/**
 * Created by xion on 01/08/17.
 */
$(document).ready(function() {
    $(function() {
        $(".preloader").fadeOut();
    });

    $('#searchMe').submit(function()
        {
            paginateMe(1);
            return false;
        }
    );

    $('#formSubasta').submit(function()
        {
            goSubasta();
            return false;
        }
    );

});

function goSubasta(){

    $.ajax({
        url: 'tvalidar/ps_subasta.php',
        type: 'POST',
        encoding:"UTF-8",
        data: $('#formSubasta').serialize(),
        dataType: 'json'
    })

        .done(function(data){
            // cargar - loading
            $(".preloader").fadeIn();
            // boton - msg
            $('#btn-subasta').html('<img src="ajax-loader.gif" /> &nbsp; Enviando...').prop('disabled', true);

            setTimeout(function(){

                if ( data.status==='success' ) {
                    $(".preloader").fadeOut();  // desvanece preloader
                    // boton - texto - OK
                    $('#btn-subasta').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Subasta Generada...').prop('disabled', false);
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
                    $('#btn-subasta').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Intente nuevamente...').prop('disabled', false);
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


function paginateMe(page){

    document.getElementById('page').value = page;

    $.ajax({
        url: 'tvalidar/ps_aprobados.php',
        type: 'POST',
        encoding:"UTF-8",
        data: $('#searchMe').serialize(),
        dataType: 'json'
    })

        .done(function(data){

            $(".preloader").fadeIn();
            setTimeout(function(){

                if ( data.status==='success' ) {
                    $(".preloader").fadeOut();
                    $('#resDiv').html(data.result);

                    var table = $('#tpendingdisp').DataTable({
                        "columnDefs": [
                            { "visible": true, "targets": 2 }
                        ],
                        "order": [[ 2, 'asc' ]],
                        "displayLength": 25,
                        "paging":   false,
                        "info":     true,
                        "drawCallback": function ( settings ) {
                            var api = this.api();
                            var rows = api.rows( {page:'current'} ).nodes();
                            var last=null;
                        }
                    } );

                    // Order by the grouping
                    $('#tpendingdisp tbody').on( 'click', 'tr.group', function () {
                        var currentOrder = table.order()[0];
                        if ( currentOrder[0] === 2 && currentOrder[1] === 'asc' ) {
                            table.order( [ 2, 'desc' ] ).draw();
                        }
                        else {
                            table.order( [ 2, 'asc' ] ).draw();
                        }
                    } );

                } else {
                    $(".preloader").fadeOut();
                    $('#resDiv').html(data.result);
                }

            },3000);
        })
        .fail(function(){
            alert('An unknown error occoured, Please try again Later...');
        });

}

function init()
{
    paginateMe(1);
}

function setIdProyecto(idproyecto)
{
    document.getElementById("cidproyecto").value = idproyecto;
}

