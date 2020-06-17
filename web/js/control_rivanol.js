$(document).ready(function(){
    cambiar_totales();
    cambiar_totales_rivanol();
});

function cambiar_totales(){
    var total_neg=0;
    var total_pos=0;
    var total_hemo=0;
    var total_e=0;
    var total=0;


    $('.totales_for_count').each(function() {
        switch (parseInt(this.value)){
            case 1: total_neg++;
                break;
            case 2: total_pos++;
                break;
            case 3: total_hemo++;
                break;
            case 17: total_e++;
                break;

        }
        total = total_neg+total_pos+total_hemo+total_e;

        $('#total_neg').html(total_neg);
        $('#total_pos').html(total_pos);
        $('#total_hemo').html(total_hemo);
        $('#total_e').html(total_e);
        $('#total').html(total);

    });
}

function cambiar_totales_rivanol(){
    var total_neg=0;
    var total_pos=0;
    var total_ins=0;
    var total=0;


    $('.riv_for_count').each(function() {
        //alert("riv " + this.value);
        var res = parseInt(this.value);
        if(res==8){
            total_neg++;
        }else if(res==29){
            total_ins++;
        }else{
            total_pos++;
        }
        total = total_neg+total_pos+total_ins;

        $('#total_neg_riv').html(total_neg);
        $('#total_pos_riv').html(total_pos);
        $('#total_ins_riv').html(total_ins);
        $('#total_riv').html(total);

    });
}

function positivobr(id) {
cambiar_totales();
    var find = document.getElementById('resu_'+id).value;
    if(find==2){
        $('#riva_'+id).fadeIn( "slow", function() {

        });
    }else{
        $('#riva_'+id).fadeOut( "slow", function() {

        });
    }

   // $('#riva_'+id).prop('disabled', true);
}