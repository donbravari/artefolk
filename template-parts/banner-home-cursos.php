<?php
                date_default_timezone_set('Chile/Continental');
                $fecha_actual  = date("Ymd");
                $args = array(
                        'post_type' => 'cursos',
                        'post_status' => 'publish',
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'posts_per_page' => -1,
                        'meta_query'	=> array(
                          'relation'	=> 'AND',
                          array(
                            'key' => 'destacado',
                            'compare' => '=',
                            'value'    => '1'
                          ),
                          array(
                            'key' => 'fecha_inicio',
                            'value'    => array($fecha_actual),
                            'compare' => '>='
                          )

                        ),
                );

                $cursos = new WP_Query( $args );
                if($cursos -> have_posts()):
    ?>
    <section class="py-1">
        <div class="container-fluid">
        <div class="col-12 titulo-seccion mt-4 mb-5 d-flex align-items-center justify-content-between">
                      <h2>Nuestros Cursos y talleres</h2>
                      <a href="<?php the_permalink(); ?>" class="btn btn-artefolk bg-purple">Ver todos</a>
                  </div>
        <div class="owl-carousel owl-theme py-0" id="cursos-destacados">
                
                <?php while ( $cursos -> have_posts() ) : $cursos->the_post(); ?>
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
                                        <?php  $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'cursohome' ); $url = $thumb['0']; ?>
                                        <img src="<?php echo $url; ?>" alt="<?php the_title(); ?>">
                                    </picture>
                                </figure>
                            </div>
                <?php }; endwhile; 
                    wp_reset_query();
                ?>
            </div>
        </div>
    </section>
    <?php endif; ?>