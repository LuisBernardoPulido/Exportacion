$(document).ready(function(){

    $('#asignacionidentificadores-r23_celular').mask('000-000-0000');
    $('#asignacionidentificadores-r23_codigo_postal').mask('00000');



    $('body').on('keyup', '.select2-search__field', function() {
        var selectItem = $('.select2-container--open').prev();
        var index = selectItem.index();
        var id = selectItem.attr('id');

        if(id == 'asignacionidentificadores-r01_id' || 'asignacionidentificadoressearch-r01_id'){
            $('.select2-search__field').mask('00-000-0000-AAA');
        }else{
            $('.select2-search__field').unmask();
        }
    });
});

function validar_asignacion(){
    var id_unidad = document.getElementById('asignacionidentificadores-r01_id').value;
    if(id_unidad){
        val ={"id_unidad": id_unidad};
        $.ajax({
            type: 'GET',
            url: 'index.php?r=asignacion-identificadores/getcantidadhato',
            data: val,
            dataType: "json",
            success: function (res) {
                $.pjax.reload({container: "#tabla_aretes", timeout: false});
                if(res>0){
                    /*swal({
                        type: 'success',
                        title: 'Se pueden asignar aretes a la UPP.',
                        showConfirmButton: false,
                        timer: 1500
                    }).catch(swal.noop);*/
                    cargarProductores();
                }else{
                    swal({
                        type: 'error',
                        title: 'No se pueden asingar aretes a la unidad seleccionada.',
                        text: 'No hay vacas mayores a 12 meses.',
                    }).catch(swal.noop);
                    $('#asignacionidentificadores-r01_id').val(null).trigger('change');
                }
            }
        });
    }else if(!id_unidad){
        swal({
            type: 'error',
            title: 'No se ha seleccionado una unidad',
            //text: 'No hay vacas mayores a 12 meses.',
        }).catch(swal.noop);
    }
}

function generarAretes(){
    var cantidad = document.getElementById('asignacionidentificadores-r23_cantidad_solicitada').value;
    var id_unidad = document.getElementById('asignacionidentificadores-r01_id').value;
    var especie = document.getElementById('asignacionidentificadores-r23_especie').value;

    if(id_unidad && cantidad && especie){
        val ={"id_unidad": id_unidad};
        $.ajax({
            type: 'GET',
            url: 'index.php?r=asignacion-identificadores/getcantidadhato',
            data: val,
            dataType: "json",
            success: function (hato) {
                if(hato>=cantidad){

                    val ={"cantidad":cantidad, "especie":especie};
                    $.ajax({
                        type: 'GET',
                        url: 'index.php?r=asignacion-identificadores/generar',
                        data: val,
                        dataType: "json",
                        success: function (res) {
                            alert("res " + res);

                        }
                    });
                    //document.getElementById('asignacionidentificadores-r23_cantidad_solicitada').disabled = true;
                    document.getElementById('botonOk').disabled = true;
                    swal({
                        type: 'success',
                        title: 'Generando aretes.',
                        showConfirmButton: false,
                        timer: 1500
                    }).catch(swal.noop);
                    $.pjax.reload({container: "#tabla_aretes", timeout: false});
                }else{
                    swal({
                        type: 'error',
                        title: 'No se pueden asingar los aretes ingresados.',
                        text: 'No hay vacas mayores a 12 meses.',
                    }).catch(swal.noop);
                    document.getElementById('asignacionidentificadores-r23_cantidad_solicitada').value = "";
                }
            }
        });
    }else if(!id_unidad){
        swal({
            type: 'error',
            title: 'No se ha seleccionado una unidad.',
        }).catch(swal.noop);
    }else if(!cantidad){
        swal({
            type: 'error',
            title: 'No se ha seleccionado una cantidad.',
        }).catch(swal.noop);
    }else if(!cantidad){
        swal({
            type: 'error',
            title: 'No se ha seleccionado una especie.',
        }).catch(swal.noop);
    }
}

function cargarProductores() {
    var id_unidad = document.getElementById('asignacionidentificadores-r01_id').value;
    parametro={"id_unidad":id_unidad};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=asignacion-identificadores/ponerproductores',
        data: parametro,
        success:function(respuesta){
            document.getElementById('asignacionidentificadores-c01_id').innerHTML=respuesta;
            parametro={"id_unidad":id_unidad};
            $.ajax({
                type: 'GET',
                url: 'index.php?r=asignacion-identificadores/ponerproductoresunico',
                data: parametro,
                success:function(respuesta){
                    if(respuesta){
                        $('#asignacionidentificadores-c01_id').val(respuesta).trigger('change');
                    }
                }
            });

        }
    });
}

function edadupdate(edad, arete, tipo, raza) {
    var raza_valida = true;
    if(tipo==1 || tipo==2){
        if(edad.value == raza)
            raza_valida = false;
    }
    if(raza_valida){
        parametro = {"valor": edad.value, "arete":arete, "tipo":tipo};
        $.ajax({
            type: 'GET',
            url: 'index.php?r=asignacion-identificadores/update_arete',
            data: parametro,
            dataType: "json",
            success: function (res) {
                if(res){
                    /*swal({
                        title: "!Guardado Correctamente!",
                        type: "success",
                        timer: 800,
                        showConfirmButton: false
                    });*/
                }

            }
        });
    }else{
        swal({
            title: 'No se puede duplicar la raza en el mismo arete.',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#942626',
            confirmButtonText: 'Ok'
        }).catch(swal.noop);
    }
}