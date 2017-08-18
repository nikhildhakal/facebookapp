<?php
session_start();
session_unset();
    $_SESSION['facebook_access_token'] = NULL;
    $_SESSION['path'] = NULL;
    $_SESSION['IMAGE'] =  NULL;
header("Location: http://localhost/facebook/");        // you can enter home page here ( Eg : header("Location: " ."http://www.krizna.com");
?>
