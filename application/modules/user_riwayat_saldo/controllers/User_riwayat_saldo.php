<?php defined('BASEPATH') OR exit('No direct script access allowed');
class User_riwayat_saldo extends MY_User {
	
	var $template = 'home_page';
	var $template_user = "user_page";

	function __construct()
	{
		parent::__construct();
		$this->load->model("M_user_riwayat_saldo","saldo");
	}
	
	public function index()
	{
		$auth = $this->session->userdata('id_akun_auth');
		$akun = $this->session->userdata("id_akun_user");
		$data['tampil'] = $this->saldo->tampilData("view_riwayat_saldo", NULL, array('ID_AKUN' => $akun));
		$data['page_user'] = "riwayat_saldo";
		$data['page'] = $this->template_user;
		$this->load->view($this->template, $data);
	}
	
	public function detailsaldo($id)
	{
		$akun = $this->session->userdata("id_akun_user");
		$auth = $this->session->userdata('id_akun_auth');
		$data['akun'] = $akun;
		$data['auth'] = $auth;
		$data['toko'] = $this->db->query("SELECT * FROM view_checkout WHERE ID_AKUN = '$akun' AND NO_TRANS = '$id' GROUP BY ID_TOKO")->result();
		$data['bukti'] = $this->db->query("SELECT * FROM view_bukti WHERE NO_TRANS = '$id'")->row();
		$data['stat'] = $this->db->query("SELECT ID_STATUS, STS_BAYAR, STS_SALDO FROM mp_transaksi WHERE ID_AKUN = '$akun' AND NO_TRANS = '$id'")->row();
		$where = array(
			'LEVEL' => 1
		);
		$data['rekening'] = $this->saldo->tampilData('view_rekening','*',$where);
		$cek_hari = $this->db->query("SELECT * FROM view_checkout WHERE ID_AKUN = '$akun' AND NO_TRANS = '$id'")->row();
		$hari = date("Y-m-d");
		if ($hari == $cek_hari->JTH_TEMPO && $data['stat']->STS_BAYAR == 0) {
			$up_trans = $this->saldo->editData(array('ID_STATUS' => 9), 'mp_transaksi', array('NO_TRANS' => $id));
		}
		$data['page'] = "detailsaldo";		
		$this->load->view($this->template, $data);
	}
}