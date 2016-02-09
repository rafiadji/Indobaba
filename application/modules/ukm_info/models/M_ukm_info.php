<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class M_ukm_info extends CI_Model {



	function __construct(){

		parent::__construct();

    }

	function nama_bank($id){

		$data = $this->tampilData("mp_bank", "*", array("ID_BANK" => $id),TRUE);

		return $data->BANK;

	

	}

	function notifikasipesan(){

		$id_akun = $this->idakun();

		$data = $this->db->query("SELECT * FROM mp_pesan WHERE ID_TOKO = $id_akun ORDER BY ID_PESAN DESC LIMIT 0,1")->row();

		return $data->LEVEL;

	}

	function templateE_toko(){

		$id_akun = $this->idakun();

		$data = $this->db->query("SELECT * FROM mp_toko WHERE ID_TOKO = $id_akun")->row();

		return $data->NM_TOKO;

	}

	function cari_bank($id){

		

		return $data = $this->db->query("SELECT * FROM mp_bank WHERE id_bank NOT IN (SELECT ID_BANK FROM mp_rekening WHERE ID_PEMILIK = $id AND LEVEL = 2)")->result();

	

	}
	function tampil_gambar(){
		$id = $this->idakun();
		$data = $this->db->query("SELECT * FROM mp_toko WHERE ID_TOKO = $id")->row();

		return $data->FT_PROFIL;
	}

	function tampil_pesan($id){

		$data = $this->db->query("SELECT * FROM mp_pesan WHERE ID_TOKO = $id ORDER BY ID_PESAN ASC")->result();

		return $data;

	}

	function tampilData($nm_tbl = NULL, $select = NULL, $where = array(),$result = FALSE,$limit_start = NULL,$limit_end = NULL){

	if(count($where) > 0){

		foreach($where as $key =>$val){

			$this->db->where($key,$val);

		}

	}

	if($select != NULL){

		$this->db->select($select);

	}

	if($limit_start != NULL){

		$this->db->limit($limit_start);

	}

	elseif($limit_start != NULL and $limit_end != NULL ){

		$this->db->limit($limit_start,$limit_end);

	}

	$query = $this->db->get($nm_tbl);

		if($query->num_rows() > 0){

			if($result == TRUE){

				$data = $query->row();

			}

			elseif($result != NULL){

				$data = $query->result();

			}

			else{

				$data = $query->result();

			}

			return $data;

		}

}

function tambahData($data = array(),$table = NULL)

	{

		$sql = $this->db->insert($table, $data);

		if($sql){

			return TRUE;

		}

		else{

			return FALSE;

		}

	}

	function hitungtransaksibaru(){

		$id_akun = $this->idakun();

		$tampil = $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TOKO = $id_akun AND ID_STATUS='2' AND STS_TAMPIL!=0 GROUP BY NO_TRANS");
		
		return $tampil->num_rows();

		
	}
	function hitungtransaksiresi(){

		$id_akun = $this->idakun();

		$tampil = $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TOKO = $id_akun AND ID_STATUS='3' AND STS_TAMPIL!=0 GROUP BY NO_TRANS");
		
		return $tampil->num_rows();

		
	}



	function editData($data = array(),$table = NULL ,$where = array())

	{

		$sql = $this->db->where($where)

				->update($table,$data);

		if($sql){

			return TRUE;

		}

		else{

			return FALSE;

		}

	}



	function hapusData($table = NULL,$where = array())

	{

		$sql = $this->db->delete($table, $where);

		if($sql){

			return TRUE;

		}

		else{

			return FALSE;

		}

	}

	function idakun(){

    $id_akun =  $this->session->userdata("id_akun_ukm");

		$where = array(

			"ID_USER" => $id_akun

		);

		$akun = $this->infomodel->tampilData("mp_user","*",$where,TRUE);

        return $akun->ID_AUTH;

	}

	

}