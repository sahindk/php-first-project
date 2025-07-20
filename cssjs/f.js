
/* manşet değiştirme */
function mansetDegistir(no)
{
	var toplam = 10;
	
	for(var i = 0; i < toplam; i++)
	{
		// üstüne gelen haber bu ise displayi block yap görünsün
		if(i == no)
			document.getElementById('manset_rd_'+i).style.display = 'block';
		else // değilse display i pasif yap görünmesin
			document.getElementById('manset_rd_'+i).style.display = 'none';
	}
	
	return false;
}

function favorilereEkle()
{
	var baslik	= "Sahin Dokuyucu"; 
	var url 	= "http://www.gokhandokuyucu.com/sahin";

	if (window.sidebar) { // Mozilla Firefox Bookmark
		window.sidebar.addPanel(baslik, url,"");
	} else if( window.external ) { // IE Favorite
		window.external.AddFavorite( url, baslik); }
	else if(window.opera && window.print) { // Opera Hotlist
		return true; }
}