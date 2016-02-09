<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Admin_ekspedisi extends MY_Admin {

	var $template = 'admin_page';



	function __construct(){
		parent::__construct();
		$this->load->model("M_admin_ekspedisi","ekspedisimodel");
		$this->session->set_userdata(array("menu_admin" => "master_data"));
	}

    public function index(){

		$data['judul_page'] = 'Ekpedisi';

		$data['des_page'] = ''; // Dapat dikosongi

		$data['page'] = 'ekspedisi';

		$data['tampil'] = $this->ekspedisimodel->tampilData("mp_ekspedisi"); 

		$this->load->view($this->template,$data);

	}

    public function harga($id = NULL){

         if($id == NULL){ redirect("404");}

         $data['judul_page'] = 'Tambah Harga Ekspedisi';

         $data['des_page'] = '';

		 $data['page'] = 'ekspedisi-harga';

         $tampil =  $this->ekspedisimodel->tampilData("mp_harga_ekspedisi","*",array("ID_EKSPEDISI" => $id), TRUE);

         $data['tampil'] = $tampil;

         $data['tampilprov'] = $this->ekspedisimodel->tampilData("mp_provinsi","*",array("ID_PROVINSI" => $tampil->ID_PROVINSI),TRUE);

         $data['tampilkota'] = $this->ekspedisimodel->tampilData("mp_kokab","*",array("ID_KOTA" => $tampil->ID_KOTA),TRUE);

         $data['tampilkecamatan'] = $this->ekspedisimodel->tampilData("mp_kecamatan","*",array("ID_KECAMATAN" => $tampil->ID_KECAMATAN),TRUE);

         $this->load->view($this->template,$data);

    }

    public function editHarga($id){

        if($id == NULL){ redirect("404");}

         $data['judul_page'] = 'Edit Harga Ekspedisi';

         $data['des_page'] = '';

		 $data['page'] = 'ekspedisi-editharga';

         $tampil = $this->ekspedisimodel->tampilData("mp_harga_ekspedisi","*",array("ID_HRG_EKS" => $id),TRUE);

         $data['tampil'] = $tampil;

         $data['tampilprov'] = $this->ekspedisimodel->tampilData("mp_provinsi","*");

         if($this->input->post("simpan") == TRUE){

             $this->form_validation->set_rules("provinsi","Provinsi","required");

            $this->form_validation->set_rules("kota","Kota","required");

            $this->form_validation->set_rules("kecamatan","Kecamatan","required");

            $this->form_validation->set_rules("harga_ekspedisi","Harga Ekspedisi","required|numeric");

              if($this->form_validation->run() == TRUE){

                 $data = array(

                  "ID_PROVINSI" => $this->input->post("provinsi"),

                  "ID_KOTA" => $this->input->post("kota"),

                  "ID_KECAMATAN" => $this->input->post("kecamatan"),

                  "HARGA" => $this->input->post("harga_ekspedisi")

                );

                $this->ekspedisimodel->editData($data ,"mp_harga_ekspedisi" ,array("ID_HRG_EKS" => $id));

                $this->session->set_flashdata('notif', "Ekspedisi Harga Berhasil Di Ubah !");

                $this->session->set_flashdata('clr', 'success');

                redirect("admin_ekspedisi/editHarga/$id");

                

            }

			else{

                $this->session->set_flashdata('notif', validation_errors());

                $this->session->set_flashdata('clr', 'danger');

               redirect("admin_ekspedisi/editHarga/$id");

            }

         }

          

         $this->load->view($this->template,$data);

    }

    public function tambahData(){

         $data['judul_page'] = 'Tambah Ekpedisi';

         $data['des_page'] = '';

		 $data['page'] = 'ekspedisi-tambahdata';

         

         if($this->input->post("simpan")){

            $this->form_validation->set_rules("nama_ekspedisi","Nama Ekspedisi","required|max_length[100]");

            $this->form_validation->set_rules("des_ekspedisi","Deskripsi Ekspedisi","required");

            if($this->form_validation->run()){

                $tanggal = tglSekarang();

                $waktu = wktSekarang();

                $data = array(

                  "NAMA_EKSPEDISI" => $this->input->post("nama_ekspedisi"),

                  "DES_EKSPEDISI" => $this->input->post("des_ekspedisi"),

                  "TGL_TERDAFTAR" => $tanggal,

                  "WKT_TERDAFTAR" => $waktu

                );

                $this->ekspedisimodel->tambahData($data ,"mp_ekspedisi");

                $this->session->set_flashdata('notif', "Ekspedisi Berhasil Di Tambah !");

                $this->session->set_flashdata('clr', 'success');

                redirect('admin_ekspedisi/tambahData'); 

            }

            else{

                $this->session->set_flashdata('notif', validation_errors());

                $this->session->set_flashdata('clr', 'danger');

                redirect('admin_ekspedisi/tambahData');

            }

        }

		$this->load->view($this->template,$data);

    }

    public function tambahHarga($id = NULL){

         if($id == NULL){ redirect("404");}

         $data['judul_page'] = 'Tambah Harga Ekspedisi';

         $data['des_page'] = '';

		 $data['page'] = 'ekspedisi-tambahharga';

         $data['tampilprov'] = $this->ekspedisimodel->tampilData("mp_provinsi", NULL);

         if($this->input->post("simpan")){

            $this->form_validation->set_rules("provinsi","Provinsi","required");

            $this->form_validation->set_rules("kota","Kota","required");

            $this->form_validation->set_rules("kecamatan","Kecamatan","required");

            $this->form_validation->set_rules("harga_ekspedisi","Harga Ekspedisi","required|numeric");

            if($this->form_validation->run() == TRUE){

                 $data = array(

                  "ID_EKSPEDISI" => $id,

                  "ID_PROVINSI" => $this->input->post("provinsi"),

                  "ID_KOTA" => $this->input->post("kota"),

                  "ID_KECAMATAN" => $this->input->post("kecamatan"),

                  "HARGA" => $this->input->post("harga_ekspedisi")

                );

                $this->ekspedisimodel->tambahData($data ,"mp_harga_ekspedisi");

                $this->session->set_flashdata('notif', "Ekspedisi Harga Berhasil Di Tambah !");

                $this->session->set_flashdata('clr', 'success');

                redirect("admin_ekspedisi/tambahHarga/$id");

                

            }

             else{

                $this->session->set_flashdata('notif', validation_errors());

                $this->session->set_flashdata('clr', 'danger');

                redirect("admin_ekspedisi/tambahHarga/$id");

            }

            

         }

         $this->load->view($this->template,$data);

    }

    public function edit($id = NULL){

        if($id == NULL){ redirect("404");}

         $data['judul_page'] = 'Edit Ekpedisi';

         $data['des_page'] = '';

		 $data['page'] = 'ekspedisi-editdata';

         $data['tampil'] = $this->ekspedisimodel->tampilData("mp_ekspedisi","*",array("ID_EKSPEDISI" => $id),TRUE);

          if($this->input->post("simpan")){

            $this->form_validation->set_rules("nama_ekspedisi","Nama Ekspedisi","required|max_length[100]");

            $this->form_validation->set_rules("des_ekspedisi","Deskripsi Ekspedisi","required");

            if($this->form_validation->run()){

                 $data = array(

                  "NAMA_EKSPEDISI" => $this->input->post("nama_ekspedisi"),

                  "DES_EKSPEDISI" => $this->input->post("des_ekspedisi"),

                );

                 $where = array(

                   "ID_EKSPEDISI" => $id 

                 );

                 $this->ekspedisimodel->editData($data ,"mp_ekspedisi" ,$where);

                 $this->session->set_flashdata('notif', "Ekspedisi Berhasil Di Ubah !");

                 $this->session->set_flashdata('clr', 'success');

                 redirect("admin_ekspedisi/edit/$id"); 

            }

            else{

                $this->session->set_flashdata('notif', validation_errors());

                $this->session->set_flashdata('clr', 'danger');

                redirect("admin_ekspedisi/edit/$id");

            }

          }

         $this->load->view($this->template,$data);

    }

    public function hapus($id = NULL){

         if($id == NULL){ redirect("404");}

         	$where = array(

			"ID_EKSPEDISI" => $id

		);

		$this->ekspedisimodel->hapusData("mp_ekspedisi",$where);

		$this->session->set_flashdata('notif', "Ekspedisi Berhasil di hapus");

		$this->session->set_flashdata('clr', 'success');

		redirect("admin_ekspedisi/");

    }

    function getKota(){

		$idprov = $_GET['idprov'];

		$where = array(

			"ID_PROVINSI" => $idprov

		);

		$tampilkota = $this->ekspedisimodel->tampilData("mp_kokab", NULL, $where);

		foreach($tampilkota as $row){

			echo '<option value="'.$row->ID_KOTA.'">'.$row->KOKAB.'</option>';

		}

	}

    public function dapatkota()

	{

		$idkota= $this->input->get_post('idkota');

		$idprov = $this->input->get_post('idprov');

		$where = array(

			"ID_PROVINSI" => $idprov

		);

		$tampilkota = $this->ekspedisimodel->tampilData("mp_kokab", NULL, $where);

		foreach ($tampilkota as $row) {

			$selected = ($row->ID_KOTA == $idkota) ? 'selected' : '';

			echo '<option value="'.$row->ID_KOTA.'"'.$selected.'>'.$row->KOKAB.'</option>';

		}

	}

	function getKecam(){

		$idkota = $_GET['idkota'];

		$where = array(

			"ID_KOTA"=>$idkota

		);

		$tampilkota = $this->ekspedisimodel->tampilData("mp_kecamatan", NULL, $where);

		foreach($tampilkota as $row){

			echo '<option value="'.$row->ID_KECAMATAN.'">'.$row->KECAMATAN.'</option>';

		}

	}

     public function dapatKecamatan()

	{

		$idkota= $this->input->get_post('idkota');

		$idkecam = $this->input->get_post('idkecamatan');

		$where = array(

			"ID_KOTA" => $idkota

		);

		$tampilkota = $this->ekspedisimodel->tampilData("mp_kecamatan", NULL, $where);

		foreach ($tampilkota as $row) {

			$selected = ($row->ID_KECAMATAN == $idkecam) ? 'selected' : '';

			echo '<option value="'.$row->ID_KECAMATAN.'"'.$selected.'>'.$row->KECAMATAN.'</option>';

		}

	}

}