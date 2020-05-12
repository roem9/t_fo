<?php
class Kartupiutang extends CI_CONTROLLER{
    public function __construct(){
        parent::__construct();
        $this->load->model('KartuPiutang_model');
        $this->load->model('Fo_model');
        
        if($this->session->userdata('status') != "login"){
            $this->session->set_flashdata('flash', 'Maaf, Anda harus login terlebih dahulu');
            redirect(base_url("login"));
        }
    }
    
    public function kelas($id_kelas){
        $data['kelas'] = $this->KartuPiutang_model->dataKelasPrivat($id_kelas);
        $data['peserta'] = $this->KartuPiutang_model->dataPesertaById($id_kelas);
        $data['jadwal'] = $this->KartuPiutang_model->dataJadwalById($id_kelas);

        $data['header'] = "Kartu Piutang {$data['kelas']['nama_peserta']}";
        $data['title'] = "Kartu Piutang {$data['kelas']['nama_peserta']}";

        $data['total'] = 0;
        $data['detail'] = [];
        $i = 0;
        $piutang = $this->KartuPiutang_model->get_tagihan_kelas($id_kelas);
        foreach ($piutang as $piutang) {
            $data['detail'][$i] = $piutang;
            $data['detail'][$i]['tgl'] = $piutang['tgl_tagihan'];
            $data['detail'][$i]['status'] = "tagihan";
            $data['detail'][$i]['ket'] = $piutang['stat'];
            $data['total'] += $data['detail'][$i]['nominal'];
            $i++;
        }
        
        $deposit = $this->KartuPiutang_model->get_deposit_kelas($id_kelas);
        foreach ($deposit as $deposit) {
            $data['detail'][$i] = $deposit;
            $data['detail'][$i]['tgl'] = $deposit['tgl_deposit'];
            $data['detail'][$i]['status'] = "deposit";
            $data['total'] += $data['detail'][$i]['nominal'];
            $i++;
        }

        $data['total'] = $data['total'] * -1;

        $pembayaran = $this->KartuPiutang_model->get_pembayaran_kelas_cash($id_kelas);
        foreach ($pembayaran as $pembayaran) {
            $data['detail'][$i] = $pembayaran;
            $data['detail'][$i]['tgl'] = $pembayaran['tgl_pembayaran'];
            $data['detail'][$i]['status'] = "cash";
            $data['total'] += $data['detail'][$i]['nominal'];
            $i++;
        }
        
        $pembayaran = $this->KartuPiutang_model->get_pembayaran_kelas_transfer($id_kelas);
        foreach ($pembayaran as $pembayaran) {
            $data['detail'][$i] = $pembayaran;
            $data['detail'][$i]['tgl'] = $pembayaran['tgl_transfer'];
            $data['detail'][$i]['status'] = "transfer";
            $data['total'] += $data['detail'][$i]['nominal'];
            $i++;
        }
        
        $data['invoice'] = $this->KartuPiutang_model->get_invoice_kelas($id_kelas);

        usort($data['detail'], function($a, $b) {
            return $a['tgl'] <=> $b['tgl'];
        });

        $data['id'] = $id_kelas;
        $data['kbm'] = $this->KartuPiutang_model->get_data_kbm($id_kelas);
        
        // data modal
            $kelas = $this->Fo_model->get_data_kelas_by_id($id_kelas);
            $kpq = $this->Fo_model->get_kpq_by_id($kelas['nip']);
            $data['kpq'] = $kpq['nama_kpq'];
            $data['tipe'] = "kelas";
            $data['id'] = $id_kelas;
        // data modal

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('modal/modal_transaksi', $data);
        $this->load->view('modal/modal_edit_status_tagihan');
        $this->load->view('modal/modal_edit_tagihan');
        $this->load->view('piutang/kartu_piutang_kelas', $data);
        $this->load->view('templates/footer');
    }

