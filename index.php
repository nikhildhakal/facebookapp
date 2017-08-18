
<?php include_once('includes/header.php'); ?>

<?php if (isset($_POST['image'])) {
session_start();

require( __DIR__.'/src/Facebook/autoload.php' );
$_SESSION['IMAGE'] = $_POST['image'];
$fb = new Facebook\Facebook([
  'app_id' => '311560492587109', // Replace {app-id} with your app id
  'app_secret' => 'a79302126fa65a2de27f8f9fa97a92ba',
  'default_graph_version' => 'v2.10',
  ]);
/**** After Login**********/
$helper = $fb->getRedirectLoginHelper();
$permissions = ['email','publish_actions'];
$loginUrl = $helper->getLoginUrl('http://localhost/facebook/login.php', $permissions);

header("Location:". $loginUrl);
 } else{ ?>

<div class="content" align="center">
  <div class="start" align="center">
  <img src="img/campaign.png" alt="sample campaign image">
</div> <br>
  <form class="" action="index.php" method="post">
    <div class="form-group">
      <label for="image"><h3>Select a Design and Click Start:</h3></label>
      <select class="form-control" name="image" style="width:400px; height:40px;">
        <option value="1">I Want Directly Elected PM</option>
        <option value="2">Happy New Year 2017</option>
        <option value="3">Merry Christmas</option>
      </select>
      <br><br>
      <div id="designs" align="center">
            <img class="design" src="overlay/mark-1.png" />
            <img class="design" src="overlay/mark-2.png" />
            <img class="design" src="overlay/mark-3.png" />
      </div>
    </div>
    <br>
    <div class="form-group">
      <input type="submit" value="Start the App" class="btn btn-primary btn-large form-control" style="width:200px;">
    </div>

  </form>

  <div class="login-explain">
*You will have to log in with Facebook to take this test
</div>
<br>
</div>
<div class="content">
  <div class="artha">
  <a target="_blank" href="http://www.arthasarokar.com/">
  <img src="img/artha.png" alt="image block" style="width:50%; height:150px;"/>
  </a>
  </div>

</div>

<?php } ?>

  <?php include_once('includes/footer.php'); ?>
