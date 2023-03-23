<?php



ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);



?>

<!DOCTYPE html>

<html lang="<?php bloginfo('language'); ?>">

  <head>

    <meta charset="<?php bloginfo('charset'); ?>">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?php wp_title( '|', true, 'right' ); ?></title>

    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url') ?>">

    <?php wp_head(); ?>

  </head>

  <body>

    <header class="">

      <div class="container-fluid">

            <div class="row top-header py-1 py-xl-2 align-items-center">

                <div class="col-3 col-md-3 order-1 d-flex d-xl-none align-items-center justify-content-start">

                    <buttton id="show-menu-mobile" class="menu-mobile d-block d-xl-none"><i data-feather="menu" class="text-dark"></i></button>

                </div>

                <div class="col-6 col-md-6 col-xl-2 order-xl-2 order-2" itemscope itemtype="http://schema.org/Organization">

                    <a class="navbar-brand d-flex align-items-center justify-content-center justify-content-xl-start" itemprop="url" href="<?php echo get_home_url(); ?>">

                        <img itemprop="logo" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/marca-artefolk-mistica.svg" width="100px" height="auto" class="d-inline-block align-top img-fluid" alt="">

                    </a>

                </div>

                <div class="col-12 col-md-12 col-xl-6 order-4 py-1 py-xl-3">

                    <form id="search-products" action="<?php echo esc_url( home_url( '/' ) ); ?>">

                        <div class="searchform-group position-relative d-flex justify-content-strech align-items-center">

                            <input type="text" placeholder="Buscar en artefolk.cl" name="s" value="<?php echo get_search_query(); ?>" class="pl-4 w-100" />
                            <input type="hidden" name="post_type" value="product" />

                            <button type="submit" id="searchsubmit" class="searchform-btnicon position-absolute d-flex align-items-center justify-content-center"><i data-feather="search" class="text-white-50"></i></button>

                        </div>

                    </form>

                </div>

                <div class="col-3 col-md-3 col-xl-4 order-3 order-xl-4 d-flex align-items-center justify-content-end">

                    <!--a href="http://localhost/artefolk-template/mi-cuenta/" class="mx-2" title="Mi cuenta">

                        <i data-feather="user" class="text-dark"></i>

                    </a-->

                    <a href="<?php echo wc_get_cart_url() ?>" class="mr-2 carrito_main_header_content" title="ir al carrito de compras">

                        <i data-feather="shopping-bag" class="text-dark"></i>

                        <?php if( WC()->cart->get_cart_contents_count() > 0): ?>

                        <span class="carrito-counter" id="carrito-counter"><?php echo WC()->cart->get_cart_contents_count(); ?></span>

                        <?php endif; ?>

                    </a>

                </div>

            </div>

        </div>

        <div class="main-menu bg-darkgreen d-none d-xl-block">

            <div class="container-fluid">

                <div class="row main-menu">

                    <div class="navbar navbar-expand-xl col-12 d-none d-md-block p-0">

                        <ul class="navbar-nav mr-auto">

                        <?php

                        if( have_rows('menu_superior', 'option') ):

                            while( have_rows('menu_superior', 'option') ) : the_row();

                            if( have_rows('menu_item_superior', 'option') ):

                                while( have_rows('menu_item_superior', 'option') ) : the_row();

                                $menu_item_titulo = get_sub_field('menu_item_titulo');

                                $menu_item_link = get_sub_field('menu_item_link');

                                $menu_activo = get_sub_field('menu_activo');

                        ?>

                            <li <?php if($menu_activo): ?>class="active"<?php endif; ?>><a href="<?php echo $menu_item_link; ?>"<?php if( have_rows('submenu_item', 'option') ): ?> class="hasmenu" <?php endif; ?>><span data-hover="<?php echo $menu_item_titulo; ?>"><?php echo $menu_item_titulo; ?></span></a>

                                <?php if( have_rows('submenu_item', 'option') ): ?>

                                    <ul class="submenu">

                                        <?php while( have_rows('submenu_item', 'option') ) : the_row(); 

                                                $submenu_titulo = get_sub_field('submenu_titulo');

                                                $submenu_link = get_sub_field('submenu_link');

                                                

                                        ?>

                                        <li><a href="<?php echo $submenu_link; ?>"><?php echo $submenu_titulo.$menu_activo; ?></a></li>

                                        <?php endwhile; ?>

                                    </ul>

                                <?php endif; ?>

                        

                            </li>

                        <?php

                            endwhile; endif;

                        endwhile;

                        endif;

                        ?>
                        <li><a href="https://artefolk.cl/mayorista/" target="_blank"><span data-hover="Mayorista">Mayorista</span></a></li>
                        </ul>

                    </div>

                </div>

            </div>

        </div>

        <div class="product-menu bg-green d-none d-xl-block">

            <div class="container-fluid">

                <div class="row main-menu">

                        <div class="navbar navbar-expand-xl navbar-dark col-12 d-none d-md-block  p-0">

                        <ul class="navbar-nav mr-auto">

                            



                        <?php

                        if( have_rows('menu_productos', 'option') ):

                            while( have_rows('menu_productos', 'option') ) : the_row();

                            if( have_rows('menu_item_superior', 'option') ):

                                while( have_rows('menu_item_superior', 'option') ) : the_row();

                                

                                $menu_item_link = get_sub_field('menu_item_link');

                                $menu_item_titulo = get_term($menu_item_link)->name;

                                $menu_activo = get_sub_field('menu_activo');

                                if(isset($menu_item_link) and !empty($menu_item_link)){

                                    $menu_link_categoria = get_term_link($menu_item_link);

                                }else{

                                    $menu_link_categoria = '#';

                                }

                        ?>

                            <li <?php if($menu_activo): ?>class="active"<?php endif; ?>><a href="<?php echo $menu_link_categoria; ?>"<?php if( have_rows('submenu_item', 'option') ): ?> class="hasmenu" <?php endif; ?>><span data-hover="<?php echo $menu_item_titulo; ?>"><?php echo $menu_item_titulo; ?></span></a>

                                <?php if( have_rows('submenu_item', 'option') ): ?>

                                    <ul class="submenu">

                                    

                                        <?php while( have_rows('submenu_item', 'option') ) : the_row(); 

                                                

                                                $submenu_link = get_sub_field('submenu_link');


                                                if( get_term($submenu_link)):
                                                $submenu_titulo = get_term($submenu_link)->name;


                                                if(isset($submenu_link) and !empty($submenu_link)){

                                                    $submenu_link = get_term_link($submenu_link);

                                                }else{

                                                    $submenu_link = '#';

                                                }
                                                 endif;

                                                

                                        ?>

                                        <li><a href="<?php echo $submenu_link; ?>"><?php echo $submenu_titulo; ?></a></li>

                                        <?php endwhile; ?>

                                        <li><a href="<?php echo $menu_link_categoria; ?>" class="">Ver todo</a></li>

                                    </ul>

                                <?php endif; ?>

                        

                            </li>

                        <?php

                            endwhile; endif;

                        endwhile;

                        endif;

                        ?>

                        </ul>

                    </div>

                </div>

            </div>

        </div>

