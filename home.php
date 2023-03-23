<!-- Archivo de cabecera global de Wordpress -->

<?php get_header(); ?>

<!-- Listado de posts -->

<?php if ( have_posts() ) : ?>

  <section class="py-4">

  <div class="container">

            <div class="row">

                <!-- Blog entries-->

                <div class="col-12">

                    <ul id="breadcrumb">

                        <li><a href="<?php echo get_home_url(); ?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>

                        <li class="active"><a>Blog</a></li>

                    </ul>

                </div>

                <div class="col-lg-8">

                  <?php

                      $args = array(

                        'post_type'      => 'post', // Set the post type to 'post'

                        'posts_per_page' => 1, // Show only one post

                        'orderby'        => 'date', // Order the posts by date

                        'order'          => 'DESC' // Show the newest post first

                    );

                    $query = new WP_Query( $args );

                    if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();

                  ?>

                    <!-- Featured blog post-->

                    

                    <div class="card mb-4">

                        <a href="<?php the_permalink(); ?>">

                        <?php echo get_the_post_thumbnail( $post->ID, array( 850, 350), array( 'class' => 'card-img-top' ) ); ?></a>

                        <div class="card-body">

                            <div class="small text-muted" datatime="<?php the_time('Y-m-j'); ?>"><?php the_time('j F, Y'); ?></div>

                            <h2 class="card-title"><?php the_title(); ?></h2>

                            <p class="card-text"><?php the_excerpt(); ?></p>

                            <a class="btn btn-primary" href="<?php the_permalink(); ?>">Leer más →</a>

                        </div>

                    </div>



                    <?php

                    endwhile; endif;



                    // Reset the post data

                    wp_reset_postdata();

                    ?>

                    <!-- Nested row for non-featured blog posts-->

                    <div class="row">

                        

                            <?php

                                $contadorPost = 0;

                                $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

                                $args = array(

                                  'post_type'      => 'post', // Set the post type to 'post'

                                  'posts_per_page' => 4, // Show 5 posts per page

                                  'paged'          => $paged, // Use the current page variable

                                  'offset'  => -1

                                );

                                $query = new WP_Query( $args );

                                if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();

                              ?>

                              <div class="col-lg-6">

                                <!-- Blog post-->

                                <div class="card mb-4">

                                    <a href="<?php the_permalink(); ?>">

                                    <?php echo get_the_post_thumbnail( $post->ID, array( 700, 350), array( 'class' => 'card-img-top' ) ); ?></a>

                                    <div class="card-body">

                                        <div class="small text-muted" datatime="<?php the_time('Y-m-j'); ?>"><?php the_time('j F, Y'); ?></div>

                                        <h2 class="card-title h4"><?php the_title(); ?></h2>

                                        <p class="card-text"><?php the_excerpt(); ?></p>

                                        <a class="btn btn-primary" href="<?php the_permalink(); ?>">Leer más →</a>

                                    </div>

                                </div>

                              </div>

                            <?php

                                endwhile;

                            ?>                      

                    </div>



                    

                            <?php

                          // Display pagination if there's more than one page

                          if ( $query->max_num_pages > 1 ) :

                            ?><nav aria-label="Pagination"><hr class="my-0" /><?php

                            echo '<ul class="pagination justify-content-center my-4">';

                            $pagination_args = array(

                              'base'      => get_pagenum_link( 1 ) . '%_%',

                              'format'    => '/page/%#%',

                              'current'   => max( 1, get_query_var( 'paged' ) ),

                              'total'     => $query->max_num_pages,

                              'prev_text' => 'Anterior',

                              'next_text' => 'Siguiente',

                              'mid_size'  => 2 // Show 2 pages before and after the current page

                          );

                          function blog_paginate_links($links){

                              $links = str_replace( 'page-numbers', 'page-link', $links );

                              $links = str_replace( '<span class="pag e-link current">', '<li class="page-item active" aria-current="page"><a class="page-link" href="#!">', $links );

                              $links = str_replace( '<a class="page-link"', '<li class="page-item"><a class="page-link"', $links );

                              $links = str_replace( '</span>', '</a></li>', $links );

                              $links = str_replace( 'prev page-link', 'page-item', $links );

                              $links = str_replace( 'next page-link', 'page-item', $links );

                              return $links;

                          };

                            // Add Bootstrap classes to the pagination links

                            add_filter( 'paginate_links', 'blog_paginate_links');

                            echo paginate_links( $pagination_args );

                            echo '</ul>';



                            ?></nav> <?php

                        endif;





                            ?>

                            <?php

                            endif;

                            wp_reset_postdata();

                            ?>

    



                    <!-- Pagination

                    <nav aria-label="Pagination">

                        <hr class="my-0" />

                        <ul class="pagination justify-content-center my-4">

                            <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Newer</a></li>

                            <li class="page-item active" aria-current="page"><a class="page-link" href="#!">1</a></li>

                            <li class="page-item"><a class="page-link" href="#!">2</a></li>

                            <li class="page-item"><a class="page-link" href="#!">3</a></li>

                            <li class="page-item disabled"><a class="page-link" href="#!">...</a></li>

                            <li class="page-item"><a class="page-link" href="#!">15</a></li>

                            <li class="page-item"><a class="page-link" href="#!">Older</a></li>

                        </ul>

                    </nav>-->

                </div>

                <!-- Side widgets-->

                <div class="col-lg-4">

                    <!-- Search widget-->

                    <div class="card mb-4">

                        <div class="card-header">Buscar</div>

                        <div class="card-body">

                        <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">

                            <div class="input-group">

                                <input class="form-control" type="text" placeholder="Ingresar termino de consulta..." aria-label="Ingresar termino de consulta..." value="<?php echo get_search_query(); ?>" name="s" aria-describedby="button-search" />
                                <input type="hidden" name="post_type" value="post" />
                                <button class="btn btn-primary" id="button-search" type="submit">Buscar</button>

                            </div>

                          </form>

                        </div>

                    </div>

                    <!-- Categories widget-->

                    <div class="card mb-4">

                        <div class="card-header">Categorías</div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col-sm-6">

                                    <ul class="list-unstyled mb-0">

                                    <?php wp_list_categories( 'title_li=' ); ?>

                                    </ul>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- Side widget

                    <div class="card mb-4">

                        <div class="card-header">Side Widget</div>

                        <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and feature the Bootstrap 5 card component!</div>

                    </div>-->

                </div>

            </div>

        </div>

  </section>

<?php else : ?>

  <p><?php _e('Ups!, no hay entradas.'); ?></p>

<?php endif; ?>

<!-- Archivo de barra lateral por defecto -->

<?php get_sidebar(); ?>

<!-- Archivo de pié global de Wordpress -->

<?php get_footer(); ?>