<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Admin_keuntungan extends MY_Admin {

	var $template = 'admin_page';



	function __construct(){

		parent::__construct();

		$this->load->model("M_admin_keuntungan","untungmodel");
		$this->session->set_userdata(array('menu_admin' => 'master_pengaturan'));

	}

    public function index(){

         $data['judul_page'] = 'Setting Keuntungan';

		$data['des_page'] = ''; // Dapat dikosongi

		$data['page'] = 'keuntungan';

		$data['tampil'] = $this->untungmodel->tampilData("mp_keuntungan",'*',array(),TRUE);

        if($this->input->post("simpan") == TRUE){

            $this->form_validation->set_rules("keuntunganukm","Keuntungan UKM","required|numeric");

            $this->form_validation->set_rules("keuntunganpj","Keuntungan Penanggung Jawab","required|numeric");

            if($this->form_validation->run() == TRUE){

                $data = array(

                  "KEUNTUNGAN_UKM" => $this->input->post("keuntunganukm"),

                  "KEUNTUNGAN_PJ" => $this->input->post("keuntunganpj"),

                );

                $where = array(

                    "ID_KEUNTUNGAN" => 0

                );

                $this->untungmodel->editData($data ,"mp_keuntungan" ,$where);

                $this->session->set_flashdata('notif', "Keuntungan Berhasil di Ubah");

                $this->session->set_flashdata('clr', 'success');

                redirect('admin_keuntungan');

            }

            else{

            $this->session->set_flashdata('notif', validation_errors());

		  	$this->session->set_flashdata('clr', 'danger');

		  	redirect('admin_keuntungan');

        }

        }

        

		$this->load->view($this->template,$data);

    }

   

    

}