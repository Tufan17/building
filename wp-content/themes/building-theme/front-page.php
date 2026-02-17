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
            <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/40 to-background-dark"></div>
        </div>
        <div class="relative z-10 text-center px-4 max-w-5xl mx-auto mt-16">
            <?php if ($hero_subtitle): ?>
                <p class="text-primary tracking-[0.3em] uppercase text-sm mb-6 font-medium animate-fade-in-up">
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
                        <a class="bg-primary hover:bg-primary-dark text-white px-10 py-4 rounded text-sm uppercase tracking-widest transition-all duration-300 shadow-lg shadow-primary/20"
                            href="<?php echo esc_url($btn['link']); ?>">
                            <?php echo esc_html($btn['text']); ?>
                        </a>
                    <?php else: ?>
                        <a class="group flex items-center justify-center gap-2 text-white px-10 py-4 rounded text-sm uppercase tracking-widest border border-white/20 hover:bg-white/5 transition-all duration-300"
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
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce text-white/50">
            <span class="material-icons text-4xl">keyboard_arrow_down</span>
        </div>
    </header>

    <!-- Brand Statement Section -->
    <?php
    $brand_quote = get_option('prestige_brand_quote', prestige_get_default('prestige_brand_quote'));
    $brand_signature = get_option('prestige_brand_signature', prestige_get_default('prestige_brand_signature'));
    ?>
    <section class="bg-off-white py-32 md:py-48 px-4 relative overflow-hidden">
        <div class="max-w-6xl mx-auto text-center relative z-10">
            <span class="block w-px h-24 bg-primary/40 mx-auto mb-12"></span>
            <h2 class="font-serif-heading text-4xl md:text-6xl text-background-dark leading-snug">
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
    <section class="py-32 bg-background-dark relative" id="projects">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
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

        <div class="flex flex-col gap-32 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <?php
            // Extracting components to template-parts for cleaner code or WP loop integration
            get_template_part('template-parts/section-projects');
            ?>
        </div>
    </section>

    <!-- Prestige Metrics -->
    <?php
    $metrics = get_option('prestige_metrics');
    if (!$metrics || !is_array($metrics)) {
        $metrics = prestige_get_default('prestige_metrics');
    }
    $metric_count = count($metrics);
    ?>
    <?php if ($metric_count > 0): ?>
    <section class="py-24 bg-navy-dark border-y border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-<?php echo min($metric_count, 4); ?> gap-12 text-center divide-y md:divide-y-0 md:divide-x divide-white/10">
                <?php foreach ($metrics as $m): ?>
                    <div class="p-6">
                        <span class="block font-serif-heading text-5xl md:text-6xl text-primary mb-4"><?php echo esc_html($m['value']); ?></span>
                        <span class="text-gray-400 text-xs uppercase tracking-[0.2em]"><?php echo esc_html($m['label']); ?></span>
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
    <section class="py-32 bg-background-dark" id="expertise">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-24">
                <h2 class="font-serif-heading text-4xl text-white mb-6">
                    Presij Standartları
                </h2>
                <div class="w-16 h-0.5 bg-primary mx-auto"></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-<?php echo min($std_count, 3); ?> gap-12">
                <?php foreach ($standards as $std): ?>
                    <div class="group p-8 border border-white/5 hover:border-primary/30 transition-colors duration-500 rounded bg-white/[0.02]">
                        <?php if (!empty($std['icon'])): ?>
                            <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center mb-8 group-hover:bg-primary/20 transition-colors">
                                <span class="material-icons text-primary"><?php echo esc_html($std['icon']); ?></span>
                            </div>
                        <?php endif; ?>
                        <h3 class="font-serif-heading text-xl text-white mb-4"><?php echo esc_html($std['title']); ?></h3>
                        <p class="text-gray-400 text-sm leading-relaxed font-light"><?php echo esc_html($std['desc']); ?></p>
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
                Bir fincan kahve eşliğinde projenizi konuşmak ister misiniz? Vizyonunuzu dinlemek ve size özel çözümler sunmak için buradayız.
            </p>
            <a class="inline-block bg-primary hover:bg-primary-dark text-white px-12 py-5 rounded-sm text-sm uppercase tracking-widest transition-all duration-300 shadow-xl shadow-primary/10"
                href="#contact">
                Hadi Tanışalım ☕
            </a>
        </div>
    </section>

</main><!-- #main -->

<?php
get_footer();
