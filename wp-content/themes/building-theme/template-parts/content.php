<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Building_Theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('glass-card mb-4'); ?>>
    <header class="entry-header">
        <?php
        if (is_singular()):
            the_title('<h1 class="entry-title">', '</h1>');
        else:
            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
        endif;

        if ('post' === get_post_type()):
            ?>
            <div class="entry-meta">
                <?php
                // You could add post meta here (date, author, etc.)
                ?>
            </div><!-- .entry-meta -->
        <?php endif; ?>
    </header><!-- .entry-header -->

    <?php the_post_thumbnail('large', array('class' => 'rounded mb-3')); ?>

    <div class="entry-content">
        <?php
        the_content(
            sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'building-theme'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                wp_kses_post(get_the_title())
            )
        );

        wp_link_pages(
            array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'building-theme'),
                'after' => '</div>',
            )
        );
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php
        // You could add footer meta here (categories, tags)
        ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->