<?php require_once "config.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<link rel="stylesheet" type="text/css" href="https://<?=site_url?>/styles.css?v=2.0.3">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<?php $w = isset($_GET['w']) && $_GET['w'] ? $_GET['w'] : '' ?>
	<?php
		if(isset($_POST['submit'])) {
			$www = $_POST['www'];
			$resp = null;
			$error = null;
			require_once('recaptchalib.php');
			
			$secret = secret;
			$reCaptcha = new ReCaptcha($secret);
			  if ($_POST["g-recaptcha-response"]) {
			    $resp = $reCaptcha->verifyResponse(
			        $_SERVER["REMOTE_ADDR"],
			        $_POST["g-recaptcha-response"]
			    );
			}
		}

	?>
</head>
<body> <?php
		if ($resp != null && $resp->success) { 
			$token = token;
			$url = 'https://'.site_ping.'/rest/connect?ip='.get_client_ip().'&token='.$token.'&local_storage=&http_referer='.$www;
			$get = file_get_contents($url);
			$json = json_decode($get);
			$array = array();
			if($json->status == 'success') { ?>
				<script type="text/javascript">
					var t_status = 'success';
					var t_msg = '<?php echo $json->urlrespone; ?>';
				</script>
			<?php } else { ?>
				<script type="text/javascript">
					var t_status = 'error';
					var t_msg = 'Lỗi! Hãy thử lại.'
				</script>
			<?php }
	?>
    <div id="box_v01get_code" class="btn_v01code" style="cursor:pointer">VUI LÒNG ĐỢI....</div>
    <a href="#" style="display: none;" id="ahref" target="_blank" class="btn_v01code"></a>
    <script type="text/javascript">
    	$(document).ready(function(){
    		var seconds = <?php echo rand(57,65);?>;
    		active = 1;
    		$(document).on('visibilitychange', function() {
	 			if(document.visibilityState === 'visible') {
    				active = 1;
 				} else {
 					active = 0;
 				}
			});
		    setTimeout(function countdown() {
		        if(active == 1) {
		            seconds--;
		        }
		        el = $('#box_v01get_code');
		        el.text('VUI LÒNG ĐỢI ... '+seconds);
		        if (seconds > 0) {
		            setTimeout(countdown, 1000)
		        }
		        else {
		        	if(t_status == 'success') {
	                		$('#ahref').attr("href", t_msg);
	                		$('#ahref').html('GET LINK >>>');
											$('#ahref').show();
											$('#box_v01get_code').hide();
                	} else {
                		$('#box_v01get_code').html(t_msg);
                	}
		        }
		    }, 1000);
    	});
    </script>
<?php } else { 
if($resp == null) {
	echo '<p class="error">Vui lòng xác nhận Captcha</p>';
} ?>
<form action="" method="POST">
      <div class="g-recaptcha" data-sitekey="<?= sitekey ?>"></div>
      <input type="hidden" name="www" value="<?php echo isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] ? $_SERVER['HTTP_REFERER'] : $w.',' ?>">
      <br/>
      <input type="submit" name="submit" value="LẤY LINK NGAY" class="btn_v01code" style="cursor:pointer">
    </form>
<?php } ?>
	
</body>
</html>

<?php

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