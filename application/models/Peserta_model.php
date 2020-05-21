<?php
class Peserta_model extends CI_Model{
    // get one
        public function getPesertaById($id_peserta){
            $this->db->select('*');
            $this->db->from('peserta as a');
            $this->db->join('alamat as b', 'a.id_peserta = b.id_peserta');
            $this->db->join('pekerjaan as c', 'a.id_peserta = c.id_peserta');
            $this->db->join('ortu as d', 'a.id_peserta = d.id_peserta');
            $this->db->where('a.id_peserta', $id_peserta);
            return $this->db->get()->row_array();
        }
    // get one
}