<?php

class Wl extends CI_CONTROLLER{
    public function __construct(){
        parent::__construct();
        $this->load->model('Wl_model');
        if($this->session->userdata('status') != "login"){
            $this->session->set_flashdata('login', 'Maaf, Anda harus login terlebih dahulu');
			redirect(base_url("login"));
		}
    }
    
    public function peserta(){
        $data['header'] = 'Waiting List';
        $data['title'] = 'Peserta Wl';
        $data['tabs'] = 'peserta';
        $data['peserta'] = $this->Wl_model->getPesertaWl();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('modal/modal_detail_peserta', $data);
        $this->load->view('peserta/peserta', $data);
        $this->load->view('templates/footer');
    }

    public function kelas(){
        $data['header'] = 'Waiting List';
        $data['title'] = 'Kelas Wl';
        $data['tabs'] = 'kelas';
        $data['wl'] = $this->Wl_model->getKelasWl();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('modal/modal_kelas_wl');
        $this->load->view('kelas/kelas_wl', $data);
        $this->load->view('templates/footer');
    }

}