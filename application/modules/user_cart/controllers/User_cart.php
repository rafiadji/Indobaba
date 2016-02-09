<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class User_cart extends MY_User {

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_user_cart', 'admincart');
		$this->sesi();
		$this->sesikodeunik();
    }

    function modal()
    {
    	$id = $this->input->post("id_produk");
    	$data['tampil']=$query=$this->db->query("SELECT * FROM mp_produk WHERE ID_PRODUK='$id'")->row();
    	echo json_encode($data['tampil']);
    }
    function isidropdown()
    {
    	$akun = $this->session->userdata("id_akun_user");
    	$tampil=$query=$this->db->query("SELECT * FROM mp_temp_alamat WHERE ID_AKUN='$akun'")->result();
    	echo "<option>---Pilih Alamat---</option>";
    	foreach ($tampil as $kelue) {
	    	if($kelue->STS==1)
	    	{
	    		$a="selected=''";
	    	}
	    	else
	    	{
	    		$a="";
	    	}
	    	echo "<option ".$a." value='".$kelue->ID_ALAMAT."'>".$kelue->SIMPAN_SEBAGAI." - ".$kelue->ALAMAT."</option>";
	    }
    }
    function hitungqty()
    {
    	$id = $this->input->post("id_produk");
    	$qty = $this->input->post("qty");
    	$data['tampil']=$query=$this->db->query("SELECT * FROM mp_produk WHERE ID_PRODUK='$id'")->row();
	    $jumlah = $this->input->post("qty");
	    if($data['tampil']->STS_GROSIR==1)
	    {
			$grosir = $data['tampil']->HARGA;
			$data =  explode('|',$grosir);
			foreach($data as $key){
				if ($key!='') {
				$data2 = explode('-',$key);
				if($jumlah >= $data2[0] and $jumlah <= $data2[1]){
					$perhitungan = ($jumlah * $data2[2]);
					echo formatRp($perhitungan);
				}
				}
			}
		}
		else
		{
			echo formatRp($data['tampil']->HARGA*$qty);
		}
    	
    } 
    function alamat_stts()
    {
    	$id_alamat = $this->input->post("id_alamat");
    	$akun = $this->session->userdata("id_akun_user");
    	$data['tampil']=$query=$this->db->query("UPDATE mp_temp_alamat SET STS=0 WHERE ID_AKUN='$akun'");
    	$data['tampil']=$query=$this->db->query("UPDATE mp_temp_alamat SET STS=1 WHERE ID_ALAMAT='$id_alamat'");
    } 
    function do_hitung_uang()
    {
    	$id = $this->input->post("id_produk");
    	$qty = $this->input->post("qty");
    	$kurir = $this->input->post("kurir");
    	$id_alamat = $this->input->post("id_alamat");
    	if($kurir=='0')
    	{
    		echo "<span style='color:red'>Masukan Kurir Yang Telah Disediakan!</span>";
    	}
    	else
    	{
    		$da=$query=$this->db->query("SELECT * FROM mp_produk WHERE ID_PRODUK='$id'")->row();
	    	$toko=$query=$this->db->query("SELECT * FROM mp_toko WHERE ID_TOKO='$da->ID_TOKO'")->row();
	    	$alamat_tujuan=$query=$this->db->query("SELECT * FROM mp_temp_alamat WHERE ID_ALAMAT='$id_alamat'")->row();
	    	$this->load->library('rajaongkir');
	    	$berat = $da->BERAT_PRODUK*$qty;
	    	$cost = $this->rajaongkir->cost($toko->ID_KOTA,$alamat_tujuan->KOTA_KAB,$berat,$kurir);
	    	//$cost = $this->rajaongkir->cost(501,114, $da->BERAT_PRODUK, "'".$kurir"'");
	    	$cost=json_decode($cost);
	    	$no=0;
	    	foreach ($cost->rajaongkir->results as $a) {
	    		echo "<select name='ong' id='ong' onchange='do_hitung_uange()' class='select form-control'>";
	    		echo "<option value=0>----Pilih Jenis Kurir----</option>";
	    		foreach ($a->costs as $cc) {
				echo "<option value='".$cc->service."'>".$cc->service." - ".$cc->description."</option>";
	    		}
	    		echo "</select>";
    	}
    	}
    	
    }
    	function do_hitung_uange()
	    {
	    	$id = $this->input->post("id_produk");
	    	$qty = $this->input->post("qty");
	    	$kurir = $this->input->post("kurir");
	    	$ong = $this->input->post("ong");
	    	$id_alamat = $this->input->post("id_alamat");
	    	if($ong=='0')
			{
				echo "0#(0) Hari";	
			}
			else
			{
	    	$da=$query=$this->db->query("SELECT * FROM mp_produk WHERE ID_PRODUK='$id'")->row();
	    	$toko=$query=$this->db->query("SELECT * FROM mp_toko WHERE ID_TOKO='$da->ID_TOKO'")->row();
	    	$alamat_tujuan=$query=$this->db->query("SELECT * FROM mp_temp_alamat WHERE ID_ALAMAT='$id_alamat'")->row();
	    	$this->load->library('rajaongkir');
	    	$berat = $da->BERAT_PRODUK*$qty;
	    	$cost = $this->rajaongkir->cost($toko->ID_KOTA,$alamat_tujuan->KOTA_KAB,$berat,$kurir);
	    	//$cost = $this->rajaongkir->cost(501,114, $da->BERAT_PRODUK, "'".$kurir"'");
	    	$cost=json_decode($cost);
	    	$no=0;
	    	//print_r($cost);exit();
	    	foreach ($cost->rajaongkir->results as $a) {
	    		foreach ($a->costs as $cc) {
	    			//print_r($cc);exit();
	    			if($cc->service==$ong)
	    			{
	    				foreach ($cc->cost as $o) {
	    					echo $o->value."#( ".$o->etd." ) Hari";	
	    				}
	    				
	    			}

					
	    		}
	    	}
	    	}
	    }
	    function do_hitung_all()
	    {
	    	$id = $this->input->post("id_produk");
	    	$qty = $this->input->post("qty");
	    	$hargapengiriman = $this->input->post("hargapengiriman");
	    	$da=$query=$this->db->query("SELECT * FROM mp_produk WHERE ID_PRODUK='$id'")->row();
	    	if($da->STS_GROSIR==1)
		    {
				$grosir = $da->HARGA;
				$data =  explode('|',$grosir);
				foreach($data as $key){
				if ($key!='') {
				$data2 = explode('-',$key);
				if($qty >= $data2[0] and $qty <= $data2[1]){
					$perhitungan = ($qty * $data2[2])+$hargapengiriman;
					echo formatRp($perhitungan);
				}
				}
			}
			}
			else
			{
		    	$h = ($qty*$da->HARGA)+$hargapengiriman;
		    	echo formatRp($h);
			}

	    	
	    	
	    }

    function udate($format, $utimestamp = null) {
			if (is_null($utimestamp))
		    $utimestamp = microtime(true);
			$timestamp = floor($utimestamp);
			$milliseconds = round(($utimestamp - $timestamp) * 1000000);
			return date(preg_replace('`(?<!\\\\)u`', $milliseconds, $format), $timestamp);
	}

	function sesi()
	{
		$d =  $this->udate('dmy-His-u');
		$data = array(
		"waktu" => $d);
		if(!$this->session->userdata("waktu"))
		{
			$this->session->set_userdata($data);
		}
	}
	function sesikodeunik()
	{
		$d =  rand(100,999);
		$data = array(
		"kode_unik" => $d);
		if(!$this->session->userdata("kode_unik"))
		{
			$this->session->set_userdata($data);
		}
	}
	public function hitung()

	{
		$akun = $this->session->userdata("id_akun_user");
		//echo "SELECT COUNT(ID_CART) AS TOTAL FROM mp_temp_cart WHERE ID_TRANS='$sss' ";exit();
		$query=$this->db->query("SELECT COUNT(ID_CART) AS TOTAL FROM mp_temp_cart WHERE ID_AKUN='$akun' ")->row();
		echo $query->TOTAL." Keranjang";
	}
	public function to_cart()
	{
		
		$id_produktext = $this->input->post("id_produktext");	
		$qty = $this->input->post("qty");
		$id_alamat = $this->input->post("id_alamat");
		$kurir = $this->input->post("kurir");
		$ong = $this->input->post("ong");
		$hargapengiriman = $this->input->post("hargapengiriman");
		$sesi = $this->session->userdata("waktu");
		$akun = $this->session->userdata("id_akun_user");
		//exit();
		if($this->session->userdata("id_akun_user"))
		{
			$detail_produk = $this->db->query("SELECT * FROM view_detail_produk WHERE ID_PRODUK='$id_produktext'")->row();
			//echo "SELECT * FROM view_detail_produk WHERE ID_PRODUK='$id_produktext'";exit();
			$keun = $this->db->query("SELECT * FROM mp_keuntungan WHERE ID_KEUNTUNGAN=0")->row();
			
			$id_toko = $this->db->query("SELECT * FROM mp_produk WHERE ID_PRODUK='$id_produktext'")->row()->ID_TOKO;
			$cek_ongkir = $this->db->query("SELECT * FROM view_temp_cart WHERE ID_TRANS='$sesi' AND ID_TOKO='$id_toko' AND NAMA_KURIR='$kurir' AND PAKET_YANG_DIAMBIL='$ong'  AND ID_ALAMAT='$id_alamat'")->row();
			if($qty>0){
				$query=$this->db->query("SELECT * FROM view_temp_cart WHERE ID_AKUN='$akun' AND ID_PRODUK='$id_produktext' AND NAMA_KURIR='$kurir' AND PAKET_YANG_DIAMBIL='$ong' AND ID_ALAMAT='$id_alamat'");
				$prdk=$this->db->query("SELECT * FROM mp_produk WHERE ID_PRODUK='$id_produktext'")->row();
				
				if($query->num_rows()<=0)
				{
					if($cek_ongkir)
					{
						//echo "SELECT * FROM view_temp_cart WHERE ID_TRANS='$sesi' AND ID_TOKO='$id_toko' AND NAMA_KURIR='$kurir' AND PAKET_YANG_DIAMBIL='$ong' AND ID_ALAMAT='$id_alamat' AND ID_ONGKIR='$cek_ongkir->ID_ONGKIR'  -- ".$cek_ongkir->ID_ONGKIR;exit();
						$id_ongkir=$this->db->query("SELECT * FROM view_temp_cart WHERE ID_TRANS='$sesi' AND ID_TOKO='$id_toko' AND NAMA_KURIR='$kurir' AND PAKET_YANG_DIAMBIL='$ong' AND ID_ALAMAT='$id_alamat' AND ID_ONGKIR='$cek_ongkir->ID_ONGKIR'")->row();
						if($prdk->STS_GROSIR==1)
							{
								$jumlah = $qty;
								$grosir = $prdk->HARGA;
								$data =  explode('|',$grosir);
								foreach($data as $key){
									if ($key!='') {
									$data2 = explode('-',$key);
									if($jumlah >= $data2[0] and $jumlah <= $data2[1]){
										$perhitungan = $data2[2];
										$rgh=$perhitungan;
									}
									}
								}
							}
							else
							{
								$rgh=$prdk->HARGA;
							}
							$data = array(
							'ID_TRANS' => $sesi,
							'ID_PRODUK' => $id_produktext, 
							'ID_AKUN' => $akun, 
							'ID_ALAMAT' => $id_alamat, 
							'ID_ONGKIR' => $cek_ongkir->ID_ONGKIR, 
							'HARGA@' => $rgh, 
							'QTY' => $qty,
							'NAMA_PRODUK' =>$detail_produk->NM_PRODUK,
							'BERAT_PRODUK' =>$detail_produk->BERAT_PRODUK,
							'NAMA_TOKO' =>$detail_produk->NM_TOKO,
							'ID_PJ' =>$detail_produk->ID_PENANGGUNG_JWB,
							'NAMA_PJ' =>$detail_produk->NAMA_PENANGGUNG_JWB,
							'KEUNTUNGAN_PJ' =>$keun->KEUNTUNGAN_PJ,
							'KEUNTUNGAN_INDOBABA' =>$keun->KEUNTUNGAN_UKM
							);
							$this->admincart->tambahData($data,'mp_temp_cart');

							echo $this->db->last_query();
								$total_berat = $this->db->query("SELECT * FROM view_temp_cart WHERE ID_TRANS='$sesi' AND ID_TOKO='$id_toko' AND NAMA_KURIR='$kurir' AND PAKET_YANG_DIAMBIL='$ong' AND ID_ALAMAT='$id_alamat'")->result();
								$tot_ber = 0;
								foreach ($total_berat as $ber) {
									$tot_ber+=$ber->QTY*$ber->BERAT_PRODUK;
								}

							$toko=$query=$this->db->query("SELECT * FROM mp_toko WHERE ID_TOKO='$id_toko'")->row();
		    				$alamat_tujuan=$query=$this->db->query("SELECT * FROM mp_temp_alamat WHERE ID_ALAMAT='$id_alamat'")->row();

							$this->load->library('rajaongkir');
					    	$berat = $tot_ber;
					    	$cost = $this->rajaongkir->cost($toko->ID_KOTA,$alamat_tujuan->KOTA_KAB,$berat,$kurir);
					    	//$cost = $this->rajaongkir->cost(501,114, $da->BERAT_PRODUK, "'".$kurir"'");
					    	$cost=json_decode($cost);
					    	//print_r($cost);exit();
					    	
					    	$no=0;
						    	foreach ($cost->rajaongkir->results as $a) {
						    		foreach ($a->costs as $cc) {
						    			//print_r($cc);exit();
						    			if($cc->service==$ong)
						    			{
						    				foreach ($cc->cost as $o) {
						    					//print_r($o);exit();
						    					$harg_ongkir = $o->value;
						    					//echo $harg_ongkir." ";//exit();
						    					//echo "UPDATE mp_temp_ongkir SET TOTAL='$harg_ongkir' WHERE ID_ONGKIR='".$id_ongkir->ID_ONGKIR."'";
						    					$this->db->query("UPDATE mp_temp_ongkir SET TOTAL='$harg_ongkir' WHERE ID_ONGKIR='".$id_ongkir->ID_ONGKIR."'");
						    				}
						    				
						    			}

										
						    		}
				    			}
				    		//echo 1;
				    		//echo 
				    		//$insert_id = $this->db->insert_id();
							
					}
					else
					{
						$this->db->query("INSERT INTO mp_temp_ongkir (NAMA_KURIR,PAKET_YANG_DIAMBIL,TOTAL) values ('$kurir','$ong','$hargapengiriman')");
						$insert_id = $this->db->insert_id();
							if($prdk->STS_GROSIR==1)
							{
								$jumlah = $qty;
								$grosir = $prdk->HARGA;
								$data =  explode('|',$grosir);
								foreach($data as $key){
									if ($key!='') {
									$data2 = explode('-',$key);
									if($jumlah >= $data2[0] and $jumlah <= $data2[1]){
										$perhitungan = $data2[2];
										$rgh=$perhitungan;
									}
									}
								}
							}
							else
							{
								$rgh=$prdk->HARGA;
							}
							$data = array(
							'ID_TRANS' => $sesi,
							'ID_PRODUK' => $id_produktext, 
							'ID_AKUN' => $akun, 
							'ID_ALAMAT' => $id_alamat, 
							'ID_ONGKIR' => $insert_id, 
							'HARGA@' => $rgh, 
							'QTY' => $qty,
							'NAMA_PRODUK' =>$detail_produk->NM_PRODUK,
							'BERAT_PRODUK' =>$detail_produk->BERAT_PRODUK,
							'NAMA_TOKO' =>$detail_produk->NM_TOKO,
							'ID_PJ' =>$detail_produk->ID_PENANGGUNG_JWB,
							'NAMA_PJ' =>$detail_produk->NAMA_PENANGGUNG_JWB,
							'KEUNTUNGAN_PJ' =>$keun->KEUNTUNGAN_PJ,
							'KEUNTUNGAN_INDOBABA' =>$keun->KEUNTUNGAN_UKM
							);
							$this->admincart->tambahData($data,'mp_temp_cart');
					}
						echo 1;
				}
				else
				{
						$getid = $this->db->query("SELECT * FROM view_temp_cart WHERE ID_AKUN='$akun' AND ID_PRODUK='$id_produktext' AND NAMA_KURIR='$kurir' AND PAKET_YANG_DIAMBIL='$ong' AND ID_ALAMAT='$id_alamat'")->row();
						$this->db->query("UPDATE mp_temp_cart SET QTY=QTY+'$qty' WHERE ID_AKUN='$akun' AND ID_ALAMAT='$id_alamat' AND ID_PRODUK='$id_produktext' AND ID_ONGKIR='$getid->ID_ONGKIR' ");
						if($prdk->STS_GROSIR==1)
						{
							$jumlah = $qty;
							$grosir = $prdk->HARGA;
							$data =  explode('|',$grosir);
							foreach($data as $key){
								if ($key!='') {
								$data2 = explode('-',$key);
								if($jumlah >= $data2[0] and $jumlah <= $data2[1]){
									$perhitungan = $data2[2];
									$rgh=$perhitungan;
								}
								}
							}
						}
						else
						{
							$rgh=$prdk->HARGA;
						}

							$total_berat = $this->db->query("SELECT * FROM view_temp_cart WHERE ID_TRANS='$sesi' AND ID_TOKO='$id_toko' AND NAMA_KURIR='$kurir' AND PAKET_YANG_DIAMBIL='$ong' AND ID_ALAMAT='$id_alamat'")->result();
								$tot_ber = 0;
								foreach ($total_berat as $ber) {
									$tot_ber+=$ber->QTY*$ber->BERAT_PRODUK;
								}

							$toko=$query=$this->db->query("SELECT * FROM mp_toko WHERE ID_TOKO='$id_toko'")->row();
		    				$alamat_tujuan=$query=$this->db->query("SELECT * FROM mp_temp_alamat WHERE ID_ALAMAT='$id_alamat'")->row();
							$this->load->library('rajaongkir');
					    	$berat = $tot_ber;
					    	$cost = $this->rajaongkir->cost($toko->ID_KOTA,$alamat_tujuan->KOTA_KAB,$berat,$kurir);
					    	$cost=json_decode($cost);
					    	$no=0;
					    	foreach ($cost->rajaongkir->results as $a) {
					    		foreach ($a->costs as $cc) {
					    			//print_r($cc);exit();
					    			if($cc->service==$ong)
					    			{
					    				foreach ($cc->cost as $o) {
					    					//print_r($o);exit();
					    					$harg_ongkir = $o->value;
					    					$this->db->query("UPDATE mp_temp_ongkir SET NAMA_KURIR='$kurir',PAKET_YANG_DIAMBIL='$ong',TOTAL='$harg_ongkir' WHERE ID_ONGKIR='$getid->ID_ONGKIR' ");
					    					echo "UPDATE mp_temp_ongkir SET NAMA_KURIR='$kurir',PAKET_YANG_DIAMBIL='$ong',TOTAL='$harg_ongkir' WHERE ID_ONGKIR='$getid->ID_ONGKIR'";
					    				}
					    				
					    			}

									
					    		}
			    			}
					echo 2;
				}
			}
			else
			{
				echo 0;
			}

		}
		else
		{
			redirect("login");
		}
	}
	public function updatecart()
	{
		
		$id_produk = $this->input->post("id_produk");	
		$qty = $this->input->post("qty");
		$sesi = $this->session->userdata("waktu");
		$akun = $this->session->userdata("id_akun_user");
		if($this->session->userdata("id_akun_user"))
		{
			if($qty>0){
				//echo "UPDATE mp_temp_cart SET QTY='$qty' WHERE ID_TRANS='$sesi' AND ID_PRODUK='$id_produk'";exit();
				$this->db->query("UPDATE mp_temp_cart SET QTY='$qty' WHERE ID_AKUN='$akun' AND ID_PRODUK='$id_produk'");
				echo 1;
			}
			else
			{
				echo 2;
			}

		}
		else
		{
			redirect("login");
		}
	}
	public function hapuscart()
	{
		$id_produk = $this->input->post("id_produk");
		$akun = $this->session->userdata("id_akun_user");
		$this->db->query("DELETE FROM mp_temp_cart  WHERE ID_AKUN='$akun' AND ID_PRODUK='$id_produk'");		
	}
	public function do_alamat()
	{
		$alamat = $this->input->post("alamat");
		$simpansebagai = $this->input->post("simpansebagai");
		$nama_penerima = $this->input->post("nama_penerima");
		$no_hp_penerima = $this->input->post("no_hp_penerima");
		$kode_pos = $this->input->post("kode_pos");
		$id_provinsi = $this->input->post("id_provinsi");
		$id_kota = $this->input->post("id_kota");
		$akun = $this->session->userdata("id_akun_user");
		$data = array(
		'ALAMAT' => $alamat,
		'SIMPAN_SEBAGAI' => $simpansebagai,
		'NAMA_PENERIMA' => $nama_penerima,
		'NO_HP_PENERIMA' => $no_hp_penerima,
		'KODE_POS' => $kode_pos,
		'PROVINSI' => $id_provinsi,
		'KOTA_KAB' => $id_kota,
		'STS' => 0, 
		'ID_AKUN' => $akun
		);
		$this->admincart->tambahData($data,'mp_temp_alamat');
		$this->admincart->tambahData($data,'mp_alamat');
	}
	public function editalamat()
	{
		$id_alamat = $this->input->post("id_alamat");
		$akun = $this->session->userdata("id_akun_user");
		$this->db->query("UPDATE mp_temp_cart SET ID_ALAMAT='$id_alamat' WHERE ID_AKUN='$akun'");
		$this->db->query("UPDATE mp_temp_alamat SET STS=1 WHERE ID_ALAMAT='$id_alamat'");
	}
	function getkota(){
		$this->load->library('rajaongkir');
		$id_provinsi = $this->input->post('id_provinsi');
		$data_kota = $this->rajaongkir->city($id_provinsi);
		$data['kota'] = json_decode($data_kota);
		$this->load->view('lihat_kota',$data);
	}
	function formatRupiah(){
		$formatRupiah = $this->input->post('nominal');
		$form = explode("#", $formatRupiah);
		if($formatRupiah)
			echo formatRp($form[0])." ".$form[1];
	}
	function formatHarga(){
		$formatRupiah = $this->input->post('nominal');
		echo formatRp($formatRupiah);
	}
}