<?php

class Piutang_model extends CI_MODEL{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('Datatables', 'datatables');
    }

    // function terpisah
        // tagihan peserta
        public function get_total_tagihan_peserta($id){
            $this->db->select("sum(nominal) as total");
            $this->db->from("tagihan as a");
            $this->db->join("tagihan_peserta as b", "a.id_tagihan = b.id_tagihan");
            $this->db->where("id_peserta", $id);
            return $this->db->get()->row_array();
        }
        
        // deposit peserta
        public function get_total_deposit_peserta($id){
            $this->db->select("sum(nominal) as total");
            $this->db->from("deposit as a");
            $this->db->join("deposit_peserta as b", "a.id_deposit = b.id_deposit");
            $this->db->where("id_peserta", $id);
            return $this->db->get()->row_array();
        }
        
        // pembayaran cash peserta
        public function get_total_cash_peserta($id){
            $this->db->select("sum(nominal) as total");
            $this->db->from("pembayaran as a");
            $this->db->join("pembayaran_peserta as b", "a.id_pembayaran = b.id_pembayaran");
            $this->db->where("id_peserta", $id);
            return $this->db->get()->row_array();
        }

        // pembayaran transfer peserta
        public function get_total_transfer_peserta($id){
            $this->db->select("sum(nominal) as total");
            $this->db->from("transfer as a");
            $this->db->join("transfer_peserta as b", "a.id_transfer = b.id_transfer");
            $this->db->where("id_peserta", $id);
            return $this->db->get()->row_array();
        }
        
        // tagihan kelas
        public function get_total_tagihan_kelas($id){
            $this->db->select("sum(nominal) as total");
            $this->db->from("tagihan as a");
            $this->db->join("tagihan_kelas as b", "a.id_tagihan = b.id_tagihan");
            $this->db->where("id_kelas", $id);
            return $this->db->get()->row_array();
        }
        
        // deposit kelas
        public function get_total_deposit_kelas($id){
            $this->db->select("sum(nominal) as total");
            $this->db->from("deposit as a");
            $this->db->join("deposit_kelas as b", "a.id_deposit = b.id_deposit");
            $this->db->where("id_kelas", $id);
            return $this->db->get()->row_array();
        }
        
        // pembayaran cash kelas
        public function get_total_cash_kelas($id){
            $this->db->select("sum(nominal) as total");
            $this->db->from("pembayaran as a");
            $this->db->join("pembayaran_kelas as b", "a.id_pembayaran = b.id_pembayaran");
            $this->db->where("id_kelas", $id);
            return $this->db->get()->row_array();
        }
        
        // pembayaran transfer kelas
        public function get_total_transfer_kelas($id){
            $this->db->select("sum(nominal) as total");
            $this->db->from("transfer as a");
            $this->db->join("transfer_kelas as b", "a.id_transfer = b.id_transfer");
            $this->db->where("id_kelas", $id);
            return $this->db->get()->row_array();
        }
        
        // tagihan kpq
        public function get_total_tagihan_kpq($id){
            $this->db->select("sum(nominal) as total");
            $this->db->from("tagihan as a");
            $this->db->join("tagihan_kpq as b", "a.id_tagihan = b.id_tagihan");
            $this->db->where("nip", $id);
            return $this->db->get()->row_array();
        }
        
        // deposit kpq
        public function get_total_deposit_kpq($id){
            $this->db->select("sum(nominal) as total");
            $this->db->from("deposit as a");
            $this->db->join("deposit_kpq as b", "a.id_deposit = b.id_deposit");
            $this->db->where("nip", $id);
            return $this->db->get()->row_array();
        }
        
        // pembayaran cash kpq
        public function get_total_cash_kpq($id){
            $this->db->select("sum(nominal) as total");
            $this->db->from("pembayaran as a");
            $this->db->join("pembayaran_kpq as b", "a.id_pembayaran = b.id_pembayaran");
            $this->db->where("nip", $id);
            return $this->db->get()->row_array();
        }
        
        // pembayaran transfer kpq
        public function get_total_transfer_kpq($id){
            $this->db->select("sum(nominal) as total");
            $this->db->from("transfer as a");
            $this->db->join("transfer_kpq as b", "a.id_transfer = b.id_transfer");
            $this->db->where("nip", $id);
            return $this->db->get()->row_array();
        }
    // function terpisah

    function getListPiutangReguler() { 
        $query = "
            DROP TEMPORARY TABLE IF EXISTS temporaryTable;
            DROP TEMPORARY TABLE IF EXISTS TagihanPeserta;
            DROP TEMPORARY TABLE IF EXISTS DepositPeserta;
            DROP TEMPORARY TABLE IF EXISTS PembayaranPeserta;
            DROP TEMPORARY TABLE IF EXISTS TransferPeserta;

            CREATE TEMPORARY TABLE TagihanPeserta AS
            SELECT
                b.id_peserta,
                SUM(nominal) AS total_tagihan
            FROM tagihan a
            JOIN tagihan_peserta b ON a.id_tagihan = b.id_tagihan
            GROUP BY b.id_peserta;

            CREATE TEMPORARY TABLE DepositPeserta AS
            SELECT
                b.id_peserta,
                SUM(nominal) AS total
            FROM deposit a
            JOIN deposit_peserta b ON a.id_deposit = b.id_deposit
            GROUP BY b.id_peserta;

            CREATE TEMPORARY TABLE PembayaranPeserta AS
            SELECT
                b.id_peserta,
                SUM(nominal) AS total
            FROM pembayaran a
            JOIN pembayaran_peserta b ON a.id_pembayaran = b.id_pembayaran
            GROUP BY b.id_peserta;

            CREATE TEMPORARY TABLE TransferPeserta AS
            SELECT
                b.id_peserta,
                SUM(nominal) AS total
            FROM transfer a
            JOIN transfer_peserta b ON a.id_transfer = b.id_transfer
            GROUP BY b.id_peserta;

            CREATE TEMPORARY TABLE temporaryTable AS
            SELECT
                a.id_peserta,
                a.status,
                a.nama_peserta,
                COALESCE(a.program, '-') AS program,
                COALESCE(a.hari, '-') AS hari,
                COALESCE(a.jam, '-') AS jam,
                COALESCE(a.nama_kpq, '-') AS nama_kpq,
                (COALESCE(f.total, 0) + COALESCE(g.total, 0) + COALESCE(h.total, 0)) - COALESCE(e.total_tagihan, 0)  AS piutang
            FROM peserta_reguler a
            LEFT JOIN TagihanPeserta e ON a.id_peserta = e.id_peserta
            LEFT JOIN DepositPeserta f ON a.id_peserta = f.id_peserta
            LEFT JOIN PembayaranPeserta g ON a.id_peserta = g.id_peserta
            LEFT JOIN TransferPeserta h ON a.id_peserta = h.id_peserta
            ORDER BY a.nama_peserta;
        ";

        $queries = explode(";", $query);

        foreach ($queries as $query) {
            if(trim($query) != ""){
                $this->db->query($query);
            }
        }

        $this->datatables->select('id_peserta, status, nama_peserta, program, hari, jam, nama_kpq, piutang');
        $this->datatables->from('temporaryTable');
        return $this->datatables->generate();
    }

    function getListPiutangCivitas() { 
        $query = "
            DROP TEMPORARY TABLE IF EXISTS temporaryTable;
            DROP TEMPORARY TABLE IF EXISTS TagihanKpq;
            DROP TEMPORARY TABLE IF EXISTS DepositKpq;
            DROP TEMPORARY TABLE IF EXISTS PembayaranKpq;
            DROP TEMPORARY TABLE IF EXISTS TransferKpq;

            CREATE TEMPORARY TABLE TagihanKpq AS
            SELECT
                b.nip,
                SUM(nominal) AS total_tagihan
            FROM tagihan a
            JOIN tagihan_kpq b ON a.id_tagihan = b.id_tagihan
            GROUP BY b.nip;

            CREATE TEMPORARY TABLE DepositKpq AS
            SELECT
                b.nip,
                SUM(nominal) AS total
            FROM deposit a
            JOIN deposit_kpq b ON a.id_deposit = b.id_deposit
            GROUP BY b.nip;

            CREATE TEMPORARY TABLE PembayaranKpq AS
            SELECT
                b.nip,
                SUM(nominal) AS total
            FROM pembayaran a
            JOIN pembayaran_kpq b ON a.id_pembayaran = b.id_pembayaran
            GROUP BY b.nip;

            CREATE TEMPORARY TABLE TransferKpq AS
            SELECT
                b.nip,
                SUM(nominal) AS total
            FROM transfer a
            JOIN transfer_kpq b ON a.id_transfer = b.id_transfer
            GROUP BY b.nip;

            CREATE TEMPORARY TABLE temporaryTable AS
            SELECT
                a.nip,
                a.status,
                a.nama_kpq,
                CASE 
                    WHEN SUBSTRING(a.nip, 1, 3) = '012' THEN 'KPQ' 
                    ELSE 'Karyawan' 
                END AS tipe,
                (COALESCE(f.total, 0) + COALESCE(g.total, 0) + COALESCE(h.total, 0)) - COALESCE(e.total_tagihan, 0)  AS piutang
            FROM kpq a
            LEFT JOIN TagihanKpq e ON a.nip = e.nip
            LEFT JOIN DepositKpq f ON a.nip = f.nip
            LEFT JOIN PembayaranKpq g ON a.nip = g.nip
            LEFT JOIN TransferKpq h ON a.nip = h.nip
            ORDER BY a.nama_kpq;
        ";

        $queries = explode(";", $query);

        foreach ($queries as $query) {
            if(trim($query) != ""){
                $this->db->query($query);
            }
        }

        $this->datatables->select('nip, status, nama_kpq, tipe, piutang');
        $this->datatables->from('temporaryTable');
        return $this->datatables->generate();
    }

    function getListPiutangPrivat($table) { 
        $query = "
            DROP TEMPORARY TABLE IF EXISTS temporaryTable;
            DROP TEMPORARY TABLE IF EXISTS TagihanKelas;
            DROP TEMPORARY TABLE IF EXISTS DepositKelas;
            DROP TEMPORARY TABLE IF EXISTS PembayaranKelas;
            DROP TEMPORARY TABLE IF EXISTS TransferKelas;

            CREATE TEMPORARY TABLE TagihanKelas AS
            SELECT
                b.id_kelas,
                SUM(nominal) AS total_tagihan
            FROM tagihan a
            JOIN tagihan_kelas b ON a.id_tagihan = b.id_tagihan
            GROUP BY b.id_kelas;

            CREATE TEMPORARY TABLE DepositKelas AS
            SELECT
                b.id_kelas,
                SUM(nominal) AS total
            FROM deposit a
            JOIN deposit_kelas b ON a.id_deposit = b.id_deposit
            GROUP BY b.id_kelas;

            CREATE TEMPORARY TABLE PembayaranKelas AS
            SELECT
                b.id_kelas,
                SUM(nominal) AS total
            FROM pembayaran a
            JOIN pembayaran_kelas b ON a.id_pembayaran = b.id_pembayaran
            GROUP BY b.id_kelas;

            CREATE TEMPORARY TABLE TransferKelas AS
            SELECT
                b.id_kelas,
                SUM(nominal) AS total
            FROM transfer a
            JOIN transfer_kelas b ON a.id_transfer = b.id_transfer
            GROUP BY b.id_kelas;

            CREATE TEMPORARY TABLE temporaryTable AS
            SELECT
                a.status,
                a.id_kelas,
                COALESCE(a.pj, 'edit') AS pj,
                a.nama_peserta,
                a.no_hp,
                DATE_FORMAT(a.tgl_mulai, '%d-%m-%Y') as tgl_mulai,
                COALESCE(a.nama_kpq, '-') AS nama_kpq,
                (COALESCE(f.total, 0) + COALESCE(g.total, 0) + COALESCE(h.total, 0)) - COALESCE(e.total_tagihan, 0)  AS piutang
            FROM $table a
            LEFT JOIN TagihanKelas e ON a.id_kelas = e.id_kelas
            LEFT JOIN DepositKelas f ON a.id_kelas = f.id_kelas
            LEFT JOIN PembayaranKelas g ON a.id_kelas = g.id_kelas
            LEFT JOIN TransferKelas h ON a.id_kelas = h.id_kelas;
        ";

        $queries = explode(";", $query);

        foreach ($queries as $query) {
            if(trim($query) != ""){
                $this->db->query($query);
            }
        }

        $this->datatables->select('id_kelas, status, pj, nama_peserta, no_hp, tgl_mulai, nama_kpq, piutang');
        $this->datatables->from('temporaryTable');
        return $this->datatables->generate();
    }
}