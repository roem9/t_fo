<?php
class KartuPiutang_model extends CI_MODEL{
    
    public function tambah_invoice(){
        // cek invoice terakhir bulan ini
        $bulan = date("m", strtotime($this->input->post("tgl")));
        $tahun = date("Y", strtotime($this->input->post("tgl")));

        $this->db->select("substr(id_invoice, 1, 3) as id");
        $this->db->from("invoice");
        $this->db->where("MONTH(tgl_invoice)", $bulan);
        $this->db->where("YEAR(tgl_invoice)", $tahun);
        $this->db->order_by("id", "DESC");
        $id = $this->db->get()->row_array();

        if($id){
            $id = $id['id'] + 1;
        } else {
            $id = 1;
        }

        if($id >= 1 && $id < 10){
            $id = "00".$id.date('my', strtotime($this->input->post("tgl")));
        } else if($id >= 10 && $id < 100){
            $id = "0".$id.date('my', strtotime($this->input->post("tgl")));
        } else if($id >= 100 && $id < 1000){
            $id = $id.date('my', strtotime($this->input->post("tgl")));
        }

        $data['invoice'] = [
            "id_invoice" => $id,
            "tgl_invoice" => $this->input->post("tgl"),
            "nama_invoice" => $this->input->post("nama")
        ];

        $this->db->insert("invoice", $data['invoice']);

        foreach ($_POST['uraian'] as $i => $detail) {
            $data['uraian'] = [
                "uraian" => $_POST['uraian'][$i],
                "nominal" => $_POST['nominal'][$i],
                "id_invoice" => $id
            ];
            
            $this->db->insert("invoice_uraian", $data['uraian']);
        }

        $tipe = $this->input->post('tipe');
        if($tipe == 'kelas'){
            
            $data = [
                "id_invoice" => $id,
                "id_kelas" => $this->input->post('id')
            ];

            $this->db->insert("invoice_kelas", $data);

        } else if($tipe == 'peserta'){
            
            $data = [
                "id_invoice" => $id,
                "id_peserta" => $this->input->post('id')
            ];

            $this->db->insert("invoice_peserta", $data);

        } else if($tipe == 'kpq'){
            
            $data = [
                "id_invoice" => $id,
                "nip" => $this->input->post('id')
            ];

            $this->db->insert("invoice_kpq", $data);
        }
    }
    
    public function dataKelasPrivat($id_kelas){
        $query = "a.id_kelas, a.status, a.program, nama_peserta, nama_kpq, pengajar, tipe_kelas";
        $this->db->select($query);
        $this->db->from("kelas as a");
        $this->db->join("kelas_koor as b", "a.id_kelas=b.id_kelas");
        $this->db->join("peserta as c", "b.id_peserta=c.id_peserta");
        $this->db->join("kpq as d", "d.nip=a.nip");
        $this->db->where("a.id_kelas", $id_kelas);
        return $this->db->get()->row_array();
    }
    
    public function dataPesertaById($id_kelas){
        $query = "nama_peserta";
        $this->db->select($query);
        $this->db->from("peserta");
        $this->db->where("id_kelas", $id_kelas);
        $this->db->where("status", "aktif");
        return $this->db->get()->result_array();
    }
    
    public function dataJadwalById($id_kelas){
        $query = "tempat, hari, jam, ot";
        $this->db->select($query);
        $this->db->from("jadwal");
        $this->db->where("id_kelas", $id_kelas);
        $this->db->where("status", 'aktif');
        return $this->db->get()->result_array();
    }
    
    public function getTagihanKelas($id_kelas){
        $this->db->from("tagihan as a");
        $this->db->join("tagihan_kelas as b", "a.id_tagihan=b.id_tagihan", "left");
        $this->db->join("kelas_koor as d", "b.id_kelas=d.id_kelas", "left");
        $this->db->join("peserta as e", "e.id_peserta=d.id_peserta", "left");
        $this->db->where("b.id_kelas", $id_kelas);
        // $this->db->order_by("tgl_tagihan", "DESC");
        return $this->db->get()->result_array();
    }

    public function get_pembayaran_kpq($nip){
        $this->db->from("pembayaran as a");
        $this->db->join("pembayaran_kpq as b", "a.id_pembayaran=b.id_pembayaran");
        $this->db->join("kpq as d", "d.nip = b.nip");
        $this->db->where("d.nip", $nip);
        $this->db->where("metode !=", "Deposit");
        return $this->db->get()->result_array();
    }

