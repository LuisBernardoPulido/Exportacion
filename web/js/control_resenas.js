$(document).ready(function(){
    document.getElementById("especc").selectedIndex = document.getElementById('especie').value-1;
    var editando = document.getElementById("editando").value;
    $('.select2-search__field').mask('00-000-0000-AAA');
    $('#por_arete').mask('000000000000');
    $('#edad_por_arete_ind').mask('0000000000');
    $('.edadtabla').mask('0000000000');
    mostrar_totales_count(0);
    check_pendientes();
    habilitar_elementos(editando);
});
$( "#bus_arete" ).keyup(function() {

    var arete = document.getElementById('bus_arete').value
    if(arete.length>0){
        parametro = {"arete": arete};
        $.ajax({
            type: 'GET',
            url: 'index.php?r=resenas/getareteupp',
            data: parametro,
            dataType: "json",
            success: function (res) {
                if (res) {
                    document.getElementById('bus_edad').value = res[0];
                    document.getElementById('bus_raza1').value = res[1];
                    document.getElementById('bus_raza2').value = res[2];
                    var sexo = "";
                    if(res[3]==0)
                        sexo = "MACHO";
                    else if(res[3]==1)
                        sexo = "HEMBRA";
                    document.getElementById('bus_sexo').value = sexo;
                    document.getElementById('bus_upp').value = res[4];
                }
            }
        });

    }else{
        document.getElementById('bus_edad').value = "";
        document.getElementById('bus_raza1').value = "";
        document.getElementById('bus_raza2').value = "";
        document.getElementById('bus_sexo').value = "";
        document.getElementById('bus_upp').value = "";
    }

});

$( document ).ready(function() {
    $( "#lotespor" ).fadeOut( "slow", function() {
        $( "#aretespor" ).fadeIn( "slow", function() {
            document.getElementById('por_arete').focus();
        });
    })
});


function cambiarOpcion(){
    var e = document.getElementById('tipopor').value;
    if(e==1){
        $( "#lotespor" ).fadeOut( "slow", function() {
            $( "#aretespor" ).fadeIn( "slow", function() {});
        })
    }else{
        $( "#aretespor" ).fadeOut( "slow", function() {
            $( "#lotespor" ).fadeIn( "slow", function() {});
        });
    }
}
function cargarUnidades() {
    var gan = document.getElementById('resenas-p01_ganadero');

    parametro={"ganadero":gan.value};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=resenas/poner_upps',
        data: parametro,
        success:function(respuesta){
            document.getElementById('resenas-p01_upp').innerHTML=respuesta;
        }
    });
}

function generar(tipo, idResena){

    var i = document.getElementById('inicio').value;
    var f = document.getElementById('fin').value;

    var especie = document.getElementById('especc').value;

    var it = parseInt(i);
    var fn = parseInt(f);
    var uno =1;
    var diferencia = fn-it+1;


    if(i.length==0 || f.length==0 || i.length<10 || f.length<10){
        $( "#error_mensaje2" ).fadeIn( "slow", function() {});
    }else{

        if(diferencia>50) {
            swal({
                title: '',
                text: '¿Estás seguro de ingresar ' + diferencia + ' aretes?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#942626',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, estoy de acuerdo',
                cancelButtonText: 'Cancelar',
            }).then(function ($res) {

                document.getElementById('inicio').value = '';
                document.getElementById('fin').value = '';
                $("#error_mensaje2").fadeOut("slow", function () {
                    parametro = {"inicio": i, "fin": f, "tipo": tipo, "idResena": idResena, "esp":especie};
                    $.ajax({
                        type: 'GET',
                        url: 'index.php?r=resenas/lotes',
                        data: parametro,
                        success: function (respuesta) {
                            $.pjax.reload({container: "#tablat", timeout: false});  //Reload GridView

                        }
                    });
                });

                //Termina function afirmativa
            })
        }else{
            document.getElementById('inicio').value = '';
            document.getElementById('fin').value = '';
            $("#error_mensaje2").fadeOut("slow", function () {
                parametro = {"inicio": i, "fin": f, "tipo": tipo, "idResena": idResena, "esp":especie};
                $.ajax({
                    type: 'GET',
                    url: 'index.php?r=resenas/lotes',
                    data: parametro,
                    success: function (respuesta) {
                        $.pjax.reload({container: "#tablat", timeout: false});  //Reload GridView

                    }
                });
            });
        }
    }
    mostrar_totales_count(1);
}


