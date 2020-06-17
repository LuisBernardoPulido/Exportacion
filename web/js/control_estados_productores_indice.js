/**
 * Created by Eduardo on 17/03/2017.
 */


function cargarMunicipiosProductor() {
    var edo = document.getElementById('edo').value;
    //var edo_oculto = document.getElementById('id_edo').value;

    //if(edo_oculto==-1) {
    //    $("#ganaderos-c01_municipio").select2("val","");
    //}

    parametro = {"edo":edo};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=ganaderos/cargarmunicipiosproductor',
        data: parametro,
        success: function (respuesta) {
            document.getElementById('mpo').innerHTML=respuesta;
        }
    });
}