$(document).ready(function() {
    $(function() {
        $(".preloader").fadeOut();
        getnall();
    });


    $('#formGenerales').submit(function()
        {
            goGenerales();
            return false;
        }
    );

    $('#formFiscales').submit(function()
        {
            goFiscales();
            return false;
        }
    );

    $('#formInversion').submit(function()
        {
            goInversion();
            return false;
        }
    );

    $('#formBancarios').submit(function()
        {
            goBancarios();
            return false;
        }
    );

    $('#formIdea').submit(function()
        {
            goIdea();
            return false;
        }
    );

    $('#formProducto').submit(function()
        {
            goProducto();
            return false;
        }
    );

    $('#formCompetencia').submit(function()
        {
            goCompetencia();
            return false;
        }
    );

    $('#formMercado').submit(function()
        {
            goMercado();
            return false;
        }
    );

    $('#formNegocio').submit(function()
        {
            goNegocio();
            return false;
        }
    );

    $('#formFuente').submit(function()
        {
            goFuente();
            return false;
        }
    );

    $('#formCostos').submit(function()
        {
            goCostos();
            return false;
        }
    );

    $('#formHistoria').submit(function()
        {
            goHistoria();
            return false;
        }
    );

    $('#formEquipo').submit(function()
        {
            goEquipo();
            return false;
        }
    );

    $('#formRiesgos').submit(function()
        {
            goRiesgos();
            return false;
        }
    );

    $('#formPlan').submit(function()
        {
            goPlan();
            return false;
        }
    );


    //proyecto listo
    $('#formListo').submit(function()
        {
            goListo();
            return false;
        }
    );


    //proyecto listo
    $('#formAprobar').submit(function()
        {
            goAprobar();
            return false;
        }
    );

    //proyecto listo
    $('#formRechazar').submit(function()
        {
            goRechazar();
            return false;
        }
    );

});