function arete(tipo, idResena){
    //get valores
    var i = document.getElementById('por_arete').value;
    var edad = document.getElementById('edad_por_arete_ind').value;
    var raza1 = document.getElementById('raza_por_arete_ind').value;
    var raza2 = document.getElementById('raza2_por_arete_ind').value;
    var sexo = document.getElementById('sexo_por_arete_ind').value;
    var especie = document.getElementById('especc').value;
    var upp_destino = document.getElementById('resenas-p01_upp').value;

    if(raza1 == raza2){
        swal({
            title: 'No se puede duplicar la raza en el mismo arete.',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#942626',
            confirmButtonText: 'Ok'
        }).catch(swal.noop);
    }else {

        if (i.length == 0 || i.length < 10) {
            $("#error_mensaje2").fadeIn("slow", function () {
            });
        } else {
            $("#error_mensaje2").fadeOut("slow", function () {
                parametro = {
                    "inicio": i,
                    "tipo": tipo,
                    "idResena": idResena,
                    "edad": edad,
                    "raza1": raza1,
                    "raza2": raza2,
                    "sexo": sexo,
                    "esp": especie,
                    "destino": upp_destino
                };
                $.ajax({
                    type: 'GET',
                    url: 'index.php?r=resenas/porarete',
                    data: parametro,
                    success: function (respuesta) {
//alert("respuesta " + respuesta);
                        if (respuesta == 0) {
                            swal({
                                title: 'Ya existe el arete en la reseña.',
                                type: 'warning',
                                showCancelButton: false,
                                confirmButtonColor: '#942626',
                                confirmButtonText: 'Ok'
                            }).then(
                                function () {
                                    document.getElementById('por_arete').value = parseInt(i) + 1;
                                    document.getElementById('edad_por_arete_ind').value = edad;
                                    document.getElementById('raza2_por_arete_ind').value = raza2;
                                    document.getElementById('raza_por_arete_ind').value = raza1;
                                    document.getElementById('sexo_por_arete_ind').value = 1;
                                    document.getElementById('por_arete').focus();
                                    document.getElementById('por_arete').select();
                                },

                                function (dismiss) {
                                    if (dismiss === 'timer') {
                                        console.log('I was closed by the timer')
                                    }
                                }
                            )
                        } else if (respuesta == 1) {
                            //document.getElementById('edad_por_arete_ind').focus();
                            var upp = "";
                            bus = {"numero": i};
                            $.ajax({
                                type: 'GET',
                                url: 'index.php?r=resenas/buscarupp',
                                data: bus,
                                success: function (upp_res) {
                                    var titulo = 'El arete ya existe';
                                    var texto = "El arete está en la unidad " + upp_res + ", ¿Desea cambiar el arete " + i + " a la UPP actual?.";
                                    var boton = 'Sí, cambiar de UPP';
                                    parametro = {"inicio": i};
                                    $.ajax({
                                        type: 'GET',
                                        url: 'index.php?r=resenas/areteupp',
                                        data: parametro,
                                        success: function (respuesta) {
                                            swal({
                                                title: titulo,
                                                text: texto,
                                                type: 'warning',
                                                showCancelButton: true,
                                                confirmButtonColor: '#942626',
                                                cancelButtonColor: '#d33',
                                                confirmButtonText: 'Sí, cambiar de UPP',
                                                cancelButtonText: 'Cancelar',
                                            }).then(function (result) {
                                                parametro = {"destino": upp_destino, "arete": i};
                                                $.ajax({
                                                    type: 'GET',
                                                    url: 'index.php?r=resenas/cambioupp',
                                                    data: parametro,
                                                    success: function (respuesta) {
                                                        if (respuesta) {
                                                            edad = document.getElementById('edad_por_arete_ind').value;
                                                            $("#error_mensaje2").fadeOut("slow", function () {
                                                                parametro = {
                                                                    "inicio": i,
                                                                    "tipo": tipo,
                                                                    "idResena": idResena,
                                                                    "edad": edad,
                                                                    "raza1": raza1,
                                                                    "raza2": raza2,
                                                                    "sexo": sexo,
                                                                    "esp": especie
                                                                };
                                                                $.ajax({
                                                                    type: 'GET',
                                                                    url: 'index.php?r=resenas/porareteexistente',
                                                                    data: parametro,
                                                                    success: function (respuesta) {
                                                                        if (respuesta) {
                                                                            $.pjax.reload({
                                                                                container: "#tablat",
                                                                                timeout: false
                                                                            });
                                                                            document.getElementById('por_arete').value = parseInt(i) + 1;
                                                                            document.getElementById('edad_por_arete_ind').value = edad;
                                                                            document.getElementById('raza2_por_arete_ind').value = raza2;
                                                                            document.getElementById('raza_por_arete_ind').value = raza1;
                                                                            document.getElementById('sexo_por_arete_ind').value = 1;
                                                                            document.getElementById('por_arete').focus();
                                                                            document.getElementById('por_arete').select();
                                                                            buscarArete();
                                                                        }
                                                                    }
                                                                });
                                                            });
                                                        }
                                                    }
                                                });
                                            });
                                        }
                                    });
                                }
                            });
                        } else if (respuesta == 2) {
//                        buscarArete();
//                        edad = document.getElementById('edad_por_arete_ind').value;
                            //document.getElementById('edad_por_arete_ind').focus();
                            parametro = {"destino": upp_destino, "arete": i};
                            $.ajax({
                                type: 'GET',
                                url: 'index.php?r=resenas/cambioupp',
                                data: parametro,
                                success: function (respuesta) {
                                    if (respuesta) {
                                        edad = document.getElementById('edad_por_arete_ind').value;
//alert("res 2.1, edad " + edad);
                                        $("#error_mensaje2").fadeOut("slow", function () {
                                            parametro = {
                                                "inicio": i,
                                                "tipo": tipo,
                                                "idResena": idResena,
                                                "edad": edad,
                                                "raza1": raza1,
                                                "raza2": raza2,
                                                "sexo": sexo,
                                                "esp": especie
                                            };
                                            $.ajax({
                                                type: 'GET',
                                                url: 'index.php?r=resenas/porareteexistente',
                                                data: parametro,
                                                success: function (respuesta) {
//alert("res 2.2, edad " + edad);
                                                    if (respuesta) {
                                                        $.pjax.reload({container: "#tablat", timeout: false});
                                                        document.getElementById('por_arete').value = parseInt(i) + 1;
                                                        document.getElementById('edad_por_arete_ind').value = edad;
                                                        document.getElementById('raza2_por_arete_ind').value = raza2;
                                                        document.getElementById('raza_por_arete_ind').value = raza1;
                                                        document.getElementById('sexo_por_arete_ind').value = 1;
                                                        document.getElementById('por_arete').focus();
                                                        document.getElementById('por_arete').select();
                                                        buscarArete();
                                                    }
                                                }
                                            });
                                        });
                                    }
                                }
                            });
                        } else {
                            $.pjax.reload({container: "#tablat", timeout: false});
                            document.getElementById('por_arete').value = parseInt(i) + 1;
                            document.getElementById('edad_por_arete_ind').value = edad;
                            document.getElementById('raza2_por_arete_ind').value = raza2;
                            document.getElementById('raza_por_arete_ind').value = raza1;
                            document.getElementById('sexo_por_arete_ind').value = 1;
                            document.getElementById('por_arete').focus();
                            document.getElementById('por_arete').select();
                            buscarArete();
                        }
                    }
                });
            });


        }
    }
    mostrar_totales_count(1);
}

