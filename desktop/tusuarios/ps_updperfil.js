$(document).ready(function() {
    $(function() {
        $(".preloader").fadeOut();
    });


    $('#formperfil').submit(function()
        {
            submitPerfil();
            return false;
        }
    );

    $('#formcuenta').submit(function()
        {
            submitCuenta();
            return false;
        }
    );

    $('#formpass').submit(function()
        {
            submitPass();
            return false;
        }
    );

});


function submitPerfil(){

    $.ajax({
        url: 'tusuarios/ps_updperfil.php',
        type: 'POST',
        encoding:"UTF-8",
        data: $('#formperfil').serialize(),
        dataType: 'json'
    })

        .done(function(data){
            // cargar - loading
            $(".preloader").fadeIn();
            // boton - msg
            $('#btn_perfil').html('<img src="ajax-loader.gif" /> &nbsp; Actualizando...').prop('disabled', true);

            setTimeout(function(){

                if ( data.status==='success' ) {
                    $(".preloader").fadeOut();  // desvanece preloader
                    //$("#formperfil").trigger('reset'); // resetea campos
                    // boton - texto - OK
                    $('#btn_perfil').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp;  Actualizado...').prop('disabled', false);

                    // mensaje OK
                    // para el msg abajo
                    $('#r_resultOkDiv').slideDown('fast', function(){
                        $('#r_resultOkDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
                    // redireccionar a login
                    //setTimeout(function(){window.location.href=data.URL} , 5500);
                    // para el debug
                    //$('#r_resultDebDiv').slideDown('fast', function(){
                    //    $('#r_resultDebDiv').html('<i class="ti-user"></i> '+data.debug+' <a href="#" class="closed">&times;</a> ');
                    //});
                   // $('#alerttopright').slideDown('fast', function(){
                   //     $('#alerttopright').html(data.debug+' <a href="#" class="closed">&times;</a> ');
                   // }).delay(6000).slideUp('fast');


                    // alerta de confirmacion
                    //Success Message
                    //swal("Felicidades!", "Ahora solo resta ingresar a tu correo y confirmar tu usuario. Gracias.", "success");

                } else {
                    $(".preloader").fadeOut(); // desvanece preloader
                    // boton - texto - ERROR
                    $('#btn_perfil').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Intente nuevamente...').prop('disabled', false);
                    // mensaje ERROR
                    // para el msg abajo
                    $('#r_resultErrDiv').slideDown('fast', function(){
                        $('#r_resultErrDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
                    // para el debug
                    //$('#r_resultDebDiv').slideDown('fast', function(){
                    //    $('#r_resultDebDiv').html('<i class="ti-user"></i> '+data.debug+' <a href="#" class="closed">&times;</a> ');
                    //});
                   // $('#alerttopright').slideDown('fast', function(){
                   //     $('#alerttopright').html(data.debug+' <a href="#" class="closed">&times;</a> ');
                   // }).delay(6000).slideUp('fast');

                }

            },3000);

        })
        .fail(function(){
            // $("#loginform").trigger('reset');
            alert('An unknown error occoured, Please try again Later...');
        });
}

function submitCuenta(){

    $.ajax({
        url: 'tusuarios/ps_updcuenta.php',
        type: 'POST',
        encoding:"UTF-8",
        data: $('#formcuenta').serialize(),
        dataType: 'json'
    })

        .done(function(data){
            // cargar - loading
            $(".preloader").fadeIn();
            // boton - msg
            $('#btn_cuenta').html('<img src="ajax-loader.gif" /> &nbsp; Actualizando...').prop('disabled', true);

            setTimeout(function(){

                if ( data.status==='success' ) {
                    $(".preloader").fadeOut();  // desvanece preloader
                    //$("#formcuenta").trigger('reset'); // resetea campos
                    // boton - texto - OK
                    $('#btn_cuenta').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp;  Actualizado...').prop('disabled', false);

                    // mensaje OK
                    // para el msg abajo
                    $('#r_resultOkDiv').slideDown('fast', function(){
                        $('#r_resultOkDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
                    // redireccionar a login
                    //setTimeout(function(){window.location.href=data.URL} , 5500);
                    // para el debug
                    //$('#r_resultDebDiv').slideDown('fast', function(){
                    //    $('#r_resultDebDiv').html('<i class="ti-user"></i> '+data.debug+' <a href="#" class="closed">&times;</a> ');
                    //});
                   // $('#alerttopright').slideDown('fast', function(){
                    //    $('#alerttopright').html(data.debug+' <a href="#" class="closed">&times;</a> ');
                   // }).delay(6000).slideUp('fast');


                    // alerta de confirmacion
                    //Success Message
                    //swal("Felicidades!", "Ahora solo resta ingresar a tu correo y confirmar tu usuario. Gracias.", "success");

                } else {
                    $(".preloader").fadeOut(); // desvanece preloader
                    // boton - texto - ERROR
                    $('#btn_cuenta').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Intente nuevamente...').prop('disabled', false);
                    // mensaje ERROR
                    // para el msg abajo
                    $('#r_resultErrDiv').slideDown('fast', function(){
                        $('#r_resultErrDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
                    // para el debug
                    //$('#r_resultDebDiv').slideDown('fast', function(){
                    //    $('#r_resultDebDiv').html('<i class="ti-user"></i> '+data.debug+' <a href="#" class="closed">&times;</a> ');
                    //});
                   // $('#alerttopright').slideDown('fast', function(){
                    //    $('#alerttopright').html(data.debug+' <a href="#" class="closed">&times;</a> ');
                   // }).delay(6000).slideUp('fast');

                }

            },3000);

        })
        .fail(function(){
            // $("#loginform").trigger('reset');
            alert('An unknown error occoured, Please try again Later...');
        });
}

function submitPass(){

    $.ajax({
        url: 'tusuarios/ps_updpass.php',
        type: 'POST',
        encoding:"UTF-8",
        data: $('#formpass').serialize(),
        dataType: 'json'
    })

        .done(function(data){
            // cargar - loading
            $(".preloader").fadeIn();
            // boton - msg
            $('#btn_pass').html('<img src="ajax-loader.gif" /> &nbsp; Actualizando...').prop('disabled', true);

            setTimeout(function(){

                if ( data.status==='success' ) {
                    $(".preloader").fadeOut();  // desvanece preloader
                    $("#formpass").trigger('reset'); // resetea campos
                    // boton - texto - OK
                    $('#btn_pass').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp;  Actualizado...').prop('disabled', false);

                    // mensaje OK
                    // para el msg abajo
                    $('#r_resultOkDiv').slideDown('fast', function(){
                        $('#r_resultOkDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
                    // redireccionar a login
                    //setTimeout(function(){window.location.href=data.URL} , 5500);
                    // para el debug
                    //$('#r_resultDebDiv').slideDown('fast', function(){
                    //    $('#r_resultDebDiv').html('<i class="ti-user"></i> '+data.debug+' <a href="#" class="closed">&times;</a> ');
                    //});
                    //$('#alerttopright').slideDown('fast', function(){
                    //    $('#alerttopright').html(data.debug+' <a href="#" class="closed">&times;</a> ');
                    //}).delay(6000).slideUp('fast');


                    // alerta de confirmacion
                    //Success Message
                    //swal("Felicidades!", "Ahora solo resta ingresar a tu correo y confirmar tu usuario. Gracias.", "success");

                } else {
                    $(".preloader").fadeOut(); // desvanece preloader
                    // boton - texto - ERROR
                    $('#btn_pass').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Intente nuevamente...').prop('disabled', false);
                    // mensaje ERROR
                    // para el msg abajo
                    $('#r_resultErrDiv').slideDown('fast', function(){
                        $('#r_resultErrDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
                    // para el debug
                    //$('#r_resultDebDiv').slideDown('fast', function(){
                    //    $('#r_resultDebDiv').html('<i class="ti-user"></i> '+data.debug+' <a href="#" class="closed">&times;</a> ');
                    //});
                    //$('#alerttopright').slideDown('fast', function(){
                    //    $('#alerttopright').html(data.debug+' <a href="#" class="closed">&times;</a> ');
                    //}).delay(6000).slideUp('fast');

                }

            },3000);

        })
        .fail(function(){
            // $("#loginform").trigger('reset');
            alert('An unknown error occoured, Please try again Later...');
        });
}