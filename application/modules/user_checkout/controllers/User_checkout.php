<?php defined('BASEPATH') OR exit('No direct script access allowed');
class User_checkout extends MY_User {
	
	var $template = 'home_page';
	var $template_user = "user_page";

	function __construct()
	{
		parent::__construct();
		$this->load->model("M_user_checkout","producthomemodel");
    }
	
	public function sts_tersedia()
	{
		$akun = $this->input->post('id_akun');
		$sts_sedia = $this->db->query("SELECT * FROM view_temp_checkout WHERE ID_AKUN = '$akun' GROUP BY ID_TOKO")->result();
		$i = 0;
		foreach ($sts_sedia as $row_sedia){
			$json_data['status'][$i]=$row_sedia->STS_SEDIA;
			$i++;
		}
		echo json_encode($json_data);
	}
	
	public function upt_sts()
	{
		$update_sts = array('STS_SEDIA' => $this->input->post('sts_value'));
		$this->producthomemodel->editData($update_sts, 'view_temp_checkout', array('ID_TOKO' => $this->input->post('id_toko'), 'ID_AKUN' => $this->input->post('id_akun')));
	}

    public function cart(){
		$akun = $this->session->userdata("id_akun_user");
		$data['akun'] = $this->session->userdata("id_akun_user");
		$this->load->library('rajaongkir');
		$data_provinsi = $this->rajaongkir->province();
    	$data['provinsi'] = json_decode($data_provinsi);
		$data['page']="cart";
		$data['getalamat'] = $this->db->query("SELECT * FROM mp_temp_alamat WHERE ID_AKUN='$akun'")->result();
		$data['toko'] = $this->db->query("SELECT * FROM view_temp_checkout WHERE ID_AKUN = '$akun' GROUP BY ID_TOKO")->result();
		$this->load->view($this->template, $data);
	}
	
	public function hapusProdukcart($id)
	{
		$akun = $this->session->userdata("id_akun_user");
		$this->load->library('rajaongkir');
		$dpt_data = $this->producthomemodel->tampilData('view_temp_checkout', NULL, array('ID_CART' => $id), TRUE);
		$cek_ongkir = $this->db->query('SELECT * FROM mp_temp_cart WHERE ID_ONGKIR = '.$dpt_data->ID_ONGKIR);
		if ($cek_ongkir->num_rows() == 1){
			$hps_ongkir = $this->producthomemodel->hapusData('mp_temp_ongkir', array('ID_ONGKIR' => $dpt_data->ID_ONGKIR));
			$hps_cart = $this->producthomemodel->hapusData('mp_temp_cart', array('ID_CART' => $id));
		}
		else{
			$hps_cart = $this->producthomemodel->hapusData('mp_temp_cart', array('ID_CART' => $id));
			$ong = $this->db->query('SELECT *,SUM(BERAT_PRODUK*QTY) as JUM_BERAT FROM view_temp_checkout WHERE ID_ONGKIR = '.$dpt_data->ID_ONGKIR)->row();
			$cost = $this->rajaongkir->cost($ong->ID_KOTA,$ong->KOTA_KAB,$ong->JUM_BERAT,$ong->NAMA_KURIR);
			$cost=json_decode($cost);
			$no=0;
			foreach ($cost->rajaongkir->results as $a) {
				foreach ($a->costs as $cc) {
					// print_r($cc);
					if($cc->service == $ong->PAKET_YANG_DIAMBIL)
					{
						foreach ($cc->cost as $o) {
							$value = $o->value;	
						}
						
					}
				}
			}
			$up_ong = $this->db->query("UPDATE mp_temp_ongkir SET TOTAL = '$value' WHERE ID_ONGKIR = '$dpt_data->ID_ONGKIR'");
		}
		if ($hps_cart){
			redirect('cart');
		}
	}
	
