<?php

// deðiþkenler
$islem		= strip_tags(addslashes($_REQUEST['islem']));
$haberid	= intval($_REQUEST['haberid']);

// kategori
$sorgu	= mysql_query("
					  SELECT kid, kategori
					  FROM kategoriler
					  ORDER BY kategori ASC
					  ") or die(mysql_error());

$kategoriler = array();
while($veri = mysql_fetch_array($sorgu))
	$kategoriler[]	= $veri;

// iþlemleri yapalým
switch($islem)
{
	case 'ekle':
	case 'duzenle':
		
		if($islem == 'duzenle')
		{
			$sorgu	= mysql_query("
								  SELECT baslik, kid, aciklama, detay, resim, durum
								  FROM haberler
								  WHERE haberid = ".$haberid."
								  ") or die(mysql_error());	
			
			$veri	= mysql_fetch_array($sorgu);
			
			$baslik		= $veri['baslik'];
			$kid		= $veri['kid'];
			$aciklama	= $veri['aciklama'];
			$detay		= $veri['detay'];
			$resim		= $veri['resim'];
			$durum		= $veri['durum'];
			
			$bolumBaslik	= "HABER DÜZENLE";
		}
		else
		{
			$durum = 1;
			
			$bolumBaslik	= "HABER EKLE";
		}
		
		if($_POST)
		{
			$baslik		= strip_tags(addslashes($_POST['baslik']));	
			$kid		= intval($_POST['kid']);	
			$durum		= intval($_POST['durum']);	
			$aciklama	= strip_tags(addslashes($_POST['aciklama']));	
			$detay		= strip_tags(addslashes($_POST['detay']));	
			$resim		= strip_tags(addslashes($_POST['resim']));
			
			// hata kontrolü
			$hatalar = array();
			if(!$kid)
				$hatalar[]	= "Lütfen Kategori Seçiniz";
			if(!$baslik)
				$hatalar[]	= "Lütfen Ba&#351;l&#305;k Giriniz";
			if(!$aciklama)
				$hatalar[]	= "Lütfen Aç&#305;klama Giriniz";
			if(!$detay)
				$hatalar[]	= "Lütfen Detay Giriniz";
				
			// hata yoksa
			if(!$hatalar)
			{
				if($islem == 'duzenle')
				{
					mysql_query("
								UPDATE haberler SET
								kid = '".$kid."',
								baslik = '".$baslik."',
								aciklama = '".$aciklama."',
								detay = '".$detay."',
								durum = '".$durum."',
								resim = '".$resim."'
								WHERE haberid = ".$haberid."
								") or die(mysql_error());	
				}
				else
				{
					mysql_query("
								INSERT INTO haberler
								(kid, baslik, aciklama, detay, resim, durum, tarih)
								VALUES
								(
								 '".$kid."',
								 '".$baslik."',
								 '".$aciklama."',
								 '".$detay."',
								 '".$resim."',
								 '".$durum."',
								 '".time()."'
								 )
								") or die(mysql_error());	
				}
				
				echo "<script type=\"text/javascript\">alert('&#304;&#351;leminiz Baþarýyla Gerçekle&#351;tirildi.'); 
													   location = './index.php?s=haberler'</script>";
				exit;
			}
			
		}
	
	break;
	
	// silme iþlemi
	case 'sil':
		if($haberid)
			mysql_query("DELETE FROM haberler WHERE haberid = ".intval($haberid)) or die(mysql_error());
		
		echo "<script type=\"text/javascript\">alert('Kayýt Ba&#351;ar&#305;yla Silindi.'); location = './index.php?s=haberler'</script>";
	break;
	
	// listeleme
	default:
	
		$bolumBaslik	= "HABERLER";
	
		$sorgu	= mysql_query("
							  SELECT h.haberid, h.baslik, h.tarih, h.durum, k.kategori
							  FROM haberler h
							  LEFT JOIN kategoriler k ON h.kid = k.kid
							  ORDER BY h.haberid DESC
							  ") or die(mysql_error());
		
		$haberler	= array();
		while($veri = mysql_fetch_array($sorgu))
			$haberler[]	= $veri;
	
	break;
	
}
?>
<!-- bölüm baþlýk -->
<div class="bolum-baslik"><?php echo $bolumBaslik; ?></div>
<!-- listeleme -->
<?php if($islem == 'listele' || !$islem){ ?>
<div style="margin:5px 0; padding:5px 0; "><a href="index.php?s=haberler&islem=ekle" class="ekle">Yeni Kayit Ekle</a></div>
<div class="kayitlar">
<table cellpadding="0" cellspacing="1" width="100%" border="0">
<tr class="ust">
	<td width="10%" align="center">ID</td>
	<td width="20%">Kategori</td>
	<td width="30%">Baslik</td>
	<td width="15%" align="center">Tarih</td>
	<td width="10%" align="center">Durum</td>
	<td width="15%">is&#351;lemler</td>
</tr>
<?php foreach($haberler as $i=>$veri){?>
<tr class="<?php echo ($i%2 == 1) ? 'satir1' : 'satir2';?>">
	<td align="center"><?=$veri['haberid']?></td>
	<td><?=stripslashes($veri['kategori'])?></td>
	<td><?=stripslashes($veri['baslik'])?></td>
	<td align="center"><?=date("d.m.Y H:i", $veri['tarih'])?></td>
	<td align="center"><?php echo $veri['durum'] ? '<span class="aktif">Aktif</span>' : '<span class="pasif">Pasif</span>'; ?></td>
	<td><a href="index.php?s=haberler&islem=duzenle&haberid=<?=$veri['haberid']?>">Düzenle</a> | <a href="index.php?s=haberler&islem=sil&haberid=<?=$veri['haberid']?>" onClick="return confirm('#<?=$veri['haberid']?> ID\'li kayýtý silmek istediðinize emin misiniz ?');">Sil</a></td>
</tr>
<?php } ?>
</table>
</div>
<!-- düzenleme ve ekleme formu -->
<?php }elseif($islem == 'duzenle' || $islem == 'ekle'){ ?>
<div class="form">
<?php if(isset($hatalar) && $hatalar){?>
<div class="hatalar">
<strong>&#304;&#351;lem s&#305;ras&#305;nda a&#351;a&#287;&#305;daki hata(lar) olu&#351;tu.</strong><br /><br />
<ul>
<?php foreach($hatalar as $i=>$hata){ ?>
	<li><?=($i+1)?>. <?=$hata?></li>
<?php } ?>
</ul>
</div>
<?php } ?>
<form method="post">
<input type="hidden" value="<?=$islem?>" name="islem">
<input type="hidden" value="<?=$haberid?>" name="haberid">
	<table cellpadding="0" cellspacing="0" width="100%" border="0">
    <tr>
    	<td class="alan" width="20%">Kategori</td>
    	<td class="alan" width="10">:</td>
        <td width="80%"><select name="kid" id="kid">
    	<option selected="selected" value="">= Kategori Seçiniz =</option>
        <?php foreach($kategoriler as $i=>$kat){?>
        <option value="<?=$kat['kid']?>"<?php if($kid == $kat['kid']) echo ' selected';?>><?=stripslashes($kat['kategori'])?></option>
		<?php } ?>
    </select></td>
    </tr>
    <tr>
    	<td colspan="3" class="ara"></td>
    </tr>
    <tr>
    	<td class="alan">Ba&#351;l&#305;k</td>
    	<td class="alan">:</td>
        <td><input type="text" name="baslik" id="baslik" size="40" value="<?=stripslashes($baslik)?>" /></td>
    </tr>
    <tr>
    	<td colspan="3" class="ara"></td>
    </tr>
    <tr>
    	<td class="alan">Aç&#305;klama</td>
    	<td class="alan">:</td>
        <td><textarea name="aciklama" cols="60" rows="2" id="aciklama"><?=stripslashes($detay)?></textarea></td>
    </tr>
    <tr>
    	<td colspan="3" class="ara"></td>
    </tr>
    <tr>
    	<td class="alan">Resim</td>
    	<td class="alan">:</td>
        <td><input type="text" name="resim" id="resim" size="40" value="<?=stripslashes($resim)?>" /></td>
    </tr>
    <tr>
    	<td colspan="3" class="ara"></td>
    </tr>
    <tr>
    	<td class="alan">Detay</td>
    	<td class="alan">:</td>
        <td><textarea name="detay" cols="80" rows="7" id="detay"><?=stripslashes($detay)?></textarea></td>
    </tr>
    <tr>
    	<td colspan="3" class="ara"></td>
    </tr>
    <tr>
    	<td class="alan">Durum</td>
    	<td class="alan">:</td>
        <td><input type="radio" name="durum" value="1" <?php if($durum == 1) echo 'checked' ?>> Aktif <input type="radio" name="durum" value="0" <?php if($durum == 0) echo 'checked' ?>> Pasif </td>
    </tr>
    <tr>
    	<td colspan="3" class="ara"></td>
    </tr>
    <tr>
    	<td class="alan"></td>
    	<td class="alan"></td>
        <td><input type="submit" value="Gönder" class="buton"></td>
    </tr>
    </table>
</form>
</div>
<?php } ?>