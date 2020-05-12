<?php
class Fo_model extends CI_MODEL{
    // get all
        public function get_all_program(){
            $this->db->from("program");
            $this->db->order_by("id_program");
            return $this->db->get()->result_array();
        }

        public function get_all_pengajar(){
            $this->db->from('kpq');
            $this->db->order_by('nama_kpq', 'asc');
            return $this->db->get()->result_array();
        }

        public function get_all_tagihan_reguler(){
            $this->db->from("piutang_reguler");
            $this->db->order_by("tgl_tagihan", "asc");
            return $this->db->get()->result_array();
        }

        public function get_all_tagihan_pv_khusus(){
            $this->db->from("piutang_pv_khusus as a");
            $this->db->join("kelas as b", "a.id_kelas = b.id_kelas");
            $this->db->order_by("tgl_tagihan", "asc");
            return $this->db->get()->result_array();
        }
    // get all

    // get by
        public function get_program_by_periode($bulan, $tahun){
            $this->db->select("program");
            $this->db->from("peserta as a");
            $this->db->from("program as b", "a.program=b.nama_program");
            $this->db->where("MONTH(tgl_masuk)", $bulan);
            $this->db->where("YEAR(tgl_masuk)", $tahun);
            $this->db->group_by("program");
            return $this->db->get()->result_array();
        }

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
    
        public function get_pekerjaan_by_periode($bulan, $tahun){
            $pekerjaan = array("Pelajar", "Mahasiswa", "Swasta", "PNS/BUMN", "TNI/POLRI");
    
            $this->db->select("pekerjaan");
            $this->db->from("peserta as a");
            $this->db->join("pekerjaan as b", "a.id_peserta = b.id_peserta");
            $this->db->where("MONTH(tgl_masuk)", $bulan);
            $this->db->where("YEAR(tgl_masuk)", $tahun);
            $this->db->where_in("pekerjaan", $pekerjaan);
            $this->db->group_by("pekerjaan");
            return $this->db->get()->result_array();
        }
    
        public function get_pekerjaan_lainnya_by_periode($bulan, $tahun){
            $pekerjaan = array("Pelajar", "Mahasiswa", "Swasta", "PNS/BUMN", "TNI/POLRI");
            $this->db->from("peserta as a");
            $this->db->join("pekerjaan as b", "a.id_peserta = b.id_peserta");
            $this->db->where("MONTH(tgl_masuk)", $bulan);
            $this->db->where("YEAR(tgl_masuk)", $tahun);
            $this->db->where_not_in("pekerjaan", $pekerjaan);
            // $this->db->group_by("pekerjaan");
            return $this->db->get()->result_array();
        }
    
        public function get_peserta_by_periode_by_pekerjaan($bulan, $tahun, $pekerjaan){
            $this->db->from("peserta as a");
            $this->db->join("pekerjaan as b", "a.id_peserta=b.id_peserta");
            $this->db->where("pekerjaan", $pekerjaan);
            $this->db->where("MONTH(tgl_masuk)", $bulan);
            $this->db->where("YEAR(tgl_masuk)", $tahun);
            return $this->db->get()->result_array();
        }
    
        public function get_pekerjaan_lain_by_periode($bulan, $tahun){
            $pekerjaan = array("Pelajar", "Mahasiswa", "Swasta", "PNS/BUMN", "TNI/POLRI");
            $this->db->select("pekerjaan, count(a.id_peserta) as peserta");
            $this->db->from("peserta as a");
            $this->db->join("pekerjaan as b", "a.id_peserta = b.id_peserta");
            $this->db->where("MONTH(tgl_masuk)", $bulan);
            $this->db->where("YEAR(tgl_masuk)", $tahun);
            $this->db->where_not_in("pekerjaan", $pekerjaan);
            $this->db->group_by("pekerjaan");
            return $this->db->get()->result_array();
        }
    
        public function get_informasi_by_periode($bulan, $tahun){
            $informasi = array("Teman", "Media Elektronik", "Spanduk", "Civitas Tar-Q", "Brosur", "Peserta", "Event");
    
            $this->db->select("info");
            $this->db->from("peserta");
            $this->db->where("MONTH(tgl_masuk)", $bulan);
            $this->db->where("YEAR(tgl_masuk)", $tahun);
            $this->db->where_in("info", $informasi);
            $this->db->group_by("info");
            return $this->db->get()->result_array();
        }
    
