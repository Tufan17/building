<?php
/**
 * Template Name: Vizyon Sayfası
 * 
 * @package Building_Theme
 */

get_header();
?>

<main id="primary"
    class="site-main bg-background-light dark:bg-background-dark text-slate-900 dark:text-white font-newsreader antialiased overflow-x-hidden">

    <!-- Hero Section -->
    <section class="relative h-screen min-h-[700px] w-full flex items-center justify-center overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img alt="Modern gökdelen mimari detay" class="w-full h-full object-cover object-center"
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuDHNIAN8DcACThxB1zxgADYQmE9q2p3RP4pFCIzDdlnbw9IkDKz2nq7iut4sGPpTJ0aPurr01LLl_jqxOpwsilZH426qt5E_ZrHwhfFt69xgjyuXkhrzocuLc0wWh7CZqvTPFNFRl__Hn31R0PXUwXRz0S42Zz74M0t61WA8A4hG_29Zlo5SzDoftvFGhQ3p74u3v6oHokDQ072_kgLGTS5kfLac_RoCAvOvGR49QgIxGk8UKo-7y4oh1IFTA6ieEWEzli8AzWtji8H" />
            <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-[#161512]"></div>
        </div>
        <div class="relative z-10 container mx-auto px-6 text-center max-w-5xl pt-20">
            <span
                class="block text-primary text-sm md:text-base font-noto tracking-[0.2em] uppercase mb-6 opacity-0 animate-[fadeIn_1s_ease-out_0.5s_forwards]">Kuruluş
                1985</span>
            <h1
                class="text-5xl md:text-7xl lg:text-9xl font-newsreader font-medium text-white leading-[0.9] tracking-tight mb-8 opacity-0 animate-[fadeInUp_1s_ease-out_0.8s_forwards]">
                VİZYONLA <br /><span class="italic font-light">İNŞA EDİYORUZ</span>
            </h1>
            <p
                class="text-white/80 text-lg md:text-xl font-light max-w-2xl mx-auto leading-relaxed opacity-0 animate-[fadeIn_1s_ease-out_1.2s_forwards]">
                Kırk yıllık inovasyonla şekillenen, zamansız tasarım ve sarsılmaz hassasiyetle silüetleri dönüştüren bir
                mimari mükemmellik mirası.
            </p>
            <div class="mt-12 flex justify-center opacity-0 animate-[fadeIn_1s_ease-out_1.5s_forwards]">
                <div class="w-[1px] h-24 bg-gradient-to-b from-primary to-transparent"></div>
            </div>
        </div>
    </section>

    <!-- Brand Story Section -->
    <section class="py-24 lg:py-32 bg-background-dark relative overflow-hidden">
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <!-- Text Column -->
                <div class="flex flex-col gap-8 order-2 lg:order-1">
                    <div class="flex items-center gap-4">
                        <div class="h-[1px] w-12 bg-primary"></div>
                        <span class="text-primary font-noto text-sm tracking-[0.15em] uppercase">Temelimiz</span>
                    </div>
                    <h2 class="text-4xl md:text-6xl font-newsreader text-white leading-tight">
                        Zamanın ötesine geçen <span class="italic text-white/70">mekanlar tasarlıyoruz.</span>
                    </h2>
                    <div class="space-y-6 text-lg text-[#b3aea2] font-light leading-relaxed">
                        <p>
                            1985 yılında kurulan stüdyomuz tek bir vizyonla yola çıktı: İlham veren mekanlar yaratmak.
                            Mimarinin sadece barınma değil, ışık, malzeme ve oran aracılığıyla insan deneyimini
                            şekillendirmek olduğuna inanıyoruz.
                        </p>
                        <p>
                            Her proje, çevre ile inşa edilen form arasındaki bir diyalogdur. Her işe, ön yargılardan
                            arınmış, temiz bir sayfa ile yaklaşıyor ve sahanın kendine özgü özelliklerinin mimari
                            anlatıyı bilgilendirmesine izin veriyoruz.
                        </p>
                    </div>
                    <div class="pt-8">
                        <img alt="Kurucu imzası" class="h-16 object-contain filter invert opacity-80"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDZQj8aW6RJoZH38zk66QFVxScbfeB3EuuutCn7ZeB6h0jyq7wIQxVsgr8PC1AiBpja_BYJXJU_uqsHqHTE-BY585trgJBgCId6gQJFd-KnYM6G932tEEMj_PV6D2n0SZaThU1Oet87RUvAz3set5fuNt4166JakaUx98qaHfFvkDMQ5AJAbknQmHA5O61KIMOEZS371whrB-AdmhK1kjiUYYzBz7QnHkT2aGOkjgptmy_J0YogrxoDT-MaeHsQEKNUMB4e2U9Z5a6j" />
                        <p class="text-sm text-[#b3aea2] mt-2 font-noto">Alexander Thorne, Kurucu</p>
                    </div>
                </div>
                <!-- Image Column -->
                <div class="relative order-1 lg:order-2 h-[600px] w-full group overflow-hidden rounded-lg">
                    <img alt="Minimal mimari detay"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-[1.5s] ease-out group-hover:scale-105"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDVw0cvSlPqeiwkMK1eb-MsyAjAWlmQmIHM49autqeOJUNhq8IqfMNppOG5OSm_wb2qreUF5_V5TPyTdpCpHIJgtf2MixLg0FzJX8fuCjWzbz0efFiePzOdZEUcWjTDrh-bcLjxpnQDtk664ZEm4A-4e-Absa10bPmY6kULV1ku7NsQrW_UhC-qTGPx-PYuN0CtjaZrbL57WWq_vC-fZvWS79a3BmL9W8cOdnl-iIh0lUg3O3r-IM181WInj1Jk64wDVgAeUit-nZeu" />
                    <div class="absolute inset-0 bg-black/10"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Philosophy Banner -->
    <section class="py-32 bg-off-white text-background-dark">
        <div class="max-w-[1200px] mx-auto px-6 text-center">
            <span class="material-symbols-outlined text-4xl text-primary mb-8">diamond</span>
            <h2
                class="text-4xl md:text-6xl lg:text-7xl font-newsreader font-medium leading-tight tracking-tight max-w-5xl mx-auto">
                "Gerçek lüks, başkalarının gözden kaçırdığı <br class="hidden md:block" /> <span
                    class="italic text-primary">detaylarda gizlidir."</span>
            </h2>
            <p class="mt-8 text-lg font-noto text-gray-600 max-w-xl mx-auto">
                Trendlerin peşinden koşmuyoruz. Form ve fonksiyonun mükemmel uyumunda bulunan sonsuz zarafeti takip
                ediyoruz.
            </p>
        </div>
    </section>

    <!-- Milestones Timeline -->
    <section class="py-24 bg-background-dark border-t border-[#35332c]">
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
                <div>
                    <span
                        class="text-primary font-noto text-sm tracking-[0.15em] uppercase block mb-2">Tarihçemiz</span>
                    <h2 class="text-4xl font-newsreader text-white">Dönüm Noktalarımız</h2>
                </div>
                <div class="flex gap-2">
                    <button
                        class="size-12 rounded-full border border-[#35332c] text-white flex items-center justify-center hover:bg-white/5 transition-colors">
                        <span class="material-symbols-outlined">arrow_back</span>
                    </button>
                    <button
                        class="size-12 rounded-full border border-[#35332c] text-white flex items-center justify-center hover:bg-white/5 transition-colors">
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </button>
                </div>
            </div>
            <div class="relative pt-10">
                <!-- Timeline Line -->
                <div class="absolute top-10 left-0 right-0 h-[1px] bg-[#35332c] w-full hidden md:block"></div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 md:gap-4">
                    <!-- Milestone 1 -->
                    <div class="relative group">
                        <div
                            class="hidden md:block absolute top-0 left-0 size-3 bg-primary -mt-[5px] rounded-full ring-4 ring-background-dark z-10">
                        </div>
                        <div class="pt-2 md:pt-12">
                            <span
                                class="text-5xl font-newsreader text-white/20 group-hover:text-primary/40 transition-colors block mb-4">1985</span>
                            <h3 class="text-xl text-white font-medium mb-2">Başlangıç</h3>
                            <p class="text-[#b3aea2] text-sm leading-relaxed">
                                Alexander Thorne, Chicago'da konut renovasyonlarına odaklanan ilk stüdyosunu açtı.
                            </p>
                        </div>
                    </div>
                    <!-- Milestone 2 -->
                    <div class="relative group">
                        <div
                            class="hidden md:block absolute top-0 left-0 size-3 bg-[#35332c] group-hover:bg-primary transition-colors -mt-[5px] rounded-full ring-4 ring-background-dark z-10">
                        </div>
                        <div class="pt-2 md:pt-12">
                            <span
                                class="text-5xl font-newsreader text-white/20 group-hover:text-primary/40 transition-colors block mb-4">1998</span>
                            <h3 class="text-xl text-white font-medium mb-2">İlk Gökdelen</h3>
                            <p class="text-[#b3aea2] text-sm leading-relaxed">
                                Şehir silüetini yeniden tanımlayan 40 katlı bir konut kulesi olan "The Vertex" için
                                görevlendirildik.
                            </p>
                        </div>
                    </div>
                    <!-- Milestone 3 -->
                    <div class="relative group">
                        <div
                            class="hidden md:block absolute top-0 left-0 size-3 bg-[#35332c] group-hover:bg-primary transition-colors -mt-[5px] rounded-full ring-4 ring-background-dark z-10">
                        </div>
                        <div class="pt-2 md:pt-12">
                            <span
                                class="text-5xl font-newsreader text-white/20 group-hover:text-primary/40 transition-colors block mb-4">2010</span>
                            <h3 class="text-xl text-white font-medium mb-2">Küresel Büyüme</h3>
                            <p class="text-[#b3aea2] text-sm leading-relaxed">
                                Felsefemizi uluslararası pazarlara taşıyan Londra ve Tokyo ofislerimizi açtık.
                            </p>
                        </div>
                    </div>
                    <!-- Milestone 4 -->
                    <div class="relative group">
                        <div
                            class="hidden md:block absolute top-0 left-0 size-3 bg-[#35332c] group-hover:bg-primary transition-colors -mt-[5px] rounded-full ring-4 ring-background-dark z-10">
                        </div>
                        <div class="pt-2 md:pt-12">
                            <span
                                class="text-5xl font-newsreader text-white/20 group-hover:text-primary/40 transition-colors block mb-4">2023</span>
                            <h3 class="text-xl text-white font-medium mb-2">Sürdürülebilirlik Ödülü</h3>
                            <p class="text-[#b3aea2] text-sm leading-relaxed">
                                Lüks projelerde öncü karbon-nötr inşaat tekniklerimizle küresel çapta tanındık.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Craftsmanship Section -->
    <section class="py-24 bg-[#11100e]">
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12">
            <div class="text-center mb-16">
                <span class="text-primary font-noto text-sm tracking-[0.15em] uppercase block mb-4">Yaklaşımımız</span>
                <h2 class="text-4xl md:text-5xl font-newsreader text-white">Zanaatkarlık Sanatı</h2>
            </div>
            <div class="grid md:grid-cols-3 gap-6 lg:gap-8">
                <!-- Card 1 -->
                <div class="group zoom-card relative h-[500px] w-full overflow-hidden rounded-lg cursor-pointer">
                    <img alt="Mermer dokusu detayı"
                        class="zoom-image absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuANbxa7HcLD0jMMuDa2MghF8JKV7fEIJhijAIiEE6YSLIxkUYQ7rNc9ZcoubbVNowX-HH7swUfDwydFPhw2REBZuCa2aL5vjAl_0KPFFyoKmD6QYGmIDeqoQbXeQgfoLTTrkbgTQS5wAVcHY-HYZfSM9yYuJu9Q-Vpb1zZOkXwr8BnvenRNZNN0l-FGXndHmeUBcxIpIOKO7NKkPEcm6nuHGkXjFamZ8z_77KO9sygXnqFuFYjidps5KkeWWcQVem8TyvRXkPnMusYt" />
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent opacity-80 group-hover:opacity-90 transition-opacity">
                    </div>
                    <div
                        class="absolute bottom-0 left-0 p-8 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                        <div
                            class="w-12 h-[1px] bg-primary mb-4 opacity-0 group-hover:opacity-100 transition-opacity delay-100">
                        </div>
                        <h3 class="text-3xl font-newsreader text-white mb-2">Materyalite</h3>
                        <p
                            class="text-white/70 text-sm max-w-[260px] opacity-0 group-hover:opacity-100 transition-opacity delay-200">
                            Malzemeleri sadece görünümleri için değil; nasıl yaşlandıkları, hissettirdikleri ve ışıkla
                            nasıl etkileşime girdikleri için seçiyoruz.
                        </p>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="group zoom-card relative h-[500px] w-full overflow-hidden rounded-lg cursor-pointer">
                    <img alt="Çelik yapı iskeleti"
                        class="zoom-image absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuCyNhSk1ceNKWFz44v7NukUnTqRFjuydU89aaOpVnlaXvHQSXqAGByWxSvHr_fQzXijpoNfGFq5h8MzJv0lhKIXavrwz4dST8fPnzdYvw2Sbo9wbNA6rsMfEQztstPXWqimjnv215d9MguoFDL-Z8LRAIrzrX0m8YphSzIEyX_xCI6reOMcjfZHrwXPIP2dv2qOxKmeyaHsQmrPNOd9Dr7IZkra3cJ-DGA9b43zbFwxJ4qHVlGV8V1WKbFcxGYqyCbAmyuAUrhpGVGw" />
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent opacity-80 group-hover:opacity-90 transition-opacity">
                    </div>
                    <div
                        class="absolute bottom-0 left-0 p-8 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                        <div
                            class="w-12 h-[1px] bg-primary mb-4 opacity-0 group-hover:opacity-100 transition-opacity delay-100">
                        </div>
                        <h3 class="text-3xl font-newsreader text-white mb-2">Hassasiyet</h3>
                        <p
                            class="text-white/70 text-sm max-w-[260px] opacity-0 group-hover:opacity-100 transition-opacity delay-200">
                            Sanatla sınır komşusu olan mühendislik. Her eklem, dikiş ve açı milimetresine kadar
                            hesaplanır.
                        </p>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="group zoom-card relative h-[500px] w-full overflow-hidden rounded-lg cursor-pointer">
                    <img alt="Doğa yansımasıyla cam cephe"
                        class="zoom-image absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAIi5LSmx6Uf66GjRsZwPuvKVpE3RDpx8DUBWC4Y0tTKKSmIWSmKmEBG_9ICkjIa3ia64uhQ7Nnyb0WgkfHYlV82WHZeijRzqaIDNiMte6GrWy6opDdyJaC1Bi_17We87wIvNYxQ6ke9nPXxS-FnCwvooVcjRs1Aq-fM8QqJogqOIwuXkUHyPzo_KED3ZmMCLEZPotdQSoCk8Kgar535mpTqG0b8ynfBx_yCjYsmWx9v0vsNwMN-B8e0rxNozfSlz7NlvqmXYb_oPxh" />
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent opacity-80 group-hover:opacity-90 transition-opacity">
                    </div>
                    <div
                        class="absolute bottom-0 left-0 p-8 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                        <div
                            class="w-12 h-[1px] bg-primary mb-4 opacity-0 group-hover:opacity-100 transition-opacity delay-100">
                        </div>
                        <h3 class="text-3xl font-newsreader text-white mb-2">Sürdürülebilirlik</h3>
                        <p
                            class="text-white/70 text-sm max-w-[260px] opacity-0 group-hover:opacity-100 transition-opacity delay-200">
                            Gelecek için inşa etmek, bugünün kaynaklarına saygı duymak demektir. Tasarım gereği çevre
                            dostu.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Closing Statement -->
    <section class="py-32 bg-navy-dark text-center px-6 relative overflow-hidden">
        <!-- Subtle pattern overlay -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
            style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 32px 32px;"></div>
        <div class="max-w-4xl mx-auto relative z-10">
            <h2
                class="text-4xl md:text-6xl lg:text-7xl font-newsreader font-bold text-white leading-tight uppercase tracking-tight">
                Sadece yapılar inşa etmiyoruz. <br />
                <span class="relative inline-block mt-2">
                    Simgeler inşa ediyoruz.
                    <svg class="absolute -bottom-2 md:-bottom-4 left-0 w-full h-3 md:h-4 text-primary" fill="none"
                        viewBox="0 0 200 9" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.00025 6.99992C18.5002 2.49992 49.0002 -3.00008 200.001 2.99991"
                            stroke="currentColor" stroke-width="3"></path>
                    </svg>
                </span>
            </h2>
            <div class="mt-12">
                <a href="<?php echo esc_url(home_url('/iletisim')); ?>"
                    class="inline-flex h-12 md:h-14 items-center justify-center rounded-lg bg-primary px-8 text-base md:text-lg font-bold text-[#161512] transition-transform hover:scale-105 active:scale-95">
                    Projenizi Başlatın
                </a>
            </div>
        </div>
    </section>

</main><!-- #main -->

<style>
    .font-newsreader {
        font-family: 'Newsreader', serif;
    }

    .font-noto {
        font-family: 'Noto Sans', sans-serif;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<?php
get_footer();
