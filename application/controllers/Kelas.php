<?php

class Kelas extends CI_CONTROLLER{
    public function __construct(){
        parent::__construct();
        $this->load->model('Kelas_model');
        if($this->session->userdata('status') != "login"){
            $this->session->set_flashdata('login', 'Maaf, Anda harus login terlebih dahulu');
			redirect(base_url("login"));
		}
    }

    public function reguler(){
        $data['header'] = 'Kelas Reguler';
        $data['title'] = 'Kelas Reguler';
        $data['tabs'] = 'reguler';
        $data['kelas'] = $this->Kelas_model->getAllKelasReguler();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        // $this->load->view('modal/modal_kelas_reguler');
        $this->load->view('modal/modal_kelas_privat');
        $this->load->view('kelas/kelas_reguler', $data);
        $this->load->view('templates/footer');
    }
    
    public function pvkhusus(){
        $data['header'] = 'Kelas Pv Khusus';
        $data['title'] = 'Kelas Pv Khusus';
        $data['tabs'] = 'pv khusus';
        $data['kelas'] = $this->Kelas_model->getAllKelasByTipe('pv khusus');

        // var_dump($data['kelas']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('modal/modal_kelas_privat');
        $this->load->view('kelas/kelas_privat', $data);
        $this->load->view('templates/footer');
    }
    
    public function pvluar(){
        $data['header'] = 'Kelas Pv Luar';
        $data['title'] = 'Kelas Pv Luar';
        $data['tabs'] = 'pv luar';
        $data['kelas'] = $this->Kelas_model->getAllKelasByTipe('pv luar');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('modal/modal_kelas_privat');
        $this->load->view('kelas/kelas_privat', $data);
        $this->load->view('templates/footer');
    }

    public function editWl(){
        $id_kelas = $_POST['id_kelas'];
        $this->Kelas_model->editWl($id_kelas);
        $this->session->set_flashdata('wl', 'diedit');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function dataKelasById(){
        $id_kelas = $_POST['id_kelas'];
        $kelas = $this->Kelas_model->dataKelasById($id_kelas);
        echo json_encode($kelas);
    }
    
    public function dataKelasWlById(){
        $id_kelas = $_POST['id_kelas'];
        $kelas = $this->Kelas_model->dataKelasWlById($id_kelas);
        echo json_encode($kelas);
    }

    public function dataPesertaById(){
        $id_kelas = $_POST['id_kelas'];
        $kelas = $this->Kelas_model->dataPesertaById($id_kelas);
        echo json_encode($kelas);
    }

    public function dataJadwalById(){
        $id_kelas = $_POST['id_kelas'];
        $kelas = $this->Kelas_model->dataJadwalById($id_kelas);
        echo json_encode($kelas);
    }

    public function dataKelasReguler(){
        $id_kelas = $_POST['id_kelas'];
        $kelas = $this->Kelas_model->datakelasreguler($id_kelas);
        echo json_encode($kelas);
    }
}