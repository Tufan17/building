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
            $thumb = 'https://placehold.co/1200x900/0b1120/c6a85a?text=' . urlencode(get_the_title());
        }

        $is_even = ($index % 2 === 0);
        ?>

                <?php if ($is_even): ?>
            <!-- Alternating Layout (even) -->
            <div class="group grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-12 lg:order-1 order-2 mt-[-10%] lg:mt-0 lg:ml-[40%] lg:w-[60%] z-10">
                    <div class="bg-navy-dark/95 backdrop-blur-xl p-10 lg:p-16 border-l border-primary/20 shadow-2xl relative">
                        <div class="absolute -left-10 top-1/2 -translate-y-1/2 w-20 h-px bg-primary/30 hidden lg:block"></div>
                        <div class="flex items-center gap-3 mb-4">
                                        <?php if ($location): ?>
                                <span class="text-primary text-[10px] font-bold uppercase tracking-[0.3em]"><?php echo esc_html($location); ?></span>
                          <?php endif; ?>
                         <?php if ($yil): ?>
                                <span class="text-gray-600 text-[10px]">•</span>
                                <span class="text-gray-400 text-[10px] uppercase tracking-[0.3em] font-medium"><?php echo esc_html($yil); ?></span>
                          <?php endif; ?>
                        </div>
                        <h3 class="font-serif-heading text-4xl lg:text-5xl text-white mb-8 leading-tight"><?php the_title(); ?></h3>
                        <p class="text-gray-400 mb-10 font-light leading-relaxed text-lg italic opacity-80">
                       <?php echo wp_trim_words(get_the_excerpt(), 25, '...'); ?>
                        </p>
                        <a class="group inline-flex items-center gap-4 text-primary text-[10px] uppercase tracking-[0.3em] font-bold hover:text-white transition-all duration-500"
                            href="<?php the_permalink(); ?>">
                            <span>Projeyi İncele</span>
                            <span class="w-12 h-px bg-primary/30 group-hover:w-20 group-hover:bg-white transition-all duration-500"></span>
                        </a>
                    </div>
                </div>
                <div class="lg:col-span-12 lg:order-2 order-1 relative overflow-hidden">
                    <div class="aspect-[16/9] lg:aspect-[21/9] overflow-hidden grayscale-[30%] hover:grayscale-0 transition-all duration-1000">
                        <img alt="<?php the_title_attribute(); ?>"
                            class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-1000 ease-out"
                            src="<?php echo esc_url($thumb); ?>" />
                    </div>
                </div>
            </div>
                <?php else: ?>
            <!-- Standard Layout (odd) -->
            <div class="group grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-12 relative overflow-hidden">
                    <div class="aspect-[16/9] lg:aspect-[21/9] overflow-hidden grayscale-[30%] hover:grayscale-0 transition-all duration-1000">
                        <img alt="<?php the_title_attribute(); ?>"
                            class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-1000 ease-out"
                            src="<?php echo esc_url($thumb); ?>" />
                    </div>
                </div>
                <div class="lg:col-span-12 mt-[-10%] lg:mt-0 lg:mr-[40%] lg:w-[60%] z-10">
                    <div class="bg-navy-dark/95 backdrop-blur-xl p-10 lg:p-16 border-r border-primary/20 shadow-2xl relative text-right ml-auto">
                        <div class="absolute -right-10 top-1/2 -translate-y-1/2 w-20 h-px bg-primary/30 hidden lg:block"></div>
                        <div class="flex items-center justify-end gap-3 mb-4">
                                        <?php if ($location): ?>
                                <span class="text-primary text-[10px] font-bold uppercase tracking-[0.3em]"><?php echo esc_html($location); ?></span>
                                        <?php endif; ?>
                                        <?php if ($yil): ?>
                                <span class="text-gray-600 text-[10px]">•</span>
                                <span class="text-gray-400 text-[10px] uppercase tracking-[0.3em] font-medium"><?php echo esc_html($yil); ?></span>
                          <?php endif; ?>
                        </div>
                        <h3 class="font-serif-heading text-4xl lg:text-5xl text-white mb-8 leading-tight"><?php the_title(); ?></h3>
                        <p class="text-gray-400 mb-10 font-light leading-relaxed text-lg italic opacity-80">
                       <?php echo wp_trim_words(get_the_excerpt(), 25, '...'); ?>
                        </p>
                        <a class="group inline-flex flex-row-reverse items-center gap-4 text-primary text-[10px] uppercase tracking-[0.3em] font-bold hover:text-white transition-all duration-500"
                            href="<?php the_permalink(); ?>">
                            <span>Projeyi İncele</span>
                            <span class="w-12 h-px bg-primary/30 group-hover:w-20 group-hover:bg-white transition-all duration-500"></span>
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
