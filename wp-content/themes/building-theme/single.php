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
    $konum_terms = wp_get_post_terms(get_the_ID(), 'konum', array('orderby' => 'parent', 'order' => 'DESC'));
    $location_parts = array();
    if (!is_wp_error($konum_terms) && !empty($konum_terms)) {
        foreach ($konum_terms as $kt) {
            $location_parts[] = $kt->name;
        }
    }
    $location = implode(', ', $location_parts);
    $year = get_post_meta(get_the_ID(), '_prestige_insaat_yili', true);
    $area = get_post_meta(get_the_ID(), '_prestige_alan', true);
    $architect = get_post_meta(get_the_ID(), '_prestige_mimar', true);

    // Default values if meta is missing
    if (!$year)
        $year = "2024";
    if (!$location)
        $location = "";
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
                class="absolute bottom-10 w-full -translate-x-1/2 text-white/50 flex flex-col items-center gap-2 animate-bounce">
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
                                <?php the_title(); ?>
                            </h2>
                        </div>
                    </div>
                    <!-- Right Column: Content & Stats -->
                    <div class="lg:col-span-7 flex flex-col gap-12 pt-4">
                        <div class="prose prose-lg max-w-none text-gray-600 font-light leading-relaxed">
                            <style>
                                .prose p { margin-bottom: 1.25em; }
                                .prose strong, .prose b { font-weight: 700; color: #1e1b14; }
                                .prose em, .prose i { font-style: italic; }
                                .prose ul { list-style: disc; padding-left: 1.5em; margin-bottom: 1.25em; }
                                .prose ol { list-style: decimal; padding-left: 1.5em; margin-bottom: 1.25em; }
                                .prose li { margin-bottom: 0.5em; }
                                .prose h2 { font-size: 1.75rem; font-weight: 600; color: #1e1b14; margin: 2em 0 0.75em; }
                                .prose h3 { font-size: 1.35rem; font-weight: 600; color: #1e1b14; margin: 1.5em 0 0.5em; }
                                .prose h4 { font-size: 1.15rem; font-weight: 600; color: #1e1b14; margin: 1.25em 0 0.5em; }
                                .prose blockquote { border-left: 3px solid #c6a85a; padding-left: 1.25em; font-style: italic; color: #6b7280; margin: 1.5em 0; }
                                .prose a { color: #c6a85a; text-decoration: underline; }
                                .prose a:hover { color: #a8903e; }
                            </style>
                            <?php the_content(); ?>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Project Gallery Section (Tabbed) -->
        <?php
        $gallery_categories = get_post_meta(get_the_ID(), '_prestige_gallery_categories', true);
        $has_categories = !empty($gallery_categories) && is_array($gallery_categories);

        // Fallback: old flat gallery
        if (!$has_categories) {
            $old_ids = get_post_meta(get_the_ID(), '_prestige_project_gallery', true);
            if (!empty($old_ids)) {
                $gallery_categories = array(array('name' => 'Genel', 'ids' => $old_ids));
                $has_categories = true;
            }
        }

        if ($has_categories && count($gallery_categories) > 0):
            // Build a flat "all" list + per-category arrays
            $all_items = array(); // [{id, cat_slug, cat_name}]
            $cat_names = array();
            foreach ($gallery_categories as $ci => $cat) {
                $cat_name = !empty($cat['name']) ? $cat['name'] : 'Kategori ' . ($ci + 1);
                $cat_slug = 'cat-' . $ci;
                $cat_names[$cat_slug] = $cat_name;
                $ids = !empty($cat['ids']) ? array_filter(explode(',', $cat['ids'])) : array();
                foreach ($ids as $item_id) {
                    $all_items[] = array('id' => $item_id, 'cat_slug' => $cat_slug);
                }
            }
            if (count($all_items) > 0):
        ?>
            <section class="bg-navy-dark py-24 md:py-32 relative overflow-hidden" id="gallery">
                <!-- Subtle Pattern Background -->
                <div class="absolute inset-0 opacity-5"
                    style="background-image: radial-gradient(#cdab56 1px, transparent 1px); background-size: 32px 32px;"></div>
                <div class="max-w-[1440px] mx-auto px-6 relative z-10">
                    <div class="flex flex-col gap-12">
                        <!-- Section Header -->
                        <div class="flex flex-col items-center text-center space-y-4">
                            <span class="text-primary text-sm font-medium tracking-[0.3em] uppercase">Proje Galerisi</span>
                        </div>

                        <!-- Tab Navigation -->
                        <?php if (count($cat_names) > 1): ?>
                        <div class="flex flex-wrap justify-center gap-2 md:gap-4">
                            <button type="button" class="gallery-tab active px-6 py-3 text-xs uppercase tracking-[0.2em] font-semibold border border-white/10 rounded-sm transition-all duration-500 text-primary bg-primary/5 border-primary/30"
                                    data-category="all">
                                Tüm Resimler
                            </button>
                            <?php foreach ($cat_names as $slug => $name): ?>
                            <button type="button" class="gallery-tab px-6 py-3 text-xs uppercase tracking-[0.2em] font-semibold border border-white/10 rounded-sm transition-all duration-500 text-gray-400 hover:text-primary hover:border-primary/20"
                                    data-category="<?php echo esc_attr($slug); ?>">
                                <?php echo esc_html($name); ?>
                            </button>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>

                        <!-- Gallery Grid -->
                        <div id="gallery-grid" class="columns-1 md:columns-2 lg:columns-3 gap-8 space-y-8">
                            <?php foreach ($all_items as $item):
                                $item_id = $item['id'];
                                if (empty($item_id)) continue;
                                $mime = get_post_mime_type($item_id);
                                $is_video = strpos($mime, 'video') !== false;
                            ?>
                            <div class="gallery-item break-inside-avoid overflow-hidden rounded-lg group relative bg-black/20 transition-all duration-500"
                                 data-category="<?php echo esc_attr($item['cat_slug']); ?>">
                                <?php if ($is_video): ?>
                                    <div class="aspect-video w-full">
                                        <video controls class="w-full h-full object-cover rounded-lg" poster="<?php echo esc_url(wp_get_attachment_image_url($item_id, 'large')); ?>">
                                            <source src="<?php echo esc_url(wp_get_attachment_url($item_id)); ?>" type="<?php echo esc_attr($mime); ?>">
                                        </video>
                                    </div>
                                <?php else: ?>
                                    <?php
                                    $full_url = wp_get_attachment_image_url($item_id, 'full');
                                    $thumb_url = wp_get_attachment_image_url($item_id, 'large');
                                    ?>
                                    <a href="<?php echo esc_url($full_url); ?>" class="block overflow-hidden rounded-lg gallery-lightbox">
                                        <img src="<?php echo esc_url($thumb_url); ?>"
                                             alt="<?php the_title(); ?>"
                                             class="w-full h-auto object-cover transition-transform duration-700 group-hover:scale-105"
                                             loading="lazy">
                                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-center justify-center">
                                            <span class="material-symbols-outlined text-white text-3xl">fullscreen</span>
                                        </div>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Lightbox Overlay -->
            <div id="gallery-lightbox-overlay" style="display:none; position:fixed; inset:0; z-index:9999; background:rgba(0,0,0,0.95); backdrop-filter:blur(8px); -webkit-backdrop-filter:blur(8px);">
                <!-- Close Button -->
                <button id="lightbox-close" style="position:absolute; top:20px; right:20px; z-index:10002; background:none; border:1px solid rgba(255,255,255,0.15); color:#fff; width:48px; height:48px; border-radius:50%; cursor:pointer; display:flex; align-items:center; justify-content:center; transition:all 0.3s;">
                    <span class="material-symbols-outlined" style="font-size:24px;">close</span>
                </button>
                <!-- Counter -->
                <div id="lightbox-counter" style="position:absolute; top:28px; left:50%; transform:translateX(-50%); z-index:10002; color:rgba(255,255,255,0.5); font-size:13px; letter-spacing:0.15em; text-transform:uppercase; font-weight:500;"></div>
                <!-- Prev Arrow -->
                <button id="lightbox-prev" style="position:absolute; left:16px; top:50%; transform:translateY(-50%); z-index:10002; background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.1); color:#fff; width:52px; height:52px; border-radius:50%; cursor:pointer; display:flex; align-items:center; justify-content:center; transition:all 0.3s;">
                    <span class="material-symbols-outlined" style="font-size:28px;">chevron_left</span>
                </button>
                <!-- Next Arrow -->
                <button id="lightbox-next" style="position:absolute; right:16px; top:50%; transform:translateY(-50%); z-index:10002; background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.1); color:#fff; width:52px; height:52px; border-radius:50%; cursor:pointer; display:flex; align-items:center; justify-content:center; transition:all 0.3s;">
                    <span class="material-symbols-outlined" style="font-size:28px;">chevron_right</span>
                </button>
                <!-- Image Container -->
                <div id="lightbox-image-wrap" style="position:absolute; inset:0; display:flex; align-items:center; justify-content:center; padding:80px 80px 60px; cursor:zoom-out;">
                    <img id="lightbox-img" src="" alt="" style="max-width:100%; max-height:100%; object-fit:contain; border-radius:4px; opacity:0; transition:opacity 0.35s ease;" />
                </div>
            </div>

            <!-- Gallery Tab Filtering + Lightbox Script -->
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                /* ========== TAB FILTERING ========== */
                var tabs = document.querySelectorAll('.gallery-tab');
                var items = document.querySelectorAll('.gallery-item');

                if (tabs.length > 0) {
                    tabs.forEach(function(tab) {
                        tab.addEventListener('click', function() {
                            var category = this.getAttribute('data-category');
                            tabs.forEach(function(t) {
                                t.classList.remove('active', 'text-primary', 'bg-primary/5', 'border-primary/30');
                                t.classList.add('text-gray-400');
                            });
                            this.classList.add('active', 'text-primary', 'bg-primary/5', 'border-primary/30');
                            this.classList.remove('text-gray-400');
                            items.forEach(function(item) {
                                var itemCat = item.getAttribute('data-category');
                                if (category === 'all' || itemCat === category) {
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
                }

                /* ========== LIGHTBOX CAROUSEL ========== */
                var overlay   = document.getElementById('gallery-lightbox-overlay');
                var lbImg     = document.getElementById('lightbox-img');
                var lbCounter = document.getElementById('lightbox-counter');
                var btnClose  = document.getElementById('lightbox-close');
                var btnPrev   = document.getElementById('lightbox-prev');
                var btnNext   = document.getElementById('lightbox-next');
                var lbWrap    = document.getElementById('lightbox-image-wrap');

                var currentIndex = 0;
                var visibleLinks = [];

                function getVisibleLinks() {
                    var links = [];
                    document.querySelectorAll('.gallery-item').forEach(function(item) {
                        if (item.style.display === 'none') return;
                        var a = item.querySelector('a.gallery-lightbox');
                        if (a) links.push(a);
                    });
                    return links;
                }

                function showImage(index) {
                    if (index < 0 || index >= visibleLinks.length) return;
                    currentIndex = index;
                    lbImg.style.opacity = '0';
                    setTimeout(function() {
                        lbImg.src = visibleLinks[currentIndex].getAttribute('href');
                        lbImg.onload = function() { lbImg.style.opacity = '1'; };
                    }, 150);
                    lbCounter.textContent = (currentIndex + 1) + ' / ' + visibleLinks.length;
                    btnPrev.style.opacity = currentIndex === 0 ? '0.3' : '1';
                    btnNext.style.opacity = currentIndex === visibleLinks.length - 1 ? '0.3' : '1';
                }

                function openLightbox(link) {
                    visibleLinks = getVisibleLinks();
                    currentIndex = visibleLinks.indexOf(link);
                    if (currentIndex === -1) currentIndex = 0;
                    overlay.style.display = 'block';
                    document.body.style.overflow = 'hidden';
                    showImage(currentIndex);
                }

                function closeLightbox() {
                    overlay.style.display = 'none';
                    document.body.style.overflow = '';
                    lbImg.src = '';
                    lbImg.style.opacity = '0';
                }

                // Open on image click
                document.addEventListener('click', function(e) {
                    var link = e.target.closest('a.gallery-lightbox');
                    if (link) { e.preventDefault(); openLightbox(link); }
                });

                // Close
                btnClose.addEventListener('click', closeLightbox);
                lbWrap.addEventListener('click', function(e) {
                    if (e.target === lbWrap) closeLightbox();
                });

                // Nav
                btnPrev.addEventListener('click', function(e) { e.stopPropagation(); if (currentIndex > 0) showImage(currentIndex - 1); });
                btnNext.addEventListener('click', function(e) { e.stopPropagation(); if (currentIndex < visibleLinks.length - 1) showImage(currentIndex + 1); });

                // Keyboard
                document.addEventListener('keydown', function(e) {
                    if (overlay.style.display !== 'block') return;
                    if (e.key === 'Escape') closeLightbox();
                    if (e.key === 'ArrowLeft' && currentIndex > 0) showImage(currentIndex - 1);
                    if (e.key === 'ArrowRight' && currentIndex < visibleLinks.length - 1) showImage(currentIndex + 1);
                });

                // Hover styles for buttons
                [btnClose, btnPrev, btnNext].forEach(function(btn) {
                    btn.addEventListener('mouseenter', function() { btn.style.borderColor = 'rgba(198,168,90,0.5)'; btn.style.color = '#C6A85A'; });
                    btn.addEventListener('mouseleave', function() { btn.style.borderColor = 'rgba(255,255,255,0.15)'; btn.style.color = '#fff'; });
                });
            });
            </script>
        <?php
            endif;
        endif;
        ?>

        <!-- Closing / CTA -->
        <section class="bg-background-dark py-32 md:py-48 px-6 border-t border-white/5">
            <div class="max-w-4xl mx-auto text-center flex flex-col items-center gap-10">
                <div class="w-[1px] h-16 bg-primary/50 mb-4"></div>
                <h2 class="font-serif-heading text-4xl md:text-6xl text-white"><?php the_title(); ?></h2>
                <p class="text-gray-400 text-lg md:text-xl max-w-xl font-light">Capital Yaşam İnşaat kalitesiyle inşa edilen bu projede yerinizi alın. Detaylı bilgi ve yerinde inceleme için bizimle iletişime geçin.</p>
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