<!----------------------Menu movile------------------------------------>

        <?php $menuproductosid = null; ?>

        <div class="multi-mobile-menu">

            <div class="navmobile-container">

                

                <div class="nav-title"> 

                    <ul>

                        <li class="first-title-nav"><a class="text-white">¡Hola! <button id="cerrar-menu_mobile"><i data-feather="x" class="text-white"></i></button></a></li>



                        <?php

                        if( have_rows('menu_superior', 'option') ):

                            while( have_rows('menu_superior', 'option') ) : the_row();

                            if( have_rows('menu_item_superior', 'option') ):

                                $contadorNivelSuperior = 1;

                                while( have_rows('menu_item_superior', 'option') ) : the_row(); 

                                $menu_item_titulo = get_sub_field('menu_item_titulo');

                                $menu_item_link = get_sub_field('menu_item_link');

                                $menu_activo = get_sub_field('menu_activo');

                                if($menu_activo){

                                    $menuproductosid = $contadorNivelSuperior;

                                }

                        ?>

                        <?php if( have_rows('submenu_item', 'option') || $menu_activo ): ?>

                            <li><a href="" class="l1" value="<?php echo $contadorNivelSuperior; ?>"><?php echo $menu_item_titulo; ?> <span> ›</span></a></li>

                        <?php else: ?>

                            <li><a href="<?php echo $menu_item_link; ?>"><?php echo $menu_item_titulo; ?></a></li>

                        <?php endif; ?>

                        

                        <?php

                         $contadorNivelSuperior++;

                            endwhile; endif;

                        endwhile;

                        endif;

                        ?>



                        <li><a href="https://artefolk.cl/mayorista/" target="_blank">Mayorista</a></li>

                    </ul>

                </div>



                <?php

                        if( have_rows('menu_superior', 'option') ):

                            while( have_rows('menu_superior', 'option') ) : the_row();

                            if( have_rows('menu_item_superior', 'option') ):

                                $contadorNivelSuperior = 1;

                                while( have_rows('menu_item_superior', 'option') ) : the_row();

                                $menu_item_titulo = get_sub_field('menu_item_titulo');

                                $menu_item_link = get_sub_field('menu_item_link');

                                $menu_activo = get_sub_field('menu_activo');

                        ?>

                        <?php if( have_rows('submenu_item', 'option') ): ?>

                        <div class="layer1 side-menu hide" id="layer<?php echo $contadorNivelSuperior; ?>" style="height: 100%;" >

                            <ul data-value="<?php echo $contadorNivelSuperior; ?>">

                                <li class="first-volver-nav"><a href="#" class="nav-link l1" value="3" id="l<?php echo $contadorNivelSuperior; ?>">← volver</a></li>



                                

                                        <?php while( have_rows('submenu_item', 'option') ) : the_row(); 

                                                $submenu_titulo = get_sub_field('submenu_titulo');

                                                $submenu_link = get_sub_field('submenu_link');   

                                        ?>

                                        <li><a href="<?php echo $submenu_link; ?>"><?php echo $submenu_titulo; ?></a></li>

                                        <?php endwhile; ?>

                               

                            </ul>

                        </div>

                        <?php endif; ?>

                        <?php

                            $contadorNivelSuperior++;

                            endwhile; endif;

                            endwhile;

                            endif;

                        ?>



