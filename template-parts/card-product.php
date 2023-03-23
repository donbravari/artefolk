<div class="<?php if(is_front_page() || is_search()){ ?>col-6 col-lg-3 col-md-3 px-2<?php }else{ ?>col-12 px-0<?php }; ?> mb-3" itemscope itemtype="https://schema.org/Product">
                        <div class="product-grid h-100 rounded-lg d-flex flex-column align-content-between justify-content-between">
                        <?php 
                                global $product;
                                $image_links = $product->get_gallery_image_ids();
                                ?>
                            <div class="product-image<?php if(!empty($image_links[0])): echo ' multi-images'; endif; ?>">
                                <a href="<?php echo get_permalink( $post->ID ); ?>" title="<?php the_title(); ?>" class="image">
                                
                                  <?php 
                                      if ( has_post_thumbnail( $post->ID ) ):
                                        echo get_the_post_thumbnail( $post->ID, array(265,330), array("class" => "img-fluid pic-1", "itemprop", "image") ); 
                                      else:
                                        echo '<img src="' . wc_placeholder_img_src() . '" class="img-fluid" width="265" height="330" alt="Placeholder"/>';
                                      endif;
                                  ?>
                                  <?php if(!empty($image_links[0])): if(wp_get_attachment_url($image_links[0])): ?>
                                  <img src="<?php echo wp_get_attachment_url($image_links[0]); ?>" class="img-fluid pic-2" width="100%" height="auto" alt="<?php the_title(); ?>"/>
                                  <?php endif; endif; ?>
                                </a>
                                <a href="<?php echo get_permalink( $post->ID ); ?>" class="product-full-view"><i class="fa fa-search"></i></a>
                                <a href="#" class="product-like-icon"><i class="fas fa-heart"></i></a>
                                <?php show_sale_percentage_loop(); ?>
                            </div>
                            <div class="product-content">
                              <h3 class="title"><a href="<?php echo get_permalink( $post->ID ); ?>" itemprop="name"><?php the_title(); ?></a></h3>
                              <div class="price" itemprop="offers" itemscope itemtype="https://schema.org/AggregateOffer"><?php 
                                            echo $product->get_price_html(); 
                                  ?> </div>
                              <?php
                            echo apply_filters(
                                'woocommerce_loop_add_to_cart_link',
                                sprintf(
                                    '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button %s add-cart mt-2">%s</a>',
                                    esc_url( $product->add_to_cart_url() ),
                                    esc_attr( $product->get_id() ),
                                    esc_attr( $product->get_sku() ),
                                    $product->is_purchasable() ? 'add_to_cart_button' : '',
                                    //esc_attr( $product->product_type ),
                                    esc_html( $product->add_to_cart_text() )
                                ),
                                $product
                            );?>
                              </div>
                            </div>
                        </div>