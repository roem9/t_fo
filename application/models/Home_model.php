<?php
class Home_model extends CI_MODEL{
    public function getProgram($bulan, $tahun){
        $this->db->select("program");
        $this->db->from("peserta as a");
        $this->db->from("program as b", "a.program=b.nama_program");
        $this->db->where("MONTH(tgl_masuk)", $bulan);
        $this->db->where("YEAR(tgl_masuk)", $tahun);
        $this->db->group_by("program");
        return $this->db->get()->result_array();
    }

    public function pesertaJk($bulan, $tahun, $jk){
        $this->db->select("*");
        $this->db->from("peserta");
        $this->db->where("jk", $jk);
        $this->db->where("MONTH(tgl_masuk)", $bulan);
        $this->db->where("YEAR(tgl_masuk)", $tahun);
        return $this->db->get()->result_array();
    }
    
    public function getPendidikan($bulan, $tahun){
        $this->db->select("pendidikan");
        $this->db->from("peserta");
        $this->db->where("MONTH(tgl_masuk)", $bulan);
        $this->db->where("YEAR(tgl_masuk)", $tahun);
        $this->db->group_by("pendidikan");
        return $this->db->get()->result_array();
    }

    public function pendidikan($bulan, $tahun, $pendidikan){
        $this->db->select("*");
        $this->db->from("peserta");
        $this->db->where("pendidikan", $pendidikan);
        $this->db->where("MONTH(tgl_masuk)", $bulan);
        $this->db->where("YEAR(tgl_masuk)", $tahun);
        return $this->db->get()->result_array();
    }

    public function getPekerjaan($bulan, $tahun){
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

    public function getPekerjaanLainnya($bulan, $tahun){
        $pekerjaan = array("Pelajar", "Mahasiswa", "Swasta", "PNS/BUMN", "TNI/POLRI");

        $this->db->select("*");
        $this->db->from("peserta as a");
        $this->db->join("pekerjaan as b", "a.id_peserta = b.id_peserta");
        $this->db->where("MONTH(tgl_masuk)", $bulan);
        $this->db->where("YEAR(tgl_masuk)", $tahun);
        $this->db->where_not_in("pekerjaan", $pekerjaan);
        // $this->db->group_by("pekerjaan");
        return $this->db->get()->result_array();
    }

    public function pekerjaan($bulan, $tahun, $pekerjaan){
        $this->db->select("*");
        $this->db->from("peserta as a");
        $this->db->join("pekerjaan as b", "a.id_peserta=b.id_peserta");
        $this->db->where("pekerjaan", $pekerjaan);
        $this->db->where("MONTH(tgl_masuk)", $bulan);
        $this->db->where("YEAR(tgl_masuk)", $tahun);
        return $this->db->get()->result_array();
    }

    public function pekerjaanLain(){
        $bulan = $_POST['bulan'];
        $tahun = $_POST['tahun'];
        $pekerjaan = array("Pelajar", "Mahasiswa", "Swasta", "PNS/BUMN", "TNI/POLRI");

        $this->db->select("pekerjaan, count(a.id_peserta) as peserta");
        // $this->db->select("*");
        $this->db->from("peserta as a");
        $this->db->join("pekerjaan as b", "a.id_peserta = b.id_peserta");
        $this->db->where("MONTH(tgl_masuk)", $bulan);
        $this->db->where("YEAR(tgl_masuk)", $tahun);
        $this->db->where_not_in("pekerjaan", $pekerjaan);
        $this->db->group_by("pekerjaan");
        return $this->db->get()->result_array();
    }

    public function getInformasi($bulan, $tahun){
        $informasi = array("Teman", "Media Elektronik", "Spanduk", "Civitas Tar-Q", "Brosur", "Peserta", "Event");

        $this->db->select("info");
        $this->db->from("peserta");
        $this->db->where("MONTH(tgl_masuk)", $bulan);
        $this->db->where("YEAR(tgl_masuk)", $tahun);
        $this->db->where_in("info", $informasi);
        $this->db->group_by("info");
        return $this->db->get()->result_array();
    }

    public function getInformasiLainnya($bulan, $tahun){
        $informasi = array("Teman", "Media Elektronik", "Spanduk", "Civitas Tar-Q", "Brosur", "Peserta", "Event");

        $this->db->select("*");
        $this->db->from("peserta");
        $this->db->where("MONTH(tgl_masuk)", $bulan);
        $this->db->where("YEAR(tgl_masuk)", $tahun);
        $this->db->where_not_in("info", $informasi);
        // $this->db->group_by("info");
        return $this->db->get()->result_array();
    }

    public function informasi($bulan, $tahun, $informasi){
        $this->db->select("*");
        $this->db->from("peserta");
        $this->db->where("info", $informasi);
        $this->db->where("MONTH(tgl_masuk)", $bulan);
        $this->db->where("YEAR(tgl_masuk)", $tahun);
        return $this->db->get()->result_array();
    }

    public function informasiLain(){
        $bulan = $_POST['bulan'];
        $tahun = $_POST['tahun'];
        $informasi = array("Teman", "Media Elektronik", "Spanduk", "Civitas Tar-Q", "Brosur", "Peserta", "Event");

        $this->db->select("nama_kpq, count(a.id_peserta) as peserta");
        // $this->db->select("*");
        $this->db->from("peserta as a");
        $this->db->join("kpq as b", "a.info = b.nip");
        $this->db->where("MONTH(a.tgl_masuk)", $bulan);
        $this->db->where("YEAR(a.tgl_masuk)", $tahun);
        // $this->db->where_not_in("info", $informasi);
        $this->db->group_by("nip");
        return $this->db->get()->result_array();
    }

    public function jumlahKelas($bulan, $tahun){
        $this->db->select("*");
        $this->db->from("kelas");
        $this->db->where("MONTH(tgl_mulai)", $bulan);
        $this->db->where("YEAR(tgl_mulai)", $tahun);
        return $this->db->get()->result_array();
    }

    public function pesertaProgram($bulan, $tahun, $program){
        $this->db->select("*");
        $this->db->from("peserta");
        $this->db->where("MONTH(tgl_masuk)", $bulan);
        $this->db->where("YEAR(tgl_masuk)", $tahun);
        $this->db->where("program", $program);
        return $this->db->get()->result_array();
    }
    
    public function pesertaByTipe($bulan, $tahun, $tipe){
        $this->db->from("peserta");
        $this->db->where("MONTH(tgl_masuk)", $bulan);
        $this->db->where("YEAR(tgl_masuk)", $tahun);
        $this->db->where("tipe_peserta", $tipe);
        return $this->db->get()->result_array();
    }
    
    public function kelasByTipe($bulan, $tahun, $tipe){
        $this->db->from("kelas");
        $this->db->where("MONTH(tgl_mulai)", $bulan);
        $this->db->where("YEAR(tgl_mulai)", $tahun);
        $this->db->where("tipe_kelas", $tipe);
        return $this->db->get()->result_array();
    }
}