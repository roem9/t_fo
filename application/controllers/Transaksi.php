<?php

class Transaksi extends CI_CONTROLLER{
    public function __construct(){
        parent::__construct();
        $this->load->model('Transaksi_model');
        if($this->session->userdata('status') != "login"){
            $this->session->set_flashdata('login', 'Maaf, Anda harus login terlebih dahulu');
			redirect(base_url("login"));
        }
    }

    public function lainnya(){
        $data['title'] = "Transaksi Lain-Lain";
        $data['header'] = "Transaksi Lain-Lain";
        $data['detail'] = $this->Transaksi_model->get_transaksi_lain();

        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar");
        $this->load->view("modal/modal_transaksi_lain");
        $this->load->view("modal/modal_edit_tagihan");
        $this->load->view("piutang/transaksi-lain", $data);
        $this->load->view("templates/footer");
    }
    
    public function laporan(){
        $data['title'] = "Laporan Keuangan";
        $data['header'] = "Laporan Keuangan";

        $data['tgl'] = $this->Transaksi_model->get_tanggal();
        
        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar");
        $this->load->view("transaksi/rekap_perhari", $data);
        $this->load->view("templates/footer");
    }

    public function export($tgl){
        // export excel
        // header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        // header('Content-Disposition: attachment;filename="'.date('d-m-y', strtotime($tgl)).'.xls"');

        $bulan = date('m', strtotime($tgl));
        $tahun = date('Y', strtotime($tgl));

        $month = ["1" => "Januari", "2" => "Februari", "3" => "Maret", "4" => "April", "5" => "Mei", "6" => "Juni", "7" => "Juli","8" => "Agustus", "9" => "September", "10" => "Oktober", "11" => "November", "12" => "Desember"];
        $data['header'] = "Laporan Keuangan ". date('d', strtotime($tgl)) ." {$bulan} {$tahun}";
        $data["pengajar"] = [];
        
        $data['tgl'] = $this->Transaksi_model->get_transaksi_tanggal($tgl);

        var_dump($data['tgl']);
        // $this->load->view("transaksi/excel.php", $data);
    }

    public function cetak_laporan(){
        $password = $this->input->post("password");
        if ($password == "wkwkwk"){
            $tgl_awal = $this->input->post("tgl_awal");
            $tgl_akhir = $this->input->post("tgl_akhir");
    
            $name = date("d/m/y", strtotime($tgl_awal)) ." - ". date("d/m/y", strtotime($tgl_akhir));
            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header('Content-Disposition: attachment;filename="'.$name.'.xls"');
            $tgl = $this->Transaksi_model->get_tanggal_between();
    
            $data['data'] = [];
            foreach ($tgl as $i => $tgl) {
                $data['data'][$i]['tgl'] = $tgl['tgl_pembayaran'];
                $data['data'][$i]['transaksi'] = $this->Transaksi_model->get_transaksi_tanggal($tgl['tgl_pembayaran']);
            }
            // var_dump($data['data']);
            $this->load->view("transaksi/excel.php", $data);
        }
    }

    public function edit_status_tagihan(){
        $this->Transaksi_model->edit_status_tagihan();

        redirect($_SERVER['HTTP_REFERER']);
    }
}