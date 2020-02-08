<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'libraries/API_Controller.php';

class Frontend extends API_Controller {

    //  Core Ajax
	public function index()
	{
        $data = [
            'root_data' => '/frontend/antrian'
        ];
		$this->load->view('antrian/index', $data);
    }
    
    public function pasien(){
        $data = [
            'root_data' => '/frontend/patient'
        ];
		$this->load->view('antrian/index', $data);
    }
    
    public function display(){
        $data = [
            'root_data' => '/frontend/display_all'
        ];
		$this->load->view('antrian/index', $data);
    }
    
    public function display_poli($id){
        $data = [
            'root_data' => '/frontend/display_poli_by_id/'.$id
        ];
		$this->load->view('antrian/index', $data);
    }
    
    public function antrian_data(){
        $data = [
            'root_data' => '/frontend/antrian_data_view'
        ];
		$this->load->view('antrian/index', $data);
    }
    
    public function dokter_cuti(){
        $data = [
            'root_data' => '/frontend/dokter_cuti_view'
        ];
		$this->load->view('antrian/index', $data);
    }
    
    public function jadwal_dokter(){
        $data = [
            'root_data' => '/frontend/jadwal_dokter_view'
        ];
		$this->load->view('antrian/index', $data);
    }

	public function blank_404()
	{
		$this->load->view('404');
    }

	public function login()
	{
        $this->load->helper('cookie');
        $cookie = get_cookie("cookielogin");
        if($cookie==null){
            $this->load->view('login');
        }else{
            redirect('/admin');
        }
    }
    
    // Ajax
    public function antrian(){
        $this->load->helper('cookie');
        $this->load->view('antrian/antrian');
    }
    
    public function patient(){
        $this->load->view('antrian/patient');
    }
    
    public function dokumentasi(){
        $this->load->view('antrian/dokumentasi');
    }
    
    public function display_all(){
        $this->load->view('antrian/display');
    }
    
    public function display_poli_by_id($id){
        $this->load->view('antrian/display_poli');
    }
    
    public function antrian_data_view(){
        $this->load->helper('cookie');
        $this->load->view('antrian/antrian_data');
    }
    
    public function cetakantrian(){
        $this->load->helper('cookie');
        $this->load->view('antrian/cetakantrian');
    }
    
    public function dokter_cuti_view(){
        $this->load->view('antrian/cuti');
    }
    
    public function jadwal_dokter_view(){
        $this->load->view('antrian/jadwal');
    }
}
