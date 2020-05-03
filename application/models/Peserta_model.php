<?php

class Peserta_model extends CI_Model{
    
    public function getId(){

        $tahun = date('y');
        $tipe = $this->input->post('tipe_peserta');

        if ($tipe == 'reguler'){
            $tipe = 'PR';
        } else if ($tipe == 'pv khusus'){
            $tipe = 'PK';
        } else if ($tipe == 'pv luar'){
            $tipe = 'PL';
        }

        $this->db->from('peserta');
        $this->db->where('SUBSTRING(id_peserta, 5, 2) = ', $tahun);
        $this->db->where('SUBSTRING(id_peserta, 1, 2) = ', $tipe);
        $this->db->order_by('id_peserta', 'desc');
        return $this->db->get()->row_array();

    }

    public function tambahWl(){

    }
    
    public function getAllPesertaByTipe($type){
        $this->db->from('peserta');
        $this->db->where('tipe_peserta', $type);
        return $this->db->get()->result_array();
    }

    public function getPesertaById($id_peserta){
        $this->db->select('*');
        $this->db->from('peserta as a');
        $this->db->join('alamat as b', 'a.id_peserta = b.id_peserta');
        $this->db->join('pekerjaan as c', 'a.id_peserta = c.id_peserta');
        $this->db->join('ortu as d', 'a.id_peserta = d.id_peserta');
        $this->db->where('a.id_peserta', $id_peserta);
        return $this->db->get()->row_array();

    }

    public function editDataPeserta($id_peserta){
        $data['peserta'] = [
            "nama_peserta" => $this->input->post('nama', true),
            "status" => $this->input->post('status', true),
            "jk" => $this->input->post('jk', true),
            "no_hp" => $this->input->post('no_hp', true),
            "program" => $this->input->post('program', true),
            "hari" => $this->input->post('hari', true),
            "jam" => $this->input->post('jam', true),
            "tempat" => $this->input->post('tempat', true)
        ];

        $this->db->where('id_peserta', $id_peserta);
        $this->db->update('peserta', $data['peserta']);

        $data['alamat'] = [
            "alamat" => $this->input->post('alamat_peserta', true)
        ];

        $this->db->where('id_peserta', $id_peserta);
        $this->db->update('alamat', $data['alamat']);
    }
}