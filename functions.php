<?php remove_action('wp_head', 'wp_generator'); 

// Declaration of theme supported features
function simple_boostrap_theme_support() {
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption'
    ));
    add_theme_support('post-thumbnails');      // wp thumbnails (sizes handled in functions.php)
    set_post_thumbnail_size(125, 125, true);   // default thumb size
    add_theme_support('automatic-feed-links'); // rss thingy
    add_theme_support('custom-background', array(
        'default-color' => '#595959',
    ));
    add_theme_support( 'title-tag' );
    register_nav_menus(                      // wp3+ menus
        array( 
            'main_nav' => __('Main Menu', 'simple-bootstrap'),   // main nav in header
        )
    );
    add_image_size( 'simple_boostrap_featured', 1140, 1140 * (9 / 21), true);
    load_theme_textdomain( 'simple-bootstrap', get_template_directory() . '/languages' );
}
add_action('after_setup_theme','simple_boostrap_theme_support');

function simple_bootstrap_theme_scripts() { 
    // For child themes
    wp_register_style( 'wpbs-style', get_stylesheet_directory_uri() . '/style.css', array(), null, 'all' );
    wp_enqueue_style( 'wpbs-style' );
    wp_register_script( 'bower-libs', 
        get_template_directory_uri() . '/app.min.js', 
        array('jquery'), 
        null );
    wp_enqueue_script('bower-libs');
    
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'simple_bootstrap_theme_scripts' );

function simple_bootstrap_load_fonts() {
    wp_register_style('simple_bootstrap_googleFonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700');
    wp_enqueue_style('simple_bootstrap_googleFonts');
}

add_action('wp_print_styles', 'simple_bootstrap_load_fonts');

?>