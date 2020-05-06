<?php

class Pendaftaran extends CI_CONTROLLER{
    public function __construct(){
        parent::__construct();
        $this->load->model('Pendaftaran_model');
        $this->load->model('Fo_model');
        if($this->session->userdata('status') != "login"){
            $this->session->set_flashdata('login', 'Maaf, Anda harus login terlebih dahulu');
			redirect(base_url("login"));
		}
    }

    public function reguler(){
        $data['title'] = 'Tambah Peserta Reguler';
        $data['tipe'] = 'reguler';
        $data['program'] = $this->Pendaftaran_model->getAllProgram();
        $data['pengajar'] = $this->Pendaftaran_model->getAllPengajar();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('pendaftaran/form_reguler', $data);
        $this->load->view('templates/footer');
    }

    public function pvKhusus(){
        $data['title'] = 'Tambah WL PV Khusus';
        $data['tipe'] = 'pv khusus';
        $data['ket'] = 'pv khusus';
        $data['program'] = $this->Fo_model->get_all_program();
        $data['pengajar'] = $this->Fo_model->get_all_pengajar();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('pendaftaran/form_privat', $data);
        $this->load->view('templates/footer');
    }

    public function pvLuar(){
        $data['title'] = 'Tambah WL PV Luar';
        $data['tipe'] = 'pv luar';
        $data['ket'] = 'pv luar';
        $data['program'] = $this->Fo_model->get_all_program();
        $data['pengajar'] = $this->Fo_model->get_all_pengajar();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('pendaftaran/form_privat', $data);
        $this->load->view('templates/footer');
    }
    
    public function pvInstansi(){
        $data['title'] = 'Tambah WL Pv Instansi';
        $data['tipe'] = 'pv luar';
        $data['ket'] = 'pv instansi';
        $data['program'] = $this->Fo_model->get_all_program();
        $data['pengajar'] = $this->Fo_model->get_all_pengajar();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('pendaftaran/form_privat', $data);
        $this->load->view('templates/footer');
    }
    
    public function event(){
        $data['title'] = 'Tambah WL Event';
        $data['tipe'] = 'pv luar';
        $data['ket'] = 'event';
        $data['program'] = $this->Fo_model->get_all_program();
        $data['pengajar'] = $this->Fo_model->get_all_pengajar();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('pendaftaran/form_privat', $data);
        $this->load->view('templates/footer');
    }

    public function pesertaBaru($id_kelas){
        $koor = $this->Pendaftaran_model->getKoor($id_kelas);
        $data['koor'] = $koor['nama_peserta'];
        $data['tipe_peserta'] = $koor['tipe_peserta'];
        $data['id_kelas'] = $koor['id_kelas'];
        $data['prog'] = $koor['program'];
        $data['tempat'] = $koor['tempat'];
        $data['title'] = 'Tambah Peserta Baru';
        $data['header'] = 'Tambah Peserta Baru';
        $data['program'] = $this->Pendaftaran_model->getAllProgram();
        $data['pengajar'] = $this->Pendaftaran_model->getAllPengajar();
    
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('pendaftaran/form_peserta', $data);
        $this->load->view('templates/footer');
    }
    
    public function pesertaBaruReguler($id_kelas){
        $koor = $this->Pendaftaran_model->get_data_kelas($id_kelas);
        // $koor = $this
        $data['koor'] = "LKP TAR-Q";
        $data['tipe_peserta'] = 'reguler';
        $data['id_kelas'] = $id_kelas;
        $data['prog'] = $koor['program'];
        $data['tempat'] = $koor['tempat'];
        $data['title'] = 'Tambah Peserta Baru';
        $data['header'] = 'Tambah Peserta Baru';
        $data['program'] = $this->Pendaftaran_model->getAllProgram();
        $data['pengajar'] = $this->Pendaftaran_model->getAllPengajar();
    
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('pendaftaran/form_peserta', $data);
        $this->load->view('templates/footer');
    }

