$(document).ready(function () {
    $('body').on('keyup', '.select2-search__field', function() {
        var selectItem = $('.select2-container--open').prev();
        var index = selectItem.index();
        var id = selectItem.attr('id');

    });


    iseditando();

});

function iseditando(){
    var editando = document.getElementById('editando').value;
    if(editando!=-1){

    }
}
function validarCampos(numero){
    if(numero){
        return true;
    }
    else{
        if(!numero){
            mensajeErrorTexto("No se ha ingresado un número de arete");
        }
        return false;
    }
}

function mensajeErrorTexto(texto){
    swal({
        title: texto,
        type: 'warning',
        showCancelButton: false,
        confirmButtonColor: '#942626',
        confirmButtonText: 'Ok'
    }).catch(swal.noop);
}

function agregarArete(editando){
    var numero = document.getElementById('cap_are').value;

    if(validarCampos(numero)){
        parametro = {"numero": numero, "solicitud":editando};
        $.ajax({
            type: 'GET',
            url: 'index.php?r=solicitudes-exportaciones/existearete',
            data: parametro,
            success: function (res2) {
                if(res2==0){
                    parametro = {"numero": numero, "solicitud":editando};
                    $.ajax({
                        type: 'GET',
                        url: 'index.php?r=solicitudes-exportaciones/agregararete',
                        data: parametro,
                        success: function (res2) {
                            if(res2==1){
                                limpiarArete();
                            }else{
                                mensajeErrorTexto("Error.");
                            }
                            $.pjax.reload({container: "#tabla_aretes", timeout: false});
                        }
                    });
                }else if (res2==1){
                    mensajeErrorTexto("El arete ya existe.");
                    limpiarArete();
                }else{
                    mensajeErrorTexto("El arete no existe.");
                    limpiarArete();
                }
                $.pjax.reload({container: "#tabla_aretes", timeout: false});

            }

        });
    }
    function limpiarArete(){
        document.getElementById('cap_are').value = '';
    }
}