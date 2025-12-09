<?php
/**
 * Template Name: Practice Area Child
 * @package Postali Child
 * @author Postali LLC
**/

if(is_page('422')) {
    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
} else {
    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->post_parent ), 'single-post-thumbnail' );
}
get_header();?>

<div class="body-container">

    <section class="page-banner" style="background:url('<?php echo $image[0]; ?>');">
        <div class="container">
            <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?> 
            <div class="spacer-90"></div>
            <div class="columns">
                <div class="column-50">
                    <h1><?php the_title(); ?></h1>
                    <p class="serif lrg"><em><?php the_field('banner_intro_copy'); ?></em></p>
                    <a href="/contact/" class="btn">Contact</a>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="columns">
                <div class="column-66">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </section>

    <?php get_template_part('block','related-attorneys'); ?>

    <?php get_template_part('block','contact-cta'); ?>

    <div class="spacer-90"></div>

</div>

<?php get_footer();?>

