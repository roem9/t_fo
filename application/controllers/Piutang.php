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
            
            $data["peserta"] = [];

            $peserta = $this->Fo_model->get_all("peserta_reguler", "", "nama_peserta");
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
            }

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('piutang/piutang_peserta', $data);
            $this->load->view('templates/footer');
        }

        public function pvKhusus(){
            $data['header'] = 'Piutang Kelas Pv Khusus';
            $data['title'] = 'Piutang Kelas Pv Khusus';

            $data['kelas'] = [];

            $kelas = $this->Fo_model->get_all("kelas_pv_khusus", "", "nama_peserta");
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

            $kelas = $this->Fo_model->get_all("kelas_pv_luar", "", "nama_peserta");
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
            }

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('piutang/piutang_kelas', $data);
            $this->load->view('templates/footer');
        }
        
        public function civitas(){
            $data['header'] = 'Piutang Civitas';
            $data['title'] = 'Piutang Civitas';
            
            $data['kpq'] = [];
            $kpq = $this->Fo_model->get_all("kpq", ["status !=" => "hapus"], "nama_kpq");
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

                $data['kpq'][$key]['piutang'] = $tagihan['total'] + $deposit['total'];
                $data['kpq'][$key]['bayar'] = $transfer['total'] + $cash['total'];
                
                $data['kpq'][$key]['tagihan'] = $this->Piutang_model->get_total_tagihan_kpq($kpq['nip']);
            }

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('piutang/piutang_kpq', $data);
            $this->load->view('templates/footer');
        }

        // edit
            public function edit_pj_by_id(){
                $id = $this->input->post("id");
                $data = [
                    "pj" => $this->input->post("pj")
                ];
                $this->Fo_model->edit_data("kelas", ["id_kelas" => $id], $data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>mengubah</strong> PJ Kelas<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect($_SERVER['HTTP_REFERER']);
            }
        // edit
    }
?>