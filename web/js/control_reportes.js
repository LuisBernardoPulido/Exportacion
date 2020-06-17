/*$(document).ready(function(){
    var contenido ="<html xmlns:o=\'urn:schemas-microsoft-com:office:office\' xmlns:x=\'urn:schemas-microsoft-com:office:excel\' xmlns=\'http://www.w3.org/TR/REC-html40\'><head><meta http-equiv=\'Content-Type\' content=\'text/html;charset=utf-8\'/><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>ExportWorksheet</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>";
    contenido=contenido+document.getElementById('grid_acc').innerHTML+ "</table></body></html>";
    $('#excel').html(contenido);
});


function generar() {
    var contenido ="<html xmlns:o=\'urn:schemas-microsoft-com:office:office\' xmlns:x=\'urn:schemas-microsoft-com:office:excel\' xmlns=\'http://www.w3.org/TR/REC-html40\'><head><meta http-equiv=\'Content-Type\' content=\'text/html;charset=utf-8\'/><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>ExportWorksheet</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>";
    contenido=contenido+document.getElementById('grid_acc').innerHTML+ "</table></body></html>";
    $('#excel').html(contenido);
}*/

$(document).ready(function(){
    $('body').on('keyup', '.select2-search__field', function() {
        var selectItem = $('.select2-container--open').prev();
        var index = selectItem.index();
        var id = selectItem.attr('id');

        if(id == 'upp_per_aretes' || id == 'unidadesfolios'){
            $('.select2-search__field').mask('00-000-0000-AAA');
        }else{
            $('.select2-search__field').unmask();
        }
    });
});