	public function checkout(){
		$akun = $this->session->userdata("id_akun_user");
		$data['akun'] = $this->session->userdata("id_akun_user");
		$data['page_user'] = "checkout";
		$data['page'] = $this->template_user;
		$cek_hari = $this->db->query("SELECT * FROM view_checkout WHERE ID_AKUN = '$akun'")->result();
		$hari = date("Y-m-d");
		foreach ($cek_hari as $cek) {
			if ($hari == $cek->JTH_TEMPO && $cek->STS_BAYAR == 0) {
				$up_trans = $this->producthomemodel->editData(array('ID_STATUS' => 9), 'mp_transaksi', array('NO_TRANS' => $cek->NO_TRANS));
			}
		}
		$data['tampil'] = $this->producthomemodel->tampilData('mp_transaksi', NULL, array('ID_AKUN' => $akun));
		$this->load->view($this->template, $data);
	}
	
	public function checkout_tabl()
	{
		$akun = $this->session->userdata("id_akun_user");
		$order = $this->input->post('order_tab');
		if ($order == 1){$sts = 1; $sts1 = 0;}
		elseif ($order == 2) {$sts = 2; $sts1 = 3;}
		elseif ($order == 3) {$sts = 4; $sts1 = 0;}
		elseif ($order == 4) {$sts = 5; $sts1 = 0;}
		elseif ($order == 5) {$sts = 9; $sts1 = 0;}
		$tampil = $this->producthomemodel->outdata('view_checkout', $akun, $sts, 'ID_TRANS', $sts1);
		if (count($tampil) > 0) {
			$json_data = array('status' => 'yes');
			$i = 0;
			foreach ($tampil as $row) {
				$json_data['data'][$i]['NO_TRANS'] = $row->NO_TRANS;
				$json_data['data'][$i]['ID_TRANS'] = $row->ID_TRANS;
				$json_data['data'][$i]['TGL_TRANS'] = $row->TGL_TRANS;
				$json_data['data'][$i]['WKT_TRANS'] = $row->WKT_TRANS;
				if ($row->STS_BAYAR == 0) {
					$stts = "belum bayar";
				}
				else {
					$stts = "sudah bayar";
				}
				$toko = $this->db->query("SELECT * FROM view_checkout WHERE ID_AKUN = '$akun' AND NO_TRANS = '$row->NO_TRANS' GROUP BY ID_TOKO")->result();
				$k = 0;
	            foreach ($toko as $tk) {
	            	$m = 0;
	            	$alamat = $this->db->query("SELECT * FROM view_checkout WHERE ID_AKUN = '$akun' AND ID_TOKO = '$tk->ID_TOKO' AND NO_TRANS = '$row->NO_TRANS' GROUP BY ID_ALAMAT")->result();
					foreach ($alamat as $al){
						$kurir = $this->db->query("SELECT * FROM view_checkout WHERE ID_AKUN = '$akun' AND ID_TOKO = '$tk->ID_TOKO' AND ID_ALAMAT = '$al->ID_ALAMAT' AND NO_TRANS = '$row->NO_TRANS' GROUP BY ID_ONGKIR")->result();
						foreach ($kurir as $kr){
							$f = 0;
							$pro = $this->db->query("SELECT * FROM view_checkout WHERE ID_AKUN = '$akun' AND ID_TOKO = '$tk->ID_TOKO' AND ID_ALAMAT = '$al->ID_ALAMAT' AND ID_ONGKIR = '$kr->ID_ONGKIR' AND NO_TRANS = '$row->NO_TRANS'")->result();
							foreach ($pro as $pr){
								$pro_harga[$f] = ($pr->QTY * $pr->HARGA_SATUAN);
								$f++;
							}
							for ($n=0; $n < $f; $n++) {
								$pro_harga[$n] += @$pro_harga[$n-1];
							}
							$tot_harga[$m] = $pro_harga[$n-1] + $kr->TOTAL;
							$m++;
						}
					}
					for ($j=0; $j < $m; $j++){
						$tot_harga[$j] += @$tot_harga[$j-1];
					}
					$tot_tag[$k] = @$tot_harga[$j-1];
					$k++;
	            }
				for ($l=0; $l < $k; $l++){
					$tot_tag[$l] += @$tot_tag[$l-1];
				}
	            $json_data['data'][$i]['TOT_BAY'] = formatRp(@$tot_tag[$l-1] + $tk->KODE_UNIK);
				
				$json_data['data'][$i]['STS_BAYAR'] = $stts;
				$tanggap = $this->db->query("SELECT STS_TANGGAP FROM view_checkout WHERE ID_AKUN = '$akun' AND ID_TRANS = '$row->ID_TRANS' AND STS_TANGGAP = 1 GROUP BY ID_TOKO");
				$json_data['data'][$i]['STS_TANGGAP'] = $tanggap->num_rows();
				$resi = $this->db->query("SELECT STS_RESI FROM view_checkout WHERE ID_AKUN = '$akun' AND ID_TRANS = '$row->ID_TRANS' AND STS_RESI = 1 GROUP BY ID_TOKO");
				$json_data['data'][$i]['STS_RESI'] = $resi->num_rows();
				$jum_tk = $this->db->query("SELECT STS_TANGGAP FROM view_checkout WHERE ID_AKUN = '$akun' AND ID_TRANS = '$row->ID_TRANS' GROUP BY ID_TOKO");
				$json_data['data'][$i]['JUM_TOKO'] = $jum_tk->num_rows();
				$i++;
			}
		}
		else{
			$json_data = array('status' => 'no');
		}
		// for ($b=0; $b < 7; $b++) {
			// if ($b == 3){
				// $jml = $this->db->query('SELECT COUNT(NO_TRANS) as JML FROM mp_transaksi WHERE (ID_STATUS = 4 OR ID_STATUS = 6) AND ID_AKUN = '.$akun.' ORDER BY NO_TRANS DESC')->row();
			// }
			// else{
				// $jml = $this->producthomemodel->tampilData('mp_transaksi', 'COUNT(NO_TRANS) as JML', array('ID_AKUN' => $akun, 'ID_STATUS' => ($b+1)), TRUE);
			// }
			// $json_data['jml'][$b] = $jml->JML;
			// $json_data['sts'][$b] = ($b+1);
		// }
		echo json_encode($json_data);
	}
	
