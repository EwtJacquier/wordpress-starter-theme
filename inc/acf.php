<?php

define( 'ACF_JSON_FOLDER', get_stylesheet_directory() . '/acf-json' );

add_filter('acf/settings/save_json', 'acf_json_save_point');

function acf_json_save_point( $path ) {
    // update path
    $path = ACF_JSON_FOLDER;

    // return
    return $path;
}

add_filter('acf/settings/load_json', 'acf_json_load_point');

function acf_json_load_point( $paths ) {
    // remove original path (optional)
    unset($paths[0]);

    // append path
    $paths[] = ACF_JSON_FOLDER;

    // return
    return $paths;
}

function my_acf_op_init(){

    if( function_exists('acf_add_options_page') ) {
        acf_add_options_page(array(
            'page_title' 	=> 'Site Options',
            'menu_title'	=> 'Site Options',
            'menu_slug' 	=> 'theme-general-settings',
            'capability'	=> 'edit_posts',
            'redirect'		=> true
        ));

        acf_add_options_sub_page(array(
            'page_title' 	=> 'Header',
            'menu_title'	=> 'Header',
            'parent_slug'	=> 'theme-general-settings',
        ));

        acf_add_options_sub_page(array(
            'page_title' 	=> 'Footer',
            'menu_title'	=> 'Footer',
            'parent_slug'	=> 'theme-general-settings',
        ));

        acf_add_options_sub_page(array(
            'page_title' 	=> '404',
            'menu_title'	=> '404',
            'parent_slug'	=> 'theme-general-settings',
        ));

        acf_add_options_sub_page(array(
            'page_title' 	=> 'CTA',
            'menu_title'	=> 'CTA',
            'parent_slug'	=> 'theme-general-settings',
        ));

        acf_add_options_sub_page(array(
            'page_title' 	=> 'SMTP',
            'menu_title'	=> 'SMTP',
            'parent_slug'	=> 'theme-general-settings',
        ));

        /*
        acf_add_options_sub_page(array(
            'page_title' 	=> 'LGPD',
            'menu_title'	=> 'LGPD',
            'parent_slug'	=> 'theme-general-settings',
        ));
        */
    }
}

add_action('acf/init', 'my_acf_op_init');