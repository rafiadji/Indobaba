<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ukm_ekspedisi extends MY_Ukm {
	var $template = 'home_page';

	function __construct(){
		parent::__construct();
		$this->load->model("M_ukm_ekspedisi","ekspedisimodel");
	}
    public function index(){
        $id_akun =  $this->ekspedisimodel->idakun();
		$data['judul_page'] = 'Ekpedisi';
		$data['des_page'] = ''; // Dapat dikosongi
		$data['page'] = 'ekspedisiukm';
		$data['tampil'] = $tampil = $this->ekspedisimodel->tampilData("mp_ekspedisi_ukm","",array("ID_UKM" => $id_akun),TRUE);
        //$data['tampilukm'] = $this->ekspedisimodel->tampilData("mp_ekspedisi","",array("ID_EKSPEDISI" => $tampil->ID_EKSPEDISI),TRUE);
		$this->load->view($this->template,$data);
	}
}