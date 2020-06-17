$( document ).ready(function() {
    cargarMunicipios();
});

function cargarMunicipios() {

    var edo = document.getElementById('pvi-c16_estado').value;
    var edo_oculto = document.getElementById('id_edo').value;
    var first_time = document.getElementById('id_first_time').value;
    var municipioactivo = document.getElementById('pvi-c16_municipio').value;

    if(first_time!=0) {
        if (edo_oculto == -1) {
            $("#clientes-c06_id").select2("val", "");
        }
    }else{
        document.getElementById('id_first_time').value=1;
    }
    parametro = {"edo":edo};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=medicos/cargarmunicipios',
        data: parametro,
        success: function (respuesta) {
            document.getElementById('pvi-c16_municipio').innerHTML=respuesta;
            $('#pvi-c16_municipio').val(municipioactivo).trigger('change');

        }
    });
}