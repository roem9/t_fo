<?php

class Piutang_model extends CI_MODEL{
    
    public function get_peserta_reguler(){
        $this->db->from("peserta_reguler");
        return $this->db->get()->result_array();
    }
    
    public function get_kelas_pv_luar(){
        $this->db->from("kelas_pv_luar");
        return $this->db->get()->result_array();
    }

    public function get_kelas_pv_khusus(){
        $this->db->from("kelas_pv_khusus");
        return $this->db->get()->result_array();
    }

    public function getDataPeserta(){
        $this->db->select("a.id_peserta, a.status, nama_peserta, b.program, c.hari, c.jam, nama_kpq");
        $this->db->from("peserta as a");
        $this->db->join("kelas as b", "a.id_kelas=b.id_kelas", "left");
        $this->db->join("jadwal as c", "b.id_kelas=c.id_kelas", "left");
        $this->db->join("kpq as d", "b.nip=d.nip", "left");
        $this->db->where("tipe_peserta", "reguler");
        return $this->db->get()->result_array();
    }

    public function getPiutangPeserta($id_peserta){
        $this->db->select('SUM(nominal) AS piutang, COUNT(b.id_tagihan) AS tagihan');
        $this->db->from('tagihan as a');
        $this->db->join('tagihan_peserta as b', 'a.id_tagihan = b.id_tagihan', 'left');
        $this->db->where("id_peserta", $id_peserta);
        $this->db->where("status", "piutang");
        return $this->db->get()->row_array();
    }
    
    public function get_piutang_peserta($id_peserta){
        $this->db->select('SUM(nominal) AS piutang');
        $this->db->from('tagihan as a');
        $this->db->join('tagihan_peserta as b', 'a.id_tagihan = b.id_tagihan', 'left');
        $this->db->where("id_peserta", $id_peserta);
        return $this->db->get()->row_array();
    }

    public function get_deposit_peserta($id){
        $this->db->select('SUM(nominal) AS deposit');
        $this->db->from('pembayaran as a');
        $this->db->join('pembayaran_peserta as b', 'a.id_pembayaran = b.id_pembayaran', 'left');
        $this->db->where("id_peserta", $id);
        $this->db->where("metode", "Deposit");
        return $this->db->get()->row_array();
    }

    public function get_pembayaran_peserta($id_peserta){
        $this->db->select('SUM(nominal) AS bayar');
        $this->db->from('pembayaran as a');
        $this->db->join('pembayaran_peserta as b', 'a.id_pembayaran = b.id_pembayaran', 'left');
        $this->db->where("id_peserta", $id_peserta);
        $this->db->where("metode !=", "Deposit");
        return $this->db->get()->row_array();
    }

    public function getDataKelas($tipe){
        $ket = ['pv instansi'];
        $this->db->select('a.id_kelas, a.status, nama_peserta, tgl_mulai, c.no_hp, tipe_kelas, nama_kpq');
        $this->db->from('kelas as a');
        $this->db->join('kelas_koor as b', 'a.id_kelas = b.id_kelas');
        $this->db->join('peserta as c', 'b.id_peserta = c.id_peserta');
        $this->db->join('kpq as d', 'a.nip = d.nip');
        $this->db->where('a.tipe_kelas', $tipe);
        $this->db->where_not_in('ket', $ket);
        $this->db->group_by('a.id_kelas');
        return $this->db->get()->result_array();
    }

    public function get_data_kelas_pv_luar(){
        $this->db->select('a.id_kelas, a.status, nama_peserta, tgl_mulai, c.no_hp, tipe_kelas, nama_kpq');
        $this->db->from('kelas as a');
        $this->db->join('kelas_koor as b', 'a.id_kelas = b.id_kelas');
        $this->db->join('peserta as c', 'b.id_peserta = c.id_peserta');
        $this->db->join('kpq as d', 'a.nip = d.nip');
        $this->db->where('a.tipe_kelas <>', 'pv khusus');
        $this->db->group_by('a.id_kelas');
        return $this->db->get()->result_array();
    }

