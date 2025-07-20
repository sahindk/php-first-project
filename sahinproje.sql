/*
MySQL Data Transfer
Source Host: localhost
Source Database: sahinproje
Target Host: localhost
Target Database: sahinproje
Date: 22.03.2010 23:27:20
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for haberler
-- ----------------------------
DROP TABLE IF EXISTS `haberler`;
CREATE TABLE `haberler` (
  `haberid` int(11) NOT NULL auto_increment,
  `kid` int(11) NOT NULL default '0',
  `baslik` varchar(100) default NULL,
  `aciklama` varchar(200) default NULL,
  `detay` mediumtext,
  `resim` varchar(100) default NULL,
  `hit` int(11) NOT NULL default '0',
  `tarih` int(11) default NULL,
  `durum` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`haberid`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for kategoriler
-- ----------------------------
DROP TABLE IF EXISTS `kategoriler`;
CREATE TABLE `kategoriler` (
  `kid` int(11) NOT NULL auto_increment,
  `kategori` varchar(100) default NULL,
  PRIMARY KEY  (`kid`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `haberler` VALUES ('1', '1', 'Haber Basligi Buraya Gelecek', 'Haber aciklama haber aciklama haber aciklama haber aciklama haber aciklama', null, 'haber.jpg', '4', '2010', '1');
INSERT INTO `haberler` VALUES ('2', '1', 'Haber Basligi Buraya Gelecek', 'Haber aciklama haber aciklama haber aciklama haber aciklama haber aciklama', null, 'haber.jpg', '1', '2010', '1');
INSERT INTO `haberler` VALUES ('3', '1', 'Haber Basligi Buraya Gelecek', 'Haber aciklama haber aciklama haber aciklama haber aciklama haber aciklama', null, 'haber.jpg', '0', '2010', '1');
INSERT INTO `haberler` VALUES ('4', '1', 'Haber Basligi Buraya Gelecek', 'Haber aciklama haber aciklama haber aciklama haber aciklama haber aciklama', null, 'haber.jpg', '1', '2010', '1');
INSERT INTO `haberler` VALUES ('5', '1', 'Haber Basligi Buraya Gelecek', 'Haber aciklama haber aciklama haber aciklama haber aciklama haber aciklama', null, 'haber.jpg', '0', '2010', '1');
INSERT INTO `haberler` VALUES ('6', '4', 'Türkiye\\\'ye giren hangi besin GDO\\\'lu?', 'Ziraat Mühendisleri Odasý (ZMO) Baþkaný Gökhan Günaydýn, 72 milyonu aþmýþ nüfusu düþünüldüðü zaman Türkiye&#8217;nin buðday üretimini 25 milyon tona çýkartmasý, bunun için de yeterli sulama yatýrýmý y', 'Ziraat Mühendisleri Odasý (ZMO) Baþkaný Gökhan Günaydýn, 72 milyonu aþmýþ nüfusu düþünüldüðü zaman Türkiye&#8217;nin buðday üretimini 25 milyon tona çýkartmasý, bunun için de yeterli sulama yatýrýmý yapmasý gerektiðini bildirdi.\r\n\r\nZMO ve Türkiye Sulama Kooperatifleri Merkez Birliði (TÜSKOOP-BÝR) tarafýndan ortaklaþa düzenlenen &#8216;Dünyada ve Türkiye&#8217;de Su: Gündemi ve Geleceði Yönetmek&#8217; konulu sempozyum, Baþkent Öðretmenevi konferans salonunda gerçekleþtirildi.\r\n\r\nTürkiye\\\'ye giren hangi besin GDO\\\'lu?\r\n\r\nSempozyumun açýlýþýnda konuþan ZMO Baþkaný Gökhan Günaydýn, 9. Cumhurbaþkaný Süleyman Demirel&#8217;in su konusunda konferans vereceði sempozyumda, bu konuyla ilgili konuþmak istemediðini ve Türk tarýmýnýn resmini çizmekle yetineceðini söyledi.\r\n\r\n78 milyon hektar yüz ölçümüne sahip, 72 milyon kiþinin yaþadýðý Türkiye&#8217;de tarýmýn hak ettiði yeri alamadýðýný savunan Günaydýn, böylesine zengin bir biyolojik çeþitliliðe sahip ülkede özellikle temel ürünlerde üretime önem verilmesi vurguladý.\r\n\r\nBugün Türkiye&#8217;de yýllýk yaklaþýk 20 milyon ton buðday üretildiðini, olaðan yýllarda 1 milyon ton, kuraklýk görülen yýllarda ise 2,5-3 milyon ton buðday ithalatý yapýldýðýna iþaret eden ZMO Baþkaný, &#8216;72 milyonu aþmýþ nüfusu düþünüldüðü zaman Türkiye&#8217;nin buðday üretimini 25 milyon tona çýkarmasý gerekiyor. Bunun için Konya gibi bölgelerde sulama yatýrýmlarý yapýlmalý. Fakat yýlda 40 bin hektarýn altýnda olan sulama yatýrýmlarýyla bu üretim miktarýna ulaþýlmasý mümkün deðil&#8217; dedi.\r\n\r\n-&#8217;TÜRKÝYE&#8217;YE GDO&#8217;LU PÝRÝNÇ GÝRÝYOR&#8217;\r\n\r\nTürkiye&#8217;nin yýlda 1,5 milyon ton civarýnda mýsýr, 1,5 milyon ton civarýnda soya ithal ettiðini, pamuk ithalatýna 1 milyar dolar ödediðini anlatan Günaydýn, büyükbaþ hayvan sayýsýnýn 16 milyondan 11 milyona düþtüðünü, kümes hayvaný varlýðýnda ise biraz artýþ olduðunu bildirdi.\r\n\r\nTürkiye&#8217;de yýllýk süt üretiminin 12,2 milyon tona kadar çýktýðýný, kiþi baþý süt tüketiminin yýllýk 17 litre olduðuna dikkati çeken Günaydýn, AB ortalamanýn ise yýllýk 110 litre olduðunu ve bu ortalamayý yakalamak için süt üretiminin 4&#8242;e, 5&#8242;e katlamak gerektiðini söyledi.\r\n\r\nTarým ürünleri ithalat ve ihracat rakamlarýnýn baþa baþ olduðunu, dýþarýdan ithal edilen ham maddelerin iþlenerek satýldýðýný belirten Günaydýn, &#8216;Kendi gýda ham maddemizi bu kadar geniþ topraklarda neden karþýlayamýyoruz?&#8217; dedi.\r\n\r\nGünaydýn, &#8216;Türkiye&#8217;ye GDO&#8217;lu pirinç girdiðini bilmezdik, yapýlan analizler Türkiye&#8217;ye GDO&#8217;lu pirinç girdiðini gösterdi&#8217; diye konuþtu. ZMO Baþkaný þöyle devam etti:\r\n\r\n&#8216;Þeker pancarý üretimimiz 18 milyon tondan 16,3 milyon tona kadar düþtü. 25 kamu þeker fabrikasýný devreden çýkartýrsak, kar ve zarar eden fabrikalarý ayný sepete koyarsanýz özelleþtirme sonrasý bu fabrikalarýn en az 15 tanesi kapatýlýr. Bu da Türkiye&#8217;nin þeker fabrikasý üretiminin yabancýlarýn eline geçmesi demektir. Biz ZMO olarak þeker fabrikalarýmýza dokundurtmamak için için elimizden geleni yapacaðýz.&#8217;\r\n\r\n-TÜSKOOP-BÝR BAÞKANI UYSAL\r\n\r\nSempozyumun açýlýþýnda konuþan TÜSKOOP-BÝR Genel Baþkaný Halis Uysal ise sulama kooperatiflerinin, yer altýndan suyu pompalarla çektiðini, bu nedenle kullandýklarý elektrikten dolayý 2 milyar lirayý aþkýn borçlarý bulunduðunu ve borç nedeniyle pompalarýn kapalý olduðunu söyledi.\r\n\r\nSöz konusu borçlarýn yeniden yapýlandýrýlmasý konusunda hükümet ve TEDAÞ yetkilileriyle görüþtüklerini belirten Uysal, &#8216;Yeniden yapýlanma ile faizlerin kaldýrýlýp ana paranýn 3 sene içerisinde asgari 2 taksit þeklinde ödenmesi konusunda öneride bulunduk. Birliðimize baðlý kooperatiflerdeki çiftiler büyük beklenti içerisinde. Bu konunun en kýsa sürede açýklýða kavuþturulmasýný istiyoruz&#8217; dedi.', 'haber.jpg', '0', '2010', '1');
INSERT INTO `haberler` VALUES ('7', '1', 'Haber Basligi Buraya Gelecek', 'Haber aciklama haber aciklama haber aciklama haber aciklama haber aciklama', null, 'haber.jpg', '1', '2010', '1');
INSERT INTO `haberler` VALUES ('9', '2', 'Sallama Haber Baþlýðý', 'Sallama Haber Baþlýðý asd asd', 'Sallama Haber Baþlýðý asd asd', '1', '0', '0', '1');
INSERT INTO `haberler` VALUES ('11', '7', 'sahin', 'sahin', 'sahin', 'sadsadsa', '0', '1269199292', '1');
INSERT INTO `haberler` VALUES ('13', '4', 'Dünyanýn en eski bilgisayarý-M.Ö.87', 'Milattan öncesinden kalma ama inanýlmaz: Ýþte sýrrý ancak 110 yýlda çözülen &#8220;antik bilgisayar&#8221;&#8230;\r\n\r\n1900 yýlýnda Ege Denizi&#8217;nde bulunan gizemli bir mekanik cihazýn ne olduðu gün', 'Bir Roma batýðýnda bulunan ve karaya çýkartýlan eþyalar arasýnda hasar görmüþ bir makine bulundu. Ýçinde irili ufaklý çarklar olan bu karmaþýk mekanizma zamanýn etkisiyle çok yýpranmýþtý ve ne iþe yaradýðýný çözmek, üzerindeki antik Yunanca yazýlarý okumak mümkün olmamýþtý.\r\n\r\nMilattan önce 87 yýlýndan kalma bu cihazý, zamanýnda sahip olduðuna inanýlan teknolojinin çok ötesinde ve kimin yaptýðý bilinmiyor. Bu cihazýn gizemleri ancak geliþmiþ X ýþýnlarý, farklý ýþýk türleri ve þekilleri ile taranarak yakýn zamanda çözüldü.\r\n\r\n3D modellemesi yapýlan ve çarklarýn üzerindeki talimatlar okunan aracýn gelgit zamanlarýný mükemmel bir þekilde hesaplayabildiðini ortaya koydu.\r\n\r\nBununla da kalmýyor, artýk yýllarý da hesaba katýyor, Ay&#8217;ýn, Güneþ&#8217;in ve Mars, Jüpiter, Satürn gibi gezegenlerin konumunu doðru hesaplayabiliyor.\r\n\r\nÝçindeki bir küçük göstergede ise Olimpiyatlar gibi önemli olaylarýn tarihleri gösteriliyor. Farklý iþlevler yandaki kol çevrilerek kullanýlabiliyor. 2087 yýllýk bu antik bilgisayar, aslýnda etkileyici bir astronomik hesap makinesi&#8230;', 'http://www.hurriyet.com.tr/_np/8144/10138144.jpg', '19', '1269290542', '1');
INSERT INTO `kategoriler` VALUES ('1', 'Yazilim');
INSERT INTO `kategoriler` VALUES ('2', 'Donanim');
INSERT INTO `kategoriler` VALUES ('3', 'Teknoloji');
INSERT INTO `kategoriler` VALUES ('4', 'Genel');
INSERT INTO `kategoriler` VALUES ('5', 'Internet');
INSERT INTO `kategoriler` VALUES ('6', 'Oyun');
INSERT INTO `kategoriler` VALUES ('7', 'Saðlýk');
INSERT INTO `kategoriler` VALUES ('8', 'Telefon');
INSERT INTO `kategoriler` VALUES ('10', 'Test');
