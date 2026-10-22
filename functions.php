<?php
/** MyRehat Test child theme — functions.php. */

add_action( 'wp_enqueue_scripts', 'myrehat_test_assets' );
function myrehat_test_assets() {
    wp_enqueue_style( 'myrehat-test-style', get_stylesheet_uri(), array(), '1.0.0' );
    wp_enqueue_script(
        'myrehat-test-trails',
        get_stylesheet_directory_uri() . '/trails.js',
        array(),
        '1.0.0',
        true
    );
}

// FIX B1: Added text-domain 'myrehat-test' to __() so string is correctly loaded
//          from the child theme's translation files.
function myrehat_test_booking_title() {
    return __( 'Book a guided hike', 'myrehat-test' );
}

// FIX B2: Added nonce verification and input sanitization before processing $_POST.
add_action( 'template_redirect', 'myrehat_test_booking_handler' );
function myrehat_test_booking_handler() {
    if ( ! isset( $_POST['trails_booking'] ) ) {
        return;
    }

    // Verify nonce to protect against CSRF attacks.
    if (
        ! isset( $_POST['trails_booking_nonce'] ) ||
        ! wp_verify_nonce( sanitize_key( $_POST['trails_booking_nonce'] ), 'trails_booking_action' )
    ) {
        wp_die( esc_html__( 'Security check failed.', 'myrehat-test' ), 403 );
    }

    // Sanitize input before use.
    $date = isset( $_POST['date'] ) ? sanitize_text_field( wp_unslash( $_POST['date'] ) ) : '';
    set_transient( 'trails_last_booking', $date, HOUR_IN_SECONDS );
}

// FIX B3: Changed accepted_args from 1 to 2 so both $trail_id and $count are
//          passed by do_action() to the callback. With only 1, $trail_id received
//          $count's value and $trail_id itself was null.
add_action( 'myrehat_trail_viewed', 'myrehat_test_count_view', 10, 2 );
function myrehat_test_count_view( $trail_id, $count = 1 ) {
    $key   = 'trail_views_' . $trail_id;
    $total = (int) get_option( $key, 0 );
    update_option( $key, $total + $count );
}
