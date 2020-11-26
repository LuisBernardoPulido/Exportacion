$(document).ready(function () {
    $('body').on('keyup', '.select2-search__field', function() {
        var selectItem = $('.select2-container--open').prev();
        var index = selectItem.index();
        var id = selectItem.attr('id');

        if(id == 'exportacion-r01_origen' || id == 'exportacion-r01_destino'){
            $('.select2-search__field').mask('00-000-0000-AAA');
        }else{
            $('.select2-search__field').unmask();
        }

    });
    cargarUnidadesOrigen();
    var lista_unidades = document.getElementById('id_origen').length;
    //si tiene una sola unidad seleccionarla
    if(lista_unidades==2){
        getUnidad();
    }
    //Mostrar info de las unidades si se está editando
    iseditando();
    buscarUnidades();
});

function buscarUnidades(){
    var usuario = document.getElementById('usuario').value;
    if(usuario){
        parametro = {"usuario": usuario};
        $.ajax({
            type: 'GET',
            url: 'index.php?r=exportacion/buscarrelacion',
            data: parametro,
            //dataType: "json",
            success: function (res) {
                if (res!=-1) {
                    //return location.href= "index.php?r=ganaderos/update&id="+res+"";
                    return location.href= "index.php?r=unidades/create";
                }
            }
        });
    }

}

function iseditando(){
    var editando = document.getElementById('editando').value;
    if(editando!=-1){
        unidadOrigen();
        unidadDestino();
        borrarUrlTemp(editando);
    }
}

function getUnidad(){
    var usuario = document.getElementById('usuario').value;
    if(usuario){
        parametro = {"usuario": usuario};
        $.ajax({
            type: 'GET',
            url: 'index.php?r=internacion/getunidad',
            data: parametro,
            dataType: "json",
            success: function (res) {
                if (res) {
                    $('#id_origen').val(res).trigger('change');
                }
            }
        });
    }
}

function unidadOrigen(){
    var id_origen = document.getElementById('id_origen').value;
    if(id_origen){
        parametro = {"id": id_origen};
        $.ajax({
            type: 'GET',
            url: 'index.php?r=exportacion/unidadorigen',
            data: parametro,
            dataType: "json",
            success: function (res) {
                if (res) {
                    llenarCamposOrigen(res[0], res[1], res[2], res[3], res[4], res[5], res[6], res[7]);
                }
            }
        });

    }else{
        llenarCamposOrigen('', '', '', '', '', '', '', '');
    }
}

function unidadDestino(){
    var id_destino = document.getElementById('id_destino').value;
    if(id_destino){
        parametro = {"id": id_destino};
        $.ajax({
            type: 'GET',
            url: 'index.php?r=exportacion/unidaddestino',
            data: parametro,
            dataType: "json",
            success: function (res) {
                if (res) {
                    llenarCamposDestino(res[0], res[1], res[2], res[3], res[4], res[5], res[6], res[7], res[8], res[9], res[10], res[11], res[12], res[13]);
                }
            }
        });

    }else{
        llenarCamposDestino('', '', '', '', '', '', '', '', '', '', '', '', '', '');
    }
}

function buscarArete(){
    var arete = document.getElementById('cap_are').value;
    var especie = 1;

    if(arete.length==10 && especie) {
        parametro = {"arete": arete, "especie": especie};
        $.ajax({
            type: 'GET',
            url: 'index.php?r=exportacion/getaretebus',
            data: parametro,
            dataType: "json",
            success: function (res) {
                if(res[0]!=false){

                        document.getElementById('cap_edad').value = res[0];
                        document.getElementById('cap_raza').value = res[1];
                        document.getElementById('cap_raza2').value = res[2];
                        document.getElementById('cap_sexo').value = res[3];
                        document.getElementById('cap_tb').value = res[5];
                        document.getElementById('cap_res_tb').value = res[4];
                        document.getElementById('cap_br').value = res[7];
                        document.getElementById('cap_res_br').value = res[6];
                        document.getElementById('cap_tb').readOnly = true;
                        document.getElementById('cap_res_tb').disabled = true;
                        document.getElementById('cap_res_br').disabled = true;
                        document.getElementById('cap_br').readOnly = true;

                        edad_def = {"arete": arete, "especie": especie};
                        $.ajax({
                            type: 'GET',
                            url: 'index.php?r=exportacion/getfechadef',
                            data: edad_def,
                            success: function (existencia) {
                                if(existencia==1){
                                    document.getElementById('cap_edad').readOnly = true;
                                }else{
                                    document.getElementById('cap_edad').readOnly = false;
                                }

                            }
                        });


                }else{
                    document.getElementById('cap_edad').readOnly = false;
                }
            }
        });
    }else if(arete.length==10 && !especie){

    }
}

