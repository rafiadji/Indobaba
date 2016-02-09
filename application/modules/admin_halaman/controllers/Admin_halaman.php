<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_halaman extends MY_Admin {

	var $template = 'admin_page';
    function __construct()
	{
		parent::__construct();
		$this->load->model('M_admin_halaman', 'adminhalaman');
		//$this->cekLogin();
		$this->session->set_userdata(array('menu_admin' => 'master_tampilan'));
    }

	public function index()
	{
		$data['judul_page'] = 'Data Halaman Dinamis';
		$data['des_page'] = '';
		$data['page'] = "halaman";
		$data['tampil'] = $this->adminhalaman->tampilData('mp_halaman');
		$this->load->view($this->template, $data);
	}
	function tambah(){
		$data['judul_page'] = 'Tambah Halaman';
		$data['des_page'] = 'Tambah Halaman';
		$data['page'] = "tambah_halaman";
		$this->load->view($this->template, $data);
		
	}
	function editHalaman($id = NULL){
		if($id == NULL){ redirect("404");}
		$id = base64_decode_fix($id);
		//echo $id;exit();
		$data['id'] = $id;
		$data['judul_page'] = 'Edit Halaman';
		$data['des_page'] = 'Edit Halaman';
		$data['page'] = "edit_halaman";
		$data['tampil'] = $this->adminhalaman->tampilData('mp_halaman',"*",array("ID" => $id),$result=TRUE);
		$this->load->view($this->template, $data);
		
	}
	function halaman($link = NULL){
		if($link == NULL){ redirect("404");}
		$data['tampil'] = $this->adminhalaman->tampilData('mp_halaman',"*",array("LINK" => $link),$result=TRUE);
		$this->load->view("prehalaman", $data);
		
	}
	function cekKredit($id = NULL){
		if($id == NULL){ redirect("404");}
		$id = base64_decode_fix($id);
		//echo $id;exit();
		$data['id'] = $id;
		$data['judul_page'] = 'Cek kredit Api';
		$data['des_page'] = 'Cek kredit Api';
		$data['page'] = "cek_kredit";
		$data['tampil'] = $this->adminhalaman->tampilData('mp_setting',"*",array("ID_SETTING" => $id),$result=TRUE);
		$this->load->view($this->template, $data);
		
	}
	function tambahHalaman(){
		$nama_menu=$this->input->post('nama_menu');
		$judul=$this->input->post('judul');
		$isi=$this->input->post('isi');
		$link=$this->input->post('link');
		$status=$this->input->post('status');
		$des=$this->input->post('des');
		$key=$this->input->post('key');
		$data = array(
			'NAMA_MENU' => $nama_menu,
			'JUDUL' => $judul,
			'ISI' => $isi,
			'LINK' => $link,
			'DES_META' => $des,
			'KEY_META' => $key,
			'STATUS' => $status
		);

		$cek_link = $this->adminhalaman->tampilData('mp_halaman',"*",array("LINK" => $link),$result=TRUE);
		if($cek_link)
		{
			$this->session->set_flashdata('notif', 'Duplikasi Link, Silahkan Ganti Link !');
			$this->session->set_flashdata('clr', 'danger');
			redirect('admin_halaman/tambah');
		}
		else
		{
			if($this->adminhalaman->tambahData($data,'mp_halaman'))
			{
				$this->session->set_flashdata('notif', 'Sukses Tambah Data.');
				$this->session->set_flashdata('clr', 'success');
				redirect('admin_halaman');
			}
			else
			{
				$this->session->set_flashdata('notif', 'Gagal Simpan Data.');
				$this->session->set_flashdata('clr', 'danger');
				redirect('admin_halaman/tambah');
			}
		}
	}
	function updateHalaman($id = NULL){
		if($id == NULL){ redirect("404");}
		$id = base64_decode_fix($id);
		$nama_menu=$this->input->post('nama_menu');
		$judul=$this->input->post('judul');
		$isi=$this->input->post('isi');
		$link=$this->input->post('link');
		$status=$this->input->post('status');
		$des=$this->input->post('des');
		$key=$this->input->post('key');
		$where_auth = array(
			'ID' => $id
		);

		$data = array(
			'NAMA_MENU' => $nama_menu,
			'JUDUL' => $judul,
			'ISI' => $isi,
			'LINK' => $link,
			'DES_META' => $des,
			'KEY_META' => $key,
			'STATUS' => $status
		);
		$cek_link = $this->adminhalaman->cekLink($link,$id);
		if($cek_link)
		{
			$this->session->set_flashdata('notif', 'Duplikasi Link, Silahkan Ganti Link !');
			$this->session->set_flashdata('clr', 'danger');
			redirect('admin_halaman/editHalaman/'.base64_encode_fix($id));
		}
		else
		{
			if($this->adminhalaman->editData($data,'mp_halaman',$where_auth))
			{
				redirect('admin_halaman');
				$this->session->set_flashdata('notif', 'Sukses Edit Data.');
				$this->session->set_flashdata('clr', 'success');
			}
			else
			{
				$this->session->set_flashdata('notif', 'Gagal Simpan Data.');
				$this->session->set_flashdata('clr', 'danger');
				redirect('admin_halaman/editHalaman/'.base64_encode_fix($id));
			}
		}
	}
	function hapusHalaman($id = NULL){
		if($id == NULL){ redirect("404");}
		$id = base64_decode_fix($id);
		$where_auth = array(
			'ID' => $id
		);
		if($this->adminhalaman->hapusData('mp_halaman',$where_auth))
		{
			redirect('admin_halaman');
		}
		else
		{
			redirect('admin_halaman');
		}
	}
	function status($id = NULL){
		if($id == NULL){ redirect("404");}
		$id = base64_decode_fix($id);
		$data = array(
			'STATUS' => 0
		);

		$this->adminhalaman->editData($data,'mp_setting');

		$where_auth2 = array(
			'ID_SETTING' => $id
		);

		$data2 = array(
			'STATUS' => 1
		);

		$this->adminhalaman->editData($data2,'mp_setting',$where_auth2);
		redirect('admin_api');
	}
}