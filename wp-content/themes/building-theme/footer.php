<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @package Building_Theme
 */

?>

<!-- Footer -->
<footer class="bg-navy-dark pt-28 pb-12 border-t border-white/5" id="contact">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 lg:gap-24 mb-16">
            <!-- Brand Col -->
            <div class="md:col-span-1">
                <div class="flex items-center gap-2 mb-6">
                    <?php
                    $footer_logo = get_option('prestige_footer_logo');
                    if ($footer_logo):
                        ?>
                        <img src="<?php echo esc_url($footer_logo); ?>" alt="<?php bloginfo('name'); ?>"
                            class="h-24 w-auto object-contain">
                    <?php else: ?>
                        <span class="material-icons text-primary text-2xl">temple_hindu</span>
                        <span
                            class="font-serif-heading font-bold text-xl tracking-widest text-white uppercase"><?php bloginfo('name'); ?></span>
                    <?php endif; ?>
                </div>
                <p class="text-gray-400 text-xs leading-relaxed mb-6">
                    Prestij ve kalite ile yaşam alanlarını yeniden tanımlıyoruz.
                </p>
                <div class="flex gap-4">
                    <a class="text-gray-400 hover:text-primary transition-colors" href="https://www.instagram.com/capitalyasaminsaat/" target="_blank" rel="noopener noreferrer" title="Instagram">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    </a>
                </div>
            </div>
            <!-- Navigation Col -->
            <div>
                <h4 class="text-white text-[10px] uppercase tracking-[0.3em] font-bold mb-8 opacity-80">Şirket</h4>
                <ul class="space-y-4">
                    <li><a class="text-gray-400 hover:text-primary transition-colors text-xs tracking-wider"
                            href="<?php echo esc_url(home_url('/hakkimizda')); ?>">Hakkımızda</a></li>
                    <li><a class="text-gray-400 hover:text-primary transition-colors text-xs tracking-wider"
                            href="<?php echo esc_url(home_url('/vizyon')); ?>">Vizyon</a></li>
                    <li><a class="text-gray-400 hover:text-primary transition-colors text-xs tracking-wider"
                            href="<?php echo esc_url(home_url('/misyon')); ?>">Misyon</a></li>
                    <li><a class="text-gray-400 hover:text-primary transition-colors text-xs tracking-wider"
                            href="<?php echo esc_url(home_url('/projeler')); ?>">Projeler</a></li>
                </ul>
            </div>
            <!-- Projects Col -->
            <div>
                <h4 class="text-white text-[10px] uppercase tracking-[0.3em] font-bold mb-8 opacity-80">Projelerimiz
                </h4>
                <ul class="space-y-4">
                    <?php
                    $projeler_cat = get_category_by_slug('projelerimiz');
                    $projeler_cat_id = $projeler_cat ? $projeler_cat->term_id : 0;

                    $footer_projects = new WP_Query(array(
                        'posts_per_page' => 5,
                        'cat' => $projeler_cat_id,
                        'post_status' => 'publish',
                        'orderby' => 'date',
                        'order' => 'DESC'
                    ));

                    if ($footer_projects->have_posts()):
                        while ($footer_projects->have_posts()):
                            $footer_projects->the_post();
                            ?>
                            <li><a class="text-gray-400 hover:text-primary transition-colors text-xs tracking-wider"
                                    href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    else:
                        ?>
                        <li><a class="text-gray-400 hover:text-primary transition-colors text-xs tracking-wider"
                                href="<?php echo esc_url(home_url('/projeler')); ?>">Tüm Projeler</a></li>
                        <?php
                    endif;
                    ?>
                </ul>
            </div>
            <!-- Contact Col -->
            <div>
                <h4 class="text-white text-[10px] uppercase tracking-[0.3em] font-bold mb-8 opacity-80">İletişim</h4>
                <ul class="space-y-5">
                    <li class="flex items-start gap-3">
                        <span class="material-icons text-primary/80 text-sm mt-0.5">place</span>
                        <span class="text-gray-400 text-xs leading-relaxed tracking-wide">Toros Mah. 78143 Sk.<br />Hilal Tower, Bina No: 4A<br />Çukurova / Adana</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="material-icons text-primary/80 text-sm">phone</span>
                        <a href="tel:+905313550738" class="text-gray-400 hover:text-primary transition-colors text-xs tracking-wide">+90 531 355 07 38</a>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-4 h-4 text-primary/80 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        <a href="https://www.instagram.com/capitalyasaminsaat/" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-primary transition-colors text-xs tracking-wide">@capitalyasaminsaat</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="border-t border-white/5 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-gray-500 text-xs">
                © <?php echo date('Y'); ?> Capital Yaşam İnşaat. Tüm hakları saklıdır.
            </p>

        </div>
    </div>
