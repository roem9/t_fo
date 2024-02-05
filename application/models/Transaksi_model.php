<?php
    class Transaksi_model extends CI_MODEL{
        public function __construct()
        {
            parent::__construct();
            $this->load->database();
            $this->load->library('Datatables', 'datatables');
        }

        public function get_transaksi_lain(){
            $this->db->from("pembayaran");
            $where = "id_pembayaran NOT IN(SELECT id_pembayaran FROM pembayaran_peserta) AND id_pembayaran NOT IN(SELECT id_pembayaran FROM pembayaran_kelas) AND id_pembayaran NOT IN(SELECT id_pembayaran FROM pembayaran_kpq)";
            $this->db->where($where);
            return $this->db->get()->result_array();
        }
        
        public function get_tanggal(){
            $laporan = [];
            $this->db->select("tgl_pembayaran, count(id_pembayaran) AS jumlah");
            $this->db->from("pembayaran");
            $this->db->group_by("tgl_pembayaran");
            $this->db->order_by("tgl_pembayaran", "DESC");
            $tgl = $this->db->get()->result_array();
            foreach ($tgl as $key => $tgl) {
                $laporan[$key] = $tgl;
                $cash = $this->cash_perhari($tgl['tgl_pembayaran']);
                $laporan[$key]['cash'] = $cash['cash'];
                
                $transfer = $this->transfer_perhari($tgl['tgl_pembayaran']);
                $laporan[$key]['transfer'] = $transfer['transfer'];
                
                $deposit = $this->deposit_perhari($tgl['tgl_pembayaran']);
                $laporan[$key]['deposit'] = $deposit['deposit'];
            }
            return $laporan;
        }

        public function cash_perhari($tgl){
            $this->db->select("SUM(nominal) AS cash");
            $this->db->from("pembayaran");
            $this->db->where("tgl_pembayaran", $tgl);
            $this->db->where("metode", "cash");
            return $this->db->get()->row_array();
        }

        public function transfer_perhari($tgl){
            $this->db->select("SUM(nominal) AS transfer");
            $this->db->from("pembayaran");
            $this->db->where("tgl_pembayaran", $tgl);
            $this->db->where("metode", "transfer");
            return $this->db->get()->row_array();
        }

        public function deposit_perhari($tgl){
            $this->db->select("SUM(nominal) AS deposit");
            $this->db->from("pembayaran");
            $this->db->where("tgl_pembayaran", $tgl);
            $this->db->where("metode", "deposit");
            return $this->db->get()->row_array();
        }

        public function get_transaksi_tanggal($tgl){
            $this->db->from("pembayaran");
            $this->db->where("tgl_pembayaran", $tgl);
            $this->db->where("metode", "cash");
            return $this->db->get()->result_array();
        }
        
        public function get_tanggal_between(){

            $tgl_awal = $this->input->post("tgl_awal");
            $tgl_akhir = $this->input->post("tgl_akhir");

            $this->db->select("tgl_pembayaran");
            $this->db->from("pembayaran");
            $where = "tgl_pembayaran between '$tgl_awal' AND '$tgl_akhir'";
            $this->db->where($where);
            $this->db->where("metode", "cash");
            $this->db->group_by("tgl_pembayaran");
            return $this->db->get()->result_array();
        }

        
        public function edit_status_tagihan(){
            $id = $this->input->post("id");
            $status = $this->input->post("status");
            $this->db->where("id_tagihan", $id);
            $this->db->update("tagihan", ["status" => $status]);
        }

        function getListTransaksiLainnya() { 
            $query = "
                DROP TEMPORARY TABLE IF EXISTS temporaryTable;
    
                CREATE TEMPORARY TABLE temporaryTable AS
                SELECT
                    id_pembayaran as id
                    , tgl_pembayaran as tgl
                    , nama_pembayaran as nama
                    , pengajar
                    , uraian
                    , nominal
                    , metode
                    , keterangan
                    , '' as alamat
                FROM pembayaran
                WHERE id_pembayaran NOT IN(SELECT id_pembayaran FROM pembayaran_peserta) AND id_pembayaran NOT IN(SELECT id_pembayaran FROM pembayaran_kelas) AND id_pembayaran NOT IN(SELECT id_pembayaran FROM pembayaran_kpq)

                UNION ALL

                SELECT
                    id_transfer as id
                    , tgl_transfer as tgl
                    , nama_transfer as nama
                    , pengajar
                    , uraian
                    , nominal
                    , metode
                    , keterangan
                    , alamat
                FROM transfer
                WHERE id_transfer NOT IN(SELECT id_transfer FROM transfer_peserta) AND id_transfer NOT IN(SELECT id_transfer FROM transfer_kelas) AND id_transfer NOT IN(SELECT id_transfer FROM transfer_kpq);
            ";
    
            $queries = explode(";", $query);
    
            foreach ($queries as $query) {
                if(trim($query) != ""){
                    $this->db->query($query);
                }
            }
    
            $this->datatables->select('id, tgl, nama, pengajar, uraian, nominal, metode, keterangan, alamat');
            $this->datatables->from('temporaryTable');
            return $this->datatables->generate();
        }
    }