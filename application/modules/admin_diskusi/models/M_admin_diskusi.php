<?php defined('BASEPATH') OR exit('No direct script access allowed');



class M_admin_diskusi extends CI_Model {

	 function tampil_pesan($id){

		$data = $this->db->query("SELECT * FROM mp_pesan WHERE ID_TOKO = $id ORDER BY ID_PESAN ASC")->result();

		return $data;

	}

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
	function updatebintang($idtoko){
		$db = $this->db->query("SELECT NOTIF_BINTANG_ADMIN FROM mp_pesan_notif WHERE ID_TOKO = $idtoko")->row();
		return $db->NOTIF_BINTANG_ADMIN;

	}
	function tampil_gambar($id){
		$data = $this->db->query("SELECT * FROM mp_toko WHERE ID_TOKO = $id")->row();

		return $data->FT_PROFIL;
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

}