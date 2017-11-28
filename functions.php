<?php 

function themeslug_enqueue_style() {
    wp_enqueue_style( 'csmnormalize', get_template_directory_uri().'/assets/normalize.css', false ); //-- Normalize CSS
    wp_enqueue_style( 'csmcss', get_stylesheet_uri(), false ); //-- WP Style
    wp_enqueue_style( 'fontawesome-cdn','//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), '4.7.0' ); //-- Font Awesome
    wp_enqueue_style( 'latofont','//fonts.googleapis.com/css?family=lato', false ); //-- Google Font
}

function themeslug_enqueue_script() {
	wp_enqueue_script( 'my-js', 'filename.js', false );
}

add_action( 'wp_enqueue_scripts', 'themeslug_enqueue_style' );
add_action( 'wp_enqueue_scripts', 'themeslug_enqueue_script' );

add_theme_support( 'custom-logo', array(
        'height'      => 50,
        'width'       => 200,
        'flex-height' => false,
        'flex-width'  => false,
        'header-text' => array( 'site-title', 'site-description')
    ));

    function register_csm_menu() {
  register_nav_menus(
    array(
      'csm-menu' => __( 'Header Menu' ),

     )
   );
 }
 add_action( 'init', 'register_csm_menu' );

 # Image du Header personnalisable
$args = array (
    'width' => 1600,
    'height' => 359,
    'default-image' => get_template_directory_uri(). '/assets/img/bandeau-saint-marc.jpg', 
    'uploads' => true
);
add_theme_support( 'custom-header', $args );

register_default_headers( array(
    'bandeauDuHaut' => array(
        'url' => '%s/assets/img/bandeauDuHaut.jpg',
        'thumnail_url' =>'%s/assets/img/bandeauDuHaut.jpg',
        'description' => __('proposition 1', 'isen')

    ),
     'bandeauCsm' => array(
        'url' => '%s/assets/img/bandeau-saint-marc.jpg',
        'thumnail_url' => '%s/assets/img/bandeau-saint-marc.jpg',
        'description' => __('proposition 2', 'csm')

     ),
));

add_theme_support( 'custom-background' );

add_action( 'init', 'create_post_type' );
function create_post_type () {
    register_post_type('accueil-news', array(
        'labels' => array(
            'name' => __('Accueil News'),
            'singular_name' => __('Accueil News')
        ),
        'public' => true,
        'has_archive' => false
    ));
}

add_theme_support( 'post-thumbnails' );
add_post_type_support('accueil-news', 'thumbnail');
add_image_size( 'accueil-size', 500, 310, true );


add_action('widgets_init','csm_widgets_init');
function csm_widgets_init () {
    register_sidebar( array(
        'name' => 'Pied de page 1',
        'id' => 'csm-footer-1',
        'description' => 'Widget pour le placement de la map',
        'before_widget' => '<div id="%1$s"class="gmap %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
    register_sidebar( array(
        'name' => 'Pied de page 2',
        'id' => 'csm-footer-2',
        'description' => 'Widget pour le placement de la newsletter',
        'before_widget' => '<div id="%1$s"class="newsletter %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
    register_sidebar( array(
        'name' => 'Pied de page 3',
        'id' => 'csm-footer-3',
        'description' => 'Widget pour le placement des coordonnées.',
        'before_widget' => '<div id="%1$s"class="contact %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
};
?>

   