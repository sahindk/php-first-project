<?php
// header
ob_start();
header("Content-Type: text/xml; charset=utf-8");

// dizin değiştir
chdir('./../');

// include
include_once('ayarlar.php');
include_once('include.php');

// parametre al
$kid	= intval($_GET['kid']);

// utf-8 dönüştür
function utf8($yazi)
{
	$yazi	= mb_convert_encoding($yazi, "UTF-8");
	
	$bul 	= array('ð', 'þ', 'ý', 'Þ', 'Ý', 'Ð');
	$degis 	= array('ğ', 'ş', 'ı', 'Ş', 'İ', 'Ğ');
	$yazi	= str_replace($bul, $degis, $yazi);
	
	return $yazi;
}

// haberler
$sql	= "SELECT h.haberid, h.baslik, h.aciklama, h.resim, k.kategori
		  FROM haberler AS h, kategoriler AS k
		  WHERE h.kid = k.kid
		  ".($kid ? ' AND h.kid = '.$kid : '')."
		  ORDER BY h.haberid DESC
		  LIMIT 5
		  ";

// kayıtlar
$sorgu		= mysql_query($sql) or die(mysql_error());

$haberler 	= array();
while($veri = mysql_fetch_assoc($sorgu))
	$haberler[] = $veri;
	
@mysql_free_result($sorgu);

// xml
$xmlVeri 	 = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
$xmlVeri	.= "<veriler>\n";

// haberleri xml e ekle
foreach($haberler as $i=>$haber)
{
	$xmlVeri .= "<haber>\n";
	$xmlVeri .= "\t<haberid>".stripslashes(utf8($haber['haberid']))."</haberid>\n";
	$xmlVeri .= "\t<baslik>".stripslashes(utf8($haber['baslik']))."</baslik>\n";
	$xmlVeri .= "\t<kategori>".stripslashes(utf8($haber['kategori']))."</kategori>\n";
	$xmlVeri .= "\t<aciklama><![CDATA[".stripslashes(utf8($haber['aciklama']))."]]></aciklama>\n";
	$xmlVeri .= "\t<resim>".stripslashes(utf8($haber['resim']))."</resim>\n";
	$xmlVeri .= "\t<link><![CDATA[index.php?s=haber&haberid=".intval($haber['haberid'])."]]></link>\n";
	$xmlVeri .= "</haber>\n";
}

$xmlVeri	.= "</veriler>";

// yazdır
echo $xmlVeri;
?>