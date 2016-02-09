<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ukm_kurir extends MY_Ukm {

	function __construct(){
		parent::__construct();
		$this->cekLogin();
    }
	
	public function index(){
		$this->load->view('welcome_message');
	}
}
