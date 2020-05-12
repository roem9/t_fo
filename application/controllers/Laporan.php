<?php

class Laporan extends CI_CONTROLLER{
    public function __construct(){
        parent::__construct();
        $this->load->model('Fo_model');
        if($this->session->userdata('status') != "login"){
            $this->session->set_flashdata('login', 'Maaf, Anda harus login terlebih dahulu');
			redirect(base_url("login"));
		}
    }

    public function index(){
        $data['title'] = 'Form Laporan';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('laporan/form-laporan');
        $this->load->view('templates/footer');
    }

    public function cetak_laporan(){
        $laporan = $this->input->post("laporan");
        $password = $this->input->post("password");
        if ($password == "wkwkwk"){
            if($laporan == 'Transaksi'){
                $tgl_awal = $this->input->post("tgl_awal");
                $tgl_akhir = $this->input->post("tgl_akhir");
        
                $name = date("d/m/y", strtotime($tgl_awal)) ." - ". date("d/m/y", strtotime($tgl_akhir));
                header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
                header('Content-Disposition: attachment;filename="Transaksi '.$name.'.xlsx"');
                $tgl = $this->Fo_model->get_tanggal_between($tgl_awal, $tgl_akhir);
        
                $data['data'] = [];
                foreach ($tgl as $i => $tgl) {
                    $data['data'][$i]['tgl'] = $tgl['tgl_pembayaran'];
                    $data['data'][$i]['transaksi'] = $this->Fo_model->get_transaksi_tanggal($tgl['tgl_pembayaran']);
                }
                $this->load->view("laporan/pemasukan", $data);

            } else if($laporan == "Piutang Reguler"){
                $data['title'] = "Laporan Piutang Peserta Reguler";
                $name = "Piutang Reguler";
                header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
                header('Content-Disposition: attachment;filename="'.$name.'.xlsx"');

                $data['data'] = $this->Fo_model->get_all_tagihan_reguler();

                $this->load->view("laporan/piutang", $data);

            } else if($laporan == "Piutang PV Khusus"){
                $data['title'] = "Laporan Piutang Peserta PV Khusus";
                $name = "Piutang Pv Khusus";
                header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
                header('Content-Disposition: attachment;filename="'.$name.'.xlsx"');
    
                $data['data'] = $this->Fo_model->get_all_tagihan_pv_khusus();
    
                $this->load->view("laporan/piutang", $data);
            } else if($laporan == "Peserta"){
                $data['title'] = "Laporan Peserta";

                $tgl_awal = $this->input->post("tgl_awal");
                $tgl_akhir = $this->input->post("tgl_akhir");
        
                $name = date("d/m/y", strtotime($tgl_awal)) ." - ". date("d/m/y", strtotime($tgl_akhir));
                header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
                header('Content-Disposition: attachment;filename="Peserta '.$name.'.xlsx"');
                $tgl = $this->Fo_model->get_peserta_between($tgl_awal, $tgl_akhir);
        
                $data['data'] = [];
                $urut = 0;
                foreach ($tgl as $tgl) {
                    $peserta = $this->Fo_model->get_peserta_by_tgl_masuk($tgl['tgl_masuk']);
                    foreach ($peserta as $peserta) {
                        $data['data'][$urut] = $peserta;
                        $info = $this->Fo_model->get_pengajar_by_nip($peserta['info']);
                        if($info){
                            $data['data'][$urut]['info'] = $info['nama_kpq'];
                        }
                        $urut++;
                    }
                }
                $this->load->view("laporan/peserta", $data);
            } else if($laporan == "Buku"){
                $data['title'] = "Laporan Buku";

                $tgl_awal = $this->input->post("tgl_awal");
                $tgl_akhir = $this->input->post("tgl_akhir");
        
                $name = date("d/m/y", strtotime($tgl_awal)) ." - ". date("d/m/y", strtotime($tgl_akhir));
                header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
                header('Content-Disposition: attachment;filename="Buku '.$name.'.xlsx"');
                
                $tgl = $this->Fo_model->get_buku_between($tgl_awal, $tgl_akhir);

                $data['data'] = [];
                $urut = 0;
                foreach ($tgl as $tgl) {
                    $buku = $this->Fo_model->get_buku_by_tgl($tgl);
                    foreach ($buku as $buku) {
                        $data['data'][$urut] = $buku;
                        $urut++;
                    }
                }
                $this->load->view("laporan/buku", $data);
            }

        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Password salah, gagal mencetak laporan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('laporan/');
        }
    }
}