<?php

class M_home_product extends CI_Model{

    function tampilData($nm_tbl = NULL, $select = NULL, $where = array(),$result = FALSE,$limit_start = NULL,$limit_end = NULL,$order = NULL){

	if(count($where) > 0){

		foreach($where as $key =>$val){

			$this->db->where($key,$val);

		}

	}

	if($select != NULL){

		$this->db->select($select);

	}

	if($order != NULL){

		$this->db->order_by($order);

	}

	if($limit_start != NULL){

		$this->db->limit($limit_start);

	}

	if($limit_start != NULL and $limit_end != NULL ){

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
function tampilsubkategori($id){
	return $this->db->query("SELECT * FROM mp_sub_kategori WHERE ID_KATEGORI = $id")->result();
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

	function tampilProdukhits(){

		return $tampil = $this->db->query("SELECT * FROM mp_produk WHERE STS_PUBLISH = '1' ORDER BY HITS DESC LIMIT 0,6")

						   ->result();

		

	}

	function hitungbarang(){

		return $tampil = $this->db->query("SELECT COUNT(*) AS hitung FROM mp_produk WHERE STS_PUBLISH = '1'")

								  ->row();

	}

	function hitungukm(){

		return $tampil = $this->db->query("SELECT COUNT(*) AS hitung FROM mp_toko")

								  ->row();

	}

	function hitungbarangukm($id){

		return $tampil = $this->db->query("SELECT COUNT(*) AS hitung FROM mp_produk WHERE ID_TOKO = $id AND  STS_PUBLISH = '1'")

								  ->row();

	}

	function hitungbarangkat($id){

		return $tampil = $this->db->query("SELECT COUNT(*) AS hitung FROM mp_produk WHERE ID_KATEGORI = $id AND  STS_PUBLISH = '1'")

								  ->row();

	}

	function tampilterbaru($a,$b){

		return $this->db->query("SELECT * FROM mp_produk WHERE STS_PUBLISH = '1' ORDER BY ID_PRODUK DESC LIMIT $b, $a ")

						->result();

	}
	function hitungpabrikcari($produk){
		return $tampil = $this->db->query("SELECT COUNT(*) AS hitung FROM mp_toko WHERE  NM_TOKO LIKE '%$produk%'")

								  ->row();

	}

	function hitungbarangcari($produk,$sts){

		if($sts == "all"){

			return $tampil = $this->db->query("SELECT COUNT(*) AS hitung FROM view_pencarian WHERE STS_PUBLISH = '1' AND NM_PRODUK LIKE '%$produk%' OR KATEGORI LIKE '%$produk%' OR SUB_KATEGORI LIKE '%$produk%'")

								  ->row();

		}

		else{

			return $tampil = $this->db->query("SELECT COUNT(*) AS hitung FROM view_pencarian  WHERE STS_PUBLISH = '1' AND ID_KATEGORI = $sts AND NM_PRODUK LIKE '%$produk%' OR KATEGORI LIKE '%$produk%' OR SUB_KATEGORI LIKE '%$produk%'")

								  ->row();

		}

	}

	function hitungbarangcariukm($produk,$ukm,$min,$max,$urut){

		//return $tampil = $this->db->query("SELECT COUNT(*) AS hitung FROM mp_produk  WHERE STS_PUBLISH = '1' AND ID_TOKO = $ukm AND NM_PRODUK LIKE '%$produk%'  OR KEY_META LIKE '%$produk%'")

								  //->row();

								  if($min != 0){

			$this->db->where('HARGA >=', $min);

						

		}

		if($max != 0){

			$this->db->where('HARGA <=', $max);

					

		}

		if($produk != "Semua Produk"){

					$this->db->where("NM_PRODUK LIKE '%$produk%'");

		}

		if($urut == "baru"){

			$this->db->order_by('ID_PRODUK', 'DESC');

		}

		if($urut == "murah"){

			$this->db->order_by('HARGA', 'ASC');

		}

		if($urut == "mahal"){

			$this->db->order_by('HARGA', 'DESC');

		}



		$this->db->where(array("STS_PUBLISH" => '1',"ID_TOKO" => $ukm));

		$this->db->get("mp_produk");

		return $this->db->count_all_results();

	}

	function caribarangdikategori($produk,$ukm,$minn,$max,$urut,$status,$halaman,$A){

		if($status == 1){

			$this->db->limit($halaman,$A);

		}

		

		if($minn != 0){

			$this->db->where('HARGA >=', $minn);

		}

		if($max != 0){

			$this->db->where('HARGA <=', $max);

		}

		if($produk != ""){

					$this->db->where("NM_PRODUK LIKE '%$produk%'");

		}

		if($urut == "baru"){

			$this->db->order_by('ID_PRODUK', 'DESC');

		}

		if($urut == "murah"){

			$this->db->order_by('HARGA', 'ASC');

		}

		if($urut == "mahal"){

			$this->db->order_by('HARGA', 'DESC');

		}

		$this->db->where(array("STS_PUBLISH" => '1',"ID_TOKO" => $ukm));



		$query = $this->db->get("mp_produk");

		return $query->result();

	}
	function caritokodilihat_ukm($namatoko,$provinsi,$kota,$halaman,$A){
		
		if($provinsi != "semua"){
			$this->db->where("ID_PROVINSI",$provinsi);
			if($kota != "semua"){
				$this->db->where("ID_KOTA",$kota);
			}
		}
		if($namatoko != ""){
			$this->db->where("NM_TOKO LIKE '%$namatoko%'");
		}
		$this->db->limit($A,$halaman);
		$this->db->order_by('ID_TOKO', 'DESC');
		$query = $this->db->get("mp_toko");

		return $query->result();

	}
	function hitungcaritokodilihat_ukm($namatoko,$provinsi,$kota){
		
		if($provinsi != "semua"){
			$this->db->where("ID_PROVINSI",$provinsi);
			if($kota != "semua"){
				$this->db->where("ID_KOTA",$kota);
			}
		}
		if($namatoko != ""){

					$this->db->where("NM_TOKO LIKE '%$namatoko%'");

		}
		$this->db->order_by('ID_TOKO', 'DESC');
		$query = $this->db->get("mp_toko");

		return $query->num_rows();
	}
	function hitungcaribarangdilihatproduk($produk,$minn,$max,$urut,$kategori,$provinsi,$kota,$status,$halaman,$A){

		
		

		if($minn != 0){
			$this->db->where("HARGA_AS >= $minn");

		}

		if($max != 0){

			$this->db->where("HARGA_AS <= $max");

		}

		if($produk != ""){

					$this->db->where("NM_PRODUK LIKE '%$produk%'");

		}

		if($urut == "baru"){

			$this->db->order_by('ID_PRODUK', 'DESC');

		}
		if($urut == "laris"){

			$this->db->order_by('IN_CART', 'DESC');

		}

		if($urut == "murah"){

			$this->db->order_by('HARGA_AS', 'ASC');

		}

		if($urut == "mahal"){

			$this->db->order_by('HARGA_AS', 'DESC');

		}
		if($kategori != "semua"){
			$this->db->where("ID_SUB_KATEGORI",$kategori);
		}
		
	

		//$this->db->limit($A,$halaman);
			if($provinsi != "semua"){
				//$caritoko = $this->caritoko($provinsi,$kota);
					if($kota !="semua"){
					$caritoko = $this->db->query("SELECT * FROM mp_toko WHERE ID_PROVINSI = $provinsi AND ID_KOTA = $kota");
				}else{
					$caritoko = $this->db->query("SELECT * FROM mp_toko WHERE ID_PROVINSI = $provinsi");
				}
				if($caritoko->num_rows() != 0){
					$i = 1;
					foreach ($caritoko->result() as $row) {
						/*if($i == 1){
							$this->db->where("ID_TOKO",$row->ID_TOKO);
						}
						else{
							$this->db->or_where("ID_TOKO",$row->ID_TOKO);
							$this->db->where_in("ID_TOKO",$row->ID_TOKO);
						}*/
						$ulang[] = $row->ID_TOKO;
						
						$i++;
						
					}
					$this->db->where_in("ID_TOKO",$ulang);
				}
				else{
					$this->db->where("ID_TOKO",0);
				}
				
			//echo $this->db->last_query();
		}

	

		$this->db->where(array("STS_PUBLISH" => '1'));
		$query = $this->db->get("mp_produk");
	

		return $query->num_rows();

	}


	function caribarangdilihatproduk($produk,$minn,$max,$urut,$kategori,$provinsi,$kota,$status,$halaman,$A){

		
		
		if($minn != 0){
			$this->db->where("HARGA_AS >= $minn");

		}

		if($max != 0){

			$this->db->where("HARGA_AS <= $max");

		}

		if($produk != ""){

					$this->db->where("NM_PRODUK LIKE '%$produk%'");

		}

		if($urut == "baru"){

			$this->db->order_by('ID_PRODUK', 'DESC');

		}
		if($urut == "laris"){

			$this->db->order_by('IN_CART', 'DESC');

		}

		if($urut == "murah"){

			$this->db->order_by('HARGA_AS', 'ASC');

		}

		if($urut == "mahal"){

			$this->db->order_by('HARGA_AS', 'DESC');

		}
		if($kategori != "semua"){
			$this->db->where("ID_SUB_KATEGORI",$kategori);
		}
		

		
		if($provinsi != "semua"){
				//$caritoko = $this->caritoko($provinsi,$kota);
					if($kota !="semua"){
					$caritoko = $this->db->query("SELECT * FROM mp_toko WHERE ID_PROVINSI = $provinsi AND ID_KOTA = $kota");
				}else{
					$caritoko = $this->db->query("SELECT * FROM mp_toko WHERE ID_PROVINSI = $provinsi");
				}
				if($caritoko->num_rows() != 0){
					$i = 1;
					foreach ($caritoko->result() as $row) {
						/*if($i == 1){
							$this->db->where("ID_TOKO",$row->ID_TOKO);
						}
						else{
							$this->db->or_where("ID_TOKO",$row->ID_TOKO);
							$this->db->where_in("ID_TOKO",$row->ID_TOKO);
						}*/
						$ulang[] = $row->ID_TOKO;
						
						$i++;
						
					}
					$this->db->where_in("ID_TOKO",$ulang);
				}
				else{
					$this->db->where("ID_TOKO",0);
				}
				
			//echo $this->db->last_query();
		}
		$this->db->limit($A,$halaman);
		
		$this->db->where(array("STS_PUBLISH" => '1'));
		return $this->db->get("mp_produk")->result();

	}
	function hitungcaribarangdikategoripvt($produk,$minn,$max,$urut,$kategori,$provinsi,$kota,$status,$halaman,$A){

		
		

		if($minn != 0){
			$this->db->where("HARGA_AS >= $minn");

		}

		if($max != 0){

			$this->db->where("HARGA_AS <= $max");

		}

		if($produk != ""){

					$this->db->where("NM_PRODUK LIKE '%$produk%'");

		}

		if($urut == "baru"){

			$this->db->order_by('ID_PRODUK', 'DESC');

		}
		if($urut == "laris"){

			$this->db->order_by('IN_CART', 'DESC');

		}

		if($urut == "murah"){

			$this->db->order_by('HARGA_AS', 'ASC');

		}

		if($urut == "mahal"){

			$this->db->order_by('HARGA_AS', 'DESC');

		}

			$this->db->where("ID_SUB_KATEGORI",$kategori);
		
	

		//$this->db->limit($A,$halaman);
			if($provinsi != "semua"){
				//$caritoko = $this->caritoko($provinsi,$kota);
					if($kota !="semua"){
					$caritoko = $this->db->query("SELECT * FROM mp_toko WHERE ID_PROVINSI = $provinsi AND ID_KOTA = $kota");
				}else{
					$caritoko = $this->db->query("SELECT * FROM mp_toko WHERE ID_PROVINSI = $provinsi");
				}
				if($caritoko->num_rows() != 0){
					$i = 1;
					foreach ($caritoko->result() as $row) {
						/*if($i == 1){
							$this->db->where("ID_TOKO",$row->ID_TOKO);
						}
						else{
							$this->db->or_where("ID_TOKO",$row->ID_TOKO);
							$this->db->where_in("ID_TOKO",$row->ID_TOKO);
						}*/
						$ulang[] = $row->ID_TOKO;
						
						$i++;
						
					}
					$this->db->where_in("ID_TOKO",$ulang);
				}
				else{
					$this->db->where("ID_TOKO",0);
				}
				
			//echo $this->db->last_query();
		}

	

		$this->db->where(array("STS_PUBLISH" => '1'));
		$query = $this->db->get("mp_produk");
	

		return $query->num_rows();

	}


	function caribarangdikategoripvt($produk,$minn,$max,$urut,$kategori,$provinsi,$kota,$status,$halaman,$A){

		
		
		if($minn != 0){
			$this->db->where("HARGA_AS >= $minn");

		}

		if($max != 0){

			$this->db->where("HARGA_AS <= $max");

		}

		if($produk != ""){

					$this->db->where("NM_PRODUK LIKE '%$produk%'");

		}

		if($urut == "baru"){

			$this->db->order_by('ID_PRODUK', 'DESC');

		}
		if($urut == "laris"){

			$this->db->order_by('IN_CART', 'DESC');

		}

		if($urut == "murah"){

			$this->db->order_by('HARGA_AS', 'ASC');

		}

		if($urut == "mahal"){

			$this->db->order_by('HARGA_AS', 'DESC');

		}

			$this->db->where("ID_SUB_KATEGORI",$kategori);


		
		if($provinsi != "semua"){
				//$caritoko = $this->caritoko($provinsi,$kota);
					if($kota !="semua"){
					$caritoko = $this->db->query("SELECT * FROM mp_toko WHERE ID_PROVINSI = $provinsi AND ID_KOTA = $kota");
				}else{
					$caritoko = $this->db->query("SELECT * FROM mp_toko WHERE ID_PROVINSI = $provinsi");
				}
				if($caritoko->num_rows() != 0){
					$i = 1;
					foreach ($caritoko->result() as $row) {
						/*if($i == 1){
							$this->db->where("ID_TOKO",$row->ID_TOKO);
						}
						else{
							$this->db->or_where("ID_TOKO",$row->ID_TOKO);
							$this->db->where_in("ID_TOKO",$row->ID_TOKO);
						}*/
						$ulang[] = $row->ID_TOKO;
						
						$i++;
						
					}
					$this->db->where_in("ID_TOKO",$ulang);
				}
				else{
					$this->db->where("ID_TOKO",0);
				}
				
			//echo $this->db->last_query();
		}
		$this->db->limit($A,$halaman);
		
		$this->db->where(array("STS_PUBLISH" => '1'));
		return $this->db->get("mp_produk")->result();

	}
	function hitungcaribarangdiukm($idtoko,$produk,$urut,$kategori,$halaman,$A){

		

		if($produk != ""){

					$this->db->where("NM_PRODUK LIKE '%$produk%'");

		}

		if($urut == "baru"){

			$this->db->order_by('ID_PRODUK', 'DESC');

		}

		if($urut == "murah"){

			$this->db->order_by('HARGA_AS', 'ASC');

		}

		if($urut == "mahal"){

			$this->db->order_by('HARGA_AS', 'DESC');

		}
		if($urut == "laris"){

			$this->db->order_by('IN_CART', 'DESC');

		}
		if($kategori != "semua"){
			$this->db->where("ID_SUB_KATEGORI",$kategori);
		}
		
		
		$this->db->where("ID_TOKO",$idtoko);

		$this->db->where(array("STS_PUBLISH" => '1'));

		//$this->db->limit($A,$halaman);

		$query = $this->db->get("mp_produk");

		return $query->num_rows();

	}


	function caribarangdiukm($idtoko,$produk,$urut,$kategori,$halaman,$A){

		
		
		

		if($produk != ""){

					$this->db->where("NM_PRODUK LIKE '%$produk%'");

		}

		if($urut == "baru"){

			$this->db->order_by('ID_PRODUK', 'DESC');

		}
		if($urut == "laris"){

			$this->db->order_by('IN_CART', 'DESC');

		}

		if($urut == "murah"){

			$this->db->order_by('HARGA_AS', 'ASC');

		}

		if($urut == "mahal"){

			$this->db->order_by('HARGA_AS', 'DESC');

		}
		if($kategori != "semua"){
			$this->db->where("ID_SUB_KATEGORI",$kategori);
		}
		
		$this->db->where("ID_TOKO",$idtoko);
		$this->db->limit($A,$halaman);
		
		$this->db->where(array("STS_PUBLISH" => '1'));
		return $this->db->get("mp_produk")->result();

	}
	function caritoko($provinsi,$kota){
		if($kota !="semua"){
					$caritoko = $this->db->query("SELECT * FROM mp_toko WHERE ID_PROVINSI = $provinsi AND ID_KOTA = $kota");
				}else{
					$caritoko = $this->db->query("SELECT * FROM mp_toko WHERE ID_PROVINSI = $provinsi");
				}
				return $caritoko;
	}

	function hitungbarangcarikategori($produk,$minn,$max,$urut,$ukm){

		if($minn != 0){

			$this->db->where('HARGA >=', $minn);

						

		}

		if($max != 0){

			$this->db->where('HARGA <=', $max);

					

		}

		if($produk != "Semua Produk"){

					$this->db->where("NM_PRODUK LIKE '%$produk%'");

		}

		if($urut == "baru"){

			$this->db->order_by('ID_PRODUK', 'DESC');

		}

		if($urut == "murah"){

			$this->db->order_by('HARGA', 'ASC');

		}

		if($urut == "mahal"){

			$this->db->order_by('HARGA', 'DESC');

		}



		$this->db->where(array("STS_PUBLISH" => '1',"ID_KATEGORI" => $ukm));

		$this->db->get("mp_produk");

		return $this->db->count_all_results();

		

	}

	function carikategorire($minn,$max,$ukm,$produk,$urut,$halaman,$A){

		if($minn != 0){

			$this->db->where('HARGA >=', $minn);

		}

		if($max != 0){

			$this->db->where('HARGA <=', $max);

		}

		if($produk != "Semua Produk"){

					$this->db->where("NM_PRODUK LIKE '%$produk%'");

		}

		if($urut == "baru"){

			$this->db->order_by('ID_PRODUK', 'DESC');

		}

		if($urut == "murah"){

			$this->db->order_by('HARGA', 'ASC');

		}

		if($urut == "mahal"){

			$this->db->order_by('HARGA', 'DESC');

		}

		$this->db->where(array("STS_PUBLISH" => '1',"ID_KATEGORI" => $ukm));

		$this->db->limit($halaman,$A);

		$query = $this->db->get("mp_produk");

		return $query->result();

	}

	function hitungbarangcarilihatproduk($produk,$minn,$max,$urut){

		if($minn != 0){

			$this->db->where('HARGA >=', $minn);

						

		}

		if($max != 0){

			$this->db->where('HARGA <=', $max);

					

		}

		if($produk != "Semua Produk"){

					$this->db->where("NM_PRODUK LIKE '%$produk%'");

		}

		if($urut == "baru"){

			$this->db->order_by('ID_PRODUK', 'DESC');

		}

		if($urut == "murah"){

			$this->db->order_by('HARGA', 'ASC');

		}

		if($urut == "mahal"){

			$this->db->order_by('HARGA', 'DESC');

		}

		

		$this->db->where(array("STS_PUBLISH" => '1'));

		$this->db->get("mp_produk");

		return $this->db->count_all_results();

		

	}

	function carilihatproduk($minn,$max,$produk,$urut,$halaman,$A){

		if($minn != 0){

			$this->db->where('HARGA >=', $minn);

		}

		if($max != 0){

			$this->db->where('HARGA <=', $max);

		}

		if($produk != "Semua Produk"){

					$this->db->where("NM_PRODUK LIKE '%$produk%'");

		}

		if($urut == "baru"){

			$this->db->order_by('ID_PRODUK', 'DESC');

		}

		if($urut == "murah"){

			$this->db->order_by('HARGA', 'ASC');

		}

		if($urut == "mahal"){

			$this->db->order_by('HARGA', 'DESC');

		}

		$this->db->where(array("STS_PUBLISH" => '1'));

		$this->db->limit($halaman,$A);

		$query = $this->db->get("mp_produk");

		return $query->result();

	}

	

	function hitungbarangcaritoko($produk){
		$tampil = $this->db->query("SELECT COUNT(*) AS hitung FROM mp_toko WHERE NM_TOKO LIKE '%$produk%'");
		return $tampil->row();
	}

	

	function whatthisip(){

			if ( function_exists( 'apache_request_headers' ) ) {

			$headers = apache_request_headers();

		} else {

			$headers = $_SERVER;

		}

		//Get the forwarded IP if it exists

		if ( array_key_exists( 'X-Forwarded-For', $headers ) && filter_var( $headers['X-Forwarded-For'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 ) ) {

			$the_ip = $headers['X-Forwarded-For'];

		} elseif ( array_key_exists( 'HTTP_X_FORWARDED_FOR', $headers ) && filter_var( $headers['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 )

		) {

			$the_ip = $headers['HTTP_X_FORWARDED_FOR'];

		} else {

			

			$the_ip = filter_var( $_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 );

		}

		return $the_ip;

	}



	function tampilprolainukm($idproduk, $idtoko){ 

		$query = $this->db->query("SELECT * FROM mp_produk WHERE STS_PUBLISH = '1' AND ID_PRODUK <> $idproduk AND ID_TOKO = $idtoko ORDER BY RAND() LIMIT 8");

		return $query->result();

	}

	function gambarcariproduk($id){

		$gambar = $this->producthomemodel->tampilData("mp_galeri_pro", "FT_PRODUK", array("id_produk"=>$id),$result = TRUE,1);

		return $gambar->FT_PRODUK;

	}

	function hargacariprodukukm($harga,$status){

		$h_grosir = explode("|",$harga);

		$hh_grosir = explode("-",$h_grosir[0]);

		if($status == 0):

			return formatRp($harga);

		else:

			return formatRp($hh_grosir[2]);

		endif;

	}

	function penjualcariprodukukm($idtoko){

		foreach($this->producthomemodel->tampilData("mp_toko","NM_TOKO",array("ID_TOKO" => $idtoko)) as $row_namaukm):

			$nama_toko = str_replace(" ","-",$row_namaukm->NM_TOKO);

			echo anchor("Home_controller/ukm/$nama_toko",$row_namaukm->NM_TOKO);

		endforeach;

	}

	function kategoricariprodukukm($kategori,$subkategori){

		foreach($this->producthomemodel->tampilData("mp_kategori","*",array("ID_KATEGORI" => $kategori)) as $row_kategori):  endforeach;

		foreach($this->producthomemodel->tampildata("mp_sub_kategori","*",array("ID_SUB_KATEGORI" => $subkategori)) as $row_subkategori):

			$link = setPermalink($row_subkategori->ID_SUB_KATEGORI,$row_subkategori->SUB_KATEGORI);

			echo anchor("home_controller/kategori/$link",$row_subkategori->SUB_KATEGORI);

		endforeach;

	}

}