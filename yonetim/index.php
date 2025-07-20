<?php

// header bilgilerini gönderelim
ob_start();
session_start();

// include edelim
include_once("../ayarlar.php");
include_once("include.php");

// giriş kontrolü yapalım
include_once("giris_kontrol.php");

// işlemler
$s	= strip_tags($_REQUEST['s']);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-9" />
<title>Yönetim Paneli | <?php echo SITE_BASLIK;?></title>
<link href="<?=SITE_URL?>/cssjs/yonetim.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="ana-cerceve">
<div id="yonetim-baslik"><?=SITE_BASLIK?> Yönetim Paneli</div>

<div class="menuler">
<ul id="ustMenu">
	<li><a href="./index.php">Ana Sayfa</a></li>
	<li><a href="./index.php?s=kategoriler">Kategoriler</a></li>
	<li><a href="./index.php?s=haberler">Haberler</a></li>
	<li><a href="./cikis.php">Ç&#305;k&#305;&#351;</a></li>
    <div class="clearFix"></div>
</ul>
</div>

<!-- orta sayfa -->
<div id="orta">
<?php
switch($s)
{
	case 'haberler':
		include("haberler.inc.php");
	break;
	
	case 'kategoriler':
		include("kategoriler.inc.php");
	break;
	
	default:
	break;
}
?>
</div>
</div>
</body>
</head> 	 	