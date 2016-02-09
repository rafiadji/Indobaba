<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_api extends MY_Admin {

	var $template = 'admin_page';
    function __construct()
	{
		parent::__construct();
		$this->load->model('M_admin_api', 'adminapi');
		//$this->cekLogin();
		$this->session->set_userdata(array('menu_admin' => 'master_api'));
    }
	public function index()
	{
		$data['judul_page'] = 'Data Api';
		$data['des_page'] = '';
		$data['page'] = "api";
		$data['tampil'] = $this->adminapi->tampilData('mp_setting');
		$this->load->view($this->template, $data);
	}
	function tambah(){
		$data['judul_page'] = 'Tambah Api';
		$data['des_page'] = 'Tambah Api';
		$data['page'] = "tambah_api";
		$this->load->view($this->template, $data);
		
	}
	function editApi($id = NULL){
		if($id == NULL){ redirect("404");}
		$id = base64_decode_fix($id);
		//echo $id;exit();
		$data['id'] = $id;
		$data['judul_page'] = 'Edit Api';
		$data['des_page'] = 'Edit Api';
		$data['page'] = "edit_api";
		$data['tampil'] = $this->adminapi->tampilData('mp_setting',"*",array("ID_SETTING" => $id),$result=TRUE);
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
		$data['tampil'] = $this->adminapi->tampilData('mp_setting',"*",array("ID_SETTING" => $id),$result=TRUE);
		$this->load->view($this->template, $data);
		
	}
	function tambahApi(){
		$des_api=$this->input->post('des_api');
		$user_key=$this->input->post('user_key');
		$pass_key=$this->input->post('pass_key');
		$link=$this->input->post('link');
		$kredit=$this->input->post('kredit');
		$data = array(
			'DESKRIPSI' => $des_api,
			'SETTING' => $user_key."#".$pass_key,
			'LINK' => $link,
			'LINK_KREDIT' => $kredit
		);


		if($this->adminapi->tambahData($data,'mp_setting'))
		{
			redirect('admin_api');
		}
		else
		{
			redirect('admin_ukm/tambah');
		}
	}
	function updateApi($id = NULL){
		if($id == NULL){ redirect("404");}
		$id = base64_decode_fix($id);
		$des_api=$this->input->post('des_api');
		$user_key=$this->input->post('user_key');
		$pass_key=$this->input->post('pass_key');
		$link=$this->input->post('link');
		$kredit=$this->input->post('kredit');
		$where_auth = array(
			'ID_SETTING' => $id
		);

		$data = array(
			'DESKRIPSI' => $des_api,
			'SETTING' => $user_key."#".$pass_key,
			'LINK' => $link,
			'LINK_KREDIT' => $kredit
		);

		if($this->adminapi->editData($data,'mp_setting',$where_auth))
		{
			redirect('admin_api');
		}
		else
		{
			redirect('admin_ukm/editApi/'.base64_encode_fix($id));
		}
	}
	function hapusApi($id = NULL){
		if($id == NULL){ redirect("404");}
		$id = base64_decode_fix($id);
		$where_auth = array(
			'ID_SETTING' => $id
		);
		if($this->adminapi->hapusData('mp_setting',$where_auth))
		{
			redirect('admin_api');
		}
		else
		{
			redirect('admin_api');
		}
	}
	function status($id = NULL){
		if($id == NULL){ redirect("404");}
		$id = base64_decode_fix($id);
		$data = array(
			'STATUS' => 0
		);

		$this->adminapi->editData($data,'mp_setting');

		$where_auth2 = array(
			'ID_SETTING' => $id
		);

		$data2 = array(
			'STATUS' => 1
		);

		$this->adminapi->editData($data2,'mp_setting',$where_auth2);
		redirect('admin_api');
	}
}