<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'libraries/API_Controller.php';

class Welcome extends API_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function sample()
	{
		header("Access-Control-Allow-Origin: *");

		// API Configuration
		$this->_apiConfig([
			/**
			 * By Default Request Method `GET`
			 */
			'methods' => ['GET'], // 'GET', 'OPTIONS'

			/**
			 * Number limit, type limit, time limit (last minute)
			 */
			// 'limit' => [1000, 'ip', 'everyday'],

			/**
			 * type :: ['header', 'get', 'post']
			 * key  :: ['table : Check Key in Database', 'key']
			 */
			// 'key' => ['GET', 'string_key' ], // type, {key}|table (by default)
		]);

		// return data
		$this->api_return(
			[
				'status' => true,
				"result" => "Return API Response",
			],
		200);
	}
}
