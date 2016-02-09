<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ukm_rekening extends MY_Ukm {

	var $template = 'home_page';

	function __construct()
	{
		parent::__construct();
		//$this->cekLogin();
		$this->load->model("M_ukm_rekening","rekening");
	}

	public function index()
	{
		$data['judul_page'] = 'Rekening';
		$data['des_page'] = 'Semua Rekening';
		$data['page'] = 'rekening';
		$data['tampil'] = $this->rekening->tampilData('view_rekening');
		$this->load->view($this->template, $data);
	}
	
	public function tambahRekeningukm()
	{
		$this->form_validation->set_rules('NO_REKENING', 'No Rekening', 'required');
		$this->form_validation->set_rules('ID_BANK', 'Bank', 'required');
		
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
			redirect('admin_ukm/rekeningUkm/'.base64_encode_fix($this->input->post('ID_PEMILIK')));
		}
		
		$data = array(
			'ID_BANK' => $this->input->post('ID_BANK'),
			'ID_PEMILIK' => $this->input->post('ID_PEMILIK'),
			'NO_REKENING' => $this->input->post('NO_REKENING'),
			'LEVEL' => 2
		);
		
		$insert = $this->rekening->tambahData($data, 'mp_rekening');
		if($insert) {
			$this->session->set_flashdata('notif', 'Rekening berhasil ditambah');
			$this->session->set_flashdata('clr', 'success');
			redirect('admin_ukm/rekeningUkm/'.base64_encode_fix($this->input->post('ID_PEMILIK')));
		}
		else{
			$this->session->set_flashdata('notif', 'maaf data tidak bisa masuk ulangi lagi');
			$this->session->set_flashdata('clr', 'warning');
			redirect('admin_ukm/rekeningUkm/'.base64_encode_fix($this->input->post('ID_PEMILIK')));
		}
	}

	public function ubahRekeningukm()
	{
		$this->form_validation->set_rules('NO_REKENING', 'No Rekening', 'required');
		$this->form_validation->set_rules('ID_BANK', 'Bank', 'required');
		
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
			redirect('admin_ukm/rekeningUkm/'.base64_encode_fix($this->input->post('ID_PEMILIK')));
		}
		
		$data = array(
			'ID_BANK' => $this->input->post('ID_BANK'),
			'NO_REKENING' => $this->input->post('NO_REKENING'),
			'LEVEL' => 2
		);
		
		$where = array('ID_REKENING' => $this->input->post('ID_REKENING'));
		$update = $this->rekening->editData($data, 'mp_rekening', $where);
		if($update) {
			$this->session->set_flashdata('notif', 'Rekening berhasil diubah');
			$this->session->set_flashdata('clr', 'success');
			redirect('admin_ukm/rekeningUkm/'.base64_encode_fix($this->input->post('ID_PEMILIK')));
		}
		else{
			$this->session->set_flashdata('notif', 'maaf data tidak bisa diubah ulangi lagi');
			$this->session->set_flashdata('clr', 'warning');
			redirect('admin_ukm/rekeningUkm/'.base64_encode_fix($this->input->post('ID_PEMILIK')));
		}
	}

	public function hapusRekening($id = NULL)
	{
		$delete = $this->rekening->hapusData('mp_rekening', array('ID_REKENING' => $id));
		$this->session->set_flashdata('notif', 'Rekening berhasil dihapus');
		$this->session->set_flashdata('clr', 'success');
		redirect('admin_rekening');
	}
}
?>