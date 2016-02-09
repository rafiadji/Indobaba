<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_info_web extends MY_Admin {

	var $template = 'admin_page';

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_admin_info_web', 'info_web');
		$this->session->set_userdata(array('menu_admin' => 'master_pengaturan'));
    }

	function index(){
		$data['judul_page'] = 'Informasi Web';
		$data['des_page'] = '';
		$data['page'] = 'info_web';
		$where = array(
			"ID_INFO" => 1
		);
		$data['info_web'] = $this->info_web->tampilData('mp_info_web','*',$where,TRUE);
		$this->load->view($this->template,$data);
	}
	
	function editInfoWeb(){
		$this->form_validation->set_rules('nama', 'Nama Web', 'required');
		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
			redirect('admin_ukm/tambahUkm');
		}
		if($_FILES['userfile']['name'] !=  ''){
			$config['upload_path']          = '././assets/images/home/';
					$config['allowed_types'] = 'png';
					$config['max_size'] = '1024';
					$config['overwrite'] = TRUE;
					$config['file_name'] = "logo";
					$this->load->library('upload', $config);
					if ( ! $this->upload->do_upload('userfile'))
					{
						$this->session->set_flashdata('notif', 'maaf foto tidak bisa diupload, ulangi lagi');
						$this->session->set_flashdata('clr', 'warning');
						redirect('admin_info_web/');
					}
					else{
						$uploaddata = $this->upload->data();
						$foto = $uploaddata['file_name'];
					}
		}
		else{
			$foto = 'logo.png';
		}
		$nama = $this->input->post('nama');
		$des_halaman = $this->input->post('des_halaman');
		$tagline = $this->input->post('tagline');
		$meta_des = $this->input->post('meta_des');
		$meta_key = $this->input->post('meta_key');
		$no_hp = $this->input->post('no_hp');
		$no_telp = $this->input->post('no_telp');
		$s_fb = $this->input->post('s_fb');
		$s_twt = $this->input->post('s_twt');
		$s_ggl = $this->input->post('s_ggl');
		$array = array(
			'NAMA' => $nama,
			'DES_HALAMAN' => $des_halaman,
			'TAGLINE' => $tagline,
			'META_DES' => $meta_des,
			'META_KEY' => $meta_key,
			'NO_HP' => $no_hp,
			'NO_TELP' => $no_telp,
			'S_FB' => $s_fb,
			'S_GGL' => $s_ggl,
			'S_TWT' => $s_twt,
			'FT_PROFIL' => $foto
		);
		$where = array('ID_INFO' => 1);
		$sql = $this->info_web->editData($array, 'mp_info_web', $where);
		$this->session->set_flashdata('notif', 'Informasi berhasil diperbaharui');
		$this->session->set_flashdata('clr', 'success');
		redirect('admin_info_web/');
	}

}

