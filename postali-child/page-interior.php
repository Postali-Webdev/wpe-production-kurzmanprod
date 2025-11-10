<?php
/**
 * Template Name: Interior
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

    <?php
        // Get current page slug
        $current_slug = get_post_field( 'post_name', get_the_ID() );
        // Get the term object from the taxonomy using the slug
        $term = get_term_by( 'slug', $current_slug, 'practice_areas' );

        // Get the term name if the term exists
        $term_name = $term ? $term->name : '';
    ?>

    <?php if($term_name !== '') { ?>

    <section class="attorneys lined" id="related-attorneys">
        <div class="container">
            <div class="spacer-60"></div>
            <div class="columns">

            <h2><?php echo $term_name; ?> Attorneys</h2>
            <div class="spacer-break"></div>
            <div class="attorneys hidden">
            <div class="columns attorney-list">

                <?php 

                    $post_ids = wp_list_pluck( $get_chair->posts, 'ID' );

                    

                    // Query attorneys where 'practice_areas' term slug matches current page slug
                    $args_others = [
                        'post_type'      => 'attorneys',
                        'post_status'    => 'publish',
                        'tax_query'      => [
                            [
                                'taxonomy' => 'practice_areas',
                                'field'    => 'slug',
                                'terms'    => $current_slug,
                            ]
                        ],
                        'post__not_in' => $post_ids,
                        'posts_per_page' => -1,
                    ];

                    $get_others = new WP_Query( $args_others );
                    if( $get_others->have_posts() ) :
                    while( $get_others->have_posts() ): $get_others->the_post(); ?>

                        <a class="practice-attorney" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">      
                            <div class="attorney-headshot">
                            <?php if (has_post_thumbnail( $post->ID ) ): ?>
                            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
                                <img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>">
                            <?php endif; ?>
                            </div>
                            <p><strong><?php the_title(); ?></strong></p>
                            <p class="caps spaced serif"><?php the_field('title'); ?></p>
                        </a>

                    <?php endwhile;
                    endif;

                    wp_reset_postdata();

                ?>
                </div>
            </div>
            <div class="spacer-break"></div>
            <div class="more"><p class="show">Read More</p><p class="hide">Close Details</p> <span class="icon-accordion-expand-and-collapse-icon"></span></div>
            </div>
            <div class="spacer-60"></div>
        </div>
    </section>

    <?php } ?>

    <?php get_template_part('block','contact-cta'); ?>

    <div class="spacer-90"></div>

</div>

<?php get_footer();?>

