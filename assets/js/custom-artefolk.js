jQuery(document).ready(function($)
{

    $("#search-products .searchform-group input").keyup(function() {
        var searchTerm = $(this).val();
        if(searchTerm.length > 2){
            $.ajax({
            url: wc_ajax_params.url,
            type: "POST",
            data: {
                action: "search_products",
                term: searchTerm
            },
            dataType: "json",
            success: function(result) {
                // Procesar los resultados aquí
                console.log(result);
            }
            });
        }
      });



        if( $('ul').hasClass('sub-menu') )
        {
        var parent = $('ul.navbar-nav .sub-menu').parent();
        $('ul.navbar-nav .sub-menu').addClass('dropdown-menu bg-dark');
            parent.addClass('dropdown');
            parent.children(':first-child').attr({'href': '#', 'class': 'nav-link dropdown-toggle', 'data-toggle': 'dropdown'});
        }

        $('.l1').on('click',function(e){
            e.preventDefault();
            var tag = $(this).attr('value');
            var tag1 = $(this).text();
           // window.alert("#layer"+tag1);
           var back_link="#layer"+tag;
           //window.alert(back_link);
          $('header .nav-link').attr('href',back_link);
           //$('.nav-link').text(tag1);
           $('header .nav-link').attr('value',tag);
           $("#layer"+tag).removeClass('hide-menu'); 
            $("#layer"+tag).toggleClass('show-menu'); 
       });
       $('header .nav-link').on('click',function(e){
            e.preventDefault();
           var tag = $(this).attr('href');
           var val= $(this).attr('value');
           // window.alert(val);
            $(tag).removeClass('show-menu'); 
            if(val > 3){
                val = 3;
            }
            var back_link="#layer"+(val-1);
            $('header .nav-link').attr('href',back_link);
           $('header .nav-link').attr('value',val-1);
           //window.alert(back_link);
           
       });
       $("#show-menu-mobile, #show_menu_bar").click(function(e){
        e.preventDefault();
        $(".navmobile-container").toggleClass("activo");
        $("#sticky_mobile").removeClass("activo");
       })
       $("#cerrar-menu_mobile").click(function(e){
        e.preventDefault();
        $(".navmobile-container").removeClass("activo");
        $("#sticky_mobile").addClass("activo");
       })

       var carouselcategoria = $("#carousel-categorias");
        carouselcategoria.owlCarousel({
        loop:true,
        margin:0,
        responsiveClass:true,
        dots: false,
        nav: false,
        autoplay:true,
        autoplayTimeout:4000,
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:4,
            },
            768:{
                items:5,
            },
            1000:{
                items:6,
                margin:10,
            }
        }

        
        })
        var carruselTerapias = $("#carrusel-terapias");
        carruselTerapias.owlCarousel({
            loop:true,
            margin:30,
            responsiveClass:true,
            dots: false,
            nav: false,
            center:true,
            autoplay:true,
            autoplayTimeout:8000,
            autoplayHoverPause:true,
            responsive:{
                0:{
                    items:1,
                    center:false,
                },
                768:{
                    items:2,
                },
                1000:{
                    items:4,
                    margin:30,
                }
            }
        })

        var carruselCursos = $("#cursos-destacados");
        if(carruselCursos.length > 0){
            carruselCursos.owlCarousel({
                loop:true,
                margin:0,
                nav:true,
                navText: ["<span></span>","<span></span>"],
                items:1,
                autoplay:true,
                autoplayTimeout:8000,
                autoplayHoverPause:true,
            })
        } 
        makeornotowl();
        window.onresize = function(){
            makeornotowl();
        }
        
    
});

function makeornotowl(){
    var carruselTerapias = $("#blog-home");
    if (window.matchMedia("(max-width: 767px)").matches) {
        
        carruselTerapias.removeClass("row");
        carruselTerapias.addClass("owl-carousel owl-theme");
        carruselTerapias.owlCarousel({
            loop:true,
            margin:30,
            responsiveClass:true,
            dots: true,
            center:true,
            nav: false,
            center:true,
            autoplay:true,
            autoplayTimeout:8000,
            autoplayHoverPause:true,
            responsive:{
                0:{
                    items:1,
                    center:false,
                }
            }
        })
    }else{
        carruselTerapias.owlCarousel('destroy');
        carruselTerapias.addClass("row");
        carruselTerapias.removeClass("owl-carousel owl-theme");
    }
}

function gotosearch(){
    $("html, body").animate({
        scrollTop: $("#search-products").offset().top - 100
      }, 1000); 

      $("#search-products .searchform-group input").focus();
}

