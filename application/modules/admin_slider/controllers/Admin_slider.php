<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Admin_slider extends MY_Admin {



	var $template = 'admin_page';



	function __construct()

	{

		parent::__construct();

		$this->load->model('admin_slider/M_admin_slider', 'slidermodel');

		//$this->cekLogin();
	$this->session->set_userdata(array('menu_admin' => 'master_tampilan'));
    }



	public function index(){

		$data['judul_page'] = 'Data Slider';

		$data['des_page'] = 'Data Slider';

		$data['page'] = "slider";

		$data['tampil'] = $this->slidermodel->tampilData('mp_slider');

		$this->load->view($this->template, $data);

	}

	

	public function tambahSlider(){

		$data['judul_page'] = 'Tambah Slider';

		$data['des_page'] = 'Tambah Slider';

		$data['page'] = "tambahslider";

		if($this->input->post("simpan") == TRUE){

			$this->form_validation->set_rules("nama","Nama","required|max_length[50]");

			$this->form_validation->set_rules("status","Status","required");

			if($this->form_validation->run() == TRUE){

				if($_FILES['userfile']['name'] !=  ''){

					$config['upload_path']          = '././assets/images/slider/';

					$config['allowed_types'] = 'jpg|jpeg|png|gif|bmp';

					$config['max_size'] = '1024';

					$config['overwrite'] = TRUE;

					$this->load->library('upload', $config);

					if ( ! $this->upload->do_upload('userfile'))

					{

						$this->session->set_flashdata('notif', 'maaf foto tidak bisa diupload, ulangi lagi');

						$this->session->set_flashdata('clr', 'warning');

						redirect('admin_slider/tambahSlider');

					}

					else

					{

						   $uploaddata = $this->upload->data();

						 $data = array(

							"NAMA_SLIDER" => $this->input->post("nama"),

							"FT_SLIDER" => $uploaddata['file_name'],

							"STATUS_VALID" => $this->input->post("status")

						 );

						   

						   $this->slidermodel->tambahData($data ,"mp_slider");

						   $this->session->set_flashdata('notif', 'Data berhasil tersimpan!');

						   $this->session->set_flashdata('clr', 'success');

						   redirect('admin_slider/tambahSlider');

					}

				}

				else{

					$this->session->set_flashdata('notif', 'Gambar belum dipilih');

					$this->session->set_flashdata('clr', 'danger');

					redirect('admin_slider/tambahSlider');

				}

				

			}

			else{

				$this->session->set_flashdata('notif', validation_errors());

				$this->session->set_flashdata('clr', 'danger');

				redirect('admin_slider/tambahSlider');

			}

		}

		//$data['tampil'] = $this->slidermodel->tampilData('mp_slider');

		$this->load->view($this->template, $data);

	}

	public function editSlider($id = NULL){

		if($id == NULL){ redirect("404");}

		//if($this->slidermodel->cekSlider($id) == FALSE){ redirect("404");}

		if($this->input->post("simpan") == TRUE){

			$this->form_validation->set_rules("nama","Nama","required|max_length[50]");

			$this->form_validation->set_rules("status","Status","required");

			if($this->form_validation->run() == TRUE){

				if($_FILES['userfile']['name'] !=  ''){

					$akun =$id;$ftlama = $this->slidermodel->tampilData("mp_slider","*",array("ID_SLIDER" => $akun),TRUE);

					unlink('././assets/images/slider/'.$ftlama->FT_SLIDER);

					$config['upload_path']          = '././assets/images/slider/';

					$config['allowed_types'] = 'jpg|jpeg|png|gif|bmp';

					$config['max_size'] = '1024';

					$config['overwrite'] = TRUE;

					$this->load->library('upload', $config);

				

					if ( ! $this->upload->do_upload('userfile'))

					{

						$this->session->set_flashdata('notif', 'maaf foto tidak bisa diupload, ulangi lagi');

						$this->session->set_flashdata('clr', 'warning');

						redirect("admin_slider/editSlider/$id");

					}

					else

					{

						   $uploaddata = $this->upload->data();

						 $data = array(

							"NAMA_SLIDER" => $this->input->post("nama"),

							"FT_SLIDER" => $uploaddata['file_name'],

							"STATUS_VALID" => $this->input->post("status")

						 );

						 $where = array(

							"ID_SLIDER" =>$id

						 );

						   

						   $this->slidermodel->editData($data ,"mp_slider",$where);

						   $this->session->set_flashdata('notif', 'Data berhasil tersimpan!');

						   $this->session->set_flashdata('clr', 'success');

						   redirect("admin_slider/editSlider/$id");

					}

				}

				else{

					$data = array(

						"NAMA_SLIDER" => $this->input->post("nama"),

						

						"STATUS_VALID" => $this->input->post("status")

				 );

				 $where = array(

					"ID_SLIDER" =>$id

				 );			   

			   $this->slidermodel->editData($data ,"mp_slider",$where);

			   $this->session->set_flashdata('notif', 'Data berhasil tersimpan!');

			   $this->session->set_flashdata('clr', 'success');

			   redirect("admin_slider/editSlider/$id");

				}

			}

			else{

				$this->session->set_flashdata('notif', validation_errors());

				$this->session->set_flashdata('clr', 'danger');

				redirect("admin_slider/editSlider/$id");

			}

		}

		$data['tampil'] = $this->slidermodel->tampilData("mp_slider","*",array("ID_SLIDER" => $id),TRUE);

		

		$data['judul_page'] = 'Edit  Slider';

		$data['des_page'] = 'Edit Slider';

		$data['page'] = "editslider";

		$this->load->view($this->template, $data);

	}

	public function hapusSlider($id){

		 $akun =$id;$ftlama = $this->slidermodel->tampilData("mp_slider","*",array("ID_SLIDER" => $akun),TRUE);

		 $this->slidermodel->hapusData("mp_slider",array("ID_SLIDER" => $akun));

		 unlink('././assets/images/slider/'.$ftlama->FT_SLIDER);

		 redirect("admin_slider/");

		

	}

}