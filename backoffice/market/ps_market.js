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
        url: 'market/ps_market.php',
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



/**
 * Created by xion on 07/10/17.
 */