        public function get_informasi_lainnya_by_periode($bulan, $tahun){
            $informasi = array("Teman", "Media Elektronik", "Spanduk", "Civitas Tar-Q", "Brosur", "Peserta", "Event");
    
            $this->db->select("*");
            $this->db->from("peserta");
            $this->db->where("MONTH(tgl_masuk)", $bulan);
            $this->db->where("YEAR(tgl_masuk)", $tahun);
            $this->db->where_not_in("info", $informasi);
            // $this->db->group_by("info");
            return $this->db->get()->result_array();
        }
    
        public function get_informasi_by_jenis($bulan, $tahun, $informasi){
            $this->db->select("*");
            $this->db->from("peserta");
            $this->db->where("info", $informasi);
            $this->db->where("MONTH(tgl_masuk)", $bulan);
            $this->db->where("YEAR(tgl_masuk)", $tahun);
            return $this->db->get()->result_array();
        }
    
        public function get_informasi_lain_by_periode($bulan, $tahun){
            $informasi = array("Teman", "Media Elektronik", "Spanduk", "Civitas Tar-Q", "Brosur", "Peserta", "Event");
    
            $this->db->select("nama_kpq, count(a.id_peserta) as peserta");
            $this->db->from("peserta as a");
            $this->db->join("kpq as b", "a.info = b.nip");
            $this->db->where("MONTH(a.tgl_masuk)", $bulan);
            $this->db->where("YEAR(a.tgl_masuk)", $tahun);
            $this->db->group_by("nip");
            return $this->db->get()->result_array();
        }
    
        public function get_kelas_by_periode($bulan, $tahun){
            $this->db->from("kelas");
            $this->db->where("MONTH(tgl_mulai)", $bulan);
            $this->db->where("YEAR(tgl_mulai)", $tahun);
            return $this->db->get()->result_array();
        }
    
