<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_customers extends MY_Admin {

	var $template = 'admin_page';
	var $template_costumer = 'customers-detail';
    function __construct()
	{
		parent::__construct();
		$this->load->model('admin_customers/M_admin_customers', 'customersmodel');
    }

	public function index()
	{
		$data['judul_page'] = 'Data Customers';
		$data['des_page'] = 'Data Customers';
		$data['page'] = "customers";
		$data['tampil'] = $this->customersmodel->tampilData('mp_akun');
		$this->load->view($this->template, $data);
	}
	public function detailCustomers($id = NULL){
		if($id == NULL){ redirect("404");}
		if($this->customersmodel->cekid($id) == FALSE){ redirect("404");}
		$data['judul_page'] = 'Detail Customers';
		
		$data['des_page'] = 'Detail Customers';
		$data['page_costumer'] = 'informasi-umum';
		$data['page'] = $this->template_costumer;
		$data['tampil'] = $this->customersmodel->tampilData('mp_akun',"*",array("ID_AKUN" => $id),TRUE);
		$this->load->view($this->template, $data);
		
	}
}