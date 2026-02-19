<?php
/**
 * Template Name: Projelerimiz
 *
 * Projects portfolio page template
 *
 * @package Building_Theme
 */

get_header();

// Get all categories for filter buttons
$categories = get_categories(array(
    'orderby' => 'name',
    'order' => 'ASC',
    'hide_empty' => true,
));

// Get projects from "Projelerimiz" category and its children
$projelerimiz_cat = get_category_by_slug('projelerimiz');
$cat_id = $projelerimiz_cat ? $projelerimiz_cat->term_id : 0;

// Get child categories for filters
$child_cats = get_categories(array(
    'parent' => $cat_id,
    'hide_empty' => false,
));

$projects_query = new WP_Query(array(
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'cat' => $cat_id,
    'orderby' => 'date',
    'order' => 'DESC',
));
?>

<main class="w-full bg-background-dark">
    <!-- Hero Section -->
    <section
        class="relative w-full py-24 md:py-32 lg:py-40 flex flex-col items-center justify-center bg-background-dark border-b border-white/5"
        style="background-image: url(&quot;data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E&quot;);">
        <div
            class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-background-dark pointer-events-none">
        </div>
        <div class="relative z-10 text-center px-4 max-w-4xl mx-auto flex flex-col gap-6">
            <div class="flex items-center justify-center gap-2 mb-4">
                <div class="h-[1px] w-12 bg-primary"></div>
                <span class="text-primary tracking-[0.2em] text-xs font-semibold uppercase">Portföy</span>
                <div class="h-[1px] w-12 bg-primary"></div>
            </div>
            <h1 class="font-serif-heading text-5xl md:text-7xl lg:text-8xl font-normal text-white leading-tight">
                Seçilmiş <span class="italic text-white/90">Projeler</span>
            </h1>
            <p class="text-gray-400 font-light text-lg md:text-xl max-w-2xl mx-auto leading-relaxed">
                Hassasiyet ile sanatın buluştuğu, tanımlayıcı yapılar ve mekanlar. Lüks geliştirme mirasımızı keşfedin.
            </p>
        </div>
    </section>

    <!-- Filters Section -->
    <?php if (!empty($child_cats)): ?>
        <section class="top-[80px] z-40 bg-background-dark/95 backdrop-blur-sm border-b border-white/5 py-6">
            <div class="mx-auto max-w-[1440px] px-6 lg:px-12">
                <div class="flex gap-3 overflow-x-auto no-scrollbar items-center md:justify-center pb-2 md:pb-0">
                    <button
                        class="project-filter-btn active shrink-0 h-10 px-6 rounded-full bg-primary text-navy-dark text-xs font-bold uppercase tracking-widest transition-all hover:scale-105"
                        data-filter="all">
                        Tüm Projeler
                    </button>
                    <?php foreach ($child_cats as $cat): ?>
                        <button
                            class="project-filter-btn shrink-0 h-10 px-6 rounded-full bg-white/5 border border-white/10 text-white/80 text-sm font-medium hover:bg-white/10 hover:text-white hover:border-white/20 transition-all"
                            data-filter="<?php echo esc_attr($cat->slug); ?>">
                            <?php echo esc_html($cat->name); ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Projects Grid -->
    <section class="mx-auto max-w-[1440px] px-6 lg:px-12 py-16 lg:py-24 bg-background-dark">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-20 lg:gap-y-32" id="projects-grid">
            <?php if ($projects_query->have_posts()): ?>
                <?php $index = 0;
                while ($projects_query->have_posts()):
                    $projects_query->the_post();
                    $index++; ?>
                    <?php
                    // Get custom data
                    $konum_terms = wp_get_post_terms(get_the_ID(), 'konum', array('orderby' => 'parent', 'order' => 'DESC'));
                    $yil = get_post_meta(get_the_ID(), '_prestige_insaat_yili', true);

                    // Build location string
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
                        $thumb = 'https://placehold.co/800x600/1e1b14/c6a758?text=' . urlencode(get_the_title());
                    }

                    // Get post categories for filtering
                    $post_cats = wp_get_post_categories(get_the_ID(), array('fields' => 'slugs'));
                    $cat_classes = implode(' ', $post_cats);

                    $is_offset = ($index % 2 === 0);
                    ?>

                    <div class="project-item group flex flex-col gap-6 cursor-pointer <?php echo $is_offset ? 'md:mt-24' : ''; ?>"
                        data-categories="<?php echo esc_attr($cat_classes); ?>">
                        <a href="<?php the_permalink(); ?>" class="block">
                            <div class="overflow-hidden rounded-lg aspect-[4/3] relative">
                                <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-colors z-10"></div>
                                <img alt="<?php the_title_attribute(); ?>"
                                    class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105"
                                    src="<?php echo esc_url($thumb); ?>" />
                                <div
                                    class="absolute bottom-6 right-6 z-20 opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-500">
                                    <div
                                        class="size-12 rounded-full bg-primary flex items-center justify-center text-background-dark shadow-lg">
                                        <span class="material-icons">arrow_outward</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="flex flex-col gap-2">
                            <div
                                class="flex justify-between items-start border-b border-white/10 pb-4 mb-2 group-hover:border-primary/50 transition-colors duration-500">
                                <h3
                                    class="font-serif-heading text-3xl md:text-4xl text-white group-hover:text-primary transition-colors">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>
                                <span class="text-sm font-mono text-gray-500 pt-2">
                                    <?php echo str_pad($index, 2, '0', STR_PAD_LEFT); ?>
                                </span>
                            </div>
                            <div class="flex items-center gap-6 text-sm text-gray-400 font-medium tracking-wide">
                                <?php if ($location): ?>
                                    <span class="flex items-center gap-1">
                                        <span class="material-icons text-[16px] text-primary">location_on</span>
                                        <?php echo esc_html($location); ?>
                                    </span>
                                    <span class="w-1 h-1 rounded-full bg-white/20"></span>
                                <?php endif; ?>
                                <?php if ($yil): ?>
                                    <span>
                                        <?php echo esc_html($yil); ?>
                                    </span>
                                    <span class="w-1 h-1 rounded-full bg-white/20"></span>
                                <?php endif; ?>
                                <?php
                                $display_cats = wp_get_post_categories(get_the_ID(), array('fields' => 'names'));
                                $display_cats = array_diff($display_cats, array('Projelerimiz'));
                                if (!empty($display_cats)):
                                    ?>
                                    <span class="text-white/80">
                                        <?php echo esc_html(implode(', ', $display_cats)); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                <?php endwhile;
                wp_reset_postdata(); ?>
            <?php else: ?>
                <div class="col-span-2 text-center py-20">
                    <span class="material-icons text-6xl text-gray-600 mb-4 block">construction</span>
                    <h3 class="font-serif-heading text-2xl text-white mb-2">Henüz proje eklenmemiş</h3>
                    <p class="text-gray-400">Projelerimiz kategorisinde yazı ekleyerek burada gösterebilirsiniz.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-surface-dark border-t border-white/5 py-24 md:py-32">
        <div class="mx-auto max-w-[1440px] px-6 lg:px-12">
            <div class="flex flex-col lg:flex-row items-start lg:items-end justify-between gap-12">
                <div class="flex flex-col gap-8 max-w-3xl">
                    <h2
                        class="font-serif-heading text-4xl md:text-5xl lg:text-7xl leading-tight font-medium text-white">
                        Geleceği birlikte <span class="text-primary italic">inşa edelim.</span>
                    </h2>
                    <p class="text-gray-400 text-lg md:text-xl font-light max-w-xl">
                        Bir sonraki vizyoner projeniz hakkında konuşmaya başlayın. Ekibimiz mimari hayallerinizi gerçeğe
                        dönüştürmeye hazır.
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row gap-4 w-full lg:w-auto">
                    <a href="<?php echo esc_url(home_url('#contact')); ?>"
                        class="h-14 px-10 rounded-sm bg-primary text-navy-dark text-xs font-bold uppercase tracking-[0.3em] hover:bg-primary-dark transition-all duration-500 shadow-2xl shadow-primary/10 whitespace-nowrap flex items-center justify-center">
                        Proje Başlat
                    </a>
                    <a href="<?php echo esc_url(home_url('#contact')); ?>"
                        class="h-14 px-8 rounded-full bg-transparent border border-white/20 text-white text-base font-medium hover:bg-white/5 hover:border-white transition-all duration-300 whitespace-nowrap flex items-center justify-center">
                        İletişime Geç
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Filter JS -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterBtns = document.querySelectorAll('.project-filter-btn');
        const projectItems = document.querySelectorAll('.project-item');

        filterBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                // Update active button style
                filterBtns.forEach(function (b) {
                    b.classList.remove('bg-primary', 'text-background-dark', 'active');
                    b.classList.add('bg-white/5', 'border', 'border-white/10', 'text-white/80');
                });
                this.classList.remove('bg-white/5', 'border', 'border-white/10', 'text-white/80');
                this.classList.add('bg-primary', 'text-background-dark', 'active');

                var filter = this.getAttribute('data-filter');

                projectItems.forEach(function (item) {
                    if (filter === 'all' || item.getAttribute('data-categories').indexOf(filter) !== -1) {
                        item.style.display = '';
                        item.style.opacity = '0';
                        item.style.transform = 'translateY(20px)';
                        setTimeout(function () {
                            item.style.transition = 'opacity 0.5s, transform 0.5s';
                            item.style.opacity = '1';
                            item.style.transform = 'translateY(0)';
                        }, 50);
                    } else {
                        item.style.opacity = '0';
                        item.style.transform = 'translateY(20px)';
                        setTimeout(function () {
                            item.style.display = 'none';
                        }, 500);
                    }
                });
            });
        });
    });
</script>

<?php get_footer(); ?>