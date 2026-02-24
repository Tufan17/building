<?php
/**
 * Custom Post Type: Uygulamalarımız (Applications)
 */

function prestige_register_applications_cpt() {
    $labels = array(
        'name'                  => 'Uygulamalarımız',
        'singular_name'         => 'Uygulama',
        'menu_name'             => 'Uygulamalarımız',
        'name_admin_bar'        => 'Uygulama',
        'add_new'               => 'Yeni Ekle',
        'add_new_item'          => 'Yeni Uygulama Ekle',
        'new_item'              => 'Yeni Uygulama',
        'edit_item'             => 'Uygulamayı Düzenle',
        'view_item'             => 'Uygulamayı Görüntüle',
        'all_items'             => 'Tüm Uygulamalar',
        'search_items'          => 'Uygulama Ara',
        'not_found'             => 'Uygulama bulunamadı.',
        'not_found_in_trash'    => 'Çöpte uygulama bulunamadı.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'uygulamalarimiz'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 25,
        'menu_icon'          => 'dashicons-format-video',
        'supports'           => array('title', 'editor', 'thumbnail'),
        'show_in_rest'       => true,
    );

    register_post_type('uygulamalar', $args);
}
add_action('init', 'prestige_register_applications_cpt');

/**
 * Enqueue Media Library Scripts
 */
function prestige_application_admin_scripts($hook) {
    global $post_type;
    if ('uygulamalar' !== $post_type) return;
    wp_enqueue_media();
}
add_action('admin_enqueue_scripts', 'prestige_application_admin_scripts');

/**
 * Meta Box for Video URL with Media Library Support
 */
function prestige_add_application_meta_boxes() {
    add_meta_box(
        'application_video_meta',
        'Uygulama Video Bilgileri',
        'prestige_render_application_video_meta',
        'uygulamalar',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'prestige_add_application_meta_boxes');

function prestige_render_application_video_meta($post) {
    wp_nonce_field('prestige_save_application_video', 'application_video_nonce');
    $video_url = get_post_meta($post->ID, '_application_video_url', true);
    ?>
    <div style="padding: 10px 0;">
        <label for="application_video_url" style="display:block; margin-bottom: 8px; font-weight: 600;">Video veya Dosya Seç:</label>
        <div style="display:flex; gap: 10px; margin-bottom: 10px;">
            <input type="text" id="application_video_url" name="application_video_url" value="<?php echo esc_attr($video_url); ?>" style="flex:1; padding: 8px;" placeholder="https://example.com/video.mp4">
            <button type="button" id="prestige_upload_video_btn" class="button">Medyadan Seç</button>
        </div>
        <p class="description">Bilgisayarınızdan video yüklemek için "Medyadan Seç" butonuna basın. Veya YouTube/Vimeo linkini buraya yapıştırın.</p>
    </div>

    <script>
    jQuery(document).ready(function($) {
        $('#prestige_upload_video_btn').on('click', function(e) {
            e.preventDefault();
            var frame = wp.media({
                title: 'Video veya Medya Seç',
                button: { text: 'Uygulamaya Ekle' },
                library: { type: ['video', 'image'] },
                multiple: false
            });
            frame.on('select', function() {
                var attachment = frame.state().get('selection').first().toJSON();
                $('#application_video_url').val(attachment.url);
            });
            frame.open();
        });
    });
    </script>
    <?php
}

function prestige_save_application_video_meta($post_id) {
    if (!isset($_POST['application_video_nonce']) || !wp_verify_nonce($_POST['application_video_nonce'], 'prestige_save_application_video')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    if (isset($_POST['application_video_url'])) {
        update_post_meta($post_id, '_application_video_url', esc_url_raw($_POST['application_video_url']));
    }
}
add_action('save_post', 'prestige_save_application_video_meta');