    public function getDataKelasByKet($tipe){
        $this->db->select('a.id_kelas, a.status, nama_peserta, tgl_mulai, c.no_hp, tipe_kelas, nama_kpq, SUM(nominal) AS piutang, COUNT(e.id_tagihan) AS tagihan');
        $this->db->from('kelas as a');
        $this->db->join('kelas_koor as b', 'a.id_kelas = b.id_kelas');
        $this->db->join('peserta as c', 'b.id_peserta = c.id_peserta');
        $this->db->join('kpq as d', 'a.nip = d.nip');
        $this->db->join('tagihan_kelas as e', 'a.id_kelas = e.id_kelas', "left");
        $this->db->join('tagihan as f', 'f.id_tagihan = e.id_tagihan', "left");
        $this->db->where('a.ket', $tipe);
        $this->db->group_by('a.id_kelas');
        $this->db->order_by("piutang", "DESC");
        return $this->db->get()->result_array();
    }

    public function get_piutang_kelas($id){
        $this->db->select('SUM(nominal) AS piutang');
        $this->db->from('tagihan as a');
        $this->db->join('tagihan_kelas as b', 'a.id_tagihan = b.id_tagihan', 'left');
        $this->db->where("id_kelas", $id);
        return $this->db->get()->row_array();
    }

    public function get_tagihan_kelas($id){
        $this->db->select('COUNT(b.id_tagihan) AS tagihan');
        $this->db->from('tagihan as a');
        $this->db->join('tagihan_kelas as b', 'a.id_tagihan = b.id_tagihan', 'left');
        $this->db->where("id_kelas", $id);
        $this->db->where("status", "piutang");
        return $this->db->get()->row_array();
    }

    public function get_pembayaran_kelas($id){
        $this->db->select('SUM(nominal) AS bayar');
        $this->db->from('pembayaran as a');
        $this->db->join('pembayaran_kelas as b', 'a.id_pembayaran = b.id_pembayaran', 'left');
        $this->db->where("id_kelas", $id);
        $this->db->where("metode !=", "Deposit");
        return $this->db->get()->row_array();
    }
    
    public function get_deposit_kelas($id){
        $this->db->select('SUM(nominal) AS deposit');
        $this->db->from('pembayaran as a');
        $this->db->join('pembayaran_kelas as b', 'a.id_pembayaran = b.id_pembayaran', 'left');
        $this->db->where("id_kelas", $id);
        $this->db->where("metode", "Deposit");
        return $this->db->get()->row_array();
    }
    
    public function get_piutang_kpq($id){
        $this->db->select('SUM(nominal) AS piutang');
        $this->db->from('tagihan as a');
        $this->db->join('tagihan_kpq as b', 'a.id_tagihan = b.id_tagihan', 'left');
        $this->db->where("nip", $id);
        return $this->db->get()->row_array();
    }

    public function get_tagihan_kpq($id){
        $this->db->select('COUNT(b.id_tagihan) AS tagihan');
        $this->db->from('tagihan as a');
        $this->db->join('tagihan_kpq as b', 'a.id_tagihan = b.id_tagihan', 'left');
        $this->db->where("nip", $id);
        $this->db->where("status", "piutang");
        return $this->db->get()->row_array();
    }

    public function get_deposit_kpq($id){
        $this->db->select('SUM(nominal) AS deposit');
        $this->db->from('pembayaran as a');
        $this->db->join('pembayaran_kpq as b', 'a.id_pembayaran = b.id_pembayaran', 'left');
        $this->db->where("nip", $id);
        $this->db->where("metode", "Deposit");
        return $this->db->get()->row_array();
    }

    public function get_pembayaran_kpq($id){
        $this->db->select('SUM(nominal) AS bayar');
        $this->db->from('pembayaran as a');
        $this->db->join('pembayaran_kpq as b', 'a.id_pembayaran = b.id_pembayaran', 'left');
        $this->db->where("nip", $id);
        $this->db->where("metode !=", "Deposit");
        return $this->db->get()->row_array();
    }

