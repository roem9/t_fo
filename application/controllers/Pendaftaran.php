<?php

class Pendaftaran extends CI_CONTROLLER{
    public function __construct(){
        parent::__construct();
        $this->load->model('Pendaftaran_model');
        if($this->session->userdata('status') != "login"){
            $this->session->set_flashdata('login', 'Maaf, Anda harus login terlebih dahulu');
			redirect(base_url("login"));
		}
    }

    public function reguler(){
        $data['title'] = 'Tambah Peserta Reguler';
        $data['header'] = 'Tambah Peserta Reguler';
        $data['tabs'] = 'reguler';
        $data['tipe'] = 'reguler';
        $data['program'] = $this->Pendaftaran_model->getAllProgram();
        $data['pengajar'] = $this->Pendaftaran_model->getAllPengajar();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('pendaftaran/form_reguler', $data);
        $this->load->view('templates/footer');
    }

    public function pvKhusus(){
        $data['title'] = 'Tambah WL Pv Khusus';
        $data['header'] = 'Tambah WL Pv Khusus';
        $data['tabs'] = 'pvkhusus';
        $data['tipe'] = 'pv khusus';
        $data['ket'] = 'pv khusus';
        $data['program'] = $this->Pendaftaran_model->getAllProgram();
        $data['pengajar'] = $this->Pendaftaran_model->getAllPengajar();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('pendaftaran/form_privat', $data);
        $this->load->view('templates/footer');
    }

    public function pvLuar(){
        $data['title'] = 'Tambah WL Pv Luar';
        $data['header'] = 'Tambah WL Pv Luar';
        $data['tabs'] = 'pvluar';
        $data['tipe'] = 'pv luar';
        $data['ket'] = 'pv luar';
        $data['program'] = $this->Pendaftaran_model->getAllProgram();
        $data['pengajar'] = $this->Pendaftaran_model->getAllPengajar();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('pendaftaran/form_privat', $data);
        $this->load->view('templates/footer');
    }
    
    public function pvInstansi(){
        $data['title'] = 'Tambah WL Pv Instansi';
        $data['header'] = 'Tambah WL Pv Instansi';
        $data['tabs'] = 'pvinstansi';
        $data['tipe'] = 'pv luar';
        $data['ket'] = 'pv instansi';
        $data['program'] = $this->Pendaftaran_model->getAllProgram();
        $data['pengajar'] = $this->Pendaftaran_model->getAllPengajar();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('pendaftaran/form_privat', $data);
        $this->load->view('templates/footer');
    }
    
    public function event(){
        $data['title'] = 'Tambah WL Event';
        $data['header'] = 'Tambah WL Event';
        $data['tabs'] = 'event';
        $data['tipe'] = 'pv luar';
        $data['ket'] = 'event';
        $data['program'] = $this->Pendaftaran_model->getAllProgram();
        $data['pengajar'] = $this->Pendaftaran_model->getAllPengajar();

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

    public function tambahReguler(){
        $id = $this->Pendaftaran_model->getIdPeserta();
        $id_peserta = $id['id_peserta'];
        $status = 'wl';
        
        if ($id_peserta != null){
            $no_urut = $id_peserta + 1;
        } else {
            $no_urut = 1;
        }

        $cek = $this->Pendaftaran_model->tambahPeserta($no_urut, $status);

        $this->session->set_flashdata('peserta', 'ditambahkan');
        redirect('pendaftaran/reguler');
    }

    public function tambahPrivat(){
        $id = $this->Pendaftaran_model->getIdPeserta();
        $id_peserta = $id['id_peserta'];
        $status = 'aktif';
        
        if ($id_peserta != null){
            $no_urut = $id_peserta + 1;
        } else {
            $no_urut = 1;
        }

        $id_peserta = $this->Pendaftaran_model->tambahPeserta($no_urut, $status);

        $id = $this->Pendaftaran_model->getIdKelas();
        $id_kelas = $id['id_kelas'] + 1;

        $this->Pendaftaran_model->tambahKelas($id_kelas);

        $this->Pendaftaran_model->tambahKelasKoor($id_kelas, $id_peserta);

        $this->session->set_flashdata('peserta', 'ditambahkan');
        redirect('pendaftaran/'.$_POST['tabs']);
    }

    public function tambahPesertaBaru(){
        $id = $this->Pendaftaran_model->getIdPeserta();
        $id_peserta = $id['id_peserta'];
        $status = 'aktif';
        
        if ($id_peserta != null){
            $no_urut = $id_peserta + 1;
        } else {
            $no_urut = 1;
        }

        $this->Pendaftaran_model->tambahPeserta($no_urut, $status);

        $this->session->set_flashdata('peserta', 'ditambahkan');
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


}