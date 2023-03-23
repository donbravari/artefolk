<section class="section bg-lightgreen py-4">

            <div class="container">

                <div class="row justify-content-center">

                    <div class="col-lg-7 text-center">

                        <div class="section-title">

                            <h2>Nuestro Blog</h2>

                            <p>Entérate de temas relacionados con el mundo místico y Artefolk.</p>

                        </div>

                    </div>

                </div>

                <div class="row" id="blog-home">

                <?php 

                $contador = 1;

                      $args = array(

                        "post_type" => "post",

                        "posts_per_page" => 3,

                      );

                      $loop = new WP_Query( $args );

                      if ( $loop->have_posts() ):

                      while ( $loop->have_posts() ) : $loop->the_post();

                    ?>

                    <div class="col-md-6 col-lg-4 <?php //if($contador > 3){ echo 'd-none d-md-block d-lg-none'; } ?>">

                        <div class="blog-grid">

                            <div class="blog-img">

                                <div class="date"><?php the_time('j'); ?> <?php the_time('F'); ?></div>

                                <a href="<?php the_permalink(); ?>">

                                <?php  the_post_thumbnail('blog_thumbnail'); ?>

                                </a>

                            </div>

                            <div class="blog-info">

                                <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>

                                <p><?php the_excerpt(); ?></p>

                                <div class="btn-bar">

                                    <a href="<?php the_permalink(); ?>" class="btn btn-artefolk bg-purple btn-agendar">

                                        Leer más

                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                    <?php

                    $contador++;

                      endwhile;

                        endif;

                    ?>

                    

                </div>

            </div>

        </section>