    public function getDataKpq($nip){
        $this->db->from("kpq");
        $this->db->where("nip", $nip);
        return $this->db->get()->row_array();
    }
    
    public function getTagihanPeserta($id_peserta){
        $this->db->from("tagihan as a");
        $this->db->join("tagihan_peserta as b", "a.id_tagihan=b.id_tagihan");
        $this->db->join("peserta as d", "d.id_peserta = b.id_peserta");
        $this->db->where("d.id_peserta", $id_peserta);
        return $this->db->get()->result_array();
    }
    
    public function get_deposit_peserta($id_peserta){
        $this->db->from("deposit as a");
        $this->db->join("deposit_peserta as b", "a.id_deposit=b.id_deposit");
        $this->db->join("peserta as d", "d.id_peserta = b.id_peserta");
        $this->db->where("d.id_peserta", $id_peserta);
        return $this->db->get()->result_array();
    }

    public function getPembayaranPeserta($id_peserta){
        $this->db->from("pembayaran as a");
        $this->db->join("pembayaran_peserta as b", "a.id_pembayaran=b.id_pembayaran");
        $this->db->join("peserta as d", "d.id_peserta = b.id_peserta");
        $this->db->where("d.id_peserta", $id_peserta);
        $this->db->where("metode !=", "Deposit");
        return $this->db->get()->result_array();
    }
    
    public function get_pembayaran_kelas($id_kelas){
        $this->db->from("pembayaran as a");
        $this->db->join("pembayaran_kelas as b", "a.id_pembayaran=b.id_pembayaran");
        $this->db->join("kelas as d", "d.id_kelas = b.id_kelas");
        $this->db->where("d.id_kelas", $id_kelas);
        $this->db->where("metode !=", "Deposit");
        return $this->db->get()->result_array();
    }

    public function getDataPeserta($id_peserta){
        $this->db->select("a.id_peserta, a.status, tipe_peserta, b.program, nama_kpq, c.tempat, c.hari, c.jam, nama_peserta");
        $this->db->from("peserta as a");
        $this->db->join("kelas as b", "a.id_kelas = b.id_kelas", 'left');
        $this->db->join("jadwal as c", "b.id_kelas = c.id_kelas", 'left');
        $this->db->join("kpq as d", "b.nip = d.nip", 'left');
        $this->db->where("a.id_peserta", $id_peserta);
        return $this->db->get()->row_array();
    }

    public function idTagihanTerakhir(){
        $this->db->from("tagihan");
        $this->db->order_by("id_tagihan", "desc");
        return $this->db->get()->row_array();
    }

    public function get_last_id_pembayaran(){
        $this->db->from("pembayaran");
        $this->db->order_by("id_pembayaran", "DESC");
        return $this->db->get()->row_array();
    }

    public function tambahPiutang($id){
        $nominal = $this->input->post('nominal', true);
        $nominal = str_replace("Rp. ", "", $nominal);
        $nominal = str_replace(".", "", $nominal);

        $data["tagihan"] = [
            "id_tagihan" => $id, 
            "tgl_tagihan" => $this->input->post("tgl", TRUE),
            "nama_tagihan" => $this->input->post("nama", TRUE),
            "uraian" => $this->input->post("uraian", TRUE),
            "nominal" => $nominal,
            "status" => "piutang",
            "ket" => $this->input->post("ket", TRUE)
        ];

        $this->db->insert("tagihan", $data["tagihan"]);

        $tipe = $this->input->post("tipe");

        $this->jenis_tagihan($id, $tipe);
    }

    public function add_deposit($id){
        $nominal = $this->input->post('nominal', true);
        $nominal = str_replace("Rp. ", "", $nominal);
        $nominal = str_replace(".", "", $nominal);
        
        $data = [
            "id_pembayaran" => $id,
            "tgl_pembayaran" => $this->input->post("tgl"),
            "nama_pembayaran" => $this->input->post("nama", TRUE),
            "uraian" => $this->input->post("uraian", TRUE),
            "nominal" => $nominal,
            "metode" => $this->input->post("metode"),
            "keterangan" => $this->input->post("keterangan"),
            "pengajar" => $this->input->post("pengajar")
        ];

        $this->db->insert("pembayaran", $data);

        $tipe = $this->input->post("tipe");
        $this->jenis_pembayaran($id, $tipe);
    }

