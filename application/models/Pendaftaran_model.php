<?php
class Pendaftaran_model extends CI_MODEL{
    public function getAllPengajar(){
        $this->db->select('a.nip, nama_kpq');
        $this->db->from('kpq as a');
        $this->db->order_by('nama_kpq', 'asc');
        return $this->db->get()->result_array();
    }

    public function getAllIdKelas(){
        $this->db->select("id_kelas, program");
        $this->db->from("kelas");
        return $this->db->get()->result_array();
    }

    public function pesertaKelas($id_kelas){
        $this->db->select("id_peserta");
        $this->db->from("peserta");
        $this->db->where("id_kelas", $id_kelas);
        return $this->db->get()->result_array();
    }

    public function changeProgram($id_peserta, $program){
        $this->db->where("id_peserta", $id_peserta);
        $this->db->update("peserta", ["program" => $program]);
    }


    public function getIdPeserta(){
        $tgl_daftar = $this->input->post("tgl_daftar");
        $tahun = date('y', strtotime($tgl_daftar));
        // $tahun = "19";
        $tipe = $this->input->post('tipe_peserta');

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
    
    public function getIdKelas(){
        $this->db->from('kelas');
        $this->db->order_by('id_kelas', 'desc');
        return $this->db->get()->row_array();
    }
    
    public function tambahPeserta($no_urut, $status){
        
        $tgl_daftar = $this->input->post("tgl_daftar");
        $tahun = date('y', strtotime($tgl_daftar));
        $bulan = date('m', strtotime($tgl_daftar));
        // $bulan = "09";
        // $tahun = "19";

        $tipe = $this->input->post('tipe_peserta');

        if ($tipe == 'reguler'){
            $tipe = 'PR';
        } else if ($tipe == 'pv khusus'){
            $tipe = 'PK';
        } else if ($tipe == 'pv luar'){
            $tipe = 'PL';
        }
        
        if ($no_urut < 10){
            $id_peserta = $tipe.$bulan.$tahun.'.000'.$no_urut;
        } else if($no_urut >= 10 && $no_urut < 100){
            $id_peserta = $tipe.$bulan.$tahun.'.00'.$no_urut;
        } else if($no_urut >= 100 && $no_urut <1000){
            $id_peserta = $tipe.$bulan.$tahun.'.0'.$no_urut;
        } else {
            $id_peserta = $tipe.$bulan.$tahun.'.'.$no_urut;
        }

        $info = $this->input->post("info", true);
        $pekerjaan = $this->input->post("pekerjaan", true);
        
        if($info == 'Lainnya') {
            $info = $this->input->post("civitas", true);
        }
        
        if($pekerjaan == 'Lainnya') {
            $pekerjaan = $this->input->post("pekerjaan_lainnya", true);
        }

        $data['peserta'] = [
            "id_peserta" => $id_peserta,
            "nama_peserta" => $this->input->post('nama_peserta', true),
            "tipe_peserta" => $this->input->post('tipe_peserta', true),
            "t4_lahir" => $this->input->post('t4_lahir', true),
            "tgl_lahir" => $this->input->post('tgl_lahir', true),
            "jk" => $this->input->post('jk', true),
            "pendidikan" => $this->input->post('pendidikan', true),
            "status_nikah" => $this->input->post('status_nikah', true),
            "no_hp" => $this->input->post('no_hp', true),
            "info" => $info,
            "status" => $status,
            "umur" => $this->input->post('umur', true),
            "program" => $this->input->post('program', true),
            "hari" => $this->input->post('hari', true),
            "jam" => $this->input->post('jam', true),
            "tempat" => $this->input->post('tempat', true),
            "tgl_masuk" => $tgl_daftar
            // "tgl_masuk" => "2019-09-09"
        ];

        $this->db->insert('peserta', $data['peserta']);

        $data['alamat'] = [
            "alamat" => $this->input->post('alamat', true),
            "kab_kota" => $this->input->post('kab_kota', true),
            "provinsi" => $this->input->post('provinsi', true),
            "email" => $this->input->post('email', true),
            "kec" => $this->input->post('kec', true),
            "kel" => $this->input->post('kel', true),
            "no_telp" => $this->input->post('no_telp', true),
            "kd_pos" => $this->input->post('kd_pos', true),
            "id_peserta" => $id_peserta
        ];

        $this->db->insert('alamat', $data['alamat']);

        $data['ortu'] = [
            "nama_ayah" => $this->input->post('nama_ayah', true),
            "t4_lahir_ayah" => $this->input->post('t4_lahir_ayah', true),
            "tgl_lahir_ayah" => $this->input->post('tgl_lahir_ayah', true),
            "nama_ibu" => $this->input->post('nama_ibu', true),
            "t4_lahir_ibu" => $this->input->post('t4_lahir_ibu', true),
            "tgl_lahir_ibu" => $this->input->post('tgl_lahir_ibu', true),
            "id_peserta" => $id_peserta
        ];

        $this->db->insert('ortu', $data['ortu']);

        $data['pekerjaan'] = [
            "pekerjaan" => $pekerjaan,
            "nama_perusahaan" => $this->input->post('nama_perusahaan', true),
            "no_telp_perusahaan" => $this->input->post('no_telp_perusahaan', true),
            "alamat_perusahaan" => $this->input->post('alamat_perusahaan', true),
            "id_peserta" => $id_peserta
        ];

        $this->db->insert('pekerjaan', $data['pekerjaan']);
        
        if($this->input->post("id_kelas", true)){
            $this->db->where("id_peserta", $id_peserta);
            $this->db->update("peserta", ["id_kelas" => $_POST['id_kelas']]);
        }

        return $id_peserta;
    }
    
    public function tambahKelas($id_kelas){
        $data['kelas'] = [
            "id_kelas" => $id_kelas,
            "tgl_mulai" => date('Y-m-d'),
            "program" => $this->input->post('program', true),
            "catatan" => $this->input->post('catatan', true),
            "status" => 'wl',
            "tipe_kelas" => $this->input->post('tipe_peserta', true),
            "ket" => $this->input->post('ket', true),
            "pengajar" => $this->input->post('pengajar', true),
            "tempat" => $this->input->post('tempat', true)
        ];
        
        $this->db->insert('kelas', $data['kelas']);
    }

    public function tambahKelasKoor($id_kelas, $id_peserta){
        $data['koor'] = [
            "id_kelas" => $id_kelas,
            "id_peserta" => $id_peserta
        ];

        $this->db->insert('kelas_koor', $data['koor']);
        
        $this->db->where('id_peserta', $id_peserta);
        $this->db->update('peserta', ["id_kelas" => $id_kelas]);
    }

    public function getAllProgram(){
        $this->db->from("program");
        $this->db->order_by("id_program");
        return $this->db->get()->result_array();
    }

    public function getKoor($id_kelas){
        $this->db->select("nama_peserta, tipe_peserta, a.id_kelas, c.program, a.tempat");
        $this->db->from("peserta as a");
        $this->db->join("kelas_koor as b", "a.id_peserta=b.id_peserta");
        $this->db->join("kelas as c", "c.id_kelas=b.id_kelas");
        $this->db->where("a.id_kelas", $id_kelas);
        return $this->db->get()->row_array();
    }

    public function get_data_kelas($id){
        $this->db->from("kelas");
        $this->db->where("id_kelas", $id);
        return $this->db->get()->row_array();
    }
}