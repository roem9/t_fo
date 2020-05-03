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

        public function tambahPiutangPeserta(){
            $data['header'] = 'Tambah Piutang Peserta Reguler';
            $data['title'] = 'Tambah Piutang Peserta Reguler';
            $data['tabs'] = 'peserta';
            $data['pengajar'] = $this->Piutang_model->getPengajarReguler();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('piutang/form_piutang_peserta', $data);
            $this->load->view('templates/footer');
        }
        
        public function tambahPiutangKelas(){
            $data['header'] = 'Tambah Piutang Kelas Private';
            $data['title'] = 'Tambah Piutang Kelas Private';
            $data['tabs'] = 'kelas';
            $data['pengajar'] = $this->Piutang_model->getAllPengajar();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('piutang/form_piutang_kelas', $data);
            $this->load->view('templates/footer');
        }
        
        public function tambahPiutangKpq(){
            $data['header'] = 'Tambah Piutang KPQ';
            $data['title'] = 'Tambah Piutang KPQ';
            $data['tabs'] = 'kpq';
            $data['pengajar'] = $this->Piutang_model->getAllPengajar();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('piutang/form_piutang_kpq', $data);
            $this->load->view('templates/footer');
        }

        public function addPiutangKelas(){
            $id_kelas = $this->input->post('id_kelas', TRUE);
            $id = $this->Piutang_model->getIdTagihan();
            $nama = $this->Piutang_model->getNamaKoor($id_kelas);

            $id = $id['id_tagihan'];

            if($id == 0){
                $id_tagihan = 1;
            } else {
                $id_tagihan = $id+1;
            }

            $this->Piutang_model->tambahPiutangKelas($id_tagihan, $nama['nama_peserta']);
            
            $this->session->set_flashdata('piutang', 'ditambahkan');
            redirect($_SERVER['HTTP_REFERER']);
        }

        public function addPiutangPeserta(){
            $id_peserta = $this->input->post('id_peserta', TRUE);
            $id = $this->Piutang_model->getIdTagihan();
            $nama = $this->Piutang_model->getNamaPeserta($id_peserta);

            $id = $id['id_tagihan'];

            if($id == 0){
                $id_tagihan = 1;
            } else {
                $id_tagihan = $id+1;
            }

            $this->Piutang_model->tambahPiutangPeserta($id_tagihan, $nama['nama_peserta']);
            
            $this->session->set_flashdata('piutang', 'ditambahkan');
            redirect($_SERVER['HTTP_REFERER']);
        }

        public function addPiutangKpq(){
            $nip = $this->input->post("nip", TRUE);
            $id = $this->Piutang_model->getIdTagihan();
            $nama = $this->Piutang_model->getNamaPengajar($nip);

            $id = $id['id_tagihan'];

            if($id == 0){
                $id_tagihan = 1;
            } else {
                $id_tagihan = $id+1;
            }

            $this->Piutang_model->tambahPiutangKpq($id_tagihan, $nama['nama_kpq']);
            
            $this->session->set_flashdata('piutang', 'ditambahkan');
            redirect($_SERVER['HTTP_REFERER']);
        }

        public function hapusTagihan(){
            $id_tagihan = $this->input->post('id_tagihan');
            $this->Piutang_model->hapusTagihan($id_tagihan);
            $this->session->set_flashdata('piutang', 'dihapus');
            redirect($_SERVER['HTTP_REFERER']);
        }

        public function generatePiutang(){
            $bulan = ["1" => "Januari", "2" => "Februari", "3" => "Maret", "4" => "April", "5" => "Mei", "6" => "Juni", "7" => "Juli", "8" => "Agustus", "9" => "September", "10" => "Oktober", "11" => "November", "12" => "Desember"];

            $kelas = $this->Piutang_model->getAllKelasPvAktif();

            $data['kelas'] = [];
            foreach ($kelas as $key => $kelas) {
                $data['kelas'][$key] = $kelas;
                $jadwal = $this->Piutang_model->getJadwalAktif($kelas['id_kelas']);
                $nominal = 0;
                $data['kelas'][$key]['ot'] = 0;
                foreach ($jadwal as $i => $jadwal) {
                    if($jadwal['ot'] != 0){
                        $data['kelas'][$key]['ot']++; 
                    }
                }
                $data['kelas'][$key]['jadwal']= COUNT($this->Piutang_model->getJadwalAktif($kelas['id_kelas']));
                $ot = $this->Piutang_model->getInfaqByKet("ot");
                $data['kelas'][$key]['pembayaran']['ot'] = $data['kelas'][$key]['ot'] * $ot['infaq'];
                $biayajadwal = $this->Piutang_model->getInfaqByKet($kelas['ket']);
                $data['kelas'][$key]['pembayaran']['jadwal'] = $data['kelas'][$key]['jadwal'] * $biayajadwal['infaq']; 

                if ($data['kelas'][$key]['ot'] == 0){
                    $uraian = $bulan[date('n')] . " " . date('Y') . " " . $data['kelas'][$key]['jadwal'] . " jadwal";
                } else {
                    $uraian = $bulan[date('n')] . " " . date('Y') . " " . $data['kelas'][$key]['jadwal'] . " jadwal + " . $data['kelas'][$key]['ot'] . " OT";
                }

                // var_dump($data);
                $nominal = $data['kelas'][$key]['pembayaran']['jadwal'] + $data['kelas'][$key]['pembayaran']['ot'];

                // tentukan tagihannya
                $id = $this->Piutang_model->getLastIdTagihan();
                $id_tagihan = $id['id_tagihan'] + 1;

                $this->Piutang_model->insertPiutangKelas($id_tagihan, $kelas['id_kelas'], $kelas['nama_peserta'], $uraian, $nominal);
                
            }
            
            $reguler = $this->Piutang_model->getInfaqByKet("reguler");
            $peserta = $this->Piutang_model->getAllPesertaRegulerAktif();
            $uraian = $bulan[date('n')] . " " . date('Y');
            foreach ($peserta as $peserta) {
                $id = $this->Piutang_model->getLastIdTagihan();
                $id_tagihan = $id['id_tagihan'] + 1;
                $this->Piutang_model->insertPiutangPeserta($id_tagihan, $peserta['id_peserta'], $peserta['nama_peserta'], $uraian, $reguler['infaq']);
            }

            // ini_set("xdebug.var_display_max_children", -1);
            // ini_set("xdebug.var_display_max_data", -1);
            // ini_set("xdebug.var_display_max_depth", -1);
            
            // var_dump($data);
            
            $this->session->set_flashdata('piutang', 'digenerate');
            redirect('piutang/pvluar');
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

        // tampilkan peserta reguler sesuai pengajarnya dengan ajax
        public function getPesertaRegulerByPengajar(){
            $nip = $this->input->post('nip',TRUE);
            $data = $this->Piutang_model->getPesertaRegulerByPengajar($nip);
            echo json_encode($data);
        }

        // tampilkan koor kelas sesuai pengajarnya dengan ajax
        public function getKoorByPengajar(){
            $nip = $this->input->post('nip',TRUE);
            $data = $this->Piutang_model->getKoorByPengajar($nip);
            echo json_encode($data);
        }

        // tampilkan data tagihan kelas
        public function getTagihanKelas(){
            $id_kelas = $this->input->post('id_kelas',TRUE);
            $bulan = 12;
            $tahun = 2019;
            $tagihan = $this->Piutang_model->getTagihanKelas($id_kelas);
            $data['tagihan'] = [];
            foreach ($tagihan as $key => $tagihan) {
                $data['tagihan'][$key]['data'] = $tagihan;
                $bulan = date("m", strtotime($tagihan['tgl_tagihan']));
                $tahun = date("Y", strtotime($tagihan['tgl_tagihan']));
                $data['tagihan'][$key]['kbm'] = COUNT($this->Piutang_model->getTotalKbm($id_kelas, $bulan, $tahun));
            }
            echo json_encode($data);
        }
        
        // tampilkan data tagihan peserta
        public function getTagihanPeserta(){
            $id_peserta = $this->input->post('id_peserta',TRUE);
            $data = $this->Piutang_model->getTagihanPeserta($id_peserta);
            echo json_encode($data);
        }

        // tampilkan data tagihan kpq
        public function getTagihanKpq(){
            $nip = $this->input->post('nip',TRUE);
            $data = $this->Piutang_model->getTagihanKpq($nip);
            echo json_encode($data);
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