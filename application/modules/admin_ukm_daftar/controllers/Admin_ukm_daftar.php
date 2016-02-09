<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_ukm_daftar extends MY_Admin {

	var $template = 'admin_page';

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_admin_ukm_daftar', 'user');
		$this->session->set_userdata(array('menu_admin' => 'master_ukm'));
    }

	public function index()
	{
		$data['judul_page'] = 'Permintaan Bergabung';
		$data['des_page'] = '';
		$data['page'] = "lihat";
		$data['tampil'] = $this->user->tampilData('mp_daftar_ukm','*',array('STS' => 0));
		$this->load->view($this->template, $data);
	}
	
	function statusDaftar(){
		$id_status = $this->input->post('status');
		$data['id_status'] = $id_status;
		$data['tampil'] = $this->user->tampilData('mp_daftar_ukm','*',array('STS' => $id_status));
		$this->load->view('lihat-status',$data);
	}
	
	function ubahStatus($id){
		$data = array('STS' => 1);
		$where = array('ID_DAFTAR_UKM' => $id);
		$sql = $this->user->editData($data,'mp_daftar_ukm',$where);
		if($sql){
			$this->session->set_flashdata('notif', 'Sudah ditanggapi');
			$this->session->set_flashdata('clr', 'success');
		}
		redirect('admin_ukm_daftar');
	}
}

