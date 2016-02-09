<?php
	class MY_Controller extends CI_Controller{
		
	}
	class MY_Admin extends MY_Controller{
		
		public function __construct(){
			parent:: __construct();
			if($this->session->userdata("admin") == FALSE){
				redirect("login/");
			}
			
		}
	}
	class MY_Ukm extends MY_Controller{
		
		public function __construct(){
			parent:: __construct();
			if($this->session->userdata("ukm") == FALSE ){
				redirect("login/");
			}
			
		}
	}
	class MY_User extends MY_Controller{
		
		public function __construct(){
			parent:: __construct();
			if($this->session->userdata("user") == FALSE ){
				redirect("login/");
			}
			
		}
	}
	
?>