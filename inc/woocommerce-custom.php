<?php



/**********************PRODUCT PAGE CUSTOM*********** */

add_filter( 'woocommerce_get_price_html', function( $price, $product ) 

{ 

    global $woocommerce_loop;



    // check if we are in single product page, in main section, and if product has price and is on sale

    if ( is_product() && !isset( $woocommerce_loop ) && $product->get_price() && $product->is_on_sale() ) {



        // collect prices from $price html string

        $prices = array_map( function( $item ) {        

            return array( $item, (float) preg_replace( "/[^0-9.]/", "", html_entity_decode( $item, ENT_QUOTES, 'UTF-8' ) ) );           

        }, explode( ' ', strip_tags( $price ) ) );



        $price = isset( $prices[0][0] ) ? '<span class="orig-price">Original Price: ' . $prices[0][0] . '</span>' : '';

        $price .= isset( $prices[1][0] ) ? '<span class="sale-price">Sale Price: ' . $prices[1][0] . '</span>' : '';



        if ( $product->get_regular_price() ) {

            // set saved amount with currency symbol placed as defined in options

            $price .= '<span class="saved">You saved: ' . sprintf( get_woocommerce_price_format(), get_woocommerce_currency_symbol(), $prices[0][1] - $prices[1][1] ) . '</span>';      

        }

    }



    return $price;



}, 10, 2 );







//* Personalización de la página de producto de WooCommerce

add_action( 'after_setup_theme', 'martin_custom_ficha_producto_woocommmerce' );



function martin_custom_ficha_producto_woocommmerce() {

    add_action( 'woocommerce_before_single_product_summary', 'bootstrap_breadcrumb', 9 );

	//remove_action( 'woocommerce_before_single_product', 'wc_print_notices', 10 );

 

	//remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

	//remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );

 

	//remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );

 

	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );

    add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 9 );

	//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );

	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

    add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 29 );

    add_action( 'woocommerce_single_product_summary', 'start_container_prince', 28 );

    add_action( 'woocommerce_single_product_summary', 'end_container_prince', 31 );

    add_action( 'woocommerce_single_product_summary', 'share_buttons', 32 );

    

	//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );

	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

	//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );

	//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

 

	//remove_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );

	//remove_action( 'woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30 );

	//remove_action( 'woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30 );

	//remove_action( 'woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30 );

	//remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation', 10 );

	//remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );

    add_action( 'woocommerce_after_single_product_summary', 'banner_despacho', 11 );

	//remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );

	//remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );

	//remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

 

	//remove_action( 'woocommerce_review_before', 'woocommerce_review_display_gravatar', 10 );

	//remove_action( 'woocommerce_review_before_comment_meta', 'woocommerce_review_display_rating', 10 );

	//remove_action( 'woocommerce_review_meta', 'woocommerce_review_display_meta', 10 );

	//remove_action( 'woocommerce_review_comment_text', 'woocommerce_review_display_comment_text', 10 );

    add_action( 'woocommerce_output_content_wrapper', 'bootstrap_breadcrumb', 9 );

    



}



function start_container_prince() {

    echo '<div class="align-items-start justify-content-start d-none d-md-flex" style="gap:3rem">';

}

function end_container_prince() {

    echo '</div>';

}

function share_buttons(){

    echo '<hr><div class="sharethis-inline-share-buttons"></div>';

}

function banner_despacho(){

    echo '<div class="container clearfix py-4" style="clear:both"><div class="row">

            

                    <div class="col-6 col-md-3 mb-4">

                        <div class="card text-center w-100 rounded-lg bg-color-background">

                            <div class="card-body" style="max-width:unset">

                                <i data-feather="package" class="text-green icon-before-summary mb-2"></i>

                                <p>Despacho a todo Chile vía Starken o Chilexpress</p>

                            </div>

                        </div>

                    </div>

                    <div class="col-6 col-md-3 mb-4">

                        <div class="card text-center w-100 rounded-lg bg-color-background">

                            <div class="card-body" style="max-width:unset">

                                <i data-feather="tag" class="text-green icon-before-summary mb-2"></i>

                                <p>Despacho gratis sobre $70.000 en RM</p>

                            </div>

                        </div>

                    </div>

                    <div class="col-6 col-md-3">

                        <div class="card text-center w-100 rounded-lg bg-color-background">

                            <div class="card-body" style="max-width:unset">

                                <i data-feather="shopping-bag" class="text-green icon-before-summary mb-2"></i>

                                <p>Compra online y retira en tienda física</p>

                            </div>

                        </div>

                    </div>

                    <div class="col-6 col-md-3">

                        <div class="card text-center w-100 rounded-lg bg-color-background">

                            <div class="card-body" style="max-width:unset">

                                <i data-feather="credit-card" class="text-green icon-before-summary mb-2"></i>

                                <p>Paga con tarjetas de débito y crédito</p>

                            </div>

                        </div>

                    </div>

    </div></div>';

}