function reportes() {
    var e = document.getElementById('todos');
    var strUser = e.options[e.selectedIndex].value;
    $( "#panel-info-mpc" ).fadeIn( "fast", function() {});
    switch (parseInt(strUser)){
        case 1:
            $( "#cengorda" ).fadeOut( "fast", function() {});
            $( "#cotros" ).fadeOut( "fast", function() {});
            $( "#clab" ).fadeOut( "fast", function() {});
            $( "#cmvz" ).fadeOut( "fast", function() {});
            $( "#ctrazabilidad" ).fadeOut( "fast", function() {});
            $( "#cmedicos" ).fadeOut( "fast", function() {
                $( "#caretes" ).fadeOut( "fast", function() {
                    $( "#cdictamenes" ).fadeOut( "fast", function() {
                        $( "#cupp" ).fadeIn( "fast", function() {});
                    });
                });
            });
            break;

        case 2:
            $( "#cengorda" ).fadeOut( "fast", function() {});
            $( "#cotros" ).fadeOut( "fast", function() {});
            $( "#clab" ).fadeOut( "fast", function() {});
            $( "#cmvz" ).fadeOut( "fast", function() {});
            $( "#ctrazabilidad" ).fadeOut( "fast", function() {});
            $( "#cupp" ).fadeOut( "fast", function() {
                $( "#cmedicos" ).fadeOut( "fast", function() {
                    $( "#cdictamenes" ).fadeOut( "fast", function() {
                        $( "#caretes" ).fadeIn( "fast", function() {});
                    });
                });
            });
            break;

        case 3:
            $( "#cengorda" ).fadeOut( "fast", function() {});
            $( "#cotros" ).fadeOut( "fast", function() {});
            $( "#clab" ).fadeOut( "fast", function() {});
            $( "#cupp" ).fadeOut( "fast", function() {});
            $( "#cmvz" ).fadeOut( "fast", function() {});
            $( "#ctrazabilidad" ).fadeOut( "fast", function() {});
            $( "#caretes" ).fadeOut( "fast", function() {
                $( "#cdictamenes" ).fadeOut( "fast", function() {
                    $( "#cmedicos" ).fadeIn( "fast", function() {});
                });
            });
            break;

        case 4:
            $( "#cengorda" ).fadeOut( "fast", function() {});
            $( "#cotros" ).fadeOut( "fast", function() {});
            $( "#clab" ).fadeOut( "fast", function() {});
            $( "#cupp" ).fadeOut( "fast", function() {});
            $( "#cmvz" ).fadeOut( "fast", function() {});
            $( "#ctrazabilidad" ).fadeOut( "fast", function() {});
            $( "#cmedicos" ).fadeOut( "fast", function() {
                $( "#caretes" ).fadeOut( "fast", function() {
                    $( "#cdictamenes" ).fadeIn( "fast", function() {});
                });
            });
            break;
        case 5:
            $( "#ctrazabilidad" ).fadeOut( "fast", function() {
                $( "#cmvz" ).fadeOut( "fast", function() {
                    $( "#cengorda" ).fadeOut( "fast", function() {
                        $( "#clab" ).fadeOut( "fast", function() {
                            $( "#cmedicos" ).fadeOut( "fast", function() {
                                $( "#caretes" ).fadeOut( "fast", function() {
                                    $( "#cdictamenes" ).fadeOut( "fast", function() {
                                        $( "#cupp" ).fadeOut( "fast", function() {
                                            $( "#cotros" ).fadeIn( "fast", function() {});
                                        });
                                    });
                                });
                            });
                        });
                    });
                });
            });
            break;
        case 6:
            $( "#ctrazabilidad" ).fadeOut( "fast", function() {
                $( "#cmvz" ).fadeOut( "fast", function() {
                    $( "#cengorda" ).fadeOut( "fast", function() {
                        $( "#cmedicos" ).fadeOut( "fast", function() {
                            $( "#caretes" ).fadeOut( "fast", function() {
                                $( "#cdictamenes" ).fadeOut( "fast", function() {
                                    $( "#cupp" ).fadeOut( "fast", function() {
                                        $( "#cotros" ).fadeOut( "fast", function() {
                                            $( "#clab" ).fadeIn( "fast", function() {});
                                        });
                                    });
                                });
                            });
                        });
                    });
                });
            });
            break;
        case 8:
            $( "#ctrazabilidad" ).fadeOut( "fast", function() {
                $( "#cmvz" ).fadeOut( "fast", function() {
                    $( "#clab" ).fadeOut( "fast", function() {
                        $( "#cmedicos" ).fadeOut( "fast", function() {
                            $( "#caretes" ).fadeOut( "fast", function() {
                                $( "#cdictamenes" ).fadeOut( "fast", function() {
                                    $( "#cupp" ).fadeOut( "fast", function() {
                                        $( "#cotros" ).fadeOut( "fast", function() {
                                            $( "#clab" ).fadeOut( "fast", function() {
                                                $( "#cengorda" ).fadeIn( "fast", function() {});
                                            });
                                        });
                                    });
                                });
                            });
                        });
                    });
                });
            });
            break;
        case 9:
            limpiar();
            break;
        case 10:
            $( "#ctrazabilidad" ).fadeOut( "fast", function() {
                $( "#cengorda" ).fadeOut( "fast", function() {
                    $( "#clab" ).fadeOut( "fast", function() {
                        $( "#cmedicos" ).fadeOut( "fast", function() {
                            $( "#caretes" ).fadeOut( "fast", function() {
                                $( "#cdictamenes" ).fadeOut( "fast", function() {
                                    $( "#cupp" ).fadeOut( "fast", function() {
                                        $( "#cotros" ).fadeOut( "fast", function() {
                                            $( "#clab" ).fadeOut( "fast", function() {
                                                $( "#cmvz" ).fadeIn( "fast", function() {});
                                            });
                                        });
                                    });
                                });
                            });
                        });
                    });
                });
            });
            break;
        case 11://Trazabilidad
            $( "#cmvz" ).fadeOut( "fast", function() {
                $( "#cengorda" ).fadeOut( "fast", function() {
                    $( "#clab" ).fadeOut( "fast", function() {
                        $( "#cmedicos" ).fadeOut( "fast", function() {
                            $( "#caretes" ).fadeOut( "fast", function() {
                                $( "#cdictamenes" ).fadeOut( "fast", function() {
                                    $( "#cupp" ).fadeOut( "fast", function() {
                                        $( "#cotros" ).fadeOut( "fast", function() {
                                            $( "#clab" ).fadeOut( "fast", function() {
                                                $( "#ctrazabilidad" ).fadeIn( "fast", function() {});
                                            });
                                        });
                                    });
                                });
                            });
                        });
                    });
                });
            });
            break;
        case 12:
            limpiar();
            break;
        case 13:
            limpiar();
            break;
    }
}

