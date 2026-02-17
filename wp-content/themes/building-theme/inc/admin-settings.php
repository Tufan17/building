<?php
/**
 * Custom Admin Settings for Building Theme
 *
 * Menü Yapısı:
 *   Site Ayarları (top-level)
 *     ├── Anasayfa Ayarları  (Hero, Marka İfadesi, Butonlar)
 *     └── Prestij Ayarları   (Metrikler repeater, Standartlar repeater)
 *
 * @package Building_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

/* ======================================================================
   DEFAULTS
   ====================================================================== */

function prestige_get_default($field_id)
{
    $defaults = array(
        'prestige_hero_bg_type' => 'image',
        'prestige_hero_media' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuA5jTlARCDX4H4MlnZAdTV50vSESvBAlIwo4MCAqFwrAPxM5itmLXTnJAOe4SoQBtc83uFNDPSxXBxQV9Dc6lM9eA4pRL3F2s6Yeo8TXLf6NkRag3s_4RgeFYsjTG2MshhpIoZs1e-fDTM83nACr6cpzi9yIxH5BQo4w7xb4oVb5k8Inj4l1kbbP4A_24g8n8qOx4gQfsG1R1IjspJIOU87VygjaFFnuQndWZXg7EvG6zBLMEs58pLdbclrAGFDk-oxw-0ajiIOFNpN',
        'prestige_hero_subtitle' => 'Est. 1998 • Global Development',
        'prestige_hero_title' => 'Architectural <br /> <span class="italic text-primary/90">Excellence</span> Defined',
        'prestige_hero_desc' => 'Crafting bespoke residential environments for the world\'s most discerning clients. Where vision meets uncompromising precision.',
        'prestige_hero_buttons' => array(
            array('text' => 'View Portfolio', 'link' => '#projects', 'type' => 'primary'),
            array('text' => 'Our Process', 'link' => '#contact', 'type' => 'secondary'),
        ),
        'prestige_brand_quote' => '"We do not just build structures; <br /> <span class="text-primary italic">we curate legacies.</span>"',
        'prestige_brand_signature' => '',
        'prestige_metrics' => array(
            array('value' => '25', 'label' => 'Years of Legacy'),
            array('value' => '500k+', 'label' => 'Sq Ft Developed'),
            array('value' => '$1B+', 'label' => 'Portfolio Value'),
        ),
        'prestige_standards' => array(
            array('icon' => 'architecture', 'title' => 'Uncompromising Craftsmanship', 'desc' => 'We collaborate with the world\'s finest artisans. Every joint, finish, and material is selected with obsessive attention to detail.'),
            array('icon' => 'precision_manufacturing', 'title' => 'Precision Engineering', 'desc' => 'Utilizing state-of-the-art construction technologies to ensure structural integrity that withstands the test of time and elements.'),
            array('icon' => 'hourglass_empty', 'title' => 'Timeless Design', 'desc' => 'We don\'t follow trends. We create spaces that remain aesthetically relevant and emotionally resonant for generations.'),
        ),
    );

    return isset($defaults[$field_id]) ? $defaults[$field_id] : '';
}

/* ======================================================================
   ADMIN MENU
   ====================================================================== */

function prestige_admin_menu()
{
    add_menu_page(
        __('Site Ayarları', 'building-theme'),
        __('Site Ayarları', 'building-theme'),
        'manage_options',
        'prestige-settings',
        'prestige_homepage_page',
        'dashicons-admin-generic',
        60
    );

    add_submenu_page(
        'prestige-settings',
        __('Anasayfa Ayarları', 'building-theme'),
        __('Anasayfa Ayarları', 'building-theme'),
        'manage_options',
        'prestige-settings',
        'prestige_homepage_page'
    );

    add_submenu_page(
        'prestige-settings',
        __('Prestij Ayarları', 'building-theme'),
        __('Prestij Ayarları', 'building-theme'),
        'manage_options',
        'prestige-prestij-settings',
        'prestige_prestij_page'
    );
}
add_action('admin_menu', 'prestige_admin_menu');

