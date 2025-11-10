<?php
/**
 * Theme footer
 *
 * @package Postali Child
 * @author Postali LLC
**/
?>
<footer>
    <section class="footer">
        <div class="container">
            <div class="columns">
                <div class="column-25">
                    <a href="/"><img src="/wp-content/uploads/2024/10/primary-nav-logo.svg" alt="Kurzman Eisenberg logo"></a>
                </div>
                <div class="column-75">
                    <div class="footer-blocks"> 
                        <p class="footer-title">Offices</p>
                        <?php if( have_rows('location','options') ): ?>
                        <?php while( have_rows('location','options') ): the_row(); ?>  
                        <div class="column-50">
                            <p>
                                <strong><?php the_sub_field('location_name'); ?></strong><br>
                                <?php the_sub_field('address'); ?><br>
                                P: <?php the_sub_field('phone'); ?><br>
                                F: <?php the_sub_field('fax'); ?><br><br>
                                <a href="<?php the_sub_field('directions'); ?>" target="blank">Directions</a>
                            </p>
                        </div>
                        <?php endwhile; ?>
                        <?php endif; ?> 
                    </div>
                    <div class="footer-blocks menus">
                        <div class="column-50">
                            <p class="footer-title">Practice Areas</p>
                            <?php wp_nav_menu( [ 'container' => false, 'theme_location' => 'footer-practice' ] ); ?> 
                        </div>
                        <div class="column-50">
                            <p class="footer-title">Navigation</p>
                            <?php wp_nav_menu( [ 'container' => false, 'theme_location' => 'footer-nav' ] ); ?> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="spacer-90"></div>
            <div class="columns">
                <div class="column-full utility">
                    <p class="copyright-year">Copyright &copy; <?php echo date('Y'); ?> Kurzman Eisenberg Corbin & Lever, LLP | Attorney advertising | <a href="/disclaimer/">Disclaimer</a> | <a href="/sitemap/">Sitemap</a></p>
                    <div class="spacer-15"></div>
                    <div class="postali">
                        <a href="https://www.postali.com/?utm_source=kurzmaneisenberg&utm_medium=footer&utm_campaign=client-sites"><img src="/wp-content/uploads/2025/10/postali-tag-new.png" alt="Postali.com"></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</footer>
<!-- Add JSON Schema here -->
    <?php 
    // Global Schema
    $global_schema = get_field('global_schema', 'options');
    if ( !empty($global_schema) ) :
        echo '<script type="application/ld+json">' . $global_schema . '</script>';
    endif;

    // Single Page Schema
    $single_schema = get_field('single_schema');
    if ( !empty($single_schema) ) :
        echo '<script type="application/ld+json">' . $single_schema . '</script>';
    endif; ?>

<?php wp_footer(); ?>
</body>
</html>


