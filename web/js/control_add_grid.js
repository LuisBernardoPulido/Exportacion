
function add_grid(params) {

    var parametros = document.getElementById(params['param']);

    var accion = {
        type: 'POST',
        data: $(parametros).serialize(),
        url: params['url'],
        cache: false,
        success: function (html) {
            eval(html);
            if (accion.error) {
                swal({
                    title: accion.msj,
                    type: 'warning',
                    timer: 3000,
                    showConfirmButton: false
                });
                $('#modalContent2').find('.select2-selection__rendered').html('<span class="select2-selection__placeholder">Seleccionar productor...</span>');
                $.pjax.reload({container:'#'+params['grid'], timeout: 5000 });
            } else {
                /*
                 $.get(params['url'],function(data){
                    $('#modalContent2').html(data);
                 });
                 */
                $('#modalContent2').find('.select2-selection__rendered').html('<span class="select2-selection__placeholder">Seleccionar productor...</span>');
                $.pjax.reload({container:'#'+params['grid'], timeout: 5000 });


            }
            setTimeout("document.body.style.cursor = 'default'", 2000);
        }
    };
    document.body.style.cursor = "wait";
    $.ajax(accion);
}
