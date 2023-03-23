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

                <?php $product_archive_link = get_permalink(39334); ?>

                <li class="active"><a href="<?php echo esc_url( $product_archive_link ); ?>">Terapias</a></li>

                <li class="active"><a><?php the_title(); ?></a></li>

            </ul>

        </div>

        <div class="col-lg-8">

            <article>

            <div class="card mb-4">

                <?php echo get_the_post_thumbnail( $post->ID, array( 850, 350), array( 'class' => 'card-img-top' ) ); ?></a>

                <div class="card-body">

                    <h1><?php the_title(); ?></h1>

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

                        <div class="card-header"><?php the_title(); ?></div>

                        <div class="card-body">

                        <p class="price-teapia"><strong>Precio:</strong> <br><small><?php the_field('precio');?></small></p>

		                <p class="price-teapia"><strong>Duración:</strong> <br><small><?php the_field('duracion');?></small></p>

                        <a class="btn btn-primary" href="https://artefolk.cl/terapias/" target="_blank">Agendar</a>

                        </div>

                    </div>

           

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