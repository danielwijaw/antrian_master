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
            'root_data' => '/admin/permalink_view/'.$url
        ];
		$this->load->view('admin/index', $data);
    }

    public function setting()
	{
        $data = [
            'root_data' => '/admin/setting_app'
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
    
    public function setting_app(){
        $this->load->view('admin/setting_app');
    }

    public function created($url){
        $this->load->view('admin/create');
    }

    public function edited($url, $id){
        $this->load->view('admin/edit');
    }
}