        public function get_peserta_by_periode_by_program($bulan, $tahun, $program){
            $this->db->from("peserta");
            $this->db->where("MONTH(tgl_masuk)", $bulan);
            $this->db->where("YEAR(tgl_masuk)", $tahun);
            $this->db->where("program", $program);
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

        public function get_tanggal_between($tgl_awal, $tgl_akhir){
            $this->db->select("tgl_pembayaran");
            $this->db->from("pembayaran");
            $where = "tgl_pembayaran between '$tgl_awal' AND '$tgl_akhir'";
            $this->db->where($where);
            $this->db->where("metode", "cash");
            $this->db->group_by("tgl_pembayaran");
            return $this->db->get()->result_array();
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
        
        public function get_peserta_by_tgl_masuk($tgl_masuk){
            $this->db->from("peserta as a");
            $this->db->join("alamat as b", "a.id_peserta = b.id_peserta");
            $this->db->join("pekerjaan as c", "a.id_peserta = c.id_peserta");
            $this->db->join("ortu as d", "a.id_peserta = d.id_peserta");
            $this->db->where("tgl_masuk", $tgl_masuk);
            $this->db->group_by("tipe_peserta", "ASC");
            return $this->db->get()->result_array();
        }

        public function get_pengajar_by_nip($nip){
            $this->db->where("nip", $nip);
            $this->db->from("kpq");
            return $this->db->get()->row_array();
        }

        
        public function get_buku_between($tgl_awal, $tgl_akhir){
            $this->db->select("tgl_pembayaran as tgl");
            $this->db->from("pembayaran");
            $where = "tgl_pembayaran between '$tgl_awal' AND '$tgl_akhir'";
            $this->db->where($where);
            $this->db->where("keterangan", "Buku");
            $this->db->group_by("tgl_pembayaran");
            $data =  $this->db->get()->result_array();
            $cash = [];
            foreach ($data as $i => $data) {
                $cash[$i] = $data['tgl'];
            }

            $this->db->select("tgl_transfer as tgl");
            $this->db->from("transfer");
            $where = "tgl_transfer between '$tgl_awal' AND '$tgl_akhir'";
            $this->db->where($where);
            $this->db->where("keterangan", "Buku");
            $this->db->group_by("tgl_transfer");
            $data =  $this->db->get()->result_array();
            $transfer = [];
            foreach ($data as $i => $data) {
                $transfer[$i] = $data['tgl'];
            }

            $this->db->select("tgl_tagihan as tgl");
            $this->db->from("tagihan");
            $where = "tgl_tagihan between '$tgl_awal' AND '$tgl_akhir'";
            $this->db->where($where);
            $this->db->where("ket", "Buku");
            $this->db->group_by("tgl_tagihan");
            $data =  $this->db->get()->result_array();
            $tagihan = [];
            foreach ($data as $i => $data) {
                $tagihan[$i] = $data['tgl'];
            }

            $tgl = array_unique(array_merge($cash, $transfer, $tagihan), SORT_REGULAR);
            sort($tgl);
            // var_dump($tgl);
            // exit();
            return $tgl;
        }

        public function get_buku_by_tgl($tgl){
            $this->db->select("tgl_pembayaran as tgl, id_pembayaran as no_kuitansi, nama_pembayaran as nama, pengajar, uraian, nominal, metode");
            $this->db->from("pembayaran");
            $this->db->where("tgl_pembayaran", $tgl);
            $this->db->where("keterangan", "Buku");
            $this->db->group_by("tgl_pembayaran");
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
            $this->db->group_by("tgl_transfer");
            $transfer =  $this->db->get()->result_array();
            foreach ($transfer as $transfer) {
                $data[$urut] = $transfer;
                $urut++;
            }

            $this->db->select("tgl_tagihan as tgl, id_tagihan as no_kuitansi, nama_tagihan as nama, uraian, nominal");
            $this->db->from("tagihan");
            $this->db->where("tgl_tagihan", $tgl);
            $this->db->where("ket", "Buku");
            $this->db->group_by("tgl_tagihan");
            $tagihan =  $this->db->get()->result_array();
            foreach ($tagihan as $tagihan) {
                $data[$urut] = $tagihan;
                $data[$urut]['pengajar'] = "-";
                $data[$urut]['metode'] = "Piutang";
                $urut++;
            }

            return $data;
        }

        public function get_data_kelas_by_id($id_kelas){
            $this->db->from("kelas");
            $this->db->where("id_kelas", $id_kelas);
            return $this->db->get()->row_array();
        }

        public function get_kpq_by_id($nip){
            $this->db->from("kpq");
            $this->db->where("nip", $nip);
            return $this->db->get()->row_array();
        }
    // get by

    // get last id
        public function get_last_id_kelas(){
            $this->db->from('kelas');
            $this->db->order_by('id_kelas', 'desc');
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
        
        // public function add_peserta($no_urut, $status){
        //     $tgl_daftar = $this->input->post("tgl_daftar");
        //     $tahun = date('y', strtotime($tgl_daftar));
        //     $bulan = date('m', strtotime($tgl_daftar));
        //     $tipe = $this->input->post('tipe_peserta');

        //     // id peserta
        //         if ($tipe == 'reguler'){
        //             $tipe = 'PR';
        //         } else if ($tipe == 'pv khusus'){
        //             $tipe = 'PK';
        //         } else if ($tipe == 'pv luar'){
        //             $tipe = 'PL';
        //         }

        //         if ($no_urut < 10){
        //             $id_peserta = $tipe.$bulan.$tahun.'.000'.$no_urut;
        //         } else if($no_urut >= 10 && $no_urut < 100){
        //             $id_peserta = $tipe.$bulan.$tahun.'.00'.$no_urut;
        //         } else if($no_urut >= 100 && $no_urut <1000){
        //             $id_peserta = $tipe.$bulan.$tahun.'.0'.$no_urut;
        //         } else {
        //             $id_peserta = $tipe.$bulan.$tahun.'.'.$no_urut;
        //         }
        //     // id peserta

        //     $info = $this->input->post("info", true);
        //     if($info == 'Lainnya') {
        //         $info = $this->input->post("civitas", true);
        //     }

        //     $pekerjaan = $this->input->post("pekerjaan", true);
        //     if($pekerjaan == 'Lainnya') {
        //         $pekerjaan = $this->input->post("pekerjaan_lainnya", true);
        //     }
            
        //     $data['peserta'] = [
        //         "id_peserta" => $id_peserta,
        //         "nama_peserta" => $this->input->post('nama_peserta', true),
        //         "tipe_peserta" => $this->input->post('tipe_peserta', true),
        //         "t4_lahir" => $this->input->post('t4_lahir', true),
        //         "tgl_lahir" => $this->input->post('tgl_lahir', true),
        //         "jk" => $this->input->post('jk', true),
        //         "pendidikan" => $this->input->post('pendidikan', true),
        //         "status_nikah" => $this->input->post('status_nikah', true),
        //         "no_hp" => $this->input->post('no_hp', true),
        //         "info" => $info,
        //         "status" => $status,
        //         "umur" => $this->input->post('umur', true),
        //         "program" => $this->input->post('program', true),
        //         "hari" => $this->input->post('hari', true),
        //         "jam" => $this->input->post('jam', true),
        //         "tempat" => $this->input->post('tempat', true),
        //         "tgl_masuk" => $tgl_daftar
        //     ];

        //     $this->db->insert('peserta', $data['peserta']);

        //     $data['alamat'] = [
        //         "alamat" => $this->input->post('alamat', true),
        //         "kab_kota" => $this->input->post('kab_kota', true),
        //         "provinsi" => $this->input->post('provinsi', true),
        //         "email" => $this->input->post('email', true),
        //         "kec" => $this->input->post('kec', true),
        //         "kel" => $this->input->post('kel', true),
        //         "no_telp" => $this->input->post('no_telp', true),
        //         "kd_pos" => $this->input->post('kd_pos', true),
        //         "id_peserta" => $id_peserta
        //     ];

        //     $this->db->insert('alamat', $data['alamat']);

        //     $data['ortu'] = [
        //         "nama_ayah" => $this->input->post('nama_ayah', true),
        //         "t4_lahir_ayah" => $this->input->post('t4_lahir_ayah', true),
        //         "tgl_lahir_ayah" => $this->input->post('tgl_lahir_ayah', true),
        //         "nama_ibu" => $this->input->post('nama_ibu', true),
        //         "t4_lahir_ibu" => $this->input->post('t4_lahir_ibu', true),
        //         "tgl_lahir_ibu" => $this->input->post('tgl_lahir_ibu', true),
        //         "id_peserta" => $id_peserta
        //     ];

        //     $this->db->insert('ortu', $data['ortu']);

        //     $data['pekerjaan'] = [
        //         "pekerjaan" => $pekerjaan,
        //         "nama_perusahaan" => $this->input->post('nama_perusahaan', true),
        //         "no_telp_perusahaan" => $this->input->post('no_telp_perusahaan', true),
        //         "alamat_perusahaan" => $this->input->post('alamat_perusahaan', true),
        //         "id_peserta" => $id_peserta
        //     ];

        //     $this->db->insert('pekerjaan', $data['pekerjaan']);
            
        //     // ketika menambahkan peserta dari kelas yang sudah ada
        //         if($this->input->post("id_kelas", true)){
        //             $this->db->where("id_peserta", $id_peserta);
        //             $this->db->update("peserta", ["id_kelas" => $_POST['id_kelas']]);
        //         }
        //     // ketika menambahkan peserta dari kelas yang sudah ada

        //     return $id_peserta;
        // }
        
        public function add_kelas($data){
            $this->db->insert('kelas', $data);
        }

        // public function add_koor_kelas($id_kelas, $id_peserta){
        //     $data['koor'] = [
        //         "id_kelas" => $id_kelas,
        //         "id_peserta" => $id_peserta
        //     ];
    
        //     $this->db->insert('kelas_koor', $data['koor']);
            
        //     $this->db->where('id_peserta', $id_peserta);
        //     $this->db->update('peserta', ["id_kelas" => $id_kelas]);
        // }
        
        public function add_koor_kelas($data, $id_kelas, $id_peserta){
            $this->db->insert('kelas_koor', $data);
            $this->db->where('id_peserta', $id_peserta);
            $this->db->update('peserta', ["id_kelas" => $id_kelas]);
        }
}