<?php

// de�i�kenler
$haberid	= intval($_GET['haberid']);

// hit g�ncelle
mysql_query("UPDATE haberler SET hit = hit + 1 WHERE haberid = ".$haberid) or die(mysql_error());

// haber bilgileri
$sorgu	= mysql_query("
					  SELECT kid, resim, baslik, aciklama, detay,
					  resim, tarih, hit
					  FROM haberler
					  WHERE haberid = ".$haberid."
					  AND durum = 1
					  ") or die(mysql_error());

$haberDetay	= mysql_fetch_array($sorgu);

$haberDetay['detay']	= nl2br($haberDetay['detay']); // sat�r aralar�n� enter a d�n��t�r

// benzer haberler
$sorgu	= mysql_query("
					  SELECT haberid, baslik
					  FROM haberler
					  WHERE kid = ".intval($haberDetay['kid'])."
					  AND durum = 1
					  ORDER BY tarih DESC
					  LIMIT 10
					  ") or die(mysql_error());

$digerHaberler	= array();
while($veri = mysql_fetch_array($sorgu))
	$digerHaberler[] = $veri;

?>
<div id="icerikDetay">
	<h1 class="baslik"><?=stripslashes($haberDetay['baslik'])?></h1>
    <div class="tarih"><?=tarihDonustur($haberDetay['tarih'])?></div>
    <div class="aciklama"><?=stripslashes($haberDetay['aciklama'])?></div>
    <div class="resim"><img src="<?=stripslashes($haberDetay['resim'])?>" /></div>
    <div class="detay"><?=stripslashes($haberDetay['detay'])?></div>
    <div class="clearFix"></div>
    
    <div class="hit">Bu haber daha �nce <strong><?=($haberDetay['hit'])?></strong> kez okundu.</div>
</div>
<!-- di�er haber ba�l�klar� -->
<div class="blok-baslik2">Kategorideki Diger Haberler</div>
<div>
<ul id="haberListe2">
<?php foreach($digerHaberler as $i=>$haber){?>
	<li><a href="index.php?s=haber&haberid=<?=$haber['haberid']?>"><?=stripslashes($haber['baslik'])?></a></li>
<?php } ?>
</ul>
</div>