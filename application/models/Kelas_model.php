<?php

class Kelas_model extends CI_MODEL{
    public function getAllKelasByTipe($tipe){
        $query = "a.id_kelas, a.status, nama_peserta, nama_kpq, c.no_hp, a.program";
        $this->db->select($query);
        $this->db->from("kelas as a");
        $this->db->join("kelas_koor as b", "a.id_kelas = b.id_kelas");
        $this->db->join("peserta as c", "c.id_peserta = b.id_peserta");
        $this->db->join("kpq as d", "d.nip = a.nip");
        $this->db->where("a.tipe_kelas", $tipe);
        return $this->db->get()->result_array();
    }

    public function getAllKelasReguler(){
        $query = "a.id_kelas, a.status, a.program, b.tempat, hari, jam, nama_kpq, 1 AS peserta";
        $this->db->select($query);
        $this->db->from("kelas as a");
        $this->db->join("jadwal as b", "a.id_kelas = b.id_kelas");
        $this->db->join("kpq as c", "a.nip = c.nip");
        $this->db->where("a.tipe_kelas", "reguler");;
        $this->db->where("b.status", "aktif");
        return $this->db->get()->result_array();
    }

    public function dataKelasById($id_kelas){
        $query = "a.status, a.program, nama_peserta, nama_kpq, pengajar";
        $this->db->select($query);
        $this->db->from("kelas as a");
        $this->db->join("kelas_koor as b", "a.id_kelas=b.id_kelas");
        $this->db->join("peserta as c", "b.id_peserta=c.id_peserta");
        $this->db->join("kpq as d", "d.nip=a.nip");
        $this->db->where("a.id_kelas", $id_kelas);
        return $this->db->get()->row_array();
    }

    public function dataKelasWlById($id_kelas){
        $query = "a.status, a.program, nama_peserta, pengajar, a.tempat, catatan, a.id_kelas";
        $this->db->select($query);
        $this->db->from("kelas as a");
        $this->db->join("kelas_koor as b", "a.id_kelas=b.id_kelas");
        $this->db->join("peserta as c", "b.id_peserta=c.id_peserta");
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

    public function dataKelasReguler($id_kelas){
        $query = "a.status, a.program, nama_kpq, pengajar";
        $this->db->select($query);
        $this->db->from("kelas as a");
        $this->db->join("kpq as d", "d.nip=a.nip");
        $this->db->where("a.id_kelas", $id_kelas);
        return $this->db->get()->row_array();
    }
    
    public function editWl($id_kelas){
        $data['wl'] = [
            "status" => $this->input->post('status'),
            "program" => $this->input->post('program'),
            "pengajar" => $this->input->post('pengajar'),
            "tempat" => $this->input->post('tempat', TRUE),
            "catatan" => $this->input->post('catatan', TRUE)
        ];

        $this->db->where("id_kelas", $id_kelas);
        $this->db->update("kelas", $data['wl']);
    }
}