function goGenerales(){

    $.ajax({
        url: 'tproyectos/ps_generales.php',
        type: 'POST',
        encoding:"UTF-8",
        data: $('#formGenerales').serialize(),
        dataType: 'json'
    })

        .done(function(data){
            // cargar - loading
            $(".preloader").fadeIn();
            // boton - msg
            $('#btn-cg').html('<img src="ajax-loader.gif" /> &nbsp; Registrando...').prop('disabled', true);

            setTimeout(function(){

                if ( data.status==='success' ) {
                    $(".preloader").fadeOut();  // desvanece preloader
                    //$("#formGenerales").trigger('reset'); // resetea campos
                    // boton - texto - OK
                    $('#btn-cg').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registro exitoso...').prop('disabled', false);
                    // mensaje OK
                    // para el msg abajo
                    $('#r_resultOkDiv').slideDown('fast', function(){
                        $('#r_resultOkDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
                    // grafica de avance
                    $('#graf-generales').html(data.grafica);
                    $('#graf_total').html(data.graf_total);

                    // para el debug
                    //$('#alerttopright').slideDown('fast', function(){
                    //    $('#alerttopright').html(data.debug+' <a href="#" class="closed">&times;</a> ');
                    //}).delay(6000).slideUp('fast');
                } else {
                    $(".preloader").fadeOut(); // desvanece preloader
                    // boton - texto - ERROR
                    $('#btn-cg').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Intente nuevamente...').prop('disabled', false);
                    // mensaje ERROR
                    // para el msg abajo
                    $('#r_resultErrDiv').slideDown('fast', function(){
                        $('#r_resultErrDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
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

function goFiscales(){
    $.ajax({
        url: 'tproyectos/ps_fiscales.php',
        type: 'POST',
        encoding:"UTF-8",
        data: $('#formFiscales').serialize(),
        dataType: 'json'
    })

        .done(function(data){
            // cargar - loading
            $(".preloader").fadeIn();
            // boton - msg
            $('#btn-cf').html('<img src="ajax-loader.gif" /> &nbsp; Registrando...').prop('disabled', true);

            setTimeout(function(){

                if ( data.status==='success' ) {
                    $(".preloader").fadeOut();  // desvanece preloader
                    //$("#formGenerales").trigger('reset'); // resetea campos
                    // boton - texto - OK
                    $('#btn-cf').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registro exitoso...').prop('disabled', false);
                    // mensaje OK

                    // para el msg abajo
                    $('#r_resultOkDiv').slideDown('fast', function(){
                        $('#r_resultOkDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
                    // grafica de avance
                    $('#graf-fiscales').html(data.grafica);
                    $('#graf_total').html(data.graf_total);

                    // para el debug
                    //$('#alerttopright').slideDown('fast', function(){
                    //    $('#alerttopright').html(data.debug+' <a href="#" class="closed">&times;</a> ');
                    //}).delay(6000).slideUp('fast');
                } else {
                    $(".preloader").fadeOut(); // desvanece preloader
                    // boton - texto - ERROR
                    $('#btn-cf').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Intente nuevamente...').prop('disabled', false);
                    // mensaje ERROR

                    // para el msg abajo
                    $('#r_resultErrDiv').slideDown('fast', function(){
                        $('#r_resultErrDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
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

function goInversion(){
    $.ajax({
        url: 'tproyectos/ps_inversion.php',
        type: 'POST',
        encoding:"UTF-8",
        data: $('#formInversion').serialize(),
        dataType: 'json'
    })

        .done(function(data){
            // cargar - loading
            $(".preloader").fadeIn();
            // boton - msg
            $('#btn-ci').html('<img src="ajax-loader.gif" /> &nbsp; Registrando...').prop('disabled', true);

            setTimeout(function(){

                if ( data.status==='success' ) {
                    $(".preloader").fadeOut();  // desvanece preloader
                    //$("#formGenerales").trigger('reset'); // resetea campos
                    // boton - texto - OK
                    $('#btn-ci').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registro exitoso...').prop('disabled', false);
                    // mensaje OK

                    // para el msg abajo
                    $('#r_resultOkDiv').slideDown('fast', function(){
                        $('#r_resultOkDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');

                    // grafica de avance
                    $('#graf-inversion').html(data.grafica);
                    $('#graf_total').html(data.graf_total);

                    // para el debug
                    //$('#alerttopright').slideDown('fast', function(){
                    //    $('#alerttopright').html(data.debug+' <a href="#" class="closed">&times;</a> ');
                    //}).delay(6000).slideUp('fast');
                } else {
                    $(".preloader").fadeOut(); // desvanece preloader
                    // boton - texto - ERROR
                    $('#btn-ci').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Intente nuevamente...').prop('disabled', false);
                    // mensaje ERROR

                    // para el msg abajo
                    $('#r_resultErrDiv').slideDown('fast', function(){
                        $('#r_resultErrDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
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

function goBancarios(){
    $.ajax({
        url: 'tproyectos/ps_bancarios.php',
        type: 'POST',
        encoding:"UTF-8",
        data: $('#formBancarios').serialize(),
        dataType: 'json'
    })

        .done(function(data){
            // cargar - loading
            $(".preloader").fadeIn();
            // boton - msg
            $('#btn-cb').html('<img src="ajax-loader.gif" /> &nbsp; Registrando...').prop('disabled', true);

            setTimeout(function(){

                if ( data.status==='success' ) {
                    $(".preloader").fadeOut();  // desvanece preloader
                    //$("#formGenerales").trigger('reset'); // resetea campos
                    // boton - texto - OK
                    $('#btn-cb').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registro exitoso...').prop('disabled', false);
                    // mensaje OK

                    // para el msg abajo
                    $('#r_resultOkDiv').slideDown('fast', function(){
                        $('#r_resultOkDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
                    // grafica de avance
                    $('#graf-bancarios').html(data.grafica);
                    $('#graf_total').html(data.graf_total);

                    // para el debug
                    //$('#alerttopright').slideDown('fast', function(){
                    //    $('#alerttopright').html(data.debug+' <a href="#" class="closed">&times;</a> ');
                    //}).delay(6000).slideUp('fast');
                } else {
                    $(".preloader").fadeOut(); // desvanece preloader
                    // boton - texto - ERROR
                    $('#btn-cb').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Intente nuevamente...').prop('disabled', false);
                    // mensaje ERROR

                    // para el msg abajo
                    $('#r_resultErrDiv').slideDown('fast', function(){
                        $('#r_resultErrDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
                    //$('#alerttopright').slideDown('fast', function(){
                        $('#alerttopright').html(data.debug+' <a href="#" class="closed">&times;</a> ');
                    //}).delay(6000).slideUp('fast');
                }

            },3000);

        })
        .fail(function(){
            // $("#loginform").trigger('reset');
            alert('An unknown error occoured, Please try again Later...');
        });
}

function goIdea(){
    $.ajax({
        url: 'tproyectos/ps_idea.php',
        type: 'POST',
        encoding:"UTF-8",
        data: $('#formIdea').serialize(),
        dataType: 'json'
    })

        .done(function(data){
            // cargar - loading
            $(".preloader").fadeIn();
            // boton - msg
            $('#btn-cp').html('<img src="ajax-loader.gif" /> &nbsp; Registrando...').prop('disabled', true);

            setTimeout(function(){

                if ( data.status==='success' ) {
                    $(".preloader").fadeOut();  // desvanece preloader
                    //$("#formGenerales").trigger('reset'); // resetea campos
                    // boton - texto - OK
                    $('#btn-cp').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registro exitoso...').prop('disabled', false);
                    // mensaje OK

                    // para el msg abajo
                    $('#r_resultOkDiv').slideDown('fast', function(){
                        $('#r_resultOkDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
                    // grafica de avance
                    $('#graf-idea').html(data.grafica);
                    $('#graf_total').html(data.graf_total);

                    // para el debug
                    //$('#alerttopright').slideDown('fast', function(){
                    //    $('#alerttopright').html(data.debug+' <a href="#" class="closed">&times;</a> ');
                    //}).delay(6000).slideUp('fast');
                } else {
                    $(".preloader").fadeOut(); // desvanece preloader
                    // boton - texto - ERROR
                    $('#btn-cp').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Intente nuevamente...').prop('disabled', false);
                    // mensaje ERROR

                    // para el msg abajo
                    $('#r_resultErrDiv').slideDown('fast', function(){
                        $('#r_resultErrDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
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

function goProducto(){
    $.ajax({
        url: 'tproyectos/ps_producto.php',
        type: 'POST',
        encoding:"UTF-8",
        data: $('#formProducto').serialize(),
        dataType: 'json'
    })

        .done(function(data){
            // cargar - loading
            $(".preloader").fadeIn();
            // boton - msg
            $('#btn-cid').html('<img src="ajax-loader.gif" /> &nbsp; Registrando...').prop('disabled', true);

            setTimeout(function(){

                if ( data.status==='success' ) {
                    $(".preloader").fadeOut();  // desvanece preloader
                    //$("#formGenerales").trigger('reset'); // resetea campos
                    // boton - texto - OK
                    $('#btn-cid').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registro exitoso...').prop('disabled', false);
                    // mensaje OK

                    // para el msg abajo
                    $('#r_resultOkDiv').slideDown('fast', function(){
                        $('#r_resultOkDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
                    // grafica de avance
                    $('#graf-producto').html(data.grafica);
                    $('#graf_total').html(data.graf_total);

                    // para el debug
                    //$('#alerttopright').slideDown('fast', function(){
                    //    $('#alerttopright').html(data.debug+' <a href="#" class="closed">&times;</a> ');
                    //}).delay(6000).slideUp('fast');
                } else {
                    $(".preloader").fadeOut(); // desvanece preloader
                    // boton - texto - ERROR
                    $('#btn-cid').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Intente nuevamente...').prop('disabled', false);
                    // mensaje ERROR

                    // para el msg abajo
                    $('#r_resultErrDiv').slideDown('fast', function(){
                        $('#r_resultErrDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
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

function goCompetencia(){
    $.ajax({
        url: 'tproyectos/ps_competencia.php',
        type: 'POST',
        encoding:"UTF-8",
        data: $('#formCompetencia').serialize(),
        dataType: 'json'
    })

        .done(function(data){
            // cargar - loading
            $(".preloader").fadeIn();
            // boton - msg
            $('#btn-cc').html('<img src="ajax-loader.gif" /> &nbsp; Registrando...').prop('disabled', true);

            setTimeout(function(){

                if ( data.status==='success' ) {
                    $(".preloader").fadeOut();  // desvanece preloader
                    //$("#formGenerales").trigger('reset'); // resetea campos
                    // boton - texto - OK
                    $('#btn-cc').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registro exitoso...').prop('disabled', false);
                    // mensaje OK

                    // para el msg abajo
                    $('#r_resultOkDiv').slideDown('fast', function(){
                        $('#r_resultOkDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
                    // grafica de avance
                    $('#graf-competencia').html(data.grafica);
                    $('#graf_total').html(data.graf_total);

                    // para el debug
                    //$('#alerttopright').slideDown('fast', function(){
                    //     $('#alerttopright').html(data.debug+' <a href="#" class="closed">&times;</a> ');
                    //}).delay(6000).slideUp('fast');

                    // datos del grid
                    var db2 = {

                        loadData: function(filter) {
                            return $.grep(this.hola, function(hol) {
                                return ((!filter.Competidor || hol.Competidor === filter.Competidor));
                            });
                        },
                    };
                    window.db2 = db2;

                    db2.hola = data.informacion;
                    //$('#resDiv').html(data.result);
                    // aqui pinto los resultados de la tabla
                    $("#gridcompetencia").jsGrid({
                        height: "300px",
                        width: "100%",
                        sorting: !0,
                        paging: !0,
                        data: db2.hola,
                        fields: [{
                            name: "Competidor",
                            type: "text",
                            width: 140
                        }, {
                            name: "Diferenciador",
                            type: "text",
                            width: 80
                        }, {
                            name: "Propuesta",
                            type: "text",
                            width: 200
                        }]
                    });

                } else {
                    $(".preloader").fadeOut(); // desvanece preloader
                    // boton - texto - ERROR
                    $('#btn-cc').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Intente nuevamente...').prop('disabled', false);
                    // mensaje ERROR

                    // para el msg abajo
                    $('#r_resultErrDiv').slideDown('fast', function(){
                        $('#r_resultErrDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
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

function goMercado(){
    $.ajax({
        url: 'tproyectos/ps_mercado.php',
        type: 'POST',
        encoding:"UTF-8",
        data: $('#formMercado').serialize(),
        dataType: 'json'
    })

        .done(function(data){
            // cargar - loading
            $(".preloader").fadeIn();
            // boton - msg
            $('#btn-cm').html('<img src="ajax-loader.gif" /> &nbsp; Registrando...').prop('disabled', true);

            setTimeout(function(){

                if ( data.status==='success' ) {
                    $(".preloader").fadeOut();  // desvanece preloader
                    //$("#formGenerales").trigger('reset'); // resetea campos
                    // boton - texto - OK
                    $('#btn-cm').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registro exitoso...').prop('disabled', false);
                    // mensaje OK

                    // para el msg abajo
                    $('#r_resultOkDiv').slideDown('fast', function(){
                        $('#r_resultOkDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
                    // grafica de avance
                    $('#graf-mercado').html(data.grafica);
                    $('#graf_total').html(data.graf_total);

                    // para el debug
                    //$('#alerttopright').slideDown('fast', function(){
                    //    $('#alerttopright').html(data.debug+' <a href="#" class="closed">&times;</a> ');
                    //}).delay(6000).slideUp('fast');
                    //getCompetencia();
                    var dbmercado = {

                        loadData: function(filter) {
                            return $.grep(this.dmercado, function(hol) {
                                return ((!filter.Competidor || hol.Competidor === filter.Competidor));
                            });
                        },
                    };

                    window.dbmercado = dbmercado;

                    dbmercado.dmercado = data.informacion;

                    // aqui pinto los resultados de la tabla
                    $("#gridobjetivos").jsGrid({
                        height: "300px",
                        width: "100%",
                        sorting: !0,
                        paging: !0,
                        data: dbmercado.dmercado,
                        fields: [{
                            name: "Cliente",
                            type: "text",
                            width: 140
                        }, {
                            name: "Segmento",
                            type: "text",
                            width: 80
                        }, {
                            name: "Mercado",
                            type: "text",
                            width: 200
                        }, {
                            name: "Marketing",
                            type: "text",
                            width: 200
                        }, {
                            name: "Ventas",
                            type: "text",
                            width: 200
                        }, {
                            name: "Precio",
                            type: "text",
                            width: 200
                        }]
                    });
                } else {
                    $(".preloader").fadeOut(); // desvanece preloader
                    // boton - texto - ERROR
                    $('#btn-cm').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Intente nuevamente...').prop('disabled', false);
                    // mensaje ERROR

                    // para el msg abajo
                    $('#r_resultErrDiv').slideDown('fast', function(){
                        $('#r_resultErrDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
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

function goNegocio(){
    $.ajax({
        url: 'tproyectos/ps_negocio.php',
        type: 'POST',
        encoding:"UTF-8",
        data: $('#formNegocio').serialize(),
        dataType: 'json'
    })

        .done(function(data){
            // cargar - loading
            $(".preloader").fadeIn();
            // boton - msg
            $('#btn-cn').html('<img src="ajax-loader.gif" /> &nbsp; Registrando...').prop('disabled', true);

            setTimeout(function(){

                if ( data.status==='success' ) {
                    $(".preloader").fadeOut();  // desvanece preloader
                    //$("#formGenerales").trigger('reset'); // resetea campos
                    // boton - texto - OK
                    $('#btn-cn').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registro exitoso...').prop('disabled', false);
                    // mensaje OK

                    // para el msg abajo
                    $('#r_resultOkDiv').slideDown('fast', function(){
                        $('#r_resultOkDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
                    // grafica de avance
                    $('#graf-negocio').html(data.grafica);
                    $('#graf_total').html(data.graf_total);

                    // para el debug
                    // $('#alerttopright').slideDown('fast', function(){
                    //   $('#alerttopright').html(data.debug+' <a href="#" class="closed">&times;</a> ');
                    //}).delay(6000).slideUp('fast');
                } else {
                    $(".preloader").fadeOut(); // desvanece preloader
                    // boton - texto - ERROR
                    $('#btn-cn').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Intente nuevamente...').prop('disabled', false);
                    // mensaje ERROR

                    // para el msg abajo
                    $('#r_resultErrDiv').slideDown('fast', function(){
                        $('#r_resultErrDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
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

function goFuente(){
    $.ajax({
        url: 'tproyectos/ps_fuente.php',
        type: 'POST',
        encoding:"UTF-8",
        data: $('#formFuente').serialize(),
        dataType: 'json'
    })

        .done(function(data){
            // cargar - loading
            $(".preloader").fadeIn();
            // boton - msg
            $('#btn-cfu').html('<img src="ajax-loader.gif" /> &nbsp; Registrando...').prop('disabled', true);

            setTimeout(function(){

                if ( data.status==='success' ) {
                    $(".preloader").fadeOut();  // desvanece preloader
                    //$("#formGenerales").trigger('reset'); // resetea campos
                    // boton - texto - OK
                    $('#btn-cfu').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registro exitoso...').prop('disabled', false);
                    // mensaje OK

                    // para el msg abajo
                    $('#r_resultOkDiv').slideDown('fast', function(){
                        $('#r_resultOkDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
                    // para el debug
                    //$('#alerttopright').slideDown('fast', function(){
                    //    $('#alerttopright').html(data.debug+' <a href="#" class="closed">&times;</a> ');
                    //}).delay(6000).slideUp('fast');
                    // grafica de avance
                    $('#graf-ingresos').html(data.grafica);
                    $('#graf_total').html(data.graf_total);

                    //getCompetencia();
                    var dbingresos = {

                        loadData: function(filter) {
                            return $.grep(this.dingresos, function(hol) {
                                return ((!filter.Competidor || hol.Competidor === filter.Competidor));
                            });
                        },
                    };

                    window.dbingresos = dbingresos;

                    dbingresos.dingresos = data.informacion;

                    // aqui pinto los resultados de la tabla
                    $("#gridingresos").jsGrid({
                        height: "300px",
                        width: "100%",
                        sorting: !0,
                        paging: !0,
                        data: dbingresos.dingresos,
                        fields: [{
                            name: "Descripcion",
                            type: "text",
                            width: 200
                        }, {
                            name: "Valor",
                            type: "text",
                            width: 80
                        }]
                    });


                } else {
                    $(".preloader").fadeOut(); // desvanece preloader
                    // boton - texto - ERROR
                    $('#btn-cfu').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Intente nuevamente...').prop('disabled', false);
                    // mensaje ERROR

                    // para el msg abajo
                    $('#r_resultErrDiv').slideDown('fast', function(){
                        $('#r_resultErrDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
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

function goCostos(){
    $.ajax({
        url: 'tproyectos/ps_costos.php',
        type: 'POST',
        encoding:"UTF-8",
        data: $('#formCostos').serialize(),
        dataType: 'json'
    })

        .done(function(data){
            // cargar - loading
            $(".preloader").fadeIn();
            // boton - msg
            $('#btn-cco').html('<img src="ajax-loader.gif" /> &nbsp; Registrando...').prop('disabled', true);

            setTimeout(function(){

                if ( data.status==='success' ) {
                    $(".preloader").fadeOut();  // desvanece preloader
                    //$("#formGenerales").trigger('reset'); // resetea campos
                    // boton - texto - OK
                    $('#btn-cco').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registro exitoso...').prop('disabled', false);
                    // mensaje OK

                    // para el msg abajo
                    $('#r_resultOkDiv').slideDown('fast', function(){
                        $('#r_resultOkDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
                    // para el debug
                    //$('#alerttopright').slideDown('fast', function(){
                    //   $('#alerttopright').html(data.debug+' <a href="#" class="closed">&times;</a> ');
                    //}).delay(6000).slideUp('fast');
                    // grafica de avance
                    $('#graf-costos').html(data.grafica);
                    $('#graf_total').html(data.graf_total);


                    //obtiene el grid();
                    var dbcostos = {

                        loadData: function(filter) {
                            return $.grep(this.dcostos, function(hol) {
                                return ((!filter.Competidor || hol.Competidor === filter.Competidor));
                            });
                        },
                    };

                    window.dbcostos = dbcostos;

                    dbcostos.dcostos = data.informacion;

                    // aqui pinto los resultados de la tabla
                    $("#gridcostos").jsGrid({
                        height: "300px",
                        width: "100%",
                        sorting: !0,
                        paging: !0,
                        data: dbcostos.dcostos,
                        fields: [{
                            name: "Descripcion",
                            type: "text",
                            width: 200
                        }, {
                            name: "Valor",
                            type: "text",
                            width: 80
                        }]
                    });
                } else {
                    $(".preloader").fadeOut(); // desvanece preloader
                    // boton - texto - ERROR
                    $('#btn-cco').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Intente nuevamente...').prop('disabled', false);
                    // mensaje ERROR

                    // para el msg abajo
                    $('#r_resultErrDiv').slideDown('fast', function(){
                        $('#r_resultErrDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
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

function goHistoria(){
    $.ajax({
        url: 'tproyectos/ps_historia.php',
        type: 'POST',
        encoding:"UTF-8",
        data: $('#formHistoria').serialize(),
        dataType: 'json'
    })

        .done(function(data){
            // cargar - loading
            $(".preloader").fadeIn();
            // boton - msg
            $('#btn-ch').html('<img src="ajax-loader.gif" /> &nbsp; Registrando...').prop('disabled', true);

            setTimeout(function(){

                if ( data.status==='success' ) {
                    $(".preloader").fadeOut();  // desvanece preloader
                    //$("#formGenerales").trigger('reset'); // resetea campos
                    // boton - texto - OK
                    $('#btn-ch').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registro exitoso...').prop('disabled', false);
                    // mensaje OK

                    // para el msg abajo
                    $('#r_resultOkDiv').slideDown('fast', function(){
                        $('#r_resultOkDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
                    // para el debug
                    //$('#alerttopright').slideDown('fast', function(){
                    //    $('#alerttopright').html(data.debug+' <a href="#" class="closed">&times;</a> ');
                    //}).delay(6000).slideUp('fast');
                    // grafica de avance
                    $('#graf-historia').html(data.grafica);
                    $('#graf_total').html(data.graf_total);


                    //obtiene el grid();
                    var dbhistoria = {

                        loadData: function(filter) {
                            return $.grep(this.dhist, function(hol) {
                                return ((!filter.Competidor || hol.Competidor === filter.Competidor));
                            });
                        },
                    };

                    window.dbhistoria = dbhistoria;

                    dbhistoria.dhist = data.informacion;

                    // aqui pinto los resultados de la tabla
                    $("#gridacontecimiento").jsGrid({
                        height: "300px",
                        width: "100%",
                        sorting: !0,
                        paging: !0,
                        data: dbhistoria.dhist,
                        fields: [{
                            name: "Descripcion",
                            type: "text",
                            width: 200
                        }]
                    });
                } else {
                    $(".preloader").fadeOut(); // desvanece preloader
                    // boton - texto - ERROR
                    $('#btn-ch').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Intente nuevamente...').prop('disabled', false);
                    // mensaje ERROR

                    // para el msg abajo
                    $('#r_resultErrDiv').slideDown('fast', function(){
                        $('#r_resultErrDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
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

function goEquipo(){
    $.ajax({
        url: 'tproyectos/ps_equipo.php',
        type: 'POST',
        encoding:"UTF-8",
        data: $('#formEquipo').serialize(),
        dataType: 'json'
    })

        .done(function(data){
            // cargar - loading
            $(".preloader").fadeIn();
            // boton - msg
            $('#btn-ce').html('<img src="ajax-loader.gif" /> &nbsp; Registrando...').prop('disabled', true);

            setTimeout(function(){

                if ( data.status==='success' ) {
                    $(".preloader").fadeOut();  // desvanece preloader
                    //$("#formGenerales").trigger('reset'); // resetea campos
                    // boton - texto - OK
                    $('#btn-ce').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registro exitoso...').prop('disabled', false);
                    // mensaje OK

                    // para el msg abajo
                    $('#r_resultOkDiv').slideDown('fast', function(){
                        $('#r_resultOkDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
                    // para el debug
                    //$('#alerttopright').slideDown('fast', function(){
                    //    $('#alerttopright').html(data.debug+' <a href="#" class="closed">&times;</a> ');
                    //}).delay(6000).slideUp('fast');
                    // grafica de avance
                    $('#graf-equipo').html(data.grafica);
                    $('#graf_total').html(data.graf_total);

                    //obtiene el grid();
                    var dbequipo = {

                        loadData: function(filter) {
                            return $.grep(this.dteam, function(hol) {
                                return ((!filter.Competidor || hol.Competidor === filter.Competidor));
                            });
                        },
                    };

                    window.dbequipo = dbequipo;

                    dbequipo.dteam = data.informacion;

                    // aqui pinto los resultados de la tabla
                    $("#gridequipo").jsGrid({
                        height: "300px",
                        width: "100%",
                        sorting: !0,
                        paging: !0,
                        data: dbequipo.dteam,
                        fields: [{
                            name: "Nombre",
                            type: "text",
                            width: 200
                        }, {
                            name: "Puesto",
                            type: "text",
                            width: 80
                        }]
                    });
                } else {
                    $(".preloader").fadeOut(); // desvanece preloader
                    // boton - texto - ERROR
                    $('#btn-ce').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Intente nuevamente...').prop('disabled', false);
                    // mensaje ERROR

                    // para el msg abajo
                    $('#r_resultErrDiv').slideDown('fast', function(){
                        $('#r_resultErrDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
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

function goRiesgos(){
    $.ajax({
        url: 'tproyectos/ps_riesgos.php',
        type: 'POST',
        encoding:"UTF-8",
        data: $('#formRiesgos').serialize(),
        dataType: 'json'
    })

        .done(function(data){
            // cargar - loading
            $(".preloader").fadeIn();
            // boton - msg
            $('#btn-cr').html('<img src="ajax-loader.gif" /> &nbsp; Registrando...').prop('disabled', true);

            setTimeout(function(){

                if ( data.status==='success' ) {
                    $(".preloader").fadeOut();  // desvanece preloader
                    //$("#formGenerales").trigger('reset'); // resetea campos
                    // boton - texto - OK
                    $('#btn-cr').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registro exitoso...').prop('disabled', false);
                    // mensaje OK

                    // para el msg abajo
                    $('#r_resultOkDiv').slideDown('fast', function(){
                        $('#r_resultOkDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
                    // para el debug
                    //$('#alerttopright').slideDown('fast', function(){
                    //    $('#alerttopright').html(data.debug+' <a href="#" class="closed">&times;</a> ');
                    //}).delay(6000).slideUp('fast');
                    // grafica de avance
                    $('#graf-riesgos').html(data.grafica);
                    $('#graf_total').html(data.graf_total);

                    //obtiene el grid();
                    var dbriesgos = {

                        loadData: function(filter) {
                            return $.grep(this.drisk, function(hol) {
                                return ((!filter.Competidor || hol.Competidor === filter.Competidor));
                            });
                        },
                    };

                    window.dbriesgos = dbriesgos;

                    dbriesgos.drisk = data.informacion;

                    // aqui pinto los resultados de la tabla
                    $("#gridriesgos").jsGrid({
                        height: "300px",
                        width: "100%",
                        sorting: !0,
                        paging: !0,
                        data: dbriesgos.drisk,
                        fields: [{
                            name: "Explicacion",
                            type: "text",
                            width: 200
                        }, {
                            name: "Indicador",
                            type: "text",
                            width: 80
                        }]
                    });
                } else {
                    $(".preloader").fadeOut(); // desvanece preloader
                    // boton - texto - ERROR
                    $('#btn-cr').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Intente nuevamente...').prop('disabled', false);
                    // mensaje ERROR

                    // para el msg abajo
                    $('#r_resultErrDiv').slideDown('fast', function(){
                        $('#r_resultErrDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
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

function goPlan(){
    $.ajax({
        url: 'tproyectos/ps_plan.php',
        type: 'POST',
        encoding:"UTF-8",
        data: $('#formPlan').serialize(),
        dataType: 'json'
    })

        .done(function(data){
            // cargar - loading
            $(".preloader").fadeIn();
            // boton - msg
            $('#btn-cpl').html('<img src="ajax-loader.gif" /> &nbsp; Registrando...').prop('disabled', true);

            setTimeout(function(){

                if ( data.status==='success' ) {
                    $(".preloader").fadeOut();  // desvanece preloader
                    //$("#formGenerales").trigger('reset'); // resetea campos
                    // boton - texto - OK
                    $('#btn-cpl').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registro exitoso...').prop('disabled', false);
                    // mensaje OK

                    // para el msg abajo
                    $('#r_resultOkDiv').slideDown('fast', function(){
                        $('#r_resultOkDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
                    // para el debug
                    //$('#alerttopright').slideDown('fast', function(){
                    //    $('#alerttopright').html(data.debug+' <a href="#" class="closed">&times;</a> ');
                    //}).delay(6000).slideUp('fast');
                    // grafica de avance
                    $('#graf-plan').html(data.grafica);
                    $('#graf_total').html(data.graf_total);

                    //obtiene el grid();
                    var dbplan = {

                        loadData: function(filter) {
                            return $.grep(this.miplan, function(hol) {
                                return ((!filter.Competidor || hol.Competidor === filter.Competidor));
                            });
                        },
                    };

                    window.dbplan = dbplan;

                    dbplan.miplan = data.informacion;

                    // aqui pinto los resultados de la tabla
                    $("#gridplan").jsGrid({
                        height: "300px",
                        width: "100%",
                        sorting: !0,
                        paging: !0,
                        data: dbplan.miplan,
                        fields: [{
                            name: "Detalle",
                            type: "text",
                            width: 200
                        }, {
                            name: "Porcentaje",
                            type: "text",
                            width: 80
                        }]
                    });
                } else {
                    $(".preloader").fadeOut(); // desvanece preloader
                    // boton - texto - ERROR
                    $('#btn-cpl').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Intente nuevamente...').prop('disabled', false);
                    // mensaje ERROR

                    // para el msg abajo
                    $('#r_resultErrDiv').slideDown('fast', function(){
                        $('#r_resultErrDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
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

function goListo(){

    $.ajax({
        url: 'tproyectos/ps_listo.php',
        type: 'POST',
        encoding:"UTF-8",
        data: $('#formListo').serialize(),
        dataType: 'json'
    })

        .done(function(data){
            // cargar - loading
            $(".preloader").fadeIn();
            // boton - msg
            $('#btn-sendproject').html('<img src="ajax-loader.gif" /> &nbsp; Enviando...').prop('disabled', true);

            setTimeout(function(){

                if ( data.status==='success' ) {
                    $(".preloader").fadeOut();  // desvanece preloader
                    //$("#formGenerales").trigger('reset'); // resetea campos
                    // boton - texto - OK
                    $('#btn-sendproject').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Proyecto enviado...').prop('disabled', false);
                    // mensaje OK
                    // para el msg abajo
                    $('#r_resultOkDiv').slideDown('fast', function(){
                        $('#r_resultOkDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
                    // redireccionar a listado de proyectos
                    setTimeout(function(){window.location.href=data.URL} , 3500);

                } else {
                    $(".preloader").fadeOut(); // desvanece preloader
                    // boton - texto - ERROR
                    $('#btn-sendproject').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Intente nuevamente...').prop('disabled', false);
                    // mensaje ERROR
                    // para el msg abajo
                    $('#r_resultErrDiv').slideDown('fast', function(){
                        $('#r_resultErrDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
                }

            },3000);

        })
        .fail(function(){
            // $("#loginform").trigger('reset');
            alert('An unknown error occoured, Please try again Later...');
        });
}

function getnall(){

    $.ajax({
        url: 'tproyectos/ps_all.php',
        type: 'POST',
        encoding:"UTF-8",
        data: "{'tipo':'getme'}",
        dataType: 'json'
    })

        .done(function(data){

            $(".preloader").fadeIn();
            setTimeout(function(){

                var db2 = {

                    loadData: function(filter) {
                        return $.grep(this.hola, function(hol) {
                            return ((!filter.Competidor || hol.Competidor === filter.Competidor));
                        });
                    },
                };

                window.db2 = db2;

                if ( data.status==='success' ) {
                    $(".preloader").fadeOut();

                    db2.hola = data.d_competencia;
                    //$('#resDiv').html(data.result);
                    // aqui pinto los resultados de la tabla
                    $("#gridcompetencia").jsGrid({
                        height: "300px",
                        width: "100%",
                        sorting: !0,
                        paging: !0,
                        data: db2.hola,
                        fields: [{
                            name: "Competidor",
                            type: "text",
                            width: 140
                        }, {
                            name: "Diferenciador",
                            type: "text",
                            width: 80
                        }, {
                            name: "Propuesta",
                            type: "text",
                            width: 200
                        }]
                    });

                    db2.hola = data.d_mercado;

                    // aqui pinto los resultados de la tabla
                    $("#gridobjetivos").jsGrid({
                        height: "300px",
                        width: "100%",
                        sorting: !0,
                        paging: !0,
                        data: db2.hola,
                        fields: [{
                            name: "Cliente",
                            type: "text",
                            width: 140
                        }, {
                            name: "Segmento",
                            type: "text",
                            width: 80
                        }, {
                            name: "Mercado",
                            type: "text",
                            width: 200
                        }, {
                            name: "Marketing",
                            type: "text",
                            width: 200
                        }, {
                            name: "Ventas",
                            type: "text",
                            width: 200
                        }, {
                            name: "Precio",
                            type: "text",
                            width: 200
                        }]
                    });


                    db2.hola = data.d_fuente;

                    // aqui pinto los resultados de la tabla
                    $("#gridingresos").jsGrid({
                        height: "300px",
                        width: "100%",
                        sorting: !0,
                        paging: !0,
                        data: db2.hola,
                        fields: [{
                            name: "Descripcion",
                            type: "text",
                            width: 200
                        }, {
                            name: "Valor",
                            type: "text",
                            width: 80
                        }]
                    });

                    db2.hola = data.d_costos;

                    // aqui pinto los resultados de la tabla
                    $("#gridcostos").jsGrid({
                        height: "300px",
                        width: "100%",
                        sorting: !0,
                        paging: !0,
                        data: db2.hola,
                        fields: [{
                            name: "Descripcion",
                            type: "text",
                            width: 200
                        }, {
                            name: "Valor",
                            type: "text",
                            width: 80
                        }]
                    });

                    db2.hola = data.d_historia;

                    // aqui pinto los resultados de la tabla
                    $("#gridacontecimiento").jsGrid({
                        height: "300px",
                        width: "100%",
                        sorting: !0,
                        paging: !0,
                        data:  db2.hola,
                        fields: [{
                            name: "Descripcion",
                            type: "text",
                            width: 200
                        }]
                    });

                    db2.hola = data.d_equipo;

                    // aqui pinto los resultados de la tabla
                    $("#gridequipo").jsGrid({
                        height: "300px",
                        width: "100%",
                        sorting: !0,
                        paging: !0,
                        data: db2.hola,
                        fields: [{
                            name: "Nombre",
                            type: "text",
                            width: 200
                        }, {
                            name: "Puesto",
                            type: "text",
                            width: 80
                        }]
                    });

                    db2.hola = data.d_riesgos;

                    // aqui pinto los resultados de la tabla
                    $("#gridriesgos").jsGrid({
                        height: "300px",
                        width: "100%",
                        sorting: !0,
                        paging: !0,
                        data:  db2.hola,
                        fields: [{
                            name: "Explicacion",
                            type: "text",
                            width: 200
                        }, {
                            name: "Indicador",
                            type: "text",
                            width: 80
                        }]
                    });

                    db2.hola = data.d_plan;
                    // aqui pinto los resultados de la tabla
                    $("#gridplan").jsGrid({
                        height: "300px",
                        width: "100%",
                        sorting: !0,
                        paging: !0,
                        data: db2.hola,
                        fields: [{
                            name: "Detalle",
                            type: "text",
                            width: 200
                        }, {
                            name: "Porcentaje",
                            type: "text",
                            width: 80
                        }]
                    });

                    // avances - grafica
                    $('#graf-generales').html(data.graf_generales);
                    $('#graf-fiscales').html(data.graf_fiscales);
                    $('#graf-logo').html(data.graf_logo);
                    $('#graf-idproyecto').html(data.graf_idproyecto);
                    $('#graf-inversion').html(data.graf_inversion);
                    $('#graf-bancarios').html(data.graf_bancarios);
                    $('#graf-producto').html(data.graf_producto);
                    $('#graf-idea').html(data.graf_idea);
                    $('#graf-competencia').html(data.graf_competencia);
                    $('#graf-mercado').html(data.graf_mercado);
                    $('#graf-negocio').html(data.graf_negocio);
                    $('#graf-ingresos').html(data.graf_fuente);
                    $('#graf-costos').html(data.graf_costos);
                    $('#graf-historia').html(data.graf_historia);
                    $('#graf-equipo').html(data.graf_equipo);
                    $('#graf-riesgos').html(data.graf_riesgos);
                    $('#graf-plan').html(data.graf_plan);
                    //$('#graf-costos').html(data.grafica);
                    $('#graf_total').html(data.graf_total);


                } else {
                    $(".preloader").fadeOut();
                    $('#gridcompetencia').html(data.result);
                }

            },3000);
        })
        .fail(function(){
            alert('An unknown error occoured, Please try again Later...');
        });

}

function goAprobar(){

    $.ajax({
        url: 'tproyectos/ps_aprobar.php',
        type: 'POST',
        encoding:"UTF-8",
        data: $('#formAprobar').serialize(),
        dataType: 'json'
    })

        .done(function(data){
            // cargar - loading
            $(".preloader").fadeIn();
            // boton - msg
            $('#btn-aprove').html('<img src="ajax-loader.gif" /> &nbsp; Enviando...').prop('disabled', true);

            setTimeout(function(){

                if ( data.status==='success' ) {
                    $(".preloader").fadeOut();  // desvanece preloader
                    //$("#formGenerales").trigger('reset'); // resetea campos
                    // boton - texto - OK
                    $('#btn-aprove').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Proyecto Aprobado...').prop('disabled', false);
                    // mensaje OK
                    // para el msg abajo
                    $('#r_resultOkDiv').slideDown('fast', function(){
                        $('#r_resultOkDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
                    // redireccionar a listado de proyectos
                    setTimeout(function(){window.location.href=data.URL} , 3500);

                } else {
                    $(".preloader").fadeOut(); // desvanece preloader
                    // boton - texto - ERROR
                    $('#btn-aprove').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Intente nuevamente...').prop('disabled', false);
                    // mensaje ERROR
                    // para el msg abajo
                    $('#r_resultErrDiv').slideDown('fast', function(){
                        $('#r_resultErrDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
                }

            },3000);

        })
        .fail(function(){
            // $("#loginform").trigger('reset');
            alert('An unknown error occoured, Please try again Later...');
        });
}

function goRechazar(){

    $.ajax({
        url: 'tproyectos/ps_rechazar.php',
        type: 'POST',
        encoding:"UTF-8",
        data: $('#formRechazar').serialize(),
        dataType: 'json'
    })

        .done(function(data){
            // cargar - loading
            $(".preloader").fadeIn();
            // boton - msg
            $('#btn-rechazar').html('<img src="ajax-loader.gif" /> &nbsp; Enviando...').prop('disabled', true);

            setTimeout(function(){

                if ( data.status==='success' ) {
                    $(".preloader").fadeOut();  // desvanece preloader
                    //$("#formGenerales").trigger('reset'); // resetea campos
                    // boton - texto - OK
                    $('#btn-rechazar').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Proyecto enviado...').prop('disabled', false);
                    // mensaje OK
                    // para el msg abajo
                    $('#r_resultOkDiv').slideDown('fast', function(){
                        $('#r_resultOkDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
                    // redireccionar a listado de proyectos
                    setTimeout(function(){window.location.href=data.URL} , 3500);

                } else {
                    $(".preloader").fadeOut(); // desvanece preloader
                    // boton - texto - ERROR
                    $('#btn-rechazar').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Intente nuevamente...').prop('disabled', false);
                    // mensaje ERROR
                    // para el msg abajo
                    $('#r_resultErrDiv').slideDown('fast', function(){
                        $('#r_resultErrDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
                }

            },3000);

        })
        .fail(function(){
            // $("#loginform").trigger('reset');
            alert('An unknown error occoured, Please try again Later...');
        });
}
