<?php
class M_user_profil extends CI_Model{
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
function idakun(){
    $id_akun =  $this->session->userdata("id_akun_user");
		$where = array(
			"ID_USER" => $id_akun
		);
		$akun = $this->profilmodel->tampilData("mp_user","*",$where,TRUE);
        return $akun->USERNAME;
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
    function tt ($id1,$id2,$nama){
        if($id1 == $id2){
            	echo "<option value=$id1 selected>$nama</option>";
	
            }
            else{
                echo "<option value=$id1 >$nama</option>";
	
            }
    }
    function yy ($id1,$id2,$nama){
        if($id1 == $id2){
            	echo "<option value=$id1 selected>$nama</option>";
	
            }
            else{
                echo "<option value=$id1 >$nama</option>";
	
            }
    }
    function hapusfoto(){
      $akun = $this->idakun();
      $ftlama = $this->tampilData("mp_akun","*",array("ID_AKUN" => $akun),TRUE);
      
      unlink('././assets/images/user/'.$ftlama->FT_PROFIL);
    }
}