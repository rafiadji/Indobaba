<?php

if ( ! function_exists('formatRp'))

{

	function formatRp($nomimal){
		$angka = $nomimal;
		$jumlah_desimal = 0;
		$pemisah_desimal = ",";
		$pemisah_ribuan = ".";
		return "Rp ".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan).",-";
	}
}

if ( ! function_exists('kodeUnik'))

{

	function kodeUnik($no_transaksi){
		return rand(100,999);
	}

}



if ( ! function_exists('acakPass'))

{

	function acakPass($string){

		$acak = '!@#$%12345_9876';

		$password = md5($acak.md5($acak.md5($string).$acak).$acak);

		return $password;

	}

}



if ( ! function_exists('konversiGram')){

	function konversiGram($gram){

		$kilogram = $gram / 1000;

		return $kilogram." Kg";

	}

}


if(!function_exists('getProvinsiRj')){
	function getProvinsiRj($id){
		$CI =& get_instance();
		$CI->load->database();
		$api = $CI->db->query('SELECT * FROM mp_rajaongkir')->row();
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => "http://api.rajaongkir.com/starter/province?id=$id",
		CURLOPT_RETURNTRANSFER => true,
	  	CURLOPT_ENCODING => "",
	  	CURLOPT_MAXREDIRS => 10,
	  	CURLOPT_TIMEOUT => 30,
	  	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  	CURLOPT_CUSTOMREQUEST => "GET",
	  	CURLOPT_HTTPHEADER => array(
	    		"key: $api->API_KEY"
	  		),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);
		if ($err) {
	  	echo "cURL Error #:" . $err;
		}
		else {
	  		$hasil = json_decode($response);
	  		return $hasil->rajaongkir->results->province;
		}
	}
}

if(!function_exists('getKabupatenRj')){
	function getKabupatenRj($id_provinsi,$id_kabupaten){
		$CI =& get_instance();
		$CI->load->database();
		$api = $CI->db->query('SELECT * FROM mp_rajaongkir')->row();
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => "http://api.rajaongkir.com/starter/city?id=$id_kabupaten&province=$id_provinsi",
		CURLOPT_RETURNTRANSFER => true,
	  	CURLOPT_ENCODING => "",
	  	CURLOPT_MAXREDIRS => 10,
	  	CURLOPT_TIMEOUT => 30,
	  	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  	CURLOPT_CUSTOMREQUEST => "GET",
	  	CURLOPT_HTTPHEADER => array(
	    		"key: $api->API_KEY"
	  		),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);
		if ($err) {
	  	echo "cURL Error #:" . $err;
		}
		else {
	  		$hasil = json_decode($response);
	  		return $hasil->rajaongkir->results->city_name;
		}
	}
}


if ( ! function_exists('kirimSms'))

{

	function kirimSms($no_hp = NULL, $pesan = NULL){

		$CI =& get_instance();

		$CI->load->database();

		$databasee = $CI->db->query('SELECT * FROM mp_setting')->row();

		$kode = explode("#",$databasee->SETTING);

		$userkey="$kode[0]";

		$passkey="$kode[1]";

		$message= $pesan;

		$url = "$databasee->LINK";

		$curlHandle = curl_init();

		curl_setopt($curlHandle, CURLOPT_URL, $url);

		curl_setopt($curlHandle, CURLOPT_POSTFIELDS, 'userkey='.$userkey.'&passkey='.$passkey.'&nohp='.$no_hp.'&pesan='.urlencode($message));

		curl_setopt($curlHandle, CURLOPT_HEADER, 0);

		curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);

		curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);

		curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);

		curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);

		curl_setopt($curlHandle, CURLOPT_POST, 1);

		$results = curl_exec($curlHandle);

		curl_close($curlHandle);

	}

}



if ( ! function_exists('verifikasiEmail'))

{

	function verifikasiEmail($string){

		$acak = '!@#$%12345_9876';

		$password = md5($acak.md5($acak.md5($string).$acak).$acak);

		return $password;

	}

}



if ( ! function_exists('setPermalink'))

{

	function setPermalink($id,$content)

	{

		$karakter = array ('{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+','-','/','\\',',','.','#',':',';','\'','"','[',']');

		$hapus_karakter_aneh = strtolower(str_replace($karakter,"",$content));

		$tambah_strip = strtolower(str_replace(' ', '-', $hapus_karakter_aneh));

		$link_akhir = $tambah_strip.'-'.$id;

		return $link_akhir;

	}

}



if ( ! function_exists('getUsername'))

{

	function getUsername($username,$level){

		$user = strtolower($level);

		if($level == 'ukm'){

			$user_string = 'ukm'.'-'.$username;

		}

		elseif($level == 'admin'){

			$user_string = 'admin'.'-'.$username;

		}

		elseif($level == 'akun'){

			$user_string = $username;

		}

		return $user_string;

	}

}



if ( ! function_exists('metaDes'))

{

	function metaDes($description, $limit)

	{

		$karakter_khusus = array('{','}',')','(','`','%','^',';','"','[',']');

		$fix_content = str_replace($karakter_khusus,"", strip_tags($description));

		$txt = trim($fix_content);

		// Hilangkan double spasi pada deskripsi

		while( strpos($txt, '  ') ){

			$txt = str_replace('  ', ' ', $txt);

		}

		return substr($txt,0,$limit);

	}

}



if ( ! function_exists('tglSekarang')){

	function tglSekarang(){

		$tanggal = gmdate("d-m-Y", time()+60*60*7);

		return $tanggal;

	}

}



if ( ! function_exists('wktSekarang')){

	function wktSekarang(){

		$waktu = gmdate("H:i:s", time()+60*60*7);

		return $waktu;

	}

}



if ( ! function_exists('ubahFormatTgl')){

	function ubahFormatTgl($tanggal,$format){

		$ubah_format = date($format, strtotime($tanggal));

		return $ubah_format;

	}

}

function tgl_indo_lengkap($tgl){
    $tanggal = substr($tgl,8,2);
    $bulan = getBulanLengkap(substr($tgl,5,2));
    $tahun = substr($tgl,0,4);
    return $tanggal.' '.$bulan.' '.$tahun;
}
function getBulanLengkap($bln){
    switch ($bln){
	case 1: 
		return "Januari";
		break;
	case 2:
		return "Februari";
		break;
	case 3:
		return "Maret";
		break;
	case 4:
		return "April";
		break;
	case 5:
		return "Mei";
		break;
	case 6:
		return "Juni";
		break;
	case 7:
		return "Juli";
		break;
	case 8:
		return "Agustus";
		break;
	case 9:
		return "September";
		break;
	case 10:
		return "Oktober";
		break;
	case 11:
		return "November";
		break;
	case 12:
		return "Desember";
		break;
    }
}

?>