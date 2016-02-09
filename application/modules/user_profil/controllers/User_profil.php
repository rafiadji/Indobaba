<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_profil extends MY_User {
	var $template = "home_page";
	var $template_user = "user_page";
	function __construct(){
		parent::__construct();
		$this->load->model("M_user_profil","profilmodel");
	}

	public function index(){
		$id_akun =  $this->session->userdata("id_akun_user");
		$where = array(
			"ID_USER" => $id_akun
		);
		$akun = $this->profilmodel->tampilData("mp_user","*",$where,TRUE);
		$wheret = array(
			"USERNAME" => $akun->USERNAME	
		);
		$data['tampil'] = $this->profilmodel->tampilData("mp_akun", "*", $wheret);
		$data['page_user'] = "profile";
		$data['page'] = $this->template_user;
		$data['tampilprov'] = $this->profilmodel->tampilData("mp_provinsi", NULL);
		$this->load->view($this->template,$data);
	}

	public function gantipassword(){
		//$data['judul'] = "Ganti Password";
		$data['page_user'] = "profile-gantipassword";
		$data['page'] = $this->template_user;
		$this->load->view($this->template,$data);
	}

	public function gantipasswordUpdate(){
		if($this->input->post("simpan") == TRUE){
				$this->form_validation->set_rules("passlama","Password Lama","required|callback_cekpasswordlama");
				$this->form_validation->set_rules("passbaru","Password Baru","required");
				$this->form_validation->set_rules("passbaruulangi","Password Baru Ulangi","required|matches[passbaru]");
				if($this->form_validation->run() == TRUE){
						$id_akun =  $this->session->userdata("id_akun_user");
						$data = array(
							"PASSWORD" => acakPass($this->input->post("passbaru"))
						);
						$where = array(
							"ID_USER" => $id_akun 	
						);
						$this->profilmodel->editData($data ,"mp_user",$where );
						$this->session->set_flashdata('notif', "Password berhasil di ubah");
						$this->session->set_flashdata('clr', 'success');
						redirect("user_profil/gantipassword");
				}
				else{
						$this->session->set_flashdata('notif', validation_errors());
						$this->session->set_flashdata('clr', 'danger');
						redirect("user_profil/gantipassword");
				}

		}

		else{
				redirect("user_profil/gantipassword");
		}
	}

	public function cekpasswordlama(){
		$id_akun =  $this->session->userdata("id_akun_user");
		$where = array(
			"ID_USER" => $id_akun,	
		);
		$cek = $this->profilmodel->tampilData("mp_user","*",$where,TRUE);
		if($cek->PASSWORD == acakPass($this->input->post("passlama"))){
			return TRUE;
		}
		else{
				$this->form_validation->set_message('cekpasswordlama', 'Password lama anda salah');
				return FALSE;
		}
	}
	
	public function update(){
		if($this->input->post("simpan") == TRUE){
				$this->form_validation->set_rules("nama","Nama","required|max_length[50]");
				$this->form_validation->set_rules("alamat","Alamat","required");
				$this->form_validation->set_rules("kelurahan","Kelurahan","required|max_length[50]");
				$this->form_validation->set_rules("hp","NO Hp","required|max_length[12]|numeric");
				$this->form_validation->set_rules("email","Email","required|max_length[50]|valid_email");
				$this->form_validation->set_rules("provinsi","Provinsi","required");
				$this->form_validation->set_rules("kota","Kota","required");
				$this->form_validation->set_rules("kecamatan","Kecamatan","required");
				if($this->form_validation->run() == TRUE){
				$data = array(
						"NAMA" => $this->input->post("nama"),
						"ALAMAT" => $this->input->post("alamat"),
						"ID_PROVINSI" =>  $this->input->post("provinsi"),
						"ID_KABUPATEN" =>  $this->input->post("kota"),
						"ID_KECAMATAN" =>  $this->input->post("kecamatan"),
						"KELUHARAN" => $this->input->post("kelurahan"),
						"NO_HP" => $this->input->post("hp"),
						"EMAIL" => $this->input->post("email")
				);
				$id_akun =  $this->session->userdata("id_akun_user");
				$whereE = array(
						"ID_USER" => $id_akun
				);
				$akun = $this->profilmodel->tampilData("mp_user","*",$whereE,TRUE);
				$where = array(
					"USERNAME" => $akun->USERNAME
				);
				$this->profilmodel->editData($data , "mp_akun",$where);
				$this->session->set_flashdata('notif', "Data berhasil di ubah");
				$this->session->set_flashdata('clr', 'success');
				redirect("user_profil");
				}
				else{
						$this->session->set_flashdata('notif',validation_errors());
						$this->session->set_flashdata('clr', 'danger');
						redirect("user_profil");
				}
		}

		else{
			redirect("user_profil");
		}
	}

	function getKota(){
		$idprov = $_GET['idprov'];
		$where = array(
			"ID_PROVINSI" => $idprov
		);
		$tampilkota = $this->profilmodel->tampilData("mp_kokab", NULL, $where);
		foreach($tampilkota as $row){
			echo '<option value="'.$row->ID_KOTA.'">'.$row->KOKAB.'</option>';
		}
	}
	function getKecam(){
		$idkota = $_GET['idkota'];
		$where = array(
			"ID_KOTA"=>$idkota
		);
		$tampilkota = $this->profilmodel->tampilData("mp_kecamatan", NULL, $where);
		foreach($tampilkota as $row){
			echo '<option value="'.$row->ID_KECAMATAN.'">'.$row->KECAMATAN.'</option>';
		}
	}
	function getupdateKota(){
		$idprov = $_GET['idprov'];
		$idkota =  $_GET['idkota'];
		$where = array(
			"ID_PROVINSI" => $idprov
		);
		$tampilkota = $this->profilmodel->tampilData("mp_kokab", NULL, $where);
		foreach($tampilkota as $roww){
			$this->profilmodel->tt($roww->ID_KOTA,$idkota,$roww->KOKAB);
		}
	}
	function getupdateKecam(){
		$idkota = $_GET['idkota'];
		$idkecam = $_GET['idkecam'];
		$where = array(
			"ID_KOTA"=>$idkota
		);
		$tampilkota = $this->profilmodel->tampilData("mp_kecamatan", NULL, $where);
		foreach($tampilkota as $roww){
			//echo "<option value=$roww->ID_KECAMATAN>$roww->KECAMATAN</option>";
			$this->profilmodel->yy($roww->ID_KECAMATAN,$idkecam,$roww->KECAMATAN);
		}
	}
	function updatefoto(){
		if($this->input->post("upload") == TRUE){
				if($_FILES['userfile']['name'] != ""){
					$this->profilmodel->hapusfoto();
					$config['upload_path']          = '././assets/images/user/';
					$config['allowed_types'] = 'jpg|jpeg|png|gif|bmp';
					$config['max_size'] = '1024';
					$config['overwrite'] = TRUE;
					$this->load->library('upload', $config);
					if ( ! $this->upload->do_upload('userfile'))
					{
						$this->session->set_flashdata('notif', 'maaf foto tidak bisa diupload, ulangi lagi');
						$this->session->set_flashdata('clr', 'warning');
						redirect('user_profil/');
					}
					else
					{
					   $uploaddata = $this->upload->data();
					   $data = array(
								"FT_PROFIL" => $uploaddata['file_name']
							   );
							   $where = array(
									"USERNAME" => $this->profilmodel->idakun()
							   );
					   $this->profilmodel->editData($data,"mp_akun" ,$where);
					   $this->session->set_flashdata('notif', 'Foto profil berhasil di ubah!');
					   $this->session->set_flashdata('clr', 'success');
					   redirect('user_profil/');
					}
				}
				else{
				    $this->session->set_flashdata('notif', 'maaf anda belum memilih gambar.');
					$this->session->set_flashdata('clr', 'warning');
					redirect('user_profil/');
				}
				
		}
		else{
			redirect("user_profil");
		}
	}

}



?>