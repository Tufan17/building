<?php
/**
 * Template Name: İletişim
 *
 * Contact / Private Consultation page template
 *
 * @package Building_Theme
 */

get_header();
?>

<main class="flex-grow pt-4 bg-background-dark">
    <!-- Hero Section -->
    <section
        class="relative px-6 md:px-12 py-20 md:py-32 max-w-[1440px] mx-auto flex flex-col justify-center min-h-[50vh]">
        <div class="absolute top-0 right-0 w-1/3 h-full opacity-20 pointer-events-none"
            style="background: linear-gradient(135deg, rgba(198, 167, 88, 0.1) 0%, rgba(11, 17, 32, 0) 100%);"></div>
        <span class="text-primary text-sm font-bold tracking-[0.2em] mb-6 uppercase">Özel Danışmanlık</span>
        <h1
            class="font-serif-heading text-5xl md:text-7xl lg:text-8xl text-white font-medium leading-tight mb-8 max-w-4xl">
            Projenizi <br /><span class="text-gray-400 italic">konuşalım.</span>
        </h1>
        <p class="text-gray-400 text-lg md:text-xl max-w-2xl font-light leading-relaxed">
            Olağanüstü yaşam alanlarına giden yolculuğunuza başlayın. Özel müşteri ekibimiz, mimari projeleriniz ve
            gayrimenkul geliştirme hakkında gizli danışmanlık için hazırdır.
        </p>
    </section>

    <!-- Main Content Grid -->
    <section class="px-6 md:px-12 pb-24 max-w-[1440px] mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-24">

            <!-- Left Column: Contact Details -->
            <div class="lg:col-span-5 flex flex-col gap-16">

                <!-- Success Message -->
                <?php if (isset($_GET['contact_sent']) && $_GET['contact_sent'] === '1'): ?>
                <div class="bg-primary/10 border border-primary/30 rounded-xl p-6 flex items-center gap-4">
                    <span class="material-icons text-primary text-3xl">check_circle</span>
                    <div>
                        <p class="text-white font-semibold">Mesajınız başarıyla gönderildi!</p>
                        <p class="text-gray-400 text-sm">Ekibimiz en kısa sürede sizinle iletişime geçecektir.</p>
                    </div>
                </div>
                <?php endif; ?>

                <div>
                    <h3 class="text-white font-serif-heading text-3xl mb-8">Genel Merkez</h3>
                    <div class="flex flex-col gap-10">

                        <!-- Address -->
                        <div class="group">
                            <div class="flex items-center gap-3 text-primary mb-3">
                                <span class="material-icons text-[28px]">location_on</span>
                                <span class="text-sm font-bold tracking-widest uppercase text-gray-400">Ofis</span>
                            </div>
                            <p
                                class="text-white text-xl font-light leading-relaxed pl-10 border-l border-transparent group-hover:border-primary transition-all duration-300">
                                Toros Mah. 78143 Sk.<br />
                                Hilal Tower, Bina No: 4A<br />
                                Çukurova / Adana
                            </p>
                        </div>

                        <!-- Phone -->
                        <div class="group">
                            <div class="flex items-center gap-3 text-primary mb-3">
                                <span class="material-icons text-[28px]">call</span>
                                <span class="text-sm font-bold tracking-widest uppercase text-gray-400">Doğrudan
                                    Hat</span>
                            </div>
                            <a href="tel:+905313550738"
                                class="text-white text-xl font-light leading-relaxed pl-10 border-l border-transparent group-hover:border-primary transition-all duration-300 hover:text-primary block">
                                +90 531 355 07 38
                            </a>
                            <p class="text-gray-500 text-sm pl-10 mt-1">Pzt-Cum, 09:00 - 18:00</p>
                        </div>

                        <!-- Instagram -->
                        <div class="group">
                            <div class="flex items-center gap-3 text-primary mb-3">
                                <svg class="w-7 h-7 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                                <span class="text-sm font-bold tracking-widest uppercase text-gray-400">Instagram</span>
                            </div>
                            <a class="text-white text-xl font-light leading-relaxed pl-10 border-l border-transparent group-hover:border-primary transition-all duration-300 hover:text-primary block"
                                href="https://www.instagram.com/capitalyasaminsaat/" target="_blank" rel="noopener noreferrer">
                                @capitalyasaminsaat
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Map Container -->
                <div class="w-full h-[300px] rounded-xl overflow-hidden relative border border-white/10 group">
                    <div class="absolute inset-0 bg-background-dark/80 z-10"></div>
                    <img alt="Harita"
                        class="w-full h-full object-cover opacity-40 grayscale group-hover:scale-105 transition-transform duration-700 ease-out"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDf8f5sQOxa0gmIh3Ft40xtfd1mV4wAAz917jpBVpxCDOiKnsODRqTyZYtXUGJJew4heeyfrzE9f7H4bjdVrYBw4t0eNH6VM_Pvll1BS0jSGl7h_QyaX1xnJOAatJ-AVYaUoVBEMvA-RbO4NF1m2CO30Eu3gHQH5i5ja1zZtYCY0PiUq3qc6d46BaGwqytenpiOhsN1X_Jg8C2Uh2k3xocNVyH-D2UOo9vl29Tdr4jlUtSnCqHUEAMfEuz31Ah6xsv7oJsgis3uboZs" />
                    <div class="absolute inset-0 z-20 flex items-center justify-center">
                        <div class="bg-background-dark p-3 rounded-full border border-primary/50 shadow-2xl">
                            <span class="material-icons text-primary">apartment</span>
                        </div>
                    </div>
                    <div class="absolute bottom-4 left-4 z-20">
                        <a href="https://www.google.com/maps/search/Toros+Mah+78143+Sk+Hilal+Tower+%C3%87ukurova+Adana" target="_blank"
                            class="text-xs text-white bg-black/50 backdrop-blur px-3 py-1.5 rounded flex items-center gap-1 hover:bg-primary hover:text-black transition-colors">
                            Google Maps'te Görüntüle
                            <span class="material-icons text-[14px]">arrow_outward</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Column: Inquiry Form -->
            <div class="lg:col-span-7 bg-surface-dark rounded-2xl p-8 md:p-12 border border-white/10">
                <h3 class="font-serif-heading text-3xl text-white mb-2">Danışmanlık Randevusu</h3>
                <p class="text-gray-400 mb-10 font-light">Formu doldurun, ekibimiz 24 saat içinde sizinle iletişime
                    geçecektir.</p>

                <form class="flex flex-col gap-6" method="post" action="">
                    <?php wp_nonce_field('prestige_contact_form', 'prestige_contact_nonce'); ?>

                    <!-- Anti-bot protection -->
                    <div style="display:none !important;" aria-hidden="true">
                        <input type="text" name="hp_user_description" tabindex="-1" value="" autocomplete="off" />
                        <input type="hidden" name="prestige_form_ts" value="<?php echo time(); ?>" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-bold uppercase tracking-wider text-gray-400 ml-1">Ad</label>
                            <input type="text" name="contact_first_name" required
                                class="w-full bg-background-dark border border-white/10 rounded-lg px-4 py-4 text-white placeholder-gray-600 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all duration-300"
                                placeholder="Adınızı girin" />
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold uppercase tracking-wider text-gray-400 ml-1">Soyad</label>
                            <input type="text" name="contact_last_name" required
                                class="w-full bg-background-dark border border-white/10 rounded-lg px-4 py-4 text-white placeholder-gray-600 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all duration-300"
                                placeholder="Soyadınızı girin" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-bold uppercase tracking-wider text-gray-400 ml-1">E-posta
                                Adresi</label>
                            <input type="email" name="contact_email" required
                                class="w-full bg-background-dark border border-white/10 rounded-lg px-4 py-4 text-white placeholder-gray-600 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all duration-300"
                                placeholder="ornek@email.com" />
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold uppercase tracking-wider text-gray-400 ml-1">Telefon
                                Numarası</label>
                            <input type="tel" name="contact_phone"
                                class="w-full bg-background-dark border border-white/10 rounded-lg px-4 py-4 text-white placeholder-gray-600 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all duration-300"
                                placeholder="+90 (5XX) XXX XX XX" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-bold uppercase tracking-wider text-gray-400 ml-1">Proje
                                Tipi</label>
                            <div class="relative">
                                <style>
                                    select.custom-select { -webkit-appearance: none; -moz-appearance: none; appearance: none; background-image: none !important; }
                                    select.custom-select::-ms-expand { display: none; }
                                </style>
                                <select name="contact_project_type"
                                    class="custom-select w-full bg-background-dark border border-white/10 rounded-lg px-4 pr-12 py-4 text-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all duration-300 cursor-pointer">
                                    <option disabled selected value="">Proje tipini seçin</option>
                                    <option value="residential">Konut Mimarisi</option>
                                    <option value="commercial">Ticari Geliştirme</option>
                                    <option value="interior">İç Tasarım</option>
                                    <option value="renovation">Renovasyon</option>
                                </select>
                                <div
                                    class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-500">
                                    <span class="material-icons text-lg">keyboard_arrow_down</span>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold uppercase tracking-wider text-gray-400 ml-1">Tahmini
                                Bütçe</label>
                            <div class="relative">
                                <select name="contact_budget"
                                    class="custom-select w-full bg-background-dark border border-white/10 rounded-lg px-4 pr-12 py-4 text-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all duration-300 cursor-pointer">
                                    <option disabled selected value="">Bütçe aralığını seçin</option>
                                    <option value="tier1">₺500K - ₺1M</option>
                                    <option value="tier2">₺1M - ₺5M</option>
                                    <option value="tier3">₺5M - ₺10M</option>
                                    <option value="tier4">₺10M+</option>
                                </select>
                                <div
                                    class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-500">
                                    <span class="material-icons text-lg">keyboard_arrow_down</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-bold uppercase tracking-wider text-gray-400 ml-1">Mesajınız</label>
                        <textarea name="contact_message" rows="4" required
                            class="w-full bg-background-dark border border-white/10 rounded-lg px-4 py-4 text-white placeholder-gray-600 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all duration-300 resize-none"
                            placeholder="Vizyonunuzu bize anlatın..."></textarea>
                    </div>

                    <div class="pt-4">
                        <button type="submit" name="prestige_contact_submit"
                            class="group w-full md:w-auto bg-primary text-background-dark font-bold text-sm tracking-widest uppercase px-8 py-5 rounded-lg hover:bg-white transition-all duration-300 flex items-center justify-center gap-3">
                            Danışmanlık Randevusu Al
                            <span
                                class="material-icons text-[18px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </section>
</main>

<?php get_footer(); ?>
