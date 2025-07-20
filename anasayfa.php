<?php

// haberler
$sorgu	= mysql_query("
					  SELECT haberid, resim, baslik, aciklama, tarih
					  FROM haberler
					  WHERE durum = 1
					  ORDER BY haberid DESC
					  LIMIT 20
					  ") or die(mysql_error());

$haberler	= array();
$mansetler	= array();
$i = 0;
while($veri = mysql_fetch_array($sorgu))
{
	if($i < 10)
		$mansetler[] = $veri;
	else
		$haberler[]	= $veri;
	++$i;
}
?>
<!-- ana sayfa haberler -->
<div>
<!-- mansetler -->
<div id="manset">
	<div class="rd">
    <!--  her haberin resim ve açiklamasi gizli olarak sayfaya yükleniyor : display:none bunu belirtir. -->
    <?php foreach($mansetler as $i=>$haber){?>
    <div id="manset_rd_<?=$i?>" style="display:none">
    <a href="<?=SITE_URL?>/index.php?s=haber&haberid=<?=$haber['haberid']?>">
    	<div class="resim"><img src="<?=$haber['resim']?>" border="0" /></div>
        <div class="aciklama"><?=stripslashes($haber['aciklama'])?></div>
    </a>
    </div>
    <?php } ?>
    </div>
    <!-- burada ise basliklarin üstüne gelince mansetDegistir fonksiyonu çagirilir ve aktif haberin bilgileri gösterilir -->
    <div class="basliklar">
    <ul>
    	<?php foreach($mansetler as $i=>$haber){ ?>
        <li><a href="<?=SITE_URL?>/index.php?s=haber&haberid=<?=$haber['haberid']?>" onmouseover="mansetDegistir(<?=$i?>);"><?=stripslashes($haber['baslik'])?></a></li>
		<?php } ?>
    </ul>
    </div>
    <div class="clearFix"></div> 
</div>
<script type="text/javascript">mansetDegistir(0);</script>
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
</div>