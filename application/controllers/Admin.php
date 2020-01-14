<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'libraries/API_Controller.php';

class Admin extends API_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->helper('api_helper');
        $cookie = get_cookie("cookielogin");
        if($cookie==null){
            redirect('/');
        }else{
            $cookie = JSON_DECODE($cookie, true);
            if($cookie['role_user_access']==my_simple_crypt('0', 'e')){
                return true;
            }else{
                if($this->uri->segment(1)!='call_antrian'){
                    if($this->uri->segment(2)=='antrian'){
                        return true;
                    }else{
                        redirect('/call_antrian/'.$cookie['role_user_access']);
                    }
                }
            }
        }

        
    }

    //  Core Ajax
	public function index()
	{
        $data = [
            'root_data' => '/admin/administrator/admin'
        ];
		$this->load->view('admin/index', $data);
    }

    public function permalink($url)
	{
        $data = [
            'root_data' => '/admin/permalink_view/'.$url
        ];
		$this->load->view('admin/index', $data);
    }

    public function report()
	{
        $data = [
            'root_data' => '/admin/report_view'
        ];
		$this->load->view('admin/index', $data);
    }

    public function create($url)
	{
        $data = [
            'root_data' => '/admin/created/'.$url
        ];
		$this->load->view('admin/index', $data);
    }

    public function edit($url, $id)
	{
        $data = [
            'root_data' => '/admin/edited/'.$url.'/'.$id
        ];
		$this->load->view('admin/index', $data);
    }

    public function call_antrian($id)
	{
        $data = [
            'root_data' => '/admin/antrian/'.$id
        ];
		$this->load->view('antrian/index', $data);
    }

    // Ajax
    public function administrator($url){
        $this->load->view('admin/'.$url);
    }

    public function permalink_view($url){
        $this->load->view('admin/permalink');
    }
    
    public function sidebar(){
        $this->load->view('admin/sidebar');
    }
    
    public function topbar(){
        $this->load->view('admin/topbar');
    }
    
    public function report_view(){
        $this->load->view('admin/report');
    }

    public function created($url){
        $this->load->view('admin/create');
    }

    public function edited($url, $id){
        $this->load->view('admin/edit');
    }

    public function antrian($url){
        $this->load->view('admin/call_poli');
    }

    public function report_excel($date, $jenis){
        $this->load->view('admin/report_excel');
    }
}
