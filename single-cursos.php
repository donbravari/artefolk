<?php get_header(); ?>

<div id="holder-interior-curso">
        <div class="container-cursos">
            <div class="header-interior-curso">
                <div class="caption">
                    <ul class="tags-cursos">
                        <li><span>Duración: <?php the_field("duracion"); ?></span></li>
                        <li><span><?php the_field("modalidad"); ?></span></li>
                        <li><span>Inicio: <?php the_field("fecha_inicio"); ?></span></li>
                    </ul>
                    <?php the_title( '<h1>', '</h1>' ); ?>
                </div>
                <figure>
                    <picture>
                        <?php  $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'curso560x623' ); $url = $thumb['0']; ?>
                        <source srcset="<?php echo $url; ?>" media="(max-width: 767px)">
                        <?php  $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'curso877x318' ); $url = $thumb['0']; ?>
                        <img src="<?php echo $url; ?>" alt="<?php the_title(); ?>">
                    </picture>
                </figure>
            </div>

            <div class="contenedor-curso-interior">
                <div class="description-holder">
                    <h2>Descripción</h2>
                    <?php the_field("descripcion_larga"); ?>
                    <div class="temario-holder">
                    	<?php
                    	if( have_rows('temario') ):
    						while ( have_rows('temario') ) : the_row();
                    	?>
                        <div class="accordeon-temario">
                            <h3 class="header-accordeon"><?php the_sub_field("titulo_temario"); ?></h3>
                            <div class="content-accordeon">
                                <?php the_sub_field("contenido_temario"); ?>
                            </div>
                        </div>
                        <?php
                    		endwhile;
							endif;
                        ?>
                        <?php if(get_field("banner_kit")): ?>
                        <div class="banner-temario">
                            <picture>
                                <source srcset="<?php the_field("banner_kit_movil"); ?>" media="(max-width: 767px)">
                                <img src="<?php the_field("banner_kit"); ?>" alt="MDN">
                            </picture>
                        </div>
                        <?php
							endif;
                        ?>
                    </div>
                </div>
                <div class="side-column">
                    <div class="box-side box-valores">
                        <?php 
                    $fecha_entrada = strtotime(get_field("fecha_inicio")." 00:00:00");
                    $fecha_actual  = strtotime(date("d-m-Y H:i:00",time()));
                    $is_active = true;
                    if($fecha_actual > $fecha_entrada){
                        $is_active = false;
                    }
                    if($is_active){
                ?>
                        <h2 class="box-tittle">Valores</h2>
                        <div class="contenido-box">
                            <?php
	                    	if( have_rows('parrafo_valores') ):
	    						while ( have_rows('parrafo_valores') ) : the_row();
	    							the_sub_field("parrafo"); 
	                    		endwhile;
								endif;
	                        ?>
                        </div>
                        
                        <form action="/cursos-inscripcion/" method="post" class="form-comprar">
                                <input type="hidden" name="idecurso" value="<?php global $post; echo $post->ID; ?>">
                                <button type="submit" class="btn-curso-destacado">Inscribete</button>
                            </form>
                        <?php }else{ ?>
                            <h2 class="box-tittle">Inscripciones cerradas</h2>
                            <div class="contenido-box">
                                <a href="/contacto/" class="btn-curso-destacado">Contáctanos</a>
                            </div>
                        <?php } ?>
                    </div>
                    <?php if($is_active){ ?>
                    <div class="box-side box-horarios">
                        <h2 class="box-tittle">Horarios y Clases</h2>
                        <div class="contenido-box">
                            <?php
	                    	if( have_rows('parrafo_horarios_y_clases') ):
	    						while ( have_rows('parrafo_horarios_y_clases') ) : the_row();
	    							the_sub_field("parrafo"); 
	                    		endwhile;
								endif;
	                        ?>
                        </div>
                    </div>

                    <div class="box-side box-contenido">
                        <h2 class="box-tittle">El Curso incluye</h2>
                        <div class="contenido-box">
                            <?php
	                    	if( have_rows('parrafo_el_curso_incluye') ):
	    						while ( have_rows('parrafo_el_curso_incluye') ) : the_row();
	    							the_sub_field("parrafo"); 
	                    		endwhile;
								endif;
	                        ?>
                        </div>
                    </div>
                <?php } ?>

                </div>
            </div>
        </div>
    </div>
<script async src="<?php echo get_stylesheet_directory_uri(); ?>/assets-cursos/js/jquery-3.6.0.min.js"></script>
<?php
get_footer();
?>
<script async src="<?php echo get_stylesheet_directory_uri(); ?>/assets-cursos/js/funciones_cursos.js"></script>