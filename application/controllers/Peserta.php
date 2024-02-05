<?php

class Peserta extends CI_CONTROLLER{
    public function __construct(){
        parent::__construct();
        $this->load->model('Fo_model');
        $this->load->model('Peserta_model');
        $this->load->model('Main_model');
        if($this->session->userdata('status') != "login"){
            $this->session->set_flashdata('login', 'Maaf, Anda harus login terlebih dahulu');
			redirect(base_url("login"));
		}
    }
    
    public function reguler($status){
        if($status == "nonaktif"){
            $data['title'] = 'Peserta Reguler Nonaktif';
            // $data['peserta'] = $this->Main_model->get_all("peserta_reguler", ["status" => "nonaktif"], "nama_peserta", "ASC");
            $data['sidebarDropdown'] = "reguler nonaktif";
        } else {
            $data['title'] = 'Peserta Reguler Aktif';
            // $data['peserta'] = $this->Main_model->get_all("peserta_reguler", ["status" => "aktif"], "nama_peserta", "ASC");
            $data['sidebarDropdown'] = "reguler aktif";
        }
        $data['tabs'] = 'reguler';
        
        $data['kpq'] = $this->Main_model->get_all("kpq", ["status" => "aktif"], "nama_kpq", "ASC");
        $data['ruangan'] = $this->Main_model->get_all("ruangan");
        $data['program'] = $this->Main_model->get_all("program");

        // $this->load->view('templates/header', $data);
        // $this->load->view('templates/sidebar');
        // $this->load->view('peserta/peserta_reguler', $data);
        // $this->load->view('templates/footer');
        $data['sidebar'] = "peserta";
        $data['status'] = $status;

        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar');
        $this->load->view("peserta/peserta_reguler", $data);
    }
    
    public function pvkhusus($status){
        if($status == "nonaktif"){
            $data['sidebarDropdown'] = "pv khusus nonaktif";
            $data['title'] = 'Peserta Pv Khusus Nonaktif';
            // $data['peserta'] = $this->Main_model->get_all("peserta_pv_khusus", ["status" => "nonaktif"], "nama_peserta", "ASC");
        } else {
            $data['sidebarDropdown'] = "pv khusus aktif";
            $data['title'] = 'Peserta Pv Khusus Aktif';
            // $data['peserta'] = $this->Main_model->get_all("peserta_pv_khusus", ["status" => "aktif"], "nama_peserta", "ASC");
        }
        $data['tipe'] = 'pvkhusus';
        
        // $data['kpq'] = $this->Main_model->get_all("kpq", ["status" => "aktif"], "nama_kpq", "ASC");
        // $data['ruangan'] = $this->Main_model->get_all("ruangan");
        // $data['program'] = $this->Main_model->get_all("program");

        $data['sidebar'] = "peserta";
        $data['status'] = $status;

        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar');
        $this->load->view("peserta/peserta_privat", $data);
        
        // $this->load->view('templates/header', $data);
        // $this->load->view('templates/sidebar');
        // $this->load->view('peserta/peserta_privat', $data);
        // $this->load->view('templates/footer');
    }
    
    public function pvluar($status){
        if($status == "nonaktif"){
            $data['sidebarDropdown'] = "pv luar nonaktif";
            $data['title'] = 'Peserta Pv Luar Nonaktif';
            // $data['peserta'] = $this->Akademik_model->get_all_peserta_pv_luar();
            // $data['peserta'] = $this->Main_model->get_all("peserta_pv_luar", ["status" => "nonaktif"], "nama_peserta", "ASC");
        } else {
            $data['sidebarDropdown'] = "pv luar aktif";
            $data['title'] = 'Peserta Pv Luar Aktif';
            // $data['peserta'] = $this->Akademik_model->get_all_peserta_pv_luar();
            // $data['peserta'] = $this->Main_model->get_all("peserta_pv_luar", ["status" => "aktif"], "nama_peserta", "ASC");
        }
        $data['tipe'] = 'pvluar';

        $data['kpq'] = $this->Main_model->get_all("kpq", ["status" => "aktif"], "nama_kpq", "ASC");
        $data['ruangan'] = $this->Main_model->get_all("ruangan");
        $data['program'] = $this->Main_model->get_all("program");

        $data['sidebar'] = "peserta";
        $data['status'] = $status;

        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar');
        $this->load->view("peserta/peserta_privat", $data);

        // $this->load->view('templates/header', $data);
        // $this->load->view('templates/sidebar');
        // $this->load->view('peserta/peserta_privat', $data);
        // $this->load->view('templates/footer');
    }

