<!-- Archivo de cabecera global de Wordpress -->

<?php get_header(); ?>

<!-- Contenido de página de inicio -->

<?php if ( have_posts() ) : the_post(); ?>

  <section class="container py-4">
    <!--div class="col-12">

                    <ul id="breadcrumb">

                        <li><a href="<?php echo get_home_url(); ?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>

                        <li class="active"><a><?php the_title(); ?></a></li>

                    </ul>

                </div-->
    <h1><?php the_title(); ?></h1>

    <?php the_content(); ?>

  </section>

<?php endif; ?>

<!-- Archivo de barra lateral por defecto -->

<?php get_sidebar(); ?>

<!-- Archivo de pié global de Wordpress -->

<?php get_footer(); ?>