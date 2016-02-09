<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_transaksi extends MY_Admin {

	var $template = 'admin_page';
    function __construct()
	{
		parent::__construct();
		$this->load->model('M_admin_transaksi', 'admintrans');
		$this->session->set_userdata(array("menu_admin" => "orderan"));
		//$this->cekLogin();
    }

	public function index()
	{
		$data['judul_page'] = 'Data Transaksi';
		$data['des_page'] = '';
		$data['page'] = "lihat";
		$this->load->view($this->template, $data);
	}
	public function tabel($id)
	{
		error_reporting(0);
		$this->session->set_userdata(array("submenu" => $id));
		$data['id'] = $id;
		$data['judul_page'] = 'Orderan';
		$data['des_page'] = '';
		$data['tampil'] = $this->db->query("SELECT * FROM view_transaksi WHERE ID_STATUS='$id' ORDER BY TGL_TRANS DESC")->result();
		//echo $this->db->last_query();
		$data['page'] = "tabel1";
		$this->load->view($this->template, $data);
	}
	public function table2($id)
	{
		$this->session->set_userdata(array("submenu" => $id));
		$data['id'] = $id;
		$data['judul_page'] = 'Orderan';
		$data['des_page'] = '';
		$data['tampil'] = $this->db->query("SELECT * FROM view_transaksi WHERE ID_STATUS='$id'")->result();
		//echo $this->db->last_query();
		$data['page'] = "tabel2";
		$this->load->view($data['page'], $data);
	}
	function detailTransaksi($id = NULL){
		if($id == NULL){ redirect("404");}
		$id = base64_decode_fix($id);
		//echo $id;exit();
		$data['id'] = $id;
		$data['judul_page'] = 'Detail Transaksi';
		$data['des_page'] = 'Detail Transaksi';
		
		$cek = $this->db->query("SELECT * FROM mp_transaksi WHERE ID_TRANS='$id'")->row();
		if($cek->ID_STATUS==1)
		{
			$data['pembeli'] = $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TRANS='$id' LIMIT 1")->row();
			$data['toko'] = $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TRANS='$id' GROUP BY ID_TOKO")->result();
			$data['page'] = "detail_transaksi_1";
			$this->load->view($this->template, $data);
		}
		elseif($cek->ID_STATUS==2)
		{
			$data['pembeli'] = $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TRANS='$id' LIMIT 1")->row();
			$data['toko'] = $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TRANS='$id' GROUP BY ID_TOKO")->result();
			$data['page'] = "detail_transaksi_2";
			$this->load->view($this->template, $data);
		}
		elseif($cek->ID_STATUS==3)
		{
			$data['pembeli'] = $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TRANS='$id' LIMIT 1")->row();
			$data['toko'] = $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TRANS='$id' AND STS_TAMPIL=1 GROUP BY ID_TOKO")->result();
			$data['page'] = "detail_transaksi_3";
			$this->load->view($this->template, $data);
		}
		elseif($cek->ID_STATUS==4)
		{
			$data['pembeli'] = $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TRANS='$id' LIMIT 1")->row();
			$data['toko'] = $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TRANS='$id' GROUP BY ID_TOKO")->result();
			$data['page'] = "detail_transaksi_4";
			$this->load->view($this->template, $data);
		}
		elseif($cek->ID_STATUS==5)
		{
			$data['pembeli'] = $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TRANS='$id' LIMIT 1")->row();
			$data['toko'] = $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TRANS='$id' AND STS_TAMPIL=1 GROUP BY ID_TOKO")->result();
			$data['page'] = "detail_transaksi_5";
			$this->load->view($this->template, $data);
		}
		
		
	}	
	function barang_ada(){
		$id = $this->input->post("no_trans");
		$st = $this->db->query("UPDATE mp_transaksi SET ID_STATUS='6' WHERE NO_TRANS='$id'");
		if($st)
		{
			echo "Berhasil";
		}
		else
		{
			echo "Gagal";
		}
	}	
	function hituung(){
		$tg = $this->input->post("tg");
		$kode = $this->input->post("kode");
		echo formatRp($tg+$kode);
	}	
	function tghn(){
		$tg = $this->input->post("tg");
		echo formatRp($tg);
	}	
	function do_menunggu_konfirmasi_admin(){
		$id = $this->input->post("no_trans");
		$id_trans = $this->input->post("id_trans");

		$toko = $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TRANS='$id_trans' GROUP BY ID_TOKO")->result();
		foreach ($toko as $ke) {
			$this->kirimemail($id_trans,$ke->ID_TOKO);
		}
		
		$st = $this->db->query("UPDATE mp_transaksi SET ID_STATUS='2' WHERE NO_TRANS='$id'");
		if($st)
		{
			echo "Berhasil";
		}
		else
		{
			echo "Gagal";
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
	function do_konfirmasi_ulang(){
		$id = $this->input->post("no_trans");
		$st = $this->db->query("UPDATE mp_transaksi SET ID_STATUS='5' WHERE NO_TRANS='$id'");
		if($st)
		{
			echo "Berhasil";
		}
		else
		{
			echo "Gagal";
		}
	}	
	function kirim_resi(){
		$resi = $this->input->post("resi");
		$no_trans = $this->input->post("no_trans");
		$toko = $this->input->post("toko");
		$smp = count($resi);
		for ($i=0; $i < $smp; $i++) { 
			$tk= $toko[$i];
			$rs= $resi[$i];
			$this->db->query("INSERT INTO mp_resi (NO_TRANS,ID_TOKO,RESI) VALUES ('$no_trans','$tk','$rs')");
		}
		$this->db->query("UPDATE mp_transaksi SET ID_STATUS='1' WHERE NO_TRANS='$no_trans'");
		
	}	
	function kirimemail($trans,$toko){
		$iki= $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TRANS='$trans' AND ID_TOKO='$toko'")->result();
		$mai= $this->db->query("SELECT * FROM mp_toko WHERE ID_TOKO='$toko'")->row();
		$data_login = $this->db->query("SELECT * FROM mp_user WHERE ID_AUTH='$mai->ID_TOKO'")->row();
		$username = $data_login->USERNAME;
		$password = $data_login->PASSWORD;
		$isi="<table cellspacing='0'  bordercolor='#000000' cellpadding='4' border='1' style='border: solid 1.5pt black; border-collapse: collapse'>";
		$isi.="<thead>";
		$isi.="<tr>";
		$isi.="<th>No</th>";
		$isi.="<th>Produk</th>";
		$isi.="<th>QTY</th>";
		$isi.="<th>Berat @</th>";
		$isi.="<th>Harga @</th>";
		$isi.="<th>Total Berat</th>";
		$isi.="<th>Total Harga</th>";
		$isi.="<th>Ongkir</th>";
		$isi.="<th>Total</th>";
		$isi.="</tr>";
		$isi.="</thead>";
		$isi.="<tbody>";
		$no = 1;
    	$tot_web=0;
    	$tot_pj=0;
    	$tot_akh=0;
    	$tot_akh_ongkir=0;
    	$tot_ongkir=0;
		foreach ($iki as $detail) {
			$namatoko=$detail->NM_TOKO;
			$tgl_transaksi=$detail->TGL_TRANS;
			$isi.="<tr>";
			$isi.="<td>".$no++."</td>";
			$isi.="<td>".$detail->NM_PRODUK."</td>";
			$isi.="<td>".$detail->QTY."</td>";
			$isi.="<td>".$detail->BERAT_PRODUK."</td>";
			$isi.="<td>".formatRp($detail->HARGA_PER)."</td>";
			$isi.="<td>".konversiGram($detail->BERAT_PRODUK*$detail->QTY)."</td>";
			$totharga = $detail->HARGA_PER*$detail->QTY;
			$isi.="<td>".formatRp($detail->HARGA_PER*$detail->QTY)."</td>";
			$tot_ongkir +=$detail->HARGA_ONGKIR;
			$isi.="<td>".formatRp($detail->HARGA_ONGKIR)."</td>";
			$tot_akh += $totharga+$detail->HARGA_ONGKIR;
			$isi.="<td>".formatRp($totharga+$detail->HARGA_ONGKIR)."</td>";
			$isi.="<tr>";
		}
		$isi.="</tbody>";
		$isi.="<tfoot>";
		$isi.="<td colspan='7' align='center'>Jumlah</td>";
   		$isi.="<td>".formatRp($tot_ongkir)."</td>";
   		$isi.="<td>".formatRp($tot_akh)."</td>";
		$isi.="</tfoot>";
		$isi.="</table>";
		$this->load->library('email');
		$config = array(  "mailtype" => "html");
		$this->email->initialize($config);
		$this->email->from('indobaba.online@gmail.com', 'INDOBABA');
		$this->email->to($mai->EMAIL);
		$this->email->cc('indobaba.online@gmail.com');
		$this->email->bcc('indobaba.online@gmail.com');
		$this->email->subject('Orderan dari indobaba');
		$this->email->message("Hai <b>".$namatoko."</b> ,<br/><br/> Anda mendapatkan orderan pada tanggal <b>".tgl_indo_lengkap($tgl_transaksi)."</b> di ID Transaksi <b>".$trans."</b><br/><br/>Silahkan klik link dibawah ini untuk melihat orderan anda<br/><br/> <a href='".base_url()."admin_transaksi/detailTransaksiUkmEmail'>".base_url()."ukm_info</a><br/><br/>Terima kasih atas perhatiannya. Dimohon segera konfirmasi ketersediaan dan melakukan pengiriman orderan anda.<br/><br/><br/>Salam Indobaba Group");
		$this->email->send();
	}
	
	function detailTransaksiUkmEmail($email,$username,$password){
		$this->load->library('email');
		$this->email->from('indobaba.online@gmail.com','Admin Indobaba');
		$this->email->to("isarafi13@gmail.com");
		//diisi dengan alamat tujuan
		$this->email->subject('Mencoba');
		$this->email->message("Mencoba");
		$this->email->send();
	}
	
	function ft_bukti($id = NULL){
		// if($id == NULL){ redirect("404");}
		// $id = base64_decode_fix($id);
		// $ss = $this->db->query("SELECT * FROM mp_bukti WHERE NO_TRANS='$id'")->row();
		// echo "<img src='".site_url('assets/images/bukti/'.$ss->FT_BUKTI)."' ></img>";
	}
	function cekKredit($id = NULL){
		if($id == NULL){ redirect("404");}
		$id = base64_decode_fix($id);
		//echo $id;exit();
		$data['id'] = $id;
		$data['judul_page'] = 'Cek kredit Api';
		$data['des_page'] = 'Cek kredit Api';
		$data['page'] = "cek_kredit";
		$data['tampil'] = $this->adminapi->tampilData('mp_setting',"*",array("ID_SETTING" => $id),$result=TRUE);
		$this->load->view($this->template, $data);
		
	}
	function tambahApi(){
		$des_api=$this->input->post('des_api');
		$user_key=$this->input->post('user_key');
		$pass_key=$this->input->post('pass_key');
		$link=$this->input->post('link');
		$kredit=$this->input->post('kredit');
		$data = array(
			'DESKRIPSI' => $des_api,
			'SETTING' => $user_key."#".$pass_key,
			'LINK' => $link,
			'LINK_KREDIT' => $kredit
		);


		if($this->adminapi->tambahData($data,'mp_setting'))
		{
			redirect('admin_api');
		}
		else
		{
			redirect('admin_ukm/tambah');
		}
	}
	function updateApi($id = NULL){
		if($id == NULL){ redirect("404");}
		$id = base64_decode_fix($id);
		$des_api=$this->input->post('des_api');
		$user_key=$this->input->post('user_key');
		$pass_key=$this->input->post('pass_key');
		$link=$this->input->post('link');
		$kredit=$this->input->post('kredit');
		$where_auth = array(
			'ID_SETTING' => $id
		);

		$data = array(
			'DESKRIPSI' => $des_api,
			'SETTING' => $user_key."#".$pass_key,
			'LINK' => $link,
			'LINK_KREDIT' => $kredit
		);

		if($this->adminapi->editData($data,'mp_setting',$where_auth))
		{
			redirect('admin_api');
		}
		else
		{
			redirect('admin_ukm/editApi/'.base64_encode_fix($id));
		}
	}
	function hapusApi($id = NULL){
		if($id == NULL){ redirect("404");}
		$id = base64_decode_fix($id);
		$where_auth = array(
			'ID_SETTING' => $id
		);
		if($this->adminapi->hapusData('mp_setting',$where_auth))
		{
			redirect('admin_api');
		}
		else
		{
			redirect('admin_api');
		}
	}
	function status($id = NULL){
		if($id == NULL){ redirect("404");}
		$id = base64_decode_fix($id);
		$data = array(
			'STATUS' => 0
		);

		$this->adminapi->editData($data,'mp_setting');

		$where_auth2 = array(
			'ID_SETTING' => $id
		);

		$data2 = array(
			'STATUS' => 1
		);

		$this->adminapi->editData($data2,'mp_setting',$where_auth2);
		redirect('admin_api');
	}
	 function modalTersedia()
    {
	    $id_toko=$this->input->post("id_toko");
	    $transaksi=$this->input->post("transaksi");    
	    $data['transaksi']=$transaksi;         
	    $data['id_toko']=$id_toko;         
	    $data['tampil'] = $this->admintrans->tampilData('view_detail_transaksi',"*",array("ID_TRANS" => $transaksi, "ID_TOKO" => $id_toko ),$result=FALSE);
	    $this->load->view("modal_tersedia",$data);
    } 
    function do_tersedia()
    {
	    $no_trans=$this->input->post("no_trans");
	    //$id_toko=$this->input->post("id_toko");
	    $ongkir=$this->input->post("ongkir");
	    $ongkirs=$this->input->post("ongkirs");
	    $tokonya=$this->input->post("tokonya");
	    $cart=$this->input->post("cart".$tokonya);
	    $trs = $this->input->post("qtytersedia".$tokonya);

	    $tok=count($cart);
	    for ($oo=0; $oo < $tok; $oo++) { 
	    	//echo $cart[$oo];
	    	$ini = array('QTY_TERSEDIA' => $trs[$oo]);
	    	//echo "Qty Tersedia : ".$trs[$oo]." - Cart : ".$cart[$oo];
	    	$this->admintrans->editData($ini,'mp_cart',array("ID_CART" => $cart[$oo],"ID_ONGKIR" => $ongkirs));
	    	$this->db->query("UPDATE mp_cart SET STS_TANGGAP='1' WHERE ID_CART='$cart[$oo]' AND ID_ONGKIR='$ongkirs'"); 
	    }
	    $do_alamat=$this->db->query("SELECT * FROM view_detail_transaksi WHERE NO_TRANS='$no_trans' AND ID_TOKO='$tokonya' AND ID_ONGKIR='$ongkirs' GROUP BY ID_ONGKIR ")->result();
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
			else
			{
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
	    echo $this->db->last_query();
    }
    function do_batal()
    {
    	//DARISINI
	    $no_trans=$this->input->post("no_trans");
	    $id_trans=$this->input->post("id_trans");
	    $tokonya=$this->input->post("tokonya");
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
				$this->admintrans->tambahData($data,'mp_cart_batal');

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
    function isiresi()
    {
    	$no_trans=$this->input->post("no_trans");
    	$id_ongkir=$this->input->post("id_ongkir");
    	$id_trans=$this->input->post("id_trans");
    	$resi=$this->input->post("resi");
    	$toko=$this->input->post("toko");

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
		//echo $juml;
		if($juml==$f)
		{
			$this->db->query("UPDATE mp_transaksi SET ID_STATUS=4 WHERE ID_TRANS='$id_trans'");
			$produk = $this->db->query("SELECT * FROM view_checkout WHERE ID_TRANS = '$id_trans'")->result();
			foreach ($produk as $row) {
				$laris = $this->admintrans->tampilData('mp_cart', 'SUM(QTY) as LARIS', array('ID_PRODUK' => $row->ID_PRODUK), TRUE);
				$add_laris = array('IN_CART' => $laris->LARIS);
				$this->admintrans->editData($add_laris, 'mp_produk', array('ID_PRODUK' => $row->ID_PRODUK));
			}
		}

		$h = $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TRANS='$id_trans' AND ID_TOKO='$toko'")->result();
		$ree = count($h);
		$juml2=0;
		foreach ($h as $krt) {
			if($krt->STS_RESI==1)
			{
				$juml2+=1;
			}
		}
		//echo $juml;
		if($juml2==$ree)
		{
			$ceken = $this->db->query("SELECT * FROM  mp_riwayat_untung WHERE ID_TRANS='$id_trans' AND ID_TOKO='$toko'")->row();
			$pj = $this->db->query("SELECT * FROM mp_toko WHERE ID_TOKO = '$toko'")->row();
			$k = $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TRANS='$id_trans' AND ID_TOKO='$toko'")->result();
			$tot_web=0;
			$tot_pj=0;
			foreach ($k as $ke) {
				$totharga2 = $ke->HARGA_PER*$ke->QTY_TERSEDIA;
				
				$keu = $this->db->query("SELECT * FROM mp_keuntungan LIMIT 1")->ROW(); 
			  	$keuntungan1 =($keu->KEUNTUNGAN_UKM/100)*$totharga2;
			  	$tot_web+=$keuntungan1;

			  	$keu = $this->db->query("SELECT * FROM mp_keuntungan LIMIT 1")->ROW(); 
			  	$keuntungan2 =($keu->KEUNTUNGAN_PJ/100)*$totharga2;
			  	$tot_pj+=$keuntungan2;
			}
			if(!$ceken)
			{
				$tgl = date("Y-m-d");
				$this->db->query("INSERT INTO mp_riwayat_untung (ID_PJ,NOMINAL_PJ,NOMINAL_INDOBABA,ID_TRANS,ID_TOKO,TANGGAL)
				VALUES ($pj->ID_PENANGGUNG_JWB,$tot_pj,$tot_web,'$id_trans',$toko,'$tgl')");
			}
		}

    }
	function resivalid()
	{
		$id_trans=$this->input->post("id_trans");
		$this->db->query("UPDATE mp_transaksi SET ID_STATUS=4 WHERE ID_TRANS='$id_trans'");
		// $produk = $this->db->query("SELECT * FROM view_checkout WHERE ID_TRANS = '$id_trans'")->result();
		// foreach ($produk as $row) {
		// 	$laris = $this->admintrans->tampilData('mp_cart', 'SUM(QTY) as LARIS', array('ID_PRODUK' => $row->ID_PRODUK), TRUE);
		// 	$add_laris = array('IN_CART' => $laris->LARIS);
		// 	$this->admintrans->editData($add_laris, 'mp_produk', array('ID_PRODUK' => $row->ID_PRODUK));
		// }
	}
	    function batalkanini()
    {

	    $no_trans=$this->input->post("no_trans");
	    $id_trans=$this->input->post("id_trans");
	    $ongkir=$this->input->post("ongkir");
	    $ongkirs=$this->input->post("ongkirs");
	    $tokonya=$this->input->post("tokonya");
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
	    	$this->admintrans->editData($ini,'mp_cart',array("ID_CART" => $cart[$oo],"ID_ONGKIR" => $ongkirs));
	    	$this->db->query("UPDATE mp_cart SET STS_TANGGAP='0',STS_RESI=0,RESI='' WHERE ID_CART='$cart[$oo]' AND ID_ONGKIR='$ongkirs'"); 
	    }

	    $do_alamat=$this->db->query("SELECT * FROM view_detail_transaksi WHERE NO_TRANS='$no_trans' AND ID_TOKO='$tokonya' AND ID_ONGKIR='$ongkirs' GROUP BY ID_ONGKIR")->result();
		//print_r($do_alamat);
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

	    	$ceken = $this->db->query("SELECT * FROM  mp_riwayat_untung WHERE ID_TRANS='$id_trans' AND ID_TOKO='$tokonya'")->row();
			if($ceken)
			{
				$this->db->query("DELETE FROM mp_riwayat_untung WHERE ID_RIWAYAT_UNTUNG='$ceken->ID_RIWAYAT_UNTUNG'");
			}
    }
    function detailBatal()
    {
        $data['id']=$this->input->post("id_trans");
        $data['id_toko']=$this->input->post("id_toko");
        $id=$data['id'];
        $id_toko=$data['id_toko'];
        $data['pembeli'] = $this->db->query("SELECT * FROM view_trans_batal WHERE ID_TRANS='$id' LIMIT 1")->row();
		$data['toko'] = $this->db->query("SELECT * FROM view_trans_batal WHERE ID_TRANS='$id' AND ID_TOKO='$id_toko' GROUP BY ID_TOKO")->result();
        $this->load->view("modal_batal",$data);
    }
    function kirimRekening()
    {
    	$data['id_toko']=$this->input->post("id_toko");
    	$data['id_trans']=$this->input->post("id_trans");
        $this->load->view("modal_kirim_rek",$data);
    }    
    function do_kirim_rek()
    {
    	$tgl = date('Y-m-d');
    	$jam = date('H:i:s');
    	$bank_tujuan=$this->input->post("bank_tujuan");
    	$no_rek=$this->input->post("no_rek");
    	$trans=$this->input->post("trans");
    	$toko=$this->input->post("toko");
    	$cek = $this->db->query("SELECT * FROM mp_kirim_rekening WHERE ID_TRANSAKSI='$trans' AND ID_TOKO='$toko'")->num_rows();
    	if($cek==0)
    	{
    		$this->db->query("INSERT INTO mp_kirim_rekening 
    		(
				ID_TRANSAKSI,
				ID_TOKO,
				ID_REKENING,
				PETUGAS,
				TANGGAL,
				JAM
			)
			VALUES
			(
				'$trans',
				$toko,
				'$bank_tujuan',
				'admin',
				'$tgl',
				'$jam'
			)");
    	}
    	else
    	{
    		$this->db->query("UPDATE mp_kirim_rekening 
			SET
			ID_REKENING='$bank_tujuan',
			PETUGAS='admin',
			TANGGAL='$tgl',
			JAM='$jam'
			WHERE ID_TRANSAKSI='$trans' AND
			ID_TOKO=$toko
			");
    	}
    }
}