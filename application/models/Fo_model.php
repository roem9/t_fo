<?php
class Fo_model extends CI_MODEL{
    // tes 
        public function add_data($table, $data){
            $this->db->insert($table, $data);
            return $this->db->insert_id();
        }

        public function get_one($table, $where){
            $this->db->from($table);
            $this->db->where($where);
            return $this->db->get()->row_array();
        }

        public function get_all($table, $where = "", $order = "", $by = "ASC"){
            $this->db->from($table);
            if($where)
                $this->db->where($where);
            if($order)
                $this->db->order_by($order, $by);
            return $this->db->get()->result_array();
        }

        public function get_all_group_by($table, $where = "", $group = ""){
            $this->db->from($table);
            if($where)
                $this->db->where($where);
            if($group)
                $this->db->group_by($group);
            return $this->db->get()->result_array();
        }

        public function edit_data($table, $where, $data){
            $this->db->where($where);
            $this->db->update($table, $data);
            return $this->db->affected_rows();
        }

        public function delete_data($table, $where){
            $this->db->where($where);
            $this->db->delete($table);
            return $this->db->affected_rows();
        }

        public function nominal($nominal){
            $nominal = str_replace("Rp. ", "", $nominal);
            $nominal = str_replace(".", "", $nominal);
            return $nominal;
        }
    // tes 

    // get by

        public function get_peserta_by_periode_by_jk($bulan, $tahun, $jk){
            $this->db->from("peserta");
            $this->db->where("jk", $jk);
            $this->db->where("MONTH(tgl_masuk)", $bulan);
            $this->db->where("YEAR(tgl_masuk)", $tahun);
            return $this->db->get()->result_array();
        }
        
        public function get_pendidikan_by_periode($bulan, $tahun){
            $this->db->select("pendidikan");
            $this->db->from("peserta");
            $this->db->where("MONTH(tgl_masuk)", $bulan);
            $this->db->where("YEAR(tgl_masuk)", $tahun);
            $this->db->group_by("pendidikan");
            return $this->db->get()->result_array();
        }
    
        public function get_peserta_by_periode_by_pendidikan($bulan, $tahun, $pendidikan){
            $this->db->from("peserta");
            $this->db->where("pendidikan", $pendidikan);
            $this->db->where("MONTH(tgl_masuk)", $bulan);
            $this->db->where("YEAR(tgl_masuk)", $tahun);
            return $this->db->get()->result_array();
        }
    
        public function get_kelas_by_periode($bulan, $tahun){
            $this->db->from("kelas");
            $this->db->where("MONTH(tgl_mulai)", $bulan);
            $this->db->where("YEAR(tgl_mulai)", $tahun);
            return $this->db->get()->result_array();
        }
        
        public function get_peserta_by_periode_by_tipe($bulan, $tahun, $tipe){
            $this->db->from("peserta");
            $this->db->where("MONTH(tgl_masuk)", $bulan);
            $this->db->where("YEAR(tgl_masuk)", $tahun);
            $this->db->where("tipe_peserta", $tipe);
            return $this->db->get()->result_array();
        }
        
        public function get_kelas_by_periode_by_type($bulan, $tahun, $tipe){
            $this->db->from("kelas");
            $this->db->where("MONTH(tgl_mulai)", $bulan);
            $this->db->where("YEAR(tgl_mulai)", $tahun);
            $this->db->where("tipe_kelas", $tipe);
            return $this->db->get()->result_array();
        }
        
        public function get_last_id_peserta_by_type($tipe){
            $tgl_daftar = $this->input->post("tgl_daftar");
            $tahun = date('y', strtotime($tgl_daftar));

            if ($tipe == 'reguler'){
                $tipe = 'PR';
            } else if ($tipe == 'pv khusus'){
                $tipe = 'PK';
            } else if ($tipe == 'pv luar'){
                $tipe = 'PL';
            }

            $this->db->select("SUBSTRING(id_peserta, 8, 4) as id_peserta");
            $this->db->from('peserta');
            $this->db->where('SUBSTRING(id_peserta, 5, 2) = ', $tahun);
            $this->db->where('SUBSTRING(id_peserta, 1, 2) = ', $tipe);
            $this->db->order_by('id_peserta', 'desc');
            return $this->db->get()->row_array();
        }
        
        public function get_transaksi_tanggal($tgl){
            $this->db->from("pembayaran");
            $this->db->where("tgl_pembayaran", $tgl);
            $this->db->where("metode", "cash");
            return $this->db->get()->result_array();
        }

