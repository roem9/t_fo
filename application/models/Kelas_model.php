<?php

class Kelas_model extends CI_MODEL{
    // main
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
        
        public function dataKelasReguler($id_kelas){
            $query = "a.status, a.program, nama_kpq, pengajar";
            $this->db->select($query);
            $this->db->from("kelas as a");
            $this->db->join("kpq as d", "d.nip=a.nip");
            $this->db->where("a.id_kelas", $id_kelas);
            return $this->db->get()->row_array();
        }
    // main
}