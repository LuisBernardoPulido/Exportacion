
$( document ).ready(function() {

  check_todos();
   especie_vacunacion();

});

function check_todos() {
    check_campos(0, 0);
    check_campos(0, 1);
    check_campos(1, 0);
    check_campos(1, 1);
}
function valores_vacuna_aux(vacuna) {
    switch (vacuna){
        case 1:
            if($('#cepa1').is(":checked") && $('#cepa0').is(":checked")){
                $('#vacunacion-p03_cepa').val(3);
            }
            else if(!$('#cepa1').is(":checked") && $('#cepa0').is(":checked")){
                $('#vacunacion-p03_cepa').val(1);
            }
            else if($('#cepa1').is(":checked") && !$('#cepa0').is(":checked")){
                $('#vacunacion-p03_cepa').val(2);
            }
            else if(!$('#cepa1').is(":checked") && !$('#cepa0').is(":checked")){
                $('#vacunacion-p03_cepa').val(null);
            }
            break;
        case 2:
            if($('#rb1').is(":checked") && $('#rb0').is(":checked")){
                $('#vacunacion-p03_rb').val(3);

            }
            else if(!$('#rb1').is(":checked") && $('#rb0').is(":checked")){
                $('#vacunacion-p03_rb').val(1);
            }
            else if($('#rb1').is(":checked") && !$('#rb0').is(":checked")){
                $('#vacunacion-p03_rb').val(2);
            }
            else if(!$('#rb1').is(":checked") && !$('#rb0').is(":checked")){
                $('#vacunacion-p03_rb').val(null);
            }
            break;
        case 3:
            if($('#rev1').is(":checked") && $('#rev0').is(":checked")){
                $('#vacunacion-p03_rev').val(3);
            }
            else if(!$('#rev1').is(":checked") && $('#rev0').is(":checked")){
                $('#vacunacion-p03_rev').val(1);
            }
            else if($('#rev1').is(":checked") && !$('#rev0').is(":checked")){
                $('#vacunacion-p03_rev').val(2);
            }
            else if(!$('#rev1').is(":checked") && !$('#rev0').is(":checked")){
                $('#vacunacion-p03_rev').val(null);
            }
            break;
    }
}
function valores_vacuna(vacuna, valor) {
    switch (vacuna){
        case 1:
            if($('#cepa1').is(":checked") && $('#cepa0').is(":checked")){
                $('#vacunacion-p03_cepa').val(3);
                $('#rev0').prop('checked', false);
                $('#rev1').prop('checked', false);
                valores_vacuna_aux(3);
               // $('#vacunacion-p03_rev').val(null);

                $('#rb0').prop('checked', false);
                $('#rb1').prop('checked', false);
                valores_vacuna_aux(2);
                //$('#vacunacion-p03_rb').val(null);

            }
            else if(!$('#cepa1').is(":checked") && $('#cepa0').is(":checked")){
                $('#vacunacion-p03_cepa').val(1);
                $('#rev0').prop('checked', false);
                valores_vacuna_aux(3);


                $('#rb0').prop('checked', false);
                $('#rb1').prop('checked', false);
                valores_vacuna_aux(2);

            }
            else if($('#cepa1').is(":checked") && !$('#cepa0').is(":checked")){
                $('#vacunacion-p03_cepa').val(2);
                $('#rev1').prop('checked', false);
                valores_vacuna_aux(3);

                $('#rb0').prop('checked', false);
                $('#rb1').prop('checked', false);
                valores_vacuna_aux(2);
            }
            else if(!$('#cepa1').is(":checked") && !$('#cepa0').is(":checked")){
                $('#vacunacion-p03_cepa').val(null);

            }
            check_campos(0, valor);
            break;
        case 2:
        if($('#rb1').is(":checked") && $('#rb0').is(":checked")){
            $('#vacunacion-p03_rb').val(3);

            $('#cepa0').prop('checked', false);
            $('#cepa1').prop('checked', false);
            valores_vacuna_aux(1);
        }
        else if(!$('#rb1').is(":checked") && $('#rb0').is(":checked")){
            $('#vacunacion-p03_rb').val(1);
            $('#cepa0').prop('checked', false);
            $('#cepa1').prop('checked', false);
            valores_vacuna_aux(1);

        }
        else if($('#rb1').is(":checked") && !$('#rb0').is(":checked")){
            $('#vacunacion-p03_rb').val(2);
            $('#cepa0').prop('checked', false);
            $('#cepa1').prop('checked', false);
            valores_vacuna_aux(1);
        }
        else if(!$('#rb1').is(":checked") && !$('#rb0').is(":checked")){
            $('#vacunacion-p03_rb').val(null);
        }
            check_campos(1, valor);
        break;
        case 3:
            if($('#rev1').is(":checked") && $('#rev0').is(":checked")){
                $('#vacunacion-p03_rev').val(3);
                $('#cepa0').prop('checked', false);
                $('#cepa1').prop('checked', false);
                valores_vacuna_aux(1);
            }
            else if(!$('#rev1').is(":checked") && $('#rev0').is(":checked")){
                $('#vacunacion-p03_rev').val(1);
                $('#cepa0').prop('checked', false);

                valores_vacuna_aux(1);

            }
            else if($('#rev1').is(":checked") && !$('#rev0').is(":checked")){
                $('#vacunacion-p03_rev').val(2);
                $('#cepa1').prop('checked', false);
                valores_vacuna_aux(1);
            }
            else if(!$('#rev1').is(":checked") && !$('#rev0').is(":checked")){
                $('#vacunacion-p03_rev').val(null);
            }
            check_campos(0, valor);
            break;



    }
    check_todos();
}
function especie_vacunacion() {
    var valor = document.getElementById('vacunacion-p03_tipohato').value;
    if(valor==1){
        $('#rev0').attr('disabled', true);
        $('#rev1').attr('disabled', true);
        $('#rev0').prop('checked', false);
        $('#rev1').prop('checked', false);
        valores_vacuna(3, 0);
        valores_vacuna(3, 1);

        $('#cepa0').attr('disabled', false);
        $('#cepa1').attr('disabled', false);

        $('#rb0').attr('disabled', false);
        $('#rb1').attr('disabled', false);
    }else if(valor==2 || valor==3){

            $('#cepa0').prop('checked', false);
            $('#cepa1').prop('checked', false);
            valores_vacuna(1, 0);
            valores_vacuna(1, 1);


                $('#rb0').prop('checked', false);
                $('#rb1').prop('checked', false);
                valores_vacuna(2, 0);
                valores_vacuna(2, 1);


        $('#cepa0').attr('disabled', true);
        $('#cepa1').attr('disabled', true);
        $('#rb0').attr('disabled', true);
        $('#rb1').attr('disabled', true);

        $('#rev0').attr('disabled', false);
        $('#rev1').attr('disabled', false);
    }else{


        $('#rev0').attr('disabled', true);
        $('#rev1').attr('disabled', true);

        $('#cepa0').attr('disabled', true);
        $('#cepa1').attr('disabled', true);
        $('#rb0').attr('disabled', true);
        $('#rb1').attr('disabled', true);
    }

}

