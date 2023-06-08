<?php
require_once "config.php";

 header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header('Content-Type: application/json');
	$w = isset($_POST['w']) ? $_POST['w'] : '';
	$v = isset($_POST['v']) ? $_POST['v'] : '';
    $local_storage = isset($_POST['local_storage']) ? $_POST['local_storage'] : null;
	$site = array();
$token = token;
$url = 'https://'.site_ping.'/rest/connect?ip='.get_client_ip().'&token='.$token.'&local_storage='.$local_storage.'&http_referer='.$v;
$get = file_get_contents($url);
$json = json_decode($get);
$array = array();
if($json->status == 'success') {
	$array = array(
        'status' => 'success',
        'msg' => $json->urlrespone
    );
} else {
	$array = array(
        'status' => 'error',
        'msg' => 'Lỗi! Hãy thử lại.'
    );
}

echo json_encode($array);


function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}