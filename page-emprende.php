<?php
/**
 * Template Name: Página Emprende con nosotros
 */
?>
<?php get_header(); ?>
    <section class="py-4">
      <div class="container">
        <div class="row">
            <div class="col-12">
                <h1><?php the_title(); ?></h1>
            </div>
            <div class="col-12">
                <?php echo do_shortcode('[contact-form-7 id="39352" title="Formulario emprendedor"]'); ?>
            </div>
        </div>
       </div>
    </section>
<?php get_footer(); ?>