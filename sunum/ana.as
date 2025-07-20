package
{
	// importlar
	import flash.display.MovieClip;
	import flash.events.*;
	
	import flash.net.URLLoader;
	import flash.net.URLRequest;
	import flash.net.navigateToURL;
	import flash.display.Loader;
	
	// ana sınıf
	public class ana extends MovieClip
	{
		// propertyler 
		private var xml:XML;
		private var urlReq:URLRequest;
		private var urlLoad:URLLoader;
		private var loader:Loader;
		private var obj:Object;
		
		private var siteBaslik:String;
		private var siteURL:String;
		private var siteSlogan:String;
		
		private var ayarlarXMLUrl:String	= "http://www.gokhandokuyucu.com/sahin/xml/xml.ayarlar.php";
		private var haberlerXMLUrl:String	= "http://www.gokhandokuyucu.com/sahin/xml/xml.haberler.php";
		
		private var ayarlarYuklendi:Boolean	= false;
		private var haberlerYuklendi:Boolean= false;
		
		private var kategorilerDizi:Array;
		private var haberlerDizi:Array;
		
		private var seciliKategori:Number	= 0;
		private var toplamHaber:Number		= 0;
		
		
		// kuruc fonksiyon
		public function ana():void
		{
			// kategorileri getir
			this.kategorileriYukle();
			
			// haberleri yükle
			this.haberlerYukle();
		}
		
		// kategorileri yükle
		private function kategorileriYukle():void
		{
			urlReq	= new URLRequest(this.ayarlarXMLUrl+"?rand="+Math.random());
			urlLoad	= new URLLoader(urlReq);
			urlLoad.addEventListener(Event.COMPLETE, kategoriXMLYuklendi);			
		}
		
		// kategoriler yüklendi ise
		private function kategoriXMLYuklendi(e:Event):void
		{
			xml	= XML(e.currentTarget.data);
			
			this.siteBaslik	= xml.attribute('baslik');
			this.siteSlogan	= xml.attribute('slogan');
			this.siteURL	= xml.attribute('url');
			
			// 
			ustMC.siteBaslikTxt.text	= this.siteBaslik;
			ustMC.siteSloganTxt.text	= this.siteSlogan;
			
			this.kategorilerDizi	= new Array();
			this.kategorilerDizi.push({kategori:"Ana Sayfa", kid:"0"});
			for(var i:Number = 0; i < xml.kategori.length(); i++)
			{
				obj	= new Object();
				obj.kategori	= xml.kategori[i].kat.text();
				obj.kid			= xml.kategori[i].kid.text();
				obj.link		= xml.kategori[i].link.text();
				
				this.kategorilerDizi.push(obj);
			}
			// kategorileri oluştur
			this.kategorileriOlustur();
		}
		
		// kategorileri oluştur
		private function kategorileriOlustur():void
		{
			kategorilerMC.yukleniyor.visible	= false;
			
			for(var i:Number = 0; i < this.kategorilerDizi.length; i++)
			{
				var kat:kategoriMC		= new kategoriMC();
				kat.kategoriTxt.text	= this.kategorilerDizi[i].kategori;
				
				kat.x = 10;
				kat.y = (kat.height + 3) * i + 10;
				kat.index	= i;
				kat.name	= kat.kategoriTxt.text;
				
				// mouse
				kat.kArka.stop();
				kat.addEventListener(MouseEvent.MOUSE_OVER, katMouseOver);
				kat.addEventListener(MouseEvent.MOUSE_OUT, katMouseOut);
				kat.addEventListener(MouseEvent.CLICK, kategoriClick);
				
				kategorilerMC.addChild(kat);
			}
		}
		
		// kategori mouse olaylar
		private function kategoriClick(e:MouseEvent):void
		{
			var idx:Number	= e.currentTarget.index;
			var kid:Number	= this.kategorilerDizi[idx].kid;
			
			trace(kid);
			this.seciliKategori	= kid;
			
			haberlerMC.yukleniyor.visible	= true;
			haberlerMC.kategoriAdiTxt.text	= e.currentTarget.name;
			
			// haberleri temizle
			if(haberlerMC.innerMC.numChildren > 0)
				haberlerMC.innerMC.removeChildAt(0);
			// haberleri yükle
			this.haberlerYukle();
		}
		
		private function katMouseOver(e:MouseEvent):void
		{
			var kat:kategoriMC	= e.currentTarget as kategoriMC;
			kat.kArka.gotoAndPlay("mouseOver");
		}
		private function katMouseOut(e:MouseEvent):void
		{
			var kat:kategoriMC	= e.currentTarget as kategoriMC;
			kat.kArka.gotoAndPlay("mouseOut");
		}
		
		// haberleri yükle
		private function haberlerYukle()
		{
			this.haberlerDizi	= new Array();
			var url:String		= this.haberlerXMLUrl+"?kid="+this.seciliKategori+"&rand="+Math.random();
			
			urlReq	= new URLRequest(url);
			urlLoad	= new URLLoader(urlReq);
			urlLoad.addEventListener(Event.COMPLETE, haberXMLYuklendi);
		}
		
		// haberler xml yüklendi
		private function haberXMLYuklendi(e:Event):void
		{
			xml	= XML(e.currentTarget.data);
			
			for(var i:Number = 0; i < xml.haber.length(); i++)
			{
				obj	= new Object();
				obj.haberid	= xml.haber[i].haberid.text();
				obj.baslik	= xml.haber[i].baslik.text();
				obj.aciklama= xml.haber[i].aciklama.text();
				obj.resim	= xml.haber[i].resim.text();
				obj.link	= xml.haber[i].link.text();
				
				this.haberlerDizi.push(obj);
			}
			
			// 
			this.haberleriOlustur();
		}
		
		// haberleri oluştur
		private function haberleriOlustur():void
		{
			var mc:MovieClip	= new MovieClip();
			
			for(var i:Number = 0; i < this.haberlerDizi.length; i++)
			{
				var hbr:haberMC	= new haberMC();
				hbr.baslikTxt.text		= this.haberlerDizi[i].baslik;
				hbr.aciklamaTxt.text	= this.haberlerDizi[i].aciklama;
				hbr.resimYukle(this.haberlerDizi[i].resim);
				
				hbr.y	= (hbr.height + 7) * i;
				hbr.index	= i;
				
				// mouse
				hbr.hArka.stop();
				hbr.addEventListener(MouseEvent.MOUSE_OVER, hbrMouseOver);
				hbr.addEventListener(MouseEvent.MOUSE_OUT, hbrMouseOut);
				hbr.addEventListener(MouseEvent.CLICK, hbrClick);
				
				// ekle
				mc.addChild(hbr);
			}
			// haberlere ekle mc
			haberlerMC.innerMC.addChildAt(mc, 0);
			haberlerMC.yukleniyor.visible	= false;
		}
		
		// haber mouse olayları
		private function hbrMouseOver(e:MouseEvent):void
		{
			var hbr:haberMC	= e.currentTarget as haberMC;
			hbr.hArka.gotoAndPlay("mouseOver");
		}
		private function hbrMouseOut(e:MouseEvent):void
		{
			var hbr:haberMC	= e.currentTarget as haberMC;
			hbr.hArka.gotoAndPlay("mouseOut");
		}
		private function hbrClick(e:MouseEvent):void
		{
			var idx:Number	= e.currentTarget.index;
			var url:URLRequest	= new URLRequest(this.siteURL+"/"+this.haberlerDizi[idx].link);
			// linke git
			navigateToURL(url, "_blank");
		}
	}
}