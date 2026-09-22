<?php
/**
 * Expo Lead Theme functionality.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once get_template_directory() . '/settings/setting-product-inquiry.php';
require_once get_template_directory() . '/settings/email-notification.php';
require_once get_template_directory() . '/settings/ajax-product-inquiry.php';

function expo_lead_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'expo_lead_setup' );

function expo_lead_assets() {
    wp_enqueue_style( 'expo-lead-style', get_stylesheet_uri(), array(), '2.1.0' );
    wp_register_script( 'expo-lead-script', false, array(), '2.1.0', true );
    wp_enqueue_script( 'expo-lead-script' );
    wp_add_inline_script( 'expo-lead-script', 'window.expo_ajax = ' . wp_json_encode( array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) ) . ';', 'before' );
}
add_action( 'wp_enqueue_scripts', 'expo_lead_assets' );


function expo_lead_register_post_type() {
    register_post_type(
        'expo_lead',
        array(
            'labels' => array(
                'name' => 'Khách hàng tiềm năng',
                'singular_name' => 'Khách hàng tiềm năng',
                'menu_name' => 'Khách hàng tiềm năng',
                'add_new' => 'Thêm khách hàng',
                'add_new_item' => 'Thêm khách hàng',
                'edit_item' => 'Xem khách hàng',
                'all_items' => 'Tất cả khách hàng',
            ),
            'public' => false,
            'show_ui' => true,
            'menu_icon' => 'dashicons-id-alt',
            'supports' => array( 'title', 'editor' ),
        )
    );
}
add_action( 'init', 'expo_lead_register_post_type' );

function expo_lead_columns( $columns ) {
    return array(
        'cb' => $columns['cb'],
        'title' => 'Họ tên',
        'expo_lead_email' => 'Email',
        'expo_lead_phone' => 'Số điện thoại',
        'expo_lead_service' => 'Dịch vụ',
        'date' => 'Ngày gửi',
    );
}
add_filter( 'manage_expo_lead_posts_columns', 'expo_lead_columns' );

function expo_lead_column_content( $column, $post_id ) {
    $field_map = array(
        'expo_lead_email' => 'expo_lead_email',
        'expo_lead_phone' => 'expo_lead_phone',
        'expo_lead_service' => 'expo_lead_service',
    );
    if ( isset( $field_map[ $column ] ) ) {
        echo esc_html( get_post_meta( $post_id, $field_map[ $column ], true ) );
    }
}
add_action( 'manage_expo_lead_posts_custom_column', 'expo_lead_column_content', 10, 2 );

function expo_lead_handle_submission() {
    if ( ! isset( $_POST['expo_lead_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['expo_lead_nonce'] ) ), 'expo_lead_submit' ) ) {
        wp_safe_redirect( add_query_arg( 'expo_status', 'error', home_url( '/' ) ) . '#expo-contact' );
        exit;
    }

    if ( ! empty( $_POST['website'] ) ) {
        wp_safe_redirect( add_query_arg( 'expo_status', 'success', home_url( '/' ) ) . '#expo-contact' );
        exit;
    }

    $name = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
    $email = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
    $phone = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
    $service = isset( $_POST['service'] ) ? sanitize_text_field( wp_unslash( $_POST['service'] ) ) : '';
    $message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

    if ( empty( $name ) || ! is_email( $email ) || empty( $phone ) || empty( $service ) ) {
        wp_safe_redirect( add_query_arg( 'expo_status', 'invalid', home_url( '/' ) ) . '#expo-contact' );
        exit;
    }

    $lead_id = wp_insert_post(
        array(
            'post_type' => 'expo_lead',
            'post_status' => 'private',
            'post_title' => $name,
            'post_content' => $message,
        ),
        true
    );

    if ( is_wp_error( $lead_id ) ) {
        wp_safe_redirect( add_query_arg( 'expo_status', 'error', home_url( '/' ) ) . '#expo-contact' );
        exit;
    }

    $lead = array(
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'service' => $service,
        'message' => $message,
    );

    if ( function_exists( 'update_field' ) ) {
        update_field( 'expo_lead_email', $email, $lead_id );
        update_field( 'expo_lead_phone', $phone, $lead_id );
        update_field( 'expo_lead_service', $service, $lead_id );
        update_field( 'expo_lead_message', $message, $lead_id );
    } else {
        update_post_meta( $lead_id, 'expo_lead_email', $email );
        update_post_meta( $lead_id, 'expo_lead_phone', $phone );
        update_post_meta( $lead_id, 'expo_lead_service', $service );
        update_post_meta( $lead_id, 'expo_lead_message', $message );
    }

    expo_lead_send_notifications( $lead );

    wp_safe_redirect( add_query_arg( 'expo_status', 'success', home_url( '/' ) ) . '#expo-contact' );
    exit;
}
add_action( 'admin_post_nopriv_expo_lead_submit', 'expo_lead_handle_submission' );
add_action( 'admin_post_expo_lead_submit', 'expo_lead_handle_submission' );
