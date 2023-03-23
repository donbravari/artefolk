<section>
        <div class="container-fluid">
            <div class="row">
              <div class="col-12 titulo-seccion mt-4 mb-3 text-center">
                  <h2>Tienda esotérica online Artefolk</h2>
              </div>
              <div class="col-12 mb-3">
                  <ul class="nav nav-pills nav-pills-afolk justify-content-center" id="tabs_home" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="pills_newstab" data-toggle="tab" href="#pills_news" role="tab" aria-controls="pills_news" aria-selected="true">Nuevos</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="pills_offerstab" data-toggle="tab" href="#pills_offers" role="tab" aria-controls="pills_offers" aria-selected="false" >Ofertas</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="pills_salestab" data-toggle="tab" href="#pills_sales" role="tab" aria-controls="pills_sales" aria-selected="false" >Más vendidos</a>
                    </li>
                  </ul>
              </div>
              <div class="tab-content px-4 w-100" id="tabs_homeContent">
                  <div class="tab-pane fade show active" id="pills_news" role="tabpanel" aria-labelledby="pills_newstab">
                    <div class="row">
                    <?php 
                      $args = array(
                      "post_type" => "product",
                      "posts_per_page" => 12,
                      'tax_query'   => array( array(
        'taxonomy'  => 'product_visibility',
        'terms'     => array( 'exclude-from-catalog' ),
        'field'     => 'name',
        'operator'  => 'NOT IN',
    ) ), // mostrar solo productos visibles y productos que aparecen en la búsqueda
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
                    ?>
                        <?php get_template_part( 'template-parts/card', 'product' ); ?>
                    <?php
                      endwhile;
                        endif;
                    ?>
                    </div>
                  </div><!----fin tab---->

                  <div class="w-100 tab-pane fade" id="pills_offers" role="tabpanel" aria-labelledby="pills_offerstab">
                    <div class="row">
                    <?php 
                      $args = array(
                        "post_type" => "product",
                        "posts_per_page" => 12,
                        'tax_query'   => array( array(
        'taxonomy'  => 'product_visibility',
        'terms'     => array( 'exclude-from-catalog' ),
        'field'     => 'name',
        'operator'  => 'NOT IN',
    ) ), // mostrar solo productos visibles y productos que aparecen en la búsqueda
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
                        'meta_value' => 0,
                        'meta_compare' => '>=',
                        'meta_type' => 'NUMERIC'
                      );
                      $loop = new WP_Query( $args );
                      if ( $loop->have_posts() ):
                      while ( $loop->have_posts() ) : $loop->the_post();
                    ?>
                      <?php get_template_part( 'template-parts/card', 'product' ); ?>
                    <?php
                      endwhile;
                        endif;
                    ?>
                    </div>
                  </div><!----fin tab---->

                  <div class="w-100 tab-pane fade" id="pills_sales" role="tabpanel" aria-labelledby="pills_salestab">
                    <div class="row">
                    <?php 
                      $args = array(
                        "post_type" => "product",
                        "posts_per_page" => 12,
                        'tax_query'   => array( array(
        'taxonomy'  => 'product_visibility',
        'terms'     => array( 'exclude-from-catalog' ),
        'field'     => 'name',
        'operator'  => 'NOT IN',
    ) ), // excluir productos con visibilidad "catalog"
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
                        'ignore_sticky_posts' => 1,
                        'meta_key' => 'total_sales',
                        'orderby' => 'meta_value_num',
                        'order' => 'DESC',
                      );
                      $loop = new WP_Query( $args );
                      if ( $loop->have_posts() ):
                      while ( $loop->have_posts() ) : $loop->the_post();
                    ?>
                    <?php get_template_part( 'template-parts/card', 'product' ); ?>
                    <?php
                      endwhile;
                        endif;
                    ?>
                    </div>
                  </div><!----fin tab---->

               </div>
            </div>
        </div>
    </section>