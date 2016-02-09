<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_alamat extends MY_User {
	var $template = "home_page";
	function __construct(){
		parent::__construct();
		$this->load->model("M_user_alamat","alamatmodel");
		
	}
	public function index()
	{
		$id_akun =  $this->session->userdata("id_akun_user");
		$data['page'] = "alamat";
        $data['tampil'] = $this->alamatmodel->tampilData("mp_alamat","*",array("ID_AKUN" => $id_akun));
        
		$this->load->view($this->template,$data);
	}
    public Function tambahAlamat(){
        $id_akun =  $this->session->userdata("id_akun_user");
        $data['tampilprov'] = $this->alamatmodel->tampilData("mp_provinsi", NULL);
		$data['page'] = "alamat-tambah";
		if($this->input->post("simpan") == TRUE){
			$this->form_validation->set_rules("provinsi","Provinsi","required");
			$this->form_validation->set_rules("kota","Kota","required");
			$this->form_validation->set_rules("kecamatan","Kecamatan","required");
			$this->form_validation->set_rules("kelurahan","Kelurahan","required|max_length[50]");
			$this->form_validation->set_rules("alamat","Alamat","required|max_length[50]");
			if($this->form_validation->run() == TRUE){
				$alamat = $this->input->post("alamat")." ".
						  $this->input->post("kelurahan")." ".
						  $this->input->post("kecamatan")." ".
						  $this->input->post("kota")." ".
						  $this->input->post("provinsi");
				$data = array(
					"ID_AKUN" => $id_akun,
					"ALAMAT" => $alamat,
					"STS" => 0
				);
			$this->alamatmodel->tambahData($data ,"mp_alamat");
			$this->session->set_flashdata('notif', "Alamat berhasil ditambahkan");
			$this->session->set_flashdata('clr', 'success');
			redirect("user_alamat/tambahAlamat");
			
			}
			else{
				$this->session->set_flashdata('notif', validation_errors());
				$this->session->set_flashdata('clr', 'danger');
				redirect("user_alamat/tambahAlamat");
			}
		}
        $this->load->view($this->template,$data);
    }
	function editAlamat($id = NULL){
		if($id == NULL){ redirect("404");}
		$id_decode = base64_decode_fix($id);
		$id_akun =  $this->session->userdata("id_akun_user");
        $data['tampilprov'] = $this->alamatmodel->tampilData("mp_provinsi", NULL);
		$data['tampil'] = $this->alamatmodel->tampilData("mp_alamat","*",array("ID_ALAMAT" => $id_akun));
		$data['page'] = "alamat-edit";
		$this->load->view($this->template,$data);
		
	}
    function getKota(){
		$idprov = $_GET['idprov'];
		$where = array(
			"ID_PROVINSI" => $idprov
		);
		$tampilkota = $this->alamatmodel->tampilData("mp_kokab", NULL, $where);
		foreach($tampilkota as $row){
			echo '<option value="'.$row->ID_KOTA.'">'.$row->KOKAB.'</option>';
		}
	}
	function getKecam(){
		$idkota = $_GET['idkota'];
		$where = array(
			"ID_KOTA"=>$idkota
		);
		$tampilkota = $this->alamatmodel->tampilData("mp_kecamatan", NULL, $where);
		foreach($tampilkota as $row){
			echo '<option value="'.$row->ID_KECAMATAN.'">'.$row->KECAMATAN.'</option>';
		}
	}
}