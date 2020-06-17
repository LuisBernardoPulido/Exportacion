
$(document).ready(function(){
    $('body').on('keyup', '.select2-search__field', function() {
        var selectItem = $('.select2-container--open').prev();
        var index = selectItem.index();
        var id = selectItem.attr('id');

        if(id == 'brucelosissearch-r01_id'){
            $('.select2-search__field').mask('00-000-0000-AAA');
        }else{
            $('.select2-search__field').unmask();
        }
    });
});

function checarFolio(id, folio) {

    if(folio==-1) {
        swal({
            title: 'Ingrese un folio',
            text: 'Es necesario proporcionar un folio para proseguir con la impresión del dictamen de BR.',
            input: 'text',
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
            /*swal({
             type: 'success',
             html: 'You entered: ' + result
             })*/
            swal.disableButtons();
            $.get("index.php?r=brucelosis/nuevofolio&id="+id+"&folio="+result, function(datos){
                if(datos==1){
                    //location.href= "index.php?r=brucelosis/imprimir&id="+id+"";
                    swal({
                        title: 'Seleccionar Caratula BR.',
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
                        location.href= "index.php?r=brucelosis/imprimir&id="+id+"&caratula="+result+"";
                    });

                }else{
                    swal('', datos,'warning');
                }
            });

        });
    }else{
        swal({
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
                title: 'Seleccionar Caratula BR.',
                input: 'select',
                inputOptions: {
                    '1': 'Carátula anterior',
                    '2': 'Carátula nueva',
                    '5': 'Carátula última versión',
                    '6': 'Carátula anterior *nueva complementaria*',
                    '7': 'Carátula nueva *nueva complementaria*',
                    '8': 'Carátula última versión *nueva complementaria*'
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
                /*swal({
                    type: 'success',
                    html: 'You selected: ' + result
                });*/
                location.href= "index.php?r=brucelosis/imprimir&id="+id+"&caratula="+result+"";
            });
        });
    }

}
function cambiarFolio(id, folio) {
    swal({
        //title: 'Ingrese un nuevo folio',
        text: 'Ingrese un nuevo número de folio',
        input: 'text',
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
        $.get("index.php?r=brucelosis/otrofolio&id="+id+"&folio="+result+"&anterior="+folio, function(datos){
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
                    $.get("index.php?r=brucelosis/addmotivofolio&descripcion="+result+"&anterior="+folio, function(datos) {
                        if(datos==1){
                            //location.href= "index.php?r=brucelosis/imprimir&id="+id+"";
                            swal({
                                title: 'Seleccionar Caratula BR.',
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
                                location.href= "index.php?r=brucelosis/imprimir&id="+id+"&caratula="+result+"";
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
        });

    });
}

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
        $.get("index.php?r=brucelosis/deletedictamen&id="+id+"&motivo="+result, function(datos){
            if(datos==1){
                //mandar la impresion
                location.href= "index.php?r=brucelosis/deletedictamen&id="+id+"&motivo="+result+"";

            }else{
                swal('', datos,'warning');
            }
        });

    });
}

function verifResp(id, caso) {
    parametro = {"id": id};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=brucelosis/tieneresponsable',
        data: parametro,
        success: function (respuesta) {
            if (respuesta) {

                swal({
                    html: '¿Desea imprimir la hoja de resultados con el número de caso '+caso+'?<br><a href="#" onclick="cambiarResponsable('+id+')" style="text-decoration: underline; font-size: 13px;">Cambiar responsable de la técnica</a>',
                    //html: '¿Desea imprimir la hoja de resultados con el número de caso '+caso+'?<br><a href="#" ">Cambiar folio</a>',
                    //input: 'number',
                    type: 'warning',
                    confirmButtonText: 'Imprimir',
                    cancelButtonText: 'Cancelar',
                    allowOutsideClick: false,
                    showCancelButton: true
                }).then(function (result) {
                    /*******************
                     Imprimir hoja de resultados
                     ********************/
                    location.href= "index.php?r=brucelosis/descargar&id="+id+"";
                });

            }else{

                swal({
                    title: 'Ingrese un responsable de la técnica',
                    text: 'Es necesario proporcionar un responsable de la técnica para proseguir con la impresión.',
                    input: 'text',
                    confirmButtonText: 'Imprimir',
                    cancelButtonText: 'Cancelar',
                    //closeOnConfirm: false,
                    allowOutsideClick: false,
                    showCancelButton: true,
                    inputValidator: function (value) {
                        return new Promise(function (resolve, reject) {
                            if (value) {
                                if(value<1){
                                    reject('¡Necesitas ingresar un responsable!')
                                }else{
                                    resolve()
                                }
                            } else {
                                reject('¡Necesitas ingresar el responsable!')
                            }
                        })
                    }
                }).then(function (result) {
                    /*swal({
                     type: 'success',
                     html: 'You entered: ' + result
                     })*/
                    swal.disableButtons();
                    $.get("index.php?r=brucelosis/guardarresponsable&id="+id+"&responsable="+result, function(datos){
                        if(datos==1){
                            //mandar la impresion
                            location.href= "index.php?r=brucelosis/descargar&id="+id+"";

                        }else{
                            swal('', datos,'warning');
                        }
                    });

                });

            }
        }
    });
}

