<?php

class Peserta extends CI_CONTROLLER{
    public function __construct(){
        parent::__construct();
        $this->load->model('Fo_model');
        $this->load->model('Peserta_model');
        if($this->session->userdata('status') != "login"){
            $this->session->set_flashdata('login', 'Maaf, Anda harus login terlebih dahulu');
			redirect(base_url("login"));
		}
    }
    
    public function reguler(){
        $data['header'] = 'Peserta Reguler';
        $data['title'] = 'Peserta Reguler';
        $data['peserta'] = $this->Fo_model->get_all("peserta_reguler", "", "nama_peserta");

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('modal/modal_detail_peserta');
        $this->load->view('peserta/peserta_reguler', $data);
        $this->load->view('templates/footer');
    }
    
    public function pvkhusus(){
        $data['header'] = 'Peserta Pv Khusus';
        $data['title'] = 'Peserta Pv Khusus';
        $data['peserta'] = $this->Fo_model->get_all("peserta_pv_khusus", "", "nama_peserta");

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('modal/modal_detail_peserta');
        $this->load->view('peserta/peserta_pv', $data);
        $this->load->view('templates/footer');
    }
    
    public function pvluar(){
        $data['header'] = 'Peserta Pv Luar';
        $data['title'] = 'Peserta Pv Luar';
        $data['peserta'] = $this->Fo_model->get_all("peserta_pv_luar", "", "nama_peserta");

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('modal/modal_detail_peserta');
        $this->load->view('peserta/peserta_pv', $data);
        $this->load->view('templates/footer');
    }

    public function detail(){
        $id_peserta = $_POST['id_peserta'];
        $peserta = $this->Peserta_model->getPesertaById($id_peserta);
        echo json_encode($peserta);
    }

    public function edit(){
        $id_peserta = $_POST['id_peserta'];
        $data['peserta'] = [
            "nama_peserta" => $this->input->post('nama', true),
            "status" => $this->input->post('status', true),
            "jk" => $this->input->post('jk', true),
            "no_hp" => $this->input->post('no_hp', true),
            "program" => $this->input->post('program', true),
            "hari" => $this->input->post('hari', true),
            "jam" => $this->input->post('jam', true),
            "tempat" => $this->input->post('tempat', true)
        ];
        // edit data (table, where, data)
        $this->Fo_model->edit_data("peserta", ["id_peserta" => $id_peserta], $data['peserta']);

        $data['alamat'] = [
            "alamat" => $this->input->post('alamat_peserta', true)
        ];
        // edit data (table, where, data)
        $this->Fo_model->edit_data("alamat", ["id_peserta" => $id_peserta], $data['alamat']);

        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <b>merubah</b> data peserta<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect($_SERVER['HTTP_REFERER']);
    }
}