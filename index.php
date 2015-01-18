<!doctype html>
<html lang='en' class='no-js'>
<head>
<meta charset='utf-8' />
<title>ImageBox</title>
<link rel="stylesheet/less" type="text/css" href="less/style.less">
<script src="js/less.js"></script>
</head>
<body>
<div id='top' align='center'><h1>ImageBox</h1>

<?php 
error_reporting(1);
require_once('CImages.php');
$img = new CImages();
?>
<div id='flash'>
<?php
if (isset($_POST['delete'])) $img->DeleteImage();
if (isset($_POST['upload'])) $img->UploadImages();
?>

<h3>Lightbox</h3>
<p>En lightbox används ofta för att visa en större version av en bild utan att behöva ladda om hela sidan. Klicka på en bild för att testa.</p>
<?php 
echo $img->GetImages();
?>
 <!-- end of lightbox -->

<hr />
<h3>Gallery</h3>
<p>Ibland är det trevligt att kunna samla gamla bilder i ett bildgalleri.</p>

<div class='gallery'>
  <div class='gallery-current'><img/></div>
  <div class='gallery-all'>
<?php
echo $img->GetImages1('gallery');
?>
</div>
</div> <!-- end of gallery -->

<hr>
<h3>Slideshow</h3>
<p>En slideshow används vanligtvis på en startsida för att visa ett bildspel med bilder som växlar med ett bestämt tidsintervall, eller med att klicka på bilden.</p>
<div class='slideshow'>
<?php 
echo $img->GetImages1('slideshow');
?>
</div> <!-- end of slideshow -->

<hr />

<?php
echo "<a name='form'></a>";
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
echo "<a name='list'></a>";
if (isset($_GET['show-list']))
{
	echo "<button id='close'>Stäng bildarkivet</button>";
	echo $img->ListOfImages();
}
else
{
	 echo "<button id='show-list'>Visa bildarkivet</button>";
}
?>
</div>

<script src="js/jquery.js"></script>
<script src="js/main.js"></script>

</body>
</html> 

