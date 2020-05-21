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
        $this->load->view('wl/peserta_wl', $data);
        $this->load->view('templates/footer');
    }

    public function privat(){
        $data['header'] = 'Waiting List Privat';
        $data['title'] = 'Waiting List Privat';
        $data['tabs'] = 'kelas';
        $data['wl'] = $this->Wl_model->getKelasWl();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('wl/kelas_wl', $data);
        $this->load->view('templates/footer');
    }

    // edit data
        public function editWl(){
            $id_kelas = $_POST['id_kelas'];
            $data = [
                "status" => $this->input->post('status'),
                "program" => $this->input->post('program'),
                "pengajar" => $this->input->post('pengajar'),
                "tempat" => $this->input->post('tempat', TRUE),
                "catatan" => $this->input->post('catatan', TRUE)
            ];
            $this->Fo_model->edit_data("kelas", ["id_kelas" => $id_kelas], $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil merubah data waiting list<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect($_SERVER['HTTP_REFERER']);
        }
    // edit data

    // get data
        public function dataKelasWlById(){
            $id_kelas = $_POST['id_kelas'];
            $kelas = $this->Wl_model->dataKelasWlById($id_kelas);
            echo json_encode($kelas);
        }

        public function dataPesertaById(){
            $id_kelas = $_POST['id_kelas'];
            $kelas = $this->Fo_model->get_all("peserta", ["id_kelas" => $id_kelas]);
            echo json_encode($kelas);
        }
    // get data
}