<?php

/**
 * veritabani baglantisi
 */
$vt	= mysql_connect(VT_HOST, VT_KULLANICI, VT_SIFRE) or die("Veritabani Baglanti Hatasi");
mysql_select_db(VT_ADI, $vt) or die("Veritabani Seçilemedi");

/**
 * sql karakter seti
 */
mysql_query("SET NAMES latin1");
?>