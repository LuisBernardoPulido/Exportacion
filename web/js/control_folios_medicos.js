$(document).ready(function(){
    var indice = document.getElementById('medrw_oculto').value;
    var c05_id = document.getElementById('med_oculto').value;
    document.getElementById("tipo_dict").selectedIndex = document.getElementById('tipo_dict_oculto').value-1;
    document.getElementById("mostrar").selectedIndex = document.getElementById('most_oculto').value-1;
    document.getElementById("filtro_fol").selectedIndex = document.getElementById('fol_oculto').value-1;
    document.getElementById("foliosmedicos-c05_id").selectedIndex = indice;
    if(c05_id>-1)
        activarFolios(c05_id);
});

function cargarDictamenes() {
    var med = document.getElementById('foliosmedicos-c05_id').value;
    var med_row = document.getElementById('foliosmedicos-c05_id').selectedIndex;
    var tipo = document.getElementById('tipo_dict').value;
    var mos = document.getElementById('mostrar').value;
    var fol = document.getElementById('filtro_fol').value;
    //alert("med " + med);
    if(med!='' && tipo!=''){
        if(tipo==1)
            return location.href= "index.php?r=folios-medicos%2Fcreate&tipo_dictamen=1&m="+med+"&mos="+mos+"&fol="+fol+"&mrw="+med_row;
        else if(tipo==2)
            return location.href= "index.php?r=folios-medicos%2Fcreate&tipo_dictamen=2&m="+med+"&mos="+mos+"&fol="+fol+"&mrw="+med_row;
        else if(tipo==3)
            return location.href= "index.php?r=folios-medicos%2Fcreate&tipo_dictamen=3&m="+med+"&mos="+mos+"&fol="+fol+"&mrw="+med_row;
    }
}

function cargarTabla() {
    $.pjax.reload({
        container: "#tabladic",
        timeout: false
    });

}

function guardarFolio_ver1(id_dic, folio){
    var med = document.getElementById('foliosmedicos-c05_id').value;
    var tipo = document.getElementById('tipo_dict').value;

    /***********************************************************************************************
     *****Validar si ya está asignado en un dictamen o si no está en la lista de folios usables*****
     ***********************************************************************************************/
    if(med!='' && id_dic!='' && tipo!=''){
        val = {"folio": folio.value, "id_dic":id_dic, "med":med, "tipo":tipo};
        $.ajax({
            type: 'GET',
            url: 'index.php?r=folios-medicos/haycambiofolio',
            data: val,
            dataType: "json",
            success: function (res) {
                if(res==1){//no existe el folio en r16_folios_medicos
                    /***********************************************************************************************
                     **************************Validar si el folio es usable*************************************
                     ***********************************************************************************************/
                    $.ajax({
                        type: 'GET',
                        url: 'index.php?r=folios-medicos/validarfolio',
                        data: val,
                        dataType: "json",
                        success: function (res) {
                            if(res==1){
                                swal({
                                    type: 'error',
                                    title: 'No se puede usar el folio ' + folio.value,
                                    text: 'El folio que se está intentando usar no esta en su lista de folios usables.',
                                }).catch(swal.noop);
                            }else if(res==2){
                                swal({
                                    type: 'error',
                                    title: 'No se puede usar el folio ' + folio.value,
                                    text: 'El folio que se está intentando usar ya está asignado a un dictamen.',
                                }).catch(swal.noop);
                            }else if(res==3){
                                swal({
                                    type: 'success',
                                    title: 'Es usable ' + folio.value,
                                    text: 'El folio que se está intentando usar no esta en su lista de folios usables.',
                                }).catch(swal.noop);
                            }
                        }
                    })
                }else if(res==2){//existe y el folio es diferente
                    alert("Actualizar");
                }else if(res==3){//existe y el folio es igual
                    alert("No hacer Nada");
                }
            }
        })
    }
}

function visualizarDictamen(id){
    var med = document.getElementById('foliosmedicos-c05_id').value;
    var tipo = document.getElementById('tipo_dict').value;
    var dict = null
    if(tipo==1)
        dict = window.open("index.php?r=tuberculosis/view&id="+id, '_blank');
    else if(tipo==2)
        dict = window.open("index.php?r=brucelosis/view&id="+id, '_blank');
    else if(tipo==3)
        dict = window.open("index.php?r=vacunacion/view&id="+id, '_blank');

    dict.focus();

}

