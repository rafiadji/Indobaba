<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ukm_daftar_baru extends CI_Controller {

	var $template = "home_page";
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_ukm_daftar_baru', 'daftar_baru');
    }
    
    function index(){
    	$data["page"] = "daftar";
		$this->load->view($this->template,$data);
	}
	
	function kirimUkm(){
		$this->form_validation->set_rules('nm_ukm', 'Nama UKM', 'required');
		$this->form_validation->set_rules('telpon', 'No Telpon', 'required|numeric');
		$this->form_validation->set_rules('usaha', 'Usaha', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
			redirect('ukm_daftar_baru');
		}
		$nm_ukm = $this->input->post('nm_ukm');
		$telpon = $this->input->post('telpon');
		$usaha = $this->input->post('usaha');
		$array = array(
			"NAMA_UKM" => $nm_ukm,
			"NO_TELP" => $telpon,
			"NM_USAHA" => $usaha,
			"STS" => 0
		);	
		$sql = $this->daftar_baru->tambahData($array,'mp_daftar_ukm');
		if($sql){
			$this->session->set_flashdata('notif', "Data berhasil dikirim");
		  	$this->session->set_flashdata('clr', 'success');
		  	redirect('ukm_daftar_baru');
		}
	}
}

