function cargarMunicipiosProductor() {
    var edo = document.getElementById('edo').value;
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
/**
 * Created by Eduardo on 13/03/2017.
 */
