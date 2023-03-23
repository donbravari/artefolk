jQuery(document).ready(function(){
    let sliderCurso = jQuery("#cursos-destacados");
    if(sliderCurso.length > 0){
        sliderCurso.owlCarousel({
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

    jQuery(".accordeon-temario .header-accordeon").click(function(){
        jQuery(this).toggleClass("active");
        jQuery(this).parent().find(".content-accordeon").slideToggle();
    })
    if(jQuery('.datepicker').length > 0){
    jQuery('.datepicker').datepicker({dateFormat: 'dd/mm/yy', changeMonth: true, changeYear: true, yearRange: '-100:+0'});
}

    let formcurso = jQuery("#form-cursos-inscripcion");
    if(formcurso.length > 0){

        function comprobacion(){
            let currentCurrency = jQuery("input[name='forma-pago']:checked").val();
            if(todosCompletados()){
                jQuery(".nocomplete-alert").hide();
                switch(currentCurrency){
                    case 'USD':
                    jQuery('button#submit-pago').hide();
                    jQuery("#paypal-button").show();
                    break;

                    case 'CLP':
                    jQuery("#paypal-button").hide();
                     jQuery('button#submit-pago').show();
                     break;

                     case 'CLP_mensual':
                    jQuery("#paypal-button").hide();
                     jQuery('button#submit-pago').show();
                     break;
                }
            }
            else{
                jQuery('button#submit-pago').hide();
                    jQuery("#paypal-button").hide();
                    jQuery(".nocomplete-alert").show();
            }
        }
        setInterval(comprobacion, 500);

        //jQuery("#kit-holder").hide();
        jQuery("#paypal-button").hide();
        jQuery("input[name='forma-pago']").change(function(){
            let currentCurrency = jQuery("input[name='forma-pago']:checked").val();
            jQuery(".currency-holder label").each(function(){
                jQuery(this).removeClass("active");
            })
            jQuery(this).parent().addClass("active");
            switch(currentCurrency){
                case 'USD':
                    jQuery("#price-holder").html("<p>USD$"+jQuery("input[name='forma-pago']:checked").data("precio")+"</p>");
                    jQuery("#kit-holder").hide();
                    //jQuery("#paypal-button").show();
                    //jQuery('button[type="submit"]').hide();
                    jQuery("#total-sale").val(jQuery("input[name='forma-pago']:checked").data("precio"));
                break;

                case 'CLP':
                    //jQuery("#paypal-button").hide();
                    //jQuery('button[type="submit"]').show();
                    var valorKit = jQuery("input[name='incluye-kit']:checked").data("precio");
                    if(!valorKit){
                        valorKit = 0;
                    }
                    var totalClp = (jQuery("input[name='forma-pago']:checked").data("precio") + valorKit).toLocaleString('es-CL');
                    jQuery("#price-holder").html("<p>$"+totalClp+"</p>");
                    jQuery("#kit-holder").show();
                    jQuery("#total-sale").val(jQuery("input[name='forma-pago']:checked").data("precio") + valorKit);
                break;

                case 'CLP_mensual':
                    //jQuery("#paypal-button").hide();
                    //jQuery('button[type="submit"]').show();
                    var valorKit = jQuery("input[name='incluye-kit']:checked").data("precio");
                    if(!valorKit){
                        valorKit = 0;
                    }
                    var totalClp = (jQuery("input[name='forma-pago']:checked").data("precio") + valorKit).toLocaleString('es-CL');
                    jQuery("#price-holder").html("<p>$"+totalClp+"</p>");
                    jQuery("#kit-holder").show();
                    jQuery("#total-sale").val(jQuery("input[name='forma-pago']:checked").data("precio") + valorKit);
                break;
            }
        })
        jQuery("input[name='incluye-kit']").change(function(){
            let valorKit = jQuery("input[name='incluye-kit']:checked").data("precio");
            if(!valorKit){
                valorKit = 0;
            }
            let totalClp = (jQuery("input[name='forma-pago']:checked").data("precio") + valorKit).toLocaleString('es-CL');
            jQuery("#price-holder").html("<p>$"+totalClp+"</p>");
            jQuery("#total-sale").val(jQuery("input[name='forma-pago']:checked").data("precio") + valorKit);
        })

        
        jQuery('body').on('click', 'button#submit-pago', function(e){
            e.preventDefault();
            jQuery("input, select").each(function(){
                jQuery(this).removeClass("error-input")
            })
            let ok = true;
            let nombre = jQuery('input[name="name"]');
            let mail = jQuery('input[name="mail"]');
            let phone = jQuery('input[name="phone"]');
            let fechnacimiento = jQuery('input[name="fechnacimiento"]');
            let ocupacion = jQuery('input[name="ocupacion"]');
            let referido = jQuery('select[name="referido"] option:selected');
            let valor = jQuery('select[name="forma-pago"]');
            let name_course = jQuery('input[name="name_course"]');
            let total_sale = jQuery('input[name="total-sale"]');
            let orderNumber = jQuery('input[name="order_number"]');

            if(nombre.val() == ''){
                nombre.addClass("error-input");
                ok = false;
            }
            if(mail.val() == ''){
                mail.addClass("error-input");
                ok = false;
            }
            if(phone.val() == ''){
                phone.addClass("error-input");
                ok = false;
            }
            if(fechnacimiento.val() == ''){
                fechnacimiento.addClass("error-input");
                ok = false;
            }
            if(ocupacion.val() == ''){
                ocupacion.addClass("error-input");
                ok = false;
            }
            if(referido.val() == ''){
                jQuery('select[name="referido"]').addClass("error-input");
                ok = false;
            }
            if(ok){
                console.log("enviando...");
                var onkit = $('input[name="incluye-kit"]').prop('checked');
                const cdata = {
                    name:nombre.val(),
                    mail:mail.val(),
                    phone:phone.val(),
                    fechnacimiento:fechnacimiento.val(),
                    ocupacion:ocupacion.val(),
                    referido:referido.val(),
                    name_course:name_course.val(),
                    total_sale:total_sale.val(),
                    ins_state: '0',
                    order_number: orderNumber.val(),
                    kit: onkit
                }
                 jQuery.ajax({
                    data:  cdata, //datos que se envian a traves de ajax
                    url:   '/wp-content/themes/tm-organie-child/write-curso.php', //archivo que recibe la peticion
                    type:  'post', //método de envio
                    success:  function (response) {
                          console.log(response);
                          if(response == "1"){
                                let currentCurrency = jQuery("input[name='forma-pago']:checked").val();
                                switch(currentCurrency){
                                    case 'USD':
                                        jQuery("#inscripcion-curso").attr('action', '/wp-content/themes/tm-organie-child/paypal.php');
                                        jQuery("#inscripcion-curso").submit();
                                    break;
                                    case 'CLP':
                                        jQuery("#inscripcion-curso").attr('action', '/wp-content/themes/tm-organie-child/gotopay.php');
                                        jQuery("#inscripcion-curso").submit();
                                    break;
                                    case 'CLP_mensual':
                                        jQuery("#inscripcion-curso").attr('action', '/wp-content/themes/tm-organie-child/gotopay.php');
                                        jQuery("#inscripcion-curso").submit();
                                    break;
                                }
                          }else{
                            console.log("Ha ocurrido un error")
                          }
                      }
                });
                
            }
        })
    }
})

function todosCompletados(){
            let nombre = jQuery('input[name="name"]');
            let mail = jQuery('input[name="mail"]');
            let phone = jQuery('input[name="phone"]');
            let fechnacimiento = jQuery('input[name="fechnacimiento"]');
            let ocupacion = jQuery('input[name="ocupacion"]');
            let referido = jQuery('select[name="referido"] option:selected');
            let valor = jQuery('select[name="forma-pago"]');

            if(nombre.val() == ''){
                return false;
            }
            if(mail.val() == ''){
                return false;
            }
            if(phone.val() == ''){
                return false;
            }
            if(fechnacimiento.val() == ''){
                return false;
            }
            if(ocupacion.val() == ''){
                return false;
            }
            if(referido.val() == ''){
                return false;
            }
            return true;
}