    public function getPiutangKelas($id_kelas){
        $this->db->select('SUM(nominal) AS piutang, COUNT(b.id_tagihan) AS tagihan');
        $this->db->from('tagihan as a');
        $this->db->join('tagihan_kelas as b', 'a.id_tagihan = b.id_tagihan', 'left');
        $this->db->where("id_kelas", $id_kelas);
        $this->db->where("status", "piutang");
        return $this->db->get()->row_array();
    }

    
    public function getDataKpq(){
        $this->db->from("kpq");
        $this->db->where("status !=", 'hapus');
        $this->db->order_by("nama_kpq");
        return $this->db->get()->result_array();
    }

    public function getPiutangKpq($nip){
        $this->db->select('SUM(nominal) AS piutang, COUNT(b.id_tagihan) AS tagihan');
        $this->db->from('tagihan_kpq as a');
        $this->db->join('tagihan as b', 'a.id_tagihan = b.id_tagihan', 'left');
        $this->db->where("nip", $nip);
        $this->db->order_by("piutang", "DESC");
        return $this->db->get()->row_array();
    }

    public function getPengajarReguler(){
        $this->db->select('a.nip, nama_kpq');
        $this->db->from('kpq as a');
        $this->db->join('kelas as b', 'a.nip = b.nip');
        $this->db->where('tipe_kelas', 'reguler');
        $this->db->group_by('nip');
        $this->db->order_by('nama_kpq', 'asc');
        return $this->db->get()->result_array();
    }
    
    public function getAllPengajar(){
        $this->db->select('a.nip, nama_kpq');
        $this->db->from('kpq as a');
        $this->db->order_by('nama_kpq', 'asc');
        return $this->db->get()->result_array();
    }

    public function getPesertaRegulerByPengajar($nip){
        $this->db->select('a.id_peserta, nama_peserta');
        $this->db->from('peserta as a');
        $this->db->join('kelas as b', 'a.id_kelas = b.id_kelas');
        $this->db->where('tipe_kelas', 'reguler');
        $this->db->where('nip', $nip);
        $this->db->order_by('nama_peserta', 'asc');
        return $this->db->get()->result_array();
    }
    
    public function getKoorByPengajar($nip){
        $this->db->select('a.id_kelas, nama_peserta');
        $this->db->from('peserta as a');
        $this->db->join('kelas as b', 'a.id_kelas = b.id_kelas');
        $this->db->join('kelas_koor as c', 'a.id_peserta = c.id_peserta');
        $this->db->where('nip', $nip);
        $this->db->order_by('nama_peserta', 'asc');
        return $this->db->get()->result_array();
    }

    public function getNamaKoor($id_kelas){
        $this->db->select('nama_peserta');
        $this->db->from('peserta as a');
        $this->db->join('kelas_koor as c', 'a.id_peserta = c.id_peserta');
        $this->db->where('a.id_kelas', $id_kelas);
        return $this->db->get()->row_array();
    }

    public function getIdTagihan(){
        $this->db->select('*');
        $this->db->from('tagihan');
        $this->db->order_by('id_tagihan', 'desc');
        return $this->db->get()->row_array();
    }

    public function getNamaPeserta($id_peserta){
        $this->db->from('peserta');
        $this->db->where("id_peserta", $id_peserta);
        return $this->db->get()->row_array();
    }
    
    public function getNamaPengajar($nip){
        $this->db->from("kpq");
        $this->db->where("nip", $nip);
        return $this->db->get()->row_array();
    }

    public function getTagihanKelas($id_kelas){
        $this->db->from("tagihan as a");
        $this->db->join("tagihan_kelas as b", "a.id_tagihan=b.id_tagihan");
        $this->db->join("kelas_koor as d", "b.id_kelas=d.id_kelas");
        $this->db->join("peserta as e", "e.id_peserta=d.id_peserta");
        $this->db->where("b.id_kelas", $id_kelas);
        $this->db->where("a.status", "piutang");
        return $this->db->get()->result_array();
    }

    public function getTotalKbm($id_kelas, $bulan, $tahun){
        $this->db->select("id_kbm");
        $this->db->from("kbm");
        $this->db->where("MONTH(tgl)", $bulan);
        $this->db->where("YEAR(tgl)", $tahun);
        $this->db->where("id_kelas", $id_kelas);
        return $this->db->get()->result_array();
    }

