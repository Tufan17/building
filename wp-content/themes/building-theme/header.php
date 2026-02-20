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
    <div id="page" class="site">
        <a class="skip-link screen-reader-text"
            href="#primary"><?php esc_html_e('Skip to content', 'building-theme'); ?></a>

        <!-- Navigation -->
        <nav class="fixed w-full z-50 transition-all duration-300 glass-nav">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-24">
                    <div class="flex-shrink-0 flex items-center gap-2">
                        <?php
                        $header_logo = get_option('prestige_header_logo');
                        if ($header_logo):
                            ?>
                            <img src="<?php echo esc_url($header_logo); ?>" alt="<?php bloginfo('name'); ?>"
                                class="h-12 w-auto object-contain">
                        <?php else: ?>
                            <span class="material-icons text-primary text-3xl">temple_hindu</span>
                            <span
                                class="font-serif-heading font-bold text-2xl tracking-widest text-white uppercase"><?php bloginfo('name'); ?></span>
                        <?php endif; ?>
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