function agregarArete(editando){
    var numero = document.getElementById('cap_are').value;
    var edad = document.getElementById('cap_edad').value;
    var raza = document.getElementById('cap_raza').value;
    var raza2 = document.getElementById('cap_raza2').value;
    var sexo = document.getElementById('cap_sexo').value;
    var tb = document.getElementById('cap_tb').value;
    var tb_res = document.getElementById('cap_res_tb').value;
    var br_res = document.getElementById('cap_res_br').value;
    var br = document.getElementById('cap_br').value;
    var factura = document.getElementById('cap_factura').value;
    var especie = 1;

    if(tb === ""){
        mensajeErrorTexto("El arete no cuenta con folio TB");
        limpiarArete();
        document.getElementById('cap_edad').readOnly = false;
        $.pjax.reload({container: "#tabla_aretes", timeout: false});
    }else{
        if(validarCampos(numero, edad, raza, sexo, especie)){
            parametro = {"numero": numero, "especie":especie, "solicitud":editando};
            $.ajax({
                type: 'GET',
                url: 'index.php?r=exportacion/existearete',
                data: parametro,
                success: function (res2) {
                    if(res2==0){
                        parametro = {"numero": numero, "edad":edad, "raza":raza, "raza2":raza2, "sexo":sexo, "especie":especie, "solicitud":editando, "tb":tb, "br":br, "tb_res":tb_res, "br_res":br_res, "factura":factura};
                        $.ajax({
                            type: 'GET',
                            url: 'index.php?r=exportacion/agregararete',
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
                    }else{
                        mensajeErrorTexto("El arete ya existe.");
                        limpiarArete();
                    }
                    $.pjax.reload({container: "#tabla_aretes", timeout: false});

                }
            });
        }
    }
}

function validarCampos(numero, edad, raza, sexo, especie){
    if(numero && edad && raza && sexo && especie)
        return true;
    else{
        if(!numero){
            mensajeErrorTexto("No se ha ingresado un número de arete");
        }else if(!edad){
            mensajeErrorTexto("No se ha ingresado una edad");
        }else if(!raza){
            mensajeErrorTexto("No se ha ingresado una raza");
        }else if(!sexo){
            mensajeErrorTexto("No se ha ingresado un sexo");
        }else if(!especie){
            mensajeErrorTexto("No se ha ingresado una especie");
        }
        return false;
    }
}

function validarRuta(edo, pvi) {
    if(edo && pvi){
        return true;
    }else{
        if(!edo){
            mensajeErrorTexto("No se ha seleccionado un estado.");
        }else if(!pvi){
            mensajeErrorTexto("No se ha seleccionado un PVI.");
        }
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

function limpiarRuta() {
    //$('#pvi_edo').val(-1).trigger('change');
    $('#pvi_id').val(-1).trigger('change');
}

function limpiarArete(){
    document.getElementById('cap_are').value = '';
    document.getElementById('cap_raza2').value = '';
    document.getElementById('cap_tb').value = '';
    document.getElementById('cap_br').value = '';
    document.getElementById('cap_factura').value = '';
    document.getElementById('cap_tb').readOnly = false;
    document.getElementById('cap_res_tb').disabled = false;
    document.getElementById('cap_res_br').disabled = false;
    document.getElementById('cap_br').readOnly = false;
}

function llenarCamposOrigen(prod, est, lat, long, zona, senasica, usda, id_senasica){
    if(est=='LIBRE DE CUARENTENA')
        document.getElementById("origen_estatus").style.color = "#32CD32";
    else if(est){
        document.getElementById("origen_estatus").style.color = "red";
    }
    document.getElementById('origen_estatus').value = est;


}

function llenarCamposDestino(prod, calle, col, cp, edo, mpo, loc, est, lat, long, zona, senasica, usda, id_senasica) {
    //document.getElementById('destino_productor').value = prod;
    document.getElementById('destino_calle').value = calle;
    document.getElementById('destino_col').value = col;
    document.getElementById('destino_cp').value = cp;
    document.getElementById('destino_edo').value = edo;
    document.getElementById('destino_mpo').value = mpo;
    document.getElementById('destino_loc').value = loc;
    if(est=='LIBRE DE CUARENTENA')
        document.getElementById("destino_estatus").style.color = "#32CD32";
    else if(est){
        document.getElementById("destino_estatus").style.color = "red";
    }
    document.getElementById('destino_estatus').value = est;
}

function validarDocumentosbr(){
    var folio = document.getElementById('folio_br').value;
    if(folio.length>=7){
        parametro = {"folio": folio};
        $.ajax({
            type: 'GET',
            url: 'index.php?r=internacion/existedictamenbr',
            data: parametro,
            dataType: "json",
            success: function (respuesta) {
                if(respuesta==-1) {
                    document.getElementById("lbl_br").style.color = "red";
                    document.getElementById('lbl_br').textContent  = "No existe el folio.";
                    document.getElementById("img_equis_br").style.display = "block";
                    document.getElementById("img_check_br").style.display = "none";
                }else if(respuesta==-2){
                    document.getElementById("lbl_br").style.color = "red";
                    document.getElementById('lbl_br').textContent  = "Identificadores no encontrados.";
                    document.getElementById("img_equis_br").style.display = "block";
                    document.getElementById("img_check_br").style.display = "none";
                }else if(respuesta==-3){
                    document.getElementById("lbl_br").style.color = "red";
                    document.getElementById('lbl_br').textContent  = "Identificadores reactores y/o sospechosos.";
                    document.getElementById("img_equis_br").style.display = "block";
                    document.getElementById("img_check_br").style.display = "none";
                }else{
                    document.getElementById("lbl_br").style.color = "#32CD32";
                    document.getElementById('lbl_br').textContent  = "Folio e identificadores en dictamen negativos.";
                    document.getElementById("img_check_br").style.display = "block";
                    document.getElementById("img_equis_br").style.display = "none";
                }
            }
        });
    }else{
        limpiarImagenesbr();
    }
}

function limpiarImagenesbr(){
    document.getElementById("img_check_br").style.display = "none";
    document.getElementById("img_equis_br").style.display = "none";
    document.getElementById('lbl_br').textContent  = "";
}

function validarDocumentostb(){
    var folio = document.getElementById('folio_tb').value;
    if(folio.length>=7){
        parametro = {"folio": folio};
        $.ajax({
            type: 'GET',
            url: 'index.php?r=internacion/existedictamentb',
            data: parametro,
            dataType: "json",
            success: function (respuesta) {
                if(respuesta==-1) {
                    document.getElementById("lbl_tb").style.color = "red";
                    document.getElementById('lbl_tb').textContent  = "No existe el folio.";
                    document.getElementById("img_equis_tb").style.display = "block";
                    document.getElementById("img_check_tb").style.display = "none";
                }else if(respuesta==-2){
                    document.getElementById("lbl_tb").style.color = "red";
                    document.getElementById('lbl_tb').textContent  = "Identificadores no encontrados.";
                    document.getElementById("img_equis_tb").style.display = "block";
                    document.getElementById("img_check_tb").style.display = "none";
                }else if(respuesta==-3){
                    document.getElementById("lbl_tb").style.color = "red";
                    document.getElementById('lbl_tb').textContent  = "Identificadores reactores y/o sospechosos.";
                    document.getElementById("img_equis_tb").style.display = "block";
                    document.getElementById("img_check_tb").style.display = "none";
                }else{
                    document.getElementById("lbl_tb").style.color = "#32CD32";
                    document.getElementById('lbl_tb').textContent  = "Folio e identificadores en dictamen negativos.";
                    document.getElementById("img_check_tb").style.display = "block";
                    document.getElementById("img_equis_tb").style.display = "none";
                }
            }
        });
    }else{
        limpiarImagenestb();
    }
}

function limpiarImagenestb(){
    document.getElementById("img_check_tb").style.display = "none";
    document.getElementById("img_equis_tb").style.display = "none";
    document.getElementById('lbl_tb').textContent  = "";
}

function validarDocumentosgr(){
    var folio = document.getElementById('folio_gr').value;
    if(folio.length>=7){
        parametro = {"folio": folio};
        $.ajax({
            type: 'GET',
            url: 'index.php?r=internacion/existedictamengr',
            data: parametro,
            dataType: "json",
            success: function (respuesta) {
                if(respuesta==-1) {
                    document.getElementById("lbl_gr").style.color = "red";
                    document.getElementById('lbl_gr').textContent  = "No existe el folio.";
                    document.getElementById("img_equis_gr").style.display = "block";
                    document.getElementById("img_check_gr").style.display = "none";
                }else if(respuesta==-2){
                    document.getElementById("lbl_gr").style.color = "red";
                    document.getElementById('lbl_gr').textContent  = "Identificadores no encontrados.";
                    document.getElementById("img_equis_gr").style.display = "block";
                    document.getElementById("img_check_gr").style.display = "none";
                }else if(respuesta==-3){
                    document.getElementById("lbl_gr").style.color = "red";
                    document.getElementById('lbl_gr').textContent  = "Identificadores reactores y/o sospechosos.";
                    document.getElementById("img_equis_gr").style.display = "block";
                    document.getElementById("img_check_gr").style.display = "none";
                }else{
                    document.getElementById("lbl_gr").style.color = "#32CD32";
                    document.getElementById('lbl_gr').textContent  = "Folio e identificadores en dictamen negativos.";
                    document.getElementById("img_check_gr").style.display = "block";
                    document.getElementById("img_equis_gr").style.display = "none";
                }
            }
        });
    }else{
        limpiarImagenesgr();
    }
}

function limpiarImagenesgr(){
    document.getElementById("img_check_gr").style.display = "none";
    document.getElementById("img_equis_gr").style.display = "none";
    document.getElementById('lbl_gr').textContent  = "";
}

function actualizarNumero(id, num){
    parametro = {"id": id, "num":num.value};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=internacion/actualizarnum',
        data: parametro,
        success: function (res) {

        }
    });
}

function actualizarArchivo(id, arch){
    var editando = document.getElementById('editando').value;
    //se está editando
    if(editando!=-1){
        if(arch.files[0]){
            parametro = {"id": id, "arch":arch.files[0].name};
            $.ajax({
                type: 'GET',
                url: 'index.php?r=internacion/editactualizararch',
                data: parametro,
                success: function (res) {
                }
            });
        }else{
            parametro = {"id": id};
            $.ajax({
                type: 'GET',
                url: 'index.php?r=internacion/editborrararch',
                data: parametro,
                success: function (res) {
                }
            });
        }
    }else{//es registro nuevo
        if(arch.files[0]){
            parametro = {"id": id, "arch":arch.files[0].name};
            $.ajax({
                type: 'GET',
                url: 'index.php?r=internacion/actualizararch',
                data: parametro,
                success: function (res) {
                }
            });
        }else{
            parametro = {"id": id};
            $.ajax({
                type: 'GET',
                url: 'index.php?r=internacion/borrararch',
                data: parametro,
                success: function (res) {
                }
            });
        }
    }



}

function abrirUnidades(){
    window.open("index.php?r=unidades/create","_self")
}

function abrirProductores(){
    window.open("index.php?r=ganaderos/create","_self")
}

function borrarUrlTemp(id) {
    parametro = {"id": id};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=internacion/borrartemp',
        data: parametro,
        success: function (res) {
        }
    });
}

