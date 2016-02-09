<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Admin_diskusi extends MY_Admin {



	var $template = 'admin_page';

    function __construct()

	{

		parent::__construct();

		$this->load->model('admin_diskusi/M_admin_diskusi', 'diskusi');

		$this->session->set_userdata(array("menu_admin" => "master_diskusi"));
		$this->load->library('session');

    }



	public function index()

	{
		$this->session->unset_userdata("idtokochat");
		$data['judul_page'] = 'Pertanyaan Ukm';

		$data['des_page'] = 'Pertanyaan Ukm';

		$data['page'] = "diskusi";

		

		//$data['tampil'] = $this->customersmodel->tampilData('mp_akun');

		$this->load->view($this->template, $data);

	}
	public function menu(){
		$data['tampiltoko'] = $this->diskusi->tampilData("mp_toko", "*");

		$this->load->view("menu", $data);
	}

	public function data(){

		$id_akun =  $this->input->post("idtoko");
		$this->session->set_userdata("idtokochat",$id_akun);
		$data['nmtoko'] = $this->input->post("nmtoko");

		$data['tampilkomentar'] = $this->diskusi->tampil_pesan($id_akun);

		$datapesan = array(
			"NOTIF_BINTANG_ADMIN" => 0
			);
		$wherepesan = array(
			"ID_TOKO" => $id_akun
			);
		$this->diskusi->editData($datapesan ,"mp_pesan_notif" ,$wherepesan);


		$this->load->view("data",$data);	

	}
	public function autoupdatemessage(){
		$id_akun =  $this->input->post("idtoko");
		$db = $this->db->query("select * from mp_pesan_notif WHERE ID_TOKO = $id_akun")->row();
		echo $db->NOTIF_BINTANG_ADMIN;
		//echo $this->db->last_query();
	}

	public function tambahpesan(){

		$data = array(

							  "ISI_PESAN" => $this->input->post("pesan"),

							  "ID_TOKO" => $this->input->post("idtoko"),

							  "TGL_PESAN" => date("Y-m-d H:i:s"),

							  "LEVEL" => 1

							  );
				$this->diskusi->tambahData($data ,"mp_pesan");


	}

	public function update_bintang_toko(){

		$id_akun =$this->input->post("idtoko");

		$data = array(

			"NOTIF_BINTANG_UKM" => '1',
			"NOTIF_SUARA_UKM" => '1',

		);

		$where = array(

			"ID_TOKO" => $id_akun,

		);

		$this->diskusi->editData($data,"mp_pesan_notif",$where);

		echo $this->db->last_query();

	}

	public function notif_bintang(){

		$ulang = $this->db->query("SELECT * FROM mp_user WHERE ID_LEVEL = 2")->result();

		foreach($ulang as $roww){

			$data = $this->db->query("SELECT * FROM mp_pesan_notif 	WHERE ID_TOKO = $roww->ID_AUTH")->row();
			echo $data->NOTIF_BINTANG_ADMIN;

			if($data->NOTIF_BINTANG_ADMIN == 1){

				 echo $data->NOTIF_BINTANG_ADMIN;

				exit();

			}

		}

	}

	

}