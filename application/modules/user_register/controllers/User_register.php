<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class User_register extends CI_Controller {

	var $template = "home_page";

	function __construct(){

		parent::__construct();

		$this->load->model("M_user_register","registermodel");

		$this->load->library('recaptcha');

		$this->load->library('email');

	}

	

	function index(){

		//echo acakPass("sasa");

		$data['page'] = "register";

		$data['tampilprov'] = $this->registermodel->tampilData("mp_provinsi", NULL);

		$data['code'] = $this->recaptcha->getScriptTag();

		$data['recaptcha'] = $this->recaptcha->getWidget();

		$this->load->view($this->template,$data);

	}

	function registerSubmit(){

		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[mp_user.USERNAME]|max_length[50]');

		$this->form_validation->set_rules('pass1', 'Password', 'required');

		$this->form_validation->set_rules('pass2', 'Password Confirmation', 'required|matches[pass1]');

		$this->form_validation->set_rules('nama', 'Nama', 'required|max_length[50]');

		
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'callback_cekProvinsi|required');

		$this->form_validation->set_rules('kota', 'Kota', 'callback_cekKota|required');

		$this->form_validation->set_rules('kecamatan', 'Kecamatan', 'callback_cekKecamatan|required');

		
		$this->form_validation->set_rules('email', 'Email', 'required|is_unique[mp_akun.EMAIL]|max_length[50]|valid_email');

		$this->form_validation->set_rules('g-recaptcha-response','Captcha','callback_cekRecaptcha');

		

		if ($this->form_validation->run() == FALSE) {

			$this->session->set_flashdata('notif', validation_errors());

			$this->session->set_flashdata('clr', 'danger');

			redirect('user_register/');

			//echo validation_errors();

		}

		else{

			$akundata = array(

				"NAMA" => $this->input->post("nama"),

				"ALAMAT" => $this->input->post("alamat"),

				"ID_PROVINSI" => $this->input->post("provinsi"),

				"ID_KABUPATEN" => $this->input->post("kota"),

				"ID_KECAMATAN" => $this->input->post("kecamatan"),

				"KELUHARAN" => $this->input->post("kelurahan"),

				"NO_HP" => $this->input->post("hp"),

				"EMAIL" => $this->input->post("email"),

				"STATUS_VALID" => 0,

				"USERNAME" => $this->input->post("username"),

				"FT_PROFIL" => ""

			);

			$this->registermodel->tambahData($akundata, "mp_akun");

			$userdata = array(

				"ID_LEVEL" => 3,

				"USERNAME" => $this->input->post("username"),

				"PASSWORD" => acakPass($this->input->post("pass1")),

				

			);

			$this->registermodel->tambahData($userdata, "mp_user");

			$where = array(

				"USERNAME" => $this->input->post("username")

			);

			$id_akun2 = $this->registermodel->tampilData("mp_akun", "*", $where,TRUE);

			$id_akun = $id_akun2->ID_AKUN;

			$where2 = array(

				"USERNAME" => $this->input->post("username")

			);

			$data2 = array(

				"ID_AUTH" => $id_akun

			);

			$this->registermodel->editData($data2,"mp_user" ,$where2);

			

			$email  = verifikasiEmail($id_akun2->EMAIL);

			$baseurl = base_url();

			

			$config = array(

				   "mailtype" => "html"

				);

			$this->email->initialize($config);

			$this->email->from('info@ukm.com', 'UKM INDOBABA');

			$this->email->to($id_akun2->EMAIL);

			$this->email->cc('info@ukm.com');

			$this->email->bcc('info@ukm.com');

			$this->email->subject('Kode Verivikasi');

			$this->email->message("Register sukses, silahkan klik link berikut<br/><br/><a href='".base_url("user_register/verifikasi/".$id_akun."/".$email)."'>Link verifikasi</a>");

			$this->email->send();

			

			$this->session->set_flashdata('notif', "Link verifikasi berhasil terkirim ke email anda");

			$this->session->set_flashdata('clr', 'success');

			

			redirect('user_register/');

		}


	}

	public function verifikasi($id,$email){

		$where = array(

			"ID_AKUN" => $id

		);

		

		$email_db = $this->registermodel->tampilData("mp_akun", "EMAIL", $where,TRUE);

		if(verifikasiEmail($email_db->EMAIL) == $email){

			$data = array(

				"STATUS_VALID" => 1

			);

			$where_update = array(

				"ID_AKUN" => $id	

			);

			$this->registermodel->editData($data ,"mp_akun",$where_update);

			$this->session->set_flashdata('notif', "Akun telah aktif, silahkan login!");

			$this->session->set_flashdata('clr', 'success');

			

			redirect('login/');

			

		}

		

	}

	public function cekProvinsi(){

		$id = $this->input->post("provinsi");

		if($id == "pilih"){

			$this->form_validation->set_message('cekProvinsi', '{field} belum dipilih');

			return FALSE;

		}

		else{

			return TRUE;

		}

	}

	Public function cekKota(){

		$id = $this->input->post("kota");

		if($id == "pilih"){

			$this->form_validation->set_message('cekKota', '{field} belum dipilih');

			return FALSE;

		}

		else{

			return TRUE;

		}

	}

	Public function cekKecamatan(){

		$id = $this->input->post("kecamatan");

		if($id == "pilih"){

			$this->form_validation->set_message('cekKecamatan', '{field} belum dipilih');

			return FALSE;

		}

		else{

			return TRUE;

		}

	}

	public function cekRecaptcha($str){

			

		   $secret_key="6LfWLQ0TAAAAAL1kZcjDom0K6_qQUtjlcV9KIfEc";

			$ip_user=$this->input->ip_address();

			$url="https://www.google.com/recaptcha/api/siteverify?secret=".$secret_key."&response=".$str."&remoteip=".$ip_user;    

			$user_agent='Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';

			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, $url);

			curl_setopt($ch, CURLOPT_USERAGENT,$user_agent);

			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

			curl_setopt($ch, CURLOPT_TIMEOUT, 10);

			$data = curl_exec($ch);

			curl_close($ch);

			$status= json_decode($data,true);

			if($status['success'])

			 {

				

				return true;

			  }     

			else

			  {

			     //$this->session->set_flashdata('recaptcha', 'incorrect captcha');

			      $this->form_validation->set_message('cekRecaptcha', 'The {field} must verified');

			    return false;

			  }

	       

	      

		

	}

	function getKota(){

		$idprov = $_GET['idprov'];

		$where = array(

			"ID_PROVINSI" => $idprov

		);

		$tampilkota = $this->registermodel->tampilData("mp_kokab", NULL, $where);

		foreach($tampilkota as $row){

			echo '<option value="'.$row->ID_KOTA.'">'.$row->KOKAB.'</option>';

		}

	}

	function getKecam(){

		$idkota = $_GET['idkota'];

		$where = array(

			"ID_KOTA"=>$idkota

		);

		$tampilkota = $this->registermodel->tampilData("mp_kecamatan", NULL, $where);

		foreach($tampilkota as $row){

			echo '<option value="'.$row->ID_KECAMATAN.'">'.$row->KECAMATAN.'</option>';

		}

	}

	

}