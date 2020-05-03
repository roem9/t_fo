<?php

class Wl_model extends CI_MODEL{
    
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
    
}