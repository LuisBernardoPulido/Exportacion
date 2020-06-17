/**
 * Created by Eduardo on 21/03/2017.
 */

$(document).ready(function(){
    $('body').on('keyup', '.select2-search__field', function() {
        var selectItem = $('.select2-container--open').prev();
        var index = selectItem.index();
        var id = selectItem.attr('id');

        if(id == 'unidadessearch-r01_id'){
            $('.select2-search__field').mask('00-000-0000-AAA');
        }else{
            $('.select2-search__field').unmask();
        }
    });
});


function cargarMunicipiosUnidad() {
    var edo = document.getElementById('edo').value;

    $("#mpo").select2("val","");

    parametro = {"edo":edo};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=unidades/cargarmunicipios',
        data: parametro,
        success: function (respuesta) {
            document.getElementById('mpo').innerHTML=respuesta;
        }
    });
}