<footer class="footer-area footer--light">
  <div class="footer-big">
    <!-- start .container -->
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-12">
          <div class="footer-widget">
            <div class="widget-about">
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/marca-artefolk-blanca-footer.svg" alt="" class="img-fluid">
              
              <ul class="contact-details">
                <?php if(get_field('direccion', 'option')): ?>
                <li>
                  <p class="d-flex" style="gap:0.5rem"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg> <span><?php the_field('direccion', 'option'); ?></span></p>
                </li>
                <?php endif; ?>
                <?php
                        if( have_rows('telefonos', 'option') ):
                            while( have_rows('telefonos', 'option') ) : the_row();
                            if( have_rows('telefono', 'option') ):
                              while( have_rows('telefono', 'option') ) : the_row();
                                $numero = get_sub_field('numero_telefono');
                                $whatsapp = get_sub_field('whatsapp');
                ?>
                <li>
                <p class="d-flex" style="gap:0.5rem">
                  <?php if($whatsapp): ?>
                    <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" width="24px" height="24px"  fill="currentColor">    <path d="M 12.011719 2 C 6.5057187 2 2.0234844 6.478375 2.0214844 11.984375 C 2.0204844 13.744375 2.4814687 15.462563 3.3554688 16.976562 L 2 22 L 7.2324219 20.763672 C 8.6914219 21.559672 10.333859 21.977516 12.005859 21.978516 L 12.009766 21.978516 C 17.514766 21.978516 21.995047 17.499141 21.998047 11.994141 C 22.000047 9.3251406 20.962172 6.8157344 19.076172 4.9277344 C 17.190172 3.0407344 14.683719 2.001 12.011719 2 z M 12.009766 4 C 14.145766 4.001 16.153109 4.8337969 17.662109 6.3417969 C 19.171109 7.8517969 20.000047 9.8581875 19.998047 11.992188 C 19.996047 16.396187 16.413812 19.978516 12.007812 19.978516 C 10.674812 19.977516 9.3544062 19.642812 8.1914062 19.007812 L 7.5175781 18.640625 L 6.7734375 18.816406 L 4.8046875 19.28125 L 5.2851562 17.496094 L 5.5019531 16.695312 L 5.0878906 15.976562 C 4.3898906 14.768562 4.0204844 13.387375 4.0214844 11.984375 C 4.0234844 7.582375 7.6067656 4 12.009766 4 z M 8.4765625 7.375 C 8.3095625 7.375 8.0395469 7.4375 7.8105469 7.6875 C 7.5815469 7.9365 6.9355469 8.5395781 6.9355469 9.7675781 C 6.9355469 10.995578 7.8300781 12.182609 7.9550781 12.349609 C 8.0790781 12.515609 9.68175 15.115234 12.21875 16.115234 C 14.32675 16.946234 14.754891 16.782234 15.212891 16.740234 C 15.670891 16.699234 16.690438 16.137687 16.898438 15.554688 C 17.106437 14.971687 17.106922 14.470187 17.044922 14.367188 C 16.982922 14.263188 16.816406 14.201172 16.566406 14.076172 C 16.317406 13.951172 15.090328 13.348625 14.861328 13.265625 C 14.632328 13.182625 14.464828 13.140625 14.298828 13.390625 C 14.132828 13.640625 13.655766 14.201187 13.509766 14.367188 C 13.363766 14.534188 13.21875 14.556641 12.96875 14.431641 C 12.71875 14.305641 11.914938 14.041406 10.960938 13.191406 C 10.218937 12.530406 9.7182656 11.714844 9.5722656 11.464844 C 9.4272656 11.215844 9.5585938 11.079078 9.6835938 10.955078 C 9.7955938 10.843078 9.9316406 10.663578 10.056641 10.517578 C 10.180641 10.371578 10.223641 10.267562 10.306641 10.101562 C 10.389641 9.9355625 10.347156 9.7890625 10.285156 9.6640625 C 10.223156 9.5390625 9.737625 8.3065 9.515625 7.8125 C 9.328625 7.3975 9.131125 7.3878594 8.953125 7.3808594 C 8.808125 7.3748594 8.6425625 7.375 8.4765625 7.375 z"/></svg>
                    <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $numero); ?>"><?php echo $numero ?></a>
                  <?php else: ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                    <a href="tel:<?php echo $numero ?>"><?php echo $numero ?></a>
                  <?php endif; ?>
                  </p>
                </li>
                <?php
                  endwhile; endif;
                  endwhile;
                  endif;
                ?>
                <?php if(get_field('e-mail', 'option')): ?>
                <li>
                  <a href="mailto:<?php the_field('e-mail', 'option'); ?>" class="d-flex" style="gap:0.5rem"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg> <span><?php the_field('e-mail', 'option'); ?></span></a>
                </li>
                <?php endif; ?>

                


              </ul>
            </div>
          </div>
          <!-- Ends: .footer-widget -->
        </div>
        <!-- end /.col-md-4 -->
        <div class="col-md-3 col-sm-4">
          <div class="footer-widget">
            <div class="footer-menu footer-menu--1">
              <h4 class="footer-widget-title">Categorías</h4>
              <ul>
              <?php
                        if( have_rows('menu_productos', 'option') ):
                            while( have_rows('menu_productos', 'option') ) : the_row();
                            if( have_rows('menu_item_superior', 'option') ):
                                while( have_rows('menu_item_superior', 'option') ) : the_row();
                                
                                $menu_item_link = get_sub_field('menu_item_link');
                                $menu_item_titulo = get_term($menu_item_link)->name;
                                if(isset($menu_item_link) and !empty($menu_item_link)){
                                    $menu_link_categoria = get_term_link($menu_item_link);
                                }else{
                                    $menu_link_categoria = '#';
                                }
                        ?>
                            <li><a href="<?php echo $menu_link_categoria; ?>"><span data-hover="<?php echo $menu_item_titulo; ?>"><?php echo $menu_item_titulo; ?></span></a></li>
                        <?php
                            endwhile; endif;
                        endwhile;
                        endif;
                        ?>
              </ul>
            </div>
            <!-- end /.footer-menu -->
          </div>
          <!-- Ends: .footer-widget -->
        </div>
        <!-- end /.col-md-3 -->

        <div class="col-md-3 col-sm-4">
          <div class="footer-widget">
            <div class="footer-menu">
              <h4 class="footer-widget-title">Artefolk</h4>
              <ul>
              <?php
                        if( have_rows('menu_superior', 'option') ):
                            while( have_rows('menu_superior', 'option') ) : the_row();
                            if( have_rows('menu_item_superior', 'option') ):
                                while( have_rows('menu_item_superior', 'option') ) : the_row();
                                $menu_item_titulo = get_sub_field('menu_item_titulo');
                                $menu_item_link = get_sub_field('menu_item_link');
                                $menu_activo = get_sub_field('menu_activo');
                        ?>
                            <li <?php if($menu_activo): ?>class="active"<?php endif; ?>><a href="<?php echo $menu_item_link; ?>"<?php if( have_rows('submenu_item', 'option') ): ?> class="hasmenu" <?php endif; ?>><span data-hover="<?php echo $menu_item_titulo; ?>"><?php echo $menu_item_titulo; ?></span></a></li>
                        <?php
                            endwhile; endif;
                        endwhile;
                        endif;
                        ?>
              </ul>
            </div>
            <!-- end /.footer-menu -->
          </div>
          <!-- Ends: .footer-widget -->
        </div>
        <!-- end /.col-lg-3 -->

        <div class="col-md-3 col-sm-4">
          <div class="footer-widget">
            <div class="footer-menu no-padding">
              <h4 class="footer-widget-title"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg> Horarios</h4>
              <ul>
              <?php if(get_field('horarios', 'option')): ?>
                <li>
                  <?php the_field('horarios', 'option'); ?>
                </li>
                <?php endif; ?>
              </ul>
            </div>
            <!-- end /.footer-menu -->
          </div>
          <!-- Ends: .footer-widget -->
        </div>
        <!-- Ends: .col-lg-3 -->

      </div>
      <!-- end /.row -->
    </div>
    <!-- end /.container -->
  </div>
  <!-- end /.footer-big -->

  <div class="mini-footer">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="copyright-text">
            <p>© <?php echo date('Y'); ?>
              Artefolk. Todos los derechos reservados.
            </p>
          </div>

          <div class="go_top">
            <span class="icon-arrow-up"></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
