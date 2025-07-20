<?php

/**
 * tarih dönüstürme fonk.
 */
function tarihDonustur($tarih, $tur = 0)
{
	// günler
	$gunler	= array('Pazar', 'Pazartesi', 'Sal&#305;', 'Çar&#351;amba', 'Per&#351;embe', 'Cuma', 'Cumartesi');
	// aylar
	$aylar	= array(NULL, 'Ocak', '&#350;ubat', 'Mart', 'Nisan', 'May&#305;s', 'Haziran', 'Temmuz', 'A&#287;ustos', 
						  'Eylül', 'Ekim', 'Kas&#305;m', 'Aral&#305;k');
	
	$ay	= date("m", $tarih);
	$ay	= $ay < 10 ? str_replace("0", "", $ay) : $ay;
	
	if($tur == 1)
		$trh	= date("d", $tarih)." ".$aylar[$ay]." ".date("Y", $tarih)." ".$gunler[date("w", $tarih)];
	else
		$trh	= date("d", $tarih)." ".$aylar[$ay]." ".date("Y", $tarih)." ".$gunler[date("w", $tarih)]." - ".date("H:i", $tarih);
		
	
	return $trh;
}

/**
 * sayfalama fonksiyonu
 **/
function sayfalama($url, $toplam, $limit = 10, $no = 0)
{
	if($toplam)
	{
		$toplamSayfa	= ceil($toplam / $limit);
		
		// sayfalama degiskeni
		$sayfalama	 = '<div class="sayfalama">';
		
		if($toplamSayfa == 1)
			$sayfalama	.= 'Sayfa 1';
		else
		{
			$sayfalama .= '<ul>';
			for($i = 0; $i < $toplamSayfa; $i++)
			{
				if($no == $i)
					$sayfalama .= '<li class="secili">'.($i+1).'</li>';
				else
					$sayfalama .= '<li><a href="'.$url.'&no='.$i.'">'.($i+1).'</a></li>';	
			}
			$sayfalama .= '</ul>';
		}
		
		$sayfalama	.= '<div class="clearFix"></div></div>';
		
		// fonk. sonucu gönder
		return $sayfalama;
	}
}

?>