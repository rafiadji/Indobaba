<?php

function base64_encode_fix($string){
	$base_64_string = base64_encode($string);
	$url_param = rtrim($base_64_string, '=');
    return $url_param;
}

function base64_decode_fix($string){
	$base_64_string = $string . str_repeat('=', strlen($string) % 4);
    return base64_decode($base_64_string);
}

?>