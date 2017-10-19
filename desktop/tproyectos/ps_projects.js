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

});


function paginateMe(page){

    document.getElementById('page').value = page;

    $.ajax({
        url: 'tproyectos/ps_projects.php',
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


