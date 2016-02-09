<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_review extends CI_Controller {

	var $template = 'home_page';

	function __construct()
	{
		parent::__construct();
		$this->load->model('user_review/m_user_review', 'review');
		//$this->cekLogin();
    }

	public function index()
	{
		$id_produk = $this->input->post('id_pro');
		$tampil = $this->review->tampilData('view_review', NULL, array('ID_PRODUK' => $id_produk), FALSE, NULL, NULL, "ID_REVIEW DESC");
		if (count($tampil) > 0) {
			$json_data = array('status' => 'yes');
			$i = 0;
			foreach ($tampil as $row) {
				$json_data['data'][$i]['NAMA'] = $row->NAMA;
				$json_data['data'][$i]['REVIEW'] = $row->REVIEW;
				$i++;
			}
		}
		else {
			$json_data = array('status' => 'no');
		}
		echo json_encode($json_data);
	}
	
	public function tambahReview()
	{
		$this->form_validation->set_rules('REVIEW', 'REVIEW', 'required');
		$link = setPermalink($this->input->post('ID_PRODUK'),$this->input->post('NM_PRODUK'));

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
			redirect('Home_controller/detailProduct/'.$link);
		}
		
		$data = array(
			'ID_PRODUK' => $this->input->post('ID_PRODUK'),
			'ID_AKUN' => $this->session->userdata('id_akun_user'),
			'REVIEW' => $this->input->post('REVIEW')
		);
		$insert = $this->review->tambahData($data, 'mp_review');
		if($insert) {
			$this->session->set_flashdata('notif', 'Review berhasil di tambah');
			$this->session->set_flashdata('clr', 'success');
			redirect('Home_controller/detailProduct/'.$link);
		}
		else{
			$this->session->set_flashdata('notif', 'maaf data tidak bisa masuk ulangi lagi');
			$this->session->set_flashdata('clr', 'warning');
			redirect('Home_controller/detailProduct/'.$link);
		}
	}
	
}