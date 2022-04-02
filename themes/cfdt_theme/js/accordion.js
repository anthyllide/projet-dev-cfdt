/**
 * @file
 * Contains accordion.js.
 */

(function ($, Drupal) {
  'use strict';
  
  Drupal.behaviors.MyBehaviour = {
    attach: function(context, settings) {

		$(".accordion").click(function(){
			if($(this).hasClass("active")){
				$(this).next().hide();
				$(this).removeClass("active");
			} else {
				$(this).next().show();
				$(this).addClass("active");
			}
		});
	}
};

}(jQuery, Drupal));