    public function getTagihanPeserta($id_peserta){
        $this->db->from("tagihan as a");
        $this->db->join("tagihan_peserta as b", "a.id_tagihan=b.id_tagihan");
        $this->db->join("peserta as e", "e.id_peserta=b.id_peserta");
        $this->db->where("b.id_peserta", $id_peserta);
        $this->db->where("a.status", "piutang");
        return $this->db->get()->result_array();
    }

    public function getTagihanKpq($nip){
        $this->db->from("tagihan as a");
        $this->db->join("tagihan_kpq as b", "a.id_tagihan=b.id_tagihan");
        $this->db->join("kpq as e", "e.nip=b.nip");
        $this->db->where("b.nip", $nip);
        $this->db->where("a.status", "piutang");
        return $this->db->get()->result_array();
    }

    public function hapusTagihan($id_tagihan){
        $this->db->where_in('id_tagihan', $id_tagihan);
        $this->db->delete('tagihan_peserta');
        $this->db->where_in('id_tagihan', $id_tagihan);
        $this->db->delete('tagihan_kelas');
        $this->db->where_in('id_tagihan', $id_tagihan);
        $this->db->delete('tagihan_kpq');
        $this->db->where_in('id_tagihan', $id_tagihan);
        $this->db->delete('tagihan');
    }

    public function getAllKelasPvAktif(){
        $this->db->select("a.id_kelas, nama_peserta, ket");
        $this->db->from("kelas as a");
        $this->db->join("kelas_koor as b", "a.id_kelas = b.id_kelas");
        $this->db->join("peserta as c", "c.id_peserta = b.id_peserta");
        $this->db->where("tipe_kelas !=", 'reguler');
        $this->db->where("a.status", 'aktif');
        return $this->db->get()->result_array();
    }

    public function getJadwalAktif($id_kelas){
        $this->db->from("jadwal");
        $this->db->where("status", "aktif");
        $this->db->where("id_kelas", $id_kelas);
        return $this->db->get()->result_array();
    }

    public function getInfaqByKet($ket){
        $this->db->select("infaq");
        $this->db->from("infaq");
        $this->db->where("tipe_kelas", $ket);
        return $this->db->get()->row_array();
    }

    public function getLastIdTagihan(){
        $this->db->select("id_tagihan");
        $this->db->from("tagihan");
        $this->db->order_by("id_tagihan", "DESC");
        return $this->db->get()->row_array();
    }

    public function insertPiutangKelas($id_tagihan, $id_kelas, $koor, $uraian, $nominal){
        $data['tagihan'] = [
            "id_tagihan" => $id_tagihan,
            "tgl_tagihan" => date("Y-m-d"),
            // "tgl_tagihan" => "2020-01-01",
            "nama_tagihan" => $koor,
            "uraian" => $uraian,
            "nominal" => $nominal,
            "status" => "piutang",
            "ket" => "bulanan"
        ];

        $this->db->insert("tagihan", $data['tagihan']);

        $data['tagihan_kelas'] = [
            "id_tagihan" => $id_tagihan,
            "id_kelas" => $id_kelas
        ];

        $this->db->insert("tagihan_kelas", $data['tagihan_kelas']);
    }

    public function insertPiutangPeserta($id_tagihan, $id_peserta, $nama_peserta, $uraian, $nominal){
        $data['tagihan'] = [
            "id_tagihan" => $id_tagihan,
            "tgl_tagihan" => date("Y-m-d"),
            "nama_tagihan" => $nama_peserta,
            "status" => "piutang",
            "uraian" => $uraian,
            "nominal" => $nominal,
        ];

        $this->db->insert("tagihan", $data['tagihan']);

        $data['tagihan_peserta'] = [
            "id_tagihan" => $id_tagihan,
            "id_peserta" => $id_peserta
        ];

        $this->db->insert("tagihan_peserta", $data['tagihan_peserta']);
    }

