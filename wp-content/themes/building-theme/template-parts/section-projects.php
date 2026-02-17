<?php
/**
 * Template part for displaying signature projects on the front page
 * Dynamically pulls from WordPress posts
 *
 * @package Building_Theme
 */

$projects_query = new WP_Query(array(
    'posts_per_page' => 2,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
    'category_name' => 'projelerimiz',
));

if ($projects_query->have_posts()):
    $index = 0;
    while ($projects_query->have_posts()):
        $projects_query->the_post();
        $index++;

        // Get custom data
        $konum_terms = wp_get_post_terms(get_the_ID(), 'konum', array('orderby' => 'parent', 'order' => 'DESC'));
        $yil = get_post_meta(get_the_ID(), '_prestige_insaat_yili', true);

        // Build location string (Şehir, Ülke)
        $location_parts = array();
        if (!is_wp_error($konum_terms) && !empty($konum_terms)) {
            foreach ($konum_terms as $term) {
                $location_parts[] = $term->name;
            }
        }
        $location = implode(', ', $location_parts);

        // Get featured image
        $thumb = get_the_post_thumbnail_url(get_the_ID(), 'large');
        if (!$thumb) {
            $thumb = 'https://placehold.co/800x600/1e1b14/c9a96e?text=' . urlencode(get_the_title());
        }

        $is_even = ($index % 2 === 0);
        ?>

                <?php if ($is_even): ?>
            <!-- Alternating Layout (even) -->
            <div class="group grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-5 lg:order-1 lg:-mr-12 z-10 order-2">
                    <div class="bg-background-dark/95 backdrop-blur-sm p-8 lg:p-12 border-r border-primary/30 text-right">
                        <div class="flex items-center justify-end gap-3 mb-2">
                                        <?php if ($location): ?>
                                <span class="text-primary text-xs uppercase tracking-widest"><?php echo esc_html($location); ?></span>
                          <?php endif; ?>
                         <?php if ($yil): ?>
                                <span class="text-gray-500 text-xs">•</span>
                                <span class="text-gray-400 text-xs uppercase tracking-widest"><?php echo esc_html($yil); ?></span>
                          <?php endif; ?>
                        </div>
                        <h3 class="font-serif-heading text-3xl md:text-4xl text-white mb-6"><?php the_title(); ?></h3>
                        <p class="text-gray-400 mb-8 font-light leading-relaxed">
                       <?php echo wp_trim_words(get_the_excerpt(), 25, '...'); ?>
                        </p>
                        <a class="inline-flex items-center justify-end text-primary border-b border-primary/30 pb-1 hover:text-white hover:border-white transition-all uppercase text-xs tracking-widest ml-auto"
                            href="<?php the_permalink(); ?>">
                            Projeyi İncele
                        </a>
                    </div>
                </div>
                <div class="lg:col-span-7 lg:order-2 order-1 relative overflow-hidden rounded-lg">
                    <div class="aspect-[4/3] overflow-hidden">
                        <img alt="<?php the_title_attribute(); ?>"
                            class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 ease-out"
                            src="<?php echo esc_url($thumb); ?>" />
                    </div>
                </div>
            </div>
                <?php else: ?>
            <!-- Standard Layout (odd) -->
            <div class="group grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-7 relative overflow-hidden rounded-lg">
                    <div class="aspect-[4/3] overflow-hidden">
                        <img alt="<?php the_title_attribute(); ?>"
                            class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 ease-out"
                            src="<?php echo esc_url($thumb); ?>" />
                    </div>
                </div>
                <div class="lg:col-span-5 lg:-ml-12 z-10">
                    <div class="bg-background-dark/95 backdrop-blur-sm p-8 lg:p-12 border-l border-primary/30">
                        <div class="flex items-center gap-3 mb-2">
                                        <?php if ($location): ?>
                                <span class="text-primary text-xs uppercase tracking-widest"><?php echo esc_html($location); ?></span>
                                        <?php endif; ?>
                                        <?php if ($yil): ?>
                                <span class="text-gray-500 text-xs">•</span>
                                <span class="text-gray-400 text-xs uppercase tracking-widest"><?php echo esc_html($yil); ?></span>
                          <?php endif; ?>
                        </div>
                        <h3 class="font-serif-heading text-3xl md:text-4xl text-white mb-6"><?php the_title(); ?></h3>
                        <p class="text-gray-400 mb-8 font-light leading-relaxed">
                       <?php echo wp_trim_words(get_the_excerpt(), 25, '...'); ?>
                        </p>
                        <a class="inline-flex items-center text-primary border-b border-primary/30 pb-1 hover:text-white hover:border-white transition-all uppercase text-xs tracking-widest"
                            href="<?php the_permalink(); ?>">
                            Projeyi İncele
                        </a>
                    </div>
                </div>
            </div>
                <?php endif; ?>

        <?php
    endwhile;
    wp_reset_postdata();
endif;
?>