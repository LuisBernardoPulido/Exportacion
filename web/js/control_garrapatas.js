$(document).ready(function(){
    $('body').on('keyup', '.select2-search__field', function() {
        var selectItem = $('.select2-container--open').prev();
        var index = selectItem.index();
        var id = selectItem.attr('id');

        if(id == 'garrapatassearch-r01_id'){
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
        text: 'Es necesario ingresar el motivo por el cual se desea eliminar este registro.',
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
        $.get("index.php?r=garrapatas/deletedictamen&id="+id+"&motivo="+result, function(datos){
            if(datos==1){
                //mandar la impresion
                location.href= "index.php?r=garrapatas/deletedictamen&id="+id+"&motivo="+result;

            }else{
                swal('', datos,'warning');
            }
        });

    });
}

function checarFolio(id, folio){
    parametro = {"id" : id};
    if(folio==-1) {
        swal({
            title: 'Ingrese un folio',
            text: 'Es necesario proporcionar un folio para proseguir con la impresión de la Constancia de Garrapacida',
            input: 'number',
            confirmButtonText: 'Imprimir',
            cancelButtonText: 'Cancelar',
            allowOutsideClick: false,
            showCancelButton: true,
            inputValidator: function (value) {
                return new Promise(function (resolve, reject) {
                    if (value) {
                        if(value<1){
                            reject('¡Necesitas ingresar un folio válido!')
                        }else{
                            resolve()
                        }
                    } else {
                        reject('¡Necesitas ingresar el folio!')
                    }
                })
            }
        }).then(function (result) {
            swal.disableButtons();
            $.get("index.php?r=garrapatas/nuevofolio&id="+id+"&folio="+result, function(datos){
                if(datos==1){
                    location.href= "index.php?r=garrapatas/imprimir&id="+id+"";

                }else{
                    swal('', datos,'warning');
                }
            });

        });
    }else{
        swal({
            title: '¿Desea imprimir el dictamen con el folio '+folio+'?',
            type: 'warning',
            html: "<a href='#' onclick='cambiarFolio("+id+")'>Cambiar folio</a>",
            confirmButtonText: 'Imprimir',
            cancelButtonText: 'Cancelar',
            allowOutsideClick: false,
            showCancelButton: true
        }).then(function (result) {
            location.href= "index.php?r=garrapatas/imprimir&id="+id+"";
        });
    }
}

function cambiarFolio(id) {
    alert(id);
    swal({
        text: 'Ingrese un nuevo número de folio',
        input: 'number',
        inputValue: id,
        type:'question',
        confirmButtonText: 'Imprimir',
        cancelButtonText: 'Cancelar',
        //closeOnConfirm: false,
        allowOutsideClick: false,
        showCancelButton: true,
        inputValidator: function (value) {
            return new Promise(function (resolve, reject) {
                if (value) {
                    if(value<1){
                        reject('¡Necesitas ingresar un folio válido!')
                    }else{

                        resolve()

                    }
                } else {
                    reject('¡Necesitas ingresar el folio!')
                }
            })
        }
    }).then(function (result) {
        swal.disableButtons();
        $.get("index.php?r=garrapatas/nuevofolio&id="+id+"&folio="+result, function(datos){
            if(datos==1){
                location.href= "index.php?r=garrapatas/imprimir&id="+id+"";

            }else{
                swal('', datos,'warning');
            }
        });

    });
}