    public function getAllPesertaRegulerAktif(){
        $this->db->select("id_peserta, nama_peserta");
        $this->db->from("peserta");
        $this->db->where("status", "aktif");
        $this->db->where("tipe_peserta", "reguler");
        return $this->db->get()->result_array();
    }
    
    public function tambahPiutangKelas($id_tagihan, $nama){
        $data['tagihan'] = [
            "id_tagihan" => $id_tagihan,
            "tgl_tagihan" => $this->input->post("tgl_tagihan"),
            "nama_tagihan" => $nama,
            "status" => "piutang"
        ];

        $this->db->insert('tagihan', $data['tagihan']);
        
        $nominal = $this->input->post('nominal', true);
        $nominal = str_replace("Rp. ", "", $nominal);
        $nominal = str_replace(".", "", $nominal);

        $data['uraian'] = [
            "uraian" => $this->input->post('uraian', TRUE),
            "nominal" => $nominal,
            "id_tagihan" => $id_tagihan
        ];

        $this->db->insert('uraian_tagihan', $data['uraian']);

        $data['kelas'] = [
            "id_tagihan" => $id_tagihan,
            "id_kelas" => $this->input->post('id_kelas', TRUE)
        ];

        $this->db->insert('tagihan_kelas', $data['kelas']);
    }

    public function tambahPiutangPeserta($id_tagihan, $nama){
        $data['tagihan'] = [
            "id_tagihan" => $id_tagihan,
            "tgl_tagihan" => $this->input->post("tgl_tagihan"),
            "nama_tagihan" => $nama,
            "status" => "piutang"
        ];

        $this->db->insert('tagihan', $data['tagihan']);

        $nominal = $this->input->post('nominal', true);
        $nominal = str_replace("Rp. ", "", $nominal);
        $nominal = str_replace(".", "", $nominal);

        $data['uraian'] = [
            "uraian" => $this->input->post('uraian', TRUE),
            "nominal" => $nominal,
            "id_tagihan" => $id_tagihan
        ];

        $this->db->insert('uraian_tagihan', $data['uraian']);

        $data['peserta'] = [
            "id_tagihan" => $id_tagihan,
            "id_peserta" => $this->input->post('id_peserta', TRUE)
        ];

        $this->db->insert('tagihan_peserta', $data['peserta']);
    }

    public function tambahPiutangKpq($id_tagihan, $nama){
        $data['tagihan'] = [
            "id_tagihan" => $id_tagihan,
            "tgl_tagihan" => $this->input->post("tgl_tagihan"),
            "nama_tagihan" => $nama,
            "status" => "piutang"
        ];

        $this->db->insert('tagihan', $data['tagihan']);

        
        $nominal = $this->input->post('nominal', true);
        $nominal = str_replace("Rp. ", "", $nominal);
        $nominal = str_replace(".", "", $nominal);

        $data['uraian'] = [
            "uraian" => $this->input->post('uraian', TRUE),
            "nominal" => $nominal,
            "id_tagihan" => $id_tagihan
        ];

        $this->db->insert('uraian_tagihan', $data['uraian']);

        $data['kpq'] = [
            "id_tagihan" => $id_tagihan,
            "nip" => $this->input->post('nip', TRUE)
        ];

        $this->db->insert('tagihan_kpq', $data['kpq']);
    }

    public function data_pembayaran($id){
        $this->db->from("tagihan");
        $this->db->where("id_tagihan", $id);
        return $this->db->get()->row_array();
    }

    public function bayar_piutang($id){
        $data = [
            "status" => "lunas"
        ];

        $this->db->where("id_tagihan", $id);
        $this->db->update("tagihan", $data);
    }

    public function input_pembayaran($data){
        // id terakhir
        $nominal = $this->input->post('nominal', true);
        $nominal = str_replace("Rp. ", "", $nominal);
        $nominal = str_replace(".", "", $nominal);

        $this->db->select("id_pembayaran");
        $this->db->from("pembayaran");
        $this->db->order_by("id_pembayaran", "DESC");
        $id_bayar = $this->db->get()->row_array();
        $id_bayar = $id_bayar['id_pembayaran'] + 1;

        $bayar = [
            "id_pembayaran" => $id_bayar,
            "nama_pembayaran" => $data['nama_tagihan'],
            "uraian" => $data['uraian'],
            "nominal" => $nominal,
            "metode" => $this->input->post("metode"),
            "tgl_pembayaran" => $this->input->post("tgl")
        ];

        $this->db->insert("pembayaran", $bayar);

        // jenis pembayaran
        $tipe = $this->input->post("tipe");
        $this->jenis_pembayaran($id_bayar, $tipe);
    }

