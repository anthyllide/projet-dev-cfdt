/**
 * @file
 * Contains animation.js.
 */

(function ($, Drupal) {
 'use strict';
  
  Drupal.behaviors.TitreClignotant = {
    attach: function(context, settings) {

		var init = 0;

            $('#clignotant').click(function() {
                if (init==0) {
                    init++;
                    blink(this, 500, 3000);
                }
            });

           // This line must come *AFTER* the $('#clignotant').click() function !!
           if($('#clignotant') != undefined){
                //window.load($('#clignotant').trigger('click')); 
           }
            

            function blink(selector, blink_speed, iterations, counter){
                counter = counter | 0;
                $(selector).animate({opacity:0}, 50, "linear", function(){
                    $(this).delay(blink_speed);
                    $(this).animate({opacity:1}, 50, function(){

                        counter++;

                            if (iterations == -1) {
                                blink(this, blink_speed, iterations, counter);
                            }else if (counter >= iterations) {
                                return false;
                            }else{
                                blink(this, blink_speed, iterations, counter);
                            }
                        });

                      $(this).delay(blink_speed);
                });
            }
	    }
    };

}(jQuery, Drupal));