	public function detailcheckout($id){
		$akun = $this->session->userdata("id_akun_user");
		$auth = $this->session->userdata('id_akun_auth');
		$data['akun'] = $akun;
		$data['auth'] = $auth;
		$data['toko'] = $this->db->query("SELECT * FROM view_checkout WHERE ID_AKUN = '$akun' AND NO_TRANS = '$id' GROUP BY ID_TOKO")->result();
		$data['bukti'] = $this->db->query("SELECT * FROM view_bukti WHERE NO_TRANS = '$id'")->row();
		$data['stat'] = $this->db->query("SELECT ID_STATUS, STS_BAYAR, STS_SALDO FROM mp_transaksi WHERE ID_AKUN = '$akun' AND NO_TRANS = '$id'")->row();
		$where = array(
			'LEVEL' => 1
		);
		$data['rekening'] = $this->producthomemodel->tampilData('view_rekening','*',$where);
		$cek_hari = $this->db->query("SELECT * FROM view_checkout WHERE ID_AKUN = '$akun' AND NO_TRANS = '$id'")->row();
		$hari = date("Y-m-d");
		if ($hari == $cek_hari->JTH_TEMPO && $data['stat']->STS_BAYAR == 0) {
			$up_trans = $this->producthomemodel->editData(array('ID_STATUS' => 9), 'mp_transaksi', array('NO_TRANS' => $id));
		}
		$data['page'] = "detailCheckout";		
		$this->load->view($this->template, $data);
	}
	
