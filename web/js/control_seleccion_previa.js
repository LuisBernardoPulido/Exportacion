$(document).ready(function(){
    $('body').on('keyup', '.select2-search__field', function() {
        var selectItem = $('.select2-container--open').prev();
        var index = selectItem.index();
        var id = selectItem.attr('id');

        if(id == 'seleccionpreviasearch-c01_id'){
            $('.select2-search__field').mask('00-000-0000-AAA');
        }else{
            $('.select2-search__field').unmask();
        }
    });
});

function  motivoBorrar(id) {
    parametro = {"id" : id};

    swal({
        title: 'Motivo',
        text: 'Es necesario ingresar el motivo por el cual se desea eliminar la prueba.',
        input: 'text',
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar',
        //closeOnConfirm: false,
        allowOutsideClick: false,
        showCancelButton: true,
        inputValidator: function (value) {
            return new Promise(function (resolve, reject) {
                if (value) {
                    if(value<3){
                        reject('¡Debes de ingresar un motivo para poder eliminar!')
                    }else{
                        resolve()
                    }
                } else {
                    reject('¡Debes de ingresar un motivo para poder eliminar')
                }
            })
        }
    }).then(function (result) {
        /*swal({
         type: 'success',
         html: 'You entered: ' + result
         })*/
        swal.disableButtons();
        $.get("index.php?r=seleccion-previa/deleteprueba&id="+id+"&motivo="+result, function(datos){
            if(datos==1){
                //mandar la impresion
                location.href= "index.php?r=seleccion-previa/deleteprueba&id="+id+"&motivo="+result;

            }else{
                swal('', datos,'warning');
            }
        });

    });
}