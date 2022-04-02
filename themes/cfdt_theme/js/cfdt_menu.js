/**
 * @file
 * Contains cfdt_menu.js
 */
(function ($, Drupal) {
  'use strict';

  Drupal.behaviors.simple_megamenu = {
    attach: function(context, settings) {
        
        //ouvre le sous-menu au click sur Infos pratiques
        $("#block-cfdt-theme-main-menu li.menu-item--expanded:nth-child(3)").click(function(){
            $("#block-cfdt-theme-main-menu li.menu-item--expanded > ul").hide();
            $("#block-cfdt-theme-main-menu li.menu-item--expanded:nth-child(3) > ul").css("display","flex");
        });
        //ouvre le sous-menu au click sur Qui sommes-nous
        $("#block-cfdt-theme-main-menu li.menu-item--expanded:nth-child(4)").click(function(){
            $("#block-cfdt-theme-main-menu li.menu-item--expanded > ul").hide();
            $("#block-cfdt-theme-main-menu li.menu-item--expanded:nth-child(4) > ul").css("display","flex");
        });
        //ouvre le menu mobile
        $("#menu-burger a").click(function(){
           $("#menu-mobile").show();
        });

        // ferme le menu mobile 
        $(".closeNav").not("span.closeNav").click(function(){
                $("#menu-mobile").hide();
        });

        //ouvre le sous-menu au click sur "qui sommes-nous"
        $("#menu-mobile > div > ul > li:nth-child(4) > span").click(function(){
            $("#menu-mobile > ul > li:nth-child(4) > ul").show();
        });
        //ouvre le sous-menu au click sur "infos pratiques"
        $(".overlay-content > ul > li:nth-child(3) > span").click(function(){
                $(".overlay-content > ul > li:nth-child(3) > ul.closeNav").show();
        });

        //ouvre le sous-menu au click sur "adhérer"
        $(".overlay-content > ul > li:nth-child(6) > span").click(function(){
                $(".overlay-content > ul > li:nth-child(6) > ul.closeNav").show();
        });

        //ajoute au css un target="blank" pour les liens vers des documents
        $("li.menu-item:nth-child(6) > div:nth-child(2) > ul:nth-child(2) > li:nth-child(1) > a:nth-child(1)").attr('target','blank');
        $("li.menu-item:nth-child(6) > div:nth-child(2) > ul:nth-child(2) > li:nth-child(2) > a:nth-child(1)").attr('target','blank');
    }	
};
}(jQuery, Drupal));
