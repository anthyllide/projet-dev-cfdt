/**
 * @file
 * Contains animation.js.
 */

(function ($, Drupal) {
  'use strict';
  
  Drupal.behaviors.AnimationVignette = {
    attach: function(context, settings) {

		//retourne les blocs presentations à partir d'un clic pour la version mobile, sinon au survol de la souris
		if($(".pres").css("margin-bottom") == "20px"){
			$(".pres").flip({
  				axis: 'y',
  				trigger : 'click'
			});
		} else {
			$(".pres").flip({
  			axis: 'y',
  			trigger : 'hover'
			});
		}	
	}
};

}(jQuery, Drupal));
