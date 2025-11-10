<?php
/**
 * Template Name: Blog
 * 
 * @package Postali Child
 * @author Postali LLC
 */

$args = array (
	'post_type'     => 'post',
	'post_status'   => 'publish',
	'order'         => 'DESC',
    'paged'         => $paged,
);

$wp_query = new WP_Query($args);

get_header(); ?>

<div class="body-container">

    <section class="page-banner">
        <div class="container">
        <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?> 
            <div class="spacer-90"></div>
            <div class="columns">
                <div class="column-66 centered center">

                    <h1>
                        <?php
                        $value = get_field('news_headline','options');
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
            <div class="columns posts">
            <?php while( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
                <div class="post-block">
                    <div class="column-50">
                        <div class="post-img-container">
                            <div class="bg-image">
                                <img src="<?php echo get_the_post_thumbnail_url($post->ID); ?>" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="column-50">
                        <h2><?php the_title(); ?></h2>
                        <?php 
                        $content = get_the_content(); ?>
                        <p><?php echo wp_trim_words( $content , '30' ); ?></p>
                        <a href="<?php the_permalink(); ?>">
                            <p class="sm"><strong>read post</strong><span class="icon-right-arrow"></span></p>
                        </a>
                    </div>
                </div>
            <?php endwhile; wp_reset_postdata(); ?>
            </div>
            <div class="spacer-60"></div>
            <div class="columns">
                <div class="column-full centered">
                    <?php the_posts_pagination(); ?>
                </div>
            </div>
        </div>
    </section>

    <?php get_template_part('block','contact-cta'); ?>

    <div class="spacer-90"></div>

</div>

<?php get_footer(); ?>