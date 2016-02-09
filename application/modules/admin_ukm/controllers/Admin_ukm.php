<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_ukm extends MY_Admin {
	var $template = 'admin_page';
	var $template_ukm = 'edit_ukm';
	function __construct(){
		parent::__construct();
		$this->load->model('M_admin_ukm','adminukm');
		$this->load->model('admin_penanggung_jwb/M_admin_penanggung_jwb','penanggung_jwb');
		$this->session->set_userdata(array('menu_admin' => 'master_ukm'));
    }

    function index(){
		$data['judul_page'] = 'Tambah UKM';
		$data['des_page'] = 'Tambah ukm baru';
		$data['page'] = 'lihat_ukm';
		$data['ukm'] = $this->adminukm->tampilData('mp_toko','*',array('STATUS_HAPUS' => 0));
		$this->load->view($this->template,$data);
	}

    function tambahUkm(){
    	$this->load->library('rajaongkir');
    	$data_provinsi = $this->rajaongkir->province();
    	$data['provinsi'] = json_decode($data_provinsi);
    	$data['penanggung_jwb'] = $this->adminukm->tampilData('mp_penanggung_jwb','ID_PENANGGUNG_JWB, NAMA');
		$data['judul_page'] = 'Tambah UKM';
		$data['des_page'] = 'Tambah ukm baru';
		$data['page'] = 'tambah_ukm';
		$this->load->view($this->template,$data);
	}

	function lihatKota(){
		$this->load->library('rajaongkir');
		$id_provinsi = $this->input->post('id_provinsi');
		$data_kota = $this->rajaongkir->city($id_provinsi);
		$data['kota'] = json_decode($data_kota);
		$this->load->view('lihat_kota',$data);
	}

	function hapusUkm($id){
		/*$where = array(
			'ID_TOKO' => $id
		);
		$where_ukm = array(
			'ID_UKM' => $id
		);
		$username = $this->adminukm->tampilData('mp_toko','*', $where, TRUE);
		$where_username = array(
			'USERNAME' => $username->USERNAME
		);
		if(($username->FT_PROFIL!=NULL) OR ($username->FT_SAMPUL!=NULL) OR ($username->FT_PROFIL!="") OR ($username->FT_SAMPUL!=""))
		{
			if (file_exists("./upload/profil/".$username->FT_PROFIL)) {
				if (file_exists("./upload/sampul/".$username->FT_SAMPUL)) {
					unlink("./upload/profil/".$username->FT_PROFIL);
					unlink("./upload/sampul/".$username->FT_SAMPUL);
				}
				else
				{
					unlink("./upload/profil/".$username->FT_PROFIL);
				}
			}
			else
			{
				unlink("./upload/sampul/".$username->FT_SAMPUL);
			}
		}
		$wherechat = array(
			'ID_TOKO' => $id
			);
		$this->penanggung_jwb->hapusData('mp_pesan',$wherechat);
		$this->penanggung_jwb->hapusData('mp_pesan_notif',$wherechat);
		$this->penanggung_jwb->hapusData('mp_toko',$where);
		$this->penanggung_jwb->hapusData('mp_user',$where_username);
		$this->penanggung_jwb->hapusData('mp_kurir',$where);
		$this->penanggung_jwb->hapusData('mp_ekspedisi_ukm',$where_ukm);*/
		$data = array(
			"STATUS_HAPUS" => 1
		);
		$this->produkmodel->editData($data,'mp_toko', array('ID_TOKO' => $id));
		$this->produkmodel->editData($data,'mp_produk', array('ID_TOKO' => $id));
		$this->session->set_flashdata('notif', 'UKM berhasil dihapus');
		$this->session->set_flashdata('clr', 'success');
		redirect('admin_produk');
	}

	function tambahUkmSubmit(){
		$this->form_validation->set_rules('nm_toko', 'Nama Toko', 'required');
		$this->form_validation->set_rules('des_toko', 'Deskripsi Toko', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('id_penanggung_jwb', 'Penanggung Jawab', 'required|numeric');
		$this->form_validation->set_rules('email', 'Email', 'valid_email');
		$this->form_validation->set_rules('id_provinsi', 'Provinsi', 'required');
		$this->form_validation->set_rules('id_kota', 'Kota', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('kelurahan', 'kelurahan', 'required');
		if($this->form_validation->run() == FALSE){
			// Set flashdata	
			$this->session->set_flashdata('nm_toko', set_value('nm_toko'));
			$this->session->set_flashdata('des_toko', set_value('des_toko'));
			$this->session->set_flashdata('alamat', set_value('alamat'));
			$this->session->set_flashdata('email', set_value('email'));
			$this->session->set_flashdata('username', set_value('username'));
			$this->session->set_flashdata('password', set_value('password'));
			
			$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
			redirect('admin_ukm/tambahUkm');
		}
		else{
			$this->session->set_flashdata('nm_toko', set_value('nm_toko'));
			$this->session->set_flashdata('des_toko', set_value('des_toko'));
			$this->session->set_flashdata('alamat', set_value('alamat'));
			$this->session->set_flashdata('email', set_value('email'));
			$this->session->set_flashdata('username', set_value('username'));
		}
		$nm_toko = $this->input->post('nm_toko');
		$id_penanggung_jwb = $this->input->post('id_penanggung_jwb');
		$des_toko = $this->input->post('des_toko');
		$alamat = $this->input->post('alamat');
		$no_hp = $this->input->post('no_hp');
		$no_telp = $this->input->post('no_telp');
		$email = $this->input->post('email');
		$id_provinsi = $this->input->post('id_provinsi');
		$id_kota = $this->input->post('id_kota');
		$kecamatan = $this->input->post('kecamatan');
		$kelurahan = $this->input->post('kelurahan');
		$key_meta = $this->input->post('key_meta');
		$des_meta = $this->input->post('des_meta');
		$username = $this->input->post('username');
		$get_username = getUsername($username,'ukm');
		$password = $this->input->post('password');
		$pass_acak = acakPass($password);
		$s_bbm = $this->input->post('s_bbm');
		$s_whatsapp = $this->input->post('s_whatsapp');
		$level_user = 2;
		// Jangan hilangkan value pada form
		$this->session->set_flashdata('nm_toko', set_value('nm_toko'));
		$this->session->set_flashdata('des_toko', set_value('des_toko'));
		$this->session->set_flashdata('alamat', set_value('alamat'));
		$this->session->set_flashdata('email', set_value('email'));
		$this->session->set_flashdata('username', set_value('username'));
		$this->session->set_flashdata('password', set_value('password'));
			
		// Set kurir
		if($this->input->post('jne')){
			$jne = 1;
		}
		else{
			$jne = 0;
		}

		if($this->input->post('tiki')){
			$tiki = 1;
		}
		else{
			$tiki = 0;
		}
		if($this->input->post('pos')){

			$pos = 1;

		}

		else{

			$pos = 0;

		}
		//echo $_FILES['userImage']['name'];exit();
		$ter = $this->adminukm->tampilData('mp_toko','MAX(ID_TOKO) AS TERAKHIR',$where = array(),TRUE);
		$namafilee = $ter->TERAKHIR+1;
		//echo $namafilee;exit();
		if($_FILES['userImage']['name']) {
			if($_FILES['profil']['name'])
			{
					$fnamePRO = $_FILES['profil']['name'];
					$sourcePathPRO = $_FILES['profil']['tmp_name'];
					$targetPathPRO = "./upload/profil/".$namafilee.".jpg";
					if(move_uploaded_file($sourcePathPRO,$targetPathPRO)) {
						$resizePRO = './upload/profil/';
						$namePRO = $namafilee.".jpg";
						$imgPRO = imagecreatefromjpeg( $targetPathPRO );
		                $widthPRO = imagesx( $imgPRO );
		                $heightPRO = imagesy( $imgPRO );
						$new_widthPRO = 100;
		                $new_heightPRO = 300;
		                $tmp_imgPRO = imagecreatetruecolor( $new_widthPRO, $new_heightPRO );
		                imagecopyresized( $tmp_imgPRO, $imgPRO, 0, 0, 0, 0, $new_widthPRO, $new_heightPRO,$widthPRO, $heightPRO );
		                imagejpeg( $tmp_imgPRO, "{$resize}{$name}" );

		                $fname = $_FILES['userImage']['name'];
						$sourcePath = $_FILES['userImage']['tmp_name'];
						$targetPath = "./upload/sampul/".$namafilee.".jpg";
						if(move_uploaded_file($sourcePath,$targetPath)) {
							$resize = './upload/sampul/';
							$name = $namafilee.".jpg";
							$img = imagecreatefromjpeg( $targetPath );
			                $width = imagesx( $img );
			                $height = imagesy( $img );
							$new_width = 500;
			                $new_height = 300;
			                $tmp_img = imagecreatetruecolor( $new_width, $new_height );
			                imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height,$width, $height );
			                imagejpeg( $tmp_img, "{$resize}{$name}" );
							$data_insert = array(
							'ID_PROVINSI' => $id_provinsi,
							'ID_KOTA' => $id_kota,
							'NM_TOKO' => $nm_toko,
							'DES_TOKO' => $des_toko,
							'NO_HP' => $no_hp,
							'NO_TELP' => $no_telp,
							'EMAIL' => $email,
							'ID_PENANGGUNG_JWB' => $id_penanggung_jwb,
							'ALAMAT' => $alamat,
							'S_BBM' => $s_bbm,
							'S_WHATSAPP' => $s_whatsapp,
							'DES_META' => $des_meta,
							'KEY_META' => $key_meta,
							'KELURAHAN' => $kelurahan,
							'KECAMATAN' => $kecamatan,
							'USERNAME' => $get_username,
							'FT_PROFIL' => $namafilee.".jpg",
							'FT_SAMPUL' => $namafilee.".jpg",
							'STATUS_DELETE' => 0
							);

							}
					}
			}
			else
			{
				$fname = $_FILES['userImage']['name'];
				$sourcePath = $_FILES['userImage']['tmp_name'];
				$targetPath = "./upload/sampul/".$$namafilee.".jpg";
				if(move_uploaded_file($sourcePath,$targetPath)) {
					$resize = './upload/sampul/';
					$name = $namafilee.".jpg";
					$img = imagecreatefromjpeg( $targetPath );
	                $width = imagesx( $img );
	                $height = imagesy( $img );
					$new_width = 500;
	                $new_height = 300;
	                $tmp_img = imagecreatetruecolor( $new_width, $new_height );
	                imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height,$width, $height );
	                imagejpeg( $tmp_img, "{$resize}{$name}" );
					$data_insert = array(
						'ID_PROVINSI' => $id_provinsi,
						'ID_KOTA' => $id_kota,
						'NM_TOKO' => $nm_toko,
						'DES_TOKO' => $des_toko,
						'NO_HP' => $no_hp,
						'NO_TELP' => $no_telp,
						'EMAIL' => $email,
						'ID_PENANGGUNG_JWB' => $id_penanggung_jwb,
						'ALAMAT' => $alamat,
						'S_BBM' => $s_bbm,
						'S_WHATSAPP' => $s_whatsapp,
						'DES_META' => $des_meta,
						'KEY_META' => $key_meta,
						'KELURAHAN' => $kelurahan,
						'KECAMATAN' => $kecamatan,
						'USERNAME' => $get_username,
						'FT_SAMPUL' => $namafilee.".jpg"
					);

					}

			}	
		}
		elseif($_FILES['profil']['name'])
		{
					$fname = $_FILES['profil']['name'];
					$sourcePath = $_FILES['profil']['tmp_name'];
					$targetPath = "./upload/profil/".$namafilee.".jpg";
					if(move_uploaded_file($sourcePath,$targetPath)) {
						$resize = './upload/profil/';
						$name = $namafilee.".jpg";
						$img = imagecreatefromjpeg( $targetPath );
		                $width = imagesx( $img );
		                $height = imagesy( $img );
						$new_width = 500;
		                $new_height = 300;
		                $tmp_img = imagecreatetruecolor( $new_width, $new_height );
		                imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height,$width, $height );
		                imagejpeg( $tmp_img, "{$resize}{$name}" );
						$data_insert = array(
							'ID_PROVINSI' => $id_provinsi,
							'ID_KOTA' => $id_kota,
							'NM_TOKO' => $nm_toko,
							'DES_TOKO' => $des_toko,
							'NO_HP' => $no_hp,
							'NO_TELP' => $no_telp,
							'EMAIL' => $email,
							'ID_PENANGGUNG_JWB' => $id_penanggung_jwb,
							'ALAMAT' => $alamat,
							'S_BBM' => $s_bbm,
							'S_WHATSAPP' => $s_whatsapp,
							'DES_META' => $des_meta,
							'KEY_META' => $key_meta,
							'KELURAHAN' => $kelurahan,
							'KECAMATAN' => $kecamatan,
							'USERNAME' => $get_username,
							'FT_PROFIL' => $namafilee.".jpg",
							'STATUS_DELETE' => 0
						);

					}
		}
		else
		{
			$data_insert = array(
			'ID_PROVINSI' => $id_provinsi,
			'ID_KOTA' => $id_kota,
			'NM_TOKO' => $nm_toko,
			'DES_TOKO' => $des_toko,
			'NO_HP' => $no_hp,
			'NO_TELP' => $no_telp,
			'EMAIL' => $email,
			'ID_PENANGGUNG_JWB' => $id_penanggung_jwb,
			'ALAMAT' => $alamat,
			'S_BBM' => $s_bbm,
			'S_WHATSAPP' => $s_whatsapp,
			'DES_META' => $des_meta,
			'KEY_META' => $key_meta,
			'KELURAHAN' => $kelurahan,
			'KECAMATAN' => $kecamatan,
			'USERNAME' => $get_username,
			'STATUS_DELETE' => 0
			);
		}
		$data_user = array(
			'USERNAME' => $get_username,
			'PASSWORD' => $pass_acak,
			'ID_LEVEL' => $level_user
		);
		$where = array(
			'USERNAME' => $get_username
		);

		// Masukkan data

		$this->adminukm->tambahData($data_insert,'mp_toko');
		$idtokochat = $this->db->insert_id();
		$datapesannotif = array(
			"ID_TOKO" => $idtokochat,
			"NOTIF_BINTANG_UKM" => 1,
			"NOTIF_BINTANG_ADMIN" => 0,
			"NOTIF_SUARA_UKM" => 1,
			);
		$this->adminukm->tambahData($datapesannotif,'mp_pesan_notif');
		$datapesan = array(
			"ISI_PESAN" => "Selamat Bergabung Dengan Indobaba",
			"ID_TOKO" => $idtokochat,
			"TGL_PESAN" => date("Y-m-d H:i:s"),
			"LEVEL" => 1,
			);
		$this->adminukm->tambahData($datapesan ,'mp_pesan');
		$this->adminukm->tambahData($data_user,'mp_user');
		$id_auth = $this->adminukm->tampilData('mp_toko','ID_TOKO,USERNAME',$where,TRUE);
		// Edit dan tambahkan ID AUTH
		$where_auth = array(
			'ID_AUTH' => $id_auth->ID_TOKO
		);
		$this->adminukm->editData('mp_user',$where_auth,$where);
		$data_kurir = array(
			'JNE' => $jne,
			'TIKI' => $tiki,
			'POS' => $pos,
			'ID_TOKO' => $id_auth->ID_TOKO
		);
		$this->adminukm->tambahData($data_kurir,'mp_kurir');
		$this->session->set_flashdata('notif', 'Tambah UKM sukses');
		$this->session->set_flashdata('clr', 'success');
		redirect('admin_ukm/tambahUkm');
	}
	
	function lihatProduk($id_toko){
		$where = array(
			'ID_TOKO' => $id_toko
		);
		$ukm_info = $this->adminukm->tampilData('mp_toko', "*", $where, TRUE);
		$data['id'] = $id_toko;
		$data['judul_page'] = $ukm_info->NM_TOKO;
		$data['des_page'] = '';
		$data['page_ukm'] = 'lihat-produk';
		$data['page'] = $this->template_ukm;
		$data['tampil'] = $this->adminukm->tampilData('mp_produk','*',$where);
		$this->load->view($this->template, $data);
	}
	
	function cekUsername(){

		$username = $this->input->post('username');

		$where = array(

			'USERNAME' => getUsername($username,'ukm')

		);

		$cek = $this->adminukm->tampilData('mp_user','USERNAME',$where,TRUE);

		if($cek){

			echo 'Username tidak tersedia';

		}

		else{

			echo 'Username tersedia dan dapat digunakan';

		}

	}
	// Edit Ukm //
	function editUkm($id){
		$id = base64_decode_fix($id);
		$data['id']=$id;
    	$this->load->library('rajaongkir');
    	$data_provinsi = $this->rajaongkir->province();
    	$data['provinsi'] = json_decode($data_provinsi);
    	$data['penanggung_jwb'] = $this->adminukm->tampilData('mp_penanggung_jwb','ID_PENANGGUNG_JWB, NAMA');
    	$where = array(
			'ID_TOKO' => $id
		);
    	$data['ukm'] = $this->adminukm->tampilData('mp_toko', "*", $where, TRUE);
    	$ukm_info = $this->adminukm->tampilData('mp_toko', "*", $where, TRUE);
    	$where2 = array(

			'ID_TOKO' => $id

		);
    	$data['kurir'] = $this->adminukm->tampilData('mp_kurir', "*", $where2, TRUE);
		$data['judul_page'] = $ukm_info->NM_TOKO;
		$data['des_page'] = '';
		$data['page_ukm'] = 'informasi-umum';
		$data['page'] = $this->template_ukm;
		$this->load->view($this->template,$data);

	}
	
	function rekeningUkm($id){
		$id = base64_decode_fix($id);
		$data['id']=$id;
		$data['judul_page'] = 'Tambah UKM';
		$data['des_page'] = 'Tambah ukm baru';
		$data['page_ukm'] = 'rekening-ukm';
		$data['rekening'] = $this->adminukm->tampilData('view_rekening', NULL, array("ID_PEMILIK" => $id, "LEVEL" => 2), TRUE);
		$data['bank'] = $this->adminukm->tampilData('mp_bank');
		$data['page'] = $this->template_ukm;
		$this->load->view($this->template,$data);
	}
	
	function ekspedisiUkm($id){
		$data['id_encode'] = $id;
		$id = base64_decode_fix($id);
		$data['id']=$id;
		$data['judul_page'] = 'Ekspedisi';
		$data['des_page'] = 'Ekspedisi di Ukm';
		$data['page_ukm'] = 'ekspedisi-ukm';
		$data['tampil'] = $this->adminukm->tampilData("mp_ekspedisi_ukm","",array("ID_UKM" => $id)); 
		$data['page'] = $this->template_ukm;
		$this->load->view($this->template,$data);
	}
	function ekspedisiUkmtambah($idd){
		
		$data['id_encode'] = $idd;
		$id = base64_decode_fix($idd);
		$data['id']=$id;
		if($this->input->post("simpan")){
			$this->form_validation->set_rules("ekspedisi","Ekspedisi",required);
			if($this->form_validation->run() == TRUE){
				$data = array(
					"ID_UKM" => $id,
					"ID_EKSPEDISI" => $this->input->post("ekspedisi")
				);
				$this->adminukm->tambahData($data ,"mp_ekspedisi_ukm");
				 $this->session->set_flashdata('notif', "Ekspedisi Berhasil di tambah di ukm anda !");
                $this->session->set_flashdata('clr', 'success');
                redirect("admin_ukm/ekspedisiUkmtambah/$idd");
			}
			else{
				$this->session->set_flashdata('notif',  validation_errors());
                $this->session->set_flashdata('clr', 'success');
                redirect("admin_ukm/ekspedisiUkmtambah/$idd");
			}
		}
		
		$data['tampilEkspedisi']  = $this->db->query("SELECT * FROM mp_ekspedisi WHERE ID_EKSPEDISI NOT IN (SELECT ID_EKSPEDISI FROM mp_ekspedisi_ukm WHERE ID_UKM = $id)")->result();
		$data['judul_page'] = 'Tambah Ekspedisi';
		$data['des_page'] = 'Tambah ekspedisi baru';
		$data['page_ukm'] = 'ekspedisitambah-ukm';
		$data['page'] = $this->template_ukm;
		$this->load->view($this->template,$data);
	}
	public function hapusekspedisi($id_ukm ,$id){
		$this->db->query("DELETE FROM mp_ekspedisi_ukm WHERE ID_EKS_UKM = $id");
		$this->session->set_flashdata('notif',  "Data berhasil di hapus");
        $this->session->set_flashdata('clr', 'success');
        redirect("admin_ukm/ekspedisiUkm/$id_ukm");
	}
	
	function updateUkm($id){
		$id=base64_decode_fix($id);

		$nm_toko=$this->input->post('nm_toko');
		$email=$this->input->post('email');
		$id_penanggung_jwb=$this->input->post('id_penanggung_jwb');
		$des_toko=$this->input->post('des_toko');
		$key_meta=$this->input->post('key_meta');
		$des_meta=$this->input->post('des_meta');
		$jne=$this->input->post('jne');
		$tiki=$this->input->post('tiki');
		$pos=$this->input->post('pos');
		$id_provinsi=$this->input->post('id_provinsi');
		$id_kota=$this->input->post('id_kota');
		$kecamatan=$this->input->post('kecamatan');
		$kelurahan=$this->input->post('kelurahan');
		$alamat=$this->input->post('alamat');
		$no_hp=$this->input->post('no_hp');
		$no_telp=$this->input->post('no_telp');
		$s_bbm=$this->input->post('s_bbm');
		$s_whatsapp=$this->input->post('s_whatsapp');

		$where_auth = array(
			'ID_TOKO' => $id
		);

		$ter = $this->adminukm->tampilData('mp_toko','*',$where_auth,TRUE);
		$profil = $ter->ID_TOKO.".jpg";
		$sampul = $ter->ID_TOKO.".jpg";
		if($_FILES['userImage']['name']) {
			if($_FILES['profil']['name'])
			{
					$fnamePRO = $_FILES['profil']['name'];
					$sourcePathPRO = $_FILES['profil']['tmp_name'];
					$targetPathPRO = "./upload/profil/".$profil;
					if(move_uploaded_file($sourcePathPRO,$targetPathPRO)) {
						$resizePRO = './upload/profil/';
						$namePRO = $profil;
						$imgPRO = imagecreatefromjpeg( $targetPathPRO );
		                $widthPRO = imagesx( $imgPRO );
		                $heightPRO = imagesy( $imgPRO );
						$new_widthPRO = 100;
		                $new_heightPRO = 300;
		                $tmp_imgPRO = imagecreatetruecolor( $new_widthPRO, $new_heightPRO );
		                imagecopyresized( $tmp_imgPRO, $imgPRO, 0, 0, 0, 0, $new_widthPRO, $new_heightPRO,$widthPRO, $heightPRO );
		                imagejpeg( $tmp_imgPRO, "{$resize}{$name}" );

		                $fname = $_FILES['userImage']['name'];
						$sourcePath = $_FILES['userImage']['tmp_name'];
						$targetPath = "./upload/sampul/".$sampul;
						if(move_uploaded_file($sourcePath,$targetPath)) {
							$resize = './upload/sampul/';
							$name = $sampul;
							$img = imagecreatefromjpeg( $targetPath );
			                $width = imagesx( $img );
			                $height = imagesy( $img );
							$new_width = 500;
			                $new_height = 300;
			                $tmp_img = imagecreatetruecolor( $new_width, $new_height );
			                imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height,$width, $height );
			                imagejpeg( $tmp_img, "{$resize}{$name}" );

							$data = array(
							'NM_TOKO' => $nm_toko,
							'ID_PENANGGUNG_JWB' => $id_penanggung_jwb,
							'DES_TOKO' => $des_toko,
							'KEY_META' => $key_meta,
							'DES_META' => $des_meta,
							'ID_PROVINSI' => $id_provinsi,
							'ID_KOTA' => $id_kota,
							'KECAMATAN' => $kecamatan,
							'KELURAHAN' => $kelurahan,
							'ALAMAT' => $alamat,
							'NO_HP' => $no_hp,
							'NO_TELP' => $no_telp,
							'S_BBM' => $s_bbm,
							'S_WHATSAPP' => $s_whatsapp,
							'EMAIL' => $email,
							'FT_PROFIL' => $profil,
							'FT_SAMPUL' => $sampul
							);

							}
					}
			}
			else
			{
				$fname = $_FILES['userImage']['name'];
				$sourcePath = $_FILES['userImage']['tmp_name'];
				$targetPath = "./upload/sampul/".$sampul;
				if(move_uploaded_file($sourcePath,$targetPath)) {
					$resize = './upload/sampul/';
					$name = $sampul;
					$img = imagecreatefromjpeg( $targetPath );
	                $width = imagesx( $img );
	                $height = imagesy( $img );
					$new_width = 500;
	                $new_height = 300;
	                $tmp_img = imagecreatetruecolor( $new_width, $new_height );
	                imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height,$width, $height );
	                imagejpeg( $tmp_img, "{$resize}{$name}" );
					
					$data = array(
						'NM_TOKO' => $nm_toko,
						'ID_PENANGGUNG_JWB' => $id_penanggung_jwb,
						'DES_TOKO' => $des_toko,
						'KEY_META' => $key_meta,
						'DES_META' => $des_meta,
						'ID_PROVINSI' => $id_provinsi,
						'ID_KOTA' => $id_kota,
						'KECAMATAN' => $kecamatan,
						'KELURAHAN' => $kelurahan,
						'ALAMAT' => $alamat,
						'NO_HP' => $no_hp,
						'NO_TELP' => $no_telp,
						'S_BBM' => $s_bbm,
						'S_WHATSAPP' => $s_whatsapp,
						'EMAIL' => $email,
						'FT_SAMPUL' => $sampul
						);
					}

			}
		}
		elseif($_FILES['profil']['name'])
		{
					$fname = $_FILES['profil']['name'];
					$sourcePath = $_FILES['profil']['tmp_name'];
					$targetPath = "./upload/profil/".$profil;
					if(move_uploaded_file($sourcePath,$targetPath)) {
						$resize = './upload/profil/';
						$name = $profil;
						$img = imagecreatefromjpeg( $targetPath );
		                $width = imagesx( $img );
		                $height = imagesy( $img );
						$new_width = 500;
		                $new_height = 300;
		                $tmp_img = imagecreatetruecolor( $new_width, $new_height );
		                imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height,$width, $height );
		                imagejpeg( $tmp_img, "{$resize}{$name}" );
						
						$data = array(
						'NM_TOKO' => $nm_toko,
						'ID_PENANGGUNG_JWB' => $id_penanggung_jwb,
						'DES_TOKO' => $des_toko,
						'KEY_META' => $key_meta,
						'DES_META' => $des_meta,
						'ID_PROVINSI' => $id_provinsi,
						'ID_KOTA' => $id_kota,
						'KECAMATAN' => $kecamatan,
						'KELURAHAN' => $kelurahan,
						'ALAMAT' => $alamat,
						'NO_HP' => $no_hp,
						'NO_TELP' => $no_telp,
						'S_BBM' => $s_bbm,
						'S_WHATSAPP' => $s_whatsapp,
						'EMAIL' => $email,
						'FT_PROFIL' => $profil
						);
					}
		}
		else
		{
			$data = array(
			'NM_TOKO' => $nm_toko,
			'ID_PENANGGUNG_JWB' => $id_penanggung_jwb,
			'DES_TOKO' => $des_toko,
			'KEY_META' => $key_meta,
			'DES_META' => $des_meta,
			'ID_PROVINSI' => $id_provinsi,
			'ID_KOTA' => $id_kota,
			'KECAMATAN' => $kecamatan,
			'KELURAHAN' => $kelurahan,
			'ALAMAT' => $alamat,
			'NO_HP' => $no_hp,
			'NO_TELP' => $no_telp,
			'S_BBM' => $s_bbm,
			'S_WHATSAPP' => $s_whatsapp,
			'EMAIL' => $email
		);
		}

		

		$this->adminukm->editData('mp_toko',$data,$where_auth);

		if($this->input->post('jne')){
			$jne = 1;
		}
		else{
			$jne = 0;
		}

		if($this->input->post('tiki')){
			$tiki = 1;
		}
		else{
			$tiki = 0;
		}

		if($this->input->post('pos')){
			$pos = 1;
		}
		else{
			$pos = 0;
		}

		$where_auth2 = array(
			'ID_TOKO' => $id
		);

		$data2 = array(
			'JNE' => $jne,
			'POS' => $pos,
			'TIKI' => $tiki
		);

		$this->adminukm->editData('mp_kurir',$data2,$where_auth2);
		$this->session->set_flashdata('notif', 'Perbaharui informasi berhasil');
		$this->session->set_flashdata('clr', 'success');
		redirect('admin_ukm/editUkm/'.base64_encode_fix($id));
	}

}

