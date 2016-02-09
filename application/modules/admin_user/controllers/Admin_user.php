<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_user extends MY_Admin {

	var $template = 'admin_page';

	function __construct()
	{
		parent::__construct();
		$this->load->model('admin_user/m_admin_user', 'user');
		$this->session->set_userdata(array('menu_admin' => 'master_user'));
    }

	public function index()
	{
		$data['judul_page'] = 'Data Admin';
		$data['des_page'] = 'Data admin';
		$data['page'] = "admin";
		$data['tampil'] = $this->user->tampilData('mp_admin');
		$this->load->view($this->template, $data);
	}

	public function tambahAdmin()
	{
		$data['judul_page'] = 'Tambah Admin';
		$data['des_page'] = 'Tambah admin baru';
		$data['page'] = "tambahadmin";
		$this->load->view($this->template, $data);
	}
	public function tambahAdminsubmit()
	{
		$this->form_validation->set_rules('USERNAME', 'USERNAME', 'required');
		$this->form_validation->set_rules('PASSWORD', 'PASSWORD', 'required');
		$this->form_validation->set_rules('PASSWORD2', 'Confrim password', 'required|matches[PASSWORD]');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
			redirect('admin_user');
		}

		$cekpass = $this->user->tampilData('mp_user');
		foreach ($cekpass as $row) {
			if ($row->PASSWORD == acakPass($this->input->post('PASSWORD'))) {
				$this->session->set_flashdata('notif', 'Ulangi Password sudah terpakai');
				$this->session->set_flashdata('clr', 'warning');
				redirect('admin_user');
			}
		}

		$dataadmin = array(
			'NAMA' => $this->input->post('NAMA'),
			'NO_TELP' => $this->input->post('NO_TELP'),
			'USERNAME' => getUsername($this->input->post('USERNAME'), 'admin')
			);
		$insertadmin = $this->user->tambahData($dataadmin, 'mp_admin');

		$data = array(
			'ID_LEVEL' => '1',
			'ID_AUTH' => $this->db->insert_id(),
			'USERNAME' => getUsername($this->input->post('USERNAME'), 'admin'),
			'PASSWORD' => acakPass($this->input->post('PASSWORD'))			
		);
		$insert = $this->user->tambahData($data, 'mp_user');
		if($insert) {
			$this->session->set_flashdata('notif', 'admin berhasil di tambah');
			$this->session->set_flashdata('clr', 'success');
			redirect('admin_user');
		}
		else{
			$this->session->set_flashdata('notif', 'maaf data tidak bisa masuk ulangi lagi');
			$this->session->set_flashdata('clr', 'warning');
			redirect('admin_user');
		}
	}

	public function hapusAdmin($id)
	{
		$admin = $this->user->tampilData('mp_admin', NULL, array('ID_ADMIN' => $id), TRUE);
		$delete = $this->user->hapusData('mp_user', array('USERNAME' => $admin->USERNAME));
		$deladmin = $this->user->hapusData('mp_admin', array('ID_ADMIN' => $id));
		$this->session->set_flashdata('notif', 'Data Admin berhasil dihapus');
		$this->session->set_flashdata('clr', 'success');
		redirect('admin_user');
	}

	public function ubahpasswordAdmin()
	{
		$this->session->set_userdata(array('menu_admin' => 'master_pengaturan'));
		$data['judul_page'] = 'Ubah Password';
		$data['des_page'] = 'Ubah Password admin';
		$data['page'] = "ubahpassadmin";
		$this->load->view($this->template, $data);
	}

	public function ubahpasswordAdminsubmit()
	{
		$this->form_validation->set_rules('PASSWORD', 'PASSWORD', 'required');
		$this->form_validation->set_rules('PASSWORDLM', 'password lama', 'required');
		$this->form_validation->set_rules('PASSWORD2', 'Confrim password', 'required|matches[PASSWORD]');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
			redirect('admin_user/ubahpasswordAdmin');
		}

		$cekpass = $this->user->tampilData('mp_user');
		foreach ($cekpass as $row) {
			if ($row->PASSWORD == acakPass($this->input->post('PASSWORD'))) {
				$this->session->set_flashdata('notif', 'Ulangi Password sudah terpakai');
				$this->session->set_flashdata('clr', 'warning');
				redirect('admin_user/ubahpasswordAdmin');
			}
		}

		$where = array(
			'ID_USER' => $this->session->userdata('id_akun_admin'),
			'PASSWORD' => acakPass($this->input->post('PASSWORDLM'))
		);
		$data = array(
			'PASSWORD' => acakPass($this->input->post('PASSWORD'))			
		);
		$update = $this->user->editData($data, 'mp_user', $where);
		if($update) {
			$this->session->set_flashdata('notif', 'admin berhasil di tambah');
			$this->session->set_flashdata('clr', 'success');
			redirect('admin_user');
		}
		else{
			$this->session->set_flashdata('notif', 'maaf data tidak bisa masuk ulangi lagi');
			$this->session->set_flashdata('clr', 'warning');
			redirect('admin_user');
		}
	}
	
	public function ubahAdmin($id = NULL)
	{
		$data['judul_page'] = 'Ubah Data Admin';
		$data['des_page'] = 'Ubah Data Admin';
		$data['page'] = "ubahadmin";
		$data['edit'] = $this->user->tampilData('mp_admin', NULL, array('ID_ADMIN' => $id), TRUE);
		$this->load->view($this->template, $data);
	}

	public function ubahAdminsubmit()
	{
		$this->form_validation->set_rules('NAMA', 'NAMA', 'required');
		$this->form_validation->set_rules('NO_TELP', 'NO_TELP', 'required');
		
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
			redirect('admin_user/ubahAdmin/'.$this->input->post('ID_ADMIN'));
		}
		
		$data = array(
			'NAMA' => $this->input->post('NAMA'),
			'NO_TELP' => $this->input->post('NO_TELP')
		);
		$where = array('ID_ADMIN' => $this->input->post('ID_ADMIN'));
		$update = $this->user->editData($data, 'mp_admin', $where);
		if($update) {
			$this->session->set_flashdata('notif', 'Data Admin berhasil diubah');
			$this->session->set_flashdata('clr', 'success');
			redirect('admin_user/ubahAdmin/'.$this->input->post('ID_ADMIN'));
		}
		else{
			$this->session->set_flashdata('notif', 'maaf data tidak bisa diubah ulangi lagi');
			$this->session->set_flashdata('clr', 'warning');
			redirect('admin_user/ubahAdmin/'.$this->input->post('ID_ADMIN'));
		}
	}
	

}

