<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_laporan extends CI_Controller {
	public function index()
	{
		$this->load->view('welcome_message');
	}
}