<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_penanggung_jwb extends MY_Admin {

	var $template = 'admin_page';
	var $template_penanggung_jwb = 'detail_penanggung_jwb';

	function __construct(){
		parent::__construct();
		$this->load->model('M_admin_penanggung_jwb','penanggung_jwb');
		$this->session->set_userdata(array('menu_admin' => 'master_ukm'));
    }
	
	function index(){
		$data['judul_page'] = 'Penanggung Jawab UKM';
		$data['des_page'] = '';
		$data['penanggung_jwb_ukm'] = $this->penanggung_jwb->tampilData('mp_penanggung_jwb', '*',array('STATUS_HAPUS' => 0));
		$data['page'] = 'lihat_penanggung_jwb';
		$this->load->view($this->template,$data);
	}
	
	function lihatUkm($id){
		$data['id_penanggung_jwb'] = $id;
		$data['judul_page'] = 'UKMnya';
		$data['des_page'] = '';
		$data['page_penanggung_jwb'] = 'lihat-ukm';
		$data['page'] = $this->template_penanggung_jwb;
		$data['ukm'] = $this->penanggung_jwb->tampilData('mp_toko','*',array('ID_PENANGGUNG_JWB' => $id));
		$this->load->view($this->template,$data);
	}
	
	function editPenanggungJwb($id){
		$where_user = array(
			'ID_PENANGGUNG_JWB' => $id
		);
		$detail = $this->penanggung_jwb->tampilData('mp_penanggung_jwb', '*',$where_user,TRUE);		
		$where_kota = array(
			'ID_PROVINSI' => $detail->ID_PROVINSI
		);
		$where_kecamatan = array(
			'ID_KOTA' => $detail->ID_KOTA
		);
		$data['id_penanggung_jwb'] = $id;
		$data['judul_page'] = $detail->NAMA;
		$data['des_page'] = '';
		$data['detail'] = $this->penanggung_jwb->tampilData('mp_penanggung_jwb', '*',$where_user,TRUE);
		$data['page_penanggung_jwb'] = 'informasi-umum';
		$data['page'] = $this->template_penanggung_jwb;
		$data['provinsi'] = $this->penanggung_jwb->tampilData('mp_provinsi');
		$data['kota'] = $this->penanggung_jwb->tampilData('mp_kokab','*',$where_kota);
		$data['kecamatan'] = $this->penanggung_jwb->tampilData('mp_kecamatan','*',$where_kecamatan);
		$this->load->view($this->template,$data);
	}
	
	function tambahRekening($id){
		$data['id_penanggung_jwb'] = $id;
		$where_user = array(
			'ID_PENANGGUNG_JWB' => $id
		);
		$detail = $this->penanggung_jwb->tampilData('mp_penanggung_jwb', '*',$where_user,TRUE);
		$data['judul_page'] = 'Tambah rekening '.$detail->NAMA;
		$data['des_page'] = '';
		$data['page_penanggung_jwb'] = 'rekening-penanggung-jwb';
		$data['page'] = $this->template_penanggung_jwb;
		$data['rekening'] = $this->penanggung_jwb->tampilData('view_rekening', NULL, array("ID_PEMILIK" => $id, "LEVEL" => 3), TRUE);
		$data['bank'] = $this->penanggung_jwb->tampilData('mp_bank');
		$this->load->view($this->template,$data);
	}
	
	function editPenanggungJwbSubmit(){
		$id_penanggung_jwb = $this->input->post('id_penanggung_jwb');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('telp', 'Telepon', 'required');
		$this->form_validation->set_rules('email', 'Email', 'valid_email');
		$this->form_validation->set_rules('id_provinsi', 'Provinsi', 'required');
		$this->form_validation->set_rules('id_kota', 'Kota', 'required');
		$this->form_validation->set_rules('id_kecamatan', 'Kecamatan', 'required');
		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
			redirect('admin_penanggung_jwb/editPenanggungJwb/'.$id_penanggung_jwb,'location');
		}
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$telp = $this->input->post('telp');
		$email = $this->input->post('email');
		$s_bbm = $this->input->post('s_bbm');
		$id_provinsi = $this->input->post('id_provinsi');
		$id_kota = $this->input->post('id_kota');
		$id_kecamatan = $this->input->post('id_kecamatan');
		$kelurahan = $this->input->post('kelurahan');
		$tgl_terdaftar = ubahFormatTgl(tglSekarang(),'Y-m-d');
		$where = array(
			'ID_PENANGGUNG_JWB' => $id_penanggung_jwb
		);
		$gambar = $this->penanggung_jwb->tampilData('mp_penanggung_jwb','FT_PROFIL',$where,TRUE);		
		if(!empty($_FILES['foto_profil']["tmp_name"])){
			// Hapus foto lama
			$dir = 'assets-admin/img/penanggung_jwb/';
			unlink($dir.$gambar->FT_PROFIL);
			// Jika upload
			$config['file_name'] = date("Ymdhis");
			$config['upload_path'] = './assets-admin/img/penanggung_jwb/';
	        $config['allowed_types'] = 'gif|jpg|png';
	        $config['max_size'] = 1048;
	        $config['max_width'] = 1024;
	        $config['max_height'] = 768;
	        $config['detect_mime'] = TRUE;
			$this->load->library("upload",$config);
			$filename = "foto_profil";
			if(!$this->upload->do_upload($filename)){
				$this->session->set_flashdata('notif', $this->upload->display_errors());
				$this->session->set_flashdata('clr', 'danger');
				redirect('admin_penanggung_jwb/editPenanggungJwb/'.$id_penanggung_jwb,'location');
				exit();
			}
			$nm_img = $this->upload->data("file_name");
		}
		else{
			$nm_img = $gambar->FT_PROFIL;
		}
		$data = array(
			'NAMA' => $nama,
			'ALAMAT' => $alamat,
			'TELP' => $telp,
			'EMAIL' => $email,
			'S_BBM' => $s_bbm,
			'KELURAHAN' => $kelurahan,
			'ID_PROVINSI' => $id_provinsi,
			'ID_KOTA' => $id_kota,
			'ID_KECAMATAN' => $id_kecamatan,
			'TGL_TERDAFTAR' => $tgl_terdaftar,
			'FT_PROFIL' => $nm_img
		);
		$this->penanggung_jwb->editData('mp_penanggung_jwb',$data,$where);
		$this->session->set_flashdata('notif', 'Informasi berhasil di perbaharui');
		$this->session->set_flashdata('clr', 'success');
		redirect('admin_penanggung_jwb/editPenanggungJwb/'.$id_penanggung_jwb,'location');
	}
	
	function hapusPenanggungJwb($id){
		/*$where = array(
			'ID_PENANGGUNG_JWB' => $id
		);
		$gambar = $this->penanggung_jwb->tampilData('mp_penanggung_jwb','FT_PROFIL',$where,TRUE);		
		// Hapus foto lama
		$dir = 'assets-admin/img/penanggung_jwb/';
		unlink($dir.$gambar->FT_PROFIL);
		$this->penanggung_jwb->hapusData('mp_penanggung_jwb',$where);
		$this->session->set_flashdata('notif', 'Penanggung jawab berhasil di hapus');
		$this->session->set_flashdata('clr', 'success');
		redirect('admin_penanggung_jwb/editPenanggungJwb/'.$id_penanggung_jwb,'location');*/
		$data = array(
			"STATUS_HAPUS" => 1
		);
		$this->penanggung_jwb->editData($data,'mp_penanggung_jwb', array('ID_PENANGGUNG_JWB' => $id));
		$tokonya = $this->penanggung_jwb->tampilData('mp_toko','*',array('ID_PENANGGUNG_JWB' => $id));
		foreach($tokonya as $data_toko){
			// Edit toko beserta produknya
			$this->penanggung_jwb->editData($data,'mp_produk', array('ID_TOKO' => $id));
		}
		$this->session->set_flashdata('notif', 'Produk berhasil dihapus');
		$this->session->set_flashdata('clr', 'success');
		redirect('admin_produk');
	}
	
	function tambahPenanggungJwb(){
		$data['judul_page'] = 'Tambah Penanggung Jawab UKM';
		$data['des_page'] = '';
		$data['page'] = 'tambah_penanggung_jwb';
		$data['provinsi'] = $this->penanggung_jwb->tampilData('mp_provinsi');
		$this->load->view($this->template,$data);
	}
	
	function tambahPenanggungJwbSubmit(){
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('telp', 'Telepon', 'required');
		$this->form_validation->set_rules('email', 'Email', 'valid_email');
		$this->form_validation->set_rules('id_provinsi', 'Provinsi', 'required');
		$this->form_validation->set_rules('id_kota', 'Kota', 'required');
		$this->form_validation->set_rules('id_kecamatan', 'Kecamatan', 'required');
		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
			redirect('admin_penanggung_jwb/tambahPenanggungJwb');
		}
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$telp = $this->input->post('telp');
		$email = $this->input->post('email');
		$s_bbm = $this->input->post('s_bbm');
		$id_provinsi = $this->input->post('id_provinsi');
		$id_kota = $this->input->post('id_kota');
		$id_kecamatan = $this->input->post('id_kecamatan');
		$kelurahan = $this->input->post('kelurahan');
		$tgl_terdaftar = ubahFormatTgl(tglSekarang(),'Y-m-d');
		if(!empty($_FILES['foto_profil']["tmp_name"])){
			// Jika upload
			$config['file_name'] = date("Ymdhis");
			$config['upload_path'] = './assets-admin/img/penanggung_jwb/';
	        $config['allowed_types'] = 'gif|jpg|png';
	        $config['max_size'] = 1048;
	        $config['max_width'] = 1024;
	        $config['max_height'] = 768;
	        $config['detect_mime'] = TRUE;
			$this->load->library("upload",$config);
			$filename = "foto_profil";
			if(!$this->upload->do_upload($filename)){
				$this->session->set_flashdata('notif', $this->upload->display_errors());
				$this->session->set_flashdata('clr', 'danger');
				redirect('admin_penanggung_jwb/tambahPenanggungJwb','location');
				exit();
			}
			$nm_img = $this->upload->data("file_name");
		}
		else{
			$nm_img = NULL;
		}
		$data = array(
			'NAMA' => $nama,
			'ALAMAT' => $alamat,
			'TELP' => $telp,
			'EMAIL' => $email,
			'S_BBM' => $s_bbm,
			'KELURAHAN' => $kelurahan,
			'ID_PROVINSI' => $id_provinsi,
			'ID_KOTA' => $id_kota,
			'ID_KECAMATAN' => $id_kecamatan,
			'TGL_TERDAFTAR' => $tgl_terdaftar,
			'FT_PROFIL' => $nm_img,
			'STATUS_HAPUS' => 0
		);
		$this->penanggung_jwb->tambahData($data,'mp_penanggung_jwb');
		$this->session->set_flashdata('notif', 'Tambah UKM Berhasil');
		$this->session->set_flashdata('clr', 'success');
		redirect('admin_penanggung_jwb/tambahPenanggungJwb','location');
	}
	
	function lihatKota(){
		$id_provinsi = $this->input->post('id_provinsi');
		$where = array(
			'ID_PROVINSI' => $id_provinsi
		);
		$data['kota'] = $this->penanggung_jwb->tampilData('mp_kokab','*',$where);
		$this->load->view('lihat_kota',$data);
	}
	
	function lihatKecamatan(){
		$id_kota = $this->input->post('id_kota');
		$where = array(
			'ID_KOTA' => $id_kota
		);
		$data['kecamatan'] = $this->penanggung_jwb->tampilData('mp_kecamatan','*',$where);
		$this->load->view('lihat_kecamatan',$data);
	}

	function laporan(){
		$data['judul_page'] = 'Laporan Penanggung Jawab';
		$data['des_page'] = '';
		$data['penanggung_jwb_ukm'] = $this->penanggung_jwb->tampilData('mp_penanggung_jwb', '*');
		$data['page'] = 'laporan_penanggung_jwb';
		$this->load->view($this->template,$data);
	}
	function laporan_pj(){
		$data['judul_page'] = 'Laporan Penanggung Jawab';
		$data['des_page'] = '';
		$data['penanggung_jwb_ukm'] = $this->penanggung_jwb->tampilData('mp_penanggung_jwb', '*');
		$data['page'] = 'laporan_pj';
		$this->load->view($this->template,$data);
	}
}
