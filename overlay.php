<?php
session_start();
require( __DIR__.'/src/Facebook/autoload.php' );

$fb = new Facebook\Facebook([
  'app_id' => '311560492587109', // Replace {app-id} with your app id
  'app_secret' => 'a79302126fa65a2de27f8f9fa97a92ba',
  'default_graph_version' => 'v2.10',
  ]);


  $token = $_SESSION['facebook_access_token'];
  $image = $_SESSION['IMAGE'];

  // echo $imageSelected;
  // $overlay = $_SESSION['overlay']; echo $overlay;

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

  //Store image in the directory
	$img = __DIR__.'/avatar/'.$profile['id'].'.jpg';
	file_put_contents($img, file_get_contents($picture['url']));

  //Attempt merging of the overlay with the profile image

  $jpeg = imagecreatefromjpeg('avatar/'.$profile['id'].'.jpg');
  $png = imagecreatefrompng('overlay/'.$image);
  list($width, $height) = getimagesize('avatar/'.$profile['id'].'.jpg');
  list($newwidth, $newheight) = getimagesize('overlay/'.$image);
  $out = imagecreatetruecolor($newwidth, $newheight);
  imagecopyresampled($out, $jpeg, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
  imagecopyresampled($out, $png, 0, 0, 0, 0, $newwidth, $newheight, $newwidth, $newheight);
  imagejpeg($out, 'output/'.$profile['id'].'.jpg', 100);

  $path = 'output/'.$profile['id'].".jpg";
  $_SESSION['path'] = $path;
  // $_SESSION['FBID'] = $profile['id'];
  // var_dump($path);

?>

<?php include_once('includes/header.php'); ?>

<div class="content" align="center">
  <div class="row">
      <div class="col-md-6">
        <h4>Your Picture is Ready</h4>
        <img src="output/<?php echo $profile['id']; ?>.jpg" alt="Campaign Image" width="400px" height="500px">
        <br>
        <form class="form" action="update.php?id=<?php echo $profile['id']; ?>" method="post">
            <br>
            <textarea class="var" name="text" style="margin: 0px 0px 10px; width: 390px; height: 80px;"></textarea>
            <br>
            <input class="btn btn-primary" value="Post on your timeline" type="submit">
        </form>
      </div>
  </div>



</div>


<?php include_once('includes/footer.php'); ?>
