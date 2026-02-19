<?php
/**
 * The template for displaying all single posts (Projects)
 *
 * @package Building_Theme
 */

get_header();

while (have_posts()):
    the_post();

    // Get project meta data
    $location = get_post_meta(get_the_ID(), '_prestige_konum', true); // Custom meta if available
    $year = get_post_meta(get_the_ID(), '_prestige_insaat_yili', true);
    $area = get_post_meta(get_the_ID(), '_prestige_alan', true);
    $architect = get_post_meta(get_the_ID(), '_prestige_mimar', true);

    // Default values if meta is missing
    if (!$year)
        $year = "2024";
    if (!$location)
        $location = "İstanbul, Türkiye";
    if (!$area)
        $area = "1,200m²";
    if (!$architect)
        $architect = "ARCHITRAVE";

    $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
    if (!$thumbnail_url) {
        $thumbnail_url = 'https://lh3.googleusercontent.com/aida-public/AB6AXuAcGj84PMoMIdGSaEW-30uMtFTYdWROx16x56nH__uNIF18l6YVw-gPcjr_XPTBTb2rHzEgUObDDdoPCwfzsC9QtPKZGdS55exRZXIRboOAz5iAk8WJd3NsIQKkGK-cvuVMHwLHH8yy-P3WWc9krc4kTcfYhSXPuTpEkHO3E38AQEWrITlpXPQ8WcjPya95ObR4gdsQRcKc6DdXSYc8RSgMO0v9YZVNCuEPDiWzP2l_Mr7-qZVDQNSqaVtduR05fnqzDmc7UEtLY_w3';
    }
    ?>

    <main id="primary"
        class="site-main bg-background-dark text-white font-display antialiased overflow-x-hidden selection:bg-primary selection:text-black">

        <!-- Hero Section -->
        <header class="relative w-full h-screen min-h-[800px] flex items-center justify-center overflow-hidden">
            <!-- Background Image -->
            <div class="absolute inset-0 bg-cover bg-center bg-no-repeat bg-fixed scale-105 animate-[pulse_10s_ease-in-out_infinite]"
                style="background-image: url('<?php echo esc_url($thumbnail_url); ?>');">
            </div>
            <!-- Overlays -->
            <div class="absolute inset-0 bg-black/40 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#171512] via-transparent to-black/30"></div>
            <!-- Content -->
            <div class="relative z-10 flex flex-col items-center text-center px-4 max-w-5xl mx-auto space-y-8">
                <h2
                    class="text-primary/90 text-sm md:text-base font-medium tracking-[0.3em] uppercase animate-[fadeIn_1s_ease-out_0.5s_both]">
                    <?php echo esc_html($location); ?> · <?php echo esc_html($year); ?>
                </h2>
                <h1
                    class="font-serif-heading text-5xl md:text-7xl lg:text-9xl text-white font-medium leading-[0.9] tracking-tight mix-blend-overlay opacity-90 animate-[fadeInUp_1s_ease-out_0.2s_both]">
                    <?php the_title(); ?>
                </h1>
                <div class="pt-8 animate-[fadeIn_1s_ease-out_1s_both]">
                    <div class="w-[1px] h-24 bg-gradient-to-b from-primary to-transparent mx-auto"></div>
                </div>
            </div>
            <!-- Scroll Indicator -->
            <div
                class="absolute bottom-10 left-1/2 -translate-x-1/2 text-white/50 flex flex-col items-center gap-2 animate-bounce">
                <span class="text-[10px] uppercase tracking-widest">Aşağı Kaydır</span>
                <span class="material-symbols-outlined text-sm">keyboard_arrow_down</span>
            </div>
        </header>

        <!-- Overview Section (Light Mode Variant) -->
        <section class="relative bg-background-light text-background-dark py-24 md:py-32 px-6">
            <div class="max-w-[1440px] mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-start">
                    <!-- Left Column: Title -->
                    <div class="lg:col-span-5 relative">
                        <div class="sticky top-32">
                            <span class="block w-12 h-[2px] bg-primary mb-8"></span>
                            <h2
                                class="font-serif-heading text-4xl md:text-6xl lg:text-7xl font-medium leading-tight text-background-dark">
                                Formun <br /><span class="italic text-gray-400">Senfonisi</span>
                            </h2>
                        </div>
                    </div>
                    <!-- Right Column: Content & Stats -->
                    <div class="lg:col-span-7 flex flex-col gap-12 pt-4">
                        <div class="text-lg md:text-xl font-light leading-relaxed text-gray-600">
                            <?php the_content(); ?>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 pt-8 border-t border-gray-200">
                            <!-- Stat 1 -->
                            <div class="flex flex-col gap-2">
                                <div class="flex items-center gap-2 text-primary">
                                    <span class="material-symbols-outlined">square_foot</span>
                                </div>
                                <h3 class="text-background-dark font-bold text-lg">Alan</h3>
                                <p class="text-gray-500 font-medium text-sm"><?php echo esc_html($area); ?></p>
                            </div>
                            <!-- Stat 2 -->
                            <div class="flex flex-col gap-2">
                                <div class="flex items-center gap-2 text-primary">
                                    <span class="material-symbols-outlined">home_work</span>
                                </div>
                                <h3 class="text-background-dark font-bold text-lg">Tip</h3>
                                <p class="text-gray-500 font-medium text-sm">Özel Mülk</p>
                            </div>
                            <!-- Stat 3 -->
                            <div class="flex flex-col gap-2">
                                <div class="flex items-center gap-2 text-primary">
                                    <span class="material-symbols-outlined">architecture</span>
                                </div>
                                <h3 class="text-background-dark font-bold text-lg">Mimar</h3>
                                <p class="text-gray-500 font-medium text-sm"><?php echo esc_html($architect); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Metrics Section -->
        <section class="bg-navy-dark py-24 md:py-32 relative overflow-hidden">
            <!-- Subtle Pattern Background -->
            <div class="absolute inset-0 opacity-5"
                style="background-image: radial-gradient(#cdab56 1px, transparent 1px); background-size: 32px 32px;"></div>
            <div class="max-w-[1440px] mx-auto px-6 relative z-10">
                <div
                    class="flex flex-col md:flex-row flex-wrap gap-12 md:gap-0 divide-y md:divide-y-0 md:divide-x divide-white/10">
                    <!-- Metric 1 -->
                    <div class="flex-1 flex flex-col items-center justify-center p-8 md:p-12 text-center group">
                        <h3
                            class="text-primary font-bold text-7xl md:text-9xl tracking-tighter mb-4 transition-transform duration-500 group-hover:-translate-y-2">
                            03</h3>
                        <p class="text-white font-medium text-lg uppercase tracking-[0.2em] mb-2">Yıllık Titiz Çalışma</p>
                        <p class="text-gray-400 text-sm max-w-[200px]">İlk taslaktan son taş yerleşimine kadar.</p>
                    </div>
                    <!-- Metric 2 -->
                    <div class="flex-1 flex flex-col items-center justify-center p-8 md:p-12 text-center group">
                        <h3
                            class="text-primary font-bold text-7xl md:text-9xl tracking-tighter mb-4 transition-transform duration-500 group-hover:-translate-y-2">
                            12</h3>
                        <p class="text-white font-medium text-lg uppercase tracking-[0.2em] mb-2">Özel Malzeme</p>
                        <p class="text-gray-400 text-sm max-w-[200px]">En iyi ocaklardan özenle seçilmiş.</p>
                    </div>
                    <!-- Metric 3 -->
                    <div class="flex-1 flex flex-col items-center justify-center p-8 md:p-12 text-center group">
                        <h3
                            class="text-primary font-bold text-7xl md:text-9xl tracking-tighter mb-4 transition-transform duration-500 group-hover:-translate-y-2">
                            ∞</h3>
                        <p class="text-white font-medium text-lg uppercase tracking-[0.2em] mb-2">Kesintisiz Manzara</p>
                        <p class="text-gray-400 text-sm max-w-[200px]">Ufuk çizgisine açılan panoramik bakış.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Closing / CTA -->
        <section class="bg-background-dark py-32 md:py-48 px-6 border-t border-white/5">
            <div class="max-w-4xl mx-auto text-center flex flex-col items-center gap-10">
                <div class="w-[1px] h-16 bg-primary/50 mb-4"></div>
                <h2 class="font-serif-heading text-4xl md:text-6xl text-white">Hassasiyetle İşlendi</h2>
                <p class="text-gray-400 text-lg md:text-xl max-w-xl font-light">Sessizliği, alanı ve ARCHITRAVE'in tavizsiz
                    kalitesini deneyimleyin.</p>
                <a href="<?php echo esc_url(home_url('/iletisim')); ?>"
                    class="mt-8 relative inline-flex items-center justify-center px-12 py-4 overflow-hidden font-bold text-white transition-all duration-300 bg-transparent border border-primary rounded-lg group hover:bg-primary/10">
                    <span
                        class="absolute w-0 h-0 transition-all duration-500 ease-out bg-primary rounded-full group-hover:w-80 group-hover:h-80 opacity-10"></span>
                    <span class="relative flex items-center gap-3 tracking-[0.15em] uppercase text-sm">
                        İnceleme İçin İletişime Geçin
                        <span class="material-symbols-outlined text-[18px]">arrow_outward</span>
                    </span>
                </a>
            </div>
        </section>

    </main><!-- #main -->

    <?php
endwhile;

get_footer();
