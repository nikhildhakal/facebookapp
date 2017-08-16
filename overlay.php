<?php
session_start();
require( __DIR__.'/src/Facebook/autoload.php' );

$fb = new Facebook\Facebook([
  'app_id' => '311560492587109', // Replace {app-id} with your app id
  'app_secret' => 'a79302126fa65a2de27f8f9fa97a92ba',
  'default_graph_version' => 'v2.10',
  ]);


  $token = $_SESSION['facebook_access_token'];

  /****************Getting basic/profile info using crul***************/

  // getting profile picture of the user
	try {
		$requestPicture = $fb->get('/me/picture?redirect=false&height=960&width=960', $token); //getting user picture
		$requestProfile = $fb->get('/me', $token); // getting basic info
		$picture = $requestPicture->getGraphUser();
		$profile = $requestProfile->getGraphUser();
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		// When Graph returns an error
		echo 'Graph returned an error: ' . $e->getMessage();
		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		// When validation fails or other local issues
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}

	// showing picture on the screen
	// echo "<img src='".$picture['url']."'/>";

  // echo "Name:".$profile['name'];
  // saving picture
	$img = __DIR__.'/avatar/'.$profile['id'].'.jpg';
	file_put_contents($img, file_get_contents($picture['url']));

  //Attempt merging of the overlay with the profile image

  $jpeg = imagecreatefromjpeg('avatar/'.$profile['id'].'.jpg');
  $png = imagecreatefrompng('overlay/mark.png');
  list($width, $height) = getimagesize('avatar/'.$profile['id'].'.jpg');
  list($newwidth, $newheight) = getimagesize('overlay/mark.png');
  $out = imagecreatetruecolor($newwidth, $newheight);
  imagecopyresampled($out, $jpeg, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
  imagecopyresampled($out, $png, 0, 0, 0, 0, $newwidth, $newheight, $newwidth, $newheight);
  imagejpeg($out, 'output/'.$profile['id'].'.jpg', 100);

?>

<?php include_once('includes/header.php'); ?>

<img src="output/<?php echo $profile['id']; ?>.jpg" width="280" height="280" alt="campaign image">

<?php include_once('includes/footer.php'); ?>
