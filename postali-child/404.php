<?php
/**
 * 404 Page Not Found.
 *
 * @package Postali Parent
 * @author Postali LLC
 */

get_header(); ?>

<div class="body-container">

    <section class="page-banner" style="background:url('/wp-content/uploads/2024/11/single-banner-bg.jpg');">
        <div class="container">
            <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?> 
            <div class="spacer-90"></div>
            <div class="columns">
                <div class="column-50">
                    <h1>404 </h1>
                    <p class="serif lrg"><em>Sorry, we were unable to find that page.</em></p>
                    <a href="/contact/" class="btn">Contact</a>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="columns">
                <div class="column-66 center block">
                    <p><?php esc_html_e( 'We apologize but the page you\'re looking for could not be found.', 'postali' ); ?></p>
                    <p><a href="/">Let's Get You Back on Track!</a></p>
                </div>
            </div>
        </div>
    </section>

</div>

<?php get_footer();
