<?php
/**
 * Template Name: Misyon Sayfası
 *
 * @package Building_Theme
 */

get_header();
?>

<main id="primary"
    class="site-main bg-background-dark text-white font-display overflow-x-hidden antialiased selection:bg-primary selection:text-navy-dark">

    <!-- Hero Section -->
    <section
        class="relative h-[85vh] min-h-[600px] w-full flex flex-col items-center justify-center bg-navy-dark overflow-hidden">
        <!-- Architectural Background Texture -->
        <div class="absolute inset-0 z-0 opacity-20 pointer-events-none"
            style="background-image: radial-gradient(circle at 50% 50%, rgba(198, 168, 90, 0.15), transparent 70%);">
        </div>
        <div class="absolute inset-0 z-0 opacity-[0.03]"
            style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBnknrPUXFErjscREHoO0S_vKxx7jPjQtBV_F01pJFtkRZTWfROGvFjyHVoAbng3k8Ds5cRINrhBJD0yVlROIP-fL7V0JLiEwMEadW5ltPo3ehQ3RfAgyaXDnljSzl8cXCpiREmt8qLKSn6TQbuipSQGaw0ya5alaAA9mntsZjLmdY3LmiGfmTJU5DmVe730P_8kfwI19GZ7eHU145PnuokCax4Dz2IZG0N4qlonp7CJ35haDbBa7v7aAkbtKT2Fi1VO5Jj7MbqptCq');">
        </div>
        <div
            class="relative z-10 flex flex-col items-center text-center px-6 max-w-5xl mx-auto space-y-8 animate-fade-in-up">
            <span
                class="text-primary/80 uppercase tracking-[0.2em] text-sm font-medium border-b border-primary/30 pb-2 mb-2">Miras
                & Gelecek</span>
            <h1 class="text-5xl md:text-7xl lg:text-8xl font-serif-heading text-white leading-tight">
                <span class="block mb-2">VİZYON</span>
                <span class="block text-white/30 font-light italic">&amp;</span>
                <span class="block mt-2">MİSYON</span>
            </h1>
            <p class="text-white/70 text-lg md:text-xl font-light max-w-2xl leading-relaxed">
                Zamansız tasarım ve kalıcı yapılarla yarının mirasını bugünden inşa ediyoruz.
            </p>
            <div class="pt-8">
                <span
                    class="material-symbols-outlined text-primary text-4xl animate-bounce cursor-pointer opacity-70 hover:opacity-100 transition-opacity">keyboard_arrow_down</span>
            </div>
        </div>
    </section>

    <!-- Vision Statement Section -->
    <section class="py-24 md:py-32 bg-off-white text-navy-dark px-6 relative">
        <div class="max-w-4xl mx-auto text-center">
            <div class="w-px h-24 bg-primary mx-auto mb-10"></div>
            <h2 class="text-3xl md:text-5xl font-serif-heading leading-tight mb-8">
                "Ufuk çizgisini nefes alan, kalıcı ve ilham verici yapılarla yeniden şekillendirmek."
            </h2>
            <div class="w-24 h-[2px] bg-primary mx-auto mb-8"></div>
            <p class="text-navy-dark/70 text-lg md:text-xl font-light leading-relaxed max-w-2xl mx-auto">
                Zamana meydan okuyan mekanlar yaratmaya, insan deneyimini yükseltmek için sanatı işlevsellikle
                birleştirmeye inanıyoruz.
            </p>
        </div>
    </section>

    <!-- Mission Split Section -->
    <section class="bg-background-dark py-20 md:py-0">
        <div class="max-w-[1440px] mx-auto grid grid-cols-1 md:grid-cols-2 min-h-[600px]">
            <!-- Left: Sticky Heading -->
            <div
                class="relative p-10 md:p-20 flex flex-col justify-center border-b md:border-b-0 md:border-r border-white/10 bg-[url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=2070&auto=format&fit=crop')] bg-cover bg-center">
                <div class="absolute inset-0 bg-navy-dark/90"></div>
                <div class="relative z-10">
                    <h2 class="text-5xl md:text-6xl font-serif-heading text-white mb-6">Bizim<br /><span
                            class="text-primary italic">Misyonumuz</span></h2>
                    <div class="w-16 h-1 bg-primary mb-6"></div>
                    <p class="text-white/60 uppercase tracking-widest text-sm">Adanmışlık • Kalite • İnovasyon</p>
                </div>
            </div>
            <!-- Right: Content -->
            <div class="p-10 md:p-20 flex flex-col justify-center bg-background-dark">
                <p class="text-xl md:text-2xl font-light leading-relaxed text-white/90 mb-8 font-serif-heading">
                    Tavizsiz kaliteye ve sürdürülebilir inovasyona odaklanıyoruz. Misyonumuz, insan deneyimini
                    zenginleştiren, çevreleriyle uyum içinde gelişen topluluklar ve yaşam tarzları oluşturmaktır.
                </p>
                <p class="text-white/50 leading-relaxed mb-10 text-sm">
                    Her proje bir dürüstlük ve mükemmellik vaadidir. Her taslağa sadece bir inşaat planı olarak değil,
                    taş, çelik ve camla yazılan bir miras olarak yaklaşıyoruz. Bağlılığımız, fiziksel yapının ötesine
                    geçerek sakinlerine sunduğu kalıcı değere kadar uzanır.
                </p>
                <?php
                $misyon_metrics = get_option('prestige_metrics');
                if (!$misyon_metrics || !is_array($misyon_metrics)) {
                    $misyon_metrics = prestige_get_default('prestige_metrics');
                }
                if (!empty($misyon_metrics)):
                ?>
                <div class="flex flex-col sm:flex-row gap-8 mt-4">
                    <?php foreach ($misyon_metrics as $m): ?>
                    <div class="flex flex-col gap-2">
                        <span class="text-4xl font-serif-heading text-primary"><?php echo esc_html($m['value']); ?></span>
                        <span class="text-sm text-white/60 uppercase tracking-wider"><?php echo esc_html($m['label']); ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Core Values Grid -->
    <section class="py-24 px-6 md:px-12 bg-navy-dark relative overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-white/10 to-transparent">
        </div>
        <div class="max-w-[1440px] mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
                <div>
                    <h2 class="text-4xl md:text-5xl font-serif-heading text-white mb-4">Temel Değerlerimiz</h2>
                    <p class="text-white/60 max-w-md">Mükemmellik taahhüdümüzü destekleyen ve verdiğimiz her karara
                        rehberlik eden sütunlar.</p>
                </div>
                <div class="hidden md:block w-32 h-px bg-white/20 mb-4"></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Value 1 -->
                <div
                    class="group relative p-8 rounded-lg border border-white/10 bg-white/[0.02] hover:bg-white/[0.05] transition-all duration-500 hover:-translate-y-2">
                    <div
                        class="absolute top-0 left-0 w-full h-1 bg-primary scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left">
                    </div>
                    <div class="mb-6 text-primary group-hover:text-white transition-colors duration-300">
                        <span class="material-symbols-outlined text-4xl font-light">construction</span>
                    </div>
                    <h3 class="text-xl font-serif-heading text-white mb-3 group-hover:text-primary transition-colors">
                        Zanaatkarlık</h3>
                    <p class="text-sm text-white/60 leading-relaxed">
                        Her eklemde ve yüzeyde tavizsiz detay hassasiyeti. Modern hassasiyeti kucaklarken geleneksel
                        teknikleri onurlandırıyoruz.
                    </p>
                </div>
                <!-- Value 2 -->
                <div
                    class="group relative p-8 rounded-lg border border-white/10 bg-white/[0.02] hover:bg-white/[0.05] transition-all duration-500 hover:-translate-y-2">
                    <div
                        class="absolute top-0 left-0 w-full h-1 bg-primary scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left">
                    </div>
                    <div class="mb-6 text-primary group-hover:text-white transition-colors duration-300">
                        <span class="material-symbols-outlined text-4xl font-light">verified_user</span>
                    </div>
                    <h3 class="text-xl font-serif-heading text-white mb-3 group-hover:text-primary transition-colors">
                        Dürüstlük</h3>
                    <p class="text-sm text-white/60 leading-relaxed">
                        Ortaklıklarımızın temel taşı olarak şeffaflık ve dürüstlük. Güveni, yapıları inşa ettiğimiz
                        kadar dikkatle inşa ediyoruz.
                    </p>
                </div>
                <!-- Value 3 -->
                <div
                    class="group relative p-8 rounded-lg border border-white/10 bg-white/[0.02] hover:bg-white/[0.05] transition-all duration-500 hover:-translate-y-2">
                    <div
                        class="absolute top-0 left-0 w-full h-1 bg-primary scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left">
                    </div>
                    <div class="mb-6 text-primary group-hover:text-white transition-colors duration-300">
                        <span class="material-symbols-outlined text-4xl font-light">lightbulb</span>
                    </div>
                    <h3 class="text-xl font-serif-heading text-white mb-3 group-hover:text-primary transition-colors">
                        İnovasyon</h3>
                    <p class="text-sm text-white/60 leading-relaxed">
                        En son teknolojinin zamansız gelenekle buluştuğu nokta. Verimliliği ve tasarımı geliştirmek için
                        sürekli yeni yöntemler arıyoruz.
                    </p>
                </div>
                <!-- Value 4 -->
                <div
                    class="group relative p-8 rounded-lg border border-white/10 bg-white/[0.02] hover:bg-white/[0.05] transition-all duration-500 hover:-translate-y-2">
                    <div
                        class="absolute top-0 left-0 w-full h-1 bg-primary scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left">
                    </div>
                    <div class="mb-6 text-primary group-hover:text-white transition-colors duration-300">
                        <span class="material-symbols-outlined text-4xl font-light">eco</span>
                    </div>
                    <h3 class="text-xl font-serif-heading text-white mb-3 group-hover:text-primary transition-colors">
                        Sürdürülebilirlik</h3>
                    <p class="text-sm text-white/60 leading-relaxed">
                        Daha yeşil ve daha kalıcı bir gelecek için sorumlu inşaat. Longevity'yi maksimize ederken
                        etkimizi minimize ediyoruz.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Future Outlook / CTA -->
    <section class="relative h-[600px] w-full flex items-center justify-center overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0 bg-cover bg-center bg-no-repeat bg-fixed transform scale-105"
            style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDWfA0jXB5cN5dxajrZ_kN94Z6K1ODyWhOnm8ovqXsKOevdodNXpFBXdCW0ILzBnZrTYIAlT5f0BiRK36XLZ_UH7bLpewOzJ5VdNJltToTAVoOd8XL7kUEgKCKbx0KRiVNCx5hEE2cU03fUkOWpoV9cDt_Pr4cjhQrunk0YJYQEc2Ib7711ewpMyCiOixxFVl0UODpaYV7PJ0hoHv94vuH6hL4ENaDtgHun2xVudgRxgXZ-msQkJNfJzigOLWe0J9WZGkKbyXRuDk4O');">
        </div>
        <!-- Heavy Dark Overlay -->
        <div class="absolute inset-0 bg-navy-dark/80 z-10"></div>
        <!-- Content -->
        <div class="relative z-20 text-center px-6 max-w-3xl mx-auto space-y-8 animate-fade-in-up">
            <h2 class="text-4xl md:text-6xl font-serif-heading text-white leading-tight">
                İnşa ettiğimiz geleceğe<br /><span class="italic text-primary">tanıklık edin.</span>
            </h2>
            <p class="text-white/70 text-lg font-light max-w-xl mx-auto">
                Konut şaheserlerinden ticari simge yapılara kadar, mirasımızı tanımlayan portföyümüzü keşfedin.
            </p>
            <div class="pt-4">
                <a href="<?php echo esc_url(home_url('/projeler')); ?>"
                    class="group relative inline-flex items-center justify-center overflow-hidden rounded-lg px-8 py-4 bg-primary text-navy-dark font-bold tracking-widest uppercase transition-all duration-300 hover:bg-white hover:shadow-[0_0_20px_rgba(255,255,255,0.3)]">
                    <span class="relative z-10">Projelerimizi Keşfedin</span>
                    <div
                        class="absolute inset-0 -translate-x-full group-hover:translate-x-0 bg-white transition-transform duration-300 ease-out">
                    </div>
                </a>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