        public function get_peserta_between($tgl_awal, $tgl_akhir){
            $this->db->from("peserta");
            $where = "tgl_masuk between '$tgl_awal' AND '$tgl_akhir'";
            $this->db->where($where);
            $this->db->group_by("tgl_masuk");
            return $this->db->get()->result_array();
        }

        public function get_pengajar_by_nip($nip){
            $this->db->where("nip", $nip);
            $this->db->from("kpq");
            return $this->db->get()->row_array();
        }

        public function get_buku_by_tgl($tgl){
            $this->db->select("tgl_pembayaran as tgl, id_pembayaran as no_kuitansi, nama_pembayaran as nama, pengajar, uraian, nominal, metode");
            $this->db->from("pembayaran");
            $this->db->where("tgl_pembayaran", $tgl);
            $this->db->where("keterangan", "Buku");
            // $this->db->group_by("tgl_pembayaran");
            $cash =  $this->db->get()->result_array();

            $urut = 0;
            foreach ($cash as $cash) {
                $data[$urut] = $cash;
                $urut++;
            }

            $this->db->select("tgl_transfer as tgl, id_transfer as no_kuitansi, nama_transfer as nama, pengajar, uraian, nominal, metode");
            $this->db->from("transfer");
            $this->db->where("tgl_transfer", $tgl);
            $this->db->where("keterangan", "Buku");
            // $this->db->group_by("tgl_transfer");
            $transfer =  $this->db->get()->result_array();
            foreach ($transfer as $transfer) {
                $data[$urut] = $transfer;
                $urut++;
            }

            // $this->db->select("tgl_tagihan as tgl, id_tagihan as no_kuitansi, nama_tagihan as nama, uraian, nominal");
            // $this->db->from("tagihan");
            // $this->db->where("tgl_tagihan", $tgl);
            // $this->db->where("ket", "Buku");
            // $this->db->where("status", "piutang");
            // $this->db->group_by("tgl_tagihan");
            // $tagihan =  $this->db->get()->result_array();
            // foreach ($tagihan as $tagihan) {
            //     $data[$urut] = $tagihan;
            //     $data[$urut]['pengajar'] = "-";
            //     $data[$urut]['metode'] = "Piutang";
            //     $urut++;
            // }

            return $data;
        }
    // get by

    // get last id
        public function get_last_id_kelas(){
            $this->db->from('kelas');
            $this->db->order_by('id_kelas', 'desc');
            return $this->db->get()->row_array();
        }

        public function get_last_id_deposit(){
            $this->db->from("deposit");
            $this->db->order_by("id_deposit", "DESC");
            return $this->db->get()->row_array();
        }

        public function get_last_id_tagihan(){
            $this->db->from("tagihan");
            $this->db->order_by("id_tagihan", "DESC");
            return $this->db->get()->row_array();
        }

        public function get_last_id_transfer(){
            $bulan = date("m", strtotime($this->input->post("tgl")));
            $tahun = date("Y", strtotime($this->input->post("tgl")));
            $this->db->select("substr(id_transfer, 1, 3) as id");
            $this->db->from("transfer");
            $this->db->where("MONTH(tgl_transfer)", $bulan);
            $this->db->where("YEAR(tgl_transfer)", $tahun);
            $this->db->order_by("id", "DESC");
            return $this->db->get()->row_array();
        }

        public function get_last_id_pembayaran(){
            $this->db->from("pembayaran");
            $this->db->order_by("id_pembayaran", "DESC");
            return $this->db->get()->row_array();
        }
    // get last id

    // edit 
        public function edit_pj_by_id($id){
            $this->db->where("id_kelas", $id);
            $this->db->update("kelas", ["pj" => $this->input->post("pj")]);
        }
    // edit

    // add
        public function add_peserta($data, $id_peserta){
            $this->db->insert('peserta', $data['peserta']);
            $this->db->insert('alamat', $data['alamat']);
            $this->db->insert('ortu', $data['ortu']);
            $this->db->insert('pekerjaan', $data['pekerjaan']);

            if($data['kelas']){
                $this->db->where("id_peserta", $id_peserta);
                $this->db->update("peserta", $data['kelas']);
            }
        }
        
        public function add_kelas($data){
            $this->db->insert('kelas', $data);
        }

        public function add_koor_kelas($data, $id_kelas, $id_peserta){
            $this->db->insert('kelas_koor', $data);
            $this->db->where('id_peserta', $id_peserta);
            $this->db->update('peserta', ["id_kelas" => $id_kelas]);
        }

        public function add_transfer_by_tipe($tipe, $data){
            $this->db->insert($tipe, $data);
        }
}