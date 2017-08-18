<?php
session_start();
require( __DIR__.'/src/Facebook/autoload.php' );

// $overlay = $_POST['image'];
// $_SESSION['overlay'] = $overlay;

$fb = new Facebook\Facebook([
  'app_id' => '311560492587109', // Replace {app-id} with your app id
  'app_secret' => 'a79302126fa65a2de27f8f9fa97a92ba',
  'default_graph_version' => 'v2.10',
  ]);

$helper = $fb->getRedirectLoginHelper();

try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (isset($accessToken)) {
    // Logged in!
  $_SESSION['facebook_access_token'] = (string) $accessToken;
    //echo $_SESSION['facebook_access_token'];

    header("Location: overlay.php"); //redirect
    die();
      //"overlay",array("token"=> $token),true);
    // Now you can redirect to another page and use the
    // access token from $_SESSION['facebook_access_token']
  } elseif ($helper->getError()) {
    // The user denied the request
    var_dump($helper->getError());
    var_dump($helper->getErrorCode());
    var_dump($helper->getErrorReason());
    var_dump($helper->getErrorDescription());
    exit;
  }
http_response_code(400);
exit;

?>
