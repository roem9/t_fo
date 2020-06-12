<?php

class Wl_model extends CI_MODEL{
    // get all
        public function getPesertaWl(){
            $this->db->from('peserta');
            $this->db->where('status', 'wl');
            $this->db->where('tipe_peserta', 'reguler');
            return $this->db->get()->result_array();
        }
        
        public function getKelasWl(){
            $this->db->select('a.status, a.program, a.tipe_kelas, nama_peserta, a.id_kelas');
            $this->db->from('kelas as a');
            $this->db->join('kelas_koor as b','a.id_kelas=b.id_kelas');
            $this->db->join('peserta as c','c.id_peserta=b.id_peserta');
            $this->db->where('a.status', 'wl');
            $this->db->or_where('a.status', 'nonaktif');
            $this->db->where('a.nip', '');
            $this->db->or_where('a.nip', NULL);
            return $this->db->get()->result_array();
        }
        
        public function getKelasWlPending(){
            $this->db->select('a.status, a.program, a.tipe_kelas, nama_peserta, a.id_kelas');
            $this->db->from('kelas as a');
            $this->db->join('kelas_koor as b','a.id_kelas=b.id_kelas');
            $this->db->join('peserta as c','c.id_peserta=b.id_peserta');
            $this->db->where('a.status', 'pending');
            // $this->db->or_where('a.status', 'nonaktif');
            // $this->db->where('a.nip', '');
            $this->db->where('a.nip', NULL);
            return $this->db->get()->result_array();
        }
    // get all
    
    // get by
        public function dataKelasWlById($id_kelas){
            $query = "a.status, a.program, nama_peserta, pengajar, a.tempat, catatan, a.id_kelas";
            $this->db->select($query);
            $this->db->from("kelas as a");
            $this->db->join("kelas_koor as b", "a.id_kelas=b.id_kelas");
            $this->db->join("peserta as c", "b.id_peserta=c.id_peserta");
            $this->db->where("a.id_kelas", $id_kelas);
            return $this->db->get()->row_array();
        }
    // get by
}