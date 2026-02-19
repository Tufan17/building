<?php
/**
 * Building Theme functions and definitions
 *
 * @package Building_Theme
 */

if (!function_exists('building_theme_setup')):
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     */
    function building_theme_setup()
    {
        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        // Let WordPress manage the document title.
        add_theme_support('title-tag');

        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'menu-1' => esc_html__('Primary', 'building-theme'),
            'anamenu' => esc_html__('Ana Menü', 'building-theme'),
        ));

        // Switch default core markup for search form, comment form, and comments to output valid HTML5.
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        ));
    }
endif;
add_action('after_setup_theme', 'building_theme_setup');

/**
 * Enqueue scripts and styles.
 */
function building_theme_scripts()
{
    // Core WordPress style
    wp_enqueue_style('building-theme-style', get_stylesheet_uri(), array(), '1.0.0');

    // Tailwind CSS via CDN
    wp_enqueue_script('tailwind-cdn', 'https://cdn.tailwindcss.com?plugins=forms,container-queries', array(), null, false);

    // Google Fonts: Manrope, Playfair Display, Newsreader, Noto Sans
    wp_enqueue_style('google-fonts-prestige', 'https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Newsreader:ital,opsz,wght@0,6..72,200..800;1,6..72,200..800&family=Noto+Sans:wght@300;400;500;700&display=swap', array(), null);

    // Material Icons & Symbols
    wp_enqueue_style('material-icons', 'https://fonts.googleapis.com/icon?family=Material+Icons', array(), null);
    wp_enqueue_style('material-symbols', 'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap', array(), null);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'building_theme_scripts');

/**
 * Add Tailwind Config to the header
 */
function building_theme_tailwind_config()
{
    ?>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#C6A85A",
                        "primary-dark": "#A68A4A",
                        "background-light": "#f8f7f6",
                        "background-dark": "#111827",
                        "navy-dark": "#0B1120",
                        "off-white": "#F9FAFB",
                    },
                    fontFamily: {
                        "display": ["Manrope", "sans-serif"],
                        "serif": ["Playfair Display", "serif"],
                        "newsreader": ["Newsreader", "serif"],
                        "noto": ["Noto Sans", "sans-serif"],
                    },
                    borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" },
                    spacing: {
                        '128': '32rem',
                    }
                },
            },
        }
    </script>
    <style>
        html {
            scroll-behavior: smooth;
        }

        .font-serif-heading {
            font-family: 'Playfair Display', serif;
        }

        .glass-nav {
            background: rgba(11, 17, 32, 0.9);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(198, 168, 90, 0.15);
        }
    </style>
    <?php
}
add_action('wp_head', 'building_theme_tailwind_config');

/**
 * Desktop Nav Walker - hover dropdown for sub-menus
 */
class Building_Theme_Desktop_Walker extends Walker_Nav_Menu
{
    private $link_classes;
    private $parent_items = array();

    public function __construct($link_classes = '')
    {
        $this->link_classes = $link_classes;
    }

    public function start_lvl(&$output, $depth = 0, $args = null)
    {
        if ($depth === 0) {
            $output .= '<div class="absolute left-1/2 -translate-x-1/2 top-full pt-3 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">';
            $output .= '<div class="bg-background-dark/95 backdrop-blur-xl border border-white/10 rounded-sm py-2 min-w-[220px] shadow-2xl">';
        }
    }

    public function end_lvl(&$output, $depth = 0, $args = null)
    {
        if ($depth === 0) {
            $output .= '</div></div>';
        }
    }

    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $title = apply_filters('the_title', $item->title, $item->ID);
        $current_class = $item->current ? ' text-primary' : '';

        if ($depth === 0 && $this->has_children) {
            $this->parent_items[$item->ID] = true;
            $href = !empty($item->url) && $item->url !== '#' ? esc_url($item->url) : '#';
            $output .= '<div class="relative group">';
            $output .= '<a href="' . $href . '" class="' . esc_attr($this->link_classes . $current_class) . ' flex items-center gap-1">';
            $output .= $title;
            $output .= '<span class="material-icons text-xs transition-transform duration-300 group-hover:rotate-180">expand_more</span>';
            $output .= '</a>';
        } elseif ($depth > 0) {
            $href = !empty($item->url) ? esc_url($item->url) : '';
            $output .= '<a href="' . $href . '" class="block px-5 py-2.5 text-xs uppercase tracking-widest text-gray-400 hover:text-primary hover:bg-white/5 transition-all duration-300' . esc_attr($current_class) . '">';
            $output .= $title;
        } else {
            $href = !empty($item->url) ? esc_url($item->url) : '';
            $target = !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
            $output .= '<a href="' . $href . '"' . $target . ' class="' . esc_attr($this->link_classes . $current_class) . '">';
            $output .= $title;
        }
    }

    public function end_el(&$output, $item, $depth = 0, $args = null)
    {
        if ($depth === 0 && isset($this->parent_items[$item->ID])) {
            $output .= '</div>';
        } else {
            $output .= '</a>';
        }
    }
}

