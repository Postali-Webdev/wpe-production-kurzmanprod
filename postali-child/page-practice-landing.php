<?php
/**
 * Template Name: Practice Area Landing
 * @package Postali Child
 * @author Postali LLC
**/

get_header();?>

<div class="body-container">

    <section class="page-banner">
        <div class="container">
            <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?> 
            <div class="spacer-90"></div>
            <div class="columns">
                <div class="column-75 center centered">
                    <h1><?php the_title(); ?></h1>
                </div>
            </div>
        </div>
    </section>

    <section class="practice-areas">
        <div class="container">
            <div class="columns">
            <?php if( have_rows('practice_areas') ): ?>
            <?php while( have_rows('practice_areas') ): the_row(); ?>
                <?php $post_object = get_sub_field('practice_area'); ?>
                <?php if( $post_object ): ?>
                    <?php // override $post
                    $post = $post_object;
                    setup_postdata( $post );
                    ?>
                    <?php $bg_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
                    <div class="column-25">
                        <a class="practice-area" href="<?php the_permalink(); ?>">
                            <h2><?php the_title(); ?></h2>
                            <span class="icon-right-arrow"></span>
                            <div class="bg-image">
                                <img src="<?php echo $bg_image[0]; ?>" alt="">
                            </div>
                        </a>
                    </div>
                    
                    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                <?php endif; ?>
            <?php endwhile; ?>
            <?php endif; ?>
            </div>
        </div>
    </section>

</div>

<?php get_footer();?>