function cambiarResponsable(id) {
    swal({
        //title: 'Ingrese un nuevo folio',
        text: 'Ingrese un nuevo responsable',
        input: 'text',
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
                        reject('¡Necesitas ingresar un responsable!')
                    }else{
                        resolve()
                    }
                } else {
                    reject('¡Necesitas ingresar el responsable!')
                }
            })
        }
    }).then(function (result) {
        swal.disableButtons();
        $.get("index.php?r=brucelosis/guardarresponsable&id="+id+"&responsable="+result, function(datos){
            if(datos==1){
                location.href= "index.php?r=brucelosis/descargar&id="+id+"";
            }else{
                swal('', datos,'warning');
            }
        });

    });
}

function descargar(id, caso){
    return location.href= "index.php?r=brucelosis&rec=1&dic="+id+"&ncas="+caso;
}

function liberar(id, liberado, lab){
        if(liberado){
            swal({
                title: '',
                text: '¿Cancelar la liberación del dictamen?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#942626',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, cancelar la liberación',
                cancelButtonText: 'Cancelar',
            }).then(function (res) {
                parametro = {"id": id, "liberar": '0', "lab":lab};
                $.ajax({
                    type: 'GET',
                    url: 'index.php?r=brucelosis/liberar',
                    data: parametro,
                    success: function (respuesta) {
                        if(respuesta){
                            swal({
                                title: "Se canceló la liberación",
                                type: "success",
                                showConfirmButton: false
                            }).catch(swal.noop);
                            location.reload();
                        }else{
                            swal({
                                type: 'error',
                                title: 'No se pudo cancelar la liberación.',
                                text: 'Ocurrió un error al tratar de guardar una(s) prueba(s).',
                                timer: 2500
                            }).catch(swal.noop);
                            location.reload();
                        }
                    }
                });
            }).catch(swal.noop);
        }else{
            if(id != -1){
                swal({
                    title: '',
                    text: '¿Liberar el dictamen?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#942626',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, liberar el dictamen',
                    cancelButtonText: 'Cancelar',
                }).then(function (res) {
                    parametro = {"id": id, "liberar": '1', "lab":lab};
                    $.ajax({
                        type: 'GET',
                        url: 'index.php?r=brucelosis/liberar',
                        data: parametro,
                        success: function (respuesta) {
                            if(respuesta){
                                swal({
                                    title: "Se liberó el dictamen",
                                    type: "success",
                                    showConfirmButton: false
                                }).catch(swal.noop);
                                location.reload();
                            }else{
                                swal({
                                    type: 'error',
                                    title: 'No se pudo liberar la prueba.',
                                    text: 'Ocurrió un error al tratar de guardar una(s) prueba(s).',
                                    timer: 2500
                                }).catch(swal.noop);
                                location.reload();
                            }
                        }
                    });
                }).catch(swal.noop);
            }else{
                swal({
                    type: 'error',
                    title: 'No se puede liberar la prueba.',
                    text: 'La prueba seleccionada no tiene número de caso.',
                }).catch(swal.noop);
            }
        }
}

function imprimirHojaRes(id) {
    location.href= "index.php?r=brucelosis/descargar&id="+id+"";
}


