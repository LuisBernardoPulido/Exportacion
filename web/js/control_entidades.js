$( document ).ready(function() {
    cargarMunicipios();
    cargarlocalidades();
    cargarMunicipiosProductor();
    cargarlocalidadesProductor();
    cargarMunicipiosUpp();
    cargarlocalidadesUpp();
});

function cargarMunicipios() {
    var edo = document.getElementById('medicos-c05_estado').value;

    parametro = {"edo":edo};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=medicos/cargarmunicipios',
        data: parametro,
        success: function (respuesta) {
            document.getElementById('medicos-c05_municipio').innerHTML=respuesta;

        }
    });
}

function cargarlocalidades() {
    var mpo = document.getElementById('medicos-c05_municipio').value;
    var edo = document.getElementById('medicos-c05_estado').value;

    parametro = {"edo":edo,"mpo":mpo};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=medicos/cargarlocalidades',
        data: parametro,
        success: function (respuesta) {
            document.getElementById('medicos-c05_localidad').innerHTML=respuesta;

        }
    });
}



