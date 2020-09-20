<?php
class Home_model extends CI_MODEL{
    // get by
        public function get_pekerjaan_by_periode($bulan, $tahun){
            $pekerjaan = array("Pelajar", "Mahasiswa", "Swasta", "PNS/BUMN", "TNI/POLRI");

            $this->db->select("pekerjaan");
            $this->db->from("peserta as a");
            $this->db->join("pekerjaan as b", "a.id_peserta = b.id_peserta");
            $this->db->where("MONTH(tgl_masuk)", $bulan);
            $this->db->where("YEAR(tgl_masuk)", $tahun);
            $this->db->where_in("pekerjaan", $pekerjaan);
            $this->db->group_by("pekerjaan");
            return $this->db->get()->result_array();
        }
        
        public function get_pekerjaan_between($where){
            $pekerjaan = array("Pelajar", "Mahasiswa", "Swasta", "PNS/BUMN", "TNI/POLRI");

            $this->db->select("pekerjaan");
            $this->db->from("peserta as a");
            $this->db->join("pekerjaan as b", "a.id_peserta = b.id_peserta");
            // $this->db->where("MONTH(tgl_masuk)", $bulan);
            // $this->db->where("YEAR(tgl_masuk)", $tahun);
            $this->db->where($where);
            $this->db->where_in("pekerjaan", $pekerjaan);
            $this->db->group_by("pekerjaan");
            return $this->db->get()->result_array();
        }
        
        public function get_peserta_by_periode_by_pekerjaan($bulan, $tahun, $pekerjaan){
            $this->db->from("peserta as a");
            $this->db->join("pekerjaan as b", "a.id_peserta=b.id_peserta");
            $this->db->where("pekerjaan", $pekerjaan);
            $this->db->where("MONTH(tgl_masuk)", $bulan);
            $this->db->where("YEAR(tgl_masuk)", $tahun);
            return $this->db->get()->result_array();
        }
        
        public function get_peserta_between_by_pekerjaan($where, $pekerjaan){
            $this->db->from("peserta as a");
            $this->db->join("pekerjaan as b", "a.id_peserta=b.id_peserta");
            $this->db->where("pekerjaan", $pekerjaan);
            // $this->db->where("MONTH(tgl_masuk)", $bulan);
            // $this->db->where("YEAR(tgl_masuk)", $tahun);
            $this->db->where($where);
            return $this->db->get()->result_array();
        }

        public function get_pekerjaan_lainnya_by_periode($bulan, $tahun){
            $pekerjaan = array("Pelajar", "Mahasiswa", "Swasta", "PNS/BUMN", "TNI/POLRI");
            $this->db->from("peserta as a");
            $this->db->join("pekerjaan as b", "a.id_peserta = b.id_peserta");
            $this->db->where("MONTH(tgl_masuk)", $bulan);
            $this->db->where("YEAR(tgl_masuk)", $tahun);
            $this->db->where_not_in("pekerjaan", $pekerjaan);
            // $this->db->group_by("pekerjaan");
            return $this->db->get()->result_array();
        }
        
        public function get_pekerjaan_lainnya_between($where){
            $pekerjaan = array("Pelajar", "Mahasiswa", "Swasta", "PNS/BUMN", "TNI/POLRI");
            $this->db->from("peserta as a");
            $this->db->join("pekerjaan as b", "a.id_peserta = b.id_peserta");
            // $this->db->where("MONTH(tgl_masuk)", $bulan);
            // $this->db->where("YEAR(tgl_masuk)", $tahun);
            $this->db->where($where);
            $this->db->where_not_in("pekerjaan", $pekerjaan);
            // $this->db->group_by("pekerjaan");
            return $this->db->get()->result_array();
        }
        
        public function get_informasi_by_periode($bulan, $tahun){
            $informasi = array("Teman", "Media Elektronik", "Spanduk", "Civitas Tar-Q", "Brosur", "Peserta", "Event");
            $this->db->select("info");
            $this->db->from("peserta");
            $this->db->where("MONTH(tgl_masuk)", $bulan);
            $this->db->where("YEAR(tgl_masuk)", $tahun);
            $this->db->where_in("info", $informasi);
            $this->db->group_by("info");
            return $this->db->get()->result_array();
        }

        public function get_informasi_between($where){
            $informasi = array("Teman", "Media Elektronik", "Spanduk", "Civitas Tar-Q", "Brosur", "Peserta", "Event");
            $this->db->select("info");
            $this->db->from("peserta");
            // $this->db->where("MONTH(tgl_masuk)", $bulan);
            // $this->db->where("YEAR(tgl_masuk)", $tahun);
            $this->db->where($where);
            $this->db->where_in("info", $informasi);
            $this->db->group_by("info");
            return $this->db->get()->result_array();
        }
        
