<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class('bg-background-light dark:bg-background-dark text-gray-800 dark:text-gray-200 font-display selection:bg-primary selection:text-white overflow-x-hidden'); ?>>
    <?php wp_body_open(); ?>

    <!-- Premium Splash / Preloader -->
    <?php $splash_logo = get_option('prestige_header_logo'); ?>
    <div id="splash-preloader">
        <style>
            #splash-preloader {
                position: fixed;
                inset: 0;
                z-index: 99999;
                background: #0b1120;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                transition: opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1), transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
            }
            #splash-preloader.splash-hide {
                opacity: 0;
                transform: scale(1.05);
                pointer-events: none;
            }
            /* Logo wrapper */
            .splash-logo-wrap {
                position: relative;
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 32px;
            }
            /* Logo image */
            .splash-logo {
                width: 300px;
                height: auto;
                opacity: 0;
                transform: translateY(20px) scale(0.9);
                animation: splashLogoIn 1s cubic-bezier(0.16, 1, 0.3, 1) 0.3s forwards;
            }
            @media (min-width: 768px) {
                .splash-logo { width: 420px; }
            }
            @keyframes splashLogoIn {
                to {
                    opacity: 1;
                    transform: translateY(0) scale(1);
                }
            }
            /* Golden shimmer effect over logo */
            .splash-logo-wrap::after {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 60%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(198, 168, 90, 0.15), transparent);
                animation: splashShimmer 2s ease-in-out 0.8s;
            }
            @keyframes splashShimmer {
                to { left: 200%; }
            }
            /* Decorative line */
            .splash-line {
                width: 1px;
                height: 0;
                background: linear-gradient(to bottom, rgba(198, 168, 90, 0.6), transparent);
                animation: splashLineGrow 1s ease-out 0.6s forwards;
            }
            @keyframes splashLineGrow {
                to { height: 60px; }
            }
            /* Progress bar */
            .splash-progress-track {
                position: absolute;
                bottom: 80px;
                left: 50%;
                transform: translateX(-50%);
                width: 180px;
                height: 1px;
                background: rgba(255, 255, 255, 0.06);
                border-radius: 1px;
                overflow: hidden;
                opacity: 0;
                animation: splashFadeIn 0.5s ease 0.5s forwards;
            }
            .splash-progress-bar {
                height: 100%;
                width: 0%;
                background: linear-gradient(90deg, #c6a85a, #e8d5a0);
                border-radius: 1px;
                animation: splashProgress 1.8s cubic-bezier(0.4, 0, 0.2, 1) 0.6s forwards;
            }
            @keyframes splashProgress {
                to { width: 100%; }
            }
            /* Tagline */
            .splash-tagline {
                position: absolute;
                bottom: 100px;
                left: 50%;
                transform: translateX(-50%);
                color: rgba(255, 255, 255, 0.25);
                font-size: 10px;
                letter-spacing: 0.35em;
                text-transform: uppercase;
                font-weight: 500;
                white-space: nowrap;
                opacity: 0;
                animation: splashFadeIn 0.6s ease 1s forwards;
            }
            @keyframes splashFadeIn {
                to { opacity: 1; }
            }
            /* Corner accents */
            .splash-corner {
                position: absolute;
                width: 40px;
                height: 40px;
                border-color: rgba(198, 168, 90, 0.12);
                opacity: 0;
                animation: splashFadeIn 0.8s ease 0.4s forwards;
            }
            .splash-corner--tl { top: 40px; left: 40px; border-top: 1px solid; border-left: 1px solid; }
            .splash-corner--tr { top: 40px; right: 40px; border-top: 1px solid; border-right: 1px solid; }
            .splash-corner--bl { bottom: 40px; left: 40px; border-bottom: 1px solid; border-left: 1px solid; }
            .splash-corner--br { bottom: 40px; right: 40px; border-bottom: 1px solid; border-right: 1px solid; }
        </style>

        <!-- Corner Accents -->
        <div class="splash-corner splash-corner--tl"></div>
        <div class="splash-corner splash-corner--tr"></div>
        <div class="splash-corner splash-corner--bl"></div>
        <div class="splash-corner splash-corner--br"></div>

        <!-- Logo -->
        <div class="splash-logo-wrap">
            <?php if ($splash_logo): ?>
                <img src="<?php echo esc_url($splash_logo); ?>" alt="<?php bloginfo('name'); ?>" class="splash-logo" />
            <?php else: ?>
                <div class="splash-logo" style="display:flex;align-items:center;gap:12px;">
                    <span class="material-icons" style="font-size:48px;color:#c6a85a;">temple_hindu</span>
                    <span style="font-family:serif;font-size:32px;color:#fff;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;"><?php bloginfo('name'); ?></span>
                </div>
            <?php endif; ?>
            <div class="splash-line"></div>
        </div>

        <!-- Tagline -->
        <span class="splash-tagline">Prestij ile İnşa Ediyoruz</span>

        <!-- Progress Bar -->
        <div class="splash-progress-track">
            <div class="splash-progress-bar"></div>
        </div>
    </div>

    <script>
    (function() {
        var splash = document.getElementById('splash-preloader');
        if (!splash) return;

        // Block scroll while splash is visible
        document.documentElement.style.overflow = 'hidden';

        function dismissSplash() {
            splash.classList.add('splash-hide');
            document.documentElement.style.overflow = '';
            setTimeout(function() { splash.remove(); }, 900);
        }

        // Dismiss after animations complete (min 2.6s) or on window load + delay
        var minTime = 1200;
        var startTime = Date.now();

        window.addEventListener('load', function() {
            var elapsed = Date.now() - startTime;
            var remaining = Math.max(0, minTime - elapsed);
            setTimeout(dismissSplash, remaining);
        });

        // Safety fallback: always dismiss after 2.5s
        setTimeout(function() {
            if (splash.parentNode) dismissSplash();
        }, 2500);
    })();
    </script>

    <div id="page" class="site">
        <a class="skip-link screen-reader-text"
            href="#primary"><?php esc_html_e('Skip to content', 'building-theme'); ?></a>

        <!-- Navigation -->
        <nav class="fixed w-full z-50 transition-all duration-300 glass-nav">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-24">
                    <div class="flex-shrink-0 flex items-center gap-2">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center gap-2">
                        <?php
                        $header_logo = get_option('prestige_header_logo');
                        if ($header_logo):
                            ?>
                            <img src="<?php echo esc_url($header_logo); ?>" alt="<?php bloginfo('name'); ?>"
                                class="h-36 w-auto object-contain">
                        <?php else: ?>
                            <span class="material-icons text-primary text-3xl">temple_hindu</span>
                            <span
                                class="font-serif-heading font-bold text-2xl tracking-widest text-white uppercase"><?php bloginfo('name'); ?></span>
                        <?php endif; ?>
                        </a>
                    </div>
                    <div class="hidden md:flex items-center gap-8">
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'anamenu',
                                'container' => false,
                                'items_wrap' => '%3$s',
                                'fallback_cb' => false,
                                'walker' => new Building_Theme_Desktop_Walker('text-xs uppercase tracking-[0.2em] text-gray-400 hover:text-primary transition-all duration-300'),
                            )
                        );
                        ?>
                    </div>
                    <div class="hidden md:block">
                        <a class="px-8 py-3 border border-primary/20 text-primary hover:bg-primary hover:text-white transition-all duration-500 text-xs uppercase tracking-[0.2em] rounded-sm"
                            href="/build.com/index.php/iletisim/">
                            İletişime Geç
                        </a>
                    </div>
                    <!-- Mobile menu button -->
                    <div class="md:hidden flex items-center">
                        <button id="mobile-menu-button" class="text-gray-300 hover:text-white focus:outline-none"
                            aria-controls="mobile-menu" aria-expanded="false">
                            <span class="material-icons">menu</span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu -->
            <div id="mobile-menu"
                class="hidden md:hidden bg-background-dark/95 backdrop-blur-lg border-t border-white/10 px-4 pt-2 pb-6">
                <div class="space-y-1">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'anamenu',
                            'container' => false,
                            'items_wrap' => '%3$s',
                            'fallback_cb' => false,
                            'walker' => new Building_Theme_Mobile_Walker('block px-3 py-4 text-xs font-medium text-gray-300 hover:text-primary transition-all duration-300 uppercase tracking-widest'),
                        )
                    );
                    ?>
                </div>
            </div>
        </nav>
