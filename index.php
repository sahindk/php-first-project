<?php

// dahil edilecek sayfalar� al
include("ayarlar.php");
include("include.php");

// de�i�ken
$s	= strip_tags(addslashes($_GET['s']));

// �a��r�lacak sayfa
switch($s)
{
	case 'haber':
		$dosya	= 'haber.php';
	break;
	
	case 'kategoriler':
		$dosya	= 'kategoriler.php';
	break;
	
	default:
		$dosya	= 'anasayfa.php';
	break;
}

// kategoriler
$sorgu	= mysql_query("
					  SELECT kid, kategori
					  FROM kategoriler
					  ORDER BY kategori ASC
					  ") or die(mysql_error());

$kategoriler = array();
while($veri = mysql_fetch_array($sorgu))
	$kategoriler[]	= $veri;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-9" />
<title><?php echo SITE_BASLIK;?></title>
<link href="<?=SITE_URL?>/cssjs/stil.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=SITE_URL?>/cssjs/f.js"></script>
</head>

<body>
<!-- ta��y�c� �er�eve -->
<div id="anacerceve">
	<!-- �st b�l�m -->
	<div id="ust-bolum">
    	<!-- logo -->
    	<div class="logo"><a href="index.php" title="Ana Sayfa"><img src="resimler/logo.png" border="0" /></a></div>
        <!-- �st ara�lar -->
        <div class="ust-araclar">
        <div class="ic">
        	<a href="javascript:void();" onClick="this.style.behavior='url(#default#homepage)';this.setHomePage('http://www.gokhandokuyucu.com/sahin');">Ana Sayfam Yap</a><a href="javascript:void();" onclick="favorilereEkle();">Favorilerime Ekle</a><a href="">Bize Ula&#351;&#305;n</a>             
        </div>
        </div>
    </div>
    <!-- �st men� -->
    <div id="ustmenu">
    	<div class="sag"><img src="resimler/ustmenu_sag.png" border="0" /></div>
        <div class="sol"><img src="resimler/ustmenu_sol.png" border="0" /></div>
        <div>
        <ul id="ustMenuListe">
        	<li><a href="<?=SITE_URL?>/index.php">Ana Sayfa</a></li>
            
            <li class="cizgi"></li>
            <?php
            foreach($kategoriler as $i=>$kat){
			?>
        	<li><a href="<?=SITE_URL?>/index.php?s=kategoriler&kid=<?=$kat['kid']?>"><?=stripslashes($kat['kategori'])?></a></li>
            <li class="cizgi"></li>
            <?php
			}
			?>
        </ul>
        </div>
    </div>
    
    <!-- orta ta��y�c� -->
    <div id="orta">
   		<!-- sol -->
        <div id="sol-bolum">
        <div class="sol-bolum-ic">
        <?php include($dosya); ?>
        </div>
        </div>
        <!-- sa� -->
        <div id="sag-bolum">
        <div class="sag-bolum-ic">
        <?php include("sag.php"); ?>
        </div>
        </div>
        <!-- s�tunlar� e�itle -->
        <div class="clearFix"></div>
    </div>
</div>
<!-- alt b�l�m -->
<div id="alt-bolum">
	<div class="ic">
    <strong>Copyright &copy; <?=date("Y")?> <?php echo SITE_BASLIK; ?>. T�m Haklar&#305; Sakl&#305;d&#305;r.</strong><br />
    Yaz&#305;l&#305;m & Tasar&#305;m : &#350;ah&#304;n DOKUYUCU
    </div>
</div>



</body>
</html>