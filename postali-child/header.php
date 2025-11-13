<?php
/**
 * Theme header.
 *
 * @package Postali Child
 * @author Postali LLC
**/
?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<!-- Google Tag Manager -->


<!-- End Google Tag Manager -->
<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php wp_head(); ?>
<!--
<script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
-->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400..800;1,400..800&family=Oswald:wght@200..700&family=Red+Hat+Display:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://use.typekit.net/gon5sjb.css">
</head>

<body <?php body_class(); ?>>
	<!-- Google Tag Manager (noscript) -->

	<!-- End Google Tag Manager (noscript) -->

	<header>
		<div id="header-top" class="container">
            <div id="header-logo">
				<?php the_custom_logo(); ?>
			</div>
            <div class="header-menu nav-left">

                <script type="text/javascript" id="dropdown-script-nav">

                    jQuery(document).ready(function ($) {
                        jQuery(".search_box_nav").on('input', function () {
                            let query = $(this).val().trim();

                            var word_nav = $('.search_box_nav').val();
                            var search_type_nav = "live";

                            if (query.length > 1) { 
                            $.ajax({
                                url:'/wp-content/themes/postali-child/db_attorneys_nav.php',
                                type:'GET',
                                data:'word=' + word_nav +'&search_type='+search_type_nav,
                                cache: 'false',
                                success: function(data){
                                    $('#results_nav').html($(data));
                                },
                                error: function(err){
                                    alert(err.responseText);
                                }
                            });

                            } else {
                                $('#results_nav').empty();
                            }

                        });

                    });

                </script>
                <nav role="navigation">
                <?php
                    $args = array(
                        'container' => false,
                        'theme_location' => 'header-nav'
                    );
                    wp_nav_menu( $args );
                ?>
                </nav>
            </div>

            <div class="header-menu-nav-mobile">
                <nav role="navigation">
                <?php
                    $args = array(
                        'container' => false,
                        'theme_location' => 'header-nav'
                    );
                    wp_nav_menu( $args );
                ?>
                </nav>
            </div>
	
            <div id="header-top_mobile">
                <div id="menu-icon" class="toggle-nav">
                    <span class="line line-1"></span>
                    <span class="line line-2"></span>
                    <span class="line line-3"></span>
                </div>
            </div>
		</div>
	</header>

    <section class="search-bar">
        <div class="container">
            <div class="columns">
                <div class="column-full">
                    <div class="search-holder">
                        <form class="navbar-form-search" role="search" method="get" action="/">
                            <div class="search-form-container hdn" id="search-input-container">
                                <div class="search-input-group">
                                    <div class="form-group">
                                    <input type="text" name="s" placeholder="Search for..." id="search-input-5cab7fd94d469" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-search" id="search-button"><span class="icon-magnifying-glass" aria-hidden="true"></span></button>
                        </form>	
                    </div>
                </div>
            </div>
        </div>
    </section>