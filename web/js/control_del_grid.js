$(document).on('ready pjax:success', function () {
    $('.ajaxDelete').on('click', function (e) {
        e.preventDefault();

        var url = $(this).attr('url');
        var grid = $(this).attr('grid');
        var param = $(this).attr('param');

        var parametros = document.getElementById(param);

        var accion = {
            type: 'POST',
            data: $(parametros).serialize(),
            url: url,
            cache: false,
            success: function (html) {
                eval(html);
                if (accion.error) {
                    swal(accion.msj,'','warning');
                } else {
                    $.pjax.reload({container: '#' + grid, timeout: 5000});
                    swal(accion.msj, '','success');
                }
            }
        };
        swal({
                title: 'Advertencia',
                text:'¿Desea eliminar este arete de la tabla?',
                type:'warning',
                showCancelButton: true,
                confirmButtonColor: '#942626',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Eliminar',
                cancelButtonText: "Cancelar",
                //closeOnConfirm: false,
                allowOutsideClick: false
            }).then(function ($res) {
                swal.disableButtons();
                //console.log("Si")
                //console.log(accion)
                $.ajax(accion);
            });

    });

});