function msgGuardarFolio(id){
    var med = document.getElementById('foliosmedicos-c05_id').value;
    val = {"med":med};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=folios-medicos/diasrestantes',
        data: val,
        dataType: "json",
        success: function (res) {
            if(res==1){
                swal({
                    title: 'Ingrese un folio',
                    text: 'Ingrese el folio que desea asignar al dictamen.',
                    input: 'number',
                    confirmButtonText: 'Guardar',
                    cancelButtonText: 'Cancelar',
                    //closeOnConfirm: false,
                    allowOutsideClick: false,
                    showCancelButton: true,
                    inputValidator: function (value) {
                        return new Promise(function (resolve, reject) {
                            if (value) {
                                if(value<1){
                                    reject('Necesitas ingresar un folio válido')
                                }else{
                                    resolve()
                                }
                            } else {
                                reject('Necesitas ingresar un folio')
                            }
                        })
                    }
                }).then(function (folio) {
                    guardarFolio(id, folio);
                }).catch(swal.noop);
            }else{
                swal({
                    type: 'error',
                    title: 'El médico tiene dictamen(es) pendiente(s) por entregar con más de 30 días.',
                    showConfirmButton: false,
                    timer: 3000
                }).catch(swal.noop);
            }
        }
    })
}

function msgDesasignarFolio(id_dic, folio){
    swal({
        html: '¿Desea desasignar el folio '+folio+' al dictamen?<br>',
        //input: 'number',
        type: 'warning',
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar',
        allowOutsideClick: false,
        showCancelButton: true
    }).then(function () {
        desasignarFolio(id_dic, folio);
    }).catch(swal.noop);

}

function msgCancelarFolio(id_dic, folio){
    swal({
        html: '¿Desea cancelar el folio '+folio+' del dictamen?<br>',
        //input: 'number',
        type: 'warning',
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar',
        allowOutsideClick: false,
        showCancelButton: true
    }).then(function () {
        cancelarFolio(id_dic, folio);
    }).catch(swal.noop);

}

function guardarFolio(id_dic, folio){
    var med = document.getElementById('foliosmedicos-c05_id').value;
    var tipo = document.getElementById('tipo_dict').value;

    /***********************************************************************************************
     *****Validar si ya está asignado en un dictamen o si no está en la lista de folios usables*****
     ***********************************************************************************************/
    if(med!='' && id_dic!='' && tipo!=''){
        val = {"folio": folio, "id_dic": id_dic, "tipo":tipo};
        /***********************************************************************************************
         **************************Validar si el folio es usable*************************************
         ***********************************************************************************************/
        $.ajax({
            type: 'GET',
            url: 'index.php?r=folios-medicos/validarfolio',
            data: val,
            dataType: "json",
            success: function (res) {
                if(res==0){
                    swal({
                        type: 'error',
                        title: 'No se puede asignar folio',
                        text: 'El dictamen no ha sido liberado por el laboratorio.',
                    }).catch(swal.noop);
                }else if(res==1){
                    swal({
                        type: 'error',
                        title: 'No se puede usar el folio ' + folio,
                        text: 'El folio que se está intentando usar no esta en su lista de folios usables.',
                    }).catch(swal.noop);
                }else if(res==2){
                    swal({
                        type: 'error',
                        title: 'No se puede usar el folio ' + folio,
                        text: 'El folio que se está intentando usar ya está asignado a un dictamen.',
                    }).catch(swal.noop);
                }else if(res==3){
                    swal({
                        type: 'error',
                        title: 'No se puede usar el folio ' + folio,
                        text: 'El folio que se está intentando usar está cancelado.',
                    }).catch(swal.noop);
                }else if(res==4){
                    val = {"folio": folio, "id_dic": id_dic, "tipo":tipo, "med":med};
                    $.ajax({
                        type: 'GET',
                        url: 'index.php?r=folios-medicos/guardarfolio',
                        data: val,
                        dataType: "json",
                        success: function (res) {
                            if(res){
                                swal({
                                    type: 'success',
                                    title: 'Guardado Correctamente',
                                    showConfirmButton: false,
                                    timer: 1500
                                    //text: 'El folio que se está intentando usar no esta en su lista de folios usables.',
                                }).catch(swal.noop);
                                cargarTabla();
                            }
                        }
                    })

                }
            }
        })
    }
}

function desasignarFolio(id_dic, folio){
    var med = document.getElementById('foliosmedicos-c05_id').value;
    var tipo = document.getElementById('tipo_dict').value;

    val = {"folio": folio, "id_dic": id_dic, "tipo":tipo, "med":med};
    /***********************************************************************************************
     **************************Validar si el folio es usable*************************************
     ***********************************************************************************************/
    $.ajax({
        type: 'GET',
        url: 'index.php?r=folios-medicos/eliminarfolio',
        data: val,
        dataType: "json",
        success: function (res) {
            if(res){
                swal({
                    type: 'success',
                    title: 'Se eliminó la asignación de folio correctamente',
                    showConfirmButton: false,
                    timer: 1500
                    //text: 'El folio que se está intentando usar no esta en su lista de folios usables.',
                }).catch(swal.noop);
                cargarTabla();
            }
        }
    })

}