function check_campos(valor, origen) {

    if(valor==0){
        //Clasica o reducida
        if(origen==0){
            if($('#cepa0').is(":checked") || $('#rev0').is(":checked")){
                $('#vacunacion-p03_lote_clasica').attr('disabled', false);
                $('#vacunacion-p03_cad_clasica').attr('disabled', false);
            }else{
                $('#vacunacion-p03_lote_clasica').attr('disabled', true);
                //$('#vacunacion-p03_lote_clasica').val("");
                $('#vacunacion-p03_cad_clasica').attr('disabled', true);
                //$('#vacunacion-p03_cad_clasica').val("");
            }
        }else{
            if($('#cepa1').is(":checked") || $('#rev1').is(":checked")){
                $('#vacunacion-p03_lote_reducida').attr('disabled', false);
                $('#vacunacion-p03_cad_reducida').attr('disabled', false);
            }else{
                $('#vacunacion-p03_lote_reducida').attr('disabled', true);
                //$('#vacunacion-p03_lote_reducida').val("");
                $('#vacunacion-p03_cad_reducida').attr('disabled', true);
                //$('#vacunacion-p03_cad_reducida').val("");
            }
        }



    }else{
        if(origen==0){
            //Becerra o Vaca
            if($('#rb0').is(":checked")){
                $('#vacunacion-p03_lote_becerra').attr('disabled', false);
                $('#vacunacion-p03_cad_becerra').attr('disabled', false);
            }else{
                $('#vacunacion-p03_lote_becerra').attr('disabled', true);
                //$('#vacunacion-p03_lote_becerra').val("");
                $('#vacunacion-p03_cad_becerra').attr('disabled', true);
                //$('#vacunacion-p03_cad_becerra').val("");
            }
        }else{
            if($('#rb1').is(":checked")){
                $('#vacunacion-p03_lote_vaca').attr('disabled', false);
                $('#vacunacion-p03_cad_vaca').attr('disabled', false);
            }else{
                $('#vacunacion-p03_lote_vaca').attr('disabled', true);
                //$('#vacunacion-p03_lote_vaca').val("");
                $('#vacunacion-p03_cad_vaca').attr('disabled', true);
                //$('#vacunacion-p03_cad_vaca').val("");
            }
        }


    }
}