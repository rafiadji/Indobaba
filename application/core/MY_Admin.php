<?php
	class MY_Admin extends CI_Controller{
		public function __construct(){
			parent:: __construct();
			if($this->session->userdata("id_akun_admin") == "" ){
				redirect("login/");
			}
			
		}
	}
?>