function asignarUPP() {
    var id= document.getElementById('resenas-p01_upp').value;
    if(id){
        $( ".bloquearetes" ).fadeIn( "slow", function() {});
        parametro = {"upp": id};
        $.ajax({
            type: 'GET',
            url: 'index.php?r=resenas/totalhato',
            data: parametro,
            success: function (respuesta) {
                if (respuesta) {
                    document.getElementById('hato').value = respuesta;
                }
            }
        });
        $.ajax({
            type: 'GET',
            url: 'index.php?r=resenas/tieneproductor',
            data: parametro,
            success: function (respuesta) {
                if (respuesta) {
                    if(respuesta==0){
                        swal("UPP sin productor.", "La UPP no tiene productor asociado.")
                            .catch(swal.noop);
                        //document.getElementById('resenas-p01_upp').value = '';
                        //$("#resenas-p01_upp").fadeOut("slow", function () {});
                    }
                }
            }
        });
    }else{
        $( ".bloquearetes" ).fadeOut( "slow", function() {});
    }
}

function cambioespecie($tipo, $resena) {
    var especie = document.getElementById('especc').value;
    $("#por_arete").attr('maxlength','10');
    document.getElementById('por_arete').value = "";
    document.getElementById('edad_por_arete_ind').readOnly = false;
    //var id = document.getElementById('idupp').value;
    if(especie==1)
        return location.href= "index.php?r=resenas%2Fcreate&especie=1";
    else if(especie==2)
        return location.href= "index.php?r=resenas%2Fcreate&especie=2";
    else
        return location.href= "index.php?r=resenas%2Fcreate&especie=3";

    /*parametro = {"especie": especie, "tipo":$tipo, "resena": $resena};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=resenas/cambiarespecies',
        data: parametro,
        success: function (respuesta) {
            $.pjax.reload({container: "#tablat", timeout: false});  //Reload GridView
        }
    });*/

}

