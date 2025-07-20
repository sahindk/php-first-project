<?php

// header bilgilerini gönderelim
ob_start();
session_start();

// include edelim
include_once("../ayarlar.php");

$uyeadi	= strip_tags(addslashes($_SESSION['uyeadi']));
$sifre	= strip_tags(addslashes($_SESSION['sifre']));

if(!(($uyeadi == $yp_uyeadi) && ($sifre == $yp_sifre)))
{
	echo "<script type=\"text/javascript\">location = './giris.php'; </script>";
	exit;
}

?>