</footer>
</div><!-- #page -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Mobile menu toggle
        const menuBtn = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        if (menuBtn && mobileMenu) {
            menuBtn.addEventListener('click', function () {
                mobileMenu.classList.toggle('hidden');
                const icon = menuBtn.querySelector('.material-icons');
                const expanded = !mobileMenu.classList.contains('hidden');
                menuBtn.setAttribute('aria-expanded', expanded);
                icon.textContent = expanded ? 'close' : 'menu';
            });
        }

        // Mobile sub-menu dropdown toggles
        document.querySelectorAll('.mobile-dropdown-toggle').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const submenu = btn.nextElementSibling;
                const icon = btn.querySelector('.material-icons');
                if (submenu && submenu.classList.contains('mobile-submenu')) {
                    submenu.classList.toggle('hidden');
                    if (icon) {
                        icon.style.transform = submenu.classList.contains('hidden') ? '' : 'rotate(180deg)';
                    }
                }
            });
        });
    });
</script>


<a href="https://wa.me/905313550738" target="_blank" rel="noopener noreferrer"
    class="fixed bottom-8 left-8 z-[100] w-14 h-14 bg-navy-dark border border-primary/40 rounded-full flex items-center justify-center text-primary shadow-2xl hover:bg-primary hover:text-navy-dark hover:scale-110 transition-all duration-500 group"
    title="WhatsApp ile İletişime Geçin">
    <div class="absolute inset-0 rounded-full bg-primary/20 animate-ping group-hover:hidden"></div>
    <svg class="w-7 h-7 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path
            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.438 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
    </svg>
</a>
<!-- Global Scroll Reveal System -->
<style>
    /* Base hidden state for scroll reveal */
    .sr-hidden {
        opacity: 0;
        transform: translateY(40px);
        transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .sr-hidden.sr-left {
        transform: translateX(-40px);
    }
    .sr-hidden.sr-right {
        transform: translateX(40px);
    }
    .sr-hidden.sr-scale {
        transform: scale(0.95);
    }
    /* Revealed state */
    .sr-visible {
        opacity: 1 !important;
        transform: translateY(0) translateX(0) scale(1) !important;
    }
    /* Respect reduced motion */
    @media (prefers-reduced-motion: reduce) {
        .sr-hidden {
            opacity: 1;
            transform: none;
            transition: none;
        }
    }
</style>

<script>
(function() {
    // Wait for DOM
    document.addEventListener('DOMContentLoaded', function() {
        // Selectors for elements to animate
        var selectors = [
            'main section',
            'main .grid > div',
            'main h2',
            'main h3',
            '.project-item',
            '.fp-project-item',
            '.gallery-item',
            'footer .grid > div',
            'main a.group',
            'main .flex.flex-col.gap-32 > div',
            'main img[loading="lazy"]'
        ];

        var elements = document.querySelectorAll(selectors.join(', '));
        if (!elements.length) return;

        // Skip hero section (first section) and splash preloader
        var heroSection = document.querySelector('main > header, main > section:first-of-type');

        elements.forEach(function(el, i) {
            // Don't animate hero, splash, nav, or already visible elements
            if (el === heroSection || el.closest('#splash-preloader') || el.closest('nav')) return;
            if (el.closest('header.relative')) return; // hero header

            // Don't double-apply
            if (el.classList.contains('sr-hidden')) return;

            el.classList.add('sr-hidden');

            // Add stagger delay for grid children
            var parent = el.parentElement;
            if (parent && (parent.classList.contains('grid') || parent.classList.contains('flex'))) {
                var siblings = Array.from(parent.children);
                var idx = siblings.indexOf(el);
                if (idx > 0) {
                    el.style.transitionDelay = (idx * 0.1) + 's';
                }
            }
        });

        // Intersection Observer
        var observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('sr-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.08,
            rootMargin: '0px 0px -60px 0px'
        });

        document.querySelectorAll('.sr-hidden').forEach(function(el) {
            observer.observe(el);
        });
    });
})();
</script>

<?php wp_footer(); ?>

</body>

</html>