    public function kpq($nip){
        $data['kpq'] = $this->KartuPiutang_model->getDataKpq($nip);
        $data['header'] = "Kartu Piutang {$data['kpq']['nama_kpq']}";
        $data['title'] = "Kartu Piutang {$data['kpq']['nama_kpq']}";

        
        $data['total'] = 0;
        $data['detail'] = [];
        $i = 0;
        $piutang = $this->KartuPiutang_model->get_tagihan_kpq($nip);
        foreach ($piutang as $piutang) {
            $data['detail'][$i] = $piutang;
            $data['detail'][$i]['tgl'] = $piutang['tgl_tagihan'];
            $data['detail'][$i]['status'] = "tagihan";
            $data['detail'][$i]['ket'] = $piutang['stat'];
            $data['total'] += $data['detail'][$i]['nominal'];
            $i++;
        }
        
        $deposit = $this->KartuPiutang_model->get_deposit_kpq($nip);
        foreach ($deposit as $deposit) {
            $data['detail'][$i] = $deposit;
            $data['detail'][$i]['tgl'] = $deposit['tgl_deposit'];
            $data['detail'][$i]['status'] = "deposit";
            $data['total'] += $data['detail'][$i]['nominal'];
            $i++;
        }

        $data['total'] = $data['total'] * -1;

        $pembayaran = $this->KartuPiutang_model->get_pembayaran_kpq_cash($nip);
        foreach ($pembayaran as $pembayaran) {
            $data['detail'][$i] = $pembayaran;
            $data['detail'][$i]['tgl'] = $pembayaran['tgl_pembayaran'];
            $data['detail'][$i]['status'] = "cash";
            $data['total'] += $data['detail'][$i]['nominal'];
            $i++;
        }
        
        $pembayaran = $this->KartuPiutang_model->get_pembayaran_kpq_transfer($nip);
        foreach ($pembayaran as $pembayaran) {
            $data['detail'][$i] = $pembayaran;
            $data['detail'][$i]['tgl'] = $pembayaran['tgl_transfer'];
            $data['detail'][$i]['status'] = "transfer";
            $data['total'] += $data['detail'][$i]['nominal'];
            $i++;
        }
        
        $data['invoice'] = $this->KartuPiutang_model->get_invoice_kpq($nip);
        $data['id'] = $nip;
        
        usort($data['detail'], function($a, $b) {
            return $a['tgl'] <=> $b['tgl'];
        });
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('modal/modal_tambah_invoice');
        $this->load->view('modal/modal_edit_invoice');
        $this->load->view('modal/modal_edit_status_tagihan');
        $this->load->view('modal/modal_transaksi', $data);
        $this->load->view('modal/modal_edit_tagihan');
        $this->load->view('piutang/kartu-piutang-kpq', $data);
        $this->load->view('templates/footer');
    }

    public function peserta($id_peserta){
        $data['total'] = 0;
        $data['detail'] = [];
        $i = 0;

        $piutang = $this->KartuPiutang_model->get_tagihan_peserta($id_peserta);
        foreach ($piutang as $piutang) {
            $data['detail'][$i] = $piutang;
            $data['detail'][$i]['tgl'] = $piutang['tgl_tagihan'];
            $data['detail'][$i]['status'] = "tagihan";
            $data['detail'][$i]['ket'] = $piutang['stat'];
            $data['total'] += $data['detail'][$i]['nominal'];
            $i++;
        }
        
        $deposit = $this->KartuPiutang_model->get_deposit_peserta($id_peserta);
        foreach ($deposit as $deposit) {
            $data['detail'][$i] = $deposit;
            $data['detail'][$i]['tgl'] = $deposit['tgl_deposit'];
            $data['detail'][$i]['status'] = "deposit";
            $data['total'] += $data['detail'][$i]['nominal'];
            $i++;
        }

        $data['total'] = $data['total'] * -1;

        $pembayaran = $this->KartuPiutang_model->get_pembayaran_peserta_cash($id_peserta);
        foreach ($pembayaran as $pembayaran) {
            $data['detail'][$i] = $pembayaran;
            $data['detail'][$i]['tgl'] = $pembayaran['tgl_pembayaran'];
            $data['detail'][$i]['status'] = "cash";
            $data['total'] += $data['detail'][$i]['nominal'];
            $i++;
        }
        
        $pembayaran = $this->KartuPiutang_model->get_pembayaran_peserta_transfer($id_peserta);
        foreach ($pembayaran as $pembayaran) {
            $data['detail'][$i] = $pembayaran;
            $data['detail'][$i]['tgl'] = $pembayaran['tgl_transfer'];
            $data['detail'][$i]['status'] = "transfer";
            $data['total'] += $data['detail'][$i]['nominal'];
            $i++;
        }
        
        $data['invoice'] = $this->KartuPiutang_model->get_invoice_peserta($id_peserta);

        $data['peserta'] = $this->KartuPiutang_model->getDataPeserta($id_peserta);
        $data['header'] = "Kartu Piutang {$data['peserta']['nama_peserta']}";
        $data['title'] = "Kartu Piutang {$data['peserta']['nama_peserta']}";
        $data['id'] = $id_peserta;
        
        usort($data['detail'], function($a, $b) {
            return $a['tgl'] <=> $b['tgl'];
        });
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('modal/modal_tambah_invoice');
        $this->load->view('modal/modal_edit_invoice');
        $this->load->view('modal/modal_edit_tagihan', $data);
        $this->load->view('modal/modal_transaksi', $data);
        $this->load->view('modal/modal_edit_status_tagihan');
        $this->load->view('piutang/kartu-piutang-peserta', $data);
        $this->load->view('templates/footer');
    }