function descargarArchivo(id, nom) {

    parametro = {"id": id, "nom":nom};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=internacion/descargar',
        data: parametro,
        success: function (res) {

        }
    });
}
function cargarUnidadesOrigen() {
    //var prod = document.getElementById('prod_origen').value;
    var prod = 2

    parametro={"prod":prod};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=exportacion/getunidades',
        data: parametro,
        success:function(respuesta){
            document.getElementById('id_origen').innerHTML=respuesta;

            $.ajax({
                type: 'GET',
                url: 'index.php?r=exportacion/productororigenunico',
                data: parametro,
                success:function(respuesta){
                    if(respuesta){
                        $('#id_origen').val(respuesta).trigger('change');
                    }
                }
            });
        }
    });
}

function cargarUnidadesDestino() {
    var prod = document.getElementById('prod_destino').value;
    parametro={"prod":prod};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=exportacion/getunidades',
        data: parametro,
        success:function(respuesta){
            document.getElementById('id_destino').innerHTML=respuesta;

            //ver si sólo tiene una unidad para ponerla por default
            //parametro={"prod":prod};
            $.ajax({
                type: 'GET',
                url: 'index.php?r=exportacion/productororigenunico',
                data: parametro,
                success:function(respuesta){
                    if(respuesta){
                        $('#id_destino').val(respuesta).trigger('change');
                    }
                }
            });

        }
    });
}