    public function input_deposit($data,$uang){
        // id terakhir
        $this->db->select("id_pembayaran");
        $this->db->from("pembayaran");
        $this->db->order_by("id_pembayaran", "DESC");
        $id_bayar = $this->db->get()->row_array();
        $id_bayar = $id_bayar['id_pembayaran'] + 1;

        $bayar = [
            "nama_pembayaran" => $data['nama_tagihan'],
            "uraian" => "Deposit",
            "nominal" => $uang,
            "metode" => $this->input->post("metode"),
            "tgl_pembayaran" => date('Y-m-d')
        ];

        $this->db->insert("pembayaran", $bayar);

        $tipe = $this->input->post("tipe");
        
        $this->jenis_pembayaran($id_bayar, $tipe);
    }

    public function input_sisa_piutang($data, $uang){
        // id terakhir
        $this->db->select("id_tagihan");
        $this->db->from("tagihan");
        $this->db->order_by("id_tagihan", "DESC");
        $id_bayar = $this->db->get()->row_array();
        $id_bayar = $id_bayar['id_tagihan'] + 1;

        $bayar = [
            "nama_tagihan" => $data['nama_tagihan'],
            "uraian" => "Sisa Piutang",
            "nominal" => $uang,
            "tgl_tagihan" => date('Y-m-d'),
            "status" => "Piutang"
        ];

        $this->db->insert("tagihan", $bayar);

        $tipe = $this->input->post("tipe");
        
        $this->jenis_tagihan($id_bayar, $tipe);
    }

    public function add_piutang($id_tagihan, $nama, $tipe, $id){
        $nominal = $this->input->post('nominal', true);
        $nominal = str_replace("Rp. ", "", $nominal);
        $nominal = str_replace(".", "", $nominal);

        $data['tagihan'] = [
            "id_tagihan" => $id_tagihan,
            "tgl_tagihan" => $this->input->post("tgl"),
            "nama_tagihan" => $nama,
            "uraian" => $this->input->post('uraian', TRUE),
            "nominal" => $nominal,
            "status" => "piutang"
        ];

        $this->db->insert('tagihan', $data['tagihan']);

        $this->jenis_tagihan($id_tagihan, $tipe);
    }

    public function add_pembayaran_deposit($id_tagihan, $nama, $tipe, $id){
        $nominal = $this->input->post('nominal', true);
        $nominal = str_replace("Rp. ", "", $nominal);
        $nominal = str_replace(".", "", $nominal);
        
        if($tipe == "peserta"){
            $piutang = $this->get_piutang_peserta($id);
            $pembayaran = $this->get_pembayaran_peserta($id);
            $deposit = $pembayaran['bayar'] - $piutang['piutang'];
        } else if($tipe == "kelas"){
            $piutang = $this->get_piutang_kelas($id);
            $pembayaran = $this->get_pembayaran_kelas($id);
            $deposit = $pembayaran['bayar'] - $piutang['piutang'];
        } else if($tipe == "kpq"){
            $piutang = $this->get_piutang_kpq($id);
            $pembayaran = $this->get_pembayaran_kpq($id);
            $deposit = $pembayaran['bayar'] - $piutang['piutang'];
        }
        
        if($nominal <= $deposit){
            $this->add_piutang($id_tagihan, $nama, $tipe, $id);
            $this->bayar_piutang($id_tagihan);
        } else {
            $sisa = ($deposit - $nominal) * -1;
            $this->add_piutang($id_tagihan, $nama, $tipe, $id);
            $this->bayar_piutang($id_tagihan);
            
            //ganti nominal
            $this->db->where("id_tagihan", $id_tagihan);
            $this->db->update("tagihan", ['nominal' => $deposit]);

            $this->add_sisa_piutang($nama, $tipe, $id, $sisa);
        }
    }