function cancelarFolio(id_dic, folio){
    var med = document.getElementById('foliosmedicos-c05_id').value;
    var tipo = document.getElementById('tipo_dict').value;

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

    }).then(function (desc) {
        val = {"folio": folio, "id_dic": id_dic, "tipo":tipo, "med":med, "descripcion":desc};
        $.ajax({
            type: 'GET',
            url: 'index.php?r=folios-medicos/cancelarfolio',
            data: val,
            dataType: "json",
            success: function (res) {
                if(res){
                    swal({
                        type: 'success',
                        title: 'La iformación se guardó correctamente',
                        showConfirmButton: false,
                        timer: 1500
                        //text: 'El folio que se está intentando usar no esta en su lista de folios usables.',
                    }).catch(swal.noop);
                    cargarTabla();
                }
            }
        })
    }).catch(swal.noop);

}

function msgRecibirDictamen(id_dic, folio, id_fol){
    if(id_dic){
        validarUsuario(folio, id_fol, id_dic);
    }
    else{
        swal({
            html: '¿Recibir el dictamen con folio '+folio+'?<br>',
            //input: 'number',
            type: 'warning',
            confirmButtonText: 'Recibir',
            cancelButtonText: 'Cancelar',
            allowOutsideClick: false,
            showCancelButton: true
        }).then(function () {
            recibirDictamen(id_dic, folio, id_fol);
        }).catch(swal.noop);
    }
}

function msgCancelarRecepcion(id_fol, folio){
    swal({
        html: '¿Cancelar la recepción del dictamen con folio '+folio+'?<br>',
        //input: 'number',
        type: 'warning',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
        allowOutsideClick: false,
        showCancelButton: true
    }).then(function () {
        cancelarRecepcion(id_fol,folio);
    }).catch(swal.noop);
}

function recibirDictamen(id_dic, folio, id_fol){
    var med = document.getElementById('foliosmedicos-c05_id').value;
    var tipo = document.getElementById('tipo_dict').value;

    val = {"folio": folio, "id_dic": id_dic, "tipo":tipo, "med":med, "id_fol":id_fol};
    /***********************************************************************************************
     **************************Validar si el folio es usable*************************************
     ***********************************************************************************************/
    $.ajax({
        type: 'GET',
        url: 'index.php?r=folios-medicos/recibirdictamen',
        data: val,
        dataType: "json",
        success: function (res) {
            if(res){
                swal({
                    type: 'success',
                    title: 'Se recibió el dictamen.',
                    showConfirmButton: false,
                    timer: 1500
                    //text: 'El folio que se está intentando usar no esta en su lista de folios usables.',
                }).catch(swal.noop);
                cargarTabla();
            }
        }
    })

}

function cancelarRecepcion(id_fol,folio){
    var tipo = document.getElementById('tipo_dict').value;

    val = {"id_fol":id_fol, "tipo":tipo, "folio":folio};
    /***********************************************************************************************
     **************************Validar si el folio es usable*************************************
     ***********************************************************************************************/
    $.ajax({
        type: 'GET',
        url: 'index.php?r=folios-medicos/cancelarrecepcion',
        data: val,
        dataType: "json",
        success: function (res) {
            if(res){
                swal({
                    type: 'success',
                    title: 'Se canceló la recepción.',
                    showConfirmButton: false,
                    timer: 1500
                }).catch(swal.noop);
                cargarTabla();
            }
        }
    })

}

function validarUsuario(folio, id_fol, id_dic){

    val = {"id_fol":id_fol};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=folios-medicos/validarusuario',
        data: val,
        dataType: "json",
        success: function (res) {
            if(res==1){
                swal({
                    html: '¿Recibir el dictamen con folio '+folio+'?<br>',
                    type: 'warning',
                    confirmButtonText: 'Recibir',
                    cancelButtonText: 'Cancelar',
                    allowOutsideClick: false,
                    showCancelButton: true
                }).then(function () {
                    recibirDictamen(id_dic, folio, id_fol);
                }).catch(swal.noop);
            }else{
                swal({
                    type: 'error',
                    title: 'Sólo puede recibir el supervisor que entregó el folio.',
                    showConfirmButton: false,
                    timer: 2000
                }).catch(swal.noop);
            }
        }
    })
}

function dictamenesSinEntregar(){
    var med = document.getElementById('foliosmedicos-c05_id').value;
    val = {"med":med};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=folios-medicos/diasrestantes',
        data: val,
        dataType: "json",
        success: function (res) {
            if(res==1){
                alert("entra");
            }else{
                swal({
                    type: 'error',
                    title: 'El médico tiene dictamen(es) pendiente(s) por entregar con más de 30 días.',
                    showConfirmButton: false,
                    timer: 3000
                }).catch(swal.noop);
            }
        }
    })
}

function visualizarInfoAsignacion(id){
    dict = window.open("index.php?r=folios-medicos/view&id="+id, '_blank');
    dict.focus();
}

