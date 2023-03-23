<section class="py-5">

        <div class="container-fluid">

                  <div class="col-12 titulo-seccion mt-4 mb-5 d-flex align-items-center justify-content-between flex-column flex-lg-row">

                      <h2 class="text-center">Terapias Complementarias</h2>

                      <a href="<?php the_permalink(39334); ?>" class="btn btn-artefolk bg-purple">Ver todas</a>

                  </div>

                  <div  class="owl-carousel owl-theme" id="carrusel-terapias">

                  <?php 

                      $args = array(

                        "post_type" => "terapia",

                        "posts_per_page" => -1,

                      );

                      $loop = new WP_Query( $args );

                      if ( $loop->have_posts() ):

                      while ( $loop->have_posts() ) : $loop->the_post();

                    ?>

                        <div class="item">

                          <div class="card shadow">

                            <?php the_post_thumbnail(array(300, 169), ['class' => 'card-img-top']); ?>

                            <div class="card-body">

                              <h5 class="card-title"><?php the_title(); ?></h5>

                              <p class="card-text"><?php the_excerpt(); ?></p>

                              <a href="<?php the_permalink(); ?>" class="btn btn-artefolk bg-purple btn-agendar">Saber más</a>

                            </div>

                          </div>

                        </div>

                        

                    <?php

                      endwhile;

                        endif;

                    ?>

                  </div>

        </div>

    </section>