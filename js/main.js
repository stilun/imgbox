/**
 * Place your JS-code here.
 */
$(document).ready(function(){
  'use strict';
  
  /**
   * Lightbox. 
   */
  $('.lightbox').click(function() {
    var windowHeigth = window.innerHeight || $(window).height(), // make it work on ipad & android
        windowWidth  = window.innerWidth  || $(window).width();

    // Display the overlay
    $('<div id="overlay"></div>')
      .css('opacity', '0')
      .animate({'opacity' : '0.7'}, 'slow')
      .appendTo('body');
    
    // Create the lightbox container
    $('<div id="lightbox"></div>')
      .hide()
      .appendTo('body');
    
    // Display the image on load
    $('<img>')
      .attr('src', $(this).attr('src'))
      .css({
        'max-height': windowHeigth, 
        'max-width':  windowWidth
      })
      .load(function() {
        $('#lightbox')
          .css({
            'top':  (windowHeigth - $('#lightbox').height()) / 2,
            'left': (windowWidth  - $('#lightbox').width())  / 2
          })
          .fadeIn();
      })
      .appendTo('#lightbox');
   
      //close button
      $('<div id="close-button"></div>')
      .css({
      		      'top': -15,
      		      'right': -15
      		      //'width': 25
      })
      .appendTo('#lightbox');
      
      // Remove it all on click
      $('#overlay, #lightbox').click(function() {
        $('#overlay, #lightbox').remove();
      });
      //close functions on click x
      $('#close-button').click(function(){
      		      closeDown();
      });
      // Remove it all when pressing esc-key
       document.onkeydown = function(event) {
            var key;
            key = event.keyCode || event.which;    
           //Key esc = 27 - http://www.cambiaresearch.com/articles/15/javascript-char-codes-key-codes 
            if(key === 27) {
                $('#overlay, #lightbox').remove();
            } 
       }
    
    console.log("Display image in lightbox.");
  });
  
  
   /**
   * Gallery. 
   */
  var galleryInit = function() {
    var current = null;

    $('.gallery-all img').each(function() {
      $(this)
        .attr('src', $(this).attr('src1') + '?w=' + $(this).width() + '&h=' + $(this).height() + '&crop-to-fit')
        .click(function() {
          if(!current) {
            current = this;
            console.log("Set current.");
          } else {
            $(current).toggleClass('selected');
            current = this;
            console.log("Toogled current");
          }
          $(this).toggleClass('selected');
          $('.gallery-current img').attr('src', $(this).attr('src1') + '?w=' + $('.gallery-current').width() + '&h=' + $('.gallery-current').height());
          console.log("Click on mini image.");
        });
      console.log("Gallery image was initiated.");
    });
    
    $('.gallery-all img').first().trigger('click');
  };
  galleryInit();
  
  
  
  /**
   * Slideshow
   */
  var slideshowInit = function() {
    var numberImages =  $('.slideshow img').length,
      currentImage = numberImages - 1,

      // Get current z-index for the slideshow and stack all images above this z-index
      zIndex = parseInt($('.slideshow').css('z-index')),
      currentZIndex = zIndex,
      intervallId = setInterval(function() {rotateImages();}, 5000); // Här bestäms tidsintervallet mellan bilderna. 5000 = 5 sekunder.
      // To play/pause the slideshow intervall
      intervallId = null;
      
    // Function to rotate images
    var rotateImages = function() {
      // Fade out current image and reorder z-index
      $('.slideshow img')
        .eq(currentImage)
        .fadeOut('slow', function() {
          $(this)
            .css('z-index', zIndex)
            .fadeIn(0)
            .siblings().each(function() {
              $(this).css('z-index', ((parseInt($(this).css('z-index')) - zIndex + 1) % numberImages + zIndex));
              
          });
        });
	
      currentImage = (numberImages + currentImage - 1) % numberImages;
      console.log('Rotating pictures in slideshow.' + currentImage);
    };
    
    // Fore each image, set it up.
    $('.slideshow img')
      .each(function() { 
        // Get the crop attribute from the img element, if defined and use to crop the image
        var crop = $(this).attr('crop');
        crop = crop ? 'crop=' + crop + '&' : null;
        
        // Use i to set the z-index of the image, stack them on top of each other
        $(this)
          .attr('src', $(this).attr('src1') + '?' + crop + 'w=' + $(this).width() + '&h=' + $(this).height() + '&crop-to-fit')
          .css('z-index', currentZIndex++);
      })
      .click(function() {rotateImages();});
   
    console.log("Slideshow was initiated.");
  };
  slideshowInit();
  
  
   // Show archive
  $('#show-list').click(function(){
    window.location = "index.php?show-list#list";
  });
  
   $('#show-form').click(function(){
    window.location = "index.php?show-form#form";
  });
  
   $('#close').click(function(){
    window.location = "index.php";
  });
 
});
