<?php 

/**
 * gurux Admin menu position
 *
 * @return string
 */
function gurux_admin_menu_position() {
    return apply_filters( 'gurux_menu_position', '55.4' );
}

/**
 * gurux Admin menu capability
 *
 * @return string
 */
function guruxa_admin_menu_capability() {
    return apply_filters( 'gurux_menu_capability', 'manage_woocommerce' );
}

/**
 * gurux Get current user id
 *
 * @return int
 */
function gurux_get_current_user_id() {
    return get_current_user_id();
}

/**
 * Check if a user is seller
 *
 * @param int $user_id
 *
 * @return bool
 */
function gurux_is_user_seller( $user_id ) {
    if ( ! user_can( $user_id, 'guruxdar' ) ) {
        return false;
    }

    return true;
}

/**
 * Check if a user is customer
 *
 * @param int $user_id
 *
 * @return bool
 */
function gurux_is_user_customer( $user_id ) {
    if ( ! user_can( $user_id, 'customer' ) ) {
        return false;
    }

    return true;
}
