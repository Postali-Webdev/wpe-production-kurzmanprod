<?php
/**
 * Template Name: Contact
 * @package Postali Child
 * @author Postali LLC
**/

$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
get_header();?>

<div class="body-container">

    <section class="page-banner" style="background:url('<?php echo $image[0]; ?>');">
        <div class="container">
            <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?> 
            <div class="spacer-90"></div>
            <div class="columns">
                <div class="column-full">
                    <h1><?php the_field('banner_headline'); ?></h1>
                    <div class="subhead"><?php the_field('banner_subheadline'); ?></div>
                </div>
            </div>
        </div>
    </section>

    <section class="locations">
        <div class="container">
            <div class="columns">
            <?php if( have_rows('location','options') ): ?>
            <div class="dashed-title">
                <p class="caps spaced lrg serif">Locations</p><span></span>
            </div>
            <div class="spacer-15"></div>
            <?php while( have_rows('location','options') ): the_row(); ?>  
                <div class="column-50">
                    <p>
                        <strong><?php the_sub_field('location_name'); ?></strong><br>
                        <?php the_sub_field('address'); ?><br>
                        PH: <a href="tel:<?php the_sub_field('phone'); ?>"><?php the_sub_field('phone'); ?></a><br>
                        FX: <?php the_sub_field('fax'); ?><br>
                        <a href="<?php the_sub_field('directions'); ?>" target="blank">Directions</a>
                    </p>
                    <div class="map-block">
                        <iframe src="<?php the_sub_field('map'); ?>" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            <?php endwhile; ?>
            <?php endif; ?> 
            </div>
        </div>
    </section>

</div>

<?php get_footer();?>

