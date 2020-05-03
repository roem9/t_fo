<?php

class Rekap_model extends CI_MODEL{
    public function getAllRekapKelasByTipe($tipe, $month, $year){
        $query = "a.id_kelas, a.status, nama_peserta, nama_kpq, c.no_hp, a.program, COUNT(id_kbm) AS kbm";
        $this->db->select($query);
        $this->db->from("kelas as a");
        $this->db->join("kelas_koor as b", "a.id_kelas = b.id_kelas");
        $this->db->join("peserta as c", "c.id_peserta = b.id_peserta");
        $this->db->join("kpq as d", "d.nip = a.nip");
        $this->db->join("kbm as e", "e.id_kelas = a.id_kelas");
        $this->db->where("MONTH(e.tgl) = ", $month);
        $this->db->where("YEAR(e.tgl) = ", $year);
        $this->db->where("a.tipe_kelas", $tipe);
        $this->db->group_by("a.id_kelas");
        return $this->db->get()->result_array();
    }

    public function getAllKbmById($id_kelas, $month, $year){
        $query = "DATE_FORMAT(tgl, '%d %M %Y') AS tgl, a.hari, a.jam, nama_peserta";
        $this->db->select($query);
        $this->db->from("kbm as a");
        $this->db->join("kelas_koor as b", "a.id_kelas=b.id_kelas");
        $this->db->join("peserta as c", "c.id_peserta=b.id_peserta");
        $this->db->where("MONTH(tgl)", $month);
        $this->db->where("YEAR(tgl)", $year);
        $this->db->where("a.id_kelas", $id_kelas);
        $this->db->order_by("tgl", "asc");
        return $this->db->get()->result_array();
    }
}