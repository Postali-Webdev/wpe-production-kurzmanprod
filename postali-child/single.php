<?php
/**
 * Single template
 *
 * @package Postali Parent
 * @author Postali LLC
 */

get_header();?>

<div class="body-container">
 
    <section class="page-banner" style="background:url('/wp-content/uploads/2025/08/header-blog.jpg);">
        <div class="container">
            <p id="breadcrumbs"><span><span><a href="/">Homepage</a></span> &gt; <span><a href="/news/">News & Resources</a></span> &gt; <span class="breadcrumb_last" aria-current="page">New York’s Prompt Payment Act Amendments</span></span></p>
            <div class="spacer-90"></div>
            <div class="columns">
                <div class="column-50 block">
                    <p class="sm caps serif spaced"><?php echo get_the_date(); ?></p>
                    <h1><?php the_title(); ?></h1>
                    <div class="spacer-30"></div>
                    <p class="sm">Written by: Kurzman Eisenberg</p>
                </div>
            </div>
        </div>
    </section>

    <section class="posts">

        <div class="rellax left" data-rellax-speed="2">
            <img src="/wp-content/uploads/2024/11/pa-left.png" />
        </div>

        <script>
            var rellax = new Rellax('.rellax');
        </script>	

        <div class="container">
            <div class="columns">
                <div class="column-50 block center post-content">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </section>

    <?php get_template_part('block','contact-cta'); ?>

    <div class="spacer-90"></div>

</div>

<?php get_footer(); ?>