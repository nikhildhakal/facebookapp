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
  $fbid = $_GET['id'];
  // echo $path;
  // $fbid = $_SESSION['FBID'];

  try {
		// message must come from the user-end
    $data = ['source' => $fb->fileToUpload($path), 'message' => $text];
		$request = $fb->post('/me/photos', $data, $token);
    $response = $request->getGraphNode()->asArray();
    // $picture = $fb->get('/'.$fbid.'fields=link' , $token);
    // echo "<pre>";
    // var_dump($picture);
    // header("Location:". $picture['link']."&makeprofile=1");

	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		// When Graph returns an error
		echo 'Graph returned an error: ' . $e->getMessage();
		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		// When validation fails or other local issues
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}
    $id =  $response['id'];
          /* PHP SDK v5.0.0 */
      /* make the API call */
      $req = $fb->get('/' . $id . '?fields=link', $token);
      // $response = $request->execute();
      $graphObject = $req->getGraphObject();
      // echo "<pre>";
      // print_r($graphObject);
      $link =  $graphObject['link'];
      /* handle the result */

        ?>

  <div class="content" align="center">
    <h4>Successfully updated your Status </h4>
    <hr>
    <img src="<?php echo $path; ?>" alt="Profile" width="400px" height="500px">
    <br>
    <a href="<?php echo $link; ?>" class="btn btn-success">Make this Your Profile Picture</a>
    <?php

        // echo '<a class="button" target="_blank" href="http://www.facebook.com/photo?'.$fbid.'&type=1&makeprofile=1&makeuserprofile=1">Make Your Profile Picture</a>';
    ?>

  </div>


  <?php include_once('includes/footer.php'); ?>
