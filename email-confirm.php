<?php
/*
 * Plugin Name: Ninja Forms - Email Confirm
 * Plugin URI: http://kylebjohnson.me
 * Description: Adds an "Email Confirm" field for Ninja Forms.
 * Version: 3.0.0
 * Author: Kyle B. Johnson
 * Author URI: http://kylebjohnson.me
 *
 * Copyright 2017 Kyle B. Johnson.
 */

if( ! function_exists( 'NF_EmailConfirm' ) ) {
    function NF_EmailConfirm()
    {
        static $instance;
        if( ! isset( $instance ) ) {
            require_once plugin_dir_path(__FILE__) . 'includes/plugin.php';
            $instance = new NF_EmailConfirm_Plugin( '1.0.0', __FILE__ );
        }
        return $instance;
    }
}
NF_EmailConfirm();
