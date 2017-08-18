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
<br>
<!-- Before login -->

  <?php echo $_POST['image']; ?>


  </div>
  <?php include_once('includes/footer.php'); ?>