    public function add_sisa_piutang($nama, $tipe, $id, $nominal){
        // id terakhir
        $this->db->select("id_tagihan");
        $this->db->from("tagihan");
        $this->db->order_by("id_tagihan", "DESC");
        $id_bayar = $this->db->get()->row_array();
        $id_bayar = $id_bayar['id_tagihan'] + 1;

        $bayar = [
            "id_tagihan" => $id_bayar,
            "nama_tagihan" => $nama,
            "uraian" => "Sisa Piutang",
            "nominal" => $nominal,
            "tgl_tagihan" => $this->input->post("tgl"),
            "status" => "Piutang"
        ];

        $this->db->insert("tagihan", $bayar);

        $this->jenis_tagihan($id_bayar, $tipe);
    }

    public function add_pembayaran($id_tagihan, $nama, $tipe, $id){
        // id terakhir
        $metode = $this->input->post("metode");
        if($metode != 'Deposit'){
            $this->add_piutang($id_tagihan, $nama, $tipe, $id);
            $this->bayar_piutang($id_tagihan);
        }

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
            "nama_pembayaran" => $nama,
            "uraian" => $this->input->post('uraian', TRUE),
            "nominal" => $nominal,
            "metode" => $metode,
            "tgl_pembayaran" => $this->input->post("tgl"),
            "keterangan" => $this->input->post("keterangan", TRUE),
            "pengajar" => $this->input->post("pengajar", TRUE)
        ];

        $this->db->insert("pembayaran", $bayar);
        
        $this->jenis_pembayaran($id_bayar, $tipe);;
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

