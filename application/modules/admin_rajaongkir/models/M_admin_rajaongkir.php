<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin_rajaongkir extends CI_Model {
     function tampilData($nm_tbl = NULL, $select = NULL, $where = array(),$result = FALSE,$limit_start = NULL,$limit_end = NULL)
    {

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
	function cekid($id){
		  
		 $cek =  $this->db->query("SELECT COUNT(*) AS hitung FROM mp_akun where ID_AKUN = $id")
						 ->row();
		  if($cek->hitung != 0){
				   return TRUE;
		  }
		  else{
			       return FALSE;
		  }
	}
	function cekProvinsi($id){
		  $cek = $this->tampilData("mp_provinsi","*",array("ID_PROVINSI" => $id),TRUE);
		  return $cek->PROVINSI;
	}
	function cekKota($id){
		  $cek = $this->tampilData("mp_kokab","*",array("ID_KOTA" => $id),TRUE);
		  return $cek->KOKAB;
	}
	function cekKecam($id){
		  $cek = $this->tampilData("mp_kecamatan","*",array("ID_KECAMATAN" => $id),TRUE);
		  return $cek->KECAMATAN;
	}
	function cekFoto($id){
	 $A = "default.png";
	 $cek = $this->tampilData("mp_akun","*",array("ID_AKUN" => $id),TRUE);
	 if($cek->FT_PROFIL == ""){
		  return $A;
	 }
	 else{
		  return $cek->FT_PROFIL;
	 }
	}
	
}