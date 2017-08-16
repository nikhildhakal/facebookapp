<?php include_once('includes/header.php'); ?>
<?php
session_start();
require_once __DIR__ . '/src/Facebook/autoload.php';

$fb = new \Facebook\Facebook([
  'app_id' => '311560492587109',
  'app_secret' => 'a79302126fa65a2de27f8f9fa97a92ba',
  'default_graph_version' => 'v2.10',
]);

   $permissions = []; // optional
   $helper = $fb->getRedirectLoginHelper();
   $accessToken = $helper->getAccessToken();

if (isset($accessToken)) {

 		$url = "https://graph.facebook.com/v2.6/me?fields=id,name,gender,email,cover&access_token={$accessToken}";
		$headers = array("Content-type: application/json");


		 $ch = curl_init();
		 curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		 curl_setopt($ch, CURLOPT_URL, $url);
	         curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		 curl_setopt($ch, CURLOPT_COOKIEJAR,'cookie.txt');
		 curl_setopt($ch, CURLOPT_COOKIEFILE,'cookie.txt');
		 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		 curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3");
		 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		 $st=curl_exec($ch);
		 $result=json_decode($st,TRUE);
		//  echo "My name: ".$result['name'];
    //  echo $result['id'];
		//  echo "<img src=".$result['cover']['source'].">";
    $fbid = $result['id'];
    $fbfullname = $result['name'];
    $femail = $result['email'];
    $_SESSION['FBID'] = $fbid;
    $_SESSION['FULLNAME'] = $fbfullname;
    $_SESSION['EMAIL'] =  $femail;
header("Location:http://localhost/facebook/app.php");
} else {

	$loginUrl = $helper->getLoginUrl('http://localhost/facebook/app.php', $permissions);
	echo '<a href="' . $loginUrl . '">Login with Facebook</a>';
} ?>
<?php include_once('includes/footer.php'); ?>
