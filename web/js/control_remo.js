
$(document).ready(function(){
    $('body').on('keyup', '.select2-search__field', function() {
        var selectItem = $('.select2-container--open').prev();
        var index = selectItem.index();
        var id = selectItem.attr('id');

        if(id == 'reemomanualsearch-c14_motivo'){
            $('.select2-search__field').unmask();
        }else{
            $('.select2-search__field').mask('00-000-0000-AAA');
        }
    });
});

function checar_arete() {
    var ar = document.getElementById('arete_remo').value;
    if(ar.length==10){
        parametro = {"arete": ar};
        $.ajax({
            type: 'GET',
            url: 'index.php?r=remo/aretecheck',
            data: parametro,
            success: function (respuesta) {
                //alert(respuesta)
                if(respuesta!=-1){
                    $( "#mensaje_no" ).fadeOut( "slow", function() {
                        //document.getElementById("remo-r01_origen").value = 8;
                    });
                    $("#remo-r01_origen").select2("val", "8");
                }else{
                    $( "#mensaje_no" ).fadeIn( "slow", function() {});
                }

            }
        });
    }
}
function habilitarotro(tipo) {
    if(tipo==0){
        $('#textareas').attr('readonly',false);
    }else{
        $('#textareas').attr('readonly',true);
    }
}
