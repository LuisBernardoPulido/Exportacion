function mover_configuracion(valor) {
    parametro = {"valor": valor};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=site/configuracion',
        data: parametro,
        success: function (respuesta) {
            location.reload();
        }
    });
}
