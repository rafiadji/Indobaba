<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_produk extends MY_Admin {

	var $template = 'admin_page';

	function __construct()
	{
		parent::__construct();
		$this->load->model("M_admin_produk","produkmodel");
		$this->session->set_userdata(array('menu_admin' => 'master_ukm'));
	}

	public function index()
	{
		$data['judul_page'] = 'Produk';
		$data['des_page'] = 'Semua Produk';
		$data['page'] = 'produk';
		$data['tampil'] = $this->produkmodel->tampilData('mp_produk','*',array('STATUS_HAPUS' => 0));
		$this->load->view($this->template, $data);
	}

	public function dapatSubkategori()
	{
		$key = $this->input->post('key');
		$subkategori = $this->produkmodel->tampilData('mp_sub_kategori', NULL,array('ID_KATEGORI' => $key) );
		foreach ($subkategori as $row) {
			echo '<option value="'.$row->ID_SUB_KATEGORI.'">'.$row->SUB_KATEGORI.'</option>';
		}
	}
	
	public function dapatSubkategoriedit()
	{
		$idsubkategori = $this->input->get_post('idsubkategori');
		$idkategori = $this->input->get_post('idkategori');
		$subkategori = $this->produkmodel->tampilData('mp_sub_kategori', NULL,array('ID_KATEGORI' => $idkategori));
		foreach ($subkategori as $row) {
			$selected = ($row->ID_SUB_KATEGORI == $idsubkategori) ? 'selected' : '';
			echo '<option value="'.$row->ID_SUB_KATEGORI.'"'.$selected.'>'.$row->SUB_KATEGORI.'</option>';
		}
	}

	public function tambahProduk()
	{
		$data['judul_page'] = 'Tambah Produk';
		$data['des_page'] = 'Tambah Produk';
		$data['page'] = 'tambahproduk';
		$data['toko'] = $this->produkmodel->tampilData('mp_toko');
		$data['tanggung'] = $this->produkmodel->tampilData('mp_penanggung_jwb');
		$data['kategori'] = $this->produkmodel->tampilData('mp_kategori');
		$this->load->view($this->template, $data);
	}

	function detailProduk($id){
		$info_produk = $this->produkmodel->tampilData("mp_produk","*",array("ID_PRODUK" => $id),TRUE);
		$data['judul_page'] = $info_produk->NM_PRODUK;
		$data['des_page'] = "";
		$data['page'] = 'detail-produk';
		$data["row"] = $this->produkmodel->tampilData("mp_produk","*",array("ID_PRODUK" => $id),TRUE);
		$data["row"] = $this->produkmodel->tampilData("mp_produk","*",array("ID_PRODUK" => $id),TRUE);
		$this->load->view($this->template,$data);
	}
	
	public function tambahProduksubmit()
	{		
		$this->form_validation->set_rules('ID_TOKO', 'ID_TOKO', 'required');
		$this->form_validation->set_rules('NM_PRODUK', 'NM_PRODUK', 'required');
		$this->form_validation->set_rules('ID_KATEGORI', 'ID_KATEGORI', 'required');
		$this->form_validation->set_rules('ID_SUB_KATEGORI', 'ID_SUB_KATEGORI', 'required');
		$this->form_validation->set_rules('HARGA', 'HARGA', 'required');
		$this->form_validation->set_rules('BERAT_PRODUK', 'BERAT_PRODUK', 'required');
		$this->form_validation->set_rules('MIN_PESAN', 'MIN_PESAN', 'required');
		$this->form_validation->set_rules('DES_PRODUK', 'DES_PRODUK', 'required');
		// $this->form_validation->set_rules('grosir[]', 'grosir', 'required');

		if ($this->input->post('HARGA') == 0) {
			$grosir = $this->input->post('grosir');
			$banyak = count($this->input->post('grosir'));
			$all ="";
			for ($i=0; $i < $banyak; $i++) { 
				$all .= $grosir[$i]."-";
				$i = $i+1;
				$all .= $grosir[$i]."-";
				$i = $i+1;
				$all .= $grosir[$i]."|";
			}
			$harga = $all;
			$sts = '1';
			$data =  explode('|',$harga);
            $data2 = explode('-',$data[0]);
            $hasil_akhir = $data2[2];
		}
		else{
			$harga = $this->input->post('HARGA');
			$sts = '0';
			$hasil_akhir = $harga;
		}

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
			redirect('admin_produk/tambahProduk');
		}
		$data = array(
			'ID_TOKO' => $this->input->post('ID_TOKO'),
			'NM_PRODUK' => $this->input->post('NM_PRODUK'),
			'ID_KATEGORI' => $this->input->post('ID_KATEGORI'),
			'ID_SUB_KATEGORI' => $this->input->post('ID_SUB_KATEGORI'),
			'HARGA' => $harga,
			'BERAT_PRODUK' => $this->input->post('BERAT_PRODUK'),
			'MIN_PESAN' => $this->input->post('MIN_PESAN'),
			'DES_PRODUK' => $this->input->post('DES_PRODUK'),
			'TGL_POS' => ubahFormatTgl(tglSekarang(), 'Y-m-d'),
			'WKT_POS' => wktSekarang(),
			'IN_CART' => 0,
			'DES_META' => $this->input->post('DES_META'),
			'KEY_META' => $this->input->post('KEY_META'),
			'STS_GROSIR' => $sts,
			'STS_PUBLISH' => 1,
			'HARGA_AS' => 1,
			'STATUS_DELETE' => 0
		);
		$insert = $this->produkmodel->tambahData($data, 'mp_produk');
		if($insert) {
			$this->session->set_flashdata('notif', 'Produk berhasil ditamnah');
			$this->session->set_flashdata('clr', 'success');
			redirect('admin_produk/fotoProduk/'.$this->db->insert_id());
		}
		else{
			$this->session->set_flashdata('notif', 'maaf data tidak bisa masuk ulangi lagi');
			$this->session->set_flashdata('clr', 'warning');
			redirect('admin_produk/tambahProduk');
		}
	}

	public function ubahProduk($id = NULL)
	{
		$data['judul_page'] = 'Ubah Produk';
		$data['des_page'] = 'Ubah Produk';
		$data['page'] = 'editproduk';
		$data['kategori'] = $this->produkmodel->tampilData('mp_kategori');
		$data['toko'] = $this->produkmodel->tampilData('mp_toko');
		$data['edit'] = $this->produkmodel->tampilData('mp_produk', NULL, array('ID_PRODUK' => $id), TRUE);
		$this->load->view($this->template, $data);
	}

	public function ubahProduksubmit()
	{
		$this->form_validation->set_rules('ID_TOKO', 'ID_TOKO', 'required');
		$this->form_validation->set_rules('NM_PRODUK', 'NM_PRODUK', 'required');
		$this->form_validation->set_rules('ID_KATEGORI', 'ID_KATEGORI', 'required');
		$this->form_validation->set_rules('ID_SUB_KATEGORI', 'ID_SUB_KATEGORI', 'required');
		$this->form_validation->set_rules('HARGA', 'HARGA', 'required');
		$this->form_validation->set_rules('BERAT_PRODUK', 'BERAT_PRODUK', 'required');
		$this->form_validation->set_rules('MIN_PESAN', 'MIN_PESAN', 'required');
		$this->form_validation->set_rules('DES_PRODUK', 'DES_PRODUK', 'required');
		// $this->form_validation->set_rules('grosir[]', 'grosir', 'required');

		if ($this->input->post('HARGA') == 0) {
			$grosir = $this->input->post('grosir');
			$banyak = count($this->input->post('grosir'));
			$all ="";
			for ($i=0; $i < $banyak; $i++) { 
				$all .= $grosir[$i]."-";
				$i = $i+1;
				$all .= $grosir[$i]."-";
				$i = $i+1;
				$all .= $grosir[$i]."|";	
			}
			$harga = $all;
			$sts = '1';
		}
		else{
			$harga = $this->input->post('HARGA');
			$sts = '0';
		}

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('a', $harga);
			$this->session->set_flashdata('clr', 'danger');
			redirect('admin_produk/ubahProduk/'.$this->input->post('ID_PRODUK'));
		}

		$data = array(
			'NM_PRODUK' => $this->input->post('NM_PRODUK'),
			'ID_KATEGORI' => $this->input->post('ID_KATEGORI'),
			'ID_SUB_KATEGORI' => $this->input->post('ID_SUB_KATEGORI'),
			'HARGA' => $harga,
			'BERAT_PRODUK' => $this->input->post('BERAT_PRODUK'),
			'MIN_PESAN' => $this->input->post('MIN_PESAN'),
			'DES_PRODUK' => $this->input->post('DES_PRODUK'),
			'TGL_POS' => ubahFormatTgl(tglSekarang(), 'Y-m-d'),
			'WKT_POS' => wktSekarang(),
			'DES_META' => $this->input->post('DES_META'),
			'KEY_META' => $this->input->post('KEY_META'),
			'STS_GROSIR' => $sts
		);
		$where = array('ID_PRODUK' => $this->input->post('ID_PRODUK'));
		$update = $this->produkmodel->editData($data, 'mp_produk', $where);
		if($update) {
			$this->session->set_flashdata('notif', 'Produk berhasil diubah');
			$this->session->set_flashdata('clr', 'success');
			redirect('admin_produk/ubahProduk/'.$this->input->post('ID_PRODUK'));
		}
		else{
			$this->session->set_flashdata('notif', 'maaf data tidak bisa diubah ulangi lagi');
			$this->session->set_flashdata('clr', 'warning');
			redirect('admin_produk/ubahProduk/'.$this->input->post('ID_PRODUK'));
		}
	}

	public function hapusProduk($id)
	{
		$data = array(
			"STATUS_HAPUS" => 1
		);
		$delete = $this->produkmodel->editData($data,'mp_produk', array('ID_PRODUK' => $id));
		$this->session->set_flashdata('notif', 'Produk berhasil dihapus');
		$this->session->set_flashdata('clr', 'success');
		redirect('admin_produk');
	}

	public function fotoProduk($id = NULL)
	{	
		$edit = $this->produkmodel->tampilData('mp_produk', NULL, array('ID_PRODUK' => $id), TRUE);
		$data['judul_page'] = 'Foto Produk ';
		$data['des_page'] = $edit->NM_PRODUK;
		$data['page'] = 'fotoproduk';
		$data['edit'] = $edit;
		$data['tampil'] = $this->produkmodel->tampilData('mp_galeri_pro', NULL, array('ID_PRODUK' => $id));
		$this->load->view($this->template, $data);
	}

	public function tambahfotoProduk($id = NULL)
	{	
		$edit = $this->produkmodel->tampilData('mp_produk', NULL, array('ID_PRODUK' => $id), TRUE);
		$ft = $this->produkmodel->tampilData('mp_galeri_pro', NULL, array('ID_PRODUK' => $id));
		$data['judul_page'] = 'Tambah Foto Produk ';
		$data['des_page'] = $edit->NM_PRODUK;
		$data['page'] = 'tambahfotoproduk';
		$data['edit'] = $edit;
		$data['jumft'] = count($ft);
		$this->load->view($this->template, $data);
	}

	public function tambahfotoProduksubmit()
	{
		$config['upload_path'] = '././assets-admin/img/produk';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|bmp';
		$config['max_size'] = '3024';
		$config['overwrite'] = FALSE;
		$this->load->library('upload');
			
		$files = $_FILES['userfile'];
		foreach ($files['name'] as $key => $image) 
		{
			if(!empty($files['name'][$key]))
			{
				$_FILES['userfile[]']['name']		= $files['name'][$key];
				$_FILES['userfile[]']['type']		= $files['type'][$key];
				$_FILES['userfile[]']['tmp_name']	= $files['tmp_name'][$key];
				$_FILES['userfile[]']['error']		= $files['error'][$key];
				$_FILES['userfile[]']['size']		= $files['size'][$key];
	
				$fileName = $image;
				// $images[] = $fileName;
				$config['file_name'] 				= $fileName;
				
				$this->upload->initialize($config);
				if ($this->upload->do_upload('userfile[]')) 
				{
					$uploaddata = $this->upload->data();
					$tambahft = array(
							
							'ID_PRODUK' => $this->input->post('ID_PRODUK'),
							'FT_PRODUK' => $uploaddata['file_name'],
						);
					$insert = $this->produkmodel->tambahData($tambahft, 'mp_galeri_pro');
				} 
				else 
				{
					$this->session->set_flashdata('notif', 'maaf foto tidak bisa diupload ulangi lagi');
					$this->session->set_flashdata('clr', 'warning');
					redirect('admin_produk/tambahfotoProduk/'.$this->input->post('ID_PRODUK'));
				}
			}
		}
		$config['image_library'] = 'gd2';
		$config['source_image'] = '././assets-admin/img/produk/'.$uploaddata['file_name'];
		$config['maintain_ratio'] = TRUE;
		$config['width'] = 900;
		$this->load->library('image_lib', $config);
		$this->image_lib->resize();
		$this->session->set_flashdata('notif', 'Foto berhasil di tambah');
		$this->session->set_flashdata('clr', 'success');
		redirect('admin_produk/fotoProduk/'.$this->input->post('ID_PRODUK'));
	}

	public function ubahfotoProduk($idft = NULL)
	{	
		$ft = $this->produkmodel->tampilData('mp_galeri_pro', NULL, array('ID_GALERI_PRO' => $idft), TRUE);
		$edit = $this->produkmodel->tampilData('mp_produk', NULL, array('ID_PRODUK' => $ft->ID_PRODUK), TRUE);
		$data['judul_page'] = 'Ubah Foto Produk ';
		$data['des_page'] = $edit->NM_PRODUK;
		$data['page'] = 'editfotoproduk';
		$data['edit'] = $ft;
		$this->load->view($this->template, $data);
	}

	public function ubahfotoProduksubmit()
	{
		$config['upload_path'] = '././assets-admin/img/produk';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|bmp';
		$config['max_size'] = '1024';
		$config['overwrite'] = FALSE;
		$this->load->library('upload');
			
		$files = $_FILES['userfile'];
		foreach ($files['name'] as $key => $image) 
		{
			if(!empty($files['name'][$key]))
			{
				$ftlama = $this->produkmodel->tampilData('mp_galeri_pro', NULL, array('ID_GALERI_PRO' => $this->input->post('ID_GALERI_PRO')), TRUE);
				unlink('././assets-admin/img/produk/'.$ftlama->FT_PRODUK);

				$_FILES['userfile[]']['name']		= $files['name'][$key];
				$_FILES['userfile[]']['type']		= $files['type'][$key];
				$_FILES['userfile[]']['tmp_name']	= $files['tmp_name'][$key];
				$_FILES['userfile[]']['error']		= $files['error'][$key];
				$_FILES['userfile[]']['size']		= $files['size'][$key];
	
				$fileName = $image;
				$images[] = $fileName;
				$config['file_name'] 				= $fileName;
				
				$this->upload->initialize($config);
				if ($this->upload->do_upload('userfile[]')) 
				{
					$uploaddata = $this->upload->data();
					$ubahft = array(
							'FT_PRODUK' => $uploaddata['file_name']
						);
					$where = array('ID_GALERI_PRO' => $this->input->post('ID_GALERI_PRO'));
					$update = $this->produkmodel->editData($ubahft, 'mp_galeri_pro', $where);
				} 
				else 
				{
					$this->session->set_flashdata('notif', 'maaf foto tidak bisa diupload ulangi lagi');
					$this->session->set_flashdata('clr', 'warning');
					redirect('admin_produk/ubahfotoProduk/'.$this->input->post('ID_GALERI_PRO'));
				}
			}
			$k++;
		}
		$this->session->set_flashdata('notif', 'Foto berhasil di ubah');
		$this->session->set_flashdata('clr', 'success');
		redirect('admin_produk/fotoProduk/'.$this->input->post('ID_PRODUK'));
	}

	public function hapusfotoProduk($idft = NULL)
	{
		$ftpro = $this->produkmodel->tampilData('mp_galeri_pro', NULL, array('ID_GALERI_PRO' => $idft), TRUE);
		$edit = $this->produkmodel->tampilData('mp_produk', NULL, array('ID_PRODUK' => $ftpro->ID_PRODUK), TRUE);
		unlink('././assets-admin/img/produk/'.$ftpro->FT_PRODUK);
		$delft = $this->produkmodel->hapusData('mp_galeri_pro', array('ID_GALERI_PRO' => $idft));
		$this->session->set_flashdata('notif', 'Foto berhasil dihapus');
		$this->session->set_flashdata('clr', 'success');
		redirect('admin_produk/fotoProduk/'.$edit->ID_PRODUK);
	}

	public function ubahSts($id_produk)
	{
		$dpt_sts = $this->produkmodel->tampilData('mp_produk', NULL, array('ID_PRODUK' => $id_produk), TRUE);
		$sts_lama = $dpt_sts->STS_PUBLISH;
		$update = $this->produkmodel->ubahSts($id_produk, $sts_lama);
		if ($sts_lama == 0) {
			$this->session->set_flashdata('notif', 'Produk telah di publikasi');
			$this->session->set_flashdata('clr', 'success');
			redirect('admin_produk');
		}
		elseif ($sts_lama == 1) {
			$this->session->set_flashdata('notif', 'Produk telah di Draft');
			$this->session->set_flashdata('clr', 'success');
			redirect('admin_produk');
		}
		else {
			$this->session->set_flashdata('notif', 'Maaf status produk tidak dapat di ubah');
			$this->session->set_flashdata('clr', 'warning');
			redirect('admin_produk');
		}
	}

}