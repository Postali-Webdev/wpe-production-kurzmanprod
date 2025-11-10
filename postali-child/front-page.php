<?php
/**
 * Template Name: Front Page
 * @package Postali Child
 * @author Postali LLC
**/
get_header();?>

<div class="body-container">

    <?php get_template_part('block','landing'); ?>

    <section class="hp-banner">

        <div class="rellax left" data-rellax-speed="-2">
            <?php if( have_rows('attorney_rotator_left') ): ?>
            <div id="attorneys-left">
            <?php while( have_rows('attorney_rotator_left') ): the_row(); ?>
                <?php $post_object = get_sub_field('attorney'); ?>
                <?php if( $post_object ): 
                    $featured_img_url = get_post_thumbnail_id( $post_object->ID );
                    ?>
                    <?php // override $post
                    $post = $post_object;
                    setup_postdata( $post );
                    ?>
                    <div class="slide" style="background:url(<?php echo wp_get_attachment_image_url( $featured_img_url, 'full' ); ?>);"></div>
                    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                <?php endif; ?>
            <?php endwhile; ?>
            </div>
            <?php endif; ?>
        </div>

        <div class="rellax right" data-rellax-speed="-4">
        <?php if( have_rows('attorney_rotator_right') ): ?>
            <div id="attorneys-right">
            <?php while( have_rows('attorney_rotator_right') ): the_row(); ?>
                <?php $post_object = get_sub_field('attorney'); ?>
                <?php if( $post_object ): 
                    $featured_img_url = get_post_thumbnail_id( $post_object->ID );
                    ?>
                    <?php // override $post
                    $post = $post_object;
                    setup_postdata( $post );
                    ?> 
                    <div class="slide" style="background:url(<?php echo wp_get_attachment_image_url( $featured_img_url, 'full' ); ?>);"></div>    
                    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                <?php endif; ?>
            <?php endwhile; ?>
            </div>
            <?php endif; ?>
        </div>

        <script>
            var rellax = new Rellax('.rellax');
        </script>

        <div class="container">
            <div class="columns">
                <div class="column-full">
                    <h1>Kurzman Eisenberg</h1>
                    <div class="banner-headline">
                        <div class="top"><?php the_field('banner_headline_top'); ?></div>
                        <div class="bottom"><?php the_field('banner_headline_bottom'); ?></div>
                        <a href="<?php the_field('banner_button_link'); ?>" class="btn"><?php the_field('banner_button_text'); ?></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="rellax middle" data-rellax-speed="-1">
        <?php if( have_rows('attorney_rotator_center') ): ?>
            <div id="attorneys-center">
            <?php while( have_rows('attorney_rotator_center') ): the_row(); ?>
                <?php $post_object = get_sub_field('attorney'); ?>
                <?php if( $post_object ): 
                    $featured_img_url = get_post_thumbnail_id( $post_object->ID );
                    ?>
                    <?php // override $post
                    $post = $post_object;
                    setup_postdata( $post );
                    ?> 
                    <div class="slide" style="background:url(<?php echo wp_get_attachment_image_url( $featured_img_url, 'full' ); ?>);"></div>    
                    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                <?php endif; ?>
            <?php endwhile; ?>
            </div>
            <?php endif; ?>
        </div>

        <script>
            var rellax = new Rellax('.rellax');
        </script>	

        <div class="banner-bg">
        <?php 
        $image = get_field('banner_background_image');
        if( !empty( $image ) ): ?>
            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
        <?php endif; ?>
        </div>
    </section>

    <section class="practice-areas" id="hp-panel-3">
        <div class="container">
            <div class="spacer-90"></div>
            <div class="columns heading">
                <div class="column-full">
                    <h2><?php the_field('p3_section_headline'); ?></h2>
                    <a href="/practice-areas/" class="view-all">View All</a>
                </div>
            </div>
            <div class="columns">
            <?php if( have_rows('p3_practice_areas') ): ?>
            <?php while( have_rows('p3_practice_areas') ): the_row(); ?>
                <?php $post_object = get_sub_field('practice_area'); ?>
                <?php if( $post_object ): ?>
                    <?php // override $post
                    $post = $post_object;
                    setup_postdata( $post );
                    ?>
                    <?php $bg_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
                    <div class="column-25">
                        <a class="practice-area" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                            <h2><?php the_title(); ?></h2>
                            <div class="bg-image">
                                <img src="<?php echo $bg_image[0]; ?>" alt="">
                            </div>
                            <span class="icon-right-arrow"></span>
                        </a>
                    </div>
                    
                    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                <?php endif; ?>
            <?php endwhile; ?>
            <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="emerald reversed" id="hp-panel-2">
        <div class="container wide">
            <div class="columns">
                <div class="column-33 block"><?php the_field('p2_content_left'); ?></div>
                <div class="column-66"><?php the_field('p2_content_right'); ?></div>
            </div>
        </div>
    </section>

    <section class="call-out">
        <div class="container">
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
                    <a href="<?php the_field('cta_button_link'); ?>" class="btn"><?php the_field('cta_button_text'); ?></a>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="columns">
                <div class="column-50 accordion-blocks">
                    <div class="accordion-top">
                        <div class="accordion">
                            <div class="accordion_title">
                                <div class="title">CROSS-DISCIPLINARY<br>INSIGHT</div>
                                <span class="icon-accordion-expand-and-collapse-icon"></span>
                            </div>
                            <div class="accordion_content">
                                <p>With experience spanning multiple practice areas, we assemble teams that bring deep knowledge in key fields along with broad cross-disciplinary insight—delivering comprehensive solutions that cover every angle.</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-bottom">
                        <div class="accordion">
                            <div class="accordion_title">
                                <div class="title">TAILORED<br>FOR YOU</div>
                                <span class="icon-accordion-expand-and-collapse-icon"></span>
                            </div>
                            <div class="accordion_content">
                                <p>We right-size our teams to meet each client’s specific needs, combining deep experience and broad perspective to help individuals and businesses achieve their goals.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php get_template_part('block','contact-cta'); ?>

    <div class="spacer-90"></div>

</div><!-- #front-page -->

<?php get_footer();?>
