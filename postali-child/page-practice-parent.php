<?php
/**
 * Template Name: Practice Area Parent
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
                    <a href="#related-attorneys" class="btn related-btn">Related Attorneys</a>
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
        <span id="first"></span>
        <div class="hidden">

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

        <?php if(get_field('content_block_bottom')) { ?>
        <div class="more"><p class="show">Read More</p><p class="hide"><a href="#first">Close Details</a></p> <a href="#first"><span class="icon-accordion-expand-and-collapse-icon"></span></a></div>
        <?php } ?>
        </div>

    </section>    

    <section class="attorneys lined" id="related-attorneys">
        <div class="container">
            <div class="spacer-60"></div>
            <div class="columns">

            <?php 
                $terms = get_the_terms( $post->ID, 'practice_areas');
                foreach ( $terms as $term ) {
                    $termID[] = $term->slug;
                    $termName = $term->name;
                }
                $cat = $termID[0]; 
                $fixed_cat = str_replace('-', '_', $cat);    
                $chair = 'sub_categories_'. $fixed_cat .'_chair';
            ?>

            <h2><?php echo $termName; ?> Attorneys</h2>
            <div class="spacer-break"></div>
            <div class="attorneys hidden">
            <div class="columns attorney-list">

                <?php 
                    $args_chair = [
                        'post_type' => 'attorneys',
                        'post_status' => 'publish',
                        'tax_query' => array(
                            array (
                                'taxonomy' => 'practice_areas',
                                'field' => 'slug',
                                'terms' => esc_html($cat),
                            )
                        ),
                        'meta_key'		=> $chair,
                        'meta_value'	=> '"yes"',
                        'meta_compare'	=> 'LIKE',
                        'posts_per_page' => -1,
                    ];

                    $get_chair = new WP_Query( $args_chair );
                    if( $get_chair->have_posts() ) :
                    while( $get_chair->have_posts() ): $get_chair->the_post();     
                    ?>

                        <a class="practice-attorney" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">        
                            <div class="attorney-headshot">
                            <?php if (has_post_thumbnail( $post->ID ) ): ?>
                            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
                                <img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>">
                            <?php endif; ?>
                            </div>
                            <p><strong><?php the_title(); ?></strong></p>
                            <p class="caps spaced serif"><?php the_field('title'); ?><?php if (get_field($chair)) { ?>, Chair <?php } ?></p>
                        </a>

                    <?php endwhile;
                    endif;

                    $post_ids = wp_list_pluck( $get_chair->posts, 'ID' );

                    $args_others = [
                        'post_type' => 'attorneys',
                        'post_status' => 'publish',
                        'tax_query' => array(
                            array (
                                'taxonomy' => 'practice_areas',
                                'field' => 'slug',
                                'terms' => esc_html($cat),
                            )
                        ),
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

    <?php if(get_field('add_related_services')) { ?>
    <section class="lined" id="related-services">
        <div class="container">
            <div class="spacer-60"></div>
            <div class="columns">
                <div class="column-full">
                    <div class="related-services">
                        <?php if( have_rows('related_services') ): ?>
                        <h2>Related Services</h2>
                        <div class="spacer-break"></div>
                        
                        <div class="related hidden">
                        <?php while( have_rows('related_services') ): the_row(); ?>  
                            <a class="btn white" href="<?php the_sub_field('page_link'); ?>" <?php if (get_sub_field('external_link') == 'yes') { ?>target="blank"<?php } ?>>
                                <?php the_sub_field('link_title'); ?>
                            </a>
                        <?php endwhile; ?>
                        <div class="spacer-30"></div>
                        </div>
                        
                        <div class="more"><p class="show">Read More</p><p class="hide">Close Details</p> <span class="icon-accordion-expand-and-collapse-icon"></span></div>

                        <?php endif; ?> 
                    </div>
                </div>
            </div>
            <div class="spacer-60"></div>
        </div>
    </section>
    <?php } ?>

    <div class="spacer-60"></div>

    <?php get_template_part('block','contact-cta'); ?>

    <div class="spacer-90"></div>

</div>

<?php get_footer();?>

