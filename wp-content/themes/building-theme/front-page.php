<?php
/**
 * The front page template file
 *
 * @package Building_Theme
 */

get_header();
?>

<main id="primary" class="site-main">

    <!-- Hero Section -->
    <?php
    $hero_bg_type = get_option('prestige_hero_bg_type', prestige_get_default('prestige_hero_bg_type'));
    $hero_media = get_option('prestige_hero_media', prestige_get_default('prestige_hero_media'));
    $hero_subtitle = get_option('prestige_hero_subtitle', prestige_get_default('prestige_hero_subtitle'));
    $hero_title = get_option('prestige_hero_title', prestige_get_default('prestige_hero_title'));
    $hero_desc = get_option('prestige_hero_desc', prestige_get_default('prestige_hero_desc'));
    $hero_buttons = get_option('prestige_hero_buttons', prestige_get_default('prestige_hero_buttons'));
    if (!$hero_buttons || !is_array($hero_buttons)) {
        $hero_buttons = prestige_get_default('prestige_hero_buttons');
    }
    ?>
    <header class="relative h-screen min-h-[800px] flex items-center justify-center overflow-hidden">
        <!-- Background Overlay -->
        <div class="absolute inset-0 z-0">
            <?php if ($hero_bg_type === 'video' && $hero_media): ?>
                <!-- Fallback image behind video -->
                <img alt="Hero Background" class="absolute w-full h-full object-cover"
                    src="<?php echo esc_url(prestige_get_default('prestige_hero_media')); ?>" />
                <video autoplay muted loop playsinline class="absolute w-full h-full object-cover"
                    poster="<?php echo esc_url(prestige_get_default('prestige_hero_media')); ?>">
                    <source src="<?php echo esc_url($hero_media); ?>" type="video/mp4">
                </video>
            <?php else: ?>
                <img alt="Hero Background" class="w-full h-full object-cover" src="<?php echo esc_url($hero_media); ?>" />
            <?php endif; ?>
            <div class="absolute inset-0 bg-gradient-to-b from-navy-dark/80 via-navy-dark/40 to-background-dark"></div>
        </div>
        <div class="relative z-10 text-center px-4 max-w-5xl mx-auto mt-16">
            <?php if ($hero_subtitle): ?>
                <p class="text-primary tracking-[0.4em] uppercase text-xs mb-8 font-bold animate-fade-in-up">
                    <?php echo esc_html($hero_subtitle); ?>
                </p>
            <?php endif; ?>

            <h1 class="font-serif-heading text-5xl md:text-7xl lg:text-8xl text-white font-medium leading-tight mb-8 animate-fade-in-up"
                style="animation-delay: 200ms;">
                <?php echo wp_kses_post($hero_title); ?>
            </h1>

            <?php if ($hero_desc): ?>
                <p class="text-gray-300 text-lg md:text-xl font-light max-w-2xl mx-auto mb-12 leading-relaxed animate-fade-in-up"
                    style="animation-delay: 400ms;">
                    <?php echo esc_html($hero_desc); ?>
                </p>
            <?php endif; ?>

            <div class="flex flex-col sm:flex-row justify-center gap-6 animate-fade-in-up"
                style="animation-delay: 600ms;">
                <?php foreach ($hero_buttons as $btn): ?>
                    <?php if ($btn['type'] === 'primary'): ?>
                        <a class="bg-primary hover:bg-primary-dark text-navy-dark px-12 py-5 rounded-sm text-xs uppercase tracking-[0.3em] font-bold transition-all duration-500 shadow-2xl shadow-primary/10"
                            href="<?php echo esc_url($btn['link']); ?>">
                            <?php echo esc_html($btn['text']); ?>
                        </a>
                    <?php else: ?>
                        <a class="group flex items-center justify-center gap-2 text-white px-12 py-5 rounded-sm text-xs uppercase tracking-[0.3em] font-bold border border-white/10 hover:bg-white/5 transition-all duration-500"
                            href="<?php echo esc_url($btn['link']); ?>">
                            <span><?php echo esc_html($btn['text']); ?></span>
                            <span
                                class="material-icons text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 w-full transform -translate-x-1/2 animate-bounce text-white/50 text-center">
            <span class="material-icons text-4xl">keyboard_arrow_down</span>
        </div>
    </header>

    <!-- Brand Statement Section -->
    <?php
    $brand_quote = get_option('prestige_brand_quote', prestige_get_default('prestige_brand_quote'));
    $brand_signature = get_option('prestige_brand_signature', prestige_get_default('prestige_brand_signature'));
    ?>
    <section class="bg-off-white py-40 md:py-60 px-4 relative overflow-hidden">
        <div class="max-w-6xl mx-auto text-center relative z-10">
            <span class="block w-px h-24 bg-primary/30 mx-auto mb-16"></span>
            <h2 class="font-serif-heading text-4xl md:text-6xl text-navy-dark leading-snug tracking-tight">
                <?php echo wp_kses_post($brand_quote); ?>
            </h2>
            <?php if ($brand_signature): ?>
                <div class="mt-12 flex justify-center">
                    <img alt="CEO Signature" class="h-16 opacity-60 grayscale"
                        src="<?php echo esc_url($brand_signature); ?>" />
                </div>
            <?php endif; ?>
        </div>
        <!-- Decorative subtle pattern -->
        <div class="absolute top-0 left-0 w-full h-full opacity-[0.03] pointer-events-none"
            style="background-image: radial-gradient(#1e1b14 1px, transparent 1px); background-size: 32px 32px;">
        </div>
    </section>

    <!-- Signature Projects -->
    <?php
    $fp_durum_terms = get_terms(array(
        'taxonomy' => 'proje_durumu',
        'hide_empty' => false,
        'orderby' => 'name',
        'order' => 'ASC',
    ));
    if (is_wp_error($fp_durum_terms)) $fp_durum_terms = array();
    ?>
    <section class="py-32 bg-background-dark relative" id="projects">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
            <div class="flex flex-col md:flex-row justify-between items-end border-b border-white/10 pb-8">
                <div>
                    <h3 class="text-primary tracking-widest uppercase text-sm font-semibold mb-2">Seçilmiş Projeler</h3>
                    <h2 class="font-serif-heading text-4xl md:text-5xl text-white">Öne Çıkan Projeler</h2>
                </div>
                <div class="mt-6 md:mt-0">
                    <a class="text-white hover:text-primary transition-colors flex items-center gap-2 text-sm uppercase tracking-widest"
                        href="#">
                        Tüm Projeleri Görüntüle <span class="material-icons text-sm">arrow_forward</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Status Filter Tabs -->
        <?php if (!empty($fp_durum_terms)): ?>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16">
            <div class="flex flex-wrap gap-3 justify-center md:justify-start">
                <button type="button"
                    class="fp-status-tab active px-6 py-3 text-xs uppercase tracking-[0.2em] font-semibold border border-white/10 rounded-sm transition-all duration-500 text-primary bg-primary/5 border-primary/30"
                    data-status="all">
                    Tümü
                </button>
                <?php foreach ($fp_durum_terms as $dt): ?>
                <button type="button"
                    class="fp-status-tab px-6 py-3 text-xs uppercase tracking-[0.2em] font-semibold border border-white/10 rounded-sm transition-all duration-500 text-gray-400 hover:text-primary hover:border-primary/20"
                    data-status="<?php echo esc_attr($dt->slug); ?>">
                    <?php echo esc_html($dt->name); ?>
                </button>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <div class="flex flex-col gap-32 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" id="fp-projects-grid">
            <?php
            get_template_part('template-parts/section-projects');
            ?>
        </div>
    </section>

    <!-- Front Page Status Filter Script -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var tabs = document.querySelectorAll('.fp-status-tab');
        var items = document.querySelectorAll('.fp-project-item');
        if (tabs.length === 0 || items.length === 0) return;

        tabs.forEach(function(tab) {
            tab.addEventListener('click', function() {
                var status = this.getAttribute('data-status');

                tabs.forEach(function(t) {
                    t.classList.remove('active', 'text-primary', 'bg-primary/5', 'border-primary/30');
                    t.classList.add('text-gray-400');
                });
                this.classList.add('active', 'text-primary', 'bg-primary/5', 'border-primary/30');
                this.classList.remove('text-gray-400');

                items.forEach(function(item) {
                    var itemStatus = item.getAttribute('data-status') || '';
                    if (status === 'all' || itemStatus.indexOf(status) !== -1) {
                        item.style.opacity = '0';
                        item.style.display = '';
                        setTimeout(function() { item.style.opacity = '1'; }, 50);
                    } else {
                        item.style.opacity = '0';
                        setTimeout(function() { item.style.display = 'none'; }, 400);
                    }
                });
            });
        });
    });
    </script>

    <!-- Instagram Showcase -->
    <?php
    $insta_url = 'https://www.instagram.com/capitalyasaminsaat/';
    $insta_query = new WP_Query(array(
        'posts_per_page' => 6,
        'post_status' => 'publish',
        'category_name' => 'projelerimiz',
        'orderby' => 'date',
        'order' => 'DESC',
        'meta_query' => array(
            array('key' => '_thumbnail_id'),
        ),
    ));
    if ($insta_query->have_posts()):
    ?>
    <section class="bg-navy-dark py-24 md:py-32 overflow-hidden border-y border-white/5">
        <!-- Header -->
        <div class="text-center mb-14 md:mb-20 px-4">
            <div class="w-12 h-px bg-primary/40 mx-auto mb-10"></div>
            <div class="flex items-center justify-center gap-4 mb-5">
                <svg class="w-7 h-7 md:w-9 md:h-9 text-white fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                <h2 class="font-serif-heading text-3xl md:text-5xl text-white tracking-wider">INSTAGRAM</h2>
            </div>
            <p class="text-gray-500 text-xs tracking-[0.3em] uppercase font-medium">@capitalyasaminsaat</p>
        </div>

        <!-- Image Grid -->
        <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 md:gap-4">
                <?php while ($insta_query->have_posts()): $insta_query->the_post();
                    $insta_thumb = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
                    if (!$insta_thumb) continue;
                ?>
                <a href="<?php echo esc_url($insta_url); ?>" target="_blank" rel="noopener noreferrer"
                   class="group relative aspect-square overflow-hidden rounded-sm bg-black/30 block">
                    <img src="<?php echo esc_url($insta_thumb); ?>"
                         alt="<?php the_title_attribute(); ?>"
                         class="w-full h-full object-cover transition-all duration-700 group-hover:scale-110"
                         loading="lazy" />
                    <!-- Hover Overlay -->
                    <div class="absolute inset-0 bg-navy-dark/70 flex flex-col items-center justify-center gap-3 opacity-0 group-hover:opacity-100 transition-all duration-500">
                        <svg class="w-8 h-8 text-white fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        <span class="text-white/80 text-[10px] uppercase tracking-widest font-medium">Görüntüle</span>
                    </div>
                    <!-- Bottom gold accent line -->
                    <div class="absolute bottom-0 left-0 right-0 h-[2px] bg-primary scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
                </a>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>

        <!-- Follow Button -->
        <div class="text-center mt-12 md:mt-16">
            <a href="<?php echo esc_url($insta_url); ?>" target="_blank" rel="noopener noreferrer"
               class="inline-flex items-center gap-3 px-10 py-4 border border-primary/20 text-primary text-xs uppercase tracking-[0.25em] font-bold rounded-sm hover:bg-primary hover:text-navy-dark transition-all duration-500 group">
                <span>Bizi Takip Edin</span>
                <span class="material-icons text-sm group-hover:translate-x-1 transition-transform duration-300">arrow_forward</span>
            </a>
        </div>
    </section>
    <?php endif; ?>

    <!-- Prestige Metrics -->
    <?php
    $metrics = get_option('prestige_metrics');
    if (!$metrics || !is_array($metrics)) {
        $metrics = prestige_get_default('prestige_metrics');
    }
    $metric_count = count($metrics);
    ?>
    <?php if ($metric_count > 0): ?>
        <section class="py-32 bg-navy-dark border-y border-white/5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div
                    class="grid grid-cols-1 md:grid-cols-<?php echo min($metric_count, 4); ?> gap-16 text-center divide-y md:divide-y-0 md:divide-x divide-white/5">
                    <?php foreach ($metrics as $m): ?>
                        <div class="p-8">
                            <span
                                class="block font-serif-heading text-5xl md:text-7xl text-primary mb-6"><?php echo esc_html($m['value']); ?></span>
                            <span
                                class="text-gray-400 text-xs uppercase tracking-[0.3em] font-medium"><?php echo esc_html($m['label']); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Why Choose Us -->
    <?php
    $standards = get_option('prestige_standards');
    if (!$standards || !is_array($standards)) {
        $standards = prestige_get_default('prestige_standards');
    }
    $std_count = count($standards);
    ?>
    <?php if ($std_count > 0): ?>
        <section class="py-40 bg-navy-dark" id="expertise">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-28">
                    <h2 class="font-serif-heading text-4xl md:text-5xl text-white mb-8">
                        Prestij Standartları
                    </h2>
                    <div class="w-12 h-px bg-primary mx-auto opacity-50"></div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-<?php echo min($std_count, 3); ?> gap-16">
                    <?php foreach ($standards as $std): ?>
                        <div
                            class="group p-10 border border-white/5 hover:border-primary/20 transition-all duration-700 bg-white/[0.01] hover:bg-white/[0.02]">
                            <?php if (!empty($std['icon'])): ?>
                                <div
                                    class="w-14 h-14 rounded-full bg-primary/5 flex items-center justify-center mb-10 group-hover:bg-primary/10 transition-all duration-500">
                                    <span
                                        class="material-icons text-primary/80 group-hover:text-primary transition-colors"><?php echo esc_html($std['icon']); ?></span>
                                </div>
                            <?php endif; ?>
                            <h3 class="font-serif-heading text-xl text-white mb-4"><?php echo esc_html($std['title']); ?></h3>
                            <p class="text-gray-400 text-sm leading-relaxed font-light"><?php echo esc_html($std['desc']); ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Pre-Footer CTA -->
    <section class="py-24 relative overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img alt="Detail of luxury marble staircase" class="w-full h-full object-cover opacity-20 grayscale"
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuB-JUjlqt7HFKrLzFo49NkXpMzi1kUb8SUyTcq57MndgH4Cr29Ro8lED-UrQIeEWQbyZAU37Q-av8BAtSjENC0E8WVBN_H8vshgtN39tO5cBOfjBGDgjkntmkzlrZ-doNmqlnQyr-DVEGch7t6tIOh_0WZOy1pecKmKO09F8uBlOcIaVS4XBwzAgx6LHfgM7g4MSMVgjHnMKhzlf-LI8hdIRzvRIWXgCUwac0MWI7BEqagg-SSd-6rHI-nMk462QLf7YobK2FQVe6s8" />
            <div class="absolute inset-0 bg-background-dark/80"></div>
        </div>
        <div class="relative z-10 max-w-4xl mx-auto px-4 text-center">
            <h2 class="font-serif-heading text-4xl md:text-5xl text-white mb-8">
                Hayalinizdeki Yapıyı Birlikte Tasarlayalım
            </h2>
            <p class="text-gray-300 mb-10 font-light text-lg">
                Bir fincan kahve eşliğinde projenizi konuşmak ister misiniz? Vizyonunuzu dinlemek ve size özel çözümler
                sunmak için buradayız.
            </p>
            <a class="inline-block bg-primary hover:bg-primary-dark text-navy-dark px-14 py-6 rounded-sm text-xs uppercase tracking-[0.3em] font-bold transition-all duration-500 shadow-2xl shadow-primary/10"
                href="/iletisim">
                Hadi Tanışalım ☕
            </a>
        </div>
    </section>

</main><!-- #main -->

<?php
get_footer();
