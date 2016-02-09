<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_kategori extends MY_Admin {
	var $template = 'admin_page';

	function __construct(){
		parent::__construct();
		$this->load->model("M_admin_kategori","kategorimodel");
		$this->session->set_userdata(array('menu_admin' => 'master_ukm'));
	}

	public function index(){
		$data['judul_page'] = 'Kategori';
		$data['des_page'] = ''; // Dapat dikosongi
		$data['page'] = 'kategori';
		$data['tampil'] = $this->kategorimodel->tampilData("mp_kategori"); 
		$this->load->view($this->template,$data);
	}

	// public function lihatKategori(){
		// $data['judul_page'] = 'Kategori';
		// $data['des_page'] = ''; // Dapat dikosongi
		// $data['page'] = 'kategori';
		// $data['tampil'] = $this->kategorimodel->tampilData("mp_kategori"); 
		// $this->load->view($this->template,$data);
	// }

	public function tambahKategori(){
		$data['judul_page'] = 'Tambah Kategori';
		$data['des_page'] = 'Tambah Kategori '; // Dapat dikosongi
		$data['page'] = 'tambahkategori';
		$this->load->view($this->template,$data);
	}

	public function tambahKategoriSubmit(){
		$this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required|max_length[50]');
		if($this->form_validation->run() == FALSE){
		  	$this->session->set_flashdata('notif', validation_errors());
		  	$this->session->set_flashdata('clr', 'danger');
		  	redirect('admin_kategori/tambahKategori');
		}
		$kategori = $this->input->post("nama_kategori"); 
		$data = array(
			"KATEGORI" => $kategori
		);
		$this->kategorimodel->tambahData($data,"mp_kategori");
		$this->session->set_flashdata('notif', "Kategori Berhasil Di Tambah !");
		$this->session->set_flashdata('clr', 'success');
		redirect('admin_kategori/tambahKategori');
	}

	public function editKategori($id = NULL){
		if($id == NULL){
			redirect("admin_kategori/lihatkategori");
		}
		$data['id'] = $id;
		$data['judul_page'] = 'Edit Kategori';
		$data['des_page'] = ''; // Dapat dikosongi
		$data['page'] = 'editkategori';
		$where = array(
			"ID_KATEGORI" => $id
		);
		$data['tampil'] = $this->kategorimodel->tampilData("mp_kategori", "*", $where,TRUE); 
		$this->load->view($this->template,$data);
	}

	public function editKategoriSubmit($id){
		$this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required|max_length[50]');
		if ($this->form_validation->run() == FALSE)

                {

                        $this->session->set_flashdata('notif', validation_errors());

			$this->session->set_flashdata('clr', 'danger');

			redirect("admin_kategori/editKategori/$id");

                }

		$kategori = $this->input->post("nama_kategori");

		$data = array(

				"KATEGORI" => $kategori

				

			      );

		$where = array(

				"ID_KATEGORI" => $id

		);

		

		$this->kategorimodel->editData($data,"mp_kategori" ,$where);

		$this->session->set_flashdata('notif', "Kategori Berhasil Di Ubah !");

		$this->session->set_flashdata('clr', 'success');

		redirect("admin_kategori/editKategori/$id");

	}

	public function hapusKategori($id){

		$where = array(

			"ID_KATEGORI" => $id

		);

		$this->kategorimodel->hapusData("mp_kategori",$where);

		$this->session->set_flashdata('notif', "Kategori Berhasil Di Hapus !");

		$this->session->set_flashdata('clr', 'success');

		redirect("admin_kategori/lihatKategori/");

		

	}

	public function lihatSubKategori(){

		$data['judul_page'] = 'Sub Kategori';

		$data['des_page'] = ''; // Dapat dikosongi

		$data['page'] = 'subkategori';

		$data['tampil'] = $this->kategorimodel->tampilData("view_kategori"); 

		$this->load->view($this->template,$data);

	}

	public function tambahSubKategori(){

		$data['judul_page'] = 'Tambah SubKategori';

		$data['des_page'] = 'Tambah SubKategori '; // Dapat dikosongi

		$data['page'] = 'tambahsubkategori';

		$data['kategori'] = $this->kategorimodel->tampilData("mp_kategori"); 

		$this->load->view($this->template,$data);

		

	}

	public function tambahSubKategoriSubmit(){

		$this->form_validation->set_rules('nama_subkategori', 'Nama Sub Kategori', 'required|max_length[50]');

		$this->form_validation->set_rules('kategori', 'Kategori', 'required');

		  if ($this->form_validation->run() == FALSE)

                {

                        $this->session->set_flashdata('notif', validation_errors());

			$this->session->set_flashdata('clr', 'danger');

			redirect('admin_kategori/tambahSubKategori');

                }

		

		$subkategori = $this->input->post("nama_subkategori");

		$kategori = $this->input->post("kategori"); 

		$data = array(

			"ID_KATEGORI" => $kategori,

			"SUB_KATEGORI" => $subkategori

		);

		$this->kategorimodel->tambahData($data,"mp_sub_kategori");

		

		$this->session->set_flashdata('notif', "Sub Sub Kategori Berhasil Di Tambah !");

		$this->session->set_flashdata('clr', 'success');

		redirect('admin_kategori/tambahSubKategori');

		

		

	}

	public function editSubKategori($id){

		if($id == NULL){

			redirect("admin_kategori/lihatsubkategori");

		}

		$data['id'] = $id;

		$data['judul_page'] = 'Edit Sub Kategori';

		$data['des_page'] = ''; // Dapat dikosongi

		$data['page'] = 'editsubkategori';

		$where = array(

			"ID_SUB_KATEGORI" => $id

		);

		$data['tampil'] = $this->kategorimodel->tampilData("mp_sub_kategori", "*", $where);

		$data['kategori'] = $this->kategorimodel->tampilData("mp_kategori"); 

		$this->load->view($this->template,$data);

	}

	public function editSubKategoriSubmit($id){

		$this->form_validation->set_rules('nama_subkategori', 'Nama Sub Kategori', 'required|max_length[50]');

		$this->form_validation->set_rules('kategori', 'Kategori', 'required');

		  if ($this->form_validation->run() == FALSE)

                {

                        $this->session->set_flashdata('notif', validation_errors());

			$this->session->set_flashdata('clr', 'danger');

			redirect("admin_kategori/editSubKategori/$id");

                }

		$subkategori = $this->input->post("nama_subkategori");

		$kategori = $this->input->post("kategori"); 

		$data = array(

			"ID_KATEGORI" => $kategori,

			"SUB_KATEGORI" => $subkategori

		);

		$where = array(

				"ID_SUB_KATEGORI" => $id

		);

		

		$this->kategorimodel->editData($data,"mp_sub_kategori" ,$where);

		$this->session->set_flashdata('notif', "Sub Kategori Berhasil Di Ubah !");

		$this->session->set_flashdata('clr', 'success');

		redirect("admin_kategori/editSubKategori/$id");

	}

	public function hapusSubKategori($id){

		$where = array(

			"ID_SUB_KATEGORI" => $id

		);

		$this->kategorimodel->hapusData("mp_sub_kategori",$where);

		$this->session->set_flashdata('notif', "Sub Kategori Berhasil Di Hapus !");

		$this->session->set_flashdata('clr', 'success');

		redirect("admin_kategori/lihatSubKategori/");

		

	}

}