    public function add_uraian(){
        $data = [
            "uraian" => $this->input->post("uraian"),
            "nominal" => $this->input->post("nominal"),
            "id_invoice" => $this->input->post("id")
        ];

        $this->db->insert("invoice_uraian", $data);
    }

    public function jenis_tagihan($id, $tipe){
        if($tipe == "peserta"){
            $piutang = [
                "id_tagihan" => $id,
                "id_peserta" => $this->input->post("id", TRUE)
            ];

            $this->db->insert("tagihan_peserta", $piutang);
        } else  if($tipe == "kelas"){
            $piutang = [
                "id_tagihan" => $id,
                "id_kelas" => $this->input->post("id", TRUE)
            ];

            $this->db->insert("tagihan_kelas", $piutang);
        } else if($tipe == "kpq"){
            $piutang = [
                "id_tagihan" => $id,
                "nip" => $this->input->post("id", TRUE)
            ];

            $this->db->insert("tagihan_kpq", $piutang);
        }
    }

    public function add_pembayaran(){
        // id terakhir
        $this->db->select("id_pembayaran");
        $this->db->from("pembayaran");
        $this->db->order_by("id_pembayaran", "DESC");
        $id_bayar = $this->db->get()->row_array();
        $id_bayar = $id_bayar['id_pembayaran'] + 1;
        
        $nominal = $this->input->post('nominal', true);
        $nominal = str_replace("Rp. ", "", $nominal);
        $nominal = str_replace(".", "", $nominal);

        $bayar = [
            "id_pembayaran" => $id_bayar,
            "nama_pembayaran" => $this->input->post("nama"),
            "uraian" => $this->input->post('uraian', TRUE),
            "nominal" => $nominal,
            "metode" => $this->input->post("metode"),
            "tgl_pembayaran" => $this->input->post("tgl"),
            "keterangan" => $this->input->post("keterangan", TRUE),
            "pengajar" => $this->input->post("pengajar", TRUE)
        ];

        $this->db->insert("pembayaran", $bayar);
        
        $tipe = $this->input->post("tipe", TRUE);

        $this->jenis_pembayaran($id_bayar, $tipe);;
    }
    
    public function add_pembayaran_by_transfer(){
        // cek invoice terakhir bulan ini
        $nominal = $this->input->post('nominal', true);
        $nominal = str_replace("Rp. ", "", $nominal);
        $nominal = str_replace(".", "", $nominal);

        $bulan = date("m", strtotime($this->input->post("tgl")));
        $tahun = date("Y", strtotime($this->input->post("tgl")));

        $this->db->select("substr(id_transfer, 1, 3) as id");
        $this->db->from("transfer");
        $this->db->where("MONTH(tgl_transfer)", $bulan);
        $this->db->where("YEAR(tgl_transfer)", $tahun);
        $this->db->order_by("id", "DESC");
        $id = $this->db->get()->row_array();

        if($id){
            $id = $id['id'] + 1;
        } else {
            $id = 1;
        }

        if($id >= 1 && $id < 10){
            $id = "00".$id.date('my', strtotime($this->input->post("tgl")));
        } else if($id >= 10 && $id < 100){
            $id = "0".$id.date('my', strtotime($this->input->post("tgl")));
        } else if($id >= 100 && $id < 1000){
            $id = $id.date('my', strtotime($this->input->post("tgl")));
        }

        $data['transfer'] = [
            "id_transfer" => $id,
            "tgl_transfer" => $this->input->post("tgl"),
            "nama_transfer" => $this->input->post("nama"),
            "pengajar" => $this->input->post("pengajar"),
            "uraian" => $this->input->post("uraian"),
            "nominal" => $nominal,
            "keterangan" => $this->input->post("keterangan"),
            "metode" => $this->input->post("metode"),
            "alamat" => ""
        ];

        $this->db->insert("transfer", $data['transfer']);

        $tipe = $this->input->post('tipe');
        if($tipe == 'kelas'){
            
            $data = [
                "id_transfer" => $id,
                "id_kelas" => $this->input->post('id')
            ];

            $this->db->insert("transfer_kelas", $data);

        } else if($tipe == 'peserta'){
            
            $data = [
                "id_transfer" => $id,
                "id_peserta" => $this->input->post('id')
            ];

            $this->db->insert("transfer_peserta", $data);

        } else if($tipe == 'kpq'){
            
            $data = [
                "id_transfer" => $id,
                "nip" => $this->input->post('id')
            ];

            $this->db->insert("transfer_kpq", $data);
        }
    }

