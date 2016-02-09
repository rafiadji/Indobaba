<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Ukm_info extends MY_Ukm {

	var $template = "ukm_page";

	function __construct(){

		parent::__construct();

		$this->load->model("m_ukm_info","infomodel");

		$this->load->library('rajaongkir');

    }
    public function hitung_transaksi_baru(){
    	$data = $this->infomodel->hitungtransaksibaru();
    	if($data){
    		echo $data;
    	}
    	else{
    		echo "0";
    	}
    }
    public function updatestok(){
    	$idcart=$this->input->post("id_cart");
    	$stok = $this->input->post("stok");
    	$data = array(
    		"QTY_TERSEDIA" => $stok,
    		);
    	$where = array(
    		"ID_CART" => $idcart,
    		);
    	$this->infomodel->editData($data ,"mp_cart",$where);

    }
     public function hitung_transaksi_resi(){
    	$data = $this->infomodel->hitungtransaksiresi();
    	if($data){
    		echo $data;
    	}
    	else{
    		echo "0";
    	}
    }

	

	public function index(){

		$id_akun =  $this->infomodel->idakun();

		$data['tampil'] = $tampil = $this->infomodel->tampilData("mp_toko","*",array("ID_TOKO" => $id_akun),TRUE);

		$data['page'] = "info";

		$data['judul_page'] ="Profil Toko Anda";

		$data['des_page'] ="";

		$data_provinsi = $this->rajaongkir->province();

    	$data['provinsi'] = json_decode($data_provinsi);

		$data['pj'] = $this->infomodel->tampilData("mp_penanggung_jwb","*",array("ID_PENANGGUNG_JWB" => $tampil->ID_PENANGGUNG_JWB),TRUE);

		if($this->input->post("simpan") == TRUE){

			$this->form_validation->set_rules("nama","Nama","required|max_length[50]");

			$this->form_validation->set_rules("des","Deskripsi","required");

			$this->form_validation->set_rules("id_provinsi","Provinsi","required");

			$this->form_validation->set_rules("id_kota","Kota","required");

			$this->form_validation->set_rules("kecamatan","Kecamatan","required");

			$this->form_validation->set_rules("kelurahan","Kelurahan","required");

			$this->form_validation->set_rules("alamat","Alamat","required");

			$this->form_validation->set_rules("nohp","No.HP","required|max_length[12]|numeric");

			$this->form_validation->set_rules("notelp","No Telp","required|max_length[12]");

			$this->form_validation->set_rules("email","Email","required|max_length[50]|valid_email");

			$this->form_validation->set_rules("bbm","BBM","required|max_length[50]");

			$this->form_validation->set_rules("key","Keyword Meta","required|max_length[50]");

			$this->form_validation->set_rules("wa","Whatsapp","required|max_length[50]");

			$this->form_validation->set_rules("keydes","Description Meta","required|max_length[50]");

			if($this->form_validation->run() == TRUE){

				$data = array(

					"ID_PROVINSI" => $this->input->post("id_provinsi"),

					"ID_KOTA" => $this->input->post("id_kota"),

					"NM_TOKO" => $this->input->post("nama"),

					"DES_TOKO" => $this->input->post("des"),

					"KELURAHAN" => $this->input->post("kelurahan"),

					"KECAMATAN" => $this->input->post("kecamatan"),

					"NO_HP" => $this->input->post("nohp"),

					"NO_TELP" => $this->input->post("notelp"),

					"EMAIL" => $this->input->post("email"),

					"ALAMAT" => $this->input->post("alamat"),

					"S_BBM" => $this->input->post("bbm"),

					"S_WHATSAPP" => $this->input->post("wa"),

					"KEY_META" => $this->input->post("key"),

					"DES_META" => $this->input->post("keydes"),

				);

				$where = array(

					"ID_TOKO" => $id_akun

				);

				$this->infomodel->editData($data ,"mp_toko" ,$where);

				$this->session->set_flashdata('notif', "Data berhasil di Ubah");

				$this->session->set_flashdata('clr', 'success');

				redirect('ukm_info');

			}

			else{

				$this->session->set_flashdata('notif', validation_errors());

				$this->session->set_flashdata('clr', 'danger');

				redirect('ukm_info');

			}

			

		}

		

		$this->load->view($this->template,$data);

	}

	public function pesan(){

		$id_akun =  $this->infomodel->idakun();

		$data['judul_page'] ="Tanya Admin";

		$data['des_page'] ="";

		$data['page'] = "info-pesan";

		$this->load->view($this->template,$data);

	}

	public function tampil_pesan(){

		$id_akun =  $this->infomodel->idakun();

		$data['tampilkomentar'] = $this->infomodel->tampil_pesan($id_akun);

		$this->load->view("info-pesan-data",$data);	

	}
	public function autoupdatevoicemessage(){
		$id_akun =  $this->infomodel->idakun();
		$db = $this->db->query("select * from mp_pesan_notif WHERE ID_TOKO = $id_akun")->row();
		echo $db->NOTIF_SUARA_UKM;
	}
	public function updatevoice(){
		$id_akun =  $this->infomodel->idakun();
		$this->infomodel->editData(array("NOTIF_SUARA_UKM" => 0),"mp_pesan_notif",array("ID_TOKO" => $id_akun));

	}
	public function autoupdatemessage(){
		
		$id_akun =  $this->infomodel->idakun();
		$db = $this->db->query("select * from mp_pesan_notif WHERE ID_TOKO = $id_akun")->row();
		echo $db->NOTIF_BINTANG_UKM;
	}

	public function tambah_pesan(){

		$id_akun =  $this->infomodel->idakun();

		$data = array(

							  "ISI_PESAN" => $this->input->post("pesan"),

							  "ID_TOKO" => $id_akun,

							  "TGL_PESAN" => date("Y-m-d H:i:s"),

							  "LEVEL" => 2

							  );

				$this->infomodel->tambahData($data ,"mp_pesan");

	}

	public function notif_bintang(){

		$id_akun =  $this->infomodel->idakun();

		$data = $this->db->query("SELECT * FROM mp_pesan_notif WHERE ID_TOKO = $id_akun")->row();
		if( $data->NOTIF_BINTANG_UKM == 1){
			//$this->infomodel->editData(array("NOTIF_SUARA_UKM" => 1),"mp_pesan_notif",array("ID_TOKO" => $id_akun));
		}

		echo $data->NOTIF_BINTANG_UKM;

	}

	public function update_bintang(){

		$id_akun =  $this->infomodel->idakun();

		$data = array(

			"NOTIF_BINTANG_UKM" => 0,

		);

		$where = array(

			"ID_TOKO" => $id_akun,

		);

		$this->infomodel->editData($data,"mp_pesan_notif",$where);

	}

	public function update_bintangg_admin(){

		$id_akun =$this->infomodel->idakun();

		$data = array(

			"NOTIF_BINTANG_ADMIN" => '1',

		);

		$where = array(

			"ID_TOKO" => $id_akun,

		);

		$this->infomodel->editData($data,"mp_pesan_notif",$where);

		echo $this->db->last_query();

	}

	public function orderan($status = 2){

		if($status == ""){ $status = "baru";}
		$data["status"] = $status;
		$data['judul_page'] ="Orderan";

		$data['des_page'] ="";

		$id_akun =  $this->infomodel->idakun();

		$data['page'] = "info-orderan";

		$this->load->view($this->template,$data);

	}

	public function tabel()

	{

		$id = $this->input->post("st");

		$id_akun =  $this->infomodel->idakun();

		$data['id'] = $id;
		if($id == 5){

			//$data['tampil'] = $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TOKO = $id_akun AND ID_STATUS='2' AND STS_TAMPIL = 0 AND QTY_TERSEDIA = 0 GROUP BY ID_TRANS  ORDER BY NO_TRANS DESC")->result();
			$data['tampil'] = $this->db->query("SELECT * FROM view_trans_batal WHERE ID_TOKO = $id_akun AND ID_STATUS='2' AND STS_TAMPIL = 1  GROUP BY ID_TRANS  ORDER BY NO_TRANS DESC")->result();

		}
		else{
			$data['tampil'] = $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TOKO = $id_akun AND ID_STATUS='$id' AND STS_TAMPIL!=0 GROUP BY ID_TRANS  ORDER BY NO_TRANS DESC")->result();
			
		}
		

		$this->load->view("tabel1", $data);

	}

	function detailTransaksi($idd = NULL,$id = NULL){

		if($id == NULL){ redirect("404");}

		$data['judul_page'] ="Detail Transaksi";

		$data['des_page'] ="";

		$id = base64_decode_fix($id);

		$id_akun =  $this->infomodel->idakun();

		//echo $id;exit();

		$data['id'] = $id;

		$data['judul_page'] = 'Detail Transaksi';

		$data['des_page'] = 'Detail Transaksi';

		

		$cek = $this->db->query("SELECT * FROM mp_transaksi WHERE ID_TRANS='$id'")->row();

		if($cek->ID_STATUS==2 AND $idd==2)

		{

			$data['pembeli'] = $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TRANS='$id' LIMIT 1")->row();

			$data['toko'] = $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TRANS='$id' AND ID_TOKO = $id_akun AND STS_TAMPIL=1 GROUP BY ID_TOKO")->result();
			$data['page'] = "detail_transaksi_2";

			$this->load->view($this->template, $data);

		}

		elseif($cek->ID_STATUS==3 AND $idd==3)

		{

			$data['pembeli'] = $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TRANS='$id' LIMIT 1")->row();

			$data['toko'] = $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TRANS='$id' AND ID_TOKO = $id_akun AND STS_TAMPIL=1 GROUP BY ID_TOKO")->result();

			$data['page'] = "detail_transaksi_3";

			$this->load->view($this->template, $data);

		}

		elseif($cek->ID_STATUS==4 AND $idd==4)

		{

			$data['pembeli'] = $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TRANS='$id' LIMIT 1")->row();

			$data['toko'] = $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TRANS='$id'  AND ID_TOKO = $id_akun AND STS_TAMPIL=1 GROUP BY ID_TOKO")->result();

			$data['page'] = "detail_transaksi_4";

			$this->load->view($this->template, $data);

		}

		elseif($cek->ID_STATUS==2 AND $idd==5)

		{

			//$data['pembeli'] = $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TRANS='$id' LIMIT 1")->row();

			//$data['toko'] = $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TRANS='$id'  AND ID_TOKO = $id_akun AND STS_TAMPIL=1 GROUP BY ID_TOKO")->result();
			$data['pembeli'] = $this->db->query("SELECT * FROM view_trans_batal WHERE ID_TRANS='$id' LIMIT 1")->row();
			$data['toko'] = $this->db->query("SELECT * FROM view_trans_batal WHERE ID_TRANS='$id'  AND ID_TOKO = $id_akun AND STS_TAMPIL=1 GROUP BY ID_TOKO")->result();
			$data['page'] = "detail_transaksi_5";

			$this->load->view($this->template, $data);

		}

		

		

	}
	function do_kirimkan(){
		$no_trans=$this->input->post("no_trans");
	    $id_trans=$this->input->post("id_trans");
	    $tokonya=$this->input->post("tokonya");
	    $ongkirs=$this->input->post("ongkirs");
	    $cart=$this->input->post("cart".$tokonya);
	    $hit = count($cart);
	    for ($i=0; $i < $hit ; $i++) { 
	    	$this->db->query("UPDATE mp_cart SET STS_TANGGAP='1' WHERE ID_TRANS='$id_trans' AND ID_CART='$cart[$i]'");
	    }
	}
	function batalkirimbarang(){
		$no_trans=$this->input->post("no_trans");
	    $id_trans=$this->input->post("id_trans");
	    $tokonya=$this->input->post("tokonya");
	    $ongkirs=$this->input->post("ongkirs");
	    $cart=$this->input->post("cart".$tokonya);
	    $hit = count($cart);
	    for ($i=0; $i < $hit ; $i++) { 
	    	$this->db->query("UPDATE mp_cart SET STS_TANGGAP='0' WHERE ID_TRANS='$id_trans' AND ID_CART='$cart[$i]'");
	    }
	}
	function batalkanini()
    {

	    $no_trans=$this->input->post("no_trans");
	    $ongkir=$this->input->post("ongkir");
	    $ongkirs=$this->input->post("ongkirs");
	    $tokonya=$this->infomodel->idakun();
	    $cart=$this->input->post("cart".$tokonya);
	    $trs = $this->input->post("qtytersedia".$tokonya);

	     $tko=$this->db->query("SELECT * FROM view_detail_transaksi WHERE NO_TRANS='$no_trans' AND ID_TOKO='$tokonya' AND ID_ONGKIR='$ongkirs' ")->result();
	    $saldo=0;
	    $hargasemuaasli=0;
	    $hargasemuapalsu=0;
	    foreach ($tko as $klm) {
	    	$hargasemuaasli+=$klm->HARGA_PER*$klm->QTY;
	    	$hargasemuapalsu+=$klm->HARGA_PER*$klm->QTY_TERSEDIA;
	    }

	    $ogki=$this->db->query("SELECT * FROM view_detail_transaksi WHERE NO_TRANS='$no_trans' AND ID_TOKO='$tokonya' AND ID_ONGKIR='$ongkirs' GROUP BY ID_ONGKIR ")->result();
	    $ongkirsemuaasli=0;
	    $ongkirsemuapalsu=0;
	    foreach ($ogki as $kes) {
	    	$ongkirsemuaasli+=$kes->HARGA_ONGKIR;
	    	$ongkirsemuapalsu+=$kes->TOTAL_ONGKIR_REALISASI;
	    }

	    $jmlasli = $hargasemuaasli-$hargasemuapalsu;
	    $ongasli = $ongkirsemuaasli-$ongkirsemuapalsu;
	    $saldo=$jmlasli+$ongasli;

	    $tok=count($cart);
	    for ($oo=0; $oo < $tok; $oo++) { 
	    	$quer = $this->db->query("SELECT * FROM mp_cart WHERE ID_CART='$cart[$oo]'")->row();
	    	$ini = array('QTY_TERSEDIA' => $quer->QTY);
	    	$this->infomodel->editData($ini,'mp_cart',array("ID_CART" => $cart[$oo],"ID_ONGKIR" => $ongkirs));
	    	$this->db->query("UPDATE mp_cart SET STS_TANGGAP='0' WHERE ID_CART='$cart[$oo]' AND ID_ONGKIR='$ongkirs'"); 
	    }

	     $do_alamat=$this->db->query("SELECT * FROM view_detail_transaksi WHERE NO_TRANS='$no_trans' AND ID_TOKO='$tokonya' AND ID_ONGKIR='$ongkirs' GROUP BY ID_ONGKIR")->result();
		foreach ($do_alamat as $key) {
	    	$this->db->query("UPDATE mp_ongkir SET TOTAL_REALISASI='$key->HARGA_ONGKIR' WHERE ID_ONGKIR='$key->ID_ONGKIR'"); 
	    }

	   

	    $akn=$this->db->query("SELECT * FROM view_detail_transaksi WHERE NO_TRANS='$no_trans' GROUP BY ID_AUTH LIMIT 1")->row();
	    $this->db->query("UPDATE mp_akun SET SALDO=SALDO-$saldo WHERE ID_AKUN='$akn->ID_AUTH'"); 
	    //echo $saldo;exit();
	    $read = $this->db->query("SELECT * FROM mp_riwayat_saldo WHERE NO_TRANS='$no_trans'")->row(); 
	    if($read)
	    {
	    	$this->db->query("UPDATE mp_riwayat_saldo SET SALDO=SALDO-$saldo WHERE NO_TRANS='$no_trans'"); 
	    }
	    else
	    {
	    	$this->db->query("INSERT INTO mp_riwayat_saldo (NO_TRANS,SALDO) VALUES ('$no_trans','$saldo')"); 
	    }
    }

	function hituung(){

		$tg = $this->input->post("tg");

		$kode = $this->input->post("kode");

		echo formatRp($tg+$kode);

	}

/*	 function do_batal()

    {

    	//DARISINI

	    $id_trans=$this->input->post("id_trans");

	    $tokonya= $this->infomodel->idakun();

	    $cart=$this->input->post("cart".$tokonya);

	    //print_r($cart);exit();

	    $hit = count($cart);

	    for ($i=0; $i < $hit ; $i++) { 

	    	$this->db->query("UPDATE mp_cart SET STS_TAMPIL=0, QTY_TERSEDIA = 0 WHERE ID_CART='$cart[$i]' AND ID_TRANS='$id_trans'"); 

	    }

		echo $this->db->last_query();

    }*/
      function do_batal()
    {
    	//DARISINI
	    $no_trans=$this->input->post("no_trans");
	    $id_trans=$this->input->post("id_trans");
	    $tokonya=$this->infomodel->idakun();
	    $ongkirs=$this->input->post("ongkirs");
	    $cart=$this->input->post("cart".$tokonya);
	    //print_r($cart);exit();
	    $hit = count($cart);
	    for ($i=0; $i < $hit ; $i++) { 
	    	$que = $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_CART='$cart[$i]'")->row();
		    	//Insert Cart Batal
		    	$data = array(
					"ID_CART" => $que->ID_CART,
					"ID_TRANS" => $que->ID_TRANS,
					"ID_PRODUK" => $que->ID_PRODUK,
					"QTY" => $que->QTY,
					"ID_ONGKIR" => $que->ID_ONGKIR,
					"ID_ALAMAT" => $que->ID_ALAMAT_PENERIMA,
					"ID_AKUN" => $que->ID_AKUN,
					"HARGA@" => $que->HARGA_PER,
					"STATUS_TERSEDIA" => $que->STATUS_TERSEDIA,
					"QTY_TERSEDIA" => $que->QTY_TERSEDIA,
					"STS_TANGGAP" => $que->STS_TANGGAP,
					"STS_RESI" => $que->STS_RESI,
					"STS_TAMPIL" => $que->STS_TAMPIL,
					"RESI" => $que->RESI
				);
				$this->infomodel->tambahData($data,'mp_cart_batal');

	    		$this->db->query("UPDATE mp_cart SET STS_TANGGAP='1',STS_RESI='1',QTY_TERSEDIA='0',STS_TAMPIL=0 WHERE ID_CART='$cart[$i]'"); 
	    		$this->db->query("UPDATE mp_ongkir SET TOTAL_REALISASI='0' WHERE ID_ONGKIR='$que->ID_ONGKIR'"); 
	    }

	    $tko=$this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TRANS='$id_trans' AND ID_TOKO='$tokonya'")->result();
	    $saldo=0;
	    $hargasemuaasli=0;
	    $hargasemuapalsu=0;
	    foreach ($tko as $klm) {
	    	$hargasemuaasli+=$klm->HARGA_PER*$klm->QTY;
	    	$hargasemuapalsu+=$klm->HARGA_PER*$klm->QTY_TERSEDIA;
	    }

	    $ogki=$this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TRANS='$id_trans' AND ID_TOKO='$tokonya' GROUP BY ID_ONGKIR ")->result();
	    $ongkirsemuaasli=0;
	    $ongkirsemuapalsu=0;
	    foreach ($ogki as $kes) {
	    	$ongkirsemuaasli+=$kes->HARGA_ONGKIR;
	    	$ongkirsemuapalsu+=$kes->TOTAL_ONGKIR_REALISASI;
	    }

	    $jmlasli = $hargasemuaasli-$hargasemuapalsu;
	    $ongasli = $ongkirsemuaasli-$ongkirsemuapalsu;
	    $saldo=$jmlasli+$ongasli;
	    echo "Jumlah Asli = ".$jmlasli.", Ong Asli =  ".$ongasli;
	    $akn=$this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TRANS='$id_trans' GROUP BY ID_AUTH LIMIT 1")->row();
	    $this->db->query("UPDATE mp_akun SET SALDO=SALDO+$saldo WHERE ID_AKUN='$akn->ID_AUTH'"); 

	    $g = $this->db->query("SELECT * FROM mp_cart WHERE ID_TRANS='$id_trans'")->result();
		$f = count($g);
		$juml=0;
		foreach ($g as $k) {
			if($k->STS_RESI==1)
			{
				$juml+=1;
			}
		}
		//echo $juml;
		if($juml==$f)
		{
			$this->db->query("UPDATE mp_transaksi SET ID_STATUS=4 WHERE ID_TRANS='$id_trans'");
		}

		$read = $this->db->query("SELECT * FROM mp_riwayat_saldo WHERE NO_TRANS='$no_trans'")->row(); 
	    if($read)
	    {
	    	$this->db->query("UPDATE mp_riwayat_saldo SET SALDO=SALDO+$saldo WHERE NO_TRANS='$no_trans'"); 
	    }
	    else
	    {
	    	$this->db->query("INSERT INTO mp_riwayat_saldo (NO_TRANS,SALDO) VALUES ('$no_trans','$saldo')"); 
	    }
    }

	 function ubahstatus()

    {

    	$no_trans=$this->input->post("no_trans");

    	$id_trans=$this->input->post("id_trans");

    	$saldo=$this->input->post("saldo");

    	$pembeli=$this->input->post("pembeli");

    	$this->db->query("UPDATE mp_transaksi SET ID_STATUS='3' WHERE NO_TRANS='$no_trans'"); 

    	$this->db->query("UPDATE mp_cart SET STS_TANGGAP='1' WHERE ID_TRANS='$id_trans'"); 

    	$getidpembeli = $this->db->query("SELECT * FROM mp_user WHERE ID_USER='$pembeli'")->row(); 

    	$this->db->query("UPDATE mp_akun SET SALDO=SALDO+$saldo WHERE ID_AKUN='$getidpembeli->ID_AUTH'"); 

    }

	function do_tersedia()

    {

	    $no_trans=$this->input->post("no_trans");

	    //$id_toko=$this->input->post("id_toko");


	    $ongkir=$this->input->post("ongkir");
	    $ongkirs=$this->input->post("ongkirs");

	    $tokonya=$this->infomodel->idakun();

	    $cart=$this->input->post("cart".$tokonya);

	    $trs = $this->input->post("qtytersedia".$tokonya);
	    print_r($trs);
	    //exit();


	    $tok=count($cart);

	    for ($oo=0; $oo < $tok; $oo++) { 

	    	//echo $cart[$oo];

	    	$ini = array('QTY_TERSEDIA' => $trs[$oo]);

	    	//echo "Qty Tersedia : ".$trs[$oo]." - Cart : ".$cart[$oo];

	    	$this->infomodel->editData($ini,'mp_cart',array("ID_CART" => $cart[$oo],"ID_ONGKIR" => $ongkirs));
	    	$this->db->query("UPDATE mp_cart SET STS_TANGGAP='1' WHERE ID_CART='$cart[$oo]' AND ID_ONGKIR='$ongkirs'"); 
	    
	    }

	    $do_alamat=$this->db->query("SELECT * FROM view_detail_transaksi WHERE NO_TRANS='$no_trans' AND ID_TOKO='$tokonya' AND ID_ONGKIR ='$ongkirs' GROUP BY ID_ONGKIR ")->result();

		foreach ($do_alamat as $key) {

	    	$this->load->library('rajaongkir');

	    	$jumlahberat=$this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TRANS='$key->ID_TRANS' AND ID_TOKO='$key->ID_TOKO' AND ID_ONGKIR='$key->ID_ONGKIR' ")->result();

	    	$hit = 0;

	    	foreach ($jumlahberat as $ke) {

	    		$hit+=$ke->BERAT_PRODUK*$ke->QTY_TERSEDIA;

	    	}

	    	$berat = $hit;

	    	$cost = $this->rajaongkir->cost($key->ID_KOTA_TOKO,$key->KOTA_KAB,$berat,$key->NAMA_KURIR);

	    	$cost=json_decode($cost);

	    	$no=0;
	    	if($berat==0)
			{
				$this->db->query("UPDATE mp_ongkir SET TOTAL_REALISASI='0' WHERE ID_ONGKIR='$key->ID_ONGKIR'"); 	
			}

			else{


	    	foreach ($cost->rajaongkir->results as $a) {

	    		foreach ($a->costs as $cc) {

	    			if($cc->service==$key->PAKET_YANG_DIAMBIL)

	    			{

	    				foreach ($cc->cost as $o) {

	    				

	    					$this->db->query("UPDATE mp_ongkir SET TOTAL_REALISASI='$o->value' WHERE ID_ONGKIR='$key->ID_ONGKIR'"); 

	    				}

	    				

	    			}

	    		}

	    	}

	    }
	    } 
	    $tko=$this->db->query("SELECT * FROM view_detail_transaksi WHERE NO_TRANS='$no_trans' AND ID_TOKO='$tokonya' AND ID_ONGKIR='$ongkirs' ")->result();
	    echo $this->db->last_query();
	    $saldo=0;
	    $hargasemuaasli=0;
	    $hargasemuapalsu=0;
	    foreach ($tko as $klm) {
	    	$hargasemuaasli+=$klm->HARGA_PER*$klm->QTY;
	    	$hargasemuapalsu+=$klm->HARGA_PER*$klm->QTY_TERSEDIA;
	    }

	    $ogki=$this->db->query("SELECT * FROM view_detail_transaksi WHERE NO_TRANS='$no_trans' AND ID_TOKO='$tokonya' AND ID_ONGKIR='$ongkirs' GROUP BY ID_ONGKIR")->result();
	    $ongkirsemuaasli=0;
	    $ongkirsemuapalsu=0;
	    foreach ($ogki as $kes) {
	    	$ongkirsemuaasli+=$kes->HARGA_ONGKIR;
	    	$ongkirsemuapalsu+=$kes->TOTAL_ONGKIR_REALISASI;
	    }

	    $jmlasli = $hargasemuaasli-$hargasemuapalsu;
	    $ongasli = $ongkirsemuaasli-$ongkirsemuapalsu;
	    $saldo+=$jmlasli+$ongasli;
	    ECHO $jmlasli.$ongasli.$saldo;
	    $akn=$this->db->query("SELECT * FROM view_detail_transaksi WHERE NO_TRANS='$no_trans' GROUP BY ID_AUTH LIMIT 1")->row();
	    $this->db->query("UPDATE mp_akun SET SALDO=SALDO+$saldo WHERE ID_AKUN='$akn->ID_AUTH'"); 

	    $read = $this->db->query("SELECT * FROM mp_riwayat_saldo WHERE NO_TRANS='$no_trans'")->row(); 
	    if($read)
	    {
	    	$this->db->query("UPDATE mp_riwayat_saldo SET SALDO=SALDO+$saldo WHERE NO_TRANS='$no_trans'"); 
	    }
	    else
	    {
	    	$this->db->query("INSERT INTO mp_riwayat_saldo (NO_TRANS,SALDO) VALUES ('$no_trans','$saldo')"); 
	    }  

    }

	function tghn(){

		$tg = $this->input->post("tg");

		echo formatRp($tg);

	}
	 function isiresi()
    {
    	$no_trans=$this->input->post("no_trans");
    	$id_ongkir=$this->input->post("id_ongkir");
    	$id_trans=$this->input->post("id_trans");
    	$resi=$this->input->post("resi");
    	if($resi ==""){
    		$this->db->query("UPDATE mp_cart SET STS_RESI=0,RESI='$resi' WHERE ID_TRANS='$id_trans' AND ID_ONGKIR='$id_ongkir'");
   
    	} 
    	else{
    		$this->db->query("UPDATE mp_cart SET STS_RESI=1,RESI='$resi' WHERE ID_TRANS='$id_trans' AND ID_ONGKIR='$id_ongkir'");
   			$g = $this->db->query("SELECT * FROM mp_cart WHERE ID_TRANS='$id_trans'")->result();
			$f = count($g);
			$juml=0;
			foreach ($g as $k) {
				if($k->STS_RESI==1)
				{
					$juml+=1;
				}
			}
			if($juml==$f)
			{

				$this->db->query("UPDATE mp_transaksi SET ID_STATUS=4 WHERE ID_TRANS='$id_trans'");
				$produk = $this->db->query("SELECT * FROM view_checkout WHERE ID_TRANS = '$id_trans'")->result();
				foreach ($produk as $row) {
					$laris = $this->infomodel->tampilData('mp_cart', 'SUM(QTY) as LARIS', array('ID_PRODUK' => $row->ID_PRODUK), TRUE);
					$add_laris = array('IN_CART' => $laris->LARIS);
					$this->infomodel->editData($add_laris, 'mp_produk', array('ID_PRODUK' => $row->ID_PRODUK));
				}
			}
			$toko_pj = $this->infomodel->idakun();
			$g_y = $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TRANS='$id_trans' AND ID_TOKO='$toko_pj'")->result();
			$f_y = count($g_y);
			$juml_y=0;
			foreach ($g_y as $k_y) {
				if($k_y->STS_RESI==1)
				{
					$juml_y+=1;
				}
			}
			if($juml_y==$f_y)
			{
				$ceken = $this->db->query("SELECT * FROM  mp_riwayat_untung WHERE ID_TRANS='$id_trans' AND ID_TOKO='$toko_pj'")->row();
				if(!$ceken)
				{
					$tot_pj = $this->input->post("tot_pj");
					$tot_web = $this->input->post("tot_web");
					$pjq = $this->db->query("SELECT * FROM mp_toko WHERE ID_TOKO = $toko_pj")->row();
					$pj = $pjq->ID_PENANGGUNG_JWB;
					$data = array(
						"ID_PJ" => $pj,
						"NOMINAL_PJ" => $tot_pj,
						"NOMINAL_INDOBABA" => $tot_web,
						"ID_TRANS" => $id_trans,
						"ID_TOKO" => $toko_pj,
						"TANGGAL" => date("Y-m-d"),
						);
					$this->infomodel->tambahData($data ,"mp_riwayat_untung");
				}
			}
			
		
    	}
	}
	function ubahdata($idtanggap ,$idtrans){
		$idtranss = base64_decode_fix($idtrans);
		$this->db->query("UPDATE mp_transaksi SET ID_STATUS=2 WHERE ID_TRANS='$idtranss'");
		redirect("ukm_info/detailTransaksi/$idtanggap/$idtrans");
		
	}

	
      function resivalid()
    {
    	$id_trans=$this->input->post("id_trans");
	    $this->db->query("UPDATE mp_transaksi SET ID_STATUS=4 WHERE ID_TRANS='$id_trans'");
    }

	function ft_bukti($id = NULL){

		if($id == NULL){ redirect("404");}

		$id = base64_decode_fix($id);

		$ss = $this->db->query("SELECT * FROM mp_bukti WHERE NO_TRANS='$id'")->row();

		echo "<img src='".site_url('assets/images/bukti/'.$ss->FT_BUKTI)."' ></img>";

	}

	public function gantipassword(){

		$id_akun =  $this->infomodel->idakun();

		$data['judul_page'] ="Ganti Password";

		$data['des_page'] ="";

		$data['page'] = "info-gantipass";

		if($this->input->post("simpan") == TRUE){

			$this->form_validation->set_rules("passlama","Password Lama","required|callback_cekpasswordlama");

			$this->form_validation->set_rules("passbaru","Password Baru","required");

			$this->form_validation->set_rules("passbaruulangi","Password Baru Ulangi","required|matches[passbaru]");

			if($this->form_validation->run() == TRUE){

						$id_akun =  $this->session->userdata("id_akun_ukm");

						$data = array(

							"PASSWORD" => acakPass($this->input->post("passbaru"))

							

						);

						$where = array(

							"ID_USER" => $id_akun 	

						);

						$this->infomodel->editData($data ,"mp_user",$where );

						$this->session->set_flashdata('notif', "Password berhasil di ubah");

						$this->session->set_flashdata('clr', 'success');

						redirect("ukm_info/gantipassword");

				}

				else{

						$this->session->set_flashdata('notif', validation_errors());

						$this->session->set_flashdata('clr', 'danger');

						redirect("ukm_info/gantipassword");

				}

		}

		$this->load->view($this->template,$data);

	}
	public function rekening(){

		

		$id_akun =  $this->infomodel->idakun();

		$data['page'] = "info-rekening";

		$data['judul_page'] ="Rekening";

		$data['des_page'] ="";

		$data['tampil'] = $tampil = $this->infomodel->tampilData("mp_rekening","*",array("ID_PEMILIK" => $id_akun,"LEVEL" => 2));

		$this->load->view($this->template,$data);

		

	}

	public function tambahRekening(){

			$data['judul_page'] ="Tambah Rekening";

			$data['des_page'] ="";

			$id_akun =  $this->infomodel->idakun();

			$data['page'] = "tambah-rekening";

			$data['bank'] = $this->infomodel->cari_bank($id_akun);

		if($this->input->post("simpan")){

			$id_akun =  $this->infomodel->idakun();

			$this->form_validation->set_rules('NO_REKENING', 'No Rekening', 'required');

			$this->form_validation->set_rules('ID_BANK', 'Bank', 'required');

			$this->form_validation->set_rules('ATAS_NAMA', 'Atas Nama', 'required');

			if ($this->form_validation->run() == FALSE) {

				$this->session->set_flashdata('notif', validation_errors());

				$this->session->set_flashdata('clr', 'danger');

				redirect('ukm_info/tambahRekening');

			}

		

			$data = array(

				'ID_BANK' => $this->input->post('ID_BANK'),

				'ID_PEMILIK' => $id_akun,

				'NO_REKENING' => $this->input->post('NO_REKENING'),

				'ATAS_NAMA' => $this->input->post('ATAS_NAMA'),

				'LEVEL' => 2

			);

		

			$insert = $this->infomodel->tambahData($data, 'mp_rekening');

			if($insert) {

				$this->session->set_flashdata('notif', 'Rekening berhasil ditambah');

				$this->session->set_flashdata('clr', 'success');

				redirect('ukm_info/tambahRekening');

			}

			else{

				$this->session->set_flashdata('notif', 'maaf data tidak bisa masuk ulangi lagi');

				$this->session->set_flashdata('clr', 'warning');

				redirect('ukm_info/tambahRekening');

			}

		}

		if($this->input->post("kembali")){

			redirect("ukm_info/rekening");

		}

		$this->db->last_query();

		$this->load->view($this->template,$data);

	}

	public function editRekening($id){

		if($id == ""){ redirect("ukm_info/rekening");}

		$data['judul_page'] ="Edit Rekening";

			$data['des_page'] ="";

		$data['page'] = "edit-rekening";

		$data['tampil'] = $this->infomodel->tampilData("mp_rekening","*",array("ID_REKENING" => $id),TRUE);

		$data['bank'] = $this->infomodel->tampilData("mp_bank","*");

		if($this->input->post("simpan")){

		$this->form_validation->set_rules('NO_REKENING', 'No Rekening', 'required');

		$this->form_validation->set_rules('ID_BANK', 'Bank', 'required');

		$this->form_validation->set_rules('ATAS_NAMA', 'Atas Nama', 'required');

		

		

		if ($this->form_validation->run() == FALSE) {

			$this->session->set_flashdata('notif', validation_errors());

			$this->session->set_flashdata('clr', 'danger');

			redirect('ukm_info/editRekening/'.$id);

		}

		

		$data = array(

			'ID_BANK' => $this->input->post('ID_BANK'),

			'NO_REKENING' => $this->input->post('NO_REKENING'),

			'ATAS_NAMA' => $this->input->post('ATAS_NAMA'),

		);

		

		$where = array('ID_REKENING' => $id);

		$update = $this->infomodel->editData($data, 'mp_rekening', $where);

		if($update) {

			$this->session->set_flashdata('notif', 'Rekening berhasil diubah');

			$this->session->set_flashdata('clr', 'success');

			redirect('ukm_info/editRekening/'.$id);

		}

		else{

			$this->session->set_flashdata('notif', 'maaf data tidak bisa di ubah ulangi lagi');

			$this->session->set_flashdata('clr', 'warning');

			redirect('ukm_info/editRekening/'.$id);

		}

		}

		if($this->input->post("kembali")){

			redirect("ukm_info/rekening");

		}

		$this->load->view($this->template,$data);

	}

	public function hapusRekening($id = NULL)

	{

		$delete = $this->infomodel->hapusData('mp_rekening', array('ID_REKENING' => $id));

		$this->session->set_flashdata('notif', 'Rekening berhasil dihapus');

		$this->session->set_flashdata('clr', 'success');

		redirect('ukm_info/rekening');

	}

	public function gantisampul(){

		$id_akun =  $this->infomodel->idakun();

		$data['tampil'] = $tampil = $this->infomodel->tampilData("mp_toko","*",array("ID_TOKO" => $id_akun),TRUE);



			if($_FILES['userfile']['name'] != ""){

			 unlink('././upload/sampul/'.$tampil->FT_SAMPUL);

			 $config['upload_path']          = '././upload/sampul/';

			 $config['allowed_types'] = 'jpg|jpeg|png';

			 $config['max_size'] = '1024';

			 $config['overwrite'] = TRUE;

			$this->load->library('upload', $config);

			

			if ( ! $this->upload->do_upload('userfile'))

								{

									

									$this->session->set_flashdata('notif', $this->upload->display_errors('<p>', '</p>'));

									$this->session->set_flashdata('clr', 'warning');

									redirect('ukm_info/');

								}

								else

								{

									   $uploaddata = $this->upload->data();

									   $data = array(

										"FT_SAMPUL" => $uploaddata['file_name']

									   );

									   $where = array(

										"ID_TOKO" => $this->infomodel->idakun()

									   );

									   

									   $this->infomodel->editData($data,"mp_toko" ,$where);

									   $this->session->set_flashdata('notif', 'Foto profil berhasil di ubah!');

									   $this->session->set_flashdata('clr', 'success');

									   redirect('ukm_info/');

								}

			}

			else{

				    $this->session->set_flashdata('notif', 'maaf anda belum memilih gambar.');

					$this->session->set_flashdata('clr', 'warning');

					 redirect('ukm_info/');

				}

		



	}

	public function gantiprofile(){

		$id_akun =  $this->infomodel->idakun();

		$data['tampil'] = $tampil = $this->infomodel->tampilData("mp_toko","*",array("ID_TOKO" => $id_akun),TRUE);

			if($_FILES['userfile']['name'] != ""){

			 unlink('././upload/profil/'.$tampil->FT_PROFIL);

			 $config['upload_path']          = '././upload/profil/';

			 $config['allowed_types'] = 'jpg|jpeg|png';

			 $config['max_size'] = '1024';

			 $config['overwrite'] = TRUE;

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('userfile'))

								{

									$this->session->set_flashdata('notif', $this->upload->display_errors('<p>', '</p>'));

									$this->session->set_flashdata('clr', 'warning');

									redirect('ukm_info/');

								}

								else

								{

									   $uploaddata = $this->upload->data();

									   $data = array(

										"FT_PROFIL" => $uploaddata['file_name']

									   );

									   $where = array(

										"ID_TOKO" => $this->infomodel->idakun()

									   );

									   

									   $this->infomodel->editData($data,"mp_toko" ,$where);

									   $this->session->set_flashdata('notif', 'Foto profil berhasil di ubah!');

									   $this->session->set_flashdata('clr', 'success');

									   redirect('ukm_info/');

								}

		}

		

		$this->load->view($this->template,$data);

	}

	public function gantikurir(){

		$id_akun =  $id_akun =  $this->infomodel->idakun();

		$data['judul_page'] ="Kurir";

		$data['des_page'] ="";

		$data['page'] = "info-gantikurir";

		$data['kurir'] = $this->infomodel->tampilData("mp_kurir","*",array("ID_TOKO" => $id_akun),TRUE);

		if($this->input->post("simpan") == TRUE){

			if($this->input->post("jne")){

				$jne = 1;

			}

			else{

				$jne = 0;

			}

			if($this->input->post("pos")){

				$pos = 1;

			}

			else{

				$pos = 0;

			}

			if($this->input->post("tiki")){

				$tiki = 1;

			}

			else{

				$tiki = 0;

			}

			 $data = array(

										"JNE" => $jne,

										"POS" => $pos,

										"TIKI" => $tiki

									   );

									   $where = array(

										"ID_TOKO" => $this->infomodel->idakun()

									   );

									   

									   $this->infomodel->editData($data,"mp_kurir" ,$where);

									   $this->session->set_flashdata('notif', 'Pemilihan kurir berhasil di perbarui');

									   $this->session->set_flashdata('clr', 'success');

									   redirect('ukm_info/gantikurir');

			

			

		}

		$this->load->view($this->template,$data);

	}

	public function gantiekspedisi(){

		$id_akun =  $id_akun =  $this->infomodel->idakun();

		$data['page'] = "info-gantiekspedisi";

		$this->load->view($this->template,$data);

	}

	public function cekpasswordlama(){

		$id_akun =  $this->session->userdata("id_akun_ukm");

		$where = array(

			"ID_USER" => $id_akun,	

		);

		$cek = $this->infomodel->tampilData("mp_user","*",$where,TRUE);

		if($cek->PASSWORD == acakPass($this->input->post("passlama"))){

				return TRUE;

		}

		else{

				$this->form_validation->set_message('cekpasswordlama', 'Password lama anda salah');

				return FALSE;

		}

	}

	function lihatKotaku(){

		$id_provinsi = $this->input->post('id_provinsi');

		$data_kota = $this->rajaongkir->city($id_provinsi);

		$data['kota'] = json_decode($data_kota);

		$data['kotadb'] = $this->input->post('id_kota_db');

		$this->load->view('lihat_kota_ku',$data);

	}

	function lihatKota(){

		$id_provinsi = $this->input->post('id_provinsi');

		$data_kota = $this->rajaongkir->city($id_provinsi);

		$data['kota'] = json_decode($data_kota);

		$this->load->view('lihat_kota',$data);

	}



	

}

