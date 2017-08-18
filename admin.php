<?php include_once('includes/header.php'); ?>

<div class="content" align="center">
  <h2>Upload Layout in PNG</h2>
  <form action="index.php" method="post" enctype="multipart/form-data">
    Select image to upload: <br>
    <input type="file" name="file" id="file"><br>
    <input type="submit" value="Upload Image" name="file">
</form>
</div>

<?php include_once('includes/footer.php'); ?>
