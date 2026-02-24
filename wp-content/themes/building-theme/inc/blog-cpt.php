<?php
/**
 * Custom Post Type: Blog
 */

function prestige_register_blog_cpt() {
    $labels = array(
        'name'                  => 'Blog Yazıları',
        'singular_name'         => 'Blog',
        'menu_name'             => 'Blog İşlemleri',
        'name_admin_bar'        => 'Blog',
        'add_new'               => 'Yeni Blog Ekle',
        'add_new_item'          => 'Yeni Blog Yazısı Ekle',
        'new_item'              => 'Yeni Blog',
        'edit_item'             => 'Blog Yazısını Düzenle',
        'view_item'             => 'Blogu Görüntüle',
        'all_items'             => 'Tüm Bloglar',
        'search_items'          => 'Blog Ara',
        'not_found'             => 'Blog bulunamadı.',
        'not_found_in_trash'    => 'Çöpte blog bulunamadı.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'blog'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 26,
        'menu_icon'          => 'dashicons-edit-page',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest'       => true,
    );

    register_post_type('blog', $args);
}
add_action('init', 'prestige_register_blog_cpt');
