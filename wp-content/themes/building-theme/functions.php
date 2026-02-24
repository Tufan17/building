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

    // Tailwind CSS generated file
    wp_enqueue_style('tailwindcss', get_template_directory_uri() . '/assets/css/tailwind.css', array(), '1.0.0');

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
 * ═══════════════════════════════════════════════════════
 * PERFORMANCE OPTIMIZATIONS (PageSpeed 90+ Target)
 * ═══════════════════════════════════════════════════════
 */

/**
 * Performance: Resource Hints — preconnect to external origins
 */
function building_resource_hints()
{
    echo '<link rel="preconnect" href="https://fonts.googleapis.com" crossorigin />' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />' . "\n";
}
add_action('wp_head', 'building_resource_hints', 0);



/**
 * Performance: Critical inline CSS
 * Renders splash screen, nav, and basic layout instantly before Tailwind/fonts load.
 */
function building_critical_css()
{
    ?>
    <style id="critical-css">
        html { scroll-behavior: smooth; }
        body { margin: 0; background: #0b1120; }
        .font-serif-heading { font-family: 'Playfair Display', serif; }
        .glass-nav {
            background: rgba(11, 17, 32, 0.9);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(198, 168, 90, 0.15);
        }
        img { max-width: 100%; height: auto; }
    </style>
    <?php
}
add_action('wp_head', 'building_critical_css', 3);

/**
 * Performance: Preload hero image on front page for faster LCP
 */
function building_preload_hero_image()
{
    if (is_front_page()) {
        $hero_bg_type = get_option('prestige_hero_bg_type', 'image');
        $hero_media = get_option('prestige_hero_media', '');
        if ($hero_media && $hero_bg_type !== 'video') {
            echo '<link rel="preload" as="image" href="' . esc_url($hero_media) . '" fetchpriority="high" />' . "\n";
        }
    }
}
add_action('wp_head', 'building_preload_hero_image', 4);

/**
 * Performance: Make Google Fonts & Material Icons non-render-blocking
 * Uses media="print" onload trick — browser downloads CSS without blocking render.
 */
function building_async_styles($tag, $handle, $href, $media)
{
    $async_handles = array('google-fonts-prestige', 'material-icons', 'material-symbols');
    if (in_array($handle, $async_handles)) {
        $tag = str_replace("media='all'", "media='print' onload=\"this.media='all'\"", $tag);
        $tag .= '<noscript><link rel="stylesheet" href="' . esc_url($href) . '" /></noscript>' . "\n";
    }
    return $tag;
}
add_filter('style_loader_tag', 'building_async_styles', 10, 4);

/**
 * Performance: Remove unnecessary WordPress default assets
 */
function building_remove_wp_bloat()
{
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('global-styles');
    wp_dequeue_style('classic-theme-styles');
    wp_deregister_script('wp-embed');
}
add_action('wp_enqueue_scripts', 'building_remove_wp_bloat', 100);

// Remove unnecessary wp_head output
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('wp_head', 'wp_oembed_add_discovery_links');

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
 * Custom Applications CPT
 */
require get_template_directory() . '/inc/applications-cpt.php';
require get_template_directory() . '/inc/blog-cpt.php';

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

    // Proje Durumu (Tamamlanan / Devam Eden)
    register_taxonomy('proje_durumu', 'post', array(
        'labels' => array(
            'name' => 'Proje Durumu',
            'singular_name' => 'Proje Durumu',
            'search_items' => 'Durum Ara',
            'all_items' => 'Tüm Durumlar',
            'edit_item' => 'Durumu Düzenle',
            'update_item' => 'Durumu Güncelle',
            'add_new_item' => 'Yeni Durum Ekle',
            'new_item_name' => 'Yeni Durum Adı',
            'menu_name' => 'Proje Durumu',
        ),
        'hierarchical' => true,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'proje-durumu'),
    ));
}
add_action('init', 'prestige_register_taxonomies');

/**
 * Auto-create default Proje Durumu terms
 */
function prestige_create_default_proje_durumu()
{
    $defaults = array(
        'tamamlanan-projeler' => 'Tamamlanan Projeler',
        'devam-eden-projeler' => 'Devam Eden Projeler',
    );
    foreach ($defaults as $slug => $name) {
        if (!term_exists($slug, 'proje_durumu')) {
            wp_insert_term($name, 'proje_durumu', array('slug' => $slug));
        }
    }
}
add_action('init', 'prestige_create_default_proje_durumu', 20);

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
/**
 * Meta Box: Kategorili Proje Galerisi (Dynamic Categories + Gallery)
 */
