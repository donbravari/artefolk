<?php
/**
 * Template Name: Página Cursos y talleres
 */

?>
<?php get_header(); ?>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets-cursos/owlcarousel/assets/owl.carousel.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets-cursos/css/cursos.css">
<div id="holder-cursos">
        <div class="container-cursos">
            <div class="owl-carousel owl-theme" id="cursos-destacados">
                <?php
                $current_date = date('Y-m-d');
                $args = array(
                        'post_type' => 'cursos',
                        'post_status' => 'publish',
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'posts_per_page' => -1,
                        'meta_key'      => 'destacado',
                        'meta_value'    => '1',

                        'meta_query' => array(
                            array(
                                'key' => 'fecha_inicio',
                                'value' => $current_date,
                                'compare' => '>=',
                                'type' => 'DATE'
                            )
                        )
                                            );

                $recetas = new WP_Query( $args ); ?>
                <?php if($recetas -> have_posts()){
                 while ( $recetas -> have_posts() ) : $recetas->the_post(); ?>
                    <?php 
                    $fecha_entrada = strtotime(get_field("fecha_inicio")." 00:00:00");
                    $fecha_actual  = strtotime(date("d-m-Y H:i:00",time()));
                    $is_active = true;
                    if($fecha_actual > $fecha_entrada){
                        $is_active = false;
                    }
                    if($is_active){
                ?>
                            <div class="item item-curso-destacado">
                                <div class="caption">
                                    <span class="precio-destacado">$<?php 

                                    if(get_field("precio_mensual") != ''){
                                        echo number_format(get_field("precio_mensual"),'0', ',', '.').' x mes'; 
                                    }else{
                                        echo number_format(get_field("precio_clp"),'0', ',', '.'); 
                                    }

                                ?> / USD$<?php echo str_replace(".", ",", get_field("precio_usd")); ?></span>
                                    <ul class="tags-cursos">
                                        <li><span>Duración: <?php the_field("duracion"); ?></span></li>
                                        <li><span><?php the_field("modalidad"); ?></span></li>
                                        <li><span>Inicio: <?php the_field("fecha_inicio"); ?></span></li>
                                    </ul>
                                    <?php the_title( '<h2>', '</h2>' ); ?>
                                    <a class="btn-curso-destacado" href="<?php the_permalink(); ?>">Saber más</a>
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
                <?php }; endwhile; 

            }else{
?>
<div class="item item-curso-destacado">
                                <div class="caption">
                                    <h2>Próximamente los mejores cursos y talleres</h2>
                                </div>
                                <figure>
                                    <picture>
                                                <source srcset="/wp-content/uploads/2022/06/curso_rider-1-560x623.gif" media="(max-width: 767px)">
                                                <img src="/wp-content/uploads/2022/06/curso_rider-1-877x318.gif" alt="Cursos y talleres Artefolk">
                                    </picture>
                                </figure>
                            </div>
<?php
            };
                    wp_reset_query();
                ?>
            </div>
            <div class="grilla-cursos-holder">
                <?php
                $args = array(
                        'post_type' => 'cursos',
                        'post_status' => 'publish',
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'posts_per_page' => 20,
                        'meta_key'      => 'destacado',
                        'meta_value'    => '0'
                                            );

                $recetas = new WP_Query( $args ); ?>
                <?php while ( $recetas -> have_posts() ) : $recetas->the_post(); ?>
                <?php 
                    $fecha_entrada = strtotime(get_field("fecha_inicio")." 00:00:00");
                    $fecha_actual  = strtotime(date("d-m-Y H:i:00",time()));
                    $is_active = true;

                    if(intval($fecha_actual) > intval($fecha_entrada)){
                        $is_active = false;
                    }
                ?>
                <div class="thumb-curso<?php if(!$is_active){ echo " close-curso"; } echo " ".$fecha_entrada.'-'.$fecha_actual;?>">
                    <a href="<?php the_permalink(); ?>" class="btn-overall"></a>
                    <div class="header-thumb-curso">
                        <?php if($is_active){ ?>
                            <span class="thumb-inicio">Inicio: <?php the_field("fecha_inicio"); ?></span>
                        <?php }else{ ?>
                            <span class="thumb-inicio">Inscripciones Cerradas</span>
                        <?php } ?>
                        <figure>
                            <?php  $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'curso349x232' ); $url = $thumb['0']; ?>
                            <img src="<?php echo $url; ?>" alt="Curso" />
                        </figure>
                        
                        <ul class="tags-cursos">
                            <li><span>Duración: <?php the_field("duracion"); ?></span></li>
                            <li><span><?php the_field("modalidad"); ?></span></li>
                        </ul>
                    </div>
                    <div class="caption">
                        <h3><?php the_title(); ?></h3>
                        <p><?php the_field("descripcion_corta"); ?></p>
                        <?php if($is_active){ ?>
                            <span class="precio-destacado">$<?php 

                                    if(get_field("precio_mensual") != ''){
                                        echo number_format(get_field("precio_mensual"),'0', ',', '.').' x mes'; 
                                    }else{
                                        echo number_format(get_field("precio_clp"),'0', ',', '.'); 
                                    }

                                ?> / USD$<?php echo str_replace(".", ",", get_field("precio_usd")); ?></span>
                        <?php }else{ ?>
                            <span class="precio-destacado">Saber más</span>
                        <?php } ?>
                        
                    </div>
                </div>
                 <?php endwhile; 
                    wp_reset_query();
                ?>
                
            </div>
        </div>
    </div>
    <script async src="<?php echo get_stylesheet_directory_uri(); ?>/assets-cursos/js/jquery-3.6.0.min.js"></script>

<?php
get_footer();
?>
<script async src="<?php echo get_stylesheet_directory_uri(); ?>/assets-cursos/owlcarousel/owl.carousel.js"></script>
<script async src="<?php echo get_stylesheet_directory_uri(); ?>/assets-cursos/js/funciones.js"></script>