    function getListPesertaReguler($status) { //data data produk by JSON object
        header('Content-Type: application/json');
        $output = $this->Peserta_model->getListPesertaReguler($status);
        echo $output;
    }

    function getListPesertaPrivat($tipe, $status) { //data data produk by JSON object
        header('Content-Type: application/json');
        $output = $this->Peserta_model->getListPesertaPrivat($tipe, $status);
        echo $output;
    }

    public function get_detail_peserta(){
        $id_peserta = $this->input->post("id");
        $data['diri'] = $this->Main_model->get_one("peserta", ["id_peserta" => $id_peserta]);
        $data['alamat'] = $this->Main_model->get_one("alamat", ["id_peserta" => $id_peserta]);
        $data['ortu'] = $this->Main_model->get_one("ortu", ["id_peserta" => $id_peserta]);
        $data['pekerjaan'] = $this->Main_model->get_one("pekerjaan", ["id_peserta" => $id_peserta]);

        echo json_encode($data);
    }

    public function detail(){
        $id_peserta = $_POST['id'];
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

        $this->session->set_flashdata('pesan', 'Berhasil merubah data peserta');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function edit_peserta(){
        $id_peserta = $this->input->post("id_peserta");
        
        $info = $this->input->post("info", true);
        if($info == 'Lainnya') {
            $info = $this->input->post("civitas", true);
        }

        $data['diri'] = [
            'tgl_masuk' => $this->input->post("tgl_masuk"),
            'nama_peserta' =>$this->input->post("nama_peserta"),
            'no_hp' => $this->input->post("no_hp"),
            't4_lahir' => $this->input->post("t4_lahir"),
            'tgl_lahir' => $this->input->post("tgl_lahir"),
            'umur' => $this->input->post("umur"),
            'jk' => $this->input->post("jk"),
            'pendidikan' => $this->input->post("pendidikan"),
            'status_nikah' => $this->input->post("status_nikah"),
            'info' => $info
        ];
        $this->Main_model->edit_data("peserta", ["id_peserta" => $id_peserta], $data['diri']);

        $data['alamat'] = [
            'alamat' => $this->input->post("alamat"),
            'kel' => $this->input->post("kel"),
            'kd_pos' => $this->input->post("kd_pos"),
            'kec' => $this->input->post("kec"),
            'kab_kota' => $this->input->post("kab_kota"),
            'provinsi' => $this->input->post("provinsi"),
            'no_telp' => $this->input->post("no_telp"),
            'email' => $this->input->post("email"),
        ];
        $this->Main_model->edit_data("alamat", ["id_peserta" => $id_peserta], $data['alamat']);

        $pekerjaan = $this->input->post("pekerjaan", true);
        if($pekerjaan == 'Lainnya') {
            $pekerjaan = $this->input->post("pekerjaan_lainnya", true);
        }
        $data['pekerjaan'] = [
            'pekerjaan' => $this->input->post("pekerjaan"),
            'nama_perusahaan' => $this->input->post("nama_perusahaan"),
            'alamat_perusahaan' => $this->input->post("alamat_perusahaan"),
            'no_telp_perusahaan' => $this->input->post("no_telp_perusahaan"),
            'pekerjaan' => $pekerjaan
        ];
        $this->Main_model->edit_data("pekerjaan", ["id_peserta" => $id_peserta], $data['pekerjaan']);

        $data['ortu'] = [
            'nama_ibu' => $this->input->post("nama_ibu"),
            't4_lahir_ibu' => $this->input->post("t4_lahir_ibu"),
            'tgl_lahir_ibu' => $this->input->post("tgl_lahir_ibu"),
            'nama_ayah' => $this->input->post("nama_ayah"),
            't4_lahir_ayah' => $this->input->post("t4_lahir_ayah"),
            'tgl_lahir_ayah' => $this->input->post("tgl_lahir_ayah"),
        ];
        $this->Main_model->edit_data("ortu", ["id_peserta" => $id_peserta], $data['ortu']);
        
        $this->session->set_flashdata('pesan', 'Berhasil mengubah data peserta');
        redirect($_SERVER['HTTP_REFERER']);
    }
}