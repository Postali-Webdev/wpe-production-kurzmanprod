/**
 * Theme scripting
 *
 * @package Postali Child
 * @author Postali LLC
 */
/*global jQuery: true */
/*jslint white: true */
/*jshint browser: true, jquery: true */

jQuery( function ( $ ) {
	"use strict";

    //Hamburger animation
	$('#menu-icon').click(function() {
		$(this).toggleClass('active');
		$('.header-menu-nav-mobile').toggleClass('active');
		return false;
	});

	//Toggle mobile menu & search
	$('.toggle-nav').click(function() {
		$('.header-menu-nav-mobile').slideToggle(400);
	});
	 
	//Close navigation on anchor tap
	$('.toggle-nav.active').click(function() {	
		$('.header-menu-nav-mobile').slideUp(400);
	});	

	//Mobile menu accordion toggle for sub pages
	$('#menu-header-1 > li.menu-item-has-children').append('<div class="accordion-toggle"><span class="icon-down-arrow"></span></span></div>');

    $('#menu-header-1 .accordion-toggle').click(function() {
        $(this).parent().find('> ul').slideToggle(400);
        $(this).toggleClass('toggle-background');
        $(this).find('.icon-icon-chevron-right').toggleClass('toggle-rotate');
    });

    // script to make accordions function
	$(".accordions").on("click", ".accordions_title", function() {
        // will (slide) toggle the related panel.
        $(this).toggleClass("active").next().slideToggle();
    });


    // open / close more
	$('.more').click(function() {	
		$(this).parent().find('.hidden').slideToggle(400);
        $(this).parent().find('.show').toggleClass('clicked');
        $(this).parent().find('.hide').toggleClass('clicked');

        $('.icon-accordion-expand-and-collapse-icon').toggleClass('rotate');
	});	

    // expand attorneys on banner button click
	$('.related-btn').click(function() {	
		$('.attorneys.hidden').slideToggle(400);
        $('.more > .show').toggleClass('clicked');
        $('.more > .hide').toggleClass('clicked');

        $('.attorneys > .more > .icon-accordion-expand-and-collapse-icon').toggleClass('rotate');
	});	


    // turn filter select into dropdown
    $('.mobile-select').click(function() {
        $('.filter-row').slideToggle(400);
        $('.filter-row').css('display','flex');
    });
    $('.filter-select').click(function() {
        $('.filter-row').slideToggle(400);
    });
    

	// Toggle search function in nav
	$( document ).ready( function() {
		var width = $(document).outerWidth();
        var open = false;
        $('#search-button').attr('type', 'button');
        
        $('#search-button').on('click', function(e) {
                if ( !open ) {
                    $('#search-input-container').removeClass('hdn');
                    $('#search-button span').removeClass('icon-magnifying-glass').addClass('icon-close-x');
                    $('#menu-main-menu li.menu-item').addClass('disable');
                    open = true;
                    return;
                }
                if ( open ) {
                    $('#search-input-container').addClass('hdn');
                    $('#search-button span').removeClass('icon-close-x').addClass('icon-magnifying-glass');
                    $('#menu-main-menu li.menu-item').removeClass('disable');
                    open = false;
                    return;
                }
        }); 
        $('html').on('click', function(e) {
            var target = e.target;
            if( $(target).closest('.navbar-form-search').length ) {
                return;
            } else {
                if ( open ) {
                    $('#search-input-container').addClass('hdn');
                    $('#search-button span').removeClass('icon-close-x').addClass('icon-magnifying-glass');
                    $('#menu-main-menu li.menu-item').removeClass('disable');
                    open = false;
                    return;
                }
            }
        });
	});

});