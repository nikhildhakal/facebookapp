
<?php
session_start();
require( __DIR__.'/src/Facebook/autoload.php' );

$fb = new Facebook\Facebook([
  'app_id' => '311560492587109', // Replace {app-id} with your app id
  'app_secret' => 'a79302126fa65a2de27f8f9fa97a92ba',
  'default_graph_version' => 'v2.10',
  ]);


  $token = $_SESSION['facebook_access_token'];
  
  $path = $_SESSION['path'];
  $fbid = $_GET['id'];
  // echo $path;
  // $fbid = $_SESSION['FBID'];

  try {
		// message must come from the user-end
    $data = ['source' => $fb->fileToUpload($path),'caption' => 'Support the campaign by Sharing. Check out www.yubapost.com'];
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
      header("Location:" . $link);
        ?>