    public function getDataPeserta(){
        $id_peserta = $this->input->post("id_peserta");
        echo json_encode($this->KartuPiutang_model->getDataPeserta($id_peserta));
    }

    public function getDataKelas(){
        $id_kelas = $this->input->post("id_kelas");
        echo json_encode($this->KartuPiutang_model->dataKelasPrivat($id_kelas));
    }

    public function getDataKpq(){
        $nip = $this->input->post("nip");
        echo json_encode($this->KartuPiutang_model->getDataKpq($nip));
    }

    public function tambah_piutang(){
        // tampilkan id terakhir dari tagihan kemudian tambah 1 
        $id = $this->KartuPiutang_model->idTagihanTerakhir();
        $id_tagihan = $id['id_tagihan'] + 1;

        // var_dump($_POST);
        $this->KartuPiutang_model->tambahPiutang($id_tagihan);
        
        $this->session->set_flashdata('piutang', 'ditambahkan');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function tambah_deposit(){
        $data = $this->KartuPiutang_model->get_last_id_pembayaran();
        $id = $data['id_pembayaran']+1;

        $this->KartuPiutang_model->add_deposit($id);

        $this->session->set_flashdata('piutang', 'ditambahkan');
        redirect($_SERVER['HTTP_REFERER']);
    }

    // edit
        public function edit_deposit(){
            $password = $this->input->post("password", true);
            
            if($password == 'wkwkwk'){
                $this->KartuPiutang_model->edit_deposit();
            } 
            redirect($_SERVER['HTTP_REFERER']);
        }

        public function edit_transaksi(){
            $password = $this->input->post("password", true);
            
            if($password == 'wkwkwk'){
                $this->KartuPiutang_model->edit_transaksi();
            } 
            // $this->session->set_flashdata('piutang', 'ditambahkan');
            redirect($_SERVER['HTTP_REFERER']);
        }
        
        public function edit_pembayaran_cash(){
            $password = $this->input->post("password", true);
            
            if($password == 'wkwkwk'){
                $this->KartuPiutang_model->edit_pembayaran_cash();
            } 

            redirect($_SERVER['HTTP_REFERER']);
        }

        public function edit_tagihan(){
            $password = $this->input->post("password", true);
            
            if($password == 'wkwkwk'){
                $this->KartuPiutang_model->edit_tagihan();
            } 

            redirect($_SERVER['HTTP_REFERER']);
        }
    // edit

    
    public function kwitansi($id){
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
        
        $kwitansi['kwitansi'] = $this->KartuPiutang_model->get_data_pembayaran($id);
        $bulan = date("m", strtotime($kwitansi['kwitansi']['tgl_pembayaran']));
        $tahun = date("y", strtotime($kwitansi['kwitansi']['tgl_pembayaran']));
        $id = $kwitansi['kwitansi']['id_pembayaran'];
        if($id > 0 && $id < 10){
            $id = '00000'.$id;
        } else if($id >= 10 && $id < 100){
            $id = '0000'.$id;
        } else if($id >= 100 && $id < 1000){
            $id = '000'.$id;
        } else if($id >= 1000 && $id < 10000){
            $id = '00'.$id;
        } else if($id >= 10000 && $id < 100000){
            $id = '0'.$id;
        } else {
            $id = $id;
        };

        $kwitansi['id'] = $tahun.$bulan.$id;

        // var_dump($kwitansi);
		$data = $this->load->view('piutang/cetak_kwitansi', $kwitansi, TRUE);
        $mpdf->WriteHTML($data);
		$mpdf->Output();
    }

    public function invoice($id){
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A5-L', 'margin_top' => '3', 'margin_left' => '3', 'margin_right' => '3', 'margin_bottom' => '3', 'default_font' => 'Candara']);
        
        $invoice['invoice'] = $this->KartuPiutang_model->get_data_invoice($id);
        $invoice['detail'] = $this->KartuPiutang_model->get_data_uraian_invoice($id);

        $invoice['id'] = substr($invoice['invoice']['id_invoice'],0, 3)."/Tag-Im/".date('n', strtotime($invoice['invoice']['tgl_invoice']))."/".date('Y', strtotime($invoice['invoice']['tgl_invoice']));

        // var_dump($kwitansi);
		$data = $this->load->view('piutang/cetak_invoice', $invoice, TRUE);
        $mpdf->WriteHTML($data);
		$mpdf->Output();

    }

    public function tambah_invoice(){
        $this->KartuPiutang_model->tambah_invoice();
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function edit_invoice(){
        $aksi = $this->input->post("aksi");
        
        if($aksi == 'doc'){
            $this->KartuPiutang_model->edit_invoice();
        } else if($aksi == 'edit') {
            $this->KartuPiutang_model->edit_uraian();
        } else if($aksi == 'tambah'){
            $this->KartuPiutang_model->add_uraian();
        } else if($aksi == 'hapus'){
            $this->KartuPiutang_model->delete_uraian();
        }
        
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    public function deposit($id){
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P', 'margin_top' => '3', 'margin_left' => '3', 'margin_right' => '3', 'margin_bottom' => '3']);
        
        $kwitansi['kwitansi'] = $this->KartuPiutang_model->get_data_pembayaran_deposit($id);

        // var_dump($kwitansi);
		$data = $this->load->view('piutang/cetak_kwitansi', $kwitansi, TRUE);
        $mpdf->WriteHTML($data);
		$mpdf->Output();
    }

    public function add_pembayaran(){
        $metode = $this->input->post("metode", TRUE);
        if($metode == "Cash"){
            $this->KartuPiutang_model->add_pembayaran();
        } else {
            $this->KartuPiutang_model->add_pembayaran_by_transfer();
        }

        $this->session->set_flashdata('piutang', 'ditambahkan');
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    // get data for ajax

        public function get_data_tagihan(){
            $data = $this->KartuPiutang_model->get_data_tagihan();
            echo json_encode($data);
        }
        
        public function get_data_tagihan_kelas(){
            $data = $this->KartuPiutang_model->get_data_tagihan_kelas();
            echo json_encode($data);
        }

        public function get_data_pembayaran(){
            $id = $this->input->post("id");
            $data = $this->KartuPiutang_model->get_data_pembayaran($id);
            echo json_encode($data);
        }

        public function get_data_invoice(){
            $id = $this->input->post("id");
            $data = $this->KartuPiutang_model->get_data_invoice($id);
            echo json_encode($data);
        }

        public function get_data_uraian_invoice(){
            $id = $this->input->post("id");
            $data = $this->KartuPiutang_model->get_data_uraian_invoice($id);
            echo json_encode($data);
        }

        public function get_data_deposit(){
            $id = $this->input->post("id");
            $data = $this->KartuPiutang_model->get_data_deposit($id);
            echo json_encode($data);
        }
    // get data for ajax
}