    public function jenis_pembayaran($id, $tipe){
        if($tipe == "peserta"){
            $piutang = [
                "id_pembayaran" => $id,
                "id_peserta" => $this->input->post("id", TRUE)
            ];

            $this->db->insert("pembayaran_peserta", $piutang);
        } else  if($tipe == "kelas"){
            $piutang = [
                "id_pembayaran" => $id,
                "id_kelas" => $this->input->post("id", TRUE)
            ];

            $this->db->insert("pembayaran_kelas", $piutang);
        } else if($tipe == "kpq"){
            $piutang = [
                "id_pembayaran" => $id,
                "nip" => $this->input->post("id", TRUE)
            ];

            // var_dump($piutang);
            $this->db->insert("pembayaran_kpq", $piutang);
        }
    }

    public function edit_transaksi(){
        $id = $this->input->post("id");
        $transaksi = $this->input->post("transaksi");

        if($transaksi == "tagihan"){
            
            $data = [
                "nama_tagihan" => $this->input->post("nama"),
                "tgl_tagihan" => $this->input->post("tgl"),
                "uraian" => $this->input->post("uraian"),
                "nominal" => $this->input->post("nominal")
            ];

            $this->db->where("id_tagihan", $id);
            $this->db->update("tagihan", $data);

        } else if($transaksi == "pembayaran"){
            
            $data = [
                "nama_pembayaran" => $this->input->post("nama"),
                "tgl_pembayaran" => $this->input->post("tgl"),
                "uraian" => $this->input->post("uraian"),
                "nominal" => $this->input->post("nominal")
            ];

            $this->db->where("id_pembayaran", $id);
            $this->db->update("pembayaran", $data);

        } else if($transaksi == "invoice"){
            
            $data = [
                "nama_invoice" => $this->input->post("nama"),
                "tgl_invoice" => $this->input->post("tgl"),
                "uraian" => $this->input->post("uraian"),
                "nominal" => $this->input->post("nominal")
            ];

            $this->db->where("id_invoice", $id);
            $this->db->update("invoice", $data);

        }
    }

    public function edit_pembayaran_cash(){
        $data = [
            "nama_pembayaran" => $this->input->post("nama", TRUE),
            "tgl_pembayaran" => $this->input->post("tgl"),
            "uraian" => $this->input->post("uraian"),
            "nominal" => $this->input->post("nominal")
        ];

        $this->db->where("id_pembayaran", $this->input->post("id"));
        $this->db->update("pembayaran", $data);
    }

    public function edit_invoice(){
        $id = $this->input->post("id");

        $data = [
            "nama_invoice" => $this->input->post("nama"),
            "tgl_invoice" => $this->input->post("tgl")
        ];

        $this->db->where("id_invoice", $id);
        $this->db->update("invoice", $data);
    }

    public function edit_tagihan(){
        $data = [
            "nama_tagihan" => $this->input->post("nama", TRUE),
            "tgl_tagihan" => $this->input->post("tgl"),
            "uraian" => $this->input->post("uraian"),
            "nominal" => $this->input->post("nominal")
        ];

        $this->db->where("id_tagihan", $this->input->post("id"));
        $this->db->update("tagihan", $data);
    }

    public function edit_uraian(){
        foreach ($_POST['uraian'] as $i => $uraian) {
            $data = [
                "uraian" => $_POST['uraian'][$i],
                "nominal" => $_POST['nominal'][$i]
            ];
            
            $this->db->where("id_uraian", $_POST['id_uraian'][$i]);
            $this->db->update("invoice_uraian", $data);
        }
    }
    
    public function edit_deposit(){
        $data = [
            "nama_deposit" => $this->input->post("nama", TRUE),
            "tgl_deposit" => $this->input->post("tgl"),
            "uraian" => $this->input->post("uraian"),
            "nominal" => $this->input->post("nominal")
        ];

        $this->db->where("id_deposit", $this->input->post("id"));
        $this->db->update("deposit", $data);
    }

    public function get_data_tagihan(){
        $id = $this->input->post("id");
        $this->db->from("tagihan");
        $this->db->where("id_tagihan", $id);
        return $this->db->get()->row_array();
    }
    
