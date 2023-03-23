<!-- Archivo de cabecera global de Wordpress -->
<?php get_header(); ?>
<!-- Contenido del post -->
<?php if ( have_posts() ) : the_post(); ?>
  <section class="pt-5">
    <div class="container pt-5">
      <?php woocommerce_content(); ?>
    </div>
  </section>
<?php else : ?>
  <p><?php _e('Ups!, esta entrada no existe.'); ?></p>
<?php endif; ?>
<!-- Archivo de barra lateral por defecto -->
<?php get_sidebar(); ?>
<!-- Archivo de pié global de Wordpress -->
<?php get_footer(); ?>