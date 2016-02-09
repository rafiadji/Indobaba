<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_rajaongkir extends MY_Admin {

	var $template = 'admin_page';
    function __construct()
	{
		parent::__construct();
		$this->load->model('M_admin_rajaongkir', 'adminrajaongkir');
		//$this->cekLogin();
		$this->session->set_userdata(array('menu_admin' => 'master_api'));
    }

	public function index()
	{
		$data['judul_page'] = 'Data Raja Ongkir';
		$data['des_page'] = '';
		$data['page'] = "api";
		$data['tampil'] = $this->adminrajaongkir->tampilData('mp_rajaongkir');
		$this->load->view($this->template, $data);
	}
	function tambah(){
		$data['judul_page'] = 'Tambah Raja Ongkir';
		$data['des_page'] = 'Tambah Raja Ongkir';
		$data['page'] = "tambah_api";
		$this->load->view($this->template, $data);
		
	}
	function editRajaongkir($id = NULL){
		if($id == NULL){ redirect("404");}
		$id = base64_decode_fix($id);
		//echo $id;exit();
		$data['id'] = $id;
		$data['judul_page'] = 'Edit Raja Ongkir';
		$data['des_page'] = 'Edit Raja Ongkir';
		$data['page'] = "edit_api";
		$data['tampil'] = $this->adminrajaongkir->tampilData('mp_rajaongkir',"*",array("ID" => $id),$result=TRUE);
		$this->load->view($this->template, $data);
		
	}
	function cekKredit($id = NULL){
		if($id == NULL){ redirect("404");}
		$id = base64_decode_fix($id);
		//echo $id;exit();
		$data['id'] = $id;
		$data['judul_page'] = 'Cek kredit Api';
		$data['des_page'] = 'Cek kredit Api';
		$data['page'] = "cek_kredit";
		$data['tampil'] = $this->adminrajaongkir->tampilData('mp_setting',"*",array("ID_SETTING" => $id),$result=TRUE);
		$this->load->view($this->template, $data);
		
	}
	function tambahRajaongkir(){
		$nama=$this->input->post('nama');
		$api=$this->input->post('api');
		$tipe=$this->input->post('tipe');
		$data = array(
			'NAMA' => $nama,
			'API_KEY' => $api,
			'TIPE_AKUN' => $tipe
		);


		if($this->adminrajaongkir->tambahData($data,'mp_rajaongkir'))
		{
			$this->session->set_flashdata('notif', 'Sukses Tambah Data.');				
			$this->session->set_flashdata('clr', 'success');
			redirect('admin_rajaongkir');
		}
		else
		{
			$this->session->set_flashdata('notif', 'Gagal Simpan Data.');
			$this->session->set_flashdata('clr', 'danger');
			redirect('admin_rajaongkir/tambah');
		}
	}
	function updateRajaongkir($id = NULL){
		if($id == NULL){ redirect("404");}
		$id = base64_decode_fix($id);
		$nama=$this->input->post('nama');
		$api=$this->input->post('api');
		$tipe=$this->input->post('tipe');
		$where_auth = array(
			'ID' => $id
		);

		$data = array(
			'NAMA' => $nama,
			'API_KEY' => $api,
			'TIPE_AKUN' => $tipe
		);


		if($this->adminrajaongkir->editData($data,'mp_rajaongkir',$where_auth))
		{
			$this->session->set_flashdata('notif', 'Sukses Simpan Data.');				
			$this->session->set_flashdata('clr', 'success');
			redirect('admin_rajaongkir');
		}
		else
		{
			$this->session->set_flashdata('notif', 'Gagal Simpan Data.');
			$this->session->set_flashdata('clr', 'danger');
			redirect('admin_rajaongkir/editRajaongkir/'.base64_encode_fix($id));
		}
	}
	function hapusrRajaongkir($id = NULL){
		if($id == NULL){ redirect("404");}
		$id = base64_decode_fix($id);
		$where_auth = array(
			'ID' => $id
		);
		if($this->adminrajaongkir->hapusData('mp_rajaongkir',$where_auth))
		{
			$this->session->set_flashdata('notif', 'Sukses Hapus Data.');				
			$this->session->set_flashdata('clr', 'success');
			redirect('admin_rajaongkir');
		}
		else
		{
			$this->session->set_flashdata('notif', 'Gagal Hapus Data.');				
			$this->session->set_flashdata('clr', 'danger');
			redirect('admin_rajaongkir');
		}
	}
	function status($id = NULL){
		if($id == NULL){ redirect("404");}
		$id = base64_decode_fix($id);
		$data = array(
			'STATUS' => 0
		);

		$this->adminrajaongkir->editData($data,'mp_setting');

		$where_auth2 = array(
			'ID_SETTING' => $id
		);

		$data2 = array(
			'STATUS' => 1
		);

		$this->adminrajaongkir->editData($data2,'mp_setting',$where_auth2);
		redirect('admin_api');
	}
}