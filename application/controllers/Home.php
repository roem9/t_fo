<?php
class Home extends CI_CONTROLLER{
    public function __construct(){
        parent::__construct();
        $this->load->model('Fo_model');

        if($this->session->userdata('status') != "login"){
            $this->session->set_flashdata('login', 'Maaf, Anda harus login terlebih dahulu');
			redirect(base_url("login"));
		}
    }

    public function index($periode = 0){
        if($_GET){
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
        } else {
            $bulan = date('n');
            $tahun = date('Y');
        }

        $data['header'] = 'Home';
        $data['title'] = 'Home';
        $data['bulan'] = [ 
            ["id" => "1","bulan" => "Januari"], ["id" => "2","bulan" => "Februari"], ["id" => "3","bulan" => "Maret"], ["id" => "4","bulan" => "April"], ["id" => "5","bulan" => "Mei"], ["id" => "6","bulan" => "Juni"], ["id" => "7","bulan" => "Juli"], ["id" => "8","bulan" => "Agustus"], ["id" => "9","bulan" => "September"], ["id" => "10","bulan" => "Oktober"], ["id" => "11","bulan" => "November"], ["id" => "12","bulan" => "Desember"]
        ];
        $data['month'] = $bulan;
        $data['year'] = $tahun;
        
        $where = ["MONTH(tgl_masuk)" => $bulan, "YEAR(tgl_masuk)" => $tahun, "jk" => "Wanita"];
        $data['peserta']['wanita'] = COUNT($this->Fo_model->get_all("peserta", $where));

        $where = ["MONTH(tgl_masuk)" => $bulan, "YEAR(tgl_masuk)" => $tahun, "jk" => "Pria"];
        $data['peserta']['pria'] = COUNT($this->Fo_model->get_all("peserta", $where));
        
        $where = ["MONTH(tgl_masuk)" => $bulan, "YEAR(tgl_masuk)"];
        $pendidikan = $this->Fo_model->get_all_group_by("peserta", $where, "pendidikan");
        $data['pendidikan'] = [];
        foreach ($pendidikan as $key => $pendidikan) {
            $data['pendidikan'][$key] = $pendidikan;
            $where = ["MONTH(tgl_masuk)" => $bulan, "YEAR(tgl_masuk)" => $tahun, "pendidikan" => $pendidikan['pendidikan']];
            $data['pendidikan'][$key]['peserta'] = COUNT($this->Fo_model->get_all("peserta", $where));
        }
        
        $pekerjaan = $this->Fo_model->get_pekerjaan_by_periode($bulan, $tahun);
        $data['pekerjaan'] = [];
        foreach ($pekerjaan as $key => $pekerjaan) {
            $data['pekerjaan'][$key] = $pekerjaan;
            $data['pekerjaan'][$key]['peserta'] = COUNT($this->Fo_model->get_peserta_by_periode_by_pekerjaan($bulan, $tahun, $pekerjaan['pekerjaan']));
        }

        $data['pekerjaan_lainnya'] = COUNT($this->Fo_model->get_pekerjaan_lainnya_by_periode($bulan, $tahun));
        
        $informasi = $this->Fo_model->get_informasi_by_periode($bulan, $tahun);
        $data['informasi'] = [];
        foreach ($informasi as $key => $informasi) {
            $data['informasi'][$key] = $informasi;
            $data['informasi'][$key]['peserta'] = COUNT($this->Fo_model->get_informasi_by_jenis($bulan, $tahun, $informasi['info']));
        }

        $data['informasi_lainnya'] = COUNT($this->Fo_model->get_informasi_lainnya_by_periode($bulan, $tahun));
        
        $program = $this->Fo_model->get_program_by_periode($bulan, $tahun);
        $data['program'] = [];
        foreach ($program as $key => $program) {
            $data['program'][$key] = $program;
            $data['program'][$key]['peserta'] = COUNT($this->Fo_model->get_peserta_by_periode_by_program($bulan, $tahun, $program['program']));
        }
        
        $data['peserta']['total'] = $data['peserta']['wanita'] + $data['peserta']['pria'];
        $data['kelas'] = COUNT($this->Fo_model->get_kelas_by_periode($bulan, $tahun));

        $data['peserta_reguler'] = COUNT($this->Fo_model->get_peserta_by_periode_by_tipe($bulan, $tahun, "reguler"));
        $data['peserta_pv_khusus'] = COUNT($this->Fo_model->get_peserta_by_periode_by_tipe($bulan, $tahun, "pv khusus"));
        $data['peserta_pv_luar'] = COUNT($this->Fo_model->get_peserta_by_periode_by_tipe($bulan, $tahun, "pv luar"));
        
        $data['kelas_pv_khusus'] = COUNT($this->Fo_model->get_kelas_by_periode_by_type($bulan, $tahun, "pv khusus"));
        $data['kelas_pv_luar'] = COUNT($this->Fo_model->get_kelas_by_periode_by_type($bulan, $tahun, "pv luar"));
        $data['kelas_reguler'] = COUNT($this->Fo_model->get_kelas_by_periode_by_type($bulan, $tahun, "reguler"));
        
        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar");
        $this->load->view("modal/modal_lainnya_pekerjaan");
        $this->load->view("modal/modal_lainnya_informasi");
        $this->load->view("home/index", $data);
        $this->load->view("templates/footer");
    }

    public function get_pekerjaan_lain_by_periode(){
        $bulan = $this->input->post("bulan");
        $tahun = $this->input->post("tahun");
        $pekerjaan = $this->Fo_model->get_pekerjaan_lain_by_periode($bulan, $tahun);
        echo json_encode($pekerjaan);
    }
    
    public function get_informasi_lain_by_periode(){
        $bulan = $this->input->post("bulan");
        $tahun = $this->input->post("tahun");
        $pekerjaan = $this->Fo_model->get_informasi_lain_by_periode($bulan, $tahun);
        echo json_encode($pekerjaan);
    }
}