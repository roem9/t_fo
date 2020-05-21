<?php

class Piutang_model extends CI_MODEL{
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
}