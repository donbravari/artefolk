<?php
/**
 * Template Name: Página terapias
 */

?>

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

                        <li class="active"><a>Terapias</a></li>

                    </ul>

                </div>
                <div class="col-12 mb-4">
                    <h1><?php the_title(); ?></h1>
                </div>

                <div class="col-12">
                    <div class="row">
                  <?php

                      $args = array(

                        'post_type'      => 'terapia', // Set the post type to 'post'

                        'posts_per_page' => -1, // Show only one post

                        'orderby'        => 'date', // Order the posts by date

                        'order'          => 'DESC' // Show the newest post first

                    );

                    $query = new WP_Query( $args );

                    if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();

                  ?>

                    <!-- Featured blog post-->

                    
                    <div class="col-md-6">
                        <div class="card mb-4 ">

                        <a href="<?php the_permalink(); ?>">

                        <?php echo get_the_post_thumbnail( $post->ID, array( 850, 350), array( 'class' => 'card-img-top' ) ); ?></a>

                        <div class="card-body">

                            <div class="small text-muted" datatime="<?php the_time('Y-m-j'); ?>"><?php the_time('j F, Y'); ?></div>

                            <h2 class="card-title"><?php the_title(); ?></h2>

                            <p class="card-text"><?php the_excerpt(); ?></p>

                            <a class="btn btn-primary" href="<?php the_permalink(); ?>">Leer más →</a>

                        </div>
                    </div>
                    </div>



                    <?php

                    endwhile; endif;



                    // Reset the post data

                    wp_reset_postdata();

                    ?>

                   
</div>
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