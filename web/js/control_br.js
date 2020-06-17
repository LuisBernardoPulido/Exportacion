
$( document ).ready(function() {
    motivootro();
    tipootro();
    $( ".field-brucelosis-p03_tipoaux" ).fadeOut( "slow", function() {});
});

function opcion() {
    var i = document.getElementById('hatoC').checked;
    if(i){
        $('#brucelosis-p03_muestrahato').attr('readonly', true);
        $('#brucelosis-p03_totalhato').attr('readonly', true);
    }else{
        $('#brucelosis-p03_muestrahato').attr('readonly', false);
        $('#brucelosis-p03_totalhato').attr('readonly', false);
    }
}

function motivootro(n) {
    if(n){
        var mot =n.value;
    }else{
        var mot=0;
    }

    if(mot==99){
        $('#motivobruce').removeClass('col-md-6');
        $('#motivobruce').addClass('col-md-3');
        $( "#motivoespe" ).fadeIn( "slow", function() {

        });
    }else{
        $( "#motivoespe" ).fadeOut( "slow", function() {

            $('#motivobruce').removeClass('col-md-3');
            $('#motivobruce').addClass('col-md-6');

        });
    }
}

function tipootro(n) {
    if(n){
        var mot =n.value;
    }else{
        var mot=0;
    }
    if(mot==99){
        $('#tipobruce').removeClass('col-md-6');
        $('#tipobruce').addClass('col-md-3');
        $( "#tipoespe" ).fadeIn( "slow", function() {

        });
    }else{
        $( "#tipoespe" ).fadeOut( "slow", function() {

            $('#tipobruce').removeClass('col-md-3');
            $('#tipobruce').addClass('col-md-6');

        });
    }
}
