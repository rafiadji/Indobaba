<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin_ukm extends CI_Model {

	function __construct(){
		parent::__construct();
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
	
	function tambahData($data = array(),$table = NULL){
	$sql = $this->db->insert($table,$data);
	if($sql){
		return TRUE;
	}
	else{
		return FALSE;
	}
}
	
	function editData($table = NULL, $data = array(), $where = array()){
		if(count($where) > 0){
			foreach($where as $key =>$val){
				$this->db->where($key,$val);
			}
		}
		$sql = $this->db->update($table, $data); 
		if($sql){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}