<!------------------------------------MENU PRODUCTOS PRIMER NIVEL------------------------>

                    <?php

                        if( have_rows('menu_productos', 'option') ):

                            while( have_rows('menu_productos', 'option') ) : the_row(); ?>

                    <div class="layer1 side-menu hide" id="layer<?php echo $menuproductosid; ?>" style="height: 100%;" >

                    <ul data-value="<?php echo $menuproductosid; ?>">

                    <li class="first-volver-nav"><a href="#" class="nav-link l1" value="3" id="l2">← volver</a></li>

                    <?php

                            if( have_rows('menu_item_superior', 'option') ):

                                while( have_rows('menu_item_superior', 'option') ) : the_row();

                                

                                $menu_item_link = get_sub_field('menu_item_link');

                                $menu_item_titulo = get_term($menu_item_link)->name;

                                $menu_activo = get_sub_field('menu_activo');

                                if(isset($menu_item_link) and !empty($menu_item_link)){

                                    $menu_link_categoria = get_term_link($menu_item_link);

                                }else{

                                    $menu_link_categoria = '#';

                                }

                        ?>

                            <li><a href="" class="l1" value="<?php echo $menu_item_link; ?>"><?php echo $menu_item_titulo; ?><span> ›</span></a></li>

                        <?php

                            endwhile; endif; ?>

                        </ul>

                        </div>

                        <?php

                        endwhile;

                        endif;

                        ?>

<!------------------------------------MENU PRODUCTOS SEGUNDO NIVEL------------------------>



                        <?php

                        if( have_rows('menu_productos', 'option') ):

                            while( have_rows('menu_productos', 'option') ) : the_row();

                            if( have_rows('menu_item_superior', 'option') ):

                                while( have_rows('menu_item_superior', 'option') ) : the_row();

                                

                                $menu_item_link = get_sub_field('menu_item_link');

                                $menu_item_titulo = get_term($menu_item_link)->name;

                                $menu_activo = get_sub_field('menu_activo');

                                if(isset($menu_item_link) and !empty($menu_item_link)){

                                    $menu_link_categoria = get_term_link($menu_item_link);

                                }else{

                                    $menu_link_categoria = '#';

                                }

                        ?>

                        <div class="layer2 side-menu hide" id="layer<?php echo $menu_item_link; ?>">

                                <?php if( have_rows('submenu_item', 'option') ): ?>

                                    <ul>

                                    

                                        <?php while( have_rows('submenu_item', 'option') ) : the_row(); 

                                                

                                                $submenu_link = get_sub_field('submenu_link');


                                                if( get_term($submenu_link)):
                                                $submenu_titulo = get_term($submenu_link)->name;

                                                if(isset($submenu_link) and !empty($submenu_link)){

                                                    $submenu_link = get_term_link($submenu_link);

                                                }else{

                                                    $submenu_link = '#';

                                                }
                                            endif;

                                                

                                        ?>

                                        <li><a href="<?php echo $submenu_link; ?>"><?php echo $submenu_titulo; ?></a></li>

                                        <?php endwhile; ?>

                                        <li><a href="<?php echo $menu_link_categoria; ?>" class="">Ver todo</a></li>

                                    </ul>

                                <?php endif; ?>

                        </div>

                        <?php

                            endwhile; endif;

                        endwhile;

                        endif;

                        ?>

            </div>

        </div>

    </header>

    

   