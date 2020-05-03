<?php

class Peserta extends CI_CONTROLLER{
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Peserta_model');
        if($this->session->userdata('status') != "login"){
            $this->session->set_flashdata('login', 'Maaf, Anda harus login terlebih dahulu');
			redirect(base_url("login"));
		}
    }
    
    public function reguler(){
        $data['header'] = 'Peserta Reguler';
        $data['title'] = 'Peserta Reguler';
        $data['tabs'] = 'reguler';
        $data['peserta'] = $this->Peserta_model->getAllPesertaByTipe('reguler');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('modal/modal_detail_peserta');
        $this->load->view('peserta/peserta', $data);
        $this->load->view('templates/footer');
    }
    
    public function pvkhusus(){
        $data['header'] = 'Peserta Pv Khusus';
        $data['title'] = 'Peserta Pv Khusus';
        $data['tabs'] = 'pv khusus';
        $data['peserta'] = $this->Peserta_model->getAllPesertaByTipe('pv khusus');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('modal/modal_detail_peserta');
        $this->load->view('peserta/peserta', $data);
        $this->load->view('templates/footer');
    }
    
    public function pvluar(){
        $data['header'] = 'Peserta Pv Luar';
        $data['title'] = 'Peserta Pv Luar';
        $data['tabs'] = 'pv luar';
        $data['peserta'] = $this->Peserta_model->getAllPesertaByTipe('pv luar');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('modal/modal_detail_peserta');
        $this->load->view('peserta/peserta', $data);
        $this->load->view('templates/footer');
    }

    public function detail(){
        $id_peserta = $_POST['id_peserta'];
        $peserta = $this->Peserta_model->getPesertaById($id_peserta);
        echo json_encode($peserta);
    }

    public function edit(){
        $id_peserta = $_POST['id_peserta'];
        $this->Peserta_model->editDataPeserta($id_peserta);
        
        $this->session->set_flashdata('peserta', 'diedit');
        redirect($_SERVER['HTTP_REFERER']);
    }


}