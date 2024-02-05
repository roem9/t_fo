<?php

class Wl_model extends CI_MODEL{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('Datatables', 'datatables');
    }

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

    function getListWLReguler() { 
        $query = "
            DROP TEMPORARY TABLE IF EXISTS temporaryPeserta;

            CREATE TEMPORARY TABLE temporaryPeserta AS
            SELECT
                *
            FROM peserta
            WHERE tipe_peserta = 'reguler' AND status  = 'wl'
            ORDER BY nama_peserta ASC;
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
            , program
            , hari
            , jam
            , jk
            , no_hp
            , id_peserta
        ');

        $this->datatables->from('temporaryPeserta');
        return $this->datatables->generate();
    }

    function getListWLPrivat() { 
        $query = "
            DROP TEMPORARY TABLE IF EXISTS temporaryKelas;

            CREATE TEMPORARY TABLE temporaryKelas AS
            SELECT a.status, a.program, a.tipe_kelas, nama_peserta, a.id_kelas
            FROM kelas AS a
            JOIN kelas_koor AS b ON a.id_kelas = b.id_kelas
            JOIN peserta AS c ON c.id_peserta = b.id_peserta
            WHERE (a.status = 'wl' OR a.status = 'nonaktif')
            AND (a.nip = '' OR a.nip IS NULL);
        ";

        $queries = explode(";", $query);

        foreach ($queries as $query) {
            if(trim($query) != ""){
                $this->db->query($query);
            }
        }

        $this->datatables->select('
            status
            , program
            , tipe_kelas
            , nama_peserta
            , id_kelas
        ');

        $this->datatables->from('temporaryKelas');
        return $this->datatables->generate();
    }

    function getListWLPending() { 
        $query = "
            DROP TEMPORARY TABLE IF EXISTS temporaryKelas;

            CREATE TEMPORARY TABLE temporaryKelas AS
            SELECT a.status, a.program, a.tipe_kelas, nama_peserta, a.id_kelas
            FROM kelas AS a
            JOIN kelas_koor AS b ON a.id_kelas = b.id_kelas
            JOIN peserta AS c ON c.id_peserta = b.id_peserta
            WHERE a.status = 'pending'
            AND a.nip IS NULL;
        ";

        $queries = explode(";", $query);

        foreach ($queries as $query) {
            if(trim($query) != ""){
                $this->db->query($query);
            }
        }

        $this->datatables->select('
            status
            , program
            , tipe_kelas
            , nama_peserta
            , id_kelas
        ');

        $this->datatables->from('temporaryKelas');
        return $this->datatables->generate();
    }


    
}