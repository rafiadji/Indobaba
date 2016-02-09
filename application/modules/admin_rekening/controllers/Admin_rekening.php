<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_rekening extends MY_Admin {
	var $template = 'admin_page';
	function __construct(){
		parent::__construct();
		$this->load->model("M_admin_rekening","rekening");
		$this->session->set_userdata(array("menu_admin" => "master_data"));
	}

	public function index(){
		$data['judul_page'] = 'Rekening';
		$data['des_page'] = 'Semua Rekening';
		$data['page'] = 'rekening';
		$data['tampil'] = $this->rekening->tampilData('view_rekening','*',array("LEVEL" =>1));
		$data['tampil_ukm'] = $this->rekening->tampilData('view_rekening','*',array("LEVEL" =>2));
		$data['tampil_pj'] = $this->rekening->tampilData('view_rekening','*',array("LEVEL" =>3));
		$this->load->view($this->template, $data);
	}

	public function dapatLevel()
	{
		$level = $this->input->post('level');
		if ($level == 1) {
			// $admin = $this->rekening->tampilData('mp_admin');
			// echo '<option value="">Pilih Pemilik Rekening Indobaba Terlebih Dahulu</option>';
			// foreach ($admin as $row1) {
				// echo '<option value="'.$row1->ID_ADMIN.'">'.$row1->NAMA.'</option>';
			// }
		}
		elseif ($level == 2) {
			$ukm = $this->rekening->tampilData('mp_toko');
			echo '<option value="">Pilih Pemilik UKM Terlebih Dahulu</option>';
			foreach ($ukm as $row2) {
				echo '<option value="'.$row2->ID_TOKO.'">'.$row2->NM_TOKO.'</option>';
			}
		}

		elseif ($level == 3) {
			$tanggung = $this->rekening->tampilData('mp_penanggung_jwb');
			echo '<option value="">Pilih Pemilik Penanggung Jawab Terlebih Dahulu</option>';
			foreach ($tanggung as $row3) {
				echo '<option value="'.$row3->ID_PENANGGUNG_JWB.'">'.$row3->NAMA.'</option>';
			}
		}
	}

	public function dapatLeveledit(){
		$level = $this->input->post('level');
		$pemilik = $this->input->post('pemilik');
		if ($level == 1) {
			$admin = $this->rekening->tampilData('mp_admin');
			foreach ($admin as $row1) {
				$selected = ($row1->ID_ADMIN == $pemilik) ? 'selected' : '';
				echo '<option value="'.$row1->ID_ADMIN.'" '.$selected.' >'.$row1->NAMA.'</option>';
			}
		}
		elseif ($level == 2) {
			$ukm = $this->rekening->tampilData('mp_toko');
			foreach ($ukm as $row2) {
				$selected = ($row2->ID_TOKO == $pemilik) ? 'selected' : '';
				echo '<option value="'.$row2->ID_TOKO.'" '.$selected.'>'.$row2->NM_TOKO.'</option>';
			}
		}
		elseif ($level == 3) {
			$tanggung = $this->rekening->tampilData('mp_penanggung_jwb');
			foreach ($tanggung as $row3) {
				$selected = ($row3->ID_PENANGGUNG_JWB == $pemilik) ? 'selected' : '';
				echo '<option value="'.$row3->ID_PENANGGUNG_JWB.'" '.$selected.'>'.$row3->NAMA.'</option>';
			}
		}
	}

	public function tambahRekening(){
		$data['judul_page'] = 'Tambah Rekening';
		$data['des_page'] = 'Tambah Rekening';
		$data['page'] = 'tambahrekening';
		$data['bank'] = $this->rekening->tampilData('mp_bank');
		$this->load->view($this->template, $data);
	}

	public function tambahRekeningsubmit(){
		$this->form_validation->set_rules('NO_REKENING', 'No Rekening', 'required');
		$this->form_validation->set_rules('LEVEL', 'Rekening untuk', 'required');
		$this->form_validation->set_rules('ID_PEMILIK', 'Pemilik', 'required');
		$this->form_validation->set_rules('ID_BANK', 'Bank', 'required');
		$this->form_validation->set_rules('ATAS_NAMA', 'Atas Nama', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
			redirect('admin_rekening/tambahRekening');
		}
		$data = array(
			'ID_BANK' => $this->input->post('ID_BANK'),
			'ID_PEMILIK' => $this->input->post('ID_PEMILIK'),
			'NO_REKENING' => $this->input->post('NO_REKENING'),
			'ATAS_NAMA' => $this->input->post('ATAS_NAMA'),
			'LEVEL' => $this->input->post('LEVEL')
		);
		$insert = $this->rekening->tambahData($data, 'mp_rekening');
		if($insert) {
			$this->session->set_flashdata('notif', 'Rekening berhasil ditambah');
			$this->session->set_flashdata('clr', 'success');
			redirect('admin_rekening');
		}
		else{
			$this->session->set_flashdata('notif', 'maaf data tidak bisa masuk ulangi lagi');
			$this->session->set_flashdata('clr', 'warning');
			redirect('admin_rekening/tambahRekening');
		}
	}

	public function ubahRekening($id = NULL)
	{
		$data['judul_page'] = 'Ubah Rekening';
		$data['des_page'] = 'Ubah Rekening';
		$data['page'] = 'editrekening';
		$data['edit'] = $this->rekening->tampilData('mp_rekening', NULL, array('ID_REKENING' => $id), TRUE);
		$data['bank'] = $this->rekening->tampilData('mp_bank');
		$this->load->view($this->template, $data);
	}

	public function ubahRekeningsubmit(){
		$this->form_validation->set_rules('NO_REKENING', 'No Rekening', 'required');
		$this->form_validation->set_rules('LEVEL', 'Rekening untuk', 'required');
		$this->form_validation->set_rules('ID_PEMILIK', 'Pemilik', 'required');
		$this->form_validation->set_rules('ID_BANK', 'Bank', 'required');
		$this->form_validation->set_rules('ATAS_NAMA', 'Atas Nama', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
			redirect('admin_rekening/ubahRekening/'.$this->input->post('ID_REKENING'));
		}
		$data = array(
			'ID_BANK' => $this->input->post('ID_BANK'),
			'ID_PEMILIK' => $this->input->post('ID_PEMILIK'),
			'NO_REKENING' => $this->input->post('NO_REKENING'),
			'ATAS_NAMA' => $this->input->post('ATAS_NAMA'),
			'LEVEL' => $this->input->post('LEVEL')
		);

		$where = array('ID_REKENING' => $this->input->post('ID_REKENING'));
		$update = $this->rekening->editData($data, 'mp_rekening', $where);
		if($update) {
			$this->session->set_flashdata('notif', 'Rekening berhasil diubah');
			$this->session->set_flashdata('clr', 'success');
			redirect('admin_rekening/ubahRekening/'.$this->input->post('ID_REKENING'));
		}
		else{
			$this->session->set_flashdata('notif', 'maaf data tidak bisa di ubah ulangi lagi');
			$this->session->set_flashdata('clr', 'warning');
			redirect('admin_rekening/ubahRekening/'.$this->input->post('ID_REKENING'));
		}
	}

	public function hapusRekening($id = NULL)
	{
		$delete = $this->rekening->hapusData('mp_rekening', array('ID_REKENING' => $id));
		$this->session->set_flashdata('notif', 'Rekening berhasil dihapus');
		$this->session->set_flashdata('clr', 'success');
		redirect('admin_rekening');
	}

	// Rekening ukm
	public function tambahRekeningukm(){
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



	// Rekening penanggung jawab

	

	public function tambahRekeningpj()

	{

		$this->form_validation->set_rules('NO_REKENING', 'No Rekening', 'required');

		$this->form_validation->set_rules('ID_BANK', 'Bank', 'required');

		

		if ($this->form_validation->run() == FALSE) {

			$this->session->set_flashdata('notif', validation_errors());

			$this->session->set_flashdata('clr', 'danger');

			redirect('admin_penanggung_jwb/tambahRekening/'.$this->input->post('ID_PEMILIK'));

		}

		

		$data = array(

			'ID_BANK' => $this->input->post('ID_BANK'),

			'ID_PEMILIK' => $this->input->post('ID_PEMILIK'),

			'NO_REKENING' => $this->input->post('NO_REKENING'),

			'LEVEL' => 3

		);

		

		$insert = $this->rekening->tambahData($data, 'mp_rekening');

		if($insert) {

			$this->session->set_flashdata('notif', 'Rekening berhasil ditambah');

			$this->session->set_flashdata('clr', 'success');

			redirect('admin_penanggung_jwb/tambahRekening/'.$this->input->post('ID_PEMILIK'));

		}

		else{

			$this->session->set_flashdata('notif', 'maaf data tidak bisa masuk ulangi lagi');

			$this->session->set_flashdata('clr', 'warning');

			redirect('admin_penanggung_jwb/tambahRekening/'.$this->input->post('ID_PEMILIK'));

		}

	}



	public function ubahRekeningpj()

	{

		$this->form_validation->set_rules('NO_REKENING', 'No Rekening', 'required');

		$this->form_validation->set_rules('ID_BANK', 'Bank', 'required');

		

		if ($this->form_validation->run() == FALSE) {

			$this->session->set_flashdata('notif', validation_errors());

			$this->session->set_flashdata('clr', 'danger');

			redirect('admin_penanggung_jwb/tambahRekening/'.$this->input->post('ID_PEMILIK'));

		}

		

		$data = array(

			'ID_BANK' => $this->input->post('ID_BANK'),

			'NO_REKENING' => $this->input->post('NO_REKENING'),

			'LEVEL' => 3

		);

		

		$where = array('ID_REKENING' => $this->input->post('ID_REKENING'));

		$update = $this->rekening->editData($data, 'mp_rekening', $where);

		if($update) {

			$this->session->set_flashdata('notif', 'Rekening berhasil diubah');

			$this->session->set_flashdata('clr', 'success');

			redirect('admin_penanggung_jwb/tambahRekening/'.$this->input->post('ID_PEMILIK'));

		}

		else{

			$this->session->set_flashdata('notif', 'maaf data tidak bisa diubah ulangi lagi');

			$this->session->set_flashdata('clr', 'warning');

			redirect('admin_penanggung_jwb/tambahRekening/'.$this->input->post('ID_PEMILIK'));

		}

	}

}

?>