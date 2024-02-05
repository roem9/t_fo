<?php
class Peserta_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('Datatables', 'datatables');
    }

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

    function getListPesertaReguler($status) { 
        if($status == 'aktif'){
            $where = "a.status = '$status'";
        } else if($status == 'nonaktif'){
            $where = "a.status = '$status'";
        }

        $query = "
            DROP TEMPORARY TABLE IF EXISTS temporaryPeserta;

            CREATE TEMPORARY TABLE temporaryPeserta AS
            SELECT
                a.status
                , a.nama_peserta
                , a.no_hp
                , a.program_peserta
                , a.hari_peserta
                , a.jam_peserta
                , a.program
                , a.tempat
                , a.hari
                , a.jam
                , a.nama_kpq
                , a.id_peserta
            FROM peserta_reguler a
            WHERE $where;
        ";

        $queries = explode(";", $query);

        foreach ($queries as $query) {
            if(trim($query) != ""){
                $this->db->query($query);
            }
        }

        $this->datatables->select('
            status
            , nama_peserta
            , no_hp
            , program_peserta
            , hari_peserta
            , jam_peserta
            , program
            , tempat
            , hari
            , jam
            , nama_kpq
            , id_peserta
        ');

        $this->datatables->from('temporaryPeserta');
        return $this->datatables->generate();
    }

    function getListPesertaPrivat($tipe, $status) { 
        if($status == 'aktif'){
            $where = "a.status = '$status'";
        } else if($status == 'nonaktif'){
            $where = "a.status = '$status'";
        }

        if($tipe == 'pvluar'){
            $table = 'peserta_pv_luar';
        } else if($tipe == 'pvkhusus'){
            $table = 'peserta_pv_khusus';
        }

        $query = "
            DROP TEMPORARY TABLE IF EXISTS temporaryPeserta;

            CREATE TEMPORARY TABLE temporaryPeserta AS
            SELECT
                a.status
                , a.nama_peserta
                , a.no_hp
                , a.nama_kpq
                , a.program
                , a.id_peserta
            FROM $table a
            WHERE $where;
        ";

        $queries = explode(";", $query);

        foreach ($queries as $query) {
            if(trim($query) != ""){
                $this->db->query($query);
            }
        }

        $this->datatables->select('
            status
            , nama_peserta
            , no_hp
            , nama_kpq
            , program
            , id_peserta
        ');

        $this->datatables->from('temporaryPeserta');
        return $this->datatables->generate();
    }
}