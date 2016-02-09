<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_controller extends MY_Admin {
	var $template = 'admin_page';
	function __construct(){
		parent::__construct();
		$this->session->set_userdata(array("menu_admin" => "dashboard"));
    }
	
	function index(){
		$data['judul_page'] = 'Dashboard';
		$data['des_page'] = '';
		$data['page'] = 'admin/dashboard';
		$this->load->view($this->template,$data);
	}
}