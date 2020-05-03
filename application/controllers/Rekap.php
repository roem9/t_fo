<?php

class Rekap extends CI_CONTROLLER{
    public function __construct(){
        parent::__construct();
        $this->load->model('Rekap_model');
        if($this->session->userdata('status') != "login"){
            $this->session->set_flashdata('login', 'Maaf, Anda harus login terlebih dahulu');
			redirect(base_url("login"));
        }
    }
    // define $day = date('d');
    
    public function pvKhusus(){
        if($_POST){
            $month = $this->input->post("bulan");
            $year = $this->input->post("tahun");
        } else {
            $month = date('n');
            $year = date('Y');
        }

        $data['month'] = $month;
        $data['year'] = $year;
        $data['header'] = 'Rekap Pv Khusus';
        $data['title'] = 'Rekap Pv Khusus';
        $data['tabs'] = 'pv khusus';
        $data['url'] = 'pvkhusus';
        $data['kelas'] = $this->Rekap_model->getAllRekapKelasByTipe('pv khusus', $month, $year);
        $data['bulan'] = [ 
            ["id" => "1","bulan" => "Januari"], ["id" => "2","bulan" => "Februari"], ["id" => "3","bulan" => "Maret"], ["id" => "4","bulan" => "April"], ["id" => "5","bulan" => "Mei"], ["id" => "6","bulan" => "Juni"], ["id" => "7","bulan" => "Juli"], ["id" => "8","bulan" => "Agustus"], ["id" => "9","bulan" => "September"], ["id" => "10","bulan" => "Oktober"], ["id" => "11","bulan" => "November"], ["id" => "12","bulan" => "Desember"]
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('modal/modal_rekap');
        $this->load->view('modal/modal_kelas_privat');
        $this->load->view('rekap/kelas', $data);
        $this->load->view('templates/footer');
    }
    
    public function pvLuar(){
        if($_POST){
            $month = $this->input->post("bulan");
            $year = $this->input->post("tahun");
        } else {
            $month = date('n');
            $year = date('Y');
        }

        $data['month'] = $month;
        $data['year'] = $year;
        $data['header'] = 'Rekap Pv Luar';
        $data['title'] = 'Rekap Pv Luar';
        $data['tabs'] = 'pv luar';
        $data['url'] = 'pvluar';
        $data['kelas'] = $this->Rekap_model->getAllRekapKelasByTipe('pv luar', $month, $year);
        $data['bulan'] = [ 
            ["id" => "1","bulan" => "Januari"], ["id" => "2","bulan" => "Februari"], ["id" => "3","bulan" => "Maret"], ["id" => "4","bulan" => "April"], ["id" => "5","bulan" => "Mei"], ["id" => "6","bulan" => "Juni"], ["id" => "7","bulan" => "Juli"], ["id" => "8","bulan" => "Agustus"], ["id" => "9","bulan" => "September"], ["id" => "10","bulan" => "Oktober"], ["id" => "11","bulan" => "November"], ["id" => "12","bulan" => "Desember"]
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('modal/modal_rekap');
        $this->load->view('modal/modal_kelas_privat');
        $this->load->view('rekap/kelas', $data);
        $this->load->view('templates/footer');
    }

    public function dataRekapById(){
        $id_kelas = $_POST['id_kelas'];
        $bulan = $_POST['bulan'];
        $tahun = $_POST['tahun'];
        $kelas = $this->Rekap_model->getAllKbmById($id_kelas, $bulan, $tahun);
        echo json_encode($kelas);
    }
}