    // add
        public function add_reguler(){
            $tipe = $this->input->post('tipe_peserta');
            $tgl_daftar = $this->input->post("tgl_daftar");
            
            $info = $this->input->post("info", true);
            if($info == 'Lainnya') {
                $info = $this->input->post("civitas", true);
            }

            $pekerjaan = $this->input->post("pekerjaan", true);
            if($pekerjaan == 'Lainnya') {
                $pekerjaan = $this->input->post("pekerjaan_lainnya", true);
            }

            $id = $this->Fo_model->get_last_id_peserta_by_type($tipe);
            $id_peserta = $id['id_peserta'];

            if ($id_peserta != null){
                $no_urut = $id_peserta + 1;
            } else {
                $no_urut = 1;
            }

            $id_peserta = $this->id_peserta($no_urut, $tipe, $tgl_daftar);

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
                "status" => "wl",
                "umur" => $this->input->post('umur', true),
                "program" => $this->input->post('program', true),
                "hari" => $this->input->post('hari', true),
                "jam" => $this->input->post('jam', true),
                "tempat" => $this->input->post('tempat', true),
                "tgl_masuk" => $tgl_daftar
            ];

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

            $data['ortu'] = [
                "nama_ayah" => $this->input->post('nama_ayah', true),
                "t4_lahir_ayah" => $this->input->post('t4_lahir_ayah', true),
                "tgl_lahir_ayah" => $this->input->post('tgl_lahir_ayah', true),
                "nama_ibu" => $this->input->post('nama_ibu', true),
                "t4_lahir_ibu" => $this->input->post('t4_lahir_ibu', true),
                "tgl_lahir_ibu" => $this->input->post('tgl_lahir_ibu', true),
                "id_peserta" => $id_peserta
            ];
            
            $data['pekerjaan'] = [
                "pekerjaan" => $pekerjaan,
                "nama_perusahaan" => $this->input->post('nama_perusahaan', true),
                "no_telp_perusahaan" => $this->input->post('no_telp_perusahaan', true),
                "alamat_perusahaan" => $this->input->post('alamat_perusahaan', true),
                "id_peserta" => $id_peserta
            ];

