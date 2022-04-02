
/**
 * @file
 * Contains carousel-animation.js.
 */

(function ($, Drupal) {
  'use strict';
  
    Drupal.behaviors.AnimationCarousel = {
        attach: function(context, settings) {

//            if(document.getElementsByClassName("mySlides").length > 0){
//
//                var slideIndex = 0;
//                showSlides();
//
//                function showSlides() {
//                    var i;
//                    var slides =  document.getElementsByClassName("mySlides");
//                    for (i = 0; i < slides.length; i++) {
//                        slides[i].style.display = "none";
//                    }
//                    slideIndex++;
//                    if (slideIndex > slides.length) {
//                        slideIndex = 1
//                    }
//                    slides[slideIndex-1].style.display = "block";
//                    setTimeout(showSlides, 4000); // Change image every 4 seconds
//                } 
//            }
            
            $('.main-carousel').flickity({
                // options
                cellAlign: 'left',
                contain: true
            });
        }
    };
}(jQuery, Drupal));