function limpiar(){
    $( "#ctrazabilidad" ).fadeOut( "fast", function() {
        $( "#clab" ).fadeOut( "fast", function() {
            $( "#cmedicos" ).fadeOut( "fast", function() {
                $( "#caretes" ).fadeOut( "fast", function() {
                    $( "#cdictamenes" ).fadeOut( "fast", function() {
                        $( "#cupp" ).fadeOut( "fast", function() {
                            $( "#cotros" ).fadeOut( "fast", function() {
                                $( "#clab" ).fadeOut( "fast", function() {
                                    $( "#cengorda" ).fadeOut( "fast", function() {});
                                });
                            });
                        });
                    });
                });
            });
        });
    });
}

function medicos_check() {
    var e = document.getElementById('medicos');
    var strUser = e.options[e.selectedIndex].value;
    switch (parseInt(strUser)) {
        case 0:
            $("#contenido_pcc").fadeIn("fast", function () {

            });
            break;
        case 1:
            $("#contenido_pcc").fadeIn("fast", function () {

            });
            break;
    }
}
function aretes() {
    var e = document.getElementById('aretes');
    var strUser = e.options[e.selectedIndex].value;
    switch (parseInt(strUser)){
        case 0:$( "#show_upp" ).fadeOut( "fast", function() {
            $( "#arete_trazabilidad" ).fadeOut( "fast", function() {
            });
        });
            break;
        case 1:
            $( "#arete_trazabilidad" ).fadeOut( "fast", function() {
                $( "#show_upp" ).fadeIn( "fast", function() {});
            });
            break;
        case 2:$( "#show_upp" ).fadeOut( "fast", function() {
            $( "#arete_trazabilidad" ).fadeIn( "fast", function() {
                $('#arete_traza').mask('0000000000');
            });
        });
    }
}
function upps() {
    var e = document.getElementById('upp');
    var strUser = e.options[e.selectedIndex].value;
    switch (parseInt(strUser)){
        case 0:$( "#show_upp_upp" ).fadeOut( "fast", function() {});
            break;
        case 1:
            $( "#show_upp_upp" ).fadeIn( "fast", function() {});

            break;
    }
}
function dictamenes() {
    var e = document.getElementById('dictamenes');
    var strUser = e.options[e.selectedIndex].value;
    switch (parseInt(strUser)){
        case 0:
            $( "#show_upp_dictamen" ).fadeOut( "fast", function() {
                $( "#folio_div" ).fadeIn( "fast", function() {

                });
            });
            break;
        case 1:$( "#folio_div" ).fadeOut( "fast", function() {
            $( "#show_upp_dictamen" ).fadeIn( "fast", function() {

            });
        });
            break;
    }
}
function check_button() {
    var e = document.getElementById('todos');
    var tipo=0;
    var respuesta_folio;
    var strUser = e.options[e.selectedIndex].value;
    switch (parseInt(strUser)){
        case 2:
            var aux = document.getElementById('aretes');
            if(aux.options[aux.selectedIndex].value==0){
                tipo=1;
            }else if(aux.options[aux.selectedIndex].value==1){
                //upp_per_aretes
                var upp_per_aretes = document.getElementById('upp_per_aretes').value;
                tipo=2;

            }else{
                //Trazabilidad por arete
                var arete_traza = document.getElementById('arete_traza').value;
                var especie = document.getElementById('especie_tra').value;
                if(validarTrazabilidad(especie, arete_traza)){
                    tipo = 3;
                    upp_per_aretes=null;
                    var arete = document.getElementById('arete_traza').value;
                    return location.href= "index.php?r=site/reportes&tipo=2&arete="+arete+"&especie="+especie+"";
                }
            }
            break;
        case 3:
            var aux = document.getElementById('medicos');
            if(aux.options[aux.selectedIndex].value==0) {
                var desde = document.getElementById('desde_pccs').value;
                var hasta = document.getElementById('hasta_pccs').value;
                upp_per_aretes=null;
                return location.href= "index.php?r=site/reportes&tipo=5&desde="+desde+"&hasta="+hasta;
            }else if(aux.options[aux.selectedIndex].value==1){
                var desde = document.getElementById('desde_pccs').value;
                var hasta = document.getElementById('hasta_pccs').value;
                upp_per_aretes=null;
                return location.href= "index.php?r=site/reportes&tipo=8&desde="+desde+"&hasta="+hasta;
            }
            break;
        case 4:
            var aux = document.getElementById('dictamenes');
            switch (parseInt(aux.options[aux.selectedIndex].value)){
                case 0:
                    var foliodictamen = document.getElementById('folioid').value;
                    parametro = {"folio": foliodictamen};
                    $.ajax({
                        type: 'GET',
                        url: 'index.php?r=site/check_folio',
                        data: parametro,
                        dataType: "json",
                        success: function (res) {
                            //console.log("Respuesta recibida: "+res[0])
                            respuesta_folio=1;
                            if(res[0]==1){
                                return location.href= "index.php?r=site/folios&status=1&isin="+res[1]+"&id="+res[2];
                            }else{
                                return location.href= "index.php?r=site/reportes&tipo=4&upp=null";
                            }

                        }
                    });

                    break;
                case 1: var unidad = document.getElementById('unidadesfolios').value;
                    return location.href= "index.php?r=site/folios&tipo=1&upp="+unidad;

                    break;
            }
            break;
        case 5:
            var aux = document.getElementById('otros');
            if(aux.options[aux.selectedIndex].value==0) {
                var desde = document.getElementById('id_desde_tasa').value;
                var hasta = document.getElementById('id_hasta_tasa').value;
                upp_per_aretes=null;
                var aux_filtro = document.getElementById('otros_filtro');
                var filtro = 0;
                if(aux_filtro.options[aux_filtro.selectedIndex].value!='')
                    filtro = aux_filtro.options[aux_filtro.selectedIndex].value;
                return location.href= "index.php?r=site/reportes&tipo=6&desde="+desde+"&hasta="+hasta+"&filtro="+filtro;
            }else if(aux.options[aux.selectedIndex].value==1){
                var desde = document.getElementById('id_desde_tasa').value;
                var hasta = document.getElementById('id_hasta_tasa').value;
                upp_per_aretes=null;
                var aux_filtro = document.getElementById('otros_filtro');
                var filtro = 0;
                if(aux_filtro.options[aux_filtro.selectedIndex].value!='')
                    filtro = aux_filtro.options[aux_filtro.selectedIndex].value;
                return location.href= "index.php?r=site/reportes&tipo=7&desde="+desde+"&hasta="+hasta+"&filtro="+filtro;
            }else if(aux.options[aux.selectedIndex].value==2){
                var desde = document.getElementById('id_desde_tasa').value;
                var hasta = document.getElementById('id_hasta_tasa').value;
                upp_per_aretes=null;
                var aux_filtro = document.getElementById('otros_filtro');
                var filtro = 0;
                if(aux_filtro.options[aux_filtro.selectedIndex].value!='')
                    filtro = aux_filtro.options[aux_filtro.selectedIndex].value;
                return location.href= "index.php?r=site/reportes&tipo=16&desde="+desde+"&hasta="+hasta+"&filtro="+filtro;
            }else if(aux.options[aux.selectedIndex].value==3){
                var medico = document.getElementById('lista_medicos').value;
                return location.href= "index.php?r=site/reportes&tipo=10&med="+medico;
            }
            break;
        case 6:
            var aux = document.getElementById('lab');
            if(aux.options[aux.selectedIndex].value==0) {
                var desde = document.getElementById('id_desde_lab').value;
                var hasta = document.getElementById('id_hasta_lab').value;
                upp_per_aretes=null;
                return location.href= "index.php?r=site/reportes&tipo=9&desde="+desde+"&hasta="+hasta;
            }else if(aux.options[aux.selectedIndex].value==1) {
                var desde = document.getElementById('id_desde_lab').value;
                var hasta = document.getElementById('id_hasta_lab').value;
                upp_per_aretes=null;
                return location.href= "index.php?r=site/reportes&tipo=11&desde="+desde+"&hasta="+hasta;
            }
            break;
        case 8:
            var aux = document.getElementById('cengorda_filtro');
            if(aux.options[aux.selectedIndex].value==0) {//Mostrar todo
                upp_per_aretes=null;
                return location.href= "index.php?r=site/reportes&tipo=12";
            }else if(aux.options[aux.selectedIndex].value==1) {//Rango de Fechas por Entrada
                var desde = document.getElementById('id_desde_eng').value;
                var hasta = document.getElementById('id_hasta_eng').value;
                upp_per_aretes=null;
                return location.href= "index.php?r=site/reportes&tipo=13&desde="+desde+"&hasta="+hasta;
            }else if(aux.options[aux.selectedIndex].value==2) {//Rango de Fechas por Salida
                var desde = document.getElementById('id_desde_eng').value;
                var hasta = document.getElementById('id_hasta_eng').value;
                upp_per_aretes=null;
                return location.href= "index.php?r=site/reportes&tipo=14&desde="+desde+"&hasta="+hasta;
            }else if(aux.options[aux.selectedIndex].value==3) {//Por Corral
                var corral = document.getElementById('corral_eng').value;
                upp_per_aretes=null;
                return location.href= "index.php?r=site/reportes&tipo=15&co="+corral;
            }
            break;
        case 11:
            reporteTrazabilidad();
            break;
    }
    if(respuesta_folio!=null) {

        if (arete_traza) {
            location.href = "index.php?r=site/reportes&tipo=" + tipo + "&upp=" + upp_per_aretes + "&arete=" + arete_traza;
        } else {
            location.href = "index.php?r=site/reportes&tipo=" + tipo + "&upp=" + upp_per_aretes;
        }
    }


}
function descargarExcel(){
    var tmpElemento = document.createElement('a');
    var data_type = 'data:application/vnd.ms-excel';
    var tabla_div = document.getElementById('w3');
    var tabla_html = tabla_div.outerHTML.replace(/ /g, '%20');
    tmpElemento.href = data_type + ', ' + tabla_html;
    tmpElemento.download = 'Hato_Por_Upp.xls';
    tmpElemento.click();
}
function imprimir_button(tipo, upp) {
    //location.href= "index.php?r=site/reportes&tipo="+tipo+"&upp="+upp+"&imprimir="+1;
}
function actionContacto(){

}