/**
 * Mobile Nav Walker - click-to-expand sub-menus
 */
class Building_Theme_Mobile_Walker extends Walker_Nav_Menu
{
    private $link_classes;
    private $parent_items = array();

    public function __construct($link_classes = '')
    {
        $this->link_classes = $link_classes;
    }

    public function start_lvl(&$output, $depth = 0, $args = null)
    {
        if ($depth === 0) {
            $output .= '<div class="mobile-submenu hidden pl-4 border-l border-white/10 ml-3 mt-1">';
        }
    }

    public function end_lvl(&$output, $depth = 0, $args = null)
    {
        if ($depth === 0) {
            $output .= '</div>';
        }
    }

    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $title = apply_filters('the_title', $item->title, $item->ID);
        $current_class = $item->current ? ' text-primary' : '';

        if ($depth === 0 && $this->has_children) {
            $this->parent_items[$item->ID] = true;
            $output .= '<div class="mobile-dropdown">';
            $output .= '<button type="button" class="mobile-dropdown-toggle w-full text-left ' . esc_attr($this->link_classes . $current_class) . ' flex items-center justify-between">';
            $output .= $title;
            $output .= '<span class="material-icons text-sm transition-transform duration-300">expand_more</span>';
            $output .= '</button>';
        } elseif ($depth > 0) {
            $href = !empty($item->url) ? esc_url($item->url) : '';
            $output .= '<a href="' . $href . '" class="block px-3 py-3 text-xs font-medium text-gray-400 hover:text-primary transition-all duration-300 uppercase tracking-widest' . esc_attr($current_class) . '">';
            $output .= $title;
        } else {
            $href = !empty($item->url) ? esc_url($item->url) : '';
            $target = !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
            $output .= '<a href="' . $href . '"' . $target . ' class="' . esc_attr($this->link_classes . $current_class) . '">';
            $output .= $title;
        }
    }

    public function end_el(&$output, $item, $depth = 0, $args = null)
    {
        if ($depth === 0 && isset($this->parent_items[$item->ID])) {
            $output .= '</div>';
        } else {
            $output .= '</a>';
        }
    }
}
/**
 * Custom Partner CPT & Tax
 */
require get_template_directory() . '/inc/partners-cpt.php';

/**
 * Custom Admin Settings
 */
require get_template_directory() . '/inc/admin-settings.php';

/**
 * Custom Taxonomy: Konum (Ülke > Şehir hiyerarşisi)
 * Üst seviye = Ülkeler, Alt seviye = Şehirler
 */
function prestige_register_taxonomies()
{
    register_taxonomy('konum', 'post', array(
        'labels' => array(
            'name' => 'Konumlar',
            'singular_name' => 'Konum',
            'search_items' => 'Konum Ara',
            'all_items' => 'Tüm Konumlar',
            'parent_item' => 'Üst Konum (Ülke)',
            'parent_item_colon' => 'Üst Konum (Ülke):',
            'edit_item' => 'Konumu Düzenle',
            'update_item' => 'Konumu Güncelle',
            'add_new_item' => 'Yeni Konum Ekle',
            'new_item_name' => 'Yeni Konum Adı',
            'menu_name' => 'Konumlar (Ülke/Şehir)',
        ),
        'hierarchical' => true,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'konum'),
    ));
}
add_action('init', 'prestige_register_taxonomies');

/**
 * Meta Box: İnşaat Yılı (Construction Year)
 */
function prestige_add_year_meta_box()
{
    add_meta_box(
        'prestige_insaat_yili',
        'İnşaat Yılı',
        'prestige_render_year_meta_box',
        'post',
        'side',
        'high'
    );
}
add_action('add_meta_boxes', 'prestige_add_year_meta_box');

function prestige_render_year_meta_box($post)
{
    wp_nonce_field('prestige_save_year', 'prestige_year_nonce');
    $year = get_post_meta($post->ID, '_prestige_insaat_yili', true);
    ?>
    <label for="prestige_insaat_yili" style="display:block;margin-bottom:5px;font-weight:600;">Yıl:</label>
    <input type="text" id="prestige_insaat_yili" name="prestige_insaat_yili" value="<?php echo esc_attr($year); ?>"
        placeholder="Örn: 2024" style="width:100%;padding:6px 8px;" />
    <p class="description" style="margin-top:5px;">Projenin inşaat yılını girin.</p>
    <?php
}

function prestige_save_year_meta($post_id)
{
    if (!isset($_POST['prestige_year_nonce']) || !wp_verify_nonce($_POST['prestige_year_nonce'], 'prestige_save_year')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    if (isset($_POST['prestige_insaat_yili'])) {
        update_post_meta($post_id, '_prestige_insaat_yili', sanitize_text_field($_POST['prestige_insaat_yili']));
    }
}
add_action('save_post', 'prestige_save_year_meta');
