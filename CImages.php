<?php
/**
 * Klassbiblioteket CImages.php
 */

class CImages
{
    // -------------------------------------------------------------------------------------------
    // Constructor
    //
    function __construct() 
    {
        ;
    }
    // -------------------------------------------------------------------------------------------
    // Destructor
    //
    function __destruct() 
    {
        ;
    }
    // --------------------------------------------------------------------------------------------	
	
    // Metod för att visa Lightbox
    
    public function GetImages()
    {
    	    
    	$dl = opendir('img/lightbox');
    	$pixl = '';
	while(($file = readdir($dl)) != false) 
	{   
		if(preg_match("/.jpg/", $file) || preg_match("/.png/", $file) || preg_match("/.gif/", $file) || preg_match("/.JPG/", $file))
		{
			$pixl[] = $file;   
		}
	}  
	closedir($dl);
	$list = null;
	$i = 0;
	foreach($pixl as $val)
	{    
		$i++;
		$list .= "<img class='lightbox' src='img/lightbox/".$val."' alt='Bild ".$i."' title='Bild ".$i."' width='200px' />\n";
	}

	return $list;
    }
	
    // -------------------------------------------------------------------------------------------
	
	
    // Metod för att visa Gallery och Slideshow
    
    public function GetImages1($imgfolder)
    {
    	    
    	$dl = opendir('img/'.$imgfolder);
    	$pixl = '';
	while(($file = readdir($dl)) != false) 
	{   
		if(preg_match("/.jpg/", $file) || preg_match("/.png/", $file) || preg_match("/.gif/", $file) || preg_match("/.JPG/", $file))
		{
			$pixl[] = $file;   
		}
	}  
	closedir($dl);
	$list1 = null;
	$i=0;
	foreach($pixl as $val)
	{    
		$i++;
		$list1 .= "<img src1='img/".$imgfolder."/".$val."' alt='Bild ".$i." 'title='Bild ".$i."' />\n";
	}
	
	return $list1;
    }
	
    // -----------------------------------------------------------------------------------------
	
    // Metod för att ladda upp en bild
    
    public function UploadImages()
    {
    	    $allowed_types = array('image/jpeg', 'image/png', 'image/jpg', 'image/JPG', 'image/gif', 'image/GIF'); // Tillåtna filtyper att ladda upp
    	    $max_file_size = 1000000;// Max tillåten filstorlek i byte
    	    $imgdir = "img/".$_POST['imgdir'];
    	    if (is_uploaded_file($_FILES['img']['tmp_name'])) 
    	    {
    	    	    if (in_array($_FILES['img']['type'], $allowed_types)) 
    	    	    { 
    	    	    	    $check_filename = "true"; 
    	    	    } 
    	    	    else 
    	    	    { 
    	    	    	    echo "<pre><font color='red'><b>Du får endast ladda upp filer av formaten JPG, PNG, GIF eller JPEG !</b></font></pre>";
    	    	    	    $check_filename = "false"; 
    	    	    } 
    	    	    if ($_FILES['img']['size'] > $max_file_size) 
    	    	    { 
    	    	    	    echo "<pre><font color='red'><b>Filen du laddade upp är för stor, den kan vara max ".round($max_file_size / 1024)." KB.</b></font></pre>"; 
    	    	    	    $check_filesize = "false"; 
    	    	    } 
    	    	    else 
    	    	    { 
    	    	    	    $check_filesize = "true"; 
    	    	    }  
    	    	    if($check_filename == "true" && $check_filesize == "true") 
    	    	    { 
    	    	    	    $filename  = $_FILES['img']['name'];
    	    	    	    move_uploaded_file($_FILES['img']['tmp_name'], $imgdir."/".$filename); 
    	    	    	    echo "<pre>Du har laddat upp filen {$_FILES['img']['name']}.&nbsp;"; 
    	    	    	    echo "Den var {$_FILES['img']['size']} bytes stor.</pre>"; 
    	    	    }  
    	    }  
    }
	
    // -----------------------------------------------------------------------------------------
    
    // Lista på bilder
    
    protected function ImageList($imgfolder)
    {
    	    $dl = opendir('img/'.$imgfolder);
    	$pix = '';
	while(($file = readdir($dl)) != false) 
	{   
		if(preg_match("/.jpg/", $file) || preg_match("/.png/", $file) || preg_match("/.gif/", $file) || preg_match("/.JPG/", $file))
		{
			$pix[] = $file;   
		}
	}  
	closedir($dl);
	$list = null;
	$list .="<ul>\n";
	foreach($pix as $val)
	{    
		$list .= "<li><form method='post' action='index.php?show-list#list'><img class='lightbox' src='img/".$imgfolder."/".$val."' width='50px'/> ".$val."\n\t<input type='hidden' name='img' value='img/".$imgfolder."/".$val."'>&nbsp;<input type='submit' id='show' name='delete' value='Ta bort bilden' /></form></li>\n";
	}
	
	$list .="</ul>\n";
	return $list;
    }

    //------------------------------------------------------------------------------------------------
    
   // Metod för att visa bildarkivet
    
    public function ListOfImages()
    {
    	$list = <<<LIST
    	<hr />
    	<h3>Bildarkiv</h3>\n
    	<p>Klicka på bilderna för att visa i en större version.</p>
	<b>Lightbox</b>\n
	{$this->ImageList('lightbox')}
	<b>Gallery</b>\n
	{$this->ImageList('gallery')}
	<b>Slideshow</b>\n
	{$this->ImageList('slideshow')}
	
LIST;

	return $list;
    }
    
    // ---------------------------------------------------------------------------------------------
    
    // Metod för att ta bort enstaka bilder
    
    public function DeleteImage()
    { 
   	   $img = $_POST['img'];
	 if (file_exists($img))
	 { 
	 	 unlink($img);
	 }

    }	
	
    // ------------------------------------------------------------------------------------------
     
    // Formulär för att ladda upp bilder
    
    public function UploadForm()
    {
    	 $form = <<<FORM
	<form action='index.php?show-list#list' method='POST' enctype='multipart/form-data' name='form_img'>
	<fieldset>
	 <legend><strong>Ladda upp bilder</strong></legend> 
	 <table width='100%' border='0' cellspacing='0' cellpadding='3'>
	  <tr>
	   <td width='57%'>Välj målmapp:&nbsp;
	     <select name='imgdir'>
		<option value='lightbox' selected>Lightbox</option>
		<option value='gallery'>Gallery</option>
		<option value='slideshow'>Slideshow</option>
	    </select>
	    <input name='img' type='file' />
	      <input type='submit' id='upload' name='upload' value='Ladda upp bilden' />
	    </td>	
	   </tr>
	 </table>
	 </fieldset>
	</form>
	
FORM;

	return $form;
    }
	
	
	
}
