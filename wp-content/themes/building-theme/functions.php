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
 * End functions.php
 */