/* ======================================================================
   PAGE 1: ANASAYFA AYARLARI
   ====================================================================== */

function prestige_homepage_page()
{
    ?>
    <div class="wrap">
        <h1><?php _e('Anasayfa Ayarları', 'building-theme'); ?></h1>
        <p style="color:#666;"><?php _e('Hero bölümü, marka ifadesi ve butonları buradan yönetin.', 'building-theme'); ?></p>
        <form method="post" action="options.php">
            <?php
            settings_fields('prestige_homepage_group');
            do_settings_sections('prestige-homepage-settings');
            submit_button('Değişiklikleri Kaydet');
            ?>
        </form>
    </div>
    <?php
}

/* ======================================================================
   PAGE 2: PRESTİJ AYARLARI (Metrik + Standart Repeater)
   ====================================================================== */

function prestige_prestij_page()
{
    ?>
    <div class="wrap">
        <h1><?php _e('Prestij Ayarları', 'building-theme'); ?></h1>
        <p style="color:#666;"><?php _e('Metrik sayaçları ve prestij standartlarını buradan yönetin. İstediğiniz kadar ekleyebilir veya silebilirsiniz.', 'building-theme'); ?></p>
        <form method="post" action="options.php">
            <?php
            settings_fields('prestige_prestij_group');
            ?>

            <!-- METRICS REPEATER -->
            <h2 style="margin-top:30px;padding-bottom:8px;border-bottom:1px solid #ccc;">
                <?php _e('Prestij Metrikleri (Sayaçlar)', 'building-theme'); ?>
            </h2>
            <p class="description"><?php _e('Anasayfada görüntülenen performans göstergeleri. İstediğiniz kadar ekleyebilirsiniz.', 'building-theme'); ?></p>

            <?php
            $metrics = get_option('prestige_metrics');
            if (!$metrics || !is_array($metrics)) {
                $metrics = prestige_get_default('prestige_metrics');
            }
            ?>
            <table class="widefat" style="margin-top:15px;" id="prestige-metrics-table">
                <thead>
                    <tr>
                        <th style="width:30%;"><?php _e('Değer', 'building-theme'); ?></th>
                        <th style="width:50%;"><?php _e('Etiket', 'building-theme'); ?></th>
                        <th style="width:20%;"><?php _e('İşlem', 'building-theme'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($metrics as $i => $m): ?>
                        <tr>
                            <td><input type="text" name="prestige_metrics[<?php echo $i; ?>][value]" value="<?php echo esc_attr($m['value']); ?>" class="regular-text" style="width:100%;" placeholder="Örn: 25" /></td>
                            <td><input type="text" name="prestige_metrics[<?php echo $i; ?>][label]" value="<?php echo esc_attr($m['label']); ?>" class="regular-text" style="width:100%;" placeholder="Örn: Years of Legacy" /></td>
                            <td><button type="button" class="button prestige-remove-row" style="color:#a00;">&times; Sil</button></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button type="button" class="button button-primary" id="prestige-add-metric" style="margin-top:10px;">+ Yeni Metrik Ekle</button>

            <!-- STANDARDS REPEATER -->
            <h2 style="margin-top:40px;padding-bottom:8px;border-bottom:1px solid #ccc;">
                <?php _e('Prestij Standartları', 'building-theme'); ?>
            </h2>
            <p class="description"><?php _e('Anasayfadaki "Prestij Standartları" kartları. İkon adları için Google Material Icons kullanılmaktadır. İstediğiniz kadar ekleyebilirsiniz.', 'building-theme'); ?></p>

            <?php
            $standards = get_option('prestige_standards');
            if (!$standards || !is_array($standards)) {
                $standards = prestige_get_default('prestige_standards');
            }
            ?>
            <div id="prestige-standards-list" style="margin-top:15px;">
                <?php foreach ($standards as $i => $std): ?>
                    <div class="prestige-standard-card" style="background:#f9f9f9;border:1px solid #ddd;padding:15px 20px;margin-bottom:12px;border-radius:4px;">
                        <div style="display:flex;gap:12px;align-items:center;flex-wrap:wrap;">
                            <label style="font-weight:600;min-width:40px;">İkon:</label>
                            <input type="text" name="prestige_standards[<?php echo $i; ?>][icon]" value="<?php echo esc_attr($std['icon']); ?>" style="width:180px;" placeholder="Örn: architecture" />
                            <label style="font-weight:600;min-width:50px;">Başlık:</label>
                            <input type="text" name="prestige_standards[<?php echo $i; ?>][title]" value="<?php echo esc_attr($std['title']); ?>" class="regular-text" style="flex:1;min-width:200px;" />
                            <button type="button" class="button prestige-remove-standard" style="color:#a00;">&times; Sil</button>
                        </div>
                        <div style="margin-top:10px;">
                            <label style="font-weight:600;display:block;margin-bottom:5px;">Açıklama:</label>
                            <textarea name="prestige_standards[<?php echo $i; ?>][desc]" rows="2" class="large-text"><?php echo esc_textarea($std['desc']); ?></textarea>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <button type="button" class="button button-primary" id="prestige-add-standard" style="margin-top:10px;">+ Yeni Standart Ekle</button>

            <?php submit_button('Değişiklikleri Kaydet'); ?>
        </form>
    </div>
    <?php
}

/* ======================================================================
   REGISTER SETTINGS
   ====================================================================== */

function prestige_register_settings()
{
    // --- Homepage group ---
    register_setting('prestige_homepage_group', 'prestige_hero_bg_type');
    register_setting('prestige_homepage_group', 'prestige_hero_media');
    register_setting('prestige_homepage_group', 'prestige_hero_subtitle');
    register_setting('prestige_homepage_group', 'prestige_hero_title');
    register_setting('prestige_homepage_group', 'prestige_hero_desc');
    register_setting('prestige_homepage_group', 'prestige_hero_buttons', array(
        'type' => 'array',
        'sanitize_callback' => 'prestige_sanitize_buttons',
    ));
    register_setting('prestige_homepage_group', 'prestige_brand_quote');
    register_setting('prestige_homepage_group', 'prestige_brand_signature');

    // Hero section
    add_settings_section('prestige_hero_section', __('Hero Bölümü Ayarları', 'building-theme'), function () {
        echo '<p>' . __('Anasayfanın ana Hero (giriş) bölümünü buradan özelleştirin.', 'building-theme') . '</p>';
    }, 'prestige-homepage-settings');

    add_settings_field('prestige_hero_bg_type', __('Arkaplan Tipi', 'building-theme'), 'prestige_render_select_field', 'prestige-homepage-settings', 'prestige_hero_section', array(
        'label_for' => 'prestige_hero_bg_type',
        'options' => array('image' => 'Resim', 'video' => 'Video'),
    ));
    add_settings_field('prestige_hero_media', __('Hero Medya (Resim/Video URL)', 'building-theme'), 'prestige_render_media_field', 'prestige-homepage-settings', 'prestige_hero_section', array('label_for' => 'prestige_hero_media'));
    add_settings_field('prestige_hero_subtitle', __('Hero Alt Başlık', 'building-theme'), 'prestige_render_text_field', 'prestige-homepage-settings', 'prestige_hero_section', array('label_for' => 'prestige_hero_subtitle'));
    add_settings_field('prestige_hero_title', __('Hero Başlığı (Satır sonu için &lt;br/&gt; kullanabilirsiniz)', 'building-theme'), 'prestige_render_textarea_field', 'prestige-homepage-settings', 'prestige_hero_section', array('label_for' => 'prestige_hero_title'));
    add_settings_field('prestige_hero_desc', __('Hero Açıklaması', 'building-theme'), 'prestige_render_textarea_field', 'prestige-homepage-settings', 'prestige_hero_section', array('label_for' => 'prestige_hero_desc'));
    add_settings_field('prestige_hero_buttons', __('Hero Butonları', 'building-theme'), 'prestige_render_buttons_repeater', 'prestige-homepage-settings', 'prestige_hero_section');

    // Brand section
    add_settings_section('prestige_brand_section', __('Marka İfadesi Ayarları', 'building-theme'), function () {
        echo '<p>' . __('"Marka İfadesi" (Alıntı ve İmza) bölümünü buradan özelleştirin.', 'building-theme') . '</p>';
    }, 'prestige-homepage-settings');

    add_settings_field('prestige_brand_quote', __('Marka Sözü (Alıntı)', 'building-theme'), 'prestige_render_textarea_field', 'prestige-homepage-settings', 'prestige_brand_section', array('label_for' => 'prestige_brand_quote'));
    add_settings_field('prestige_brand_signature', __('İmza Resmi', 'building-theme'), 'prestige_render_media_field', 'prestige-homepage-settings', 'prestige_brand_section', array('label_for' => 'prestige_brand_signature'));

    // --- Prestij group (metrics + standards as arrays) ---
    register_setting('prestige_prestij_group', 'prestige_metrics', array(
        'type' => 'array',
        'sanitize_callback' => 'prestige_sanitize_metrics',
    ));
    register_setting('prestige_prestij_group', 'prestige_standards', array(
        'type' => 'array',
        'sanitize_callback' => 'prestige_sanitize_standards',
    ));
}
add_action('admin_init', 'prestige_register_settings');

/* ======================================================================
   SANITIZE CALLBACKS
   ====================================================================== */

function prestige_sanitize_buttons($input)
{
    $sanitized = array();
    if (is_array($input)) {
        foreach ($input as $btn) {
            if (!empty($btn['text'])) {
                $sanitized[] = array(
                    'text' => sanitize_text_field($btn['text']),
                    'link' => esc_url_raw($btn['link']),
                    'type' => in_array($btn['type'], array('primary', 'secondary')) ? $btn['type'] : 'primary',
                );
            }
        }
    }
    return $sanitized;
}

function prestige_sanitize_metrics($input)
{
    $sanitized = array();
    if (is_array($input)) {
        foreach ($input as $m) {
            if (!empty($m['value']) || !empty($m['label'])) {
                $sanitized[] = array(
                    'value' => sanitize_text_field($m['value']),
                    'label' => sanitize_text_field($m['label']),
                );
            }
        }
    }
    return $sanitized;
}

function prestige_sanitize_standards($input)
{
    $sanitized = array();
    if (is_array($input)) {
        foreach ($input as $std) {
            if (!empty($std['title'])) {
                $sanitized[] = array(
                    'icon' => sanitize_text_field($std['icon']),
                    'title' => sanitize_text_field($std['title']),
                    'desc' => sanitize_textarea_field($std['desc']),
                );
            }
        }
    }
    return $sanitized;
}

/* ======================================================================
   FIELD RENDERERS
   ====================================================================== */

function prestige_render_text_field($args)
{
    $value = get_option($args['label_for']);
    if (!$value) {
        $value = prestige_get_default($args['label_for']);
    }
    echo '<input type="text" class="regular-text" name="' . esc_attr($args['label_for']) . '" value="' . esc_attr($value) . '">';
}

function prestige_render_textarea_field($args)
{
    $value = get_option($args['label_for']);
    if (!$value) {
        $value = prestige_get_default($args['label_for']);
    }
    echo '<textarea class="large-text" rows="3" name="' . esc_attr($args['label_for']) . '">' . esc_textarea($value) . '</textarea>';
}

function prestige_render_select_field($args)
{
    $value = get_option($args['label_for']);
    if (!$value) {
        $value = prestige_get_default($args['label_for']);
    }
    echo '<select name="' . esc_attr($args['label_for']) . '">';
    foreach ($args['options'] as $key => $label) {
        echo '<option value="' . esc_attr($key) . '" ' . selected($value, $key, false) . '>' . esc_html($label) . '</option>';
    }
    echo '</select>';
}

function prestige_render_media_field($args)
{
    $value = get_option($args['label_for']);
    if (!$value) {
        $value = prestige_get_default($args['label_for']);
    }
    ?>
    <div class="prestige-media-uploader">
        <input type="text" class="regular-text prestige-media-url" name="<?php echo esc_attr($args['label_for']); ?>" value="<?php echo esc_attr($value); ?>">
        <button type="button" class="button prestige-media-button"><?php _e('Dosya Seç / Yükle', 'building-theme'); ?></button>
        <p class="description"><?php _e('Resim veya video URL\'sini buraya ekleyin veya yükleyin.', 'building-theme'); ?></p>
    </div>
    <?php
}

function prestige_render_buttons_repeater()
{
    $buttons = get_option('prestige_hero_buttons');
    if (!$buttons || !is_array($buttons)) {
        $buttons = prestige_get_default('prestige_hero_buttons');
    }
    ?>
    <div id="prestige-buttons-repeater">
        <div id="prestige-buttons-list">
            <?php foreach ($buttons as $i => $btn): ?>
                <div class="prestige-button-row" style="background:#f9f9f9;border:1px solid #ddd;padding:12px 15px;margin-bottom:10px;border-radius:4px;display:flex;gap:10px;align-items:center;flex-wrap:wrap;">
                    <label style="font-weight:600;min-width:60px;">Metin:</label>
                    <input type="text" name="prestige_hero_buttons[<?php echo $i; ?>][text]" value="<?php echo esc_attr($btn['text']); ?>" class="regular-text" style="flex:1;min-width:150px;" />
                    <label style="font-weight:600;min-width:40px;">Link:</label>
                    <input type="text" name="prestige_hero_buttons[<?php echo $i; ?>][link]" value="<?php echo esc_attr($btn['link']); ?>" class="regular-text" style="flex:1;min-width:150px;" />
                    <label style="font-weight:600;min-width:30px;">Tip:</label>
                    <select name="prestige_hero_buttons[<?php echo $i; ?>][type]" style="min-width:100px;">
                        <option value="primary" <?php selected($btn['type'], 'primary'); ?>>Birincil (Dolu)</option>
                        <option value="secondary" <?php selected($btn['type'], 'secondary'); ?>>İkincil (Çerçeveli)</option>
                    </select>
                    <button type="button" class="button prestige-remove-btn" style="color:#a00;">&times; Sil</button>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="button" class="button button-primary" id="prestige-add-btn" style="margin-top:8px;">+ Yeni Buton Ekle</button>
        <p class="description" style="margin-top:8px;">Her buton için metin, link ve tip belirleyebilirsiniz.</p>
    </div>
    <?php
}

/* ======================================================================
   ADMIN SCRIPTS
   ====================================================================== */

function prestige_admin_scripts($hook)
{
    if (strpos($hook, 'prestige') === false) {
        return;
    }
    wp_enqueue_media();
}
add_action('admin_enqueue_scripts', 'prestige_admin_scripts');

function prestige_admin_footer_scripts()
{
    $screen = get_current_screen();
    if (!$screen || strpos($screen->id, 'prestige') === false) {
        return;
    }
    ?>
    <script>
        jQuery(document).ready(function ($) {
            /* Media uploader */
            $(document).on('click', '.prestige-media-button', function (e) {
                e.preventDefault();
                var input = $(this).siblings('.prestige-media-url');
                wp.media({ title: 'Dosya Seç', button: { text: 'Dosyayı Kullan' }, multiple: false })
                    .on('select', function () { input.val(this.state().get('selection').first().toJSON().url); })
                    .open();
            });

            /* Generic reindex helper */
            function reindex(container, rowSel, namePrefix) {
                $(container).find(rowSel).each(function (idx) {
                    $(this).find('input, select, textarea').each(function () {
                        var n = $(this).attr('name');
                        if (n) $(this).attr('name', n.replace(/\[\d+\]/, '[' + idx + ']'));
                    });
                });
            }

            /* ---- Hero Buttons repeater ---- */
            $('#prestige-add-btn').on('click', function () {
                var idx = $('#prestige-buttons-list .prestige-button-row').length;
                var row = '<div class="prestige-button-row" style="background:#f9f9f9;border:1px solid #ddd;padding:12px 15px;margin-bottom:10px;border-radius:4px;display:flex;gap:10px;align-items:center;flex-wrap:wrap;">' +
                    '<label style="font-weight:600;min-width:60px;">Metin:</label><input type="text" name="prestige_hero_buttons[' + idx + '][text]" value="" class="regular-text" style="flex:1;min-width:150px;" />' +
                    '<label style="font-weight:600;min-width:40px;">Link:</label><input type="text" name="prestige_hero_buttons[' + idx + '][link]" value="#" class="regular-text" style="flex:1;min-width:150px;" />' +
                    '<label style="font-weight:600;min-width:30px;">Tip:</label><select name="prestige_hero_buttons[' + idx + '][type]" style="min-width:100px;"><option value="primary">Birincil (Dolu)</option><option value="secondary">İkincil (Çerçeveli)</option></select>' +
                    '<button type="button" class="button prestige-remove-btn" style="color:#a00;">&times; Sil</button></div>';
                $('#prestige-buttons-list').append(row);
            });
            $(document).on('click', '.prestige-remove-btn', function () {
                $(this).closest('.prestige-button-row').remove();
                reindex('#prestige-buttons-list', '.prestige-button-row', 'prestige_hero_buttons');
            });

            /* ---- Metrics repeater ---- */
            $('#prestige-add-metric').on('click', function () {
                var idx = $('#prestige-metrics-table tbody tr').length;
                var row = '<tr>' +
                    '<td><input type="text" name="prestige_metrics[' + idx + '][value]" value="" class="regular-text" style="width:100%;" placeholder="Örn: 25" /></td>' +
                    '<td><input type="text" name="prestige_metrics[' + idx + '][label]" value="" class="regular-text" style="width:100%;" placeholder="Örn: Years of Legacy" /></td>' +
                    '<td><button type="button" class="button prestige-remove-row" style="color:#a00;">&times; Sil</button></td></tr>';
                $('#prestige-metrics-table tbody').append(row);
            });
            $(document).on('click', '.prestige-remove-row', function () {
                $(this).closest('tr').remove();
                reindex('#prestige-metrics-table tbody', 'tr', 'prestige_metrics');
            });

            /* ---- Standards repeater ---- */
            $('#prestige-add-standard').on('click', function () {
                var idx = $('#prestige-standards-list .prestige-standard-card').length;
                var card = '<div class="prestige-standard-card" style="background:#f9f9f9;border:1px solid #ddd;padding:15px 20px;margin-bottom:12px;border-radius:4px;">' +
                    '<div style="display:flex;gap:12px;align-items:center;flex-wrap:wrap;">' +
                    '<label style="font-weight:600;min-width:40px;">İkon:</label><input type="text" name="prestige_standards[' + idx + '][icon]" value="" style="width:180px;" placeholder="Örn: architecture" />' +
                    '<label style="font-weight:600;min-width:50px;">Başlık:</label><input type="text" name="prestige_standards[' + idx + '][title]" value="" class="regular-text" style="flex:1;min-width:200px;" />' +
                    '<button type="button" class="button prestige-remove-standard" style="color:#a00;">&times; Sil</button></div>' +
                    '<div style="margin-top:10px;"><label style="font-weight:600;display:block;margin-bottom:5px;">Açıklama:</label>' +
                    '<textarea name="prestige_standards[' + idx + '][desc]" rows="2" class="large-text"></textarea></div></div>';
                $('#prestige-standards-list').append(card);
            });
            $(document).on('click', '.prestige-remove-standard', function () {
                $(this).closest('.prestige-standard-card').remove();
                reindex('#prestige-standards-list', '.prestige-standard-card', 'prestige_standards');
            });
        });
    </script>
    <?php
}
add_action('admin_footer', 'prestige_admin_footer_scripts');