        public function get_informasi_by_jenis($bulan, $tahun, $informasi){
            $this->db->select("*");
            $this->db->from("peserta");
            $this->db->where("info", $informasi);
            $this->db->where("MONTH(tgl_masuk)", $bulan);
            $this->db->where("YEAR(tgl_masuk)", $tahun);
            return $this->db->get()->result_array();
        }

        public function get_informasi_between_by_jenis($where, $informasi){
            $this->db->select("*");
            $this->db->from("peserta");
            $this->db->where("info", $informasi);
            // $this->db->where("MONTH(tgl_masuk)", $bulan);
            // $this->db->where("YEAR(tgl_masuk)", $tahun);
            $this->db->where($where);
            return $this->db->get()->result_array();
        }
        
        public function get_informasi_lainnya_by_periode($bulan, $tahun){
            $informasi = array("Teman", "Media Elektronik", "Spanduk", "Civitas Tar-Q", "Brosur", "Peserta", "Event");
            $this->db->select("*");
            $this->db->from("peserta");
            $this->db->where("MONTH(tgl_masuk)", $bulan);
            $this->db->where("YEAR(tgl_masuk)", $tahun);
            $this->db->where_not_in("info", $informasi);
            // $this->db->group_by("info");
            return $this->db->get()->result_array();
        }
        
        public function get_informasi_lainnya_between($where){
            $informasi = array("Teman", "Media Elektronik", "Spanduk", "Civitas Tar-Q", "Brosur", "Peserta", "Event");
            $this->db->select("*");
            $this->db->from("peserta");
            // $this->db->where("MONTH(tgl_masuk)", $bulan);
            // $this->db->where("YEAR(tgl_masuk)", $tahun);
            $this->db->where($where);
            $this->db->where_not_in("info", $informasi);
            // $this->db->group_by("info");
            return $this->db->get()->result_array();
        }
        
        public function get_program_by_periode($bulan, $tahun){
            $this->db->select("program");
            $this->db->from("peserta as a");
            $this->db->from("program as b", "a.program=b.nama_program");
            $this->db->where("MONTH(tgl_masuk)", $bulan);
            $this->db->where("YEAR(tgl_masuk)", $tahun);
            $this->db->group_by("program");
            return $this->db->get()->result_array();
        }
        
        public function get_program_between($where){
            $this->db->select("program");
            $this->db->from("peserta as a");
            $this->db->from("program as b", "a.program=b.nama_program");
            // $this->db->where("MONTH(tgl_masuk)", $bulan);
            // $this->db->where("YEAR(tgl_masuk)", $tahun);
            $this->db->where($where);
            $this->db->group_by("program");
            return $this->db->get()->result_array();
        }
        
        public function get_peserta_by_periode_by_program($bulan, $tahun, $program){
            $this->db->from("peserta");
            $this->db->where("MONTH(tgl_masuk)", $bulan);
            $this->db->where("YEAR(tgl_masuk)", $tahun);
            $this->db->where("program", $program);
            return $this->db->get()->result_array();
        }
        
        public function get_peserta_between_by_program($where, $program){
            $this->db->from("peserta");
            // $this->db->where("MONTH(tgl_masuk)", $bulan);
            // $this->db->where("YEAR(tgl_masuk)", $tahun);
            $this->db->where($where);
            $this->db->where("program", $program);
            return $this->db->get()->result_array();
        }
            
        public function get_pekerjaan_lain_by_periode($bulan, $tahun){
            $pekerjaan = array("Pelajar", "Mahasiswa", "Swasta", "PNS/BUMN", "TNI/POLRI");
            $this->db->select("pekerjaan, count(a.id_peserta) as peserta");
            $this->db->from("peserta as a");
            $this->db->join("pekerjaan as b", "a.id_peserta = b.id_peserta");
            $this->db->where("MONTH(tgl_masuk)", $bulan);
            $this->db->where("YEAR(tgl_masuk)", $tahun);
            $this->db->where_not_in("pekerjaan", $pekerjaan);
            $this->db->group_by("pekerjaan");
            return $this->db->get()->result_array();
        }

        public function get_informasi_lain_by_periode($bulan, $tahun){
            $informasi = array("Teman", "Media Elektronik", "Spanduk", "Civitas Tar-Q", "Brosur", "Peserta", "Event");
            $this->db->select("nama_kpq, count(a.id_peserta) as peserta");
            $this->db->from("peserta as a");
            $this->db->join("kpq as b", "a.info = b.nip");
            $this->db->where("MONTH(a.tgl_masuk)", $bulan);
            $this->db->where("YEAR(a.tgl_masuk)", $tahun);
            $this->db->group_by("nip");
            return $this->db->get()->result_array();
        }
    // get by
}