<?php

class Kelas_model extends CI_MODEL{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('Datatables', 'datatables');
    }
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
        
        public function getAllKelasPvLuar(){
            $query = "a.id_kelas, a.status, nama_peserta, nama_kpq, c.no_hp, a.program";
            $this->db->select($query);
            $this->db->from("kelas as a");
            $this->db->join("kelas_koor as b", "a.id_kelas = b.id_kelas");
            $this->db->join("peserta as c", "c.id_peserta = b.id_peserta");
            $this->db->join("kpq as d", "d.nip = a.nip");
            $where = "a.tipe_kelas = 'pv luar' OR a.tipe_kelas = 'pv luar kota'";
            $this->db->where($where);
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

    function getListKelasPrivat($tipe) { 
        if($tipe == 'pvkhusus'){
            $where = "a.tipe_kelas = 'pv khusus'";
        } else if($tipe == 'pvluar'){
            $where = "a.tipe_kelas = 'pv luar' OR a.tipe_kelas = 'pv luar kota'";
        }
        
        $query = "
            DROP TEMPORARY TABLE IF EXISTS temporaryKelas;

            CREATE TEMPORARY TABLE temporaryKelas AS
            SELECT
                a.id_kelas
                , a.status
                , nama_peserta
                , nama_kpq
                , c.no_hp
                , a.program
                
            FROM kelas a
            JOIN kelas_koor b ON a.id_kelas = b.id_kelas
            JOIN peserta c ON c.id_peserta = b.id_peserta
            JOIN kpq d ON d.nip = a.nip
            WHERE $where;
        ";

        $queries = explode(";", $query);

        foreach ($queries as $query) {
            if(trim($query) != ""){
                $this->db->query($query);
            }
        }

        $this->datatables->select('id_kelas, status, nama_peserta, nama_kpq, no_hp, program');
        $this->datatables->from('temporaryKelas');
        return $this->datatables->generate();
    }

    function getListKelasReguler() { 
        $query = "
            DROP TEMPORARY TABLE IF EXISTS temporaryKelas;

            CREATE TEMPORARY TABLE temporaryKelas AS
            SELECT
                a.id_kelas, 
                a.status, 
                a.program, 
                b.tempat, 
                hari, 
                jam, 
                nama_kpq, 
                1 AS peserta
            FROM kelas a
            JOIN jadwal b ON a.id_kelas = b.id_kelas
            JOIN kpq c ON a.nip = c.nip
            WHERE a.tipe_kelas = 'reguler'
            AND b.status = 'aktif';
        ";

        $queries = explode(";", $query);

        foreach ($queries as $query) {
            if(trim($query) != ""){
                $this->db->query($query);
            }
        }

        $this->datatables->select('id_kelas, status, program, tempat, hari, jam, nama_kpq, peserta');
        $this->datatables->from('temporaryKelas');
        return $this->datatables->generate();
    }
}