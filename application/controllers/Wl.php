<?php

class Wl extends CI_CONTROLLER{
    public function __construct(){
        parent::__construct();
        $this->load->model('Wl_model');
        $this->load->model('Fo_model');
        if($this->session->userdata('status') != "login"){
            $this->session->set_flashdata('login', 'Maaf, Anda harus login terlebih dahulu');
			redirect(base_url("login"));
		}
    }
    
    public function reguler(){
        $data['header'] = 'Waiting List Reguler';
        $data['title'] = 'Waiting List Reguler';
        $data['tabs'] = 'peserta';
        $data['peserta'] = $this->Fo_model->get_all("peserta", ["tipe_peserta" => "reguler", "status" => 'wl'], "nama_peserta");

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('modal/modal_detail_peserta', $data);
        $this->load->view('peserta/peserta_wl', $data);
        $this->load->view('templates/footer');
    }

    public function privat(){
        $data['header'] = 'Waiting List Privat';
        $data['title'] = 'Waiting List Privat';
        $data['tabs'] = 'kelas';
        $data['wl'] = $this->Wl_model->getKelasWl();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('modal/modal_kelas_wl');
        $this->load->view('kelas/kelas_wl', $data);
        $this->load->view('templates/footer');
    }

}