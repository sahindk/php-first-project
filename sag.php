<?php

// çok okunan haberler
$sorgu	= mysql_query("
					  SELECT haberid, resim, baslik, aciklama, tarih
					  FROM haberler
					  WHERE durum = 1
					  ORDER BY hit DESC
					  LIMIT 10
					  ") or die(mysql_error());

$cokOkunanlar	= array();
while($veri = mysql_fetch_array($sorgu))
	$cokOkunanlar[]	= $veri;

?>
<div class="blok-baslik">Çok Okunan Haberler</div>
<div class="blok-haberler">
<ul id="haberlerListe">
<?php foreach($cokOkunanlar as $i=>$haber){?>
	<li><a href="index.php?s=haber&haberid=<?=$haber['haberid']?>"><strong><?=stripslashes($haber['baslik'])?></strong><br /><?=stripslashes($haber['aciklama'])?></a></li>
<?php } ?>
</ul>
</div>