<?php
/**
 * Template Name: Partnerler Sayfası
 * 
 * @package Building_Theme
 */

get_header();
?>

<main id="primary"
    class="bg-background-light dark:bg-background-dark font-sans text-slate-900 dark:text-slate-100 antialiased selection:bg-primary selection:text-black">
    <!-- Hero Section -->
    <section
        class="relative flex min-h-[60vh] flex-col justify-center items-center overflow-hidden bg-navy-dark px-6 py-24 text-center">
        <!-- Abstract Architectural Background -->
        <div class="absolute inset-0 z-0 opacity-20 bg-cover bg-center"
            style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAEGe423d0fRVuYZFFs5tLZ3JNWv4l_c1WqWBYej6dQuqfu8rlz8_0-pvrPIFy5rc450EKe-ZGSFCJB4gT2csvGxVnhEKwVIU5AiEKkZ1G9xTkZPyudtDXZzeCToU5Iy5Wy4hSYvoAeXb0kj-GuIDrfmaHaltvQEb8d8T3KujWVW33uK50NHH0A1_5Ae8DeEVy5EuogzkG_MR2AUt_8w36dsIrwhCC1Tm_m-R_F3N6Etge6YXWTAw1Nbur56fJaX4ZL0ukYbvf9Hbc1');">
        </div>
        <div class="absolute inset-0 z-0 bg-gradient-to-b from-navy-dark/80 via-navy-dark/60 to-navy-dark"></div>
        <div class="relative z-10 max-w-4xl space-y-6">
            <span class="inline-block text-primary tracking-[0.2em] text-xs font-bold uppercase mb-2">Küresel
                İttifaklar</span>
            <h1 class="font-display text-5xl md:text-7xl font-light text-white leading-tight tracking-tight">
                STRATEJİK <br /><span class="font-normal italic text-white/90">ORTAKLARIMIZ</span>
            </h1>
            <div class="h-px w-24 bg-primary mx-auto my-8"></div>
            <p class="text-lg md:text-xl text-slate-300 font-light font-display max-w-2xl mx-auto leading-relaxed">
                Küresel iş birlikleriyle mükemmelliği küratörlüğünü yapıyoruz. Gökyüzünü yeniden şekillendirmek için
                dünyanın en vizyoner zihinleriyle birleşiyoruz.
            </p>
        </div>
    </section>

    <!-- Brand Statement -->
    <section class="bg-off-white py-24 px-6 md:px-20 text-center relative overflow-hidden">
        <div
            class="absolute top-0 left-1/2 -translate-x-1/2 w-px h-16 bg-gradient-to-b from-primary to-transparent opacity-50">
        </div>
        <div class="max-w-5xl mx-auto">
            <span class="material-symbols-outlined text-4xl text-primary/80 mb-6">handshake</span>
            <p class="font-display text-3xl md:text-4xl lg:text-5xl text-background-dark leading-tight font-medium">
                "Biz sadece yapılar inşa etmiyoruz; miraslar dövüyoruz. Ortaklarımız, <span
                    class="text-primary italic">tavizsiz kalite</span> ve mimari inovasyona olan paylaştığımız bağlılığa
                göre seçilir."
            </p>
            <div class="mt-12 flex justify-center items-center gap-2">
                <span class="h-px w-12 bg-background-dark/20"></span>
                <span class="text-background-dark/60 text-sm font-sans uppercase tracking-widest font-semibold">Luxe
                    Standartları</span>
                <span class="h-px w-12 bg-background-dark/20"></span>
            </div>
        </div>
    </section>



    <!-- Categorized Partners Grid -->
    <section class="bg-background-light py-24 px-6 md:px-16 lg:px-32">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-background-dark font-display text-4xl font-light mb-4">Ağımız</h2>
                <p class="text-slate-500 max-w-xl mx-auto">Disiplinler arası endüstri liderlerinden oluşan küratörlü bir seçki.</p>
            </div>

            <?php
            $categories = get_terms(array(
                'taxonomy'   => 'partner_cat',
                'hide_empty' => true,
            ));

            if (!empty($categories) && !is_wp_error($categories)):
                foreach ($categories as $cat):
                    ?>
                    <!-- Category Section -->
                    <div class="mb-16">
                        <div class="flex items-center gap-4 mb-8">
                            <h3 class="text-lg font-bold text-background-dark uppercase tracking-widest"><?php echo esc_html($cat->name); ?></h3>
                            <div class="h-px flex-1 bg-slate-200"></div>
                        </div>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-8">
                            <?php
                            $partners_query = new WP_Query(array(
                                'post_type'      => 'partner',
                                'posts_per_page' => -1,
                                'tax_query'      => array(
                                    array(
                                        'taxonomy' => 'partner_cat',
                                        'field'    => 'term_id',
                                        'terms'    => $cat->term_id,
                                    ),
                                ),
                            ));

                            if ($partners_query->have_posts()):
                                while ($partners_query->have_posts()):
                                    $partners_query->the_post();
                                    $logo_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                                    ?>
                                    <div class="group flex items-center justify-center p-8 bg-white border border-slate-100 hover:border-primary/30 transition-all duration-300 hover:shadow-lg rounded-sm aspect-[3/2]">
                                        <?php if ($logo_url): ?>
                                            <img src="<?php echo esc_url($logo_url); ?>" alt="<?php the_title_attribute(); ?>" class="w-auto grayscale group-hover:grayscale-0 transition-all duration-500 object-contain">
                                        <?php else: ?>
                                            <span class="material-symbols-outlined text-4xl text-slate-400 group-hover:text-primary transition-colors">handshake</span>
                                        <?php endif; ?>
                                        <span class="sr-only"><?php the_title(); ?></span>
                                    </div>
                                    <?php
                                endwhile;
                                wp_reset_postdata();
                            endif;
                            ?>
                        </div>
                    </div>
                    <?php
                endforeach;
            else:
                ?>
                <p class="text-center text-slate-400">Henüz eklenmiş bir partner bulunamadı. Lütfen yönetim panelinden ekleyin.</p>
                <?php
            endif;
            ?>
        </div>
    </section>

   

    <!-- CTA Section -->
    <section class="bg-[#0f1115] relative overflow-hidden py-32 px-6">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5">
        </div>
        <div class="relative z-10 max-w-3xl mx-auto text-center space-y-8">
            <h2 class="font-display text-4xl md:text-6xl text-white font-light">
                Bizimle Ortaklık Yapmak <br /><span class="italic text-white/90">İster Misiniz?</span>
            </h2>
            <p class="text-slate-400 text-lg font-light max-w-xl mx-auto">
                Lüks yaşamın geleceği için vizyonumuzu paylaşan olağanüstü iş ortakları arıyoruz.
            </p>
            <div class="pt-8">
                <a href="<?php echo esc_url(home_url('/iletisim')); ?>"
                    class="relative overflow-hidden group inline-block bg-primary text-[#181611] px-10 py-4 rounded-sm font-bold uppercase tracking-widest text-sm transition-all duration-300 hover:bg-[#ffe082] hover:shadow-[0_0_20px_rgba(244,185,37,0.3)]">
                    <span class="relative z-10">İletişime Geçin</span>
                </a>
            </div>
        </div>
    </section>
</main>

<style>
    .fade-up {
        animation: fadeUp 1s ease-out forwards;
        opacity: 0;
        transform: translateY(20px);
    }

    @keyframes fadeUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .delay-100 {
        animation-delay: 0.1s;
    }

    .delay-200 {
        animation-delay: 0.2s;
    }

    .delay-300 {
        animation-delay: 0.3s;
    }
</style>

<?php
get_footer();
