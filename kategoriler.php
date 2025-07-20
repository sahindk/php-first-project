<?php

// kategori bilgisi
$kid	= intval($_GET['kid']);

$no		= intval($_GET['no']);
$limit	= 10;
$basla	= $limit * $no;

// kategori bilgisi
$sorgu	= mysql_query("
					  SELECT kategori
					  FROM kategoriler
					  WHERE kid = ".$kid."
					  ") or die(mysql_error());

$kategoriDetay	= mysql_fetch_array($sorgu);

// haberler
$sql	= "SELECT haberid, resim, baslik, aciklama, tarih
		   FROM haberler
		   WHERE durum = 1
		   AND kid = ".$kid."
		   ORDER BY haberid DESC";
		   
$sorgu			= mysql_query($sql) or die(mysql_error());
$toplamKayit	= mysql_num_rows($sorgu);

$sorgu	= mysql_query($sql. " LIMIT $basla, $limit") or die(mysql_error());

$haberler	= array();
while($veri = mysql_fetch_array($sorgu))
	$haberler[]	= $veri;

?>
<!-- ana sayfa haberler -->
<div>
<div class="blok-baslik3"><?=stripslashes($kategoriDetay['kategori'])?></div>
<div class="araBosluk10px"></div>
<?php if($toplamKayit){?>
<ul id="anasayfa-haberler">
<?php
foreach($haberler as $i=>$haber){
?>
<li>
<a href="<?=SITE_URL?>/index.php?s=haber&haberid=<?=$haber['haberid']?>">
    <h3><?=stripslashes($haber['baslik'])?></h3>
    <div class="tarih"><?=tarihDonustur($haber['tarih'])?> tarihinde eklendi.</div>
    <img src="<?=$haber['resim']?>" />
    <?=stripslashes($haber['aciklama'])?>
</a>
    <div class="clearFix"></div>
</li>
<?php } ?>
</ul>
<div class="araBosluk10px"></div>
<!-- sayfalama -->
<div><?php echo sayfalama('index.php?s=kategoriler&kid='.$kid, $toplamKayit, $limit, $no);?></div>
<?php }else{ ?>
<div>Bu kategoride kay&#305;tl&#305; haber bulunamad&#305;.</div>
<?php } ?>
</div>