function buscarArete(){
    var arete = document.getElementById('por_arete').value;
    var upp_actual = document.getElementById('resenas-p01_upp').value;
    if(arete.length>0) {
        var especie = document.getElementById('especc').value;
        parametro = {"arete": arete, "especie": especie};
        $.ajax({
            type: 'GET',
            url: 'index.php?r=resenas/getaretebus',
            data: parametro,
            dataType: "json",
            success: function (res) {
                if(res[0]!=false){
                    if (res) {
                        par_situacion = {"arete": arete, "upp": upp_actual, "especie": especie};
                        $.ajax({
                            type: 'GET',
                            url: 'index.php?r=resenas/situacionupp',
                            data: par_situacion,
                            success: function (existencia) {
//alert("existencia " + existencia);
                                document.getElementById('edad_por_arete_ind').value = res[0];
                                if (existencia==1) {
                                    //swal("El arete ya existe.", "El arete está en la lista actual de reseña.")
                                    //    .catch(swal.noop);
                                    //document.getElementById('por_arete').value = '';
                                    //document.getElementById('por_arete').focus();
                                    //document.getElementById('por_arete').select();
                                }else if(existencia==2){
                                    //swal("El arete ya existe.", "El arete ya fue reseñado en esta UPP.")
                                    //    .catch(swal.noop);
                                }else if(existencia==3){
                                    //swal("El arete ya existe.", "El arete está en otra UPP.")
                                    //    .catch(swal.noop);
                                }else if(existencia==4){
                                    swal("El arete ya existe.", "El arete está pendiente de reseñar con otro usuario.")
                                        .catch(swal.noop);
                                }else if(existencia==7){
                                    //swal("El arete actualmente esta desactivado.", "El arete fue desactivado por otro usuario.")
                                    //  .catch(swal.noop);
                                }
                                if(existencia==1 || existencia==2 || existencia==3 || existencia==4){
                                    document.getElementById('edad_por_arete_ind').value = res[0];
                                    document.getElementById('raza_por_arete_ind').value = res[1];
                                    document.getElementById('raza2_por_arete_ind').value = res[2];
                                    document.getElementById('sexo_por_arete_ind').value = res[3];
                                    //document.getElementById('edad_por_arete_ind').focus();

                                    edad_def = {"arete": arete, "especie": especie};
                                    $.ajax({
                                        type: 'GET',
                                        url: 'index.php?r=resenas/getfechadef',
                                        data: edad_def,
                                        success: function (existencia) {
//alert("existencia " + existencia + " edad " + res[0]);
                                            if(existencia==1){
                                                document.getElementById('edad_por_arete_ind').readOnly = true;
                                            }else{
                                                document.getElementById('edad_por_arete_ind').readOnly = false;
                                            }
                                        }
                                    });

                                }
                            }
                        });
                    }
                }else{
                    document.getElementById('edad_por_arete_ind').readOnly = false;
                }
            }
        });
    }
}

function mostrar_totales_count(band){
    var table = $("#w1 .summary b");
    if(table[0]){
        if(band==0){
            document.getElementById("totales_res").textContent = table[0].textContent;
            document.getElementById("totales_res_total").textContent = table[1].textContent;
        }else{
            var uno = parseInt(table[1].textContent);
            uno++;
            document.getElementById("totales_res").textContent = "1 - "+uno;
            document.getElementById("totales_res_total").textContent = uno+"";
        }


    }

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
            url: 'index.php?r=resenas/update_arete',
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

function cambia_focus(){
    document.getElementById('por_arete').focus();
}

function check_pendientes() {
    var arete = document.getElementById('idupp').value
    var especie = document.getElementById('especc').value;
    var esp_str = "BOVINOS";
    if(especie==2)
        esp_str = "CAPRINOS";
    if(especie==3)
        esp_str = "OVINOS";

    if(arete==-1) {

        parametro = {"especie": especie};
        $.ajax({
            type: 'GET',
            url: 'index.php?r=resenas/pendientes',
            data: parametro,
            dataType: "json",
            success: function (res) {
                if (res==1) {
                    $("#panel-info-tb").fadeIn("slow", function () {

                    });

                    swal({
                        title: 'Reseña de ' + esp_str,
                        text: 'Hay aretes ' + esp_str +' pendientes por reseñar.',
                        type: 'warning',
                        showCancelButton: false,
                        confirmButtonColor: '#942626',
                        confirmButtonText: 'Ok'
                    }).catch(swal.noop);
                }else{
                    swal({
                        title: 'Reseña de ' + esp_str,
                        type: 'warning',
                        showCancelButton: false,
                        confirmButtonColor: '#942626',
                        confirmButtonText: 'Ok'
                    }).catch(swal.noop);
                }

            }
        });
    }
}

function habilitar_elementos(editando){
    if(!editando) {
        document.getElementById('especc').disabled = true;

        var id= document.getElementById('resenas-p01_upp').value;
        if(id){
            $( ".bloquearetes" ).fadeIn( "slow", function() {});
            parametro = {"upp": id};
            $.ajax({
                type: 'GET',
                url: 'index.php?r=resenas/totalhato',
                data: parametro,
                success: function (respuesta) {
                    if (respuesta) {
                        document.getElementById('hato').value = respuesta;
                    }
                }
            });
        }
    }
}
