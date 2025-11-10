<?php
/**
 * Template Name: Search
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
                <div class="column-66 centered center">
                    <h1 class="post-title"><?php printf( esc_html__( 'Search results for "%s"', 'postali' ), get_search_query() ); ?></h1>
                </div>
            </div>
        </div>
    </section>

    <section class="body-top">
        <div class="container">
            <div class="columns">
                <div class="column-66 center block">
                <?php if ( have_posts() ) : ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                    <div class="result-block">
                        <h2><?php the_title(); ?></h2>
                        <?php 
                        $content = get_the_content(); ?>
                        <?php if (!empty($content)) { ?>
                        <p><?php echo wp_trim_words( $content , '32' ); ?></p>
                        <?php } else { ?>
                        <?php 
                        $content = get_field('content_block_top'); ?>
                        <p><?php echo wp_trim_words( $content , '32' ); ?></p>
                        <?php } ?>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="arrowed-link"> <p>Read more</p> <span class="icon-right-arrow"></span></a>       
                        </div>
                    <?php endwhile; ?>
                    <?php the_posts_pagination(); ?>
                <?php else : ?>
                    <p><?php printf( esc_html__( 'Our apologies but there\'s nothing that matches your search for "%s"', 'postali' ), get_search_query() ); ?></p>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <?php get_template_part('block','contact-cta'); ?>

    <div class="spacer-90"></div>

</div>

<?php get_footer();?>

