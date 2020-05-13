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
            // return $a['tgl'] <=> $b['tgl'];
            if($a['tgl']==$b['tgl']) return 0;
            return $a['tgl'] < $b['tgl']?1:-1;
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
            // return $a['tgl'] <=> $b['tgl'];
            if($a['tgl']==$b['tgl']) return 0;
            return $a['tgl'] < $b['tgl']?1:-1;
        });
        
        // data modal
            $data['kpq'] = "-";
            $data['tipe'] = "kpq";
            $data['id'] = $nip;
        // data modal
        
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
            // return $a['tgl'] <=> $b['tgl'];
            if($a['tgl']==$b['tgl']) return 0;
            return $a['tgl'] < $b['tgl']?1:-1;
        });
        
        // data modal
            $peserta = $this->Fo_model->get_data_peserta_by_id($id_peserta);
            $kelas = $this->Fo_model->get_data_kelas_by_id($peserta['id_kelas']);
            if($kelas){
                $kpq = $this->Fo_model->get_kpq_by_id($kelas['nip']);
                $data['kpq'] = $kpq['nama_kpq'];
            } else {
                $data['kpq'] = "-";
            }
            $data['tipe'] = "peserta";
            $data['id'] = $id_peserta;
        // data modal
        
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

    // get data
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
    // get data

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

    // add
        public function add_transaksi_langsung(){
            $tipe = $this->input->post("tipe");
            $id = $this->input->post("id");
            $pengajar = $this->input->post("pengajar");
            $nama = $this->input->post("nama");
            $metode = $this->input->post("metode");

            if($metode == "Deposit"){
                $id_deposit = $this->Fo_model->get_last_id_deposit();
                $id_deposit = $id_deposit['id_deposit'] + 1;
                $data = [
                    "id_deposit" => $id_deposit,
                    "tgl_deposit" => $this->input->post("tgl"),
                    "nama_deposit" => $this->input->post("nama"),
                    "pengajar" => $this->input->post("pengajar"),
                    "uraian" => $this->input->post("uraian"),
                    "nominal" => $this->nominal($this->input->post("nominal")),
                    "keterangan" => $this->input->post("keterangan"),
                    "metode" => $this->input->post("metode")
                ]; 
                $this->Fo_model->add_deposit($data);
                // deposit sesuai tipe
                    if($tipe == 'kelas'){
                        $data = [
                            "id_deposit" => $id_deposit,
                            "id_kelas" => $this->input->post('id')
                        ];
                        $this->Fo_model->add_deposit_by_tipe("deposit_kelas", $data);
                    } else if($tipe == 'peserta'){
                        $data = [
                            "id_deposit" => $id_deposit,
                            "id_peserta" => $this->input->post('id')
                        ];
                        $this->Fo_model->add_deposit_by_tipe("deposit_peserta", $data);
                    } else if($tipe == 'kpq'){
                        $data = [
                            "id_deposit" => $id_deposit,
                            "nip" => $this->input->post('id')
                        ];
                        $this->Fo_model->add_deposit_by_tipe("deposit_kpq", $data);
                    }
                // deposit sesuai tipe
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil melakukan transaksi langsung dengan metode <b>deposit</b><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            } else if($metode == "Cash"){
                // saat pembayaran cash insert tagihan yang berstatus lunas dan pembayaran
                // tagihan
                    $id_tagihan = $this->Fo_model->get_last_id_tagihan();
                    $id_tagihan = $id_tagihan['id_tagihan'] + 1;

                    $data = [
                        "id_tagihan" => $id_tagihan,
                        "tgl_tagihan" => $this->input->post("tgl"),
                        "nama_tagihan" => $this->input->post("nama"),
                        "uraian" => $this->input->post("uraian"),
                        "nominal" => $this->nominal($this->input->post("nominal")),
                        "status" => "lunas"
                    ];

                    $this->Fo_model->add_tagihan($data);
                    
                    // tagihan sesuai tipe
                        if($tipe == "peserta"){
                            $data = [
                                "id_tagihan" => $id_tagihan,
                                "id_peserta" => $this->input->post("id", TRUE)
                            ];
                            $this->Fo_model->add_tagihan_by_tipe("tagihan_peserta", $data);
                        } else  if($tipe == "kelas"){
                            $data = [
                                "id_tagihan" => $id_tagihan,
                                "id_kelas" => $this->input->post("id", TRUE)
                            ];
                            $this->Fo_model->add_tagihan_by_tipe("tagihan_kelas", $data);
                        } else if($tipe == "kpq"){
                            $data = [
                                "id_tagihan" => $id_tagihan,
                                "nip" => $this->input->post("id", TRUE)
                            ];
                            $this->Fo_model->add_tagihan_by_tipe("tagihan_kpq", $data);
                        }
                    // tagihan sesuai tipe
                // tagihan
                // pembayaran
                    $id_pembayaran = $this->Fo_model->get_last_id_pembayaran();
                    $id_pembayaran = $id_pembayaran['id_pembayaran'] + 1;
                    $data = [
                        "id_pembayaran" => $id_pembayaran,
                        "nama_pembayaran" => $this->input->post("nama"),
                        "uraian" => $this->input->post('uraian', TRUE),
                        "nominal" => $this->nominal($this->input->post("nominal")),
                        "metode" => $metode,
                        "tgl_pembayaran" => $this->input->post("tgl"),
                        "keterangan" => $this->input->post("keterangan", TRUE),
                        "pengajar" => $this->input->post("pengajar", TRUE)
                    ];
                    $this->Fo_model->add_pembayaran($data);
                    // pembayaran sesuai tipe
                        if($tipe == "peserta"){
                            $data = [
                                "id_pembayaran" => $id_pembayaran,
                                "id_peserta" => $this->input->post("id", TRUE)
                            ];
                            $this->Fo_model->add_pembayaran_by_tipe("pembayaran_peserta", $data);
                        } else  if($tipe == "kelas"){
                            $data = [
                                "id_pembayaran" => $id_pembayaran,
                                "id_kelas" => $this->input->post("id", TRUE)
                            ];
                            $this->Fo_model->add_pembayaran_by_tipe("pembayaran_kelas", $data);
                        } else if($tipe == "kpq"){
                            $data = [
                                "id_pembayaran" => $id_pembayaran,
                                "nip" => $this->input->post("id", TRUE)
                            ];
                            $this->Fo_model->add_pembayaran_by_tipe("pembayaran_kpq", $data);
                        }
                    // pembayaran sesuai tipe
                // pembayaran
                
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil melakukan transaksi langsung dengan metode <b>cash</b><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            } else if($metode == "Transfer"){
                // saat pembayaran cash insert tagihan yang berstatus lunas dan transfer
                // tagihan
                    $id_tagihan = $this->Fo_model->get_last_id_tagihan();
                    $id_tagihan = $id_tagihan['id_tagihan'] + 1;

                    $data = [
                        "id_tagihan" => $id_tagihan,
                        "tgl_tagihan" => $this->input->post("tgl"),
                        "nama_tagihan" => $this->input->post("nama"),
                        "uraian" => $this->input->post("uraian"),
                        "nominal" => $this->nominal($this->input->post("nominal")),
                        "status" => "lunas"
                    ];

                    $this->Fo_model->add_tagihan($data);
                    
                    // tagihan sesuai tipe
                        if($tipe == "peserta"){
                            $data = [
                                "id_tagihan" => $id_tagihan,
                                "id_peserta" => $this->input->post("id", TRUE)
                            ];
                            $this->Fo_model->add_tagihan_by_tipe("tagihan_peserta", $data);
                        } else  if($tipe == "kelas"){
                            $data = [
                                "id_tagihan" => $id_tagihan,
                                "id_kelas" => $this->input->post("id", TRUE)
                            ];
                            $this->Fo_model->add_tagihan_by_tipe("tagihan_kelas", $data);
                        } else if($tipe == "kpq"){
                            $data = [
                                "id_tagihan" => $id_tagihan,
                                "nip" => $this->input->post("id", TRUE)
                            ];
                            $this->Fo_model->add_tagihan_by_tipe("tagihan_kpq", $data);
                        }
                    // tagihan sesuai tipe
                // tagihan
                // transfer
                    $id = $this->Fo_model->get_last_id_transfer();
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
                        "nama_transfer" => $this->input->post("nama"),
                        "pengajar" => $this->input->post("pengajar"),
                        "uraian" => $this->input->post("uraian"),
                        "nominal" => $this->nominal($this->input->post("nominal")),
                        "keterangan" => $this->input->post("keterangan"),
                        "metode" => $this->input->post("metode"),
                        "alamat" => ''
                    ];
                    $this->Fo_model->add_transfer($data);
                    // transfer sesuai tipe
                        if($tipe == "peserta"){
                            $data = [
                                "id_transfer" => $id_transfer,
                                "id_peserta" => $this->input->post("id", TRUE)
                            ];
                            $this->Fo_model->add_transfer_by_tipe("transfer_peserta", $data);
                        } else  if($tipe == "kelas"){
                            $data = [
                                "id_transfer" => $id_transfer,
                                "id_kelas" => $this->input->post("id", TRUE)
                            ];
                            $this->Fo_model->add_transfer_by_tipe("transfer_kelas", $data);
                        } else if($tipe == "kpq"){
                            $data = [
                                "id_transfer" => $id_transfer,
                                "nip" => $this->input->post("id", TRUE)
                            ];
                            $this->Fo_model->add_transfer_by_tipe("transfer_kpq", $data);
                        }
                    // transfer sesuai tipe
                // transfer
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil melakukan transaksi langsung dengan metode <b>transfer</b><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            }
            redirect($_SERVER['HTTP_REFERER']);
        }

        public function add_piutang(){
            $tipe = $this->input->post("tipe");

            // tagihan
                $id_tagihan = $this->Fo_model->get_last_id_tagihan();
                $id_tagihan = $id_tagihan['id_tagihan'] + 1;

                $data = [
                    "id_tagihan" => $id_tagihan,
                    "tgl_tagihan" => $this->input->post("tgl"),
                    "nama_tagihan" => $this->input->post("nama"),
                    "uraian" => $this->input->post("uraian"),
                    "nominal" => $this->nominal($this->input->post("nominal")),
                    "status" => "piutang"
                ];

                $this->Fo_model->add_tagihan($data);
                
                // tagihan sesuai tipe
                    if($tipe == "peserta"){
                        $data = [
                            "id_tagihan" => $id_tagihan,
                            "id_peserta" => $this->input->post("id", TRUE)
                        ];
                        $this->Fo_model->add_tagihan_by_tipe("tagihan_peserta", $data);
                    } else  if($tipe == "kelas"){
                        $data = [
                            "id_tagihan" => $id_tagihan,
                            "id_kelas" => $this->input->post("id", TRUE)
                        ];
                        $this->Fo_model->add_tagihan_by_tipe("tagihan_kelas", $data);
                    } else if($tipe == "kpq"){
                        $data = [
                            "id_tagihan" => $id_tagihan,
                            "nip" => $this->input->post("id", TRUE)
                        ];
                        $this->Fo_model->add_tagihan_by_tipe("tagihan_kpq", $data);
                    }
                // tagihan sesuai tipe
            // tagihan
            
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil menambahkan piutang<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect($_SERVER['HTTP_REFERER']);
        }

        public function add_pembayaran(){
            $tipe = $this->input->post("tipe");
            $id = $this->input->post("id");
            $pengajar = $this->input->post("pengajar");
            $nama = $this->input->post("nama");
            $metode = $this->input->post("metode");

            if($metode == "Cash"){
                // pembayaran
                    $id_pembayaran = $this->Fo_model->get_last_id_pembayaran();
                    $id_pembayaran = $id_pembayaran['id_pembayaran'] + 1;
                    $data = [
                        "id_pembayaran" => $id_pembayaran,
                        "nama_pembayaran" => $this->input->post("nama"),
                        "uraian" => $this->input->post('uraian', TRUE),
                        "nominal" => $this->nominal($this->input->post("nominal")),
                        "metode" => $metode,
                        "tgl_pembayaran" => $this->input->post("tgl"),
                        "keterangan" => $this->input->post("keterangan", TRUE),
                        "pengajar" => $this->input->post("pengajar", TRUE)
                    ];
                    $this->Fo_model->add_pembayaran($data);
                    // pembayaran sesuai tipe
                        if($tipe == "peserta"){
                            $data = [
                                "id_pembayaran" => $id_pembayaran,
                                "id_peserta" => $this->input->post("id", TRUE)
                            ];
                            $this->Fo_model->add_pembayaran_by_tipe("pembayaran_peserta", $data);
                        } else  if($tipe == "kelas"){
                            $data = [
                                "id_pembayaran" => $id_pembayaran,
                                "id_kelas" => $this->input->post("id", TRUE)
                            ];
                            $this->Fo_model->add_pembayaran_by_tipe("pembayaran_kelas", $data);
                        } else if($tipe == "kpq"){
                            $data = [
                                "id_pembayaran" => $id_pembayaran,
                                "nip" => $this->input->post("id", TRUE)
                            ];
                            $this->Fo_model->add_pembayaran_by_tipe("pembayaran_kpq", $data);
                        }
                    // pembayaran sesuai tipe
                // pembayaran
                
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil melakukan pembayaran dengan metode <b>cash</b><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            } else if($metode == "Transfer"){
                // transfer
                    $id = $this->Fo_model->get_last_id_transfer();
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
                        "nama_transfer" => $this->input->post("nama"),
                        "pengajar" => $this->input->post("pengajar"),
                        "uraian" => $this->input->post("uraian"),
                        "nominal" => $this->nominal($this->input->post("nominal")),
                        "keterangan" => $this->input->post("keterangan"),
                        "metode" => $this->input->post("metode"),
                        "alamat" => ''
                    ];
                    $this->Fo_model->add_transfer($data);
                    // transfer sesuai tipe
                        if($tipe == "peserta"){
                            $data = [
                                "id_transfer" => $id_transfer,
                                "id_peserta" => $this->input->post("id", TRUE)
                            ];
                            $this->Fo_model->add_transfer_by_tipe("transfer_peserta", $data);
                        } else  if($tipe == "kelas"){
                            $data = [
                                "id_transfer" => $id_transfer,
                                "id_kelas" => $this->input->post("id", TRUE)
                            ];
                            $this->Fo_model->add_transfer_by_tipe("transfer_kelas", $data);
                        } else if($tipe == "kpq"){
                            $data = [
                                "id_transfer" => $id_transfer,
                                "nip" => $this->input->post("id", TRUE)
                            ];
                            $this->Fo_model->add_transfer_by_tipe("transfer_kpq", $data);
                        }
                    // transfer sesuai tipe
                // transfer
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil melakukan pembayaran dengan metode <b>transfer</b><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            }
            redirect($_SERVER['HTTP_REFERER']);
        }
    // add

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
    
    public function deposit($id){
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P', 'margin_top' => '3', 'margin_left' => '3', 'margin_right' => '3', 'margin_bottom' => '3']);
        
        $kwitansi['kwitansi'] = $this->KartuPiutang_model->get_data_pembayaran_deposit($id);

        // var_dump($kwitansi);
		$data = $this->load->view('piutang/cetak_kwitansi', $kwitansi, TRUE);
        $mpdf->WriteHTML($data);
		$mpdf->Output();
    }

    // public function add_pembayaran(){
    //     $metode = $this->input->post("metode", TRUE);
    //     if($metode == "Cash"){
    //         $this->KartuPiutang_model->add_pembayaran();
    //     } else {
    //         $this->KartuPiutang_model->add_pembayaran_by_transfer();
    //     }

    //     $this->session->set_flashdata('piutang', 'ditambahkan');
    //     redirect($_SERVER['HTTP_REFERER']);
    // }
    
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

    // other function
        public function nominal($nominal){
            $nominal = $this->input->post('nominal', true);
            $nominal = str_replace("Rp. ", "", $nominal);
            $nominal = str_replace(".", "", $nominal);
            return $nominal;
        }
}