<?php

// header bilgilerini gönderelim
ob_start();
session_start();

// oturumu sonlandir
session_destroy();

echo "<script type=\"text/javascript\">location = './giris.php'; </script>";
?>