function bootstrap_breadcrumb($custom_home_icon = false, $custom_post_types = false) {

	wp_reset_query();

	global $post;

	

	$is_custom_post = $custom_post_types ? is_singular( $custom_post_types ) : false;

	

    $term = get_the_terms( $post->ID, 'product_cat');

    //var_dump($term);

	if (!is_front_page() && !is_home()) {

		echo '<div class="row d-none d-md-block"><div class="col-12"><ul id="breadcrumb">';

		echo '<li><a href="';

		echo get_option('home');

		echo '">';

        echo '<i data-feather="home"></i>';

		echo "</a></li>";

        if(!empty($term)){

            $primary_category = $term[0];

            echo '<li class="active"><a href="'.esc_url( get_category_link($primary_category->term_id) ).'">';

			echo $primary_category->name;

			echo '</a></li>';

        }

		if ( has_category() ) {

			echo '<li class="active"><a href="'.esc_url( get_permalink( get_page( get_the_category($post->ID) ) ) ).'">';

			the_category(', ');

			echo '</a></li>';

		}

		if ( is_category() || is_single() || $is_custom_post ) {

			if ( is_category() )

				echo '<li class="active"><a href="'.esc_url( get_permalink( get_page( get_the_category($post->ID) ) ) ).'">'.get_the_category($post->ID)[0]->name.'</a></li>';

			if ( $is_custom_post ) {

				echo '<li class="active"><a href="'.get_option('home').'/'.get_post_type_object( get_post_type($post) )->name.'">'.get_post_type_object( get_post_type($post) )->label.'</a></li>';

				if ( $post->post_parent ) {

					$home = get_page(get_option('page_on_front'));

					for ($i = count($post->ancestors)-1; $i >= 0; $i--) {

						if (($home->ID) != ($post->ancestors[$i])) {

							echo '<li><a href="';

							echo get_permalink($post->ancestors[$i]); 

							echo '">';

							echo get_the_title($post->ancestors[$i]);

							echo "</a></li>";

						}

					}

				}

			}

			if ( is_single() )

				echo '<li class="active"><a>'.get_the_title($post->ID).'</a></li>';

		} elseif ( is_page() && $post->post_parent ) {

			$home = get_page(get_option('page_on_front'));

			for ($i = count($post->ancestors)-1; $i >= 0; $i--) {

				if (($home->ID) != ($post->ancestors[$i])) {

					echo '<li><a href="';

					echo get_permalink($post->ancestors[$i]); 

					echo '">';

					echo get_the_title($post->ancestors[$i]);

					echo "</a></li>";

				}

			}

			echo '<li class="active"><a>'.get_the_title($post->ID).'</a></li>';

		} elseif (is_page()) {

			echo '<li class="active"><a>'.get_the_title($post->ID).'</a></li>';

		} elseif (is_404()) {

			echo '<li class="active">404</li>';

		} elseif (term_exists($post->ID)) {

			echo '<li class="active">Categoria</li>';

		}

		echo '</ul></div></div>';

	}

}



add_action( 'woocommerce_before_shop_loop', 'bootstrap_breadcrumb', 9 );




//PRODUCTO CARD

// Elimina la acción actual asociada al hook woocommerce_template_loop_product_link_open
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );


// Agrega tu propia función personalizada al hook woocommerce_template_loop_product_link_open
add_action( 'woocommerce_before_shop_loop_item', 'inicio_card', 10 );
add_action( 'woocommerce_after_shop_loop_item', 'fin_card', 10 );
add_action( 'woocommerce_template_loop_product_thumbnail', 'between_card', 11 );

// Define tu función personalizada
function inicio_card() {
    global $product;

    echo '<div class="product-grid h-100 rounded-lg d-flex flex-column align-content-between justify-content-between mb-3"><div class="product-image"><a href="' . esc_url( get_permalink( $product->get_id() ) ) . '" class="image">';
}
function between_card(){
	echo '</a></div><div class="product-content">';
}
function fin_card() {
    global $product;

    echo '</div></a></div>';
}







?>