function prestige_add_gallery_meta_box()
{
    add_meta_box(
        'prestige_project_gallery',
        'Proje Galerisi (Kategorili)',
        'prestige_render_gallery_meta_box',
        'post',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'prestige_add_gallery_meta_box');

function prestige_render_gallery_meta_box($post)
{
    wp_nonce_field('prestige_save_gallery', 'prestige_gallery_nonce');

    $categories = get_post_meta($post->ID, '_prestige_gallery_categories', true);

    // Backward compatibility: migrate old flat gallery format
    if (empty($categories) || !is_array($categories)) {
        $old_ids = get_post_meta($post->ID, '_prestige_project_gallery', true);
        if (!empty($old_ids)) {
            $categories = array(array('name' => 'Genel', 'ids' => $old_ids));
        } else {
            $categories = array();
        }
    }
    ?>
    <style>
        .prestige-gallery-cat { background:#f9f9f9; border:1px solid #ddd; padding:20px; margin-bottom:16px; border-radius:6px; }
        .prestige-gallery-cat .cat-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:12px; gap:12px; }
        .prestige-gallery-cat .cat-header input { font-size:15px; font-weight:600; padding:8px 12px; border:1px solid #ccc; border-radius:4px; flex:1; max-width:400px; }
        .prestige-cat-gallery-list { display:flex; flex-wrap:wrap; gap:8px; list-style:none; padding:10px; margin:0 0 12px 0; border:2px dashed #ddd; min-height:90px; border-radius:4px; background:#fff; }
        .prestige-cat-gallery-list li { position:relative; width:90px; height:90px; border:1px solid #ddd; background:#eee; cursor:move; border-radius:4px; overflow:hidden; }
        .prestige-cat-gallery-list li:hover { border-color:#007cba; }
        .prestige-cat-gallery-list li img { width:100%; height:100%; object-fit:cover; }
        .prestige-cat-remove-img { position:absolute; top:-6px; right:-6px; background:#e00; color:#fff; border-radius:50%; width:22px; height:22px; line-height:20px; text-align:center; text-decoration:none; font-size:14px; font-weight:bold; box-shadow:0 2px 4px rgba(0,0,0,0.2); z-index:10; }
        .prestige-cat-remove-img:hover { background:#b00 !important; color:#fff; }
        #prestige-add-category { margin-top:12px; }
    </style>

    <p class="description" style="margin-bottom:15px;">
        Her kategori için ayrı görseller yükleyebilirsiniz (örn: İç Mekan, Dış Mekan, Bahçe vb.). Proje detay sayfasında bu kategoriler tab olarak görüntülenir.
    </p>

    <div id="prestige-gallery-categories">
        <?php foreach ($categories as $idx => $cat):
            $cat_name = isset($cat['name']) ? $cat['name'] : '';
            $cat_ids  = isset($cat['ids'])  ? $cat['ids']  : '';
            $ids_array = !empty($cat_ids) ? array_filter(explode(',', $cat_ids)) : array();
        ?>
        <div class="prestige-gallery-cat" data-index="<?php echo $idx; ?>">
            <div class="cat-header">
                <input type="text" name="prestige_gallery_cats[<?php echo $idx; ?>][name]"
                       value="<?php echo esc_attr($cat_name); ?>" placeholder="Kategori Adı (Örn: İç Mekan)" />
                <button type="button" class="button prestige-remove-cat" style="color:#a00;">&times; Kategoriyi Sil</button>
            </div>
            <ul class="prestige-cat-gallery-list">
                <?php foreach ($ids_array as $item_id):
                    if (empty($item_id)) continue;
                    $mime = get_post_mime_type($item_id);
                    $is_video = strpos($mime, 'video') !== false;
                    $img_url = wp_get_attachment_image_url($item_id, 'thumbnail');
                ?>
                <li data-id="<?php echo esc_attr($item_id); ?>">
                    <?php if ($is_video): ?>
                        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:#222;color:#fff;">
                            <span class="dashicons dashicons-video-alt3" style="font-size:36px;width:36px;height:36px;"></span>
                        </div>
                    <?php elseif ($img_url): ?>
                        <img src="<?php echo esc_url($img_url); ?>" />
                    <?php else: ?>
                        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:#eee;">
                            <span class="dashicons dashicons-media-document" style="font-size:36px;width:36px;height:36px;"></span>
                        </div>
                    <?php endif; ?>
                    <a href="#" class="prestige-cat-remove-img">&times;</a>
                </li>
                <?php endforeach; ?>
            </ul>
            <input type="hidden" class="prestige-cat-ids" name="prestige_gallery_cats[<?php echo $idx; ?>][ids]"
                   value="<?php echo esc_attr($cat_ids); ?>" />
            <button type="button" class="button button-primary prestige-add-cat-images">Görsel / Video Ekle</button>
        </div>
        <?php endforeach; ?>
    </div>

    <button type="button" class="button button-primary button-large" id="prestige-add-category">+ Yeni Kategori Ekle</button>

    <script>
    jQuery(document).ready(function($) {

        /* ---- Helper: render a single thumbnail <li> ---- */
        function renderThumb(id, type, thumbUrl) {
            var html = '<li data-id="' + id + '">';
            if (type === 'video') {
                html += '<div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:#222;color:#fff;"><span class="dashicons dashicons-video-alt3" style="font-size:36px;width:36px;height:36px;"></span></div>';
            } else {
                html += '<img src="' + thumbUrl + '" />';
            }
            html += '<a href="#" class="prestige-cat-remove-img">&times;</a></li>';
            return html;
        }

        /* ---- Helper: update hidden IDs field for a category ---- */
        function updateCatIds($cat) {
            var ids = [];
            $cat.find('.prestige-cat-gallery-list li').each(function() {
                ids.push($(this).data('id'));
            });
            $cat.find('.prestige-cat-ids').val(ids.join(','));
        }

        /* ---- Helper: reindex all categories ---- */
        function reindexCategories() {
            $('#prestige-gallery-categories .prestige-gallery-cat').each(function(idx) {
                $(this).attr('data-index', idx);
                $(this).find('input, select, textarea').each(function() {
                    var n = $(this).attr('name');
                    if (n) $(this).attr('name', n.replace(/\[\d+\]/, '[' + idx + ']'));
                });
            });
        }

        /* ---- Add new category block ---- */
        $('#prestige-add-category').on('click', function() {
            var idx = $('#prestige-gallery-categories .prestige-gallery-cat').length;
            var block = '<div class="prestige-gallery-cat" data-index="' + idx + '">' +
                '<div class="cat-header">' +
                '<input type="text" name="prestige_gallery_cats[' + idx + '][name]" value="" placeholder="Kategori Adı (Örn: İç Mekan)" />' +
                '<button type="button" class="button prestige-remove-cat" style="color:#a00;">&times; Kategoriyi Sil</button>' +
                '</div>' +
                '<ul class="prestige-cat-gallery-list"></ul>' +
                '<input type="hidden" class="prestige-cat-ids" name="prestige_gallery_cats[' + idx + '][ids]" value="" />' +
                '<button type="button" class="button button-primary prestige-add-cat-images">Görsel / Video Ekle</button>' +
                '</div>';
            $('#prestige-gallery-categories').append(block);

            // Init sortable on the new list
            var $newList = $('#prestige-gallery-categories .prestige-gallery-cat').last().find('.prestige-cat-gallery-list');
            if ($.fn.sortable) {
                $newList.sortable({ update: function() { updateCatIds($newList.closest('.prestige-gallery-cat')); } });
            }
        });

        /* ---- Remove category ---- */
        $(document).on('click', '.prestige-remove-cat', function() {
            if (!confirm('Bu kategoriyi ve içindeki tüm görselleri silmek istediğinize emin misiniz?')) return;
            $(this).closest('.prestige-gallery-cat').remove();
            reindexCategories();
        });

        /* ---- Add images to a specific category ---- */
        $(document).on('click', '.prestige-add-cat-images', function(e) {
            e.preventDefault();
            var $cat = $(this).closest('.prestige-gallery-cat');
            var $list = $cat.find('.prestige-cat-gallery-list');

            var frame = wp.media({
                title: 'Görselleri Seç',
                button: { text: 'Galeriye Ekle' },
                library: { type: ['image', 'video'] },
                multiple: 'add'
            });

            frame.on('select', function() {
                var selection = frame.state().get('selection');
                selection.map(function(attachment) {
                    attachment = attachment.toJSON();
                    // Don't add duplicates
                    if ($list.find('li[data-id="' + attachment.id + '"]').length > 0) return;
                    var thumb = (attachment.sizes && attachment.sizes.thumbnail) ? attachment.sizes.thumbnail.url : attachment.url;
                    $list.append(renderThumb(attachment.id, attachment.type, thumb));
                });
                updateCatIds($cat);
            });

            frame.open();
        });

        /* ---- Remove single image ---- */
        $(document).on('click', '.prestige-cat-remove-img', function(e) {
            e.preventDefault();
            var $cat = $(this).closest('.prestige-gallery-cat');
            $(this).closest('li').remove();
            updateCatIds($cat);
        });

        /* ---- Init sortable on existing lists ---- */
        if ($.fn.sortable) {
            $('.prestige-cat-gallery-list').each(function() {
                var $cat = $(this).closest('.prestige-gallery-cat');
                $(this).sortable({ update: function() { updateCatIds($cat); } });
            });
        }
    });
    </script>
    <?php
}

/**
 * Save Categorized Gallery Meta
 */
function prestige_save_gallery_meta($post_id)
{
    if (!isset($_POST['prestige_gallery_nonce']) || !wp_verify_nonce($_POST['prestige_gallery_nonce'], 'prestige_save_gallery')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $categories = array();
    $all_ids = array();

    if (isset($_POST['prestige_gallery_cats']) && is_array($_POST['prestige_gallery_cats'])) {
        foreach ($_POST['prestige_gallery_cats'] as $cat) {
            $name = sanitize_text_field($cat['name']);
            $ids  = sanitize_text_field($cat['ids']);
            if (!empty($name) || !empty($ids)) {
                $categories[] = array('name' => $name, 'ids' => $ids);
                if (!empty($ids)) {
                    $all_ids = array_merge($all_ids, explode(',', $ids));
                }
            }
        }
    }

    update_post_meta($post_id, '_prestige_gallery_categories', $categories);
    // Backward compat: save combined IDs to legacy field
    update_post_meta($post_id, '_prestige_project_gallery', implode(',', array_unique(array_filter($all_ids))));
}
add_action('save_post', 'prestige_save_gallery_meta');

/**
 * Enqueue Media for Admin
 */
function prestige_admin_gallery_scripts($hook)
{
    if ('post.php' != $hook && 'post-new.php' != $hook) {
        return;
    }
    wp_enqueue_media();
}
add_action('admin_enqueue_scripts', 'prestige_admin_gallery_scripts');

/**
 * Contact Form: Custom Post Type & Handler
 */
function prestige_register_contact_cpt()
{
    register_post_type('iletisim_formu', array(
        'labels' => array(
            'name' => 'İletişim Formları',
            'singular_name' => 'İletişim Formu',
            'menu_name' => 'İletişim Formları',
            'all_items' => 'Tüm Mesajlar',
            'view_item' => 'Mesajı Görüntüle',
            'search_items' => 'Mesaj Ara',
            'not_found' => 'Mesaj bulunamadı',
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-email-alt',
        'menu_position' => 26,
        'supports' => array(''),
        'capability_type' => 'post',
        'capabilities' => array(
            'create_posts' => 'do_not_allow',
        ),
        'map_meta_cap' => true,
    ));
}
add_action('init', 'prestige_register_contact_cpt');

// Handle form submission
function prestige_handle_contact_form()
{
    if (!isset($_POST['prestige_contact_submit'])) return;
    if (!wp_verify_nonce($_POST['prestige_contact_nonce'] ?? '', 'prestige_contact_form')) return;

    $first_name = sanitize_text_field($_POST['contact_first_name'] ?? '');
    $last_name = sanitize_text_field($_POST['contact_last_name'] ?? '');
    $email = sanitize_email($_POST['contact_email'] ?? '');
    $phone = sanitize_text_field($_POST['contact_phone'] ?? '');
    $project_type = sanitize_text_field($_POST['contact_project_type'] ?? '');
    $budget = sanitize_text_field($_POST['contact_budget'] ?? '');
    $message = sanitize_textarea_field($_POST['contact_message'] ?? '');

    $post_id = wp_insert_post(array(
        'post_type' => 'iletisim_formu',
        'post_title' => $first_name . ' ' . $last_name . ' - ' . date('d.m.Y H:i'),
        'post_status' => 'publish',
    ));

    if ($post_id && !is_wp_error($post_id)) {
        update_post_meta($post_id, '_contact_first_name', $first_name);
        update_post_meta($post_id, '_contact_last_name', $last_name);
        update_post_meta($post_id, '_contact_email', $email);
        update_post_meta($post_id, '_contact_phone', $phone);
        update_post_meta($post_id, '_contact_project_type', $project_type);
        update_post_meta($post_id, '_contact_budget', $budget);
        update_post_meta($post_id, '_contact_message', $message);
        update_post_meta($post_id, '_contact_read', '0');

        // Redirect with success
        wp_redirect(add_query_arg('contact_sent', '1', wp_get_referer() ?: home_url()));
        exit;
    }
}
add_action('init', 'prestige_handle_contact_form');

// Admin columns
function prestige_contact_columns($columns)
{
    return array(
        'cb' => '<input type="checkbox" />',
        'title' => 'Gönderen',
        'contact_email' => 'E-posta',
        'contact_phone' => 'Telefon',
        'contact_type' => 'Proje Tipi',
        'contact_read' => 'Durum',
        'date' => 'Tarih',
    );
}
add_filter('manage_iletisim_formu_posts_columns', 'prestige_contact_columns');

function prestige_contact_column_data($column, $post_id)
{
    $type_labels = array(
        'residential' => 'Konut',
        'commercial' => 'Ticari',
        'interior' => 'İç Tasarım',
        'renovation' => 'Renovasyon',
    );
    switch ($column) {
        case 'contact_email':
            echo esc_html(get_post_meta($post_id, '_contact_email', true));
            break;
        case 'contact_phone':
            echo esc_html(get_post_meta($post_id, '_contact_phone', true));
            break;
        case 'contact_type':
            $t = get_post_meta($post_id, '_contact_project_type', true);
            echo esc_html($type_labels[$t] ?? $t);
            break;
        case 'contact_read':
            $read = get_post_meta($post_id, '_contact_read', true);
            echo $read === '0' ? '<span style="color:#c6a85a;font-weight:700;">● Yeni</span>' : '<span style="color:#888;">Okundu</span>';
            break;
    }
}
add_action('manage_iletisim_formu_posts_custom_column', 'prestige_contact_column_data', 10, 2);

// Custom detail view for submissions
function prestige_contact_meta_box()
{
    add_meta_box('contact_details', 'Mesaj Detayları', 'prestige_render_contact_details', 'iletisim_formu', 'normal', 'high');
}
add_action('add_meta_boxes', 'prestige_contact_meta_box');

function prestige_render_contact_details($post)
{
    // Mark as read
    update_post_meta($post->ID, '_contact_read', '1');

    $fields = array(
        'Ad' => get_post_meta($post->ID, '_contact_first_name', true),
        'Soyad' => get_post_meta($post->ID, '_contact_last_name', true),
        'E-posta' => get_post_meta($post->ID, '_contact_email', true),
        'Telefon' => get_post_meta($post->ID, '_contact_phone', true),
        'Proje Tipi' => get_post_meta($post->ID, '_contact_project_type', true),
        'Bütçe' => get_post_meta($post->ID, '_contact_budget', true),
    );
    $message = get_post_meta($post->ID, '_contact_message', true);

    $type_labels = array('residential' => 'Konut Mimarisi', 'commercial' => 'Ticari Geliştirme', 'interior' => 'İç Tasarım', 'renovation' => 'Renovasyon');
    $budget_labels = array('tier1' => '₺500K - ₺1M', 'tier2' => '₺1M - ₺5M', 'tier3' => '₺5M - ₺10M', 'tier4' => '₺10M+');

    echo '<table class="form-table" style="margin-top:0;">';
    foreach ($fields as $label => $val) {
        if ($label === 'Proje Tipi') $val = $type_labels[$val] ?? $val;
        if ($label === 'Bütçe') $val = $budget_labels[$val] ?? $val;
        if ($label === 'E-posta' && $val) $val = '<a href="mailto:' . esc_attr($val) . '">' . esc_html($val) . '</a>';
        elseif ($label === 'Telefon' && $val) $val = '<a href="tel:' . esc_attr($val) . '">' . esc_html($val) . '</a>';
        else $val = esc_html($val);
        echo '<tr><th style="width:120px;padding:12px 10px;color:#333;font-weight:600;">' . esc_html($label) . '</th><td style="padding:12px 10px;">' . ($val ?: '—') . '</td></tr>';
    }
    echo '</table>';
    echo '<h4 style="margin:20px 0 8px;font-weight:600;">Mesaj</h4>';
    echo '<div style="background:#f9f9f9;padding:16px 20px;border-radius:8px;border:1px solid #e0e0e0;line-height:1.7;white-space:pre-wrap;">' . esc_html($message) . '</div>';
}

// Unread count badge
function prestige_contact_unread_badge()
{
    $count = wp_count_posts('iletisim_formu');
    if (!$count) return;
    global $menu;
    $unread = get_posts(array('post_type' => 'iletisim_formu', 'post_status' => 'publish', 'meta_key' => '_contact_read', 'meta_value' => '0', 'fields' => 'ids'));
    $unread_count = count($unread);
    if ($unread_count > 0) {
        foreach ($menu as $key => $item) {
            if (isset($item[2]) && $item[2] === 'edit.php?post_type=iletisim_formu') {
                $menu[$key][0] .= ' <span class="awaiting-mod count-' . $unread_count . '"><span class="pending-count">' . $unread_count . '</span></span>';
                break;
            }
        }
    }
}
add_action('admin_menu', 'prestige_contact_unread_badge', 999);

/**
 * Remove WordPress branding everywhere
 */

// Remove WP generator meta tag from <head>
remove_action('wp_head', 'wp_generator');

// Remove WP logo from admin bar
function prestige_remove_wp_logo_admin_bar($wp_admin_bar)
{
    $wp_admin_bar->remove_node('wp-logo');
}
add_action('admin_bar_menu', 'prestige_remove_wp_logo_admin_bar', 999);

// Custom login page logo
function prestige_custom_login_logo()
{
    $logo = get_option('prestige_header_logo');
    ?>
    <style>
        #login h1 a,
        .login h1 a {
            <?php if ($logo): ?>
            background-image: url('<?php echo esc_url($logo); ?>');
            background-size: contain;
            width: 280px;
            height: 80px;
            <?php else: ?>
            background-image: none;
            <?php endif; ?>
            background-repeat: no-repeat;
            background-position: center;
        }
        .login {
            background: #0b1120 !important;
        }
        .login form {
            background: #131b2e !important;
            border: 1px solid rgba(255,255,255,0.05) !important;
            border-radius: 12px !important;
        }
        .login label, .login .message, .login .success {
            color: #ccc !important;
        }
        .login input[type="text"],
        .login input[type="password"] {
            background: #0b1120 !important;
            border-color: rgba(255,255,255,0.1) !important;
            color: #fff !important;
        }
        .login .button-primary {
            background: #c6a85a !important;
            border-color: #c6a85a !important;
            color: #0b1120 !important;
            font-weight: 700 !important;
        }
        .login .button-primary:hover {
            background: #e8d5a0 !important;
        }
        .login #backtoblog a,
        .login #nav a {
            color: rgba(255,255,255,0.4) !important;
        }
        .login #backtoblog a:hover,
        .login #nav a:hover {
            color: #c6a85a !important;
        }
    </style>
    <?php
}
add_action('login_enqueue_scripts', 'prestige_custom_login_logo');

// Change login logo URL to homepage
function prestige_login_logo_url()
{
    return home_url('/');
}
add_filter('login_headerurl', 'prestige_login_logo_url');

// Change login logo title
function prestige_login_logo_title()
{
    return get_bloginfo('name');
}
add_filter('login_headertext', 'prestige_login_logo_title');

// Custom admin footer text
function prestige_admin_footer_text()
{
    return '<span style="color:#888;">Capital Yaşam İnşaat — Yönetim Paneli</span>';
}
add_filter('admin_footer_text', 'prestige_admin_footer_text');

// Remove WordPress version from admin footer
function prestige_remove_wp_version_footer()
{
    return '';
}
add_filter('update_footer', 'prestige_remove_wp_version_footer', 999);

// Remove WP emoji scripts
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');

// Hide admin bar on frontend
add_filter('show_admin_bar', '__return_false');

/**
 * Custom Admin Dashboard — Remove WP widgets, add Capital Yaşam branding
 */
function prestige_remove_dashboard_widgets()
{
    // Remove all default WordPress dashboard widgets
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal');       // At a Glance
    remove_meta_box('dashboard_activity', 'dashboard', 'normal');        // Activity
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');       // Quick Draft
    remove_meta_box('dashboard_primary', 'dashboard', 'side');           // WordPress Events and News
    remove_meta_box('dashboard_site_health', 'dashboard', 'normal');     // Site Health
    remove_action('welcome_panel', 'wp_welcome_panel');                  // Welcome Panel

    // Add custom Capital Yaşam widget
    wp_add_dashboard_widget(
        'prestige_dashboard_widget',
        'Capital Yaşam İnşaat — Yönetim Paneli',
        'prestige_dashboard_widget_content'
    );
}
add_action('wp_dashboard_setup', 'prestige_remove_dashboard_widgets');

// Hide WP-related menus from admin
function prestige_remove_admin_menus()
{
    remove_menu_page('plugins.php');                             // Eklentiler
    remove_submenu_page('index.php', 'update-core.php');         // Güncellemeler
    remove_menu_page('tools.php');                               // Araçlar
    remove_menu_page('edit-comments.php');                       // Yorumlar
    remove_menu_page('themes.php');                              // Görünüm (tamamen kaldır)

    // Menüler'i bağımsız üst menü olarak ekle
    add_menu_page(
        'Menüler',
        'Menüler',
        'edit_theme_options',
        'nav-menus.php',
        '',
        'dashicons-menu',
        61
    );
}
add_action('admin_menu', 'prestige_remove_admin_menus', 999);

function prestige_dashboard_widget_content()
{
    $logo = get_option('prestige_header_logo');
    $total_projects = wp_count_posts();
    $published = $total_projects->publish ?? 0;
    $unread_messages = count(get_posts(array(
        'post_type' => 'iletisim_formu',
        'post_status' => 'publish',
        'meta_key' => '_contact_read',
        'meta_value' => '0',
        'fields' => 'ids',
    )));
    ?>
    <div style="text-align:center; padding:20px 10px;">
        <?php if ($logo): ?>
            <img src="<?php echo esc_url($logo); ?>" alt="Capital Yaşam" style="max-height:80px; width:auto; margin-bottom:20px;" />
        <?php endif; ?>
        <p style="font-size:14px; color:#555; line-height:1.8; max-width:500px; margin:0 auto 24px;">
            Adana'nın önde gelen inşaat firması olarak prestijli yaşam alanları inşa ediyoruz.
            Bu panel üzerinden projelerinizi, iletişim formlarınızı ve site ayarlarınızı yönetebilirsiniz.
        </p>

        <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:16px; margin-bottom:24px;">
            <div style="background:#f9f7f2; padding:16px; border-radius:8px; text-align:center;">
                <div style="font-size:28px; font-weight:700; color:#c6a85a;"><?php echo $published; ?></div>
                <div style="font-size:11px; color:#888; text-transform:uppercase; letter-spacing:0.1em; margin-top:4px;">Proje</div>
            </div>
            <div style="background:#f9f7f2; padding:16px; border-radius:8px; text-align:center;">
                <div style="font-size:28px; font-weight:700; color:#c6a85a;"><?php echo $unread_messages; ?></div>
                <div style="font-size:11px; color:#888; text-transform:uppercase; letter-spacing:0.1em; margin-top:4px;">Yeni Mesaj</div>
            </div>
            <div style="background:#f9f7f2; padding:16px; border-radius:8px; text-align:center;">
                <div style="font-size:28px; font-weight:700; color:#c6a85a;">
                    <a href="<?php echo esc_url(home_url('/')); ?>" target="_blank" style="color:#c6a85a; text-decoration:none;">↗</a>
                </div>
                <div style="font-size:11px; color:#888; text-transform:uppercase; letter-spacing:0.1em; margin-top:4px;">Siteyi Gör</div>
            </div>
        </div>

        <div style="display:flex; flex-wrap:wrap; gap:10px; justify-content:center;">
            <a href="<?php echo admin_url('post-new.php'); ?>" style="display:inline-block; background:#c6a85a; color:#0b1120; padding:10px 20px; border-radius:6px; text-decoration:none; font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:0.05em;">
                + Yeni Proje Ekle
            </a>
            <a href="<?php echo admin_url('edit.php?post_type=iletisim_formu'); ?>" style="display:inline-block; background:#0b1120; color:#fff; padding:10px 20px; border-radius:6px; text-decoration:none; font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:0.05em;">
                📧 İletişim Formları
            </a>
            <a href="<?php echo admin_url('admin.php?page=prestige-settings'); ?>" style="display:inline-block; background:#f0f0f0; color:#333; padding:10px 20px; border-radius:6px; text-decoration:none; font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:0.05em;">
                ⚙ Site Ayarları
            </a>
        </div>
    </div>
    <?php
}

// Change dashboard page title
function prestige_admin_title($admin_title, $title)
{
    if ($title === 'Dashboard' || $title === 'Başlangıç') {
        return 'Capital Yaşam — Yönetim Paneli';
    }
    return $admin_title;
}
add_filter('admin_title', 'prestige_admin_title', 10, 2);

/**
 * SEO: Meta Description, Open Graph, Favicon
 */

// SEO Admin Settings Page
function prestige_seo_admin_page()
{
    add_submenu_page(
        'prestige-settings',
        'SEO & Favicon Ayarları',
        'SEO & Favicon',
        'manage_options',
        'prestige-seo-settings',
        'prestige_seo_settings_page'
    );
}
add_action('admin_menu', 'prestige_seo_admin_page');

// Enqueue media on SEO page
function prestige_seo_enqueue_media($hook)
{
    if (strpos($hook, 'prestige') !== false || strpos($hook, 'seo') !== false) {
        wp_enqueue_media();
    }
}
add_action('admin_enqueue_scripts', 'prestige_seo_enqueue_media');

function prestige_seo_settings_page()
{
    if (isset($_POST['prestige_seo_save']) && check_admin_referer('prestige_seo_nonce')) {
        update_option('prestige_meta_description', sanitize_textarea_field($_POST['prestige_meta_description'] ?? ''));
        update_option('prestige_meta_keywords', sanitize_text_field($_POST['prestige_meta_keywords'] ?? ''));
        update_option('prestige_og_image', esc_url_raw($_POST['prestige_og_image'] ?? ''));
        update_option('prestige_favicon', esc_url_raw($_POST['prestige_favicon'] ?? ''));
        echo '<div class="updated"><p>SEO ayarları kaydedildi.</p></div>';
    }

    $meta_desc = get_option('prestige_meta_description', 'Capital Yaşam İnşaat — 2021\'den bu yana Adana\'da prestijli rezidans ve villa projeleri. Sarıçam ve Çukurova\'da modern yaşam alanları inşa ediyoruz.');
    $meta_keys = get_option('prestige_meta_keywords', 'capital yaşam, adana inşaat, rezidans, villa, sarıçam, çukurova, sun city, prestijli konut');
    $og_image = get_option('prestige_og_image', '');
    $favicon = get_option('prestige_favicon', '');
    ?>
    <div class="wrap">
        <h1>SEO & Favicon Ayarları</h1>
        <form method="post">
            <?php wp_nonce_field('prestige_seo_nonce'); ?>
            <table class="form-table">
                <tr>
                    <th><label for="prestige_meta_description">Meta Açıklama (Description)</label></th>
                    <td>
                        <textarea id="prestige_meta_description" name="prestige_meta_description" rows="3" class="large-text"><?php echo esc_textarea($meta_desc); ?></textarea>
                        <p class="description">Google'da sitenizin altında görünen açıklama metni. 155-160 karakter ideal.</p>
                    </td>
                </tr>
                <tr>
                    <th><label for="prestige_meta_keywords">Anahtar Kelimeler</label></th>
                    <td>
                        <input type="text" id="prestige_meta_keywords" name="prestige_meta_keywords" value="<?php echo esc_attr($meta_keys); ?>" class="large-text" />
                        <p class="description">Virgülle ayrılmış anahtar kelimeler.</p>
                    </td>
                </tr>
                <tr>
                    <th><label for="prestige_og_image">Paylaşım Görseli (OG Image)</label></th>
                    <td>
                        <?php if ($og_image): ?>
                            <img id="prestige_og_image_preview" src="<?php echo esc_url($og_image); ?>" style="max-width:300px;height:auto;display:block;margin-bottom:10px;border-radius:8px;" />
                        <?php endif; ?>
                        <input type="text" id="prestige_og_image" name="prestige_og_image" value="<?php echo esc_attr($og_image); ?>" class="large-text" />
                        <button type="button" class="button" onclick="selectMedia('prestige_og_image')">Görsel Seç</button>
                        <p class="description">Sosyal medyada paylaşıldığında görünen görsel. 1200x630px önerilir.</p>
                    </td>
                </tr>
                <tr>
                    <th><label for="prestige_favicon">Favicon (Site İkonu)</label></th>
                    <td>
                        <?php if ($favicon): ?>
                            <img id="prestige_favicon_preview" src="<?php echo esc_url($favicon); ?>" style="max-width:64px;height:auto;display:block;margin-bottom:10px;" />
                        <?php endif; ?>
                        <input type="text" id="prestige_favicon" name="prestige_favicon" value="<?php echo esc_attr($favicon); ?>" class="large-text" />
                        <button type="button" class="button" onclick="selectMedia('prestige_favicon')">İkon Seç</button>
                        <p class="description">Tarayıcı sekmesinde ve Google'da görünen küçük ikon. 512x512px PNG önerilir.</p>
                    </td>
                </tr>
            </table>
            <p class="submit">
                <input type="submit" name="prestige_seo_save" class="button-primary" value="Kaydet" />
            </p>
        </form>
        <script>
        function selectMedia(inputId) {
            var frame = wp.media({
                title: 'Görsel Seç',
                button: { text: 'Bu Görseli Kullan' },
                multiple: false
            });
            frame.on('select', function() {
                var attachment = frame.state().get('selection').first().toJSON();
                document.getElementById(inputId).value = attachment.url;
                // Update preview if exists
                var preview = document.getElementById(inputId + '_preview');
                if (preview) {
                    preview.src = attachment.url;
                    preview.style.display = 'block';
                } else {
                    // Create preview
                    var img = document.createElement('img');
                    img.id = inputId + '_preview';
                    img.src = attachment.url;
                    img.style.cssText = 'max-width:200px;height:auto;display:block;margin-top:10px;border-radius:4px;border:1px solid #ccc;';
                    document.getElementById(inputId).parentNode.appendChild(img);
                }
            });
            frame.open();
        }
        </script>
    </div>
    <?php
}

// Output SEO meta tags in <head>
function prestige_seo_meta_tags()
{
    $default_desc = "Adana inşaat firmaları arasında öncü olan Capital Yaşam İnşaat, Adana villa ve rezidans projeleri ile prestijli yaşam alanları sunar. Adana inşaat sektöründe güvenilir çözüm ortağınız.";
    $default_keys = "adana inşaat firmaları, adana villa, adana rezidans, adana inşaat, adanadaki inşaat firmaları, mersin inşaat, inşaat firması, gayrimenkul projeleri";

    $desc = get_option('prestige_meta_description', $default_desc);
    $keys = get_option('prestige_meta_keywords', $default_keys);

    // Dynamic Description for Single Posts/Pages
    if (is_singular()) {
        global $post;
        if (!empty($post->post_excerpt)) {
            $desc = wp_strip_all_tags($post->post_excerpt);
        } else {
            $desc = wp_trim_words(wp_strip_all_tags($post->post_content), 30);
        }
    }

    $og_image = get_option('prestige_og_image', '');
    $favicon = get_option('prestige_favicon', '');
    $site_name = get_bloginfo('name');
    $site_url = home_url('/');

    // Meta description
    if ($desc) {
        echo '<meta name="description" content="' . esc_attr($desc) . '">' . "\n";
    }
    // Meta keywords
    if ($keys) {
        echo '<meta name="keywords" content="' . esc_attr($keys) . '">' . "\n";
    }

    // Open Graph tags
    echo '<meta property="og:type" content="website">' . "\n";
    echo '<meta property="og:site_name" content="' . esc_attr($site_name) . '">' . "\n";
    echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '">' . "\n";
    if ($desc) {
        echo '<meta property="og:description" content="' . esc_attr($desc) . '">' . "\n";
    }

    // Dynamic OG Image
    $current_og_image = $og_image;
    if (is_singular() && has_post_thumbnail()) {
        $current_og_image = get_the_post_thumbnail_url(get_the_ID(), 'large');
    }

    if ($current_og_image) {
        echo '<meta property="og:image" content="' . esc_url($current_og_image) . '">' . "\n";
        echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
        echo '<meta name="twitter:image" content="' . esc_url($current_og_image) . '">' . "\n";
    }

    // Favicon
    if ($favicon) {
        echo '<link rel="icon" type="image/png" href="' . esc_url($favicon) . '">' . "\n";
        echo '<link rel="apple-touch-icon" href="' . esc_url($favicon) . '">' . "\n";
    }
}
add_action('wp_head', 'prestige_seo_meta_tags', 1);

// Custom title tag
function prestige_custom_title($title)
{
    if (is_front_page()) {
        return get_bloginfo('name') . ' — Prestijli Yaşam Alanları | Adana İnşaat';
    }
    return $title;
}
add_filter('pre_get_document_title', 'prestige_custom_title');

/**
 * End functions.php
 */