<section class="d-flex d-xl-none position-fixed fixed-bottom py-1 sticky-bar-mobile activo" id="sticky_mobile">
        <div class="container-fluid">
            <div class="row px-3 align-items-center justify-content-center">
                <div class="col-3 d-flex text-center justify-content-center">
                    <a href="javascript:void(0)" id="show_menu_bar"><i data-feather="menu" class="text-dark"></i><p>Menú</p></a>
                </div>
                <?php global $product; if(is_product() && $product->is_in_stock()): ?>
                    <div class="col-3 px-1 d-flex text-center justify-content-center">
                        <?php 
                        echo $product->get_price_html(); ?>
                    </div>
                    <div class="col-6 woocommerce">
                    <?php
                            echo apply_filters(
                                'woocommerce_loop_add_to_cart_link',
                                sprintf(
                                    '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="single_add_to_cart_button button alt w-100 %s">%s</a>',
                                    esc_url( $product->add_to_cart_url() ),
                                    esc_attr( $product->get_id() ),
                                    esc_attr( $product->get_sku() ),
                                    $product->is_in_stock() ? '' : 'btn-disable', 
                                    $product->is_in_stock() ? 'Añadir al carrito' : 'Agotado'
                                ), $product,false,false
                            );?>
                    </div>
                <?php else: ?>
                <div class="col-3 px-1 d-flex text-center justify-content-center">
                    <a href="javascript:gotosearch();" class="position-relative"><i data-feather="search" class="text-dark"></i><p>Buscar</p></a>
                </div>
                <div class="col-3 px-1 d-flex text-center justify-content-center">
                    <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $numero); ?>" target="_blank" rel="nofollow" class="position-relative"><i data-feather="message-circle" class="text-dark"></i><p>Whatsapp</p></a>
                </div>
                <div class="col-3 px-1 d-flex text-center justify-content-center">
                    <a href="<?php echo wc_get_cart_url() ?>" class="position-relative"><i data-feather="shopping-bag" class="text-dark"></i>
                    <?php if( WC()->cart->get_cart_contents_count() > 0): ?><span id="bottom-carcounter"><?php echo WC()->cart->get_cart_contents_count(); ?></span><?php endif; ?>
                    <p>carrito</p></a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php wp_footer(); ?>
    <script>
        feather.replace();
    </script>
  </body>
</html>