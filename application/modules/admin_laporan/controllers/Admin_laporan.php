<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_laporan extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->cekLogin();
    }
	
	public function index(){
		$this->load->view('welcome_message');
	}
}
