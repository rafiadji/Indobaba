<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_widget extends MY_Admin {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('m_admin_widget', 'widget');
		$this->session->set_userdata(array('menu_admin' => 'master_tampilan'));
	}
	
	function index(){
		$data['judul_page'] = 'Widget';
		$data['des_page'] = '';
		$data['page'] = 'tambah_widget';
		$data['halaman'] = $this->widget->tampilData('mp_halaman');
		$data['widget_1'] = $this->widget->tampilData('view_widget','*',array('TYPE' => 1));
		$data['widget_2'] = $this->widget->tampilData('view_widget','*',array('TYPE' => 2));
		$this->load->view($this->template,$data);
	}
	
	function tambahHalamanSubmit(){
		$id_halaman = $this->input->post('id_halaman');
		$type = $this->input->post('type');
		$data = array(
			"ID" => $id_halaman,
			"TYPE" => $type
		);
		$sql = $this->widget->tambahData($data,'mp_widget');
		if($sql){
			$this->session->set_flashdata('notif', 'Berhasil ditambah');
			$this->session->set_flashdata('clr', 'success');
			redirect('admin_widget');
		}
	}
	
	function hapusHalaman($id){
		$data = array(
			'ID_WIDGET' => $id
		);
		$sql = $this->widget->hapusData('mp_widget',$data);
		if($sql){
			$this->session->set_flashdata('notif', 'Berhasil dihapus');
			$this->session->set_flashdata('clr', 'info');
			redirect('admin_widget');
		}
	}
}