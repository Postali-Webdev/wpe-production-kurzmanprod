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

                <?php if(get_field('custom_sort_order')) { ?>

                <?php if( have_rows('attorneys') ): ?>
                <?php while( have_rows('attorneys') ): the_row(); ?>
                    <?php $post_object = get_sub_field('attorney'); ?>
                    <?php if( $post_object ): ?>
                        <?php // override $post
                        $post = $post_object;
                        setup_postdata( $post );
                        ?>
                        
                        <a class="practice-attorney" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">      
                            <div class="attorney-headshot">
                            <?php if (has_post_thumbnail( $post->ID ) ): ?>
                            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
                                <img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>">
                            <?php endif; ?>
                            </div>
                            <p><strong><?php the_title(); ?></strong></p>
                            <?php if(get_sub_field('custom_title')) { ?>
                            <p class="caps spaced serif"><?php the_sub_field('custom_title_text'); ?></p>
                            <?php } else { ?>
                            <p class="caps spaced serif"><?php the_field('title'); ?></p>
                            <?php } ?>
                        </a>

                        <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                    <?php endif; ?>
                <?php endwhile; ?>
                <?php endif; ?>

                <?php } else {  ?>

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

                <?php } ?>

                </div>
            </div>
            <div class="spacer-break"></div>
            <div class="more"><p class="show">Read More</p><p class="hide">Close Details</p> <span class="icon-accordion-expand-and-collapse-icon"></span></div>
            </div>
            <div class="spacer-60"></div>
        </div>
    </section>