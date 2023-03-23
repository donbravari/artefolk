<?php

add_theme_support( 'title-tag' );

add_filter( 'wp_title', 'wpdocs_hack_wp_title_for_home' );

/**
 * Customize the title for the home page, if one is not set.
 *
 * @param string $title The original title.
 * @return string The title to use.
 */
function wpdocs_hack_wp_title_for_home( $title )
{
  if ( empty( $title ) && ( is_home() || is_front_page() ) ) {
    $title = __( 'Inicio', 'textdomain' ) . ' | ' . get_bloginfo( 'name' );
  }
  return $title;
}
remove_action('wp_head', '_wp_render_title_tag', 1);


function artefolk_scripts(){
    //incluir css
    wp_enqueue_style('artefolk-bootstrap', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css', array(), false, false );
    wp_enqueue_style('artefolk-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css', array(), false, false );
    wp_enqueue_style( 'woocommerce-custom', get_template_directory_uri() . '/assets/css/woocommerce-custom.css' );
    wp_enqueue_style('artefolk-style', get_stylesheet_directory_uri() . '/assets/css/custom-artefolk.css', array(), false, false );
    wp_enqueue_style('artefolk-owlcss', get_stylesheet_directory_uri() . '/assets/owlcarousel/assets/owl.carousel.min.css', array(), false, false );
    wp_enqueue_style('artefolk-stylecursos', get_stylesheet_directory_uri() . '/assets/css/cursos.css', array(), false, false );
    if(is_single() && 'post' == get_post_type()){
        wp_enqueue_style('artefolk-stylepost', get_stylesheet_directory_uri() . '/assets/css/single-post.css', array(), false, false );
    }
    
    //incluir js
    wp_enqueue_script( 'artefolk-jquery', get_template_directory_uri() . '/assets/js/jquery-3.6.0.min.js', array( 'jquery'), false, true);
    wp_enqueue_script( 'artefolk-bootstrapjs', get_template_directory_uri() . '/assets/js/bootstrap.js', array( 'jquery'), false, true);
    wp_enqueue_script( 'artefolk-bootstrapbundle', get_template_directory_uri() . '/assets/js/bootstrap.bundle.js', array( 'jquery'), false, true);
    wp_enqueue_script( 'artefolk-owljs', get_template_directory_uri() . '/assets/owlcarousel/owl.carousel.min.js', array( 'jquery'), false, true);
    wp_enqueue_script( 'artefolk-functions', get_template_directory_uri() . '/assets/js/custom-artefolk.js', array( 'jquery'), '1.0', true);

    wp_localize_script( 'artefolk-functions', 'wc_ajax_params', array(
        'url'    => admin_url( 'admin-ajax.php' ),
        'nonce'  => wp_create_nonce( 'my-ajax-nonce' ),
        'action' => 'event-list'
    ) );

    
    wp_enqueue_script( 'artefolk-feather-icons', 'https://unpkg.com/feather-icons', array(), false, true);
    wp_enqueue_script( 'artefolk-sharethis', 'https://platform-api.sharethis.com/js/sharethis.js#property=638c0a434c31970015656007&product=inline-share-buttons&source=platform', array(), false, true);
}
add_action( 'wp_enqueue_scripts', 'artefolk_scripts' );

/************menus*************/
function menu_artefolk() {
    register_nav_menus(
      array(
        'navegation' => __( 'Menú de navegación Principal' ),
        'menu_productos' => __( 'Menú de navegación Productos' ),
        'menu_mobile' => __( 'Menú de navegación Movile' ),
      )
    );
  }
  add_action( 'init', 'menu_artefolk' );

  function add_additional_class_on_li($classes, $item, $args) {
    if(isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);

add_filter( 'nav_menu_link_attributes', function($atts) {
    $atts['class'] = "nav-link";
    return $atts;
}, 100, 1 );


add_action( 'woocommerce_after_shop_loop_item_title', 'show_sale_percentage_loop', 25 );
function show_sale_percentage_loop() {
    global $product;
    if ( ! $product->is_on_sale() ) return;
    if ( $product->is_type( 'simple' ) ) {
        $max_percentage = ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100;
    } elseif ( $product->is_type( 'variable' ) ) {
        $max_percentage = 0;
        foreach ( $product->get_children() as $child_id ) {
            $variation = wc_get_product( $child_id );
            $price = $variation->get_regular_price();
            $sale = $variation->get_sale_price();
            if ( $price != 0 && ! empty( $sale ) ) $percentage = ( $price - $sale ) / $price * 100;
            if ( $percentage > $max_percentage ) {
                $max_percentage = $percentage;
            }
        }
    }
    if ( $max_percentage > 0 ) echo "<span class='product-discount-label'>" . round($max_percentage) . "% </span>";
}
/************fin menus*************/

/***********importacion****************/
$theme_includes = array (
	'custom-fields',
    'woocommerce-custom',
    'option-pages',
    'images-sizes',
);
foreach ( $theme_includes as $file ) {
    $filepath = locate_template( 'inc' . '/'.$file.'.php' );
    if ( ! $filepath )
      trigger_error( sprintf( 'Error: File%s.php not found in /inc/', $file ), E_USER_ERROR );
    require_once $filepath;
}

/**********excerpt****************/
function wpdocs_custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

function wpdocs_show_tags() {
    $post_tags = get_the_tags();
    $separator = ' | ';
    $output = '';

    if ( ! empty( $post_tags ) ) {
        foreach ( $post_tags as $tag ) {
            $output .= '<a href="' . esc_attr( get_tag_link( $tag->term_id ) ) . '">' . __( $tag->name ) . '</a>' . $separator;
        }
    }

    return trim( $output, $separator );
}

/********************OPTION PAGE***********************/


add_action("wp_ajax_search_products", "search_products");
add_action("wp_ajax_nopriv_search_products", "search_products");

function search_products() {
  $searchTerm = $_POST["term"];

  $productos = array();
  $args = array(
    "post_type" => "product",
    's' => $searchTerm,
    "posts_per_page" => 10,
    'meta_query' => array(
        array(
            'key' => '_stock_status',
            'value' => 'instock'
        ),
        array(
          'key'=>'_thumbnail_id',
          'compare' => 'EXISTS'
        )
      ),
      'meta_key' => '_sale_price',
      'meta_compare' => 'NOT EXISTS'
    );
    $loop = new WP_Query( $args );
    if ( $loop->have_posts() ):
    while ( $loop->have_posts() ) : $loop->the_post();
        global $product;
        $image_id = get_post_thumbnail_id( $product->id );

        array_push($productos,
            array(
                "nombre" => $product->name,
                "link" => get_permalink( $product->id ),
                "imagen" => wp_get_attachment_image_src( $image_id, 'thumbnail' )[0],

            )
        );
    endwhile;
    endif;
  // Aquí debes hacer una consulta a la base de datos o usar la API REST
  // de WooCommerce para encontrar los productos que coincidan con el
  // término de búsqueda
  // ...

  wp_send_json($productos);
}


if ( function_exists( 'add_image_size' ) ) {
    add_image_size( 'custom-thumb', 100, 100, true ); // 100 wide and 100 high
}

add_filter('woocommerce_checkout_fields', 'addBootstrapToCheckoutFields' );
function addBootstrapToCheckoutFields($fields) {
    foreach ($fields as &$fieldset) {
        foreach ($fieldset as &$field) {
            // if you want to add the form-group class around the label and the input
            $value_to_remove = 'form-row';
            $key = array_search($value_to_remove, $field['class']);
            if ($key !== false) {
                unset($field['class'][$key]);
            }

            $field['class'][] = 'form-group'; 

            // add form-control to the actual input
            $field['input_class'][] = 'form-control';
        }
    }
    return $fields;
}
add_filter( 'post_thumbnail_html', 'remove_thumbnail_width_height', 10, 5 );

function remove_thumbnail_width_height( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

/*function SearchFilter($query) {
    if ($query->is_search) {
        $query->set('post_type', 'post');
    }
    return $query;
}
add_filter('pre_get_posts','SearchFilter');*/


if ( ! function_exists( 'yith_pos_customization_disable_admin_new_order_emails' ) ) {
   add_filter( 'woocommerce_email_enabled_new_order', 'yith_pos_customization_disable_admin_new_order_emails', 10, 2 );
   function yith_pos_customization_disable_admin_new_order_emails( $enabled, $order ) {
      if ( $order instanceof WC_Order && function_exists( 'yith_pos_is_pos_order' ) && yith_pos_is_pos_order( $order ) ) {
         $enabled = false;
      }
      return $enabled;
   }
}

if ( ! function_exists( 'yith_pos_customization_disable_customer_emails' ) ) {
   add_filter( 'woocommerce_email_enabled_customer_completed_order', 'yith_pos_customization_disable_customer_emails', 10, 2 );
   add_filter( 'woocommerce_email_enabled_customer_processing_order', 'yith_pos_customization_disable_customer_emails', 10, 2 );
   function yith_pos_customization_disable_customer_emails( $enabled, $order ) {
      if ( $order instanceof WC_Order && function_exists( 'yith_pos_is_pos_order' ) && yith_pos_is_pos_order( $order ) ) {
         $enabled = false;
      }
      return $enabled;
   }
}


// Filtrar la consulta principal de búsqueda para incluir publicaciones y productos.
function my_search_filter( $query ) {
    if ( !is_admin() && $query->is_main_query() && $query->is_search() ) {
        $query->set( 'post_type', array( 'post', 'product' ) );
    }
}
add_action( 'pre_get_posts', 'my_search_filter' );

?>