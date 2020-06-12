<?php

class Laporan extends CI_CONTROLLER{
    public function __construct(){
        parent::__construct();
        $this->load->model('Fo_model');
        $this->load->model('Laporan_model');
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
                $data['title'] = "Laporan Pemasukan Cash " . date("d-M-Y", strtotime($tgl_awal)) . " - " . date("d-M-Y", strtotime($tgl_akhir));
        
                $name = date("d/m/y", strtotime($tgl_awal)) ." - ". date("d/m/y", strtotime($tgl_akhir));
                header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
                header('Content-Disposition: attachment;filename="Transaksi Cash '.$name.'.xls"');
                $tgl = $this->Fo_model->get_all_group_by("pembayaran", ["tgl_pembayaran between '$tgl_awal' AND '$tgl_akhir'", "metode" => "cash"], "tgl_pembayaran");
        
                $data['data'] = [];
                foreach ($tgl as $i => $tgl) {
                    $data['data'][$i]['tgl'] = $tgl['tgl_pembayaran'];
                    $data['data'][$i]['transaksi'] = $this->Fo_model->get_all("pembayaran", ["tgl_pembayaran" => $tgl['tgl_pembayaran'], "metode" =>  "cash"]);
                }
                $this->load->view("laporan/transaksi_cash", $data);

            } else if($laporan == "Piutang Reguler"){
                $data['title'] = "Laporan Piutang Peserta Reguler";
                $name = "Piutang Reguler";
                header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
                header('Content-Disposition: attachment;filename="'.$name.'.xls"');
                $data['data'] = $this->Fo_model->get_all("piutang_reguler", "", "tgl_tagihan");

                $this->load->view("laporan/piutang", $data);
            } else if($laporan == "Piutang PV Khusus"){
                $data['title'] = "Laporan Piutang Peserta PV Khusus";
                $name = "Piutang Pv Khusus";
                header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
                header('Content-Disposition: attachment;filename="'.$name.'.xls"');
                $data['data'] = $this->Laporan_model->get_all_tagihan_pv_khusus();
                $this->load->view("laporan/piutang", $data);
            } else if($laporan == "Peserta Reguler"){
                $tgl_awal = $this->input->post("tgl_awal");
                $tgl_akhir = $this->input->post("tgl_akhir");
                $data['title'] = "Laporan Peserta Reguler " . date("d-M-Y", strtotime($tgl_awal)) . " - " . date("d-M-Y", strtotime($tgl_akhir));
        
                $name = date("d/m/y", strtotime($tgl_awal)) ." - ". date("d/m/y", strtotime($tgl_akhir));
                header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
                header('Content-Disposition: attachment;filename="Laporan Peserta Reguler '.$name.'.xls"');
                $tgl = $this->Fo_model->get_all_group_by("peserta", "(tgl_masuk between '$tgl_awal' AND '$tgl_akhir') AND tipe_peserta = 'reguler'", "tgl_masuk");
                $data['data'] = [];
                $urut = 0;
                foreach ($tgl as $tgl) {
                    $peserta = $this->Laporan_model->get_peserta_by_tgl_masuk($tgl['tgl_masuk']);
                    foreach ($peserta as $peserta) {
                        $data['data'][$urut] = $peserta;
                        $info = $this->Fo_model->get_one("kpq", ["nip" => $peserta['info']]);
                        if($info){
                            $data['data'][$urut]['info'] = $info['nama_kpq'];
                        }
                        $urut++;
                    }
                }
                $this->load->view("laporan/peserta", $data);
            } else if($laporan == "Peserta PV Khusus"){
                $tgl_awal = $this->input->post("tgl_awal");
                $tgl_akhir = $this->input->post("tgl_akhir");
                $data['title'] = "Laporan Peserta PV Khusus " . date("d-M-Y", strtotime($tgl_awal)) . " - " . date("d-M-Y", strtotime($tgl_akhir));
        
                $name = date("d/m/y", strtotime($tgl_awal)) ." - ". date("d/m/y", strtotime($tgl_akhir));
                header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
                header('Content-Disposition: attachment;filename="Laporan Peserta PV Khusus '.$name.'.xls"');
                $tgl = $this->Fo_model->get_all_group_by("peserta", "(tgl_masuk between '$tgl_awal' AND '$tgl_akhir') AND tipe_peserta = 'pv khusus'", "tgl_masuk");
                $data['data'] = [];
                $urut = 0;
                foreach ($tgl as $tgl) {
                    $peserta = $this->Laporan_model->get_peserta_by_tgl_masuk($tgl['tgl_masuk']);
                    foreach ($peserta as $peserta) {
                        $data['data'][$urut] = $peserta;
                        $info = $this->Fo_model->get_one("kpq", ["nip" => $peserta['info']]);
                        if($info){
                            $data['data'][$urut]['info'] = $info['nama_kpq'];
                        }
                        $urut++;
                    }
                }
                $this->load->view("laporan/peserta", $data);
            }else if($laporan == "Peserta PV Luar"){
                $tgl_awal = $this->input->post("tgl_awal");
                $tgl_akhir = $this->input->post("tgl_akhir");
                $data['title'] = "Laporan Peserta PV Luar " . date("d-M-Y", strtotime($tgl_awal)) . " - " . date("d-M-Y", strtotime($tgl_akhir));
        
                $name = date("d/m/y", strtotime($tgl_awal)) ." - ". date("d/m/y", strtotime($tgl_akhir));
                header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
                header('Content-Disposition: attachment;filename="Laporan Peserta PV Luar '.$name.'.xls"');
                $tgl = $this->Fo_model->get_all_group_by("peserta", "(tgl_masuk between '$tgl_awal' AND '$tgl_akhir') AND tipe_peserta = 'pv luar'", "tgl_masuk");
                $data['data'] = [];
                $urut = 0;
                foreach ($tgl as $tgl) {
                    $peserta = $this->Laporan_model->get_peserta_by_tgl_masuk($tgl['tgl_masuk']);
                    foreach ($peserta as $peserta) {
                        $data['data'][$urut] = $peserta;
                        $info = $this->Fo_model->get_one("kpq", ["nip" => $peserta['info']]);
                        if($info){
                            $data['data'][$urut]['info'] = $info['nama_kpq'];
                        }
                        $urut++;
                    }
                }
                $this->load->view("laporan/peserta", $data);
            }else if($laporan == "Buku"){
                $tgl_awal = $this->input->post("tgl_awal");
                $tgl_akhir = $this->input->post("tgl_akhir");
                $data['title'] = "Laporan Buku " . date("d-M-Y", strtotime($tgl_awal)) . " - " . date("d-M-Y", strtotime($tgl_akhir));
                $name = date("d/m/y", strtotime($tgl_awal)) ." - ". date("d/m/y", strtotime($tgl_akhir));
                header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
                header('Content-Disposition: attachment;filename="Laporan Buku '.$name.'.xlsx"');
                $tgl = $this->Laporan_model->get_buku_between($tgl_awal, $tgl_akhir);
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