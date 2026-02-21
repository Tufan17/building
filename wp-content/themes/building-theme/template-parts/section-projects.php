<?php
/**
 * Template part for displaying signature projects on the front page
 * Dynamically pulls from WordPress posts
 *
 * @package Building_Theme
 */
?>
<style>
    /* Premium project card hover effects */
    .project-info-card {
        position: relative;
        overflow: hidden;
        transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .project-info-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(
            105deg,
            transparent 40%,
            rgba(198, 168, 90, 0.06) 45%,
            rgba(198, 168, 90, 0.12) 50%,
            rgba(198, 168, 90, 0.06) 55%,
            transparent 60%
        );
        transition: left 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        z-index: 1;
        pointer-events: none;
    }
    .project-info-card:hover::before {
        left: 100%;
    }
    .project-info-card:hover {
        transform: translateY(-4px);
        box-shadow:
            0 8px 40px rgba(198, 168, 90, 0.12),
            0 0 0 1px rgba(198, 168, 90, 0.15),
            inset 0 1px 0 rgba(198, 168, 90, 0.08);
        background: rgba(11, 17, 32, 0.98);
    }
    .project-info-card > * {
        position: relative;
        z-index: 2;
    }
    .project-info-card:hover h3 {
        color: #c6a85a;
        transition: color 0.5s ease;
    }
    .project-info-card:hover p {
        opacity: 1;
        transition: opacity 0.5s ease;
    }
</style>
<?php

$projects_query = new WP_Query(array(
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'ASC',
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

        // Get proje durumu
        $durum_terms_fp = wp_get_post_terms(get_the_ID(), 'proje_durumu', array('fields' => 'all'));
        $durum_slugs_fp = array();
        $durum_name_fp = '';
        if (!is_wp_error($durum_terms_fp) && !empty($durum_terms_fp)) {
            foreach ($durum_terms_fp as $dt) {
                $durum_slugs_fp[] = $dt->slug;
            }
            $durum_name_fp = $durum_terms_fp[0]->name;
        }
        $durum_attr_fp = implode(' ', $durum_slugs_fp);

        // Badge styling — premium gold theme
        $is_tamamlanan = (strpos(strtolower($durum_name_fp), 'tamamlanan') !== false);
        $fp_badge = $is_tamamlanan ? 'bg-primary/10 text-primary border-primary/25' : 'bg-white/5 text-gray-300 border-white/15';
        $fp_dot = $is_tamamlanan ? 'bg-primary' : 'bg-gray-400';

        // Get featured image
        $thumb = get_the_post_thumbnail_url(get_the_ID(), 'large');
        if (!$thumb) {
            $thumb = 'https://placehold.co/1200x900/0b1120/c6a85a?text=' . urlencode(get_the_title());
        }

        $is_even = ($index % 2 === 0);
        ?>

                <?php if ($is_even): ?>
            <!-- Alternating Layout (even) -->
            <div class="fp-project-item group grid grid-cols-1 lg:grid-cols-12 gap-12 items-center transition-all duration-500" data-status="<?php echo esc_attr($durum_attr_fp); ?>">
                <div class="lg:col-span-12 lg:order-1 order-2 mt-[-10%] lg:mt-0 lg:ml-[40%] lg:w-[60%] z-10">
                    <div class="project-info-card bg-navy-dark/95 backdrop-blur-xl p-10 lg:p-16 border-l border-primary/20 shadow-2xl relative cursor-pointer" onclick="window.location.href='<?php echo esc_url(get_permalink()); ?>'">
                        <div class="absolute -left-10 top-1/2 -translate-y-1/2 w-20 h-px bg-primary/30 hidden lg:block"></div>
                        <div class="flex items-center gap-3 mb-4">
                            <?php if ($durum_name_fp): ?>
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[9px] font-semibold border <?php echo $fp_badge; ?>">
                                    <span class="w-1.5 h-1.5 rounded-full <?php echo $fp_dot; ?>"></span>
                                    <?php echo esc_html($durum_name_fp); ?>
                                </span>
                            <?php endif; ?>
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
                    <a href="<?php the_permalink(); ?>" class="block aspect-[16/9] lg:aspect-[21/9] overflow-hidden grayscale-[30%] hover:grayscale-0 transition-all duration-1000">
                        <img alt="<?php the_title_attribute(); ?>"
                            class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-1000 ease-out"
                            src="<?php echo esc_url($thumb); ?>" />
                    </a>
                </div>
            </div>
                <?php else: ?>
            <!-- Standard Layout (odd) -->
            <div class="fp-project-item group grid grid-cols-1 lg:grid-cols-12 gap-12 items-center transition-all duration-500" data-status="<?php echo esc_attr($durum_attr_fp); ?>">
                <div class="lg:col-span-12 relative overflow-hidden">
                    <a href="<?php the_permalink(); ?>" class="block aspect-[16/9] lg:aspect-[21/9] overflow-hidden grayscale-[30%] hover:grayscale-0 transition-all duration-1000">
                        <img alt="<?php the_title_attribute(); ?>"
                            class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-1000 ease-out"
                            src="<?php echo esc_url($thumb); ?>" />
                    </a>
                </div>
                <div class="lg:col-span-12 mt-[-10%] lg:mt-0 lg:mr-[40%] lg:w-[60%] z-10">
                    <div class="project-info-card bg-navy-dark/95 backdrop-blur-xl p-10 lg:p-16 border-r border-primary/20 shadow-2xl relative text-right ml-auto cursor-pointer" onclick="window.location.href='<?php echo esc_url(get_permalink()); ?>'">
                        <div class="absolute -right-10 top-1/2 -translate-y-1/2 w-20 h-px bg-primary/30 hidden lg:block"></div>
                        <div class="flex items-center justify-end gap-3 mb-4">
                            <?php if ($durum_name_fp): ?>
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[9px] font-semibold border <?php echo $fp_badge; ?>">
                                    <span class="w-1.5 h-1.5 rounded-full <?php echo $fp_dot; ?>"></span>
                                    <?php echo esc_html($durum_name_fp); ?>
                                </span>
                            <?php endif; ?>
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
