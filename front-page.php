<!-- Archivo de cabecera global de Wordpress -->
<?php get_header(); ?>
<!-- Contenido de página de inicio -->
<?php if ( have_posts() ) : the_post(); ?>
  <section class="p-3 p-lg-0">
    <div class="carousel slide carousel-fade" data-ride="carousel" id="mainCarousel">
      <ol class="carousel-indicators">
        <?php if( have_rows('banner') ):
          $count_banner = 0;
          while ( have_rows('banner') ) : the_row();
        ?>
          <li data-target="#mainCarousel" data-slide-to="<?php echo $count_banner; ?>" <?php if($count_banner == 0): ?>class="active"<?php endif; ?>></li>
        <?php 
              $count_banner += 1;
              endwhile;
              endif;
        ?>
      </ol>
      <div class="carousel-inner rounded-lg">

      <?php if( have_rows('banner') ):
      $count_banner = 0;
       while ( have_rows('banner') ) : the_row();
          $titulo_banner = get_sub_field('titulo_banner');
          $image_desk = get_sub_field('imagen_desktop');
          $image_mob = get_sub_field('imagen_mobile');
          $link_banner = get_sub_field('link_banner');
       ?>

        <div class="carousel-item<?php if($count_banner == 0): ?> active<?php endif; ?>">
          <a href="<?php echo $link_banner; ?>">
            <picture>
              <source srcset="<?php echo $image_desk; ?>" media="(min-width:526px)">
              <img src="<?php echo $image_mob; ?>" class="img-fluid" alt="<?php echo $titulo_banner; ?>" />
            </picture>
          </a>
        </div>
        <?php
            $count_banner += 1;
            endwhile;
          endif;
          wp_reset_query();
        ?>
      </div>
      <a class="carousel-control-prev" href="#mainCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#mainCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    <!--h1><?php the_title(); ?></h1>
    <?php the_content(); ?>-->
  </section>
  <section>
    <div class="container-fluid py-3 pt-lg-4 pb-lg-2">
      <div id="carousel-categorias" class="owl-carousel owl-theme">
      <?php if( have_rows('card_categoria') ):
            while ( have_rows('card_categoria') ) : the_row();
              $icono_categoria = get_sub_field('icono_categoria');
              $nombre_categoria = get_sub_field('nombre_categoria');
              $id_categoria = get_sub_field('link_categoria');
             $categoria_current = get_term($id_categoria);
              $nombre_original_categoria = $categoria_current->name;
              $link_categoria = get_term_link($id_categoria);
       ?>
        <div class="col-12 d-flex flex-column">
          <a href="<?php echo $link_categoria; ?>" class="btn-overall"></a>
          <img src="<?php echo $icono_categoria; ?>" width="70px" height="70px" class="img-fluid p-2 rounded-circle" alt="" />
          <p class="text-center"> <?php echo $nombre_original_categoria; ?></p>
        </div>
        <?php
            endwhile;
            endif;
            wp_reset_query();
        ?>
      </div>
    </div>
  </section>
  <section>
    <div class="container-fluid">
      <div class="row">
        <?php if( have_rows('banner_01') ):
             while ( have_rows('banner_01') ) : the_row();
            $imagen1 = get_sub_field('imagen_banner_01');
            $link1 = get_sub_field('link_banner_01');
        ?>
        <div class="col col-12 col-md-6 py-2">
          <a href="<?php echo $link1; ?>">
            <img src="<?php echo $imagen1; ?>" alt="" class="img-fluid rounded-lg" width="100%" height="auto" />
          </a>
        </div>
        <?php 
          endwhile;
          endif;
          wp_reset_query();
        ?>
        <?php if( have_rows('banner_02') ):
             while ( have_rows('banner_02') ) : the_row();
            $imagen2 = get_sub_field('imagen_banner_02');
            $link2 = get_sub_field('link_banner_02');
        ?>
        <div class="col col-12 col-md-6 py-2">
          <a href="<?php echo $link2; ?>">
            <img src="<?php echo $imagen2; ?>" alt="" class="img-fluid rounded-lg" width="100%" height="auto" />
          </a>
        </div>
        <?php 
          endwhile;
          endif;
          wp_reset_query();
        ?>
      </div>
    </div>
  </section>
  
    <?php get_template_part( 'template-parts/section', 'home-products' ); ?>
    <?php get_template_part( 'template-parts/banner', 'home-cursos' ); ?>
    <?php get_template_part( 'template-parts/carrusel', 'home-terapias' ); ?>
    <?php get_template_part( 'template-parts/section', 'blog-home' ); ?>
    <section class="py-5">
      <div class="container-fluid">
        <div class="row">
          <?php echo do_shortcode('[elfsight_instagram_feed id="1"]'); ?>
        </div>
      </div>
    </section>
<?php endif; ?>
<!-- Archivo de barra lateral por defecto -->
<?php get_sidebar(); ?>
<!-- Archivo de pié global de Wordpress -->
<?php get_footer(); ?>