<?php 
	session_start();
	$string = generateRandomString(6);
	$_SESSION['captcha'] = $string;
	$img = imagecreate(150, 50);
	$background = imagecolorallocate($img,0,0,0);
	$text_color = imagecolorallocate($img,255,255,255);
	imagestring($img,10,40,15,$string,$text_color);

	header("Content-type: image/png");
	imagepng($img);
	imagedestroy($img);

	function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>