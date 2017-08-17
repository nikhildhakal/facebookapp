<?php include_once('includes/header.php'); ?>
<?php
session_start();
require( __DIR__.'/src/Facebook/autoload.php' );

$fb = new Facebook\Facebook([
  'app_id' => '311560492587109', // Replace {app-id} with your app id
  'app_secret' => 'a79302126fa65a2de27f8f9fa97a92ba',
  'default_graph_version' => 'v2.10',
  ]);


  $token = $_SESSION['facebook_access_token'];
  $text = htmlspecialchars($_POST['text']);
  $path = $_SESSION['path'];
  // echo $path;
  // $fbid = $_SESSION['FBID'];

  try {
		// message must come from the user-end
    $data = ['source' => $fb->fileToUpload($path), 'message' => $text];
		$request = $fb->post('/me/photos', $data, $token);

	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		// When Graph returns an error
		echo 'Graph returned an error: ' . $e->getMessage();
		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		// When validation fails or other local issues
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}
  ?>

  <div class="content" align="center">
    <h4>Successfully updated your Status</h4>
    <hr>
    <img src="<?php echo $path; ?>" alt="Profile" width="400px" height="500px">
    <br>
    Thank You for Your Support

  </div>


  <?php include_once('includes/footer.php'); ?>