            $this->Fo_model->add_peserta($data, $id_peserta);

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil mendaftarkan peserta reguler baru<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('pendaftaran/reguler');
        }

        public function add_privat(){
            $tipe = $this->input->post('tipe_peserta');
            $tgl_daftar = $this->input->post("tgl_daftar");
            
            $info = $this->input->post("info", true);
            if($info == 'Lainnya') {
                $info = $this->input->post("civitas", true);
            }

            $pekerjaan = $this->input->post("pekerjaan", true);
            if($pekerjaan == 'Lainnya') {
                $pekerjaan = $this->input->post("pekerjaan_lainnya", true);
            }

            $id = $this->Fo_model->get_last_id_peserta_by_type($tipe);
            $id_peserta = $id['id_peserta'];

            if ($id_peserta != null){
                $no_urut = $id_peserta + 1;
            } else {
                $no_urut = 1;
            }

            $id_peserta = $this->id_peserta($no_urut, $tipe, $tgl_daftar);

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
                "status" => "aktif",
                "umur" => $this->input->post('umur', true),
                "program" => $this->input->post('program', true),
                "hari" => $this->input->post('hari', true),
                "jam" => $this->input->post('jam', true),
                "tempat" => $this->input->post('tempat', true),
                "tgl_masuk" => $tgl_daftar
            ];

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

            $data['ortu'] = [
                "nama_ayah" => $this->input->post('nama_ayah', true),
                "t4_lahir_ayah" => $this->input->post('t4_lahir_ayah', true),
                "tgl_lahir_ayah" => $this->input->post('tgl_lahir_ayah', true),
                "nama_ibu" => $this->input->post('nama_ibu', true),
                "t4_lahir_ibu" => $this->input->post('t4_lahir_ibu', true),
                "tgl_lahir_ibu" => $this->input->post('tgl_lahir_ibu', true),
                "id_peserta" => $id_peserta
            ];
            
            $data['pekerjaan'] = [
                "pekerjaan" => $pekerjaan,
                "nama_perusahaan" => $this->input->post('nama_perusahaan', true),
                "no_telp_perusahaan" => $this->input->post('no_telp_perusahaan', true),
                "alamat_perusahaan" => $this->input->post('alamat_perusahaan', true),
                "id_peserta" => $id_peserta
            ];

            $this->Fo_model->add_peserta($data, $id_peserta);

            $id = $this->Fo_model->get_last_id_kelas();
            $id_kelas = $id['id_kelas'] + 1;
            
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

            $this->Fo_model->add_kelas($data['kelas']);

            $data['koor'] = [
                "id_kelas" => $id_kelas,
                "id_peserta" => $id_peserta
            ];

            // $this->Fo_model->add_koor_kelas($id_kelas, $id_peserta);
            $this->Fo_model->add_koor_kelas($data['koor'], $id_kelas, $id_peserta);
    
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil mendaftarkan peserta reguler baru<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect($_SERVER['HTTP_REFERER']);
        }
    // add


    public function tambahPesertaBaru(){
        $tipe = $this->input->post('tipe_peserta');
        $tgl_daftar = $this->input->post("tgl_daftar");
        
        $info = $this->input->post("info", true);
        if($info == 'Lainnya') {
            $info = $this->input->post("civitas", true);
        }

        $pekerjaan = $this->input->post("pekerjaan", true);
        if($pekerjaan == 'Lainnya') {
            $pekerjaan = $this->input->post("pekerjaan_lainnya", true);
        }

        $id = $this->Fo_model->get_last_id_peserta_by_type($tipe);
        $id_peserta = $id['id_peserta'];

        if ($id_peserta != null){
            $no_urut = $id_peserta + 1;
        } else {
            $no_urut = 1;
        }

        $id_peserta = $this->id_peserta($no_urut, $tipe, $tgl_daftar);

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
            "status" => "aktif",
            "umur" => $this->input->post('umur', true),
            "program" => $this->input->post('program', true),
            "hari" => $this->input->post('hari', true),
            "jam" => $this->input->post('jam', true),
            "tempat" => $this->input->post('tempat', true),
            "tgl_masuk" => $tgl_daftar
        ];

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

        $data['ortu'] = [
            "nama_ayah" => $this->input->post('nama_ayah', true),
            "t4_lahir_ayah" => $this->input->post('t4_lahir_ayah', true),
            "tgl_lahir_ayah" => $this->input->post('tgl_lahir_ayah', true),
            "nama_ibu" => $this->input->post('nama_ibu', true),
            "t4_lahir_ibu" => $this->input->post('t4_lahir_ibu', true),
            "tgl_lahir_ibu" => $this->input->post('tgl_lahir_ibu', true),
            "id_peserta" => $id_peserta
        ];
        
        $data['pekerjaan'] = [
            "pekerjaan" => $pekerjaan,
            "nama_perusahaan" => $this->input->post('nama_perusahaan', true),
            "no_telp_perusahaan" => $this->input->post('no_telp_perusahaan', true),
            "alamat_perusahaan" => $this->input->post('alamat_perusahaan', true),
            "id_peserta" => $id_peserta
        ];

        $data['kelas'] = [
            "id_kelas" => $this->input->post("id_kelas")
        ];

        $this->Fo_model->add_peserta($data, $id_peserta);

        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil mendaftarkan peserta baru<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    public function backProgram(){
        $kelas = $this->Pendaftaran_model->getAllIdKelas();
        foreach ($kelas as $kelas) {
            $peserta = $this->Pendaftaran_model->pesertaKelas($kelas['id_kelas']);
            foreach ($peserta as $peserta) {
                $this->Pendaftaran_model->changeProgram($peserta['id_peserta'], $kelas['program']);
            }
        }
    }

    // other function
        public function id_peserta($no_urut, $tipe, $tgl){
            $tahun = date('y', strtotime($tgl));
            $bulan = date('m', strtotime($tgl));
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

            return $id_peserta;
        }
}