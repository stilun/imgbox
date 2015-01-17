#MY IMAGEGBOX

Detta är senaste versionen utav ImageBox. Skapat av Stig Lundmark, stig@stilun.de, 
som en del i kursen "JavaScript, jQuery och AJAX, HTML5, PHP" på Blekinge Tekniska Högskola.

##Installation

* Kunskaper i HTML, CSS, PHP och JQUERY
* JavaScript tillåts i webbläsare
* Nyaste versionen utav FireFox.`

###Filer i paketet
```
README.md - Filen du läser nu!
index.php - php-kod, samt presentations- och exempelsida.
CImages.php - Klassbibliotek för ImageBox-sidans funktionaliteter.
img/ - innehåller katalogerna lightbox, gallery samt slideshow med en del exempelbilder.
js/ - katalog som innehåller viktiga javascript-filer.
js/jquery.js - Innehåller jquery-bibloteket.
js/less.js - Kompilerar less till css.
js/main.js - Imnnehåller den JavaScrip-kod som styr ImageBoxen.
less/ - katalog som innehåller viktiga less-filer.
less/style.less - innehåller less/css kod som stylar hemsidan. Här redigeras designkoden.
```
###Ladda hem och packa upp

Klona applikationen från GitHub: `git clone https://github.com/stilun/imgbox`, eller ladda hem zip-versionen. 
Navigera till din imgbox-katalog och ladda upp denna till din utvecklingsserver. 
__Ge katalogerna `img/gallery/, img/lightbox/ och img/slideshow/` filrättigheterna chmod 777__.

För att kunna använda applikationen måste du lägga till följande kod i sidhuvudet:
```
<link rel="stylesheet/less" type="text/css" href="less/style.less">
<script src="js/less.js"></script>
```
Vidare måste du lägga in följande kod i sidfoten:
```
<script src="js/jquery.js"></script>
<script src="js/main.js"></script>
```
Eftersom en del av funktionaliteten ligger i klassbibliotektet `CImages.php` måste du lägga in följande kod någonstans i början av sidan:
```PHP
<?php
require_once('CImages.php');
$img = new CImages();
if (isset($_POST['delete'])) $img->DeleteImage();
if (isset($_POST['upload'])) $img->UploadImages();
?>
```

###Lightbox

För att lägga in lightboxen lägger du här in följande kod som genererar bilderna:
```PHP
<?php 
echo $img->GetImages();
?>
```
Du kan också lägga till en lightbox till vilken bild som helst på sidan genom att lägga till attributet `class='lightbox'` till bildtaggen.
Exempel: `<img class='lightbox' src='bildfilen.jpg' />`. 

###Gallery

Bildgalleriets bilder genereras av följande kod:
```PHP
<div class='gallery'>
<div class='gallery-current'><img/></div>
<div class='gallery-all'>
<?php
echo $img->GetImages1('gallery');
?>
</div>
</div>
```
###Slideshow

Följande kod genererar bilderna till en slideshow:
```PHP
<?php
<div class='slideshow'>
<?php 
echo $img->GetImages1('slideshow');
?>
</div>
```
Applikationen innehåller också funktionalitet för att ladda upp och ta bort bilder.
Knapparna som styr uppladningsformuläret och bildarkivet genereras av denna kod: 
```PHP
<?php
if (isset($_GET['show-form']))
{
	echo $img->UploadForm();
	echo "<button id='close'>Stäng formuläret</button>";
}
else
{
	echo "<button id='show-form'>Ladda upp bilder</button>";
}
echo "&nbsp;";
if (isset($_GET['show-list']))
{
	echo "<button id='close'>Stäng bildarkivet</button>";
	echo $img->ListOfImages();
}
else
{
	 echo "<button id='show'>Visa bildarkivet</button>";
}
?>
```
Övrig funktionalitet styrs av filen `js/main.js`, som innehåller de jQuery-funktioner som styr bildspelen. 

Sidans utseende och layout bestäms av filen `less/style.less`. Där kan du göra ändringar i bildstorlekar och design.

###Referensinstallation

Peka nu din webbläsare mot din utvecklingsserver för att prova referensinstallationen.

Min referensinstallation finns också på: <a href="http://www.student.bth.se/~stlu12/javascript/imgbox/" target="_blank">http://www.student.bth.se/~stlu12/javascript/imgbox/</a>.

###Användning

Använd din ImageBox-referenssida för att labba omkring.

###Konfiguration

I filerna `less/style.less` och `js/main.js` kan du göra de ändringar du önskar. 
Du kan också använda indexfilen index.php som den är och/eller modifiera den efter eget önskemål.