    public function get_data_tagihan_kelas(){
        $id = $this->input->post("id");
        $this->db->from("tagihan as a");
        $this->db->join("tagihan_kelas as b", "a.id_tagihan = b.id_tagihan", "left");
        $this->db->where("a.id_tagihan", $id);
        return $this->db->get()->row_array();
    }

    // public function get_data_pembayaran($id){
    //     $this->db->from("pembayaran");
    //     $this->db->where("id_pembayaran", $id);
    //     return $this->db->get()->row_array();
    // }
    
    public function get_data_pembayaran_deposit($id){
        $this->db->from("tagihan");
        $this->db->where("id_tagihan", $id);
        return $this->db->get()->row_array();
    }

    public function get_data_kbm($id){
        $kbm = [];

        $this->db->select("YEAR(tgl) as tahun");
        $this->db->from("kbm");
        $this->db->where("id_kelas", $id);
        $this->db->where("tgl !=", "0000-00-00");
        $this->db->group_by("tahun");
        $tahun = $this->db->get()->result_array();
        $i = 0;

        foreach ($tahun as $tahun) {
            $this->db->select("MONTH(tgl) as bulan");
            $this->db->from("kbm");
            $this->db->where("YEAR(tgl)", $tahun['tahun']);
            $this->db->where("id_kelas", $id);
            $this->db->group_by("bulan");
            $bulan = $this->db->get()->result_array();
            $j = 0;
            foreach ($bulan as $bulan) {
                $kbm['kbm'][$i]['tahun'] = $tahun['tahun'];
                $kbm['kbm'][$i]['bulan'] = $bulan['bulan'];
                // $kbm[$i]['bulan'][$j] = $bulan['bulan'];
                $this->db->select("COUNT(id_kbm) AS kbm");
                $this->db->from("kbm");
                $this->db->where("MONTH(tgl)", $bulan['bulan']);
                $this->db->where("YEAR(tgl)", $tahun['tahun']);
                $this->db->where("id_kelas", $id);
                $total = $this->db->get()->row_array();
                $kbm['kbm'][$i]['kbm'] = $total['kbm'];
                // var_dump($bulan);
                // $j++;
                $i++;
            }
        }
        // ini_set("xdebug.var_display_max_children", -1);
        // ini_set("xdebug.var_display_max_data", -1);
        // ini_set("xdebug.var_display_max_depth", -1);

        // var_dump($kbm);
        return $kbm;
    }
    public function get_invoice_kelas($id){
        $this->db->from("invoice as a");
        $this->db->join("invoice_kelas as b", "a.id_invoice = b.id_invoice", "left");
        $this->db->where("b.id_kelas", $id);
        $this->db->order_by("tgl_invoice", "desc");
        return $this->db->get()->result_array();
    }

    public function get_data_uraian_invoice($id){
        $this->db->from("invoice_uraian");
        $this->db->where("id_invoice", $id);
        return $this->db->get()->result_array();
    }

    public function get_data_invoice_kelas($id){
        $this->db->from("invoice as a");
        $this->db->join("invoice_kelas as b", "a.id_invoice = b.id_invoice", "left");
        $this->db->where("b.id_invoice", $id);
        return $this->db->get()->row_array();
    }
    
    public function get_data_invoice($id){
        $this->db->from("invoice");
        $this->db->where("id_invoice", $id);
        return $this->db->get()->row_array();
    }

    public function delete_uraian(){
        foreach ($_POST['uraian'] as $id) {
            $this->db->where("id_uraian", $id);
            $this->db->delete("invoice_uraian");
        }
    }

    // get data 
            
        public function get_tagihan_kelas($id_kelas){
            $this->db->select("*, a.status AS stat");
            $this->db->from("tagihan as a");
            $this->db->join("tagihan_kelas as b", "a.id_tagihan=b.id_tagihan");
            $this->db->join("kelas as d", "d.id_kelas = b.id_kelas");
            $this->db->where("d.id_kelas", $id_kelas);
            return $this->db->get()->result_array();
        }
        
        public function get_deposit_kelas($id_kelas){
            $this->db->from("deposit as a");
            $this->db->join("deposit_kelas as b", "a.id_deposit=b.id_deposit");
            $this->db->join("kelas as d", "d.id_kelas = b.id_kelas");
            $this->db->where("d.id_kelas", $id_kelas);
            return $this->db->get()->result_array();
        }
        
