$( document ).ready(function() {
    var form = document.getElementById('rutas-c18_estado');
    if(typeof(form)!='undefined' && form!=null ) {
        $('#rutas-c18_clave').mask('00-000-0000-AAA');
        cargarMunicipios();
    }else{
        cargarMunicipiosIndex();
    }
});

function cargarMunicipios() {
    var edo = document.getElementById('rutas-c18_estado').value;
    var edo_oculto = document.getElementById('id_edo').value;
    var first_time = document.getElementById('id_first_time').value;
    var municipioactivo = document.getElementById('rutas-c18_municipio').value;

    if(first_time!=0) {
        if (edo_oculto == -1) {
            $("#rutas-c18_municipio").select2('val', '');
            $("#rutas-c18_localidad").select2('val', '');
        }
    }else{
        document.getElementById('id_first_time').value=1;
    }
    parametro = {"edo":edo};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=municipios/cargarmunicipios',
        data: parametro,
        success: function (respuesta) {
            document.getElementById('rutas-c18_municipio').innerHTML=respuesta;
            $('#rutas-c18_municipio').val(municipioactivo).trigger('change');

        }
    });
}

function cargarMunicipiosIndex() {
    var edo = document.getElementById('edo').value;
    parametro = {"edo":edo};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=municipios/cargarmunicipios',
        data: parametro,
        success: function (respuesta) {
            document.getElementById('mpo').innerHTML=respuesta;
        }
    });
}