function validarTrazabilidad(especie, arete){
    var valido = true;
    if(arete.length!=10){
        valido = false;
        swal("Arete Inválido.", "El arete debe tener 10 dígitos.")
            .catch(swal.noop);
    }else if(especie.length==0) {
        valido = false;
        swal("Especie Inválida.", "No se ha seleccionado una especie.")
            .catch(swal.noop);
    }

    if(valido){
        valores = {"arete": arete, "especie": especie};
        $.ajax({
            type: 'GET',
            url: 'index.php?r=aretes/existearete',
            data: valores,
            success: function (existe) {
                if(existe==1){
                    valido = true;
                }else{
                    valido = false;
                    alert("El arete no existe.");
                    //swal("El arete no existe.", "El arete ingresado no existe.")
                    //    .catch(swal.noop);
                    /*
                    swal({
                        title: 'Aviso',
                        text: 'El arete no existe',
                        type: 'warning',
                        showCancelButton: false,
                        confirmButtonColor: '#942626',
                        confirmButtonText: 'Ok'
                    });*/
                }
            }
        });
    }

    return valido;
}
function otros_check() {
    var e = document.getElementById('otros');
    var strUser = e.options[e.selectedIndex].value;
    switch (parseInt(strUser)) {
        case 0:
            $("#filtro_cf_medicos").fadeOut("slow", function () {
                $("#filtro_cf").fadeIn("slow", function () {

                });
                e = document.getElementById('otros_filtro');
                strUser = e.options[e.selectedIndex].value;
                if(parseInt(strUser)!=4){
                    $("#contenido_tasas").fadeIn("slow", function () {

                    });
                }
            });
            break;
        case 1:
            $("#filtro_cf_medicos").fadeOut("slow", function () {
                $("#filtro_cf").fadeIn("slow", function () {

                });
                e = document.getElementById('otros_filtro');
                strUser = e.options[e.selectedIndex].value;
                if(parseInt(strUser)!=4){
                    $("#contenido_tasas").fadeIn("slow", function () {

                    });
                }
            });
            break;
        case 2:
            $("#filtro_cf_medicos").fadeOut("slow", function () {
                $("#filtro_cf").fadeIn("slow", function () {

                });
                e = document.getElementById('otros_filtro');
                strUser = e.options[e.selectedIndex].value;
                if(parseInt(strUser)!=4){
                    $("#contenido_tasas").fadeIn("slow", function () {

                    });
                }
            });
            break;
        case 3:
            $("#contenido_tasas").fadeOut("slow", function () {
            });$("#filtro_cf").fadeOut("slow", function () {
            $("#filtro_cf_medicos").fadeIn("slow", function () {});
        });
            break;
    }
}
function otros_filtro_check() {
    var e = document.getElementById('otros_filtro');
    var strUser = e.options[e.selectedIndex].value;
    if(parseInt(strUser)==4){
        $("#contenido_tasas").fadeOut("fast", function () {
        });
    }else{
        $("#contenido_tasas").fadeIn("fast", function () {
        });
    }
}