	public function checkout_cart(){
		$akun = $this->session->userdata("id_akun_user");
		$tmp_cart = $this->producthomemodel->tampilData('mp_temp_cart', '*, HARGA@ as HARGA_SATUAN', array('ID_AKUN' => $akun), FALSE, NULL, NULL, 'ID_ONGKIR');
		$last_ong = 0;
		$new_ong = 0;
		foreach ($tmp_cart as $cart) {
			if ($cart->ID_ONGKIR != $last_ong){
				$tmp_ong = $this->producthomemodel->tampilData('mp_temp_ongkir', NULL, array('ID_ONGKIR' => $cart->ID_ONGKIR), TRUE);
				$data_ong = array(
					'NAMA_KURIR' => $tmp_ong->NAMA_KURIR,
					'PAKET_YANG_DIAMBIL' => $tmp_ong->PAKET_YANG_DIAMBIL,
					'TOTAL' => $tmp_ong->TOTAL,
					'TOTAL_REALISASI' => $tmp_ong->TOTAL
				);
				$this->producthomemodel->tambahData($data_ong, 'mp_ongkir');
				$new_ong = $this->db->insert_id();	
			}
			$data_cart = array(
				'ID_TRANS' => $cart->ID_TRANS,
				'ID_PRODUK' => $cart->ID_PRODUK,
				'QTY' => $cart->QTY,
				'QTY_TERSEDIA' => $cart->QTY,
				'ID_ONGKIR' => $new_ong,
				'ID_ALAMAT' => $cart->ID_ALAMAT,
				'ID_AKUN' => $cart->ID_AKUN,
				'HARGA@' => $cart->HARGA_SATUAN,
				'STATUS_TERSEDIA' => $cart->STS_SEDIA,
				'NAMA_PRODUK' => $cart->NAMA_PRODUK,
				'BERAT_PRODUK' => $cart->BERAT_PRODUK,
				'NAMA_TOKO' => $cart->NAMA_TOKO,
				'ID_PJ' => $cart->ID_PJ,
				'NAMA_PJ' => $cart->NAMA_PJ,
				'KEUNTUNGAN_PJ' => $cart->KEUNTUNGAN_PJ,
				'KEUNTUNGAN_INDOBABA' => $cart->KEUNTUNGAN_INDOBABA
			);
			$this->producthomemodel->tambahData($data_cart, 'mp_cart');
			// $laris = $this->producthomemodel->tampilData('mp_cart', 'SUM(QTY) as LARIS', array('ID_PRODUK' => $cart->ID_PRODUK), TRUE);
			// $add_laris = array('IN_CART' => $laris->LARIS);
			// $this->producthomemodel->editData($add_laris, 'mp_produk', array('ID_PRODUK' => $cart->ID_PRODUK));
			$last_ong = $cart->ID_ONGKIR;
		}
		foreach ($tmp_cart as $ct) {
			$this->producthomemodel->hapusData('mp_temp_cart', array('ID_CART' => $ct->ID_CART));
			$this->producthomemodel->hapusData('mp_temp_ongkir', array('ID_ONGKIR' => $ct->ID_ONGKIR));
		}
		$data_trans = array(
			'ID_TRANS' => $cart->ID_TRANS,
			'ID_STATUS' => 1,
			'ID_AKUN' => $this->session->userdata("id_akun_user"),
			'TGL_TRANS' => ubahFormatTgl(tglSekarang(), 'Y-m-d'),
			'WKT_TRANS' => wktSekarang(),
			'JTH_TEMPO' => date('Y-m-d',strtotime("+3 day", strtotime(tglSekarang()))),
			'KODE_UNIK' => $this->session->userdata("kode_unik")
		);
		$insert = $this->producthomemodel->tambahData($data_trans, 'mp_transaksi');
		if ($insert) {
			$this->session->set_userdata('waktu','');
			$this->session->set_userdata('kode_unik','');
			redirect('user_checkout/detailcheckout/'.$this->db->insert_id());	
		}		
	}

	public function bukti_checkout(){
		$akun = $this->session->userdata("id_akun_user");
		$config['upload_path'] = '././assets/images/bukti';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|bmp';
		$config['max_size'] = '1024';
		$config['overwrite'] = FALSE;
		$this->load->library('upload');
		
		$this->form_validation->set_rules("ATAS_NAMA","ATAS NAMA","required");
		$this->form_validation->set_rules("TGL_TRANSFER","TGL TRANSFER","required");
		$this->form_validation->set_rules("NO_REKENING","NO REKENING","required");
		$this->form_validation->set_rules("BANK_TUJUAN","BANK TUJUAN","required");
		$this->form_validation->set_rules("NAMA_BANK","NAMA BANK","required");
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('notifi', validation_errors());
			$this->session->set_flashdata('clri', 'danger');
			redirect('user_checkout/detailcheckout/'.$this->input->post('NO_TRANS'));
		}
		
