<!-- Archivo de cabecera global de Wordpress -->
<?php get_header(); ?>
<!-- Contenido de página de inicio -->
<?php if ( have_posts() ) : the_post(); ?>
  <section class="container py-4 single">
    

    <div class="container pb50">
    <div class="row">
        <div class="col-12">
            <ul id="breadcrumb">
                <li><a href="<?php echo get_home_url(); ?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
                <li class="active"><a href="<?php echo esc_url(get_permalink(41002)); ?>">Blog</a></li>
                <li class="active"><a><?php the_title(); ?></a></li>
            </ul>
        </div>
        <div class="col-lg-8">
            <article>
            <div class="card mb-4">
                <?php echo get_the_post_thumbnail( $post->ID, array( 850, 350), array( 'class' => 'card-img-top' ) ); ?></a>
                <div class="card-body">
                    <h1><?php the_title(); ?></h1>
                    <ul class="post-meta list-inline">
                        <li class="list-inline-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Por <?php the_author_posts_link();  ?>
                        </li>
                        <li class="list-inline-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> <a><time datatime="<?php the_time('Y-m-j'); ?>"><?php the_time('j F, Y'); ?></time></a>
                        </li>
                        <li class="list-inline-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg> <?php
                                echo wpdocs_show_tags();
                            ?>
                        </li>
                    </ul>
                    <?php the_content(); ?>
                    <?php share_buttons(); ?>
                    
                </div>
                </div>
            </article>
            <!-- post article-->

        </div>
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
            <div>
                <h4 class="sidebar-title">Últimas noticias</h4>
                <ul class="list-unstyled">
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
                    <li class="media py-1">
                        <div class="card mb-3 w-100">
                            <div class="row no-gutters">
                                <div class="col-5">
                                    <?php  the_post_thumbnail(array(200, 200), ['class' => 'd-flex mr-3 img-fluid'] ); ?>
                                </div>
                                <div class="col-7">
                                    <div class="card-body">
                                        <h6 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6> 
                                        <p class="card-text"><small class="text-muted"><?php the_time('j F'); ?></small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php
                    $contador++;
                      endwhile;
                        endif;
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>



    
  </section>
<?php endif; ?>
<!-- Archivo de barra lateral por defecto -->
<?php get_sidebar(); ?>
<!-- Archivo de pié global de Wordpress -->
<?php get_footer(); ?>