$(document).ready(function(){
    $('body').on('keyup', '.select2-search__field', function() {
        var selectItem = $('.select2-container--open').prev();
        var index = selectItem.index();
        var id = selectItem.attr('id');
        if(id == 'tuberculosissearch-r01_id'){
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
        $.get("index.php?r=tuberculosis/deletedictamen&id="+id+"&motivo="+result, function(datos){
            if(datos==1){
                //mandar la impresion
                location.href= "index.php?r=tuberculosis/deletedictamen&id="+id+"&motivo="+result+"";

            }else{
                swal('', datos,'warning');
            }
        });

    });
}

function checarFolio(id, folio) {

    if(folio==-1) {
        swal({
            title: 'Ingrese un folio',
            text: 'Es necesario proporcionar un folio para proseguir con la impresión del dictamen de TB',
            input: 'number',
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
             $.get("index.php?r=tuberculosis/nuevofolio&id="+id+"&folio="+result, function(datos){

             if(datos==1){
                 swal({
                     title: 'Seleccionar Caratula TB.',
                     input: 'select',
                     inputOptions: {
                         '1': 'Carátula anterior',
                         '2': 'Carátula nueva'
                     },
                     inputPlaceholder: 'Elige una opción',
                     showCancelButton: true,
                     inputValidator: function (value) {
                         return new Promise(function (resolve, reject) {
                             if (value !== '') {
                                 resolve();
                             } else {
                                 reject('No se ha seleccionado un formato.');
                             }
                         });
                     }
                 }).then(function (result) {
                     location.href= "index.php?r=tuberculosis/imprimir&id="+id+"&caratula="+result+"";
                 });

             }else{
                swal('', datos,'warning');
             }
             //location.href= "index.php?r=tuberculosis";
             });

        });
    }else{
        swal({
            //html: '¿Desea imprimir el dictamen con el folio '+folio+'?<br><a href="#" onclick="cambiarFolio('+id+', '+folio+')" style="text-decoration: underline; font-size: 13px;">Cambiar folio</a>',
            html: '¿Desea imprimir el dictamen con el folio '+folio+'?',
            //input: 'number',
            type: 'warning',
            confirmButtonText: 'Imprimir',
            cancelButtonText: 'Cancelar',
            allowOutsideClick: false,
            body: '<b>Hola</b>',
            showCancelButton: true
        }).then(function (result) {
            /*******************
             Seleccionar caratula
             ********************/
            swal({
                title: 'Seleccionar Caratula TB.',
                input: 'select',
                inputOptions: {
                    '1': 'Carátula anterior',
                    '2': 'Carátula nueva',
                    '7': 'Formato 26/03/2020',
                },
                inputPlaceholder: 'Elige una opción',
                showCancelButton: true,
                inputValidator: function (value) {
                    return new Promise(function (resolve, reject) {
                        if (value !== '') {
                            resolve();
                        } else {
                            reject('No se ha seleccionado un formato.');
                        }
                    });
                }
            }).then(function (result) {
                location.href= "index.php?r=tuberculosis/imprimir&id="+id+"&caratula="+result+"";
            });
        });
        /*******************
         Fin seleccionar caratula
         ********************/
    }

}
function cambiarFolio(id, folio) {
    swal({
        //title: 'Ingrese un nuevo folio',
        text: 'Ingrese un nuevo número de folio',
        input: 'number',
        inputValue:folio,
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
        $.get("index.php?r=tuberculosis/otrofolio&id="+id+"&folio="+result+"&anterior="+folio, function(datos){
            if(datos==1){
                //Pedir motivo
                swal({
                    //title: 'Ingrese un nuevo folio',
                    text: 'Ingrese el mótivo de cambio',
                    input: 'textarea',
                    inputValue:"Sin descripción",
                    type:'question',
                    confirmButtonText: 'Imprimir',
                    //cancelButtonText: 'Cancelar',
                    //closeOnConfirm: false,
                    allowOutsideClick: false,
                    showCancelButton: false,

                }).then(function (result) {
                    $.get("index.php?r=tuberculosis/addmotivofolio&descripcion="+result+"&anterior="+folio, function(datos) {
                        if(datos==1){
                            //location.href= "index.php?r=tuberculosis/imprimir&id="+id+"";
                            swal({
                                title: 'Seleccionar Caratula TB.',
                                input: 'select',
                                inputOptions: {
                                    '1': 'Carátula anterior',
                                    '2': 'Carátula nueva'
                                },
                                inputPlaceholder: 'Elige una opción',
                                showCancelButton: true,
                                inputValidator: function (value) {
                                    return new Promise(function (resolve, reject) {
                                        if (value !== '') {
                                            resolve();
                                        } else {
                                            reject('No se ha seleccionado un formato.');
                                        }
                                    });
                                }
                            }).then(function (result) {
                                location.href= "index.php?r=tuberculosis/imprimir&id="+id+"&caratula="+result+"";
                            });

                        }else{
                            swal('', "¡Ocurrio un error!", 'warning');
                        }
                    });


                });

                //Termina petición de mótivo

            }else{
                swal('', datos,'warning');
            }
            //location.href= "index.php?r=tuberculosis";
        });

    });
}
function cambiarUL(ui){
    if(ui==-1){
        $("#tuberculosissearch-p03_tipoprueba").val("").trigger('change');
    }else{
        $("#tuberculosissearch-p03_tipoprueba").val(ui).trigger('change');
    }
}

function muestraImg(){
    /*var input = event.target;

    var reader = new FileReader();
    reader.onload = function(){
        var url = reader.result;
        var output = document.getElementById('output');
        output.src = url;
    };
    reader.readAsDataURL(input.files[0]);*/
}


function guardarImagen(){
    swal({
        position: 'top-end',
        type: 'success',
        title: 'El archivo se guardó correctamente.',
        showConfirmButton: false,
        timer: 1500
    })
}

