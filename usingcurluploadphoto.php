<?php
session_start();
require_once __DIR__ . '/Facebook/autoload.php';

$fb = new \Facebook\Facebook([
  'app_id' => '1145321875517395',
  'app_secret' => '2ecf70ed6ffb20481a5f5cc8920bab53',
  'default_graph_version' => 'v2.8',
]);

   $permissions = ['publish_actions']; // optional
   $helper = $fb->getRedirectLoginHelper();
   $accessToken = $helper->getAccessToken();

if (isset($accessToken)) {

 		$param = array(
		   'url' => 'https://scontent.fpnh3-1.fna.fbcdn.net/v/t31.0-8/17621729_1343048589094302_2628160039347639238_o.jpg?oh=1993fed02a055fc087345202493351a7&oe=5987FAFD',
		 	 'access_token' => $accessToken,
		 	 'message' => "this is my Facebook cover"

		);
		$ch = curl_init();
		$url = "https://graph.facebook.com/me/photos";
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
		$response = curl_exec($ch);
		$err = curl_error($ch);

		curl_close($ch);

		if ($err) {
		 echo "this is error".$err;
		} else {
		 echo $response;
		}





} else {
	//replace your app url here http://localhost/Facebook-Upload-Photo/
	$loginUrl = $helper->getLoginUrl('http://localhost/Facebook-Upload-Photo/', $permissions);
	echo '<a href="' . $loginUrl . '">Login with Facebook</a>';
}
	
