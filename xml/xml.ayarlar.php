<?php
// header
ob_start();
header("Content-Type: text/xml; charset=utf-8");

// dizin değiştir
chdir('./../');

// include
include_once('ayarlar.php');
include_once('include.php');

// utf-8 dönüştür
function utf8($yazi)
{
	$yazi	= mb_convert_encoding($yazi, "UTF-8");
	
	$bul 	= array('ð', 'þ', 'ý', 'Þ', 'Ý', 'Ð');
	$degis 	= array('ğ', 'ş', 'ı', 'Ş', 'İ', 'Ğ');
	$yazi	= str_replace($bul, $degis, $yazi);
	
	return $yazi;
}


// kategoriler
$sorgu	= mysql_query("
					  SELECT kid, kategori
					  FROM kategoriler
					  ORDER BY kategori ASC
					  ") or die(mysql_error());

$kategoriler = array();
while($veri = mysql_fetch_assoc($sorgu))
	$kategoriler[] = $veri;
	
@mysql_free_result($sorgu);

// xml
$xmlVeri 	 = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
$xmlVeri	.= "<veriler url=\"".utf8(SITE_URL)."\" baslik=\"".utf8(SITE_BASLIK)."\" slogan=\"".utf8(SITE_SLOGAN)."\">\n";
// kategorileri ekle
foreach($kategoriler as $i=>$kat)
{
	$xmlVeri .= "<kategori>\n";
	$xmlVeri .= "\t<kat>".stripslashes(utf8($kat['kategori']))."</kat>\n";
	$xmlVeri .= "\t<kid>".intval($kat['kid'])."</kid>\n";
	$xmlVeri .= "\t<link><![CDATA[index.php?s=kategoriler&kid=".intval($kat['kid'])."]]></link>\n";
	$xmlVeri .= "</kategori>\n";
}
$xmlVeri	.= "</veriler>";

// yazdır
echo $xmlVeri;
?>