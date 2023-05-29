<?php

/**
 * Enqueue scripts and styles.
 */
function padrao_scripts() {
    wp_register_style( 'padrao-css-main', get_template_directory_uri() . '/assets/css/main.css', array(), _S_VERSION );
    wp_enqueue_style('padrao-css-main');

    wp_register_script( 'padrao-js-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), _S_VERSION, true );
    wp_enqueue_script('padrao-js-main');

    wp_localize_script('padrao-js-main', 'ajax_options', array(
        'url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('admin-nonce')
    ));
    
    if (is_page() || is_single() ){
        global $post;

        if (is_page()){
            $template_name = str_replace('.php', '', get_page_template_slug() );
        }
        else{
            $template_name = 'single-' . $post->post_type;
        }

        $css_file = '/assets/css/'.$template_name.'.css';
        $css_path = get_template_directory().$css_file;

        $js_file  = '/assets/js/'.$template_name.'.js';
        $js_path  = get_template_directory().$js_file;

        if (file_exists($css_path)){
            $enqueue_name = 'css_'.$template_name;

            wp_register_style( $enqueue_name, get_template_directory_uri().$css_file, array(), _S_VERSION );
            wp_enqueue_style( $enqueue_name );
        }

        if (file_exists($js_path)){
            $enqueue_name = 'js_'.$template_name;

            wp_register_script( $enqueue_name, get_template_directory_uri().$js_file, array('jquery'), _S_VERSION );
            wp_enqueue_script( $enqueue_name );
        }
    }
}
add_action( 'wp_enqueue_scripts', 'padrao_scripts' );

/**
 * Enqueue login custom style
 */
function padrao_login_logo() {

    $current_language = get_locale();

    ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'padrao_login_logo' );