            $this->db->insert("pembayaran_kpq", $piutang);
        }
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

    // add data
        public function add_pembayaran_by_deposit(){
            // get id deposit terakhir
            $this->db->from("deposit");
            $this->db->order_by("id_deposit", "DESC");
            $id = $this->db->get()->row_array();
            $id = $id['id_deposit'] + 1;

            $data = [
                "id_deposit" => $id,
                "tgl_deposit" => $this->input->post("tgl"),
                "nama_deposit" => $this->input->post("nama"),
                "pengajar" => $this->input->post("pengajar"),
                "uraian" => $this->input->post("uraian"),
                "nominal" => $this->ganti_nominal($this->input->post("nominal")),
                "keterangan" => $this->input->post("keterangan"),
                "metode" => $this->input->post("metode")
            ]; 
            
            $this->db->insert("deposit", $data);
            
            $tipe = $this->input->post('tipe');
            if($tipe == 'kelas'){
                
                $data = [
                    "id_deposit" => $id,
                    "id_kelas" => $this->input->post('id')
                ];

                $this->db->insert("deposit_kelas", $data);

            } else if($tipe == 'peserta'){
                
                $data = [
                    "id_deposit" => $id,
                    "id_peserta" => $this->input->post('id')
                ];

                $this->db->insert("deposit_peserta", $data);

            } else if($tipe == 'kpq'){
                
                $data = [
                    "id_deposit" => $id,
                    "nip" => $this->input->post('id')
                ];

                $this->db->insert("deposit_kpq", $data);
            }
        }

        public function add_pembayaran_by_transfer($id_tagihan, $nama, $tipe, $id){
            // id terakhir
            $metode = $this->input->post("metode");
            if($metode != 'Deposit'){
                $this->add_piutang($id_tagihan, $nama, $tipe, $id);
                $this->bayar_piutang($id_tagihan);
            }
    
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
                "alamat" => ''
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
    // add data
    
    // other function
        public function ganti_nominal($nominal){
            $nominal = $this->input->post('nominal', true);
            $nominal = str_replace("Rp. ", "", $nominal);
            $nominal = str_replace(".", "", $nominal);
            return $nominal;
        }
    // other function


    // function terpisah
        // tagihan peserta
        public function get_total_tagihan_peserta($id){
            $this->db->select("sum(nominal) as total");
            $this->db->from("tagihan as a");
            $this->db->join("tagihan_peserta as b", "a.id_tagihan = b.id_tagihan");
            $this->db->where("id_peserta", $id);
            return $this->db->get()->row_array();
        }
        
        // deposit peserta
        public function get_total_deposit_peserta($id){
            $this->db->select("sum(nominal) as total");
            $this->db->from("deposit as a");
            $this->db->join("deposit_peserta as b", "a.id_deposit = b.id_deposit");
            $this->db->where("id_peserta", $id);
            return $this->db->get()->row_array();
        }
        
        // pembayaran cash peserta
        public function get_total_cash_peserta($id){
            $this->db->select("sum(nominal) as total");
            $this->db->from("pembayaran as a");
            $this->db->join("pembayaran_peserta as b", "a.id_pembayaran = b.id_pembayaran");
            $this->db->where("id_peserta", $id);
            return $this->db->get()->row_array();
        }

        // pembayaran transfer peserta
        public function get_total_transfer_peserta($id){
            $this->db->select("sum(nominal) as total");
            $this->db->from("transfer as a");
            $this->db->join("transfer_peserta as b", "a.id_transfer = b.id_transfer");
            $this->db->where("id_peserta", $id);
            return $this->db->get()->row_array();
        }
        
        // tagihan kelas
        public function get_total_tagihan_kelas($id){
            $this->db->select("sum(nominal) as total");
            $this->db->from("tagihan as a");
            $this->db->join("tagihan_kelas as b", "a.id_tagihan = b.id_tagihan");
            $this->db->where("id_kelas", $id);
            return $this->db->get()->row_array();
        }
        
        // deposit kelas
        public function get_total_deposit_kelas($id){
            $this->db->select("sum(nominal) as total");
            $this->db->from("deposit as a");
            $this->db->join("deposit_kelas as b", "a.id_deposit = b.id_deposit");
            $this->db->where("id_kelas", $id);
            return $this->db->get()->row_array();
        }
        
        // pembayaran cash kelas
        public function get_total_cash_kelas($id){
            $this->db->select("sum(nominal) as total");
            $this->db->from("pembayaran as a");
            $this->db->join("pembayaran_kelas as b", "a.id_pembayaran = b.id_pembayaran");
            $this->db->where("id_kelas", $id);
            return $this->db->get()->row_array();
        }
        
        // pembayaran transfer kelas
        public function get_total_transfer_kelas($id){
            $this->db->select("sum(nominal) as total");
            $this->db->from("transfer as a");
            $this->db->join("transfer_kelas as b", "a.id_transfer = b.id_transfer");
            $this->db->where("id_kelas", $id);
            return $this->db->get()->row_array();
        }
        
        // tagihan kpq
        public function get_total_tagihan_kpq($id){
            $this->db->select("sum(nominal) as total");
            $this->db->from("tagihan as a");
            $this->db->join("tagihan_kpq as b", "a.id_tagihan = b.id_tagihan");
            $this->db->where("nip", $id);
            return $this->db->get()->row_array();
        }
        
        // deposit kpq
        public function get_total_deposit_kpq($id){
            $this->db->select("sum(nominal) as total");
            $this->db->from("deposit as a");
            $this->db->join("deposit_kpq as b", "a.id_deposit = b.id_deposit");
            $this->db->where("nip", $id);
            return $this->db->get()->row_array();
        }
        
        // pembayaran cash kpq
        public function get_total_cash_kpq($id){
            $this->db->select("sum(nominal) as total");
            $this->db->from("pembayaran as a");
            $this->db->join("pembayaran_kpq as b", "a.id_pembayaran = b.id_pembayaran");
            $this->db->where("nip", $id);
            return $this->db->get()->row_array();
        }
        
        // pembayaran transfer kpq
        public function get_total_transfer_kpq($id){
            $this->db->select("sum(nominal) as total");
            $this->db->from("transfer as a");
            $this->db->join("transfer_kpq as b", "a.id_transfer = b.id_transfer");
            $this->db->where("nip", $id);
            return $this->db->get()->row_array();
        }
    // function terpisah
}