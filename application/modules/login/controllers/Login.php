<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    var $template = "home_page";
    public function __construct(){
		parent:: __construct();
		$this->load->model("M_login","loginmodel");
        $this->load->library('recaptcha');
	}
	
    Public function index(){
    	$data['page'] = "login";
		$data['code'] = $this->recaptcha->getScriptTag();
		$data['recaptcha'] = $this->recaptcha->getWidget();
		$this->load->view($this->template,$data);
    }
    public function loginAkun(){
        $this->form_validation->set_rules('username', 'Username', 'required|max_length[50]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
			redirect('login/');
		}
        else{
			
				$level = array("ukm","admin","akun");
				foreach($level as $row){
					$where_CEK = array(
						"USERNAME" => getUsername($this->input->post("username"),$row),
						"PASSWORD" => acakPass($this->input->post("password"))
					);
					$cek = $this->loginmodel->tampilData("mp_user", "*", $where_CEK,TRUE);
					if($cek){
						$level = $cek->ID_LEVEL;
						if($level == 1){
							$idakun2 = $cek->ID_USER;					    
							 $data = array("id_akun_admin" => $idakun2,"admin"=>TRUE);
							 $this->session->set_userdata($data);
							 redirect('admin_controller/');
							
						}
					    elseif($level == 2){
							$idakun2 = $cek->ID_USER;					    
							 $data = array("id_akun_ukm" => $idakun2,"ukm"=>TRUE);
							 $this->session->set_userdata($data);
							 redirect('ukm_info/');
							
						}
						elseif($level == 3){
							$idakun2 = $cek->ID_USER;					    
							$id_auth = $cek->ID_AUTH;					    
							$data = array("id_akun_user" => $idakun2,"user"=>TRUE,"id_akun_auth"=>$id_auth);
							$this->session->set_userdata($data);
							redirect('user_profil/');
						}
						else{
								$this->session->set_flashdata('notif', '<i class="fa fa-times"></i> Username dan password salah !');
								$this->session->set_flashdata('clr', 'danger');
								redirect('login/');
						}
					}
				}
				$this->session->set_flashdata('notif', '<i class="fa fa-times"></i> Username dan password salah !');
				$this->session->set_flashdata('clr', 'danger');
				redirect('login/');
				
		   
            }
    }
    public function lupaPassword(){
    	$data['page'] = "login-lupapassword";
		$this->load->view($this->template,$data);
    }
    
    function kirimEmailPass(){
    	$sesi_random = rand(0,99999);
    	$this->session->set_userdata(array('sesi_random' => $sesi_random)); 
		$ses_rand = base64_encode_fix($this->session->userdata('sesi_random'));
		$email = $this->input->post('email');
		$email_encrypt = base64_encode_fix($email);
		$cek_email = $this->db->query('SELECT * FROM mp_akun WHERE EMAIL="'.$email.'"')->row();
		if(count($cek_email) > 0 ){
			$this->load->library('email');
			$config = array(  "mailtype" => "html");
			$this->email->initialize($config);
			$this->email->from('indobaba.online@gmail.com', 'INDOBABA');
			$this->email->to($email);
			$this->email->cc('indobaba.online@gmail.com');
			$this->email->bcc('indobaba.online@gmail.com');
			$this->email->subject('Lupa Password');
			$this->email->message("Silahkan klik link berikut untuk reset password <a href='".base_url('login/resetPassword/'.$email_encrypt.'/'.$ses_rand)."'>klik disini.</a>");
			$this->email->send();
			$this->session->set_flashdata('notif', 'Kami telah mengirim link reset password pada email Anda. Jika tidak ada pada kotak masuk cek spam');
			$this->session->set_flashdata('clr', 'info');
			redirect('login/kirimSukses');
		}
		else{
			$this->session->set_flashdata('notif', 'Email tidak terdaftar pada database kami.');
			$this->session->set_flashdata('clr', 'info');
			redirect('login/lupaPassword');
		}
	}
	
	function kirimSukses(){
		if($this->session->userdata('sesi_random')){
			$data['page'] = "sukses-email";
			$this->load->view($this->template,$data);
		}
		else{
			redirect('login');
		}
    }
	
	function resetPassword($email, $sesi_random){
		$email = base64_decode_fix($email);
		$sesi_random = base64_decode_fix($sesi_random);
		if($this->session->userdata('sesi_random') == $sesi_random){
			$cek_email = $this->db->query("SELECT * FROM mp_akun WHERE EMAIL='$email'")->row();
			$id_auth = $this->db->query("SELECT * FROM mp_user WHERE ID_AUTH='$cek_email->ID_AKUN' AND ID_LEVEL='3'")->row();
			$this->session->set_userdata(array('id_pass_ses' => $id_auth->ID_USER,'id_email_ses'=> $email));
			$data['page'] = 'reset-password';
			$this->load->view($this->template,$data);
		}
		else{
			redirect('login');
		}
	}
	
	function resetPasswordSubmit(){
		if($this->session->userdata('id_pass_ses')){
			$id = $this->session->userdata('id_pass_ses');
			$email = base64_encode_fix($this->session->userdata('id_email_ses'));
			$h_email = $this->session->userdata('id_email_ses');
			$sesi_random = base64_encode_fix($this->session->userdata('sesi_random'));
			$pass_baru = $this->input->post('pass_bar');
			$pass_bar_con = $this->input->post('pass_bar_con');
			if($pass_baru != $pass_bar_con){
				$this->session->set_flashdata('notif', 'Password yang Anda masukkan tidak sama');
				$this->session->set_flashdata('clr', 'info');
				redirect('login/resetPassword/'.$email.'/'.$sesi_random);
				exit();
			}
			$pas_acak = acakPass($pass_baru);
			$data = array(
				"PASSWORD" => $pas_acak
			);
			$where = array(
				"ID_USER" => $id
			);
			// Login otomatis
			$id_akun_auth = $this->db->query("SELECT * FROM mp_akun WHERE EMAIL='$h_email'")->row();
			$data_login = array("id_akun_user" => $id,"user"=>TRUE,"id_akun_auth"=>$id_akun_auth->ID_AKUN);
			$this->session->set_userdata($data_login);
			$sql = $this->loginmodel->editData($data,'mp_user',$where);
			if($sql){
				$this->session->unset_userdata(array('id_email_ses','sesi_random','id_pass_ses'));
				$this->session->set_flashdata('notif', 'Password Anda berhasil diganti');
				$this->session->set_flashdata('clr', 'info');
				redirect('user_profil');
			}
		}
		else{
			echo "false";
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
			if($status['success']){
				
				return true;
			  }     
			else
			  {
			     //$this->session->set_flashdata('recaptcha', 'incorrect captcha');
			      $this->form_validation->set_message('cekRecaptcha', 'The {field} must verified');
			    return false;
			  }
	       
	      
		
	}
   
    public function logout_user(){
		
		$this->session->unset_userdata(array("id_akun_user","user"));
		$this->session->set_flashdata('notif', '<i class="fa fa-check"></i> Logout sukses');
		$this->session->set_flashdata('clr', 'info');
		redirect('login/');
	}
	
	 public function logout_admin(){
		$this->session->unset_userdata(array("id_akun_admin","admin","menu_admin"));
		$this->session->unset_userdata(array('id_email_ses','sesi_random','id_pass_ses'));
		$this->session->set_flashdata('notif', '<i class="fa fa-check"></i> Logout sukses');
		$this->session->set_flashdata('clr', 'info');
		redirect('login/');
	}
	 public function logout_ukm(){
		$this->session->unset_userdata(array("id_akun_ukm","ukm"));
		$this->session->set_flashdata('notif', '<i class="fa fa-check"></i> Logout sukses');
		$this->session->set_flashdata('clr', 'info');
		redirect('login/');
	}
    
}