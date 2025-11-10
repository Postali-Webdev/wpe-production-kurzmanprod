<?php
/**
 * Post Archive
 *
 * @package Postali Parent
 * @author Postali LLC
 */

get_header(); ?>

<div class="body-container">

    <script type="text/javascript" id="dropdown-script">

        jQuery(document).ready(function ($) {
            jQuery(".search_box").keyup(function () {

                var word = $('.search_box').val();
                var search_type = "live";

                $.ajax({
                    url:'../wp-content/themes/postali-child/db_attorneys.php',
                    type:'GET',
                    data:'word=' + word +'&search_type='+search_type,
                    cache: 'false',
                    success: function(data){
                        $('#results').html($(data));

                    },
                    error: function(err){
                        alert(err.responseText);
                    }
                });
            });

        });

    </script>

    <section class="attorneys" id="top">
        <div class="container">
            <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?> 
            <div class="spacer-90"></div>
            <div class="columns">
                <div class="column-50 centered center">
                    <h1>
                        <?php
                        $value = "Our Attorneys";
                        echo strtok($value, " "); // Test
                        ?>    
                        <span>
                        <?php
                        echo substr(strstr($value," "), 1);
                        ?>
                        </span>
                    </h1>
                    <div class="spacer-90"></div>
                    <div class="searchandfilter">
                        <div class="SF_container">
                            <input class="search_box" placeholder="Search Attorney by Name">
                            <ul id ="results"></ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="spacer-60"></div>

            <div class="results-toggle-container">
                <p class="caps spaced serif">Filter By:</p>
                <div class="filter-row-container">
                    <span class="mobile-select">Select <span class="icon-down-arrow"></span></span>
                    <div class="filter-row">
                        <div data="all" class="filter-select all" onClick="(function(){location.reload();})();return false;">All</div>
                    <?php 
                        // Get the taxonomy's terms
                        $terms = get_terms(
                            array(
                                'taxonomy'   => 'practice_areas',
                                'hide_empty' => false,
                                'parent' => 0
                            )
                        );

                        // Check if any term exists
                        if ( ! empty( $terms ) && is_array( $terms ) ) {
                            // Run a loop and print them all
                            foreach ( $terms as $term ) { ?>

                                <div data="<?php echo $term->slug; ?>" class="filter-select" onClick="(function(){ jQuery('.toggle-text').text('<?php echo $term->name; ?>'); return false; })();return false;"><?php echo $term->name; ?></div>

                        <?php } ?>
                    <?php } ?>
                    </div>
                </div>
            </div>

            <div class="spacer-90"></div>

            <div class="columns heading">
                <div class="column-full">
                    <h2><span class="toggle-text">All</span> Attorneys</h2>
                </div>
            </div>
            
            <div class="spacer-60"></div>

            <div class="columns attorneys-holder">
                <?php
                $wp_query = new WP_Query(array(
                    'posts_per_page'    => -1,
                    'post_type'         => 'attorneys', 
                    'order'             => 'DESC',
                    'post_status'       => 'publish',
                ));
                
                while ($wp_query->have_posts()): $wp_query->the_post()?>   
                
                <div class="column-25">        
                    <a class="attorney-headshot" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    <?php if (has_post_thumbnail( $post->ID ) ): ?>
                    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
                        <img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>">
                    <?php endif; ?>
                    </a>
                    <div class="attorney-details">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><h3><?php the_title(); ?></h2></a>
                        <p class="caps spaced serif"><?php the_field('title'); ?></p>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="arrowed-link"> <p>Attorney Bio</p> <span class="icon-right-arrow"></span></a>       
                    </div>
                </div>

                <?php endwhile; wp_reset_postdata(); ?>
            </div>

            <div class="columns">
                <div class="column-full">
                    <div class="spacer-60"></div>   
                    <a href="#top" class="btn gradient">Back to Top</a>
                </div>
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

<?php get_footer();
