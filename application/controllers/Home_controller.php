<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home_controller extends CI_Controller {
	var $template = 'home_page';
	function __construct(){
		parent::__construct();
		$this->load->library('pagination');
		$this->load->model("M_home_product","producthomemodel");
    }

	public function index($halaman = NULL){
	if($halaman == NULL){ $halaman = 0;}
		$akun = $this->session->userdata("id_akun_user");
		$data["page"] = "home/home";
		$hitung  = $this->producthomemodel->hitungbarang();
		$data['slider'] = $this->producthomemodel->tampilData("mp_slider","*",array("STATUS_VALID" => 1));
		$config['base_url'] = base_url()."home_controller/index/";
		$config['total_rows'] =$hitung->hitung;
		$config['per_page']  = 8;
		$this->load->library('rajaongkir');
		$data_provinsi = $this->rajaongkir->province();
    	$data['provinsi'] = json_decode($data_provinsi);
    	$data['getalamat'] = $this->db->query("SELECT * FROM mp_temp_alamat WHERE ID_AKUN='$akun'")->result();
		$config['first_link'] = 'Awal';
 		$config['last_link'] = 'Terakhir';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="disabled"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$this->pagination->initialize($config);
		$data['halaman'] = $this->pagination->create_links();
		
		//$data['tampil'] = $this->producthomemodel->tampilData("mp_produk", "*",array(),FALSE, $config['per_page'],$halaman);
		$data['tampil'] = $this->producthomemodel->tampilterbaru($config['per_page'],$halaman);
		
		//echo $this->db->last_query();
		//$data['tampil_kategori_cari'] = $this->producthomemodel->tampilData("mp_sub_kategori", "*");
		$data['tampilslider'] = $this->producthomemodel->tampilData("mp_slider","*",array("STATUS_VALID" => 1));

		$this->load->view($this->template,$data);

	}

	public function getinfoalamat()
	{
		$akun = $this->session->userdata("id_akun_user");
		$id = $this->input->post('id_alamat');
		$data['alamat'] = $this->db->query("SELECT * FROM mp_temp_alamat WHERE ID_AKUN='$akun' AND ID_ALAMAT = '$id'")->row();
		$this->load->view('home/getalamat',$data);
	}

	public function tampilkanModalnya(){
		$data["page"] = "home/home_modal";
		$sir = $this->session->userdata("id_akun_user");
		$data['tampill'] =  $this->db->query("SELECT * FROM view_temp_cart  WHERE ID_AKUN = '$sir'")->result();
		$this->load->view($data["page"],$data);
	}
	

	public function detailProduct($id = NULL){
	
		$link2 = explode("-",$id);
		$link =  end($link2);
		if($id == NULL){ redirect();}
		if($link == ""){redirect();}
		$data['id'] = $id;
		$ip =  $this->producthomemodel->whatthisip();
		$ipiku = $ip . $id;
		if($this->session->userdata($ipiku) == FALSE){
			$hit = $this->producthomemodel->tampilData("mp_produk","*",array("ID_PRODUK"=>$link,"STS_PUBLISH" => 1),TRUE);
			$hit2 = $hit->HITS + 1;
			$this->producthomemodel->editData(array("HITS" => $hit2), "mp_produk",array("ID_PRODUK"=>$link,"STS_PUBLISH" => 1));
			$data = array($ipiku=>TRUE);
			$this->session->set_userdata($data);
		}
		$this->load->library('rajaongkir');
		$data_provinsi = $this->rajaongkir->province();
    	$data['provinsi'] = json_decode($data_provinsi);
		$data['id_produk']=$link;
		$akun = $this->session->userdata("id_akun_user");
		$data['getalamat'] = $this->db->query("SELECT * FROM mp_temp_alamat WHERE ID_AKUN='$akun'")->result();
		$data['getalamate'] = $this->db->query("SELECT * FROM mp_temp_alamat WHERE ID_AKUN='$akun' AND STS=1")->result();//new
		//print_r($data['getalamate']);
		$toko = $this->producthomemodel->tampilData("mp_produk","*",array("ID_PRODUK" => $link,"STS_PUBLISH" => 1), TRUE);
		$data["prolainukm"] = $this->producthomemodel->tampilprolainukm($link, $toko->ID_TOKO);
		$data["meta"] = $this->producthomemodel->tampilData("mp_produk","DES_META, KEY_META",array("ID_PRODUK" => $link,"STS_PUBLISH" => 1), TRUE);
		$data["tampil"] = $this->producthomemodel->tampilData("mp_produk","*",array("ID_PRODUK" => $link,"STS_PUBLISH" => 1));
		$data['tampilkategori'] = $this->producthomemodel->tampilData("mp_kategori","*");
		$data["page"] = "home/detailProduct";
		$this->load->view($this->template,$data);

	}
	
	function halamanSemuakategori(){
		$data['tampilkategori'] = $this->producthomemodel->tampilData("mp_kategori","*");
		$data["page"] = "home/halaman-semua-kategori";
		$this->load->view($this->template,$data);
	}
	
	public function pencariandikategori(){
		$min = $this->input->post("min");
		$ukm = $this->input->post("idlink");
		$max = $this->input->post("max");
		$produk = $this->input->post("produk");
		$urut = $this->input->post("urut");
		$halaman = $this->input->post("halaman");
		$A = $this->input->post("A");
		if($min == "" AND $max == "" AND $produk ==""){
			$status = 1;		
		}
		else{
			$status = 0;
		}
	
		$data['tampill'] = $this->producthomemodel->caribarangdikategori($produk,$ukm,$min,$max,$urut,$status,$halaman,$A);
			//echo $this->db->last_query();
		$this->load->view("home/carikategori",$data);
	}

	public function kategori($id,$halaman = NULL){
		$data['idlink'] = $id;
		$link2 = explode("-",$id);
		$link =  end($link2);
		if($id == NULL){ redirect();		}
		if($halaman == NULL){ $halaman = 0;}
		$cek_kategori = $this->producthomemodel->tampilData("mp_sub_kategori","*",array("ID_SUB_KATEGORI"=> $link),TRUE);
		if($cek_kategori->ID_SUB_KATEGORI == ""){ redirect("404");}
		$hitung  = $this->producthomemodel->hitungbarangkat($cek_kategori->ID_SUB_KATEGORI);
		$config['base_url'] = base_url()."home_controller/kategori/$id/";
		$config['total_rows'] =$hitung->hitung;
		$config['per_page']  = 8;
		$config['first_link'] = 'Awal';
 		$config['last_link'] = 'Terakhir';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="disabled"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$this->pagination->initialize($config);
		$data['halaman'] = $this->pagination->create_links();
		$data['judul'] = $cek_kategori->SUB_KATEGORI;
		//$data['tampil'] = $this->producthomemodel->tampilData("mp_produk","*",array("ID_KATEGORI" => $cek_kategori->ID_SUB_KATEGORI),FALSE,$config['per_page'],$halaman);
		$A = $config['per_page'];
		$data['halamann'] = $halaman;
		$data['A'] = $A;
		$data['tampil'] = $this->db->query("SELECT * FROM mp_produk  WHERE ID_KATEGORI = $cek_kategori->ID_SUB_KATEGORI AND STS_PUBLISH = '1' ORDER BY ID_PRODUK DESC LIMIT $halaman,$A")->result();
		$data["page"] = "home/kategoriProduk";
		$data['tampilkategori'] = $this->producthomemodel->tampilData("mp_kategori","*");
		$this->load->library('rajaongkir');
    	$data_provinsi = $this->rajaongkir->province();
    	//$data['provinsi'] = json_decode($data_provinsi);
		$data['tampilprovinsi'] = json_decode($data_provinsi);
		
		$this->load->view($this->template,$data);

	}
	public function pencarianKategori(){
		$min = $this->input->post("min");
		$max = $this->input->post("max");
		$produk = $this->input->post("produk");
		$urut = $this->input->post("urut");
		$kategori = $this->input->post("kategori");
		$provinsi = $this->input->post("provinsi");
		$kota = $this->input->post("kota");
		$halaman = $this->input->post("halaman");
		$A = $this->input->post("A");
		if($min == "" AND $max == "" AND $produk ==""){
			$status = 1;		
		}
		else{
			$status = 0;
		}
		$page = $this->input->post('page_number');
		if($page == null){
			$page = 1;
		}
        $max_results = 12;
        $position= (($page * $max_results)-$max_results);
		$data['tampill'] = $this->producthomemodel->caribarangdikategoripvt($produk,$min,$max,$urut,$kategori,$provinsi,$kota,$status, $position,$max_results);
		$total_set = $this->producthomemodel->hitungcaribarangdikategoripvt($produk,$min,$max,$urut,$kategori,$provinsi,$kota,$status,$position,$max_results);
		$total_pages = ceil($total_set / $max_results);
		$data["page"] = $page;
		$data["total_pages"] =  $total_pages;
		$this->load->view("home/carikategori",$data);
	}
	public function lihat_produk($link = "all",$halaman = NULL){
		$akun = $this->session->userdata("id_akun_user");
		$data['judul'] = "";
		if($halaman == NULL){ $halaman = 0;}
		if($link != "all"){ $produk = humanize($link);}
		$data["page"] = "home/lihatproduk";
		if($link == "all"){ 
			$hitung  = $this->producthomemodel->hitungbarang();
		}
		else{ 
			$hitung  = $this->producthomemodel->hitungbarangcari($produk,"all");
			$data['judul'] = $produk;
		}
		if($link == "all"){
			$config['base_url'] = base_url()."home_controller/lihat_produk/all/";
		}
		else{
			$config['base_url'] = base_url()."home_controller/lihat_produk/$link/";
		}
		
		$config['total_rows'] =$hitung->hitung;
		$config['per_page']  = 12;
		$A = $config['per_page'];
		$config['first_link'] = 'Awal';
 		$config['last_link'] = 'Terakhir';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="disabled"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$this->pagination->initialize($config);
		$data['halaman'] = $this->pagination->create_links();
		$data['tampilkategori'] = $this->db->query("SELECT * FROM mp_kategori")->result();
		$data['getalamat'] = $this->db->query("SELECT * FROM mp_temp_alamat WHERE ID_AKUN='$akun'")->result();
		$this->load->library('rajaongkir');
    	$data_provinsi = $this->rajaongkir->province();
    	//$data['provinsi'] = json_decode($data_provinsi);
		$data['tampilprovinsi'] = json_decode($data_provinsi);
		if($link == "all"){
			$data['tampill'] =  $this->db->query("SELECT * FROM mp_produk  WHERE STS_PUBLISH = '1' ORDER BY ID_PRODUK DESC LIMIT $halaman,$A")->result();
		}
		else{
			$data['tampill'] = $this->db->query("SELECT * FROM view_pencarian WHERE STS_PUBLISH = '1' AND NM_PRODUK LIKE '%$produk%' OR KATEGORI LIKE '%$produk%' OR SUB_KATEGORI LIKE '%$produk%' LIMIT $halaman, $A")->result();
			//$data['tampill'] =  $this->db->query("SELECT * FROM mp_produk  WHERE STS_PUBLISH = '1' AND NM_PRODUK LIKE '%$produk%' ORDER BY ID_PRODUK DESC LIMIT $halaman,$A")->result();
		
		}
		$data['tampilkategori'] = $this->producthomemodel->tampilData("mp_kategori");
		$data['halamann'] = $halaman;
		$data['A'] = $A;
		$this->load->view($this->template,$data);
	}
	public function pencarianLihat_produk(){
		$min = $this->input->post("min");
		$max = $this->input->post("max");
		$produk = $this->input->post("produk");
		$urut = $this->input->post("urut");
		$kategori = $this->input->post("kategori");
		$provinsi = $this->input->post("provinsi");
		$kota = $this->input->post("kota");
		$halaman = $this->input->post("halaman");
		$A = $this->input->post("A");
		if($min == "" AND $max == "" AND $produk ==""){
			$status = 1;		
		}
		else{
			$status = 0;
		}
		$page = $this->input->post('page_number');
		if($page == null){
			$page = 1;
		}
        $max_results = 12;
        $position= (($page * $max_results)-$max_results);
		$data['tampill'] = $this->producthomemodel->caribarangdilihatproduk($produk,$min,$max,$urut,$kategori,$provinsi,$kota,$status, $position,$max_results);
		$total_set = $this->producthomemodel->hitungcaribarangdilihatproduk($produk,$min,$max,$urut,$kategori,$provinsi,$kota,$status,$position,$max_results);
		$total_pages = ceil($total_set / $max_results);
		$data["page"] = $page;
		$data["total_pages"] =  $total_pages;
		$this->load->view("home/carikategori",$data);
	}
	public function pencarian($link,$halaman = NULL){
		if($halaman == NULL){ $halaman = 0;}
		//$link2 = explode("-",$link);

		$produk = humanize($link);

		//$kategori = $link2[1];

		if($produk == ""){ redirect("404");}

		$data["page"] = "home/cariProduk";

		$data['judul'] = $produk;


		//$data['tampil'] = $this->producthomemodel->tampilData("mp_produk", "*", "NM_PRODUK LIKE '%$produk%'");
		$hitung  = $this->producthomemodel->hitungbarangcari($produk,"all");
		$config['base_url'] = base_url()."home_controller/pencarian/$produk/";
		$config['total_rows'] =$hitung->hitung;
		$config['per_page']  = 9;
		$config['first_link'] = 'Awal';
 		$config['last_link'] = 'Terakhir';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="disabled"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		
		$this->pagination->initialize($config);
		$data['halaman'] = $this->pagination->create_links();
		$A = $config['per_page'];
		$data['tampil'] = $this->db->query("SELECT * FROM view_pencarian WHERE STS_PUBLISH = '1' AND NM_PRODUK LIKE '%$produk%' OR KATEGORI LIKE '%$produk%' OR SUB_KATEGORI LIKE '%$produk%' LIMIT $halaman, $A")->result();

		$data['tampilkategori'] = $this->producthomemodel->tampilData("mp_kategori","*");
		
		$this->load->view($this->template,$data);

	}
	public function cari(){

		$prd1 = $this->input->post("produk");
		$dilarang = array("!","@","#","$","%","^","&","*","(",")","-","_","+","=","{","}","[","]","|",";",":","<",">",",",".","?","/");
		$produk = str_replace($dilarang, "", $prd1);
		$produk = underscore($produk);
		$status = $this->input->post("statusyangadadipencarianbesar");
		echo $status;
		//$kategori = $this->input->post("kategori");

		if($produk == ""){ redirect();}

		//$link = setPermalink($kategori,$produk);
		if($status == "Produk"){
			//echo "as";
			redirect("home_controller/lihat_produk/$produk/");
		}
		else{
			echo $produk;
			redirect("home_controller/caripabrik/$produk/");

		}
		

	}
	
	public function tampilkotadipencarian(){
		$this->load->library('rajaongkir');
		$id_provinsi = $this->input->post("provinsi");
		$data_kota = json_decode($this->rajaongkir->city($id_provinsi));
		echo '<option value="semua">Semua Kota</option>';
		foreach ($data_kota->rajaongkir->results  as $row) {
			if($row->type == 'Kota'){

				$type = ' ( '.$row->type.' ) ';

			}

			else{

				$type = '';

			}
			echo '<option value="'.$row->city_id.'">'.$row->city_name .$type.'</option>';
		}
	}
		public function lihat_ukm($halaman = NULL){
		if($halaman == NULL){ $halaman = 0;}
		$data["page"] = "home/lihatukm";
		$hitung  = $this->producthomemodel->hitungukm();
		$config['base_url'] = base_url()."home_controller/lihat_ukm/";
		$config['total_rows'] =$hitung->hitung;
		$config['per_page']  = 12;
		$A = $config['per_page'];
		$config['first_link'] = 'Awal';
 		$config['last_link'] = 'Terakhir';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="disabled"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$this->pagination->initialize($config);
		$data['halaman'] = $this->pagination->create_links();
		$data['tampill'] =  $this->db->query("SELECT * FROM mp_toko ORDER BY ID_TOKO DESC LIMIT $halaman,$A")->result();
		$data['tampilkategori'] = $this->producthomemodel->tampilData("mp_kategori");
		$this->load->library('rajaongkir');
    	$data_provinsi = $this->rajaongkir->province();
    	//$data['provinsi'] = json_decode($data_provinsi);
		$data['tampilprovinsi'] = json_decode($data_provinsi);
		$this->load->view($this->template,$data);
	}
public function caritoko(){
		$namatoko = $this->input->post("namatoko");
		$provinsi = $this->input->post("provinsi");
		$kota = $this->input->post("kota");
		$page = $this->input->post('page_number');
		if($page == null){
			$page = 1;
		}
		 $max_results = 12;
		 $position= (($page * $max_results)-$max_results);
		$data['tampill'] = $this->producthomemodel->caritokodilihat_ukm($namatoko,$provinsi,$kota, $position,$max_results);
		//echo $this->db->last_query();
		$total_set = $this->producthomemodel->hitungcaritokodilihat_ukm($namatoko,$provinsi,$kota);
		$total_pages = ceil($total_set / $max_results);
		$data["page"] = $page;
		$data["total_pages"] =  $total_pages;
		$this->load->view("home/caritoko",$data);
	}


		public function ukm($id,$halaman = NULL){
		$akun = $this->session->userdata("id_akun_user");
		if($halaman == NULL){ $halaman = 0;}
		if($id == NULL){ redirect();}
		$idd = humanize($id, "-");
		$cek_ukm = $this->producthomemodel->tampilData("mp_toko","*",array("NM_TOKO"=> $idd),TRUE);
		if($cek_ukm->ID_TOKO == ""){redirect("404");}
		$hitung  = $this->producthomemodel->hitungbarangukm($cek_ukm->ID_TOKO);
		$data['getalamat'] = $this->db->query("SELECT * FROM mp_temp_alamat WHERE ID_AKUN='$akun'")->result();
		$config['base_url'] = base_url()."home_controller/ukm/$id/";
		$config['total_rows'] =$hitung->hitung;
		$config['per_page']  = 12;
		$config['first_link'] = 'Awal';
 		$config['last_link'] = 'Terakhir';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="disabled"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$this->pagination->initialize($config);
		$data['halaman'] = $this->pagination->create_links();
		$data['tampil'] = $this->producthomemodel->tampilData("mp_produk","*",array("ID_TOKO" => $cek_ukm->ID_TOKO,"STS_PUBLISH" => 1),FALSE,$config['per_page'],$halaman);
		$data["page"] = "home/ukmProduk";
		$data['idukm'] =  $cek_ukm->ID_TOKO;
		$data['judul'] = $cek_ukm->NM_TOKO;
		$data['tampilukm'] = $this->producthomemodel->tampilData("mp_toko","*",array("ID_TOKO" => $cek_ukm->ID_TOKO),TRUE);
		$data['tampilkategori'] = $this->producthomemodel->tampilData("mp_kategori","*");
		$this->load->library('rajaongkir');
    	$data_provinsi = $this->rajaongkir->province();
    	//$data['provinsi'] = json_decode($data_provinsi);
		$data['tampilprovinsi'] = json_decode($data_provinsi);
		$this->load->view($this->template,$data);

	}
	public function pencariandiUkm(){
		$produk = $this->input->post("produk");
		$urut = $this->input->post("urut");
		$kategori = $this->input->post("kategori");
		$idtoko = $this->input->post("idtoko");
		$halaman = $this->input->post("halaman");
		$A = $this->input->post("A");
		$data['idukm'] = $idtoko;
		if($produk ==""){
			$status = 1;		
		}
		else{
			$status = 0;
		}
		$page = $this->input->post('page_number');
		if($page == null){
			$page = 1;
		}
        $max_results = 12;
        $position= (($page * $max_results)-$max_results);
		$data['tampill'] = $this->producthomemodel->caribarangdiukm($idtoko,$produk,$urut,$kategori,$position,$max_results);
		//ECHO $this->db->last_query();
		$total_set = $this->producthomemodel->hitungcaribarangdiukm($idtoko,$produk,$urut,$kategori,$position,$max_results);
		$total_pages = ceil($total_set / $max_results);
		$data["page"] = $page;
		$data["total_pages"] =  $total_pages;
		$this->load->view("home/caridiukm",$data);
	}
	public function cariUkm($id){
			if($this->input->post("cariukm") == ""){
			if($this->input->post("min") == ""){
				if($this->input->post("max") == ""){
					if($this->input->post("urut") == ""){
						$a = 1;
					}
					else{
						$a = 0;
					}
					
				}
				else{
					$a =0;
				}
			}
			else{
				$a = 0 ;
			}
		}
		else{
			$a = 0;
		}
		
		if($a == 1){
			redirect("home_controller/ukm/$id");
		}
		if($this->input->post("cariukm") != ""){
			$produk = underscore($this->input->post("cariukm"));
		}
		else{
			$produk = underscore("semua produk");
		}
		if($this->input->post("min") == ""){
			$min = 0;
		}
		else{
			$min = $min = $this->input->post("min");
		}
		if($this->input->post("max") == ""){
			$max = 0;
		}
		else{
			$max = $this->input->post("max");
		}
		$urut = $this->input->post("urut");
		
		$link = setPermalink($produk,$id);
		redirect("home_controller/pencarianUkm/$link/$min/$max/$urut/");
	}

	public function pencarianUkm($link,$min,$max,$urut,$halaman = NULL){

	if($halaman == NULL){ $halaman = 0;}
		$link2 = explode("-",$link);
		$produk = humanize($link2[1]);
		$ukm = $link2[0];
		$data['idlink'] = $link2[0];

		if($produk == "" OR $ukm  == "" OR $min == "" OR $max == "" OR $urut == ""){ redirect("404");}
		$data["page"] = "home/cariProdukdiukm";
		$data['judul'] = $produk;
		//$data['tampil'] = $this->producthomemodel->tampilData("mp_produk", "*", "NM_PRODUK LIKE '%$produk%'");
		$hitung  = $this->producthomemodel->hitungbarangcariukm($produk,$ukm,$min,$max,$urut);
		$config['base_url'] = base_url()."home_controller/pencarian/$link/";
		$config['total_rows'] =$hitung;
		$config['per_page']  = 9;
		$config['first_link'] = 'Awal';
 		$config['last_link'] = 'Terakhir';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="disabled"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		
		$this->pagination->initialize($config);
		$data['halaman'] = $this->pagination->create_links();
		$A = $config['per_page'];
		$data['tampill'] = $this->producthomemodel->barangcariukm($produk,$ukm,$min,$max,$urut,$halaman,$A);
		$this->load->view($this->template,$data);
	}
	
	
	
	public function pencariantoko($produk,$halaman = NULL){
		if($halaman == NULL){ $halaman = 0;}
		if($produk == ""){redirect("home_controller/lihat_ukm");}
		$config['base_url'] = base_url()."home_controller/pencariantoko/$produk/";
		$produk = humanize($produk);
		$data["page"] = "home/caritoko";
		$data['judul'] = $produk;
		$hitung  = $this->producthomemodel->hitungbarangcaritoko($produk);
		$config['total_rows'] = $hitung->hitung;
		$config['per_page']  = 2;
		$config['first_link'] = 'Awal';
 		$config['last_link'] = 'Terakhir';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="disabled"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		
		$this->pagination->initialize($config);
		$data['halaman'] = $this->pagination->create_links();
		$a = $config['per_page'];
		$data['tampill'] = $this->db->query("SELECT * FROM mp_toko WHERE NM_TOKO LIKE '%$produk%' LIMIT $halaman, $a")->result();

		$this->load->view($this->template,$data);
	}
	



	
	public function caripabrik($link,$halaman = NULL){
		if($halaman == NULL){ $halaman = 0;}
		$produk = humanize($link);
		if($produk == ""){ redirect("404");}
		$data["page"] = "home/caripabrik";
		$data['judul'] = $produk;
		$hitung  = $this->producthomemodel->hitungpabrikcari($produk);
		$config['base_url'] = base_url()."home_controller/caripabrik/$produk/";
		$config['total_rows'] =$hitung->hitung;
		$config['per_page']  = 12;
		$config['first_link'] = 'Awal';
 		$config['last_link'] = 'Terakhir';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="disabled"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$this->pagination->initialize($config);
		$data['halaman'] = $this->pagination->create_links();
		$A = $config['per_page'];
		$data['tampill'] = $this->db->query("SELECT * FROM mp_toko WHERE  NM_TOKO LIKE '%$produk%' LIMIT $halaman, $A")->result();
		//$data['tampilkategori'] = $this->producthomemodel->tampilData("mp_kategori","*");
		//echo $this->db->last_query();
		$this->load->view($this->template,$data);
	}
	
	public function hal($link = NULL){
		//echo "asas";exit();
		//if($link == NULL){ redirect("404");}
		$data['page']="home/prehalaman";
		$data['tampil'] = $this->db->query("SELECT * FROM mp_halaman WHERE LINK = '$link'")->row();
		$this->load->view($this->template, $data);
		
	}

}