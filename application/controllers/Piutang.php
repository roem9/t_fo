<?php
    class Piutang extends CI_CONTROLLER{
        public function __construct(){
            parent::__construct();
            $this->load->model('Piutang_model');
            $this->load->model('Fo_model');
            
            if($this->session->userdata('status') != "login"){
                $this->session->set_flashdata('flash', 'Maaf, Anda harus login terlebih dahulu');
                redirect(base_url("login"));
            }
        }

        public function reguler(){
            $data['header'] = 'Piutang Peserta Reguler';
            $data['title'] = 'Piutang Peserta Reguler';
            $data['tabs'] = 'reguler';
            
            $data["peserta"] = [];

            $peserta = $this->Piutang_model->get_peserta_reguler();
            foreach ($peserta as $key => $peserta) {
                $data['peserta'][$key] = $peserta;

                // tagihan
                $tagihan = $this->Piutang_model->get_total_tagihan_peserta($peserta['id_peserta']);
                // deposit
                $deposit = $this->Piutang_model->get_total_deposit_peserta($peserta['id_peserta']);
                // bayar cash
                $cash = $this->Piutang_model->get_total_cash_peserta($peserta['id_peserta']);
                // bayar transfer
                $transfer = $this->Piutang_model->get_total_transfer_peserta($peserta['id_peserta']);

                $data['peserta'][$key]['piutang'] =  $tagihan['total'] + $deposit['total'];
                $data['peserta'][$key]['bayar'] = $transfer['total'] + $cash['total'];
                
                $data['peserta'][$key]['tagihan'] = $this->Piutang_model->get_tagihan_peserta($peserta['id_peserta']);
            }

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('piutang/piutang_peserta', $data);
            $this->load->view('templates/footer');
        }

        public function pvKhusus(){
            $data['header'] = 'Piutang Kelas Pv Khusus';
            $data['title'] = 'Piutang Kelas Pv Khusus';
            $data['tabs'] = 'pvkhusus';

            $data['kelas'] = [];

            $kelas = $this->Piutang_model->get_kelas_pv_khusus();
            foreach ($kelas as $key => $kelas) {
                $data['kelas'][$key] = $kelas;
                
                // tagihan
                $tagihan = $this->Piutang_model->get_total_tagihan_kelas($kelas['id_kelas']);
                // deposit
                $deposit = $this->Piutang_model->get_total_deposit_kelas($kelas['id_kelas']);
                // bayar cash
                $cash = $this->Piutang_model->get_total_cash_kelas($kelas['id_kelas']);
                // bayar transfer
                $transfer = $this->Piutang_model->get_total_transfer_kelas($kelas['id_kelas']);

                $data['kelas'][$key]['piutang'] =  $tagihan['total'] + $deposit['total'];

                $data['kelas'][$key]['bayar'] = $transfer['total'] + $cash['total'];
                $data['kelas'][$key]['tagihan'] = $this->Piutang_model->get_tagihan_kelas($kelas['id_kelas']);
            }

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('piutang/piutang_kelas', $data);
            $this->load->view('templates/footer');
        }
        
        public function pvLuar(){
            $data['header'] = 'Piutang Kelas Pv Luar';
            $data['title'] = 'Piutang Kelas Pv Luar';
            $data['tabs'] = 'pvluar';

            $data['kelas'] = [];

            $kelas = $this->Piutang_model->get_kelas_pv_luar();
            foreach ($kelas as $key => $kelas) {
                $data['kelas'][$key] = $kelas;
                // tagihan
                $tagihan = $this->Piutang_model->get_total_tagihan_kelas($kelas['id_kelas']);
                // deposit
                $deposit = $this->Piutang_model->get_total_deposit_kelas($kelas['id_kelas']);
                // bayar cash
                $cash = $this->Piutang_model->get_total_cash_kelas($kelas['id_kelas']);
                // bayar transfer
                $transfer = $this->Piutang_model->get_total_transfer_kelas($kelas['id_kelas']);

                $data['kelas'][$key]['piutang'] =  $tagihan['total'] + $deposit['total'];
                $data['kelas'][$key]['bayar'] = $transfer['total'] + $cash['total'];
                
                $data['kelas'][$key]['tagihan'] = $this->Piutang_model->get_tagihan_kelas($kelas['id_kelas']);
            }

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('piutang/piutang_kelas', $data);
            $this->load->view('templates/footer');
        }
        
        public function kpq(){
            $data['header'] = 'Piutang KPQ';
            $data['title'] = 'Piutang KPQ';
            $data['tabs'] = 'kpq';
            
            $data['kpq'] = [];
            $kpq = $this->Piutang_model->getDataKpq();
            foreach ($kpq as $key => $kpq) {
                $data['kpq'][$key] = $kpq;
                
                // tagihan
                $tagihan = $this->Piutang_model->get_total_tagihan_kpq($kpq['nip']);
                // deposit
                $deposit = $this->Piutang_model->get_total_deposit_kpq($kpq['nip']);
                // bayar cash
                $cash = $this->Piutang_model->get_total_cash_kpq($kpq['nip']);
                // bayar transfer
                $transfer = $this->Piutang_model->get_total_transfer_kpq($kpq['nip']);

                $data['kpq'][$key]['piutang'] =  $tagihan['total'] + $deposit['total'];
                $data['kpq'][$key]['bayar'] = $transfer['total'] + $cash['total'];
                
                $data['kpq'][$key]['tagihan'] = $this->Piutang_model->get_tagihan_kpq($kpq['nip']);
            }

            // var_dump($data['kpq']);
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('piutang/piutang_kpq', $data);
            $this->load->view('templates/footer');
        }

        public function bayar(){
            $uang = str_replace("Rp.", "", $_POST['nominal']);
            $uang = str_replace(".", "", $uang);
            // var_dump($uang);
            // ganti status tagihan
            foreach ($_POST['id_tagihan'] as $id) {
                // ganti status piutang menjadi lunas
                $this->Piutang_model->bayar_piutang($id);

                $data = $this->Piutang_model->data_pembayaran($id);
                $this->Piutang_model->input_pembayaran($data);
                $uang -= $data['nominal'];
            }

            // if($uang < 0 ){
            //     $uang = $uang * (-1);
            //     $this->Piutang_model->input_sisa_piutang($data, $uang);
            // }
            // else {
            //     $this->Piutang_model->input_deposit($data, $uang);
            // }
            
            $this->session->set_flashdata('piutang', 'ditambahkan');
            redirect($_SERVER['HTTP_REFERER']);
        }

        public function pembayaran(){
            $tipe = $_POST['tipe'];
            $metode = $_POST['metode'];
            $id = $this->input->post("id", TRUE);
            $nama = $_POST['nama'];

            if($metode == "Deposit"){
                $this->Piutang_model->add_pembayaran_by_deposit();
            } else if($metode == "Transfer"){
                $id_tagihan = $this->Piutang_model->getIdTagihan();
    
                $id_tagihan = $id_tagihan['id_tagihan']+1;
    
                $this->Piutang_model->add_pembayaran_by_transfer($id_tagihan, $nama, $tipe, $id);
                
            } else {
                $id_tagihan = $this->Piutang_model->getIdTagihan();
    
                $id_tagihan = $id_tagihan['id_tagihan']+1;
    
                $this->Piutang_model->add_pembayaran($id_tagihan, $nama, $tipe, $id);
            }
            
            $this->session->set_flashdata('piutang', 'ditambahkan');
            redirect($_SERVER['HTTP_REFERER']);
        }

        // edit
            public function edit_pj_by_id(){
                $id = $this->input->post("id");
                $this->Fo_model->edit_pj_by_id($id);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>mengubah</strong> PJ Kelas<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect($_SERVER['HTTP_REFERER']);
            }
            
    }
?>