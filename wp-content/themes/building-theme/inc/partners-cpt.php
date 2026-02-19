<?php
/**
 * Partner Custom Post Type and Taxonomy Registration
 */

if (!defined('ABSPATH')) {
    exit;
}

function prestige_register_partners_cpt()
{
    // 1. Register Taxonomy: Partner Kategorileri
    $taxonomy_labels = array(
        'name' => 'Partner Kategorileri',
        'singular_name' => 'Kategori',
        'search_items' => 'Kategori Ara',
        'all_items' => 'Tüm Kategoriler',
        'parent_item' => 'Üst Kategori',
        'parent_item_colon' => 'Üst Kategori:',
        'edit_item' => 'Kategoriyi Düzenle',
        'update_item' => 'Kategoriyi Güncelle',
        'add_new_item' => 'Yeni Kategori Ekle',
        'new_item_name' => 'Yeni Kategori Adı',
        'menu_name' => 'Kategoriler',
    );

    register_taxonomy('partner_cat', array('partner'), array(
        'hierarchical' => true,
        'labels' => $taxonomy_labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'partner-kategori'),
        'show_in_rest' => true,
    ));

    // 2. Register Custom Post Type: Partnerler
    $cpt_labels = array(
        'name' => 'Partnerler',
        'singular_name' => 'Partner',
        'menu_name' => 'Partnerler',
        'name_admin_bar' => 'Partner',
        'add_new' => 'Yeni Ekle',
        'add_new_item' => 'Yeni Partner Ekle',
        'new_item' => 'Yeni Partner',
        'edit_item' => 'Partneri Düzenle',
        'view_item' => 'Partneri Görüntüle',
        'all_items' => 'Tüm Partnerler',
        'search_items' => 'Partner Ara',
        'parent_item_colon' => 'Üst Partner:',
        'not_found' => 'Partner bulunamadı.',
        'not_found_in_trash' => 'Çöpte partner bulunamadı.',
    );

    $cpt_args = array(
        'labels' => $cpt_labels,
        'public' => true,
        'publicly_queryable' => false,
        'show_ui' => true,
        'show_in_menu' => 'prestige-settings', // Show under Site Ayarları
        'query_var' => true,
        'rewrite' => array('slug' => 'partner'),
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'thumbnail'), // Only Title and Featured Image (Logo)
        'show_in_rest' => true,
    );

    register_post_type('partner', $cpt_args);
}
add_action('init', 'prestige_register_partners_cpt');
