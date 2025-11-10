<?php
/**
 * Single template
 *
 * @package Postali Parent
 * @author Postali LLC
 */



get_header();?>

<div class="body-container">

    <section>
        <div class="container">
            <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?> 
            <div class="spacer-90 mobile"></div>
            <div class="columns">
                <div class="column-50 bio-left">
                    <div class="attorney-headshot">
                    <?php if(get_field('secondary_image')) {
                        $image = get_field('secondary_image'); ?>
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                    <?php } else {
                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
                        <img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>">
                    <?php } ?>
                        
                    </div>
                    
                    <?php 
                    $terms = get_field('practice_area_pages');
                    if( $terms ): ?>
                        <div class="accordions">
                            <div class="accordions_title">Practice Areas <span></span></div>
                            <div class="accordions_content">
                                <ul>
                                <?php foreach( $terms as $term ): ?>
                                    <?php if ( $term->parent == 0 ): // Only show top-level terms ?>
                                    <li>
                                        <a href="/<?php echo esc_html( $term->slug ); ?>/"><?php echo esc_html( $term->name ); ?></a>
                                    </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="column-50 bio">
                    <h1><?php the_title(); ?></h1>
                    <p class="lrg serif caps spaced"><?php the_field('title'); ?></p>
                    <div class="attorney-contact">

                        <?php if(get_field('phone_number')) { ?>
                        <div class="contact" id="phone">
                            <div class="icon"><span class="icon-attorney-bio-phone-icon"></span></div><a href="tel:<?php the_field('phone_number'); ?>"><?php the_field('phone_number'); ?> <?php the_field('phone_number_descriptor'); ?></a>
                        </div>
                        <?php } ?>


                        <?php if( have_rows('additional_numbers') ): ?>
                        <?php while( have_rows('additional_numbers') ): the_row(); ?>  
                            <div class="contact" id="phone">
                                <div class="icon"><span class="icon-attorney-bio-phone-icon"></span></div><a href="tel: <?php the_sub_field('additional'); ?>"> <?php the_sub_field('additional'); ?> <?php the_sub_field('additional_descriptor'); ?></a>
                            </div>
                        <?php endwhile; ?>
                        <?php endif; ?> 


                        <?php if(get_field('email_address')) { ?>
                        <div class="contact" id="email">
                            <div class="icon"><span class="icon-attorney-bio-email-icon"></span></div><a href="mailto:<?php the_field('email_address'); ?>"><?php the_field('email_address'); ?></a>
                        </div>
                        <?php } ?>
                        <?php if(get_field('vcard')) { ?>
                        <div class="contact" id="vcard">
                            <div class="icon"><span class="icon-attorney-bio-v-card-icon"></span></div><a href="<?php the_field('vcard'); ?>" download>Download vCard</a>
                        </div>
                        <?php } ?>
                        <?php if(get_field('linkedin')) { ?>
                        <div class="contact" id="linkedin">
                            <div class="icon"><span class="icon-attorney-bio-linked-in-icon"></span></div><a href="<?php the_field('linkedin'); ?>">LinkedIn</a>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="spacer-60"></div>
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </section>

    <section class="callouts">
        <div class="container">
            <div class="columns">
                <div class="spacer-30"></div>
                <?php if( have_rows('callout') ): ?>
                <?php while( have_rows('callout') ): the_row(); ?>  
                    <div class="column-33">
                        <div class="callout-title">
                            <p class="lrg serif caps spaced"><?php the_sub_field('title'); ?></p><span></span>
                        </div>
                        <?php the_sub_field('content'); ?>
                    </div>
                <?php endwhile; ?>
                <?php endif; ?> 
            </div>
        </div>
    </section>

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

<?php get_footer(); ?>