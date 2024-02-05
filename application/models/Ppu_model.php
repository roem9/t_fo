<?php
class Ppu_model extends CI_MODEL{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('Datatables', 'datatables');
    }

    function getListPPU() { 
        $query = "
            DROP TEMPORARY TABLE IF EXISTS temporaryPPU;

            CREATE TEMPORARY TABLE temporaryPPU AS
            SELECT
                *,
                'Transfer' as metode
            FROM ppu_transfer
            UNION ALL
            SELECT
                *,
                'Cash' as metode
            FROM ppu_cash;
        ";

        $queries = explode(";", $query);

        foreach ($queries as $query) {
            if(trim($query) != ""){
                $this->db->query($query);
            }
        }

        $this->datatables->select('id, nama, alamat, tgl, jenis, keterangan, nominal, metode');
        $this->datatables->from('temporaryPPU');
        return $this->datatables->generate();
    }
}