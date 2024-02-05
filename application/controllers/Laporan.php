<?php

class Laporan extends CI_CONTROLLER{
    public function __construct(){
        parent::__construct();
        $this->load->model('Fo_model');
        $this->load->model('Laporan_model');
        $this->load->model('Home_model');
        $this->load->model('Main_model');
        if($this->session->userdata('status') != "login"){
            $this->session->set_flashdata('login', 'Maaf, Anda harus login terlebih dahulu');
			redirect(base_url("login"));
		}
    }

    public function index(){
        // $data['title'] = 'Form Laporan';
        $data['title'] = "Form Laporan";
        $data['sidebar'] = "laporan";
        $data['sidebarDropdown'] = "";

        // $this->load->view('templates/header', $data);
        // $this->load->view('templates/sidebar');
        // $this->load->view('laporan/form-laporan');
        // $this->load->view('templates/footer');
        $this->load->view("layout/header", $data);
        $this->load->view("layout/navbar", $data);
        $this->load->view("laporan/form-laporan", $data);
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
                $tgl = $this->Fo_model->get_all_group_by("pembayaran", "(tgl_pembayaran between '$tgl_awal' AND '$tgl_akhir') AND metode = 'cash'", "tgl_pembayaran");
        
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
            } else if($laporan == "Peserta Keseluruhan"){
                $tgl_awal = $this->input->post("tgl_awal");
                $tgl_akhir = $this->input->post("tgl_akhir");
                $data['title'] = "Laporan Peserta Keseluruhan " . date("d-M-Y", strtotime($tgl_awal)) . " - " . date("d-M-Y", strtotime($tgl_akhir));
        
                $name = date("d/m/y", strtotime($tgl_awal)) ." - ". date("d/m/y", strtotime($tgl_akhir));
                header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
                header('Content-Disposition: attachment;filename="Laporan Peserta Keseluruhan '.$name.'.xls"');
                $tgl = $this->Fo_model->get_all_group_by("peserta", "(tgl_masuk between '$tgl_awal' AND '$tgl_akhir')", "tgl_masuk");
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

                $data['rekap']['gender']['wanita'] = COUNT($this->Fo_model->get_all("peserta", "(tgl_masuk between '$tgl_awal' AND '$tgl_akhir') AND jk = 'Wanita'"));
                $data['rekap']['gender']['pria'] = COUNT($this->Fo_model->get_all("peserta", "(tgl_masuk between '$tgl_awal' AND '$tgl_akhir') AND jk = 'Pria'"));

                // $data['rekap']['pendidikan'] = [];
                $pendidikan = $this->Fo_model->get_all_group_by("peserta", "(tgl_masuk between '$tgl_awal' AND '$tgl_akhir')", "pendidikan");
                foreach ($pendidikan as $key => $pendidikan) {
                    $data['rekap']['pendidikan'][$key]['pendidikan'] = $pendidikan['pendidikan'];
                    // $where = ["MONTH(tgl_masuk)" => $bulan, "YEAR(tgl_masuk)" => $tahun, "pendidikan" => $pendidikan['rekap'];
                    $data['rekap']['pendidikan'][$key]['peserta'] = COUNT($this->Fo_model->get_all("peserta", "(tgl_masuk between '$tgl_awal' AND '$tgl_akhir') AND pendidikan = '$pendidikan[pendidikan]'"));
                }

                // $data['rekap']['pekerjaan'] = [];
                $pekerjaan = $this->Home_model->get_pekerjaan_between("(tgl_masuk between '$tgl_awal' AND '$tgl_akhir')");
                foreach ($pekerjaan as $key => $pekerjaan) {
                    $data['rekap']['pekerjaan'][$key]['pekerjaan'] = $pekerjaan['pekerjaan'];
                    $data['rekap']['pekerjaan'][$key]['peserta'] = COUNT($this->Home_model->get_peserta_between_by_pekerjaan("(tgl_masuk between '$tgl_awal' AND '$tgl_akhir')", $pekerjaan['pekerjaan']));
                }

                $data['rekap']['pekerjaan_lainnya'] = COUNT($this->Home_model->get_pekerjaan_lainnya_between("(tgl_masuk between '$tgl_awal' AND '$tgl_akhir')"));

                
                $informasi = $this->Home_model->get_informasi_between("(tgl_masuk between '$tgl_awal' AND '$tgl_akhir')");
                $data['informasi'] = [];
                foreach ($informasi as $key => $informasi) {
                    $data['rekap']['informasi'][$key]['informasi'] = $informasi['info'];
                    $data['rekap']['informasi'][$key]['peserta'] = COUNT($this->Home_model->get_informasi_between_by_jenis("(tgl_masuk between '$tgl_awal' AND '$tgl_akhir')", $informasi['info']));
                }

                $data['rekap']['informasi_lainnya'] = COUNT($this->Home_model->get_informasi_lainnya_between("(tgl_masuk between '$tgl_awal' AND '$tgl_akhir')"));

                $program = $this->Home_model->get_program_between("(tgl_masuk between '$tgl_awal' AND '$tgl_akhir')");
                $data['program'] = [];
                foreach ($program as $key => $program) {
                    $data['rekap']['program'][$key]['program'] = $program['program'];
                    $data['rekap']['program'][$key]['peserta'] = COUNT($this->Home_model->get_peserta_between_by_program("(tgl_masuk between '$tgl_awal' AND '$tgl_akhir')", $program['program']));
                }

                
                $data['rekap']['total'] = $data['rekap']['gender']['wanita'] + $data['rekap']['gender']['pria'];
                $data['rekap']['kelas'] = COUNT($this->Fo_model->get_all("kelas", "(tgl_mulai between '$tgl_awal' AND '$tgl_akhir')"));
                $data['rekap']['peserta_reguler'] = COUNT($this->Fo_model->get_all("peserta", "(tgl_masuk between '$tgl_awal' AND '$tgl_akhir') AND tipe_peserta = 'reguler'"));
                $data['rekap']['peserta_pv_khusus'] = COUNT($this->Fo_model->get_all("peserta", "(tgl_masuk between '$tgl_awal' AND '$tgl_akhir') AND tipe_peserta = 'pv khusus'"));
                $data['rekap']['peserta_pv_luar'] = COUNT($this->Fo_model->get_all("peserta", "(tgl_masuk between '$tgl_awal' AND '$tgl_akhir') AND tipe_peserta = 'pv luar'"));
                $data['rekap']['kelas_pv_khusus'] = COUNT($this->Fo_model->get_all("kelas", "(tgl_mulai between '$tgl_awal' AND '$tgl_akhir') AND tipe_kelas = 'pv khusus'"));
                $data['rekap']['kelas_pv_luar'] = COUNT($this->Fo_model->get_all("kelas", "(tgl_mulai between '$tgl_awal' AND '$tgl_akhir') AND tipe_kelas = 'pv luar'"));
                $data['rekap']['kelas_reguler'] = COUNT($this->Fo_model->get_all("kelas", "(tgl_mulai between '$tgl_awal' AND '$tgl_akhir') AND tipe_kelas = 'reguler'"));

                // var_dump($data['rekap']);
                $this->load->view("laporan/peserta-keseluruhan", $data);
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
                    $peserta = $this->Laporan_model->get_peserta_by_tgl_masuk($tgl['tgl_masuk'], "reguler");
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
                    $peserta = $this->Laporan_model->get_peserta_by_tgl_masuk($tgl['tgl_masuk'], "pv khusus");
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
            } else if($laporan == "Peserta PV Luar"){
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
                    $peserta = $this->Laporan_model->get_peserta_by_tgl_masuk($tgl['tgl_masuk'], "pv luar");
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
            } else if($laporan == "Buku"){
                $tgl_awal = $this->input->post("tgl_awal");
                $tgl_akhir = $this->input->post("tgl_akhir");
                $data['title'] = "Laporan Buku " . date("d-M-Y", strtotime($tgl_awal)) . " - " . date("d-M-Y", strtotime($tgl_akhir));
                $name = date("d/m/y", strtotime($tgl_awal)) ." - ". date("d/m/y", strtotime($tgl_akhir));
                header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
                header('Content-Disposition: attachment;filename="Laporan Buku '.$name.'.xls"');
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
            } else if($laporan == "PPU"){
                $tgl_awal = $this->input->post("tgl_awal");
                $tgl_akhir = $this->input->post("tgl_akhir");
                
                $data['title'] = "Laporan Transaksi PPU " . date("d-m-y", strtotime($tgl_awal)) . " - " . date("d-m-y", strtotime($tgl_akhir));
                
                $name = "Transaksi PPU " . $tgl_awal . " - " . $tgl_akhir;
                header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
                header('Content-Disposition: attachment;filename="'.$name.'.xls"');
    
                $data['transaksi'] = [];
                $tgl = [];
                $i = 0;
                $cash = $this->Main_model->get_all("ppu_cash", "tgl between '$tgl_awal' AND '$tgl_akhir'");
                foreach ($cash as $cash) {
                    $tgl[] = $cash['tgl'];
                    $data['transaksi'][$i] = $cash;
                    $data['transaksi'][$i]['metode'] = "Cash";
                    $data['transaksi'][$i]['id'] = "PPU".$cash['id'];
                    $i++;
                }
                
                // $transfer = $this->Main_model->get_all("ppu_transfer", "tgl between '$tgl_awal' AND '$tgl_akhir'");
                // foreach ($transfer as $transfer) {
                //     $tgl[] = $transfer['tgl'];
                //     $data['transaksi'][$i] = $transfer;
                //     $data['transaksi'][$i]['metode'] = "Transfer";
                //     $data['transaksi'][$i]['id'] = substr($transfer['id'],0, 3)."/PPU-Im/".date('m', strtotime($transfer['tgl']))."/".date('Y', strtotime($transfer['tgl']));
                //     $i++;
                // }
                
                $data['tgl'] = array_unique($tgl);
                
                usort($data['tgl'], function($a, $b) {
                    return $a <=> $b;
                });
    
                usort($data['transaksi'], function($a, $b) {
                    return $a['tgl'] <=> $b['tgl'];
                });
    
                $this->load->view("ppu/laporan_ppu", $data);
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Password salah, gagal mencetak laporan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('laporan/');
        }
    }
}