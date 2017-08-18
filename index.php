
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
 }
 else
 {
   ?>
<?php if (isset($_FILES['file'])) {
    // echo "<pre>";
    // print_r($_FILES['file']);
    // echo $_FILES['file']['name'];
    $image_name = $_FILES['file']['name'];
    $file_local = 'overlay/' . $image_name;
  	$imgupload = move_uploaded_file($_FILES['file']['tmp_name'], $file_local);
} else{ $image_name = "mark-1.png"; }?>
<div class="content" align="center">
  <div class="start" align="center">
  <img src="img/campaign.png" alt="sample campaign image">
</div> <br>
<?php
    // $myfile = "src/campaign.txt";
    // $lines = file($myfile);
    // foreach($lines as $line)
    //   {
    //     $var = explode(':', $line, 2);
    //     $arr[$var[0]] = $var[1];
    //   }
    $dir = 'overlay';
    $files = scandir($dir);
    $filenames = array_diff($files , array('..','.'));
    // print_r($filenames);
    ?>
  <form class="" action="index.php" method="post">
    <div class="form-group">
      <label for="image"><h3>Select a Design and Click Start:</h3></label>
      <select class="form-control" name="image" style="width:400px; height:40px;">
        <?php foreach ($filenames as $key) { ?>
        <option value="<?php echo $key; ?>"><?php echo str_replace('.png' , ' ' , $key); ?></option>
      <?php } ?>
      </select>
      <br><br>
      <div id="designs" align="center">
        <?php foreach ($filenames as $key) {   ?>
          <img class="design" src="overlay/<?php echo $key; ?>" />
          <?php  } ?>
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
