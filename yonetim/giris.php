<?php

// header bilgilerini g�nderelim
ob_start();
session_start();

// include edelim
include("../ayarlar.php");
include("include.php");

// giri� yapal�m
if(isset($_POST) && $_POST) // post i�lemi ger�ekle�ti ise
{
	$uyeadi	= strip_tags(addslashes($_POST['uyeadi']));
	$sifre	= strip_tags(addslashes($_POST['sifre']));
	
	if(!$uyeadi || !$sifre)
		$hata	= "L�tfen �ye ad&#305;n&#305;z&#305; ve/veya &#351;ifrenizi giriniz";
	else
	{
		if(!(($uyeadi == $yp_uyeadi) && ($sifre == $yp_sifre)))
			$hata	= "Giri&#351; bilgilerinizde hata bulundu";
		else
		{
			$_SESSION['uyeadi']	= $uyeadi;
			$_SESSION['sifre']	= $sifre;
			
			header("Location: ./index.php");
			exit;
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-9" />
<title><?php echo SITE_BASLIK;?></title>
<link href="<?=SITE_URL?>/cssjs/yonetim.css" rel="stylesheet" type="text/css" />
</head>
<body>
<!-- giri� formu -->
<div id="giris-form">
	<h2>Y�netim Paneli Giri&#351;</h2>
    <?php if($hata){?>
    <div class="hata"><?php echo $hata; ?></div>
	<?php } ?>
    <div>
    <form method="post">
    	<div class="inp"><label for="uyeadi">�ye Ad&#305;n&#305;z :</label>
        <input type="text" name="uyeadi" id="uyeadi" size="30" /></div>
    	<div class="inp"><label for="sifre">&#350;ifreniz :</label>
        <input type="password" name="sifre" id="sifre" size="30" /></div>
        <div class="inp"><input type="submit" value="Giri&#351; Yap" class="buton" /></div>
    </form>
    </div>
</div>
</body>
</head> 	 	