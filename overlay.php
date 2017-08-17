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
  // echo $profile['id'];
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

  $path = 'output/'.$profile['id'].".jpg";
  $_SESSION['path'] = $path;
  // $_SESSION['FBID'] = $profile['id'];
  // var_dump($path);

?>

<?php include_once('includes/header.php'); ?>

<div class="content" align="center">
  <h4>Your Picture is Ready</h4>
  <img src="output/<?php echo $profile['id']; ?>.jpg" alt="Campaign Image" width="400px" height="500px">
  <br>
  <!-- <button type="button" name="button" class="btn btn-large btn-primary">Post on timeline</button> -->
  <hr>
  <form class="form" action="update.php" method="post">
      <label for="status" class="form-control"><h4>Status:</h4></label>
      <textarea name="text" rows="5" cols="100" class="" style="margin: 0px 0px 10px; width: 390px; height: 123px;"></textarea><br>
      <input class="btn btn-primary" value="Post on your timeline" type="submit">
  </form>
<?php
  // try {
		// message must come from the user-end
    // $data = ['source' => $fb->fileToUpload(__DIR__.'/output/'.$profile['id'].".jpg"), 'message' => 'my photo'];
		// $request = $fb->post('/me/photos', $data, $token);

	// } catch(Facebook\Exceptions\FacebookResponseException $e) {
	// 	// When Graph returns an error
	// 	echo 'Graph returned an error: ' . $e->getMessage();
	// 	exit;
	// } catch(Facebook\Exceptions\FacebookSDKException $e) {
	// 	// When validation fails or other local issues
	// 	echo 'Facebook SDK returned an error: ' . $e->getMessage();
	// 	exit;
	// }
  ?>
</div>


<?php include_once('includes/footer.php'); ?>
