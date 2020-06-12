<?php

class Transaksi extends CI_CONTROLLER{
    public function __construct(){
        parent::__construct();
        $this->load->model('Transaksi_model');
        $this->load->model('Fo_model');
        if($this->session->userdata('status') != "login"){
            $this->session->set_flashdata('login', 'Maaf, Anda harus login terlebih dahulu');
			redirect(base_url("login"));
        }
    }

    public function lainnya(){
        $data['title'] = "Transaksi Lain-Lain";
        $data['header'] = "Transaksi Lain-Lain";
        // $data['detail'] = $this->Transaksi_model->get_transaksi_lain();
        $cash = $this->Fo_model->get_all("pembayaran", "id_pembayaran NOT IN(SELECT id_pembayaran FROM pembayaran_peserta) AND id_pembayaran NOT IN(SELECT id_pembayaran FROM pembayaran_kelas) AND id_pembayaran NOT IN(SELECT id_pembayaran FROM pembayaran_kpq)");
        $i = 1;
        $data['detail'] = [];

        foreach ($cash as $cash) {
            $data['detail'][$i] = $cash;
            $data['detail'][$i]['tgl'] = $cash['tgl_pembayaran'];
            $data['detail'][$i]['nama'] = $cash['nama_pembayaran'];
            $i++;
        }

        $transfer = $this->Fo_model->get_all("transfer", "id_transfer NOT IN(SELECT id_transfer FROM transfer_peserta) AND id_transfer NOT IN(SELECT id_transfer FROM transfer_kelas) AND id_transfer NOT IN(SELECT id_transfer FROM transfer_kpq)");
        foreach ($transfer as $transfer) {
            $data['detail'][$i] = $transfer;
            $data['detail'][$i]['tgl'] = $transfer['tgl_transfer'];
            $data['detail'][$i]['nama'] = $transfer['nama_transfer'];
            $i++;
        }

        usort($data['detail'], function($a, $b) {
            // return $a['tgl'] <=> $b['tgl'];
            if($a['tgl']==$b['tgl']) return 0;
            return $a['tgl'] < $b['tgl']?1:-1;
        });

        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar");
        $this->load->view("transaksi/transaksi-lain", $data);
        $this->load->view("templates/footer");
    }

    public function add_transaksi_lain(){
        $metode = $this->input->post("metode");
        if($metode == "Cash"){
            $data = [
                "tgl_pembayaran" => $this->input->post("tgl"),
                "nama_pembayaran" => $this->input->post("nama_pembayaran"),
                "keterangan" => $this->input->post("keterangan"),
                "metode" => $this->input->post("metode"),
                "uraian" => $this->input->post("uraian"),
                "nominal" => $this->Fo_model->nominal($this->input->post("nominal")),
                "pengajar" => "-"
            ];
    
            $result = $this->Fo_model->add_data("pembayaran", $data);
        } else if($metode == "Transfer"){
            // transfer
                $id = $this->Fo_model->get_last_id_transfer();
                // var_dump($id);
                // exit();
                $id = $id['id'] + 1;
                
                // id transfer
                    if($id >= 1 && $id < 10){
                        $id_transfer = "00".$id.date('my', strtotime($this->input->post("tgl")));
                    } else if($id >= 10 && $id < 100){
                        $id_transfer = "0".$id.date('my', strtotime($this->input->post("tgl")));
                    } else if($id >= 100 && $id < 1000){
                        $id_transfer = $id.date('my', strtotime($this->input->post("tgl")));
                    }
                // id transfer

                $data = [
                    "id_transfer" => $id_transfer,
                    "tgl_transfer" => $this->input->post("tgl"),
                    "nama_transfer" => $this->input->post("nama_pembayaran"),
                    "pengajar" => "-",
                    "uraian" => $this->input->post("uraian"),
                    "nominal" => $this->Fo_model->nominal($this->input->post("nominal")),
                    "keterangan" => $this->input->post("keterangan"),
                    "metode" => $this->input->post("metode"),
                    "alamat" => ''
                ];
                // var_dump($data);
                // exit();
                $result = $this->Fo_model->add_data("transfer", $data);
            // transfer
        }

        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil menambahkan transaksi<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    public function kuitansi($id){
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
        
        // $kwitansi['kwitansi'] = $this->Fo_model->get_data_pembayaran($id);
        $kwitansi['kwitansi'] = $this->Fo_model->get_one("pembayaran", ["MD5(id_pembayaran) = " => $id]);
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
		$data = $this->load->view('transaksi/cetak_kuitansi', $kwitansi, TRUE);
        $mpdf->WriteHTML($data);
		$mpdf->Output();
    }

    // get
        public function get_data_pembayaran(){
            $id = $this->input->post("id");
            $data = $this->Fo_model->get_one("pembayaran", ["id_pembayaran" => $id]);
            echo json_encode($data);
        }
    // get
    
    // edit
        public function edit_transaksi(){
            $password = $this->input->post("password");
            $id = $this->input->post("id");
            if($password == "wkwkwk"){
                $data = [
                    "nama_pembayaran" => $this->input->post("nama"),
                    "tgl_pembayaran" => $this->input->post("tgl"),
                    "uraian" => $this->input->post("uraian"),
                    "nominal" => $this->Fo_model->nominal($this->input->post("nominal"))
                ];

                $this->Fo_model->edit_data("pembayaran", ["id_pembayaran" => $id], $data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil merubah data transaksi<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Password salah, gagal mengubah data transaksi<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            }
            redirect($_SERVER['HTTP_REFERER']);
        }
    // edit
}