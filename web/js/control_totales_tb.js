$(document).ready(function(){
    cambiar_totales();
});

function cambiar_totales(){
    var total_neg=0;
    var total_sos=0;
    var total_rec=0;
    var total_sinlectura=0;
    var total_asterisco=0;

    $('.totales_for_count').each(function() {

        switch (parseInt(this.value)){
            case 4: total_neg++;
            break;
            case 5: total_sos++;
                break;
            case 6: total_rec++;
                break;
            case 7: total_asterisco++;
                break;
            case 16: total_sinlectura++;
                break;
        }
        // console.log(this.value);
        //Modificar valores
        $('#total_neg').html(total_neg);
        $('#total_sos').html(total_sos);
        $('#total_react').html(total_rec);
        $('#total_aste').html(total_asterisco);
        $('#total_gorrito').html(total_sinlectura);
     });
}
