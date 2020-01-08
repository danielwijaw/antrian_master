<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'libraries/API_Controller.php';

class Admin extends API_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        $cookie = get_cookie("cookielogin");
        if($cookie==null){
            redirect('/');
        }else{
            return true;
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
            'root_data' => '/admin/administrator/'.$url
        ];
		$this->load->view('admin/index', $data);
    }

    // Ajax
    public function administrator($url){
        $this->load->view('admin/'.$url);
    }
    
    // Ajax
    public function sidebar(){
        $this->load->view('admin/sidebar');
    }
    
    // Ajax
    public function topbar(){
        $this->load->view('admin/topbar');
    }
}
