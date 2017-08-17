<?php
session_start();
require( __DIR__.'/src/Facebook/autoload.php' );

$fb = new Facebook\Facebook([
  'app_id' => '311560492587109', // Replace {app-id} with your app id
  'app_secret' => 'a79302126fa65a2de27f8f9fa97a92ba',
  'default_graph_version' => 'v2.10',
  ]);
/**** After Login**********/
$helper = $fb->getRedirectLoginHelper();
$permissions = ['email','publish_actions'];
$loginUrl = $helper->getLoginUrl('http://localhost/facebook/login.php', $permissions);

?>
<?php include_once('includes/header.php'); ?>

<!-- Before login -->

  <div class="content">
  	<div class="left_content">
    	<h2 align="center"><?php
		$myfile = fopen("src/campaign.txt", "r") or die("Unable to open file!");
		echo fread($myfile,filesize("src/campaign.txt"));
		fclose($myfile);
		?></h2>
        <hr/>
        <div class="start" align="center">
        <img src="img/campaign.png" alt="sample campaign image">
        </div>
        <div class="button-wrapper" align="center" >
          <a href="<?php echo htmlspecialchars($loginUrl); ?>" class="btn btn-primary btn-large">Start App</a>
        </div>
        <div class="login-explain">
		*You will have to log in with Facebook to take this test
		</div>
    </div>
    <div class="right_content">
    	<div class="artha">
    	<a target="_blank" href="http://www.arthasarokar.com/">
    	<img src="img/artha.png" alt="image block" style="width:100%; height:150px;"/>
    	</a>
    	</div>
    </div>
     <div class="right_content">
    	<div class="behuli">
    	<a target="_blank" href="http://www.e-behuli.com/">
    	<img src="img/behuli.png" alt="behuli block" style="width:100%; height:196px;"/>
    	</a>
    	</div>
    </div>
    <div class="clearfix"></div>
  </div>
  <?php include_once('includes/footer.php'); ?>
