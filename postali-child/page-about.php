<?php
/**
 * Template Name: About
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
                <div class="column-50">
                    <h1>
                        <?php
                        $value = get_the_title();
                        echo strtok($value, " "); // Test
                        ?>    
                        <span>
                        <?php
                        echo substr(strstr($value," "), 1);
                        ?>
                        </span>
                    </h1>
                    <div class="spacer-60"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="body-top">
        <div class="container">
            <div class="columns">
                <div class="column-66">
                    <?php the_field('content_block_top'); ?>
                </div>
            </div>
        </div>
    </section>

    <section class="additional">
        <div class="container">

            <?php if(get_field('add_call_out_block')) { ?>
            <div class="call-out">
                <div class="columns">
                    <div class="column-50 call-out-image">
                    <?php 
                    $image = get_field('call_out_image');
                    if( !empty( $image ) ): ?>
                        <div class="call-out-img-container">
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                        </div>
                    <?php endif; ?>
                    </div>
                    <div class="column-50 call-out-copy">
                        <h2><?php the_field('call_out_headline'); ?></h2>
                        <p class="subhead"><?php the_field('call_out_subheadline'); ?></p>
                        <?php the_field('call_out_copy'); ?>
                    </div>
                </div>
            </div>
            <?php } ?>

            <div class="body-bottom">
                <div class="columns">
                    <div class="column-50 center">
                        <?php the_field('content_block_bottom'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>    

    <div class="spacer-60"></div>

    <section class="cta-footer">
        <div class="container">
            <div class="columns">
                <div class="column-66 centered center">
                    <?php the_field('careers_cta','options'); ?>
                </div>
            </div>
        </div>
    </section>

    <div class="spacer-90"></div>

</div>

<?php get_footer();?>