function contarSeleccionados(){
    var contador=0;
    $("input[name='dic_lista[]']").each(function() {
        if(this.checked){
            contador++;
        }
    });
    document.getElementById('seleccionados').innerHTML="<strong>"+contador+"</strong>";
    if(contador>0){
        $( "#botones_seleccion" ).fadeIn( "slow", function() {
        });
    }else{
        $( "#botones_seleccion" ).fadeOut( "slow", function() {
        });
    }
}

function contarTodos(n) {
    if($(n).is(":checked")) {
        $("input[name='dic_lista[]']").each(function() {
            if(!this.disabled){
                this.checked = true;
            }
        });
        contarSeleccionados();
    }else{
        $("input[name='dic_lista[]']").each(function() {
            this.checked = false;
        });
        contarSeleccionados();
    }
}

function msgBotones(op){
    var texto = '';
    if(op==1)
        texto = '¿Desea desasignar los folios seleccionados?<br>';
    if(op==2)
        texto = '¿Desea cancelar los folios seleccionados?<br>';
    if(op==3)
        texto = '¿Desea recibir los folios seleccionados?<br>';
    if(op==4)
        texto = '¿Desea cancelar la recepción de los folios seleccionados?<br>';
    swal({
        html: texto,
        //input: 'number',
        type: 'warning',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
        allowOutsideClick: false,
        showCancelButton: true
    }).then(function () {
        procesosBotones(op);
    }).catch(swal.noop);
}

function procesosBotones(op){
    var ids = document.getElementsByName('id_lista[]');
    var folios = document.getElementsByName('folio_lista[]');
    var med = document.getElementById('foliosmedicos-c05_id').value;
    var tipo = document.getElementById('tipo_dict').value;
    var procesosEjecutados = false;
    if(ids.length>0){
        var cont = 0;
        $("input[name='dic_lista[]']").each(function() {
            if(this.checked && folios[cont].value!=''){

                if(op == 1){
                    desasignarMultiplesFolios(ids[cont].value, folios[cont].value, med, tipo);
                    procesosEjecutados = true;
                }else if(op == 2){
                    cancelarMultiplesFolios(ids[cont].value, folios[cont].value, med, tipo);
                    procesosEjecutados = true;
                }else if(op == 3){
                    //var id_fol = getIdAsignacionFolio(folios[cont].value, tipo);
                    //alert("res2 " + id_fol);
                    recibirMultiplesDictamenes(ids[cont].value, folios[cont].value, med, tipo)
                    procesosEjecutados = true;
                }else if(op == 4){
                    cancelarMultiplesRecepciones(folios[cont].value, tipo)
                    procesosEjecutados = true;
                }

            }
            cont++;
        });

        if(procesosEjecutados){
            swal({
                type: 'success',
                title: 'La información se guardó correctamente',
                showConfirmButton: false,
                //timer: 1500
            }).catch(swal.noop);
            cargarTabla();
            /*if(op==1 || op==2)
                cargarTabla();
            else
                cargarDictamenes();*/
        }else{
            swal({
                type: 'error',
                title: 'El proceso no aplica para los dictamenes seleccionados',
                showConfirmButton: false,
            }).catch(swal.noop);
        }

    }
}

function desasignarMultiplesFolios(id_dic, folio, med, tipo){
    val = {"folio": folio, "id_dic": id_dic, "tipo":tipo, "med":med};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=folios-medicos/eliminarfolio',
        data: val,
        dataType: "json",
        success: function (res) {
            if(res){
            }
        }
    })
}

function cancelarMultiplesFolios(id_dic, folio, med, tipo){
    var desc = "Cancelación multiple";

    val = {"folio": folio, "id_dic": id_dic, "tipo":tipo, "med":med, "descripcion":desc};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=folios-medicos/cancelarfolio',
        data: val,
        dataType: "json",
        success: function (res) {
            if(res){
            }
        }
    })
}

function recibirMultiplesDictamenes(id_dic, folio, med, tipo){
    val = {"folio": folio, "id_dic": id_dic, "tipo":tipo, "med":med};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=folios-medicos/recibirdictamenesmult',
        data: val,
        dataType: "json",
        success: function (res) {
            if(res){
            }
        }
    })
}

function cancelarMultiplesRecepciones(folio, tipo){
    val = {"tipo":tipo, "folio":folio};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=folios-medicos/cancelarrecepcionmult',
        data: val,
        dataType: "json",
        success: function (res) {
            if(res){
            }
        }
    })
}

function activarFolios(med){
    val = {"med": med};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=folios-medicos/activarcampoporfolio',
        data: val,
        dataType: "json",
        success: function (res) {
            //alert("res: " + res);
            /*
            if(res){
                console.log("desacivar:" + res);
            }*/
        }
    })
}