        public function get_pembayaran_kelas_cash($id_kelas){
            $this->db->from("pembayaran as a");
            $this->db->join("pembayaran_kelas as b", "a.id_pembayaran=b.id_pembayaran");
            $this->db->join("kelas as d", "d.id_kelas = b.id_kelas");
            $this->db->where("d.id_kelas", $id_kelas);
            $this->db->where("metode !=", "Deposit");
            return $this->db->get()->result_array();
        }

            
        public function get_pembayaran_kelas_transfer($id_kelas){
            $this->db->from("transfer as a");
            $this->db->join("transfer_kelas as b", "a.id_transfer=b.id_transfer");
            $this->db->join("kelas as d", "d.id_kelas = b.id_kelas");
            $this->db->where("d.id_kelas", $id_kelas);
            $this->db->where("metode !=", "Deposit");
            return $this->db->get()->result_array();
        }

        
        public function get_tagihan_peserta($id_peserta){
            $this->db->select("*, a.status AS stat");
            $this->db->from("tagihan as a");
            $this->db->join("tagihan_peserta as b", "a.id_tagihan=b.id_tagihan");
            $this->db->join("peserta as d", "d.id_peserta = b.id_peserta");
            $this->db->where("d.id_peserta", $id_peserta);
            return $this->db->get()->result_array();
        }
        
        public function get_pembayaran_peserta_cash($id_peserta){
            $this->db->from("pembayaran as a");
            $this->db->join("pembayaran_peserta as b", "a.id_pembayaran=b.id_pembayaran");
            $this->db->join("peserta as d", "d.id_peserta = b.id_peserta");
            $this->db->where("d.id_peserta", $id_peserta);
            $this->db->where("metode !=", "Deposit");
            return $this->db->get()->result_array();
        }

            
        public function get_pembayaran_peserta_transfer($id_peserta){
            $this->db->from("transfer as a");
            $this->db->join("transfer_peserta as b", "a.id_transfer=b.id_transfer");
            $this->db->join("peserta as d", "d.id_peserta = b.id_peserta");
            $this->db->where("d.id_peserta", $id_peserta);
            $this->db->where("metode !=", "Deposit");
            return $this->db->get()->result_array();
        }
        
        public function get_invoice_peserta($id){
            $this->db->from("invoice as a");
            $this->db->join("invoice_peserta as b", "a.id_invoice = b.id_invoice", "left");
            $this->db->where("b.id_peserta", $id);
            $this->db->order_by("tgl_invoice", "desc");
            return $this->db->get()->result_array();
        }
        
        
        public function get_tagihan_kpq($nip){
            $this->db->select("*, a.status AS stat");
            $this->db->from("tagihan as a");
            $this->db->join("tagihan_kpq as b", "a.id_tagihan=b.id_tagihan");
            $this->db->join("kpq as d", "d.nip = b.nip");
            $this->db->where("d.nip", $nip);
            return $this->db->get()->result_array();
        }
        
        public function get_deposit_kpq($nip){
            $this->db->from("deposit as a");
            $this->db->join("deposit_kpq as b", "a.id_deposit=b.id_deposit");
            $this->db->join("kpq as d", "d.nip = b.nip");
            $this->db->where("d.nip", $nip);
            return $this->db->get()->result_array();
        }
        
        public function get_pembayaran_kpq_cash($nip){
            $this->db->from("pembayaran as a");
            $this->db->join("pembayaran_kpq as b", "a.id_pembayaran=b.id_pembayaran");
            $this->db->join("kpq as d", "d.nip = b.nip");
            $this->db->where("d.nip", $nip);
            $this->db->where("metode !=", "Deposit");
            return $this->db->get()->result_array();
        }

            
        public function get_pembayaran_kpq_transfer($nip){
            $this->db->from("transfer as a");
            $this->db->join("transfer_kpq as b", "a.id_transfer=b.id_transfer");
            $this->db->join("kpq as d", "d.nip = b.nip");
            $this->db->where("d.nip", $nip);
            $this->db->where("metode !=", "Deposit");
            return $this->db->get()->result_array();
        }
        
        public function get_invoice_kpq($id){
            $this->db->from("invoice as a");
            $this->db->join("invoice_kpq as b", "a.id_invoice = b.id_invoice", "left");
            $this->db->where("b.nip", $id);
            $this->db->order_by("tgl_invoice", "desc");
            return $this->db->get()->result_array();
        }
    
        public function get_data_deposit($id){
            $this->db->from("deposit");
            $this->db->where("id_deposit", $id);
            return $this->db->get()->row_array();
        }
    // get data
}