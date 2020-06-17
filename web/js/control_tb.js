
$( document ).ready(function() {
    motivootrotb();
    tipootrotb();
});
function cambiarFecha(){
    var inyeccion = document.getElementById('tuberculosis-p03_finyeccion').value;

    var date = new Date(inyeccion);
    date.setDate(date.getDate()+3);
    var dd = date.getDate();
    var mm = date.getMonth()+1; //January is 0!
    var minutes = date.getMinutes();
    var hours = date.getHours();

    var yyyy = date.getFullYear();
    if(dd<10){
        dd='0'+dd;
    }
    if(mm<10){
        mm='0'+mm;
    }
    if(hours<10){
        hours='0'+hours;
    }
    if(minutes<10){
        minutes='0'+minutes;
    }
    var dateFormat = yyyy+'-'+mm+'-'+dd+' '+hours+':'+minutes;
    document.getElementById('tuberculosis-p03_flectura').value=dateFormat;
}


function motivootrotb(n) {
    if(n){
        var mot =n.value;
    }else{
        var mot=0;
    }
    if(mot==99){
        $('#motivo_tb').removeClass('col-md-6');
        $('#motivo_tb').addClass('col-md-3');
        $( "#motivoespe_tb" ).fadeIn( "slow", function() {

        });
    }else{
        $( "#motivoespe_tb" ).fadeOut( "slow", function() {

            $('#motivo_tb').removeClass('col-md-3');
            $('#motivo_tb').addClass('col-md-6');

        });
    }
}

function tipootrotb(n) {
    if(n){
        var mot =n.value;
    }else{
        var mot=0;
    }
    if(mot==99){
        $('#tipo_tb').removeClass('col-md-6');
        $('#tipo_tb').addClass('col-md-3');
        $( "#tipoespe_tb" ).fadeIn( "slow", function() {

        });
    }else{
        $( "#tipoespe_tb" ).fadeOut( "slow", function() {

            $('#tipo_tb').removeClass('col-md-3');
            $('#tipo_tb').addClass('col-md-6');

        });
    }
}