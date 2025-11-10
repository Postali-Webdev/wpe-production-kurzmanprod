<?php
/**
 * Template Name: Sitemap
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
                <?php if (have_posts()) : 
                while (have_posts()) : the_post(); ?>
                <div class="column-50 block">
                    <h2>Pages</h2> 
                    <ul class="sitemap">
                        <?php 
                        $args = array(
                            'depth'        => 0,
                            'sort_column'  => 'menu_order, post_title',
                            'post_type'    => 'page',
                            'post_status'  => 'publish' ,
                            'title_li'      => ""
                        ); ?>
                        
                        <?php wp_list_pages($args);
                        ?>
                    </ul> 
                </div>
                <div class="column-50 block">
                    <h2>Blogs</h2> 
                    <ul class="sitemap">
                        <?php wp_get_archives('type=postbypost'); ?>
                    </ul>
                </div>
                <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php get_template_part('block','contact-cta'); ?>

    <div class="spacer-90"></div>

</div>

<?php get_footer();?>