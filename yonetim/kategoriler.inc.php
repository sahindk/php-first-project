<?php

// deðiskenler
$islem		= strip_tags(addslashes($_REQUEST['islem']));
$kid		= intval($_REQUEST['kid']);

// islemleri yapalim
switch($islem)
{
	case 'ekle':
	case 'duzenle':
		
		if($islem == 'duzenle')
		{
			$sorgu	= mysql_query("
								  SELECT kategori
								  FROM kategoriler
								  WHERE kid = ".$kid."
								  ") or die(mysql_error());	
			
			$veri	= mysql_fetch_array($sorgu);
			
			$kategori		= $veri['kategori'];
			
			$bolumBaslik	= "KATEGORI DÜZENLE";
		}
		else
		{
			$bolumBaslik	= "KATEGORI EKLE";
		}
		
		if($_POST)
		{
			$kategori		= strip_tags(addslashes($_POST['kategori']));	
			
			// hata kontrolü
			$hatalar = array();
			if(!$kategori)
				$hatalar[]	= "Lütfen Kategori Giriniz";
				
			// hata yoksa
			if(!$hatalar)
			{
				if($islem == 'duzenle')
				{
					mysql_query("
								UPDATE kategoriler SET
								kategori = '".$kategori."'
								WHERE kid = ".$kid."
								") or die(mysql_error());	
				}
				else
				{
					mysql_query("
								INSERT INTO kategoriler
								(kategori)
								VALUES
								(
								 '".$kategori."'
								 )
								") or die(mysql_error());	
				}
				
				echo "<script type=\"text/javascript\">alert('Isleminiz Basariyla Gerçeklestirildi.'); 
													   location = './index.php?s=kategoriler'</script>";
				exit;
			}
			
		}
	
	break;
	
	// silme islemi
	case 'sil':
		if($kid)
		{
			mysql_query("DELETE FROM kategoriler WHERE kid = ".intval($kid)) or die(mysql_error());
			mysql_query("DELETE FROM haberler WHERE kid = ".intval($kid)) or die(mysql_error());
		}
		
		echo "<script type=\"text/javascript\">alert('Kayit Basariyla Silindi.'); location = './index.php?s=kategoriler'</script>";
	break;
	
	// listeleme
	default:
	
		$bolumBaslik	= "kategoriler";
	
		$sorgu	= mysql_query("
							  SELECT kid, kategori
							  FROM kategoriler
							  ORDER BY kid DESC
							  ") or die(mysql_error());
		
		$kategoriler	= array();
		while($veri = mysql_fetch_array($sorgu))
			$kategoriler[]	= $veri;
	
	break;
	
}
?>
<!-- bölüm baslik -->
<div class="bolum-baslik"><?php echo $bolumBaslik; ?></div>
<!-- listeleme -->
<?php if($islem == 'listele' || !$islem){ ?>
<div style="margin:5px 0; padding:5px 0; "><a href="index.php?s=kategoriler&islem=ekle" class="ekle">Yeni Kay&#305;t Ekle</a></div>
<div class="kayitlar">
<table cellpadding="0" cellspacing="1" width="100%" border="0">
<tr class="ust">
	<td width="10%" align="center">ID</td>
	<td width="70%">Kategori</td>
	<td width="20%">Islemler</td>
</tr>
<?php foreach($kategoriler as $i=>$veri){?>
<tr class="<?php echo ($i%2 == 1) ? 'satir1' : 'satir2';?>">
	<td align="center"><?=$veri['kid']?></td>
	<td><?=stripslashes($veri['kategori'])?></td>
	<td><a href="index.php?s=kategoriler&islem=duzenle&kid=<?=$veri['kid']?>">Düzenle</a> | <a href="index.php?s=kategoriler&islem=sil&kid=<?=$veri['kid']?>" onClick="return confirm('#<?=$veri['kid']?> ID\'li kayiti silmek istediginize emin misiniz ?');">Sil</a></td>
</tr>
<?php } ?>
</table>
</div>
<!-- düzenleme ve ekleme formu -->
<?php }elseif($islem == 'duzenle' || $islem == 'ekle'){ ?>
<div class="form">
<?php if(isset($hatalar) && $hatalar){?>
<div class="hatalar">
<strong>islem s&#305;ras&#305;nda asag&#305;daki hata(lar) olustu.</strong><br /><br />
<ul>
<?php foreach($hatalar as $i=>$hata){ ?>
	<li><?=($i+1)?>. <?=$hata?></li>
<?php } ?>
</ul>
</div>
<?php } ?>
<form method="post">
<input type="hidden" value="<?=$islem?>" name="islem">
<input type="hidden" value="<?=$kid?>" name="kid">
	<table cellpadding="0" cellspacing="0" width="100%" border="0">
    <tr>
    	<td class="alan">Kategori</td>
    	<td class="alan">:</td>
        <td><input type="text" name="kategori" id="kategori" size="40" value="<?=stripslashes($kategori)?>" /></td>
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