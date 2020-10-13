<?php
class Laporan_model extends CI_MODEL{
    public function get_all_tagihan_pv_khusus(){
        $this->db->from("piutang_pv_khusus as a");
        $this->db->join("kelas as b", "a.id_kelas = b.id_kelas");
        $this->db->order_by("tgl_tagihan", "asc");
        return $this->db->get()->result_array();
    }
    
    public function get_peserta_by_tgl_masuk($tgl_masuk, $tipe = ""){
        $this->db->from("peserta as a");
        $this->db->join("alamat as b", "a.id_peserta = b.id_peserta");
        $this->db->join("pekerjaan as c", "a.id_peserta = c.id_peserta");
        $this->db->join("ortu as d", "a.id_peserta = d.id_peserta");
        $this->db->where("tgl_masuk", $tgl_masuk);
        if($tipe)
            $this->db->where("tipe_peserta", $tipe);
        return $this->db->get()->result_array();
    }
    
    public function get_buku_between($tgl_awal, $tgl_akhir){
        $this->db->select("tgl_pembayaran as tgl");
        $this->db->from("pembayaran");
        $where = "tgl_pembayaran between '$tgl_awal' AND '$tgl_akhir'";
        $this->db->where($where);
        $this->db->where("keterangan", "Buku");
        $this->db->group_by("tgl_pembayaran");
        $data =  $this->db->get()->result_array();
        $cash = [];
        foreach ($data as $i => $data) {
            $cash[$i] = $data['tgl'];
        }

        $this->db->select("tgl_transfer as tgl");
        $this->db->from("transfer");
        $where = "tgl_transfer between '$tgl_awal' AND '$tgl_akhir'";
        $this->db->where($where);
        $this->db->where("keterangan", "Buku");
        $this->db->group_by("tgl_transfer");
        $data =  $this->db->get()->result_array();
        $transfer = [];
        foreach ($data as $i => $data) {
            $transfer[$i] = $data['tgl'];
        }

        $this->db->select("tgl_tagihan as tgl");
        $this->db->from("tagihan");
        $where = "tgl_tagihan between '$tgl_awal' AND '$tgl_akhir'";
        $this->db->where($where);
        $this->db->where("ket", "Buku");
        $this->db->group_by("tgl_tagihan");
        $data =  $this->db->get()->result_array();
        $tagihan = [];
        foreach ($data as $i => $data) {
            $tagihan[$i] = $data['tgl'];
        }

        $tgl = array_unique(array_merge($cash, $transfer, $tagihan), SORT_REGULAR);
        sort($tgl);
        return $tgl;
    }
}