function lab_check() {
    var e = document.getElementById('lab');
    var strUser = e.options[e.selectedIndex].value;
    switch (parseInt(strUser)) {
        case 0:
            $("#contenido_lab").fadeIn("fast", function () {

            });
            break;
        case 1:
            $("#contenido_lab").fadeIn("fast", function () {

            });
            break;
    }
}

function engorda_check() {
    var e = document.getElementById('cengorda_check');
    var strUser = e.options[e.selectedIndex].value;
    switch (parseInt(strUser)){
        case 0:
            $( "#filtro_cengorda" ).fadeIn( "fast", function() { });
            //$( "#contenido_engorda" ).fadeIn( "fast", function() { });
            //$( "#corral_engorda" ).fadeOut( "fast", function() { });
            break;
        case 1:
            $( "#filtro_cengorda" ).fadeIn( "fast", function() { });
            $( "#contenido_engorda" ).fadeIn( "fast", function() { });
            $( "#corral_engorda" ).fadeOut( "fast", function() { });
            break;
        case 2:
            $( "#filtro_cengorda" ).fadeOut( "fast", function() { });
            $( "#contenido_engorda" ).fadeOut( "fast", function() { });
            $( "#corral_engorda" ).fadeIn( "fast", function() { });
            break;
    }
}

function engorda_filtro() {
    var e = document.getElementById('cengorda_filtro');
    var strUser = e.options[e.selectedIndex].value;
    switch (parseInt(strUser)){
        case 0:
            $( "#contenido_engorda" ).fadeOut( "fast", function() { });
            $( "#corral_engorda" ).fadeOut( "fast", function() { });
            break;
        case 1:
            $( "#contenido_engorda" ).fadeIn( "fast", function() { });
            $( "#corral_engorda" ).fadeOut( "fast", function() { });
            break;
        case 2:
            $( "#contenido_engorda" ).fadeIn( "fast", function() { });
            $( "#corral_engorda" ).fadeOut( "fast", function() { });
            break;
        case 3:
            $( "#contenido_engorda" ).fadeOut( "fast", function() { });
            $( "#corral_engorda" ).fadeIn( "fast", function() { });
            break;
    }
}

function reporteTrazabilidad(){
    //Trazabilidad por arete
    var arete_traza = document.getElementById('arete_trazab').value;
    var especie = document.getElementById('especie_trazabilidad').value;
    if(validarTrazabilidad(especie, arete_traza)){
        tipo = 3;
        upp_per_aretes=null;
        //var arete = document.getElementById('arete_traza').value;
        return location.href= "index.php?r=site/reportes&tipo=2&arete="+arete_traza+"&especie="+especie+"";
    }
}