		if(!empty($_FILES['filebukti']['name']))
		{			
			$this->upload->initialize($config);
			if ($this->upload->do_upload('filebukti')) 
			{
				$uploaddata = $this->upload->data();
				$tambahft = array(
						'KODE_UNIK' => $this->input->post('KODE_UNIK'),
						'NO_TRANS' => $this->input->post('NO_TRANS'),
						'ATAS_NAMA' => $this->input->post('ATAS_NAMA'),
						'TGL_TRANSFER' => ubahFormatTgl($this->input->post('TGL_TRANSFER'), 'Y-m-d'),
						'NO_REKENING' => $this->input->post('NO_REKENING'),
						'BANK_TUJUAN' => $this->input->post('BANK_TUJUAN'),
						'NAMA_BANK' => $this->input->post('NAMA_BANK'),
						'FT_BUKTI' => $uploaddata['file_name'],
					);
				$insert = $this->producthomemodel->tambahData($tambahft, 'mp_bukti');
				$update = $this->producthomemodel->editData(array('STS_BAYAR' => 1, 'TOT_TRANSFER' => $this->input->post('TOT_TRANSFER')), 'mp_transaksi', array('NO_TRANS' => $this->input->post('NO_TRANS')));
				$this->session->set_flashdata('notif', 'Bukti telah terkirim');
				$this->session->set_flashdata('clr', 'success');
				redirect('user_checkout/detailcheckout/'.$this->input->post('NO_TRANS'));
			} 
			else 
			{
				$this->session->set_flashdata('notif', 'maaf foto tidak bisa diupload ulangi lagi');
				$this->session->set_flashdata('clr', 'warning');
				redirect('user_checkout/detailcheckout/'.$this->input->post('NO_TRANS'));
			}
		}
		else{
			$tambahft = array(
				'KODE_UNIK' => $this->input->post('KODE_UNIK'),
				'NO_TRANS' => $this->input->post('NO_TRANS'),
				'ATAS_NAMA' => $this->input->post('ATAS_NAMA'),
				'TGL_TRANSFER' => ubahFormatTgl($this->input->post('TGL_TRANSFER'), 'Y-m-d'),
				'NO_REKENING' => $this->input->post('NO_REKENING'),
				'BANK_TUJUAN' => $this->input->post('BANK_TUJUAN'),
				'NAMA_BANK' => $this->input->post('NAMA_BANK'),
			);
			$insert = $this->producthomemodel->tambahData($tambahft, 'mp_bukti');
			$update = $this->producthomemodel->editData(array('STS_BAYAR' => 1, 'TOT_TRANSFER' => $this->input->post('TOT_TRANSFER')), 'mp_transaksi', array('NO_TRANS' => $this->input->post('NO_TRANS')));
			$this->session->set_flashdata('notif', 'Bukti telah terkirim');
			$this->session->set_flashdata('clr', 'success');
			redirect('user_checkout/detailcheckout/'.$this->input->post('NO_TRANS'));
		}
	}

	public function bayar_saldo()
	{
		$auth = $this->session->userdata('id_akun_auth');
		$cek_saldo = $this->db->query("SELECT * FROM mp_akun WHERE ID_AKUN = '$auth'")->row();
		$sisa_saldo = $cek_saldo->SALDO - $this->input->post('bayar');
		$this->producthomemodel->editData(array('SALDO' => $sisa_saldo), 'mp_akun', array('ID_AKUN' => $auth));
		$this->producthomemodel->editData(array('STS_BAYAR' => 1, 'STS_SALDO' => 1, 'TOT_TRANSFER' => $this->input->post('bayar')), 'mp_transaksi', array('NO_TRANS' => $this->input->post('NO_TRANS')));
	}
	public function cekresi(){
		error_reporting(0);
		$data['page']="resi";
		$this->load->view($this->template, $data);
	}
	public function docekresi(){
		error_reporting(0);
		$re =$this->input->post('resi');
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://pro.rajaongkir.com/api/waybill",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "waybill=".$re."&courier=jne",
		  CURLOPT_HTTPHEADER => array(
		    "content-type: application/x-www-form-urlencoded",
		    "key: 4cc186a737ae034b9e09a6cdcdf6e2ee"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) 
		{
		  echo "cURL Error #:" . $err;
		} 
		else 
		{
		  $data['angel']=json_decode($response);
		  $this->load->view("detail_resi", $data);
		}
	}
}