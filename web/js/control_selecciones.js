$( document ).ready(function() {
    //mensaje();
    revisa_tb();
    revisa_br();
    revisa_vc();
    revisa_gr();
    if(document.getElementById('inup').value) {
        document.getElementById("seleccionprevia-c01_id").selectedIndex = document.getElementById('inup').value;
        cargarProductores();
    }
    detectarFiltro();
    $('.azultabla').mask('000000');
    $('body').on('keyup', '.select2-search__field', function() {
        var selectItem = $('.select2-container--open').prev();
        var index = selectItem.index();
        var id = selectItem.attr('id');

        if(id == 'seleccionprevia-c01_id'){
            $('.select2-search__field').mask('00-000-0000-AAA');
        }else{
            $('.select2-search__field').unmask();
        }
    });

});

function otroMot() {
    var selectItem = $('.select2-container--open').prev();
    var index = selectItem.index();
    var val = selectItem.val();

    if(val == 121 ){
        $('#garrapatas-p03_otro_motivo').val("");
        $( "#otMot").fadeIn( "fast", function() {});
    }else{
        $('#garrapatas-p03_otro_motivo').val("-");
        $( "#otMot").fadeOut( "fast", function() {});
    }
}

function mensaje(){
    swal({
        title: '¿Desea imprimir el dictamen con el folio?',
        //input: 'number',
        html: '<a href="//sweetalert2.github.io">cambiar folio</a> ',
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
            /*swal({
                type: 'success',
                html: 'You selected: ' + result
            });*/
            location.href= "index.php?r=brucelosis/imprimir&id="+id+"&caratula="+result+"";
        });
    });

}

$(document).on('ready pjax:success', function () {
    $('.ajaxDelete').on('click', function (e) {
        e.preventDefault();

        var url = $(this).attr('url');
        var grid = $(this).attr('grid');
        var param = $(this).attr('param');

        var parametros = document.getElementById(param);

        var accion = {
            type: 'POST',
            data: $(parametros).serialize(),
            url: url,
            cache: false,
            success: function (html) {
                eval(html);
                if (accion.error) {
                    swal(accion.msj,'','warning');
                } else {
                    $.pjax.reload({container: '#' + grid, timeout: 5000});
                    swal(accion.msj, '','success');
                }
            }
        };
        swal({
            title: 'Advertencia',
            text:'¿Desea eliminar este arete de la UPP?',
            type:'warning',
            showCancelButton: true,
            confirmButtonColor: '#942626',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Eliminar',
            cancelButtonText: "Cancelar",
            //closeOnConfirm: false,
            allowOutsideClick: false
        }).then(function ($res) {
            swal.disableButtons();
            //console.log("Si")
            //console.log(accion)
            $.ajax(accion);
            cargarHatoTotalidadEliminar();
        });

    });

});

function cargarHatoTotalidadEliminar() {
    var upp = document.getElementById('seleccionprevia-c01_id').value;
    //cargarProductores();
    limpiarfiltros(0);

    parametro = {"upp": upp};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=seleccion-previa/agregarhatototalidad',
        data: parametro,
        success: function (respuesta) {
            $.pjax.reload({container: "#tablat", timeout: false});  //Reload GridView


        },
        error : function(response){
            console.log(response);
        }
    });
}

function cargarHatoTotalidad() {
    var upp = document.getElementById('seleccionprevia-c01_id').value;
    //cargarProductores();
    limpiarfiltros(0);
    if(upp!=''){
        parametro = {"upp": upp};
        $.ajax({
            type: 'GET',
            url: 'index.php?r=seleccion-previa/agregarhatototalidad',
            data: parametro,
            success: function (respuesta) {
                $.pjax.reload({container: "#tablat", timeout: false});  //Reload GridView


            },
            error : function(response){
                console.log(response);
            }
        });
    }
}

function todos_br(n) {
    if($(n).is(":checked")) {
        $("input[name='br_respuesta[]']").each(function() {
            this.checked = true;
        });
        revisa_br();
    }else{
        $("input[name='br_respuesta[]']").each(function() {
            this.checked = false;
            //console.log( this.value + ":" + this.checked );
        });
        revisa_br();
    }
}
function todos_tb(n) {
    if($(n).is(":checked")) {
        $("input[name='tb_respuesta[]']").each(function() {
            if(!this.disabled){
                this.checked = true;
            }

        });
        revisa_tb();
    }else{
        $("input[name='tb_respuesta[]']").each(function() {
            this.checked = false;
            //console.log( this.value + ":" + this.checked );
        });
        revisa_tb();
    }
}
//Selecciona o deselecciona todos los campos de la lista
function todos_gr(n) {
    if($(n).is(":checked")) {
        $("input[name='gr_respuesta[]']").each(function() {
            if(!this.disabled){
                this.checked = true;
            }

        });
        revisa_gr();
    }else{
        $("input[name='gr_respuesta[]']").each(function() {
            this.checked = false;
            //console.log( this.value + ":" + this.checked );
        });
        revisa_gr();
    }
}

function revisa_gr() {
    var contador_true=0;
    $("input[name='gr_respuesta[]']").each(function() {
        if(this.checked){
            contador_true++;
        }
    });
    document.getElementById('totalesgrnum').innerHTML="<strong>"+contador_true+"</strong>";
    if(contador_true>0){
        var axuliar_id = document.getElementById('auxliar_id').value;
        if(axuliar_id==-1) {
            $("#garrapatas-r01_id").select2("val", "");
            //$("#garrapatas-c01_id").select2("val", "");
            $('#garrapatas-p03_cal_banado').val("");
            $('#garrapatas-p03_fec_ult_trata').val("");
            $("#garrapatas-c17_id").select2("val", "");
            $("#garrapatas-c07_id").select2("val", "");
            $('#garrapatas-p03_destino').select2("val", "")
            $("#garrapatas-p03_municipio").select2("val", "");
            $("#garrapatas-p03_estado").select2("val", "");
            $('#garrapatas-p03_ruta1').val("");
            $('#garrapatas-p03_transporte').val("");
            $('#garrapatas-p03_marca').val("");
            $('#garrapatas-p03_placas').val("");
            $('#garrapatas-p03_capacidad').val("");
            $('#garrapatas-p03_fec_exp').val("");
            $('#garrapatas-p03_fec_venc').val("");
        }else{
            var axuliar_gr = document.getElementById('auxliar_gr').value;
            if(axuliar_gr==-1) {
                $("#garrapatas-r01_id").select2("val", "");
                //$("#garrapatas-c01_id").select2("val", "");
                $('#garrapatas-p03_cal_banado').val("");
                $('#garrapatas-p03_fec_ult_trata').val("");
                $("#garrapatas-c17_id").select2("val", "");
                $("#garrapatas-c07_id").select2("val", "");
                $('#garrapatas-p03_destino').select2("val", "")
                $("#garrapatas-p03_municipio").select2("val", "");
                $("#garrapatas-p03_estado").select2("val", "");
                $('#garrapatas-p03_ruta1').val("");
                $('#garrapatas-p03_transporte').val("");
                $('#garrapatas-p03_marca').val("");
                $('#garrapatas-p03_placas').val("");
                $('#garrapatas-p03_capacidad').val("");
                $('#garrapatas-p03_fec_exp').val("");
                $('#garrapatas-p03_fec_venc').val("");
            }
        }
        $( "#contenido_gr" ).fadeIn( "slow", function() {

        });

    }else{
        var mot_exp = document.getElementsByName('motivo_exp');
        for (var i = 0, length = mot_exp.length; i < length; i++){
            if (mot_exp[i].checked){
                exp = mot_exp[i].value;
                break;
            }
        }
        $( "#contenido_gr" ).fadeOut( "slow", function() {
            var axuliar_id = document.getElementById('auxliar_id').value;
            if (axuliar_id == -1) {
                $('#garrapatas-c01_id').val("1");
                $('#garrapatas-r01_id').val("51514");
                $('#garrapatas-p03_cal_banado').val("1");
                $('#garrapatas-p03_fec_ult_trata').val("2017-03-13 09:25");
                $('#garrapatas-c17_id').val("1");
                $('#garrapatas-c07_id').val("114");
                $('#garrapatas-p03_destino').val("1");
                $('#garrapatas-p03_municipio').val("2301");
                $('#garrapatas-p03_estado').val("32");
                $('#garrapatas-p03_ruta1').val("-");
                $('#garrapatas-p03_otro_motivo').val("-");
                $('#garrapatas-p03_transporte').val("-");
                $('#garrapatas-p03_marca').val("1");
                $('#garrapatas-p03_placas').val("1");
                $('#garrapatas-p03_capacidad').val("1");
                $('#garrapatas-p03_fec_exp').val("2017-03-13 09:25");
                $('#garrapatas-p03_fec_venc').val("2017-03-13 09:25");
                if(exp==1)
                    $('#garrapatas-c07_id').val("116");
                else
                    $('#garrapatas-c07_id').val("115");

            }else {
                var axuliar_gr = document.getElementById('auxliar_gr').value;
                if (axuliar_gr == -1) {
                    $('#garrapatas-c01_id').val("1");
                    $('#garrapatas-r01_id').val("51514");
                    $('#garrapatas-p03_cal_banado').val("1");
                    $('#garrapatas-p03_fec_ult_trata').val("2017-03-13 09:25");
                    $('#garrapatas-c17_id').val("1");
                    $('#garrapatas-c07_id').val("114");
                    $('#garrapatas-p03_destino').val("1");
                    $('#garrapatas-p03_municipio').val("2301");
                    $('#garrapatas-p03_estado').val("32");
                    $('#garrapatas-p03_ruta1').val("-");
                    $('#garrapatas-p03_otro_motivo').val("-");
                    $('#garrapatas-p03_transporte').val("-");
                    $('#garrapatas-p03_marca').val("1");
                    $('#garrapatas-p03_placas').val("1");
                    $('#garrapatas-p03_capacidad').val("1");
                    $('#garrapatas-p03_fec_exp').val("2017-03-13 09:25");
                    $('#garrapatas-p03_fec_venc').val("2017-03-13 09:25");
                    if(exp==1)
                        $('#garrapatas-c07_id').val("116");
                    else
                        $('#garrapatas-c07_id').val("115");
                }
            }
        });
    }
}

function revisa_tb() {
  //Esta función va a deshabilitar o habilitar el div de campos complementarios TB
    var contador_true=0;
    $("input[name='tb_respuesta[]']").each(function() {
        if(this.checked){
            contador_true++;
        }
    });
    document.getElementById('totalestbnum').innerHTML="<strong>"+contador_true+"</strong>";
    if(contador_true>0){
        var axuliar_id = document.getElementById('auxliar_id').value;
        if(axuliar_id==-1) {
            $('#tuberculosis-p03_finyeccion').val("");
            $('#tuberculosis-p03_flectura').val("");
            $("#tuberculosis-p03_motivoprueba").select2("val", "");
            $("#tuberculosis-p03_tipoprueba").select2("val", "");
            $("#tuberculosis-p03_funczoo").select2("val", "");
        }else{
            var axuliar_tb = document.getElementById('auxliar_tb').value;
            if(axuliar_tb==-1){
                $('#tuberculosis-p03_finyeccion').val("");
                $('#tuberculosis-p03_flectura').val("");
                $("#tuberculosis-p03_motivoprueba").select2("val", "");
                $("#tuberculosis-p03_tipoprueba").select2("val", "");
                $("#tuberculosis-p03_funczoo").select2("val", "");
            }
        }
        $( "#contenido_tb" ).fadeIn( "slow", function() {

        });
    }else{
        $( "#contenido_tb" ).fadeOut( "slow", function() {
            var axuliar_id = document.getElementById('auxliar_id').value;
            var radio = document.getElementsByName('opmotivo');
            for (var i = 0, length = radio.length; i < length; i++){
                if (radio[i].checked){
                    mov = radio[i].value;
                    break;
                }
            }
            var mot_exp = document.getElementsByName('motivo_exp');
            for (var i = 0, length = mot_exp.length; i < length; i++){
                if (mot_exp[i].checked){
                    exp = mot_exp[i].value;
                    break;
                }
            }
            if(axuliar_id==-1) {
                $('#tuberculosis-p03_finyeccion').val("2017-03-13 09:25");
                $('#tuberculosis-p03_flectura').val("2017-03-13 09:25");
                $('#tuberculosis-p03_tipoprueba').val("1");
                $('#tuberculosis-p03_funczoo').val("1");
                /*Quitar esta linea al activar arete azul*/
                //$('#tuberculosis-p03_motivoprueba').val("1");
                if(mov==1)
                    $('#tuberculosis-p03_motivoprueba').val("17");
                else if(exp==1)
                    $('#tuberculosis-p03_motivoprueba').val("15");
                else
                    $('#tuberculosis-p03_motivoprueba').val("1");
            }else{
                var axuliar_tb = document.getElementById('auxliar_tb').value;
                if(axuliar_tb==-1){
                    $('#tuberculosis-p03_finyeccion').val("2017-03-13 09:25");
                    $('#tuberculosis-p03_flectura').val("2017-03-13 09:25");
                    $('#tuberculosis-p03_tipoprueba').val("1");
                    $('#tuberculosis-p03_funczoo').val("1");
                    /*Quitar siguiente linea al activar arete azul*/
                    //$('#tuberculosis-p03_motivoprueba').val("1");
                    if(mov==1)
                        $('#tuberculosis-p03_motivoprueba').val("17");
                    else if(exp==1)
                        $('#tuberculosis-p03_motivoprueba').val("15");
                    else
                        $('#tuberculosis-p03_motivoprueba').val("1");
                }
            }
        });
    }
}


function todos_vc(n) {
    if($(n).is(":checked")) {
        $("input[name='vc_respuesta[]']").each(function() {
            if(!this.disabled){
                this.checked = true;
            }
        });
        revisa_vc();
    }else{
        $("input[name='vc_respuesta[]']").each(function() {
            this.checked = false;
            //console.log( this.value + ":" + this.checked );
        });
        revisa_vc();
    }
}

function revisa_br() {
    //Esta función va a deshabilitar o habilitar el div de campos complementarios TB
    var contador_true=0;
    $("input[name='br_respuesta[]']").each(function() {
        if(this.checked){
            contador_true++;
        }
    });
    document.getElementById('totalesbrnum').innerHTML="<strong>"+contador_true+"</strong>";
    if(contador_true>0){
        var axuliar_id = document.getElementById('auxliar_id').value;
        if(axuliar_id==-1) {
            $('#brucelosis-p03_fmuestreo').val("");
            $("#brucelosis-p03_motivoprueba").select2("val", "");
            $("#brucelosis-p03_tipoprueba").select2("val", "");
            $("#brucelosis-p03_laboratorio").select2("val", "");
            $("#brucelosis-p03_funczoo").select2("val", "");
        }else{
            var axuliar_br = document.getElementById('auxliar_br').value;
            if(axuliar_br==-1){
                $('#brucelosis-p03_fmuestreo').val("");
                $("#brucelosis-p03_motivoprueba").select2("val", "");
                $("#brucelosis-p03_tipoprueba").select2("val", "");
                $("#brucelosis-p03_laboratorio").select2("val", "");
                $("#brucelosis-p03_funczoo").select2("val", "");
            }
        }

        $( "#contenido_br" ).fadeIn( "slow", function() {});
    }else{

        $( "#contenido_br" ).fadeOut( "slow", function() {
            var axuliar_id = document.getElementById('auxliar_id').value;
            var mot_exp = document.getElementsByName('motivo_exp');
            for (var i = 0, length = mot_exp.length; i < length; i++){
                if (mot_exp[i].checked){
                    exp = mot_exp[i].value;
                    break;
                }
            }

            if(axuliar_id==-1) {
                $('#brucelosis-p03_fmuestreo').val("2017-03-13 09:25");
                $('#brucelosis-p03_tipoprueba').val("2");
                $('#brucelosis-p03_laboratorio').val("56");
                $('#brucelosis-p03_funczoo').val("1");
                /*Desactivar siguiente linea al activar azul*/
                //$('#brucelosis-p03_motivoprueba').val("9");
                if(exp==1)
                    $('#brucelosis-p03_motivoprueba').val("11");
                else
                    $('#brucelosis-p03_motivoprueba').val("9");
            }else{
                var axuliar_br = document.getElementById('auxliar_br').value;
                if(axuliar_br==-1){
                    $('#brucelosis-p03_fmuestreo').val("2017-03-13 09:25");
                    $('#brucelosis-p03_tipoprueba').val("2");
                    $('#brucelosis-p03_laboratorio').val("56");
                    $('#brucelosis-p03_funczoo').val("1");
                    /*Quitar la siguiente linea al activar azul*/
                    //$('#brucelosis-p03_motivoprueba').val("9");
                    if(exp==1)
                        $('#brucelosis-p03_motivoprueba').val("11");
                    else
                        $('#brucelosis-p03_motivoprueba').val("9");
                }
            }
        });
    }
}

function revisa_vc() {
    //Esta función va a deshabilitar o habilitar el div de campos complementarios VC
    var contador_true=0;
    $("input[name='vc_respuesta[]']").each(function() {
        if(this.checked){
            contador_true++;
        }
    });
    document.getElementById('totalesvcnum').innerHTML="<strong>"+contador_true+"</strong>";
    if(contador_true>0){
        var axuliar_id = document.getElementById('auxliar_id').value;
        if(axuliar_id==-1) {
            $("#vacunacion-p03_tipohato").select2("val", "");
            $('#vacunacion-p03_fexpedicion').val("");
            $('#vacunacion-p03_laboratorio').val("");
        }else{
            var axuliar_vc = document.getElementById('auxliar_vc').value;

            if(axuliar_vc==-1){
                $("#vacunacion-p03_tipohato").select2("val", "");
                $('#vacunacion-p03_fexpedicion').val(" ");
                $('#vacunacion-p03_laboratorio').val("");
            }
        }
        $( "#contenido_vc" ).fadeIn( "slow", function() {});
    }else{
        $( "#contenido_vc" ).fadeOut( "slow", function() {
            var axuliar_id = document.getElementById('auxliar_id').value;
            if(axuliar_id==-1) {
                $('#vacunacion-p03_fexpedicion').val("2018-10-07 12:00");
                $('#vacunacion-p03_tipohato').val("1");
                $('#vacunacion-p03_laboratorio').val("Desconocido");
            }else{
                var axuliar_vc = document.getElementById('auxliar_vc').value;
                if(axuliar_vc==-1){
                    $('#vacunacion-p03_fexpedicion').val("2018-10-07 12:00");
                    $('#vacunacion-p03_tipohato').val("1");
                    $('#vacunacion-p03_laboratorio').val("Desconocido");

                }
            }
        });
    }
}

function cargarProductores() {
    //console.log('cargando')
    var upp = document.getElementById('seleccionprevia-c01_id').value;
    parametro={"upp":upp};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=seleccion-previa/ponerproductores',
        data: parametro,
        success:function(respuesta){
            document.getElementById('seleccionprevia-c01_ganadero').innerHTML=respuesta;
            parametro={"upp":upp};
            $.ajax({
                type: 'GET',
                url: 'index.php?r=seleccion-previa/ponerproductoresunico',
                data: parametro,
                success:function(respuesta){
                    if(respuesta){
                        $('#seleccionprevia-c01_ganadero').val(respuesta).trigger('change');
                    }
                }
            });

        }
    });
}

function canmbiar_filtro(op){


    var axuliar_id = document.getElementById('auxliar_id').value;
    parametro = {"prueba": axuliar_id, "op":op};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=seleccion-previa/realizarfiltro',
        data: parametro,
        success: function (respuesta) {
            $.pjax.reload({container: "#tablat", timeout: false});  //Reload GridView
        },
        error : function(response){
            console.log(response);
        }
    });

}
function detectarFiltro(){
    var op = document.getElementsByName('optradio');
    for (var i = 0, length = op.length; i < length; i++)
    {
        if (op[i].checked)
        {
            habilitar_filtro(op[i].value);
            break;
        }
    }
    /*var id_upp = document.getElementById('seleccionprevia-c01_id').value;
    return location.href= "index.php?r=seleccion-previa%2Fcreate&up="+id_upp;*/
}

function habilitar_filtro(op) {
    if(op==0){
        // alert(1)
        //$('#filtros_por').prop('disabled', false);
        cargarHatoTotalidad();
        $( "#filtro_content" ).fadeIn( "slow", function() {

        });

    }
    if(op==1){
       // alert(1)
        //$('#filtros_por').prop('disabled', false);
        $( "#filtro_content" ).fadeIn( "slow", function() {

        });

    }
    if(op==2){
        $.pjax.reload({container: "#tablat", timeout: false});  //Reload GridView
        $( "#resenas_content" ).fadeIn( "slow", function() {

        });

    }

    if(op!=1){
        //$('#filtros_por').prop('disabled', true);
        $( "#filtro_content" ).fadeOut( "slow", function() {
            realizar_filtro_especie(0, 1);
            limpiarfiltros(0);
            revisar_todos_todos();
        });
    }
    if(op!=2){
        //document.getElementById('seleccionprevia-c01_id').value = '';
        //var res = document.getElementById('resenas-p01_id').value;
        $("#resenas-p01_id").select2("val", "");
        $( "#resenas_content" ).fadeOut( "slow", function() {

        });

    }

}

function revisar_todos_todos() {
    var axuliar_id = document.getElementById('auxliar_id').value;

    if(axuliar_id==-1){
        //console.log(axuliar_id)
        todos_tb();
        todos_br();
        todos_vc();
        todos_gr();
    }
}
function limpiarfiltros(indice) {
    $('#sin_tb_tb').prop('checked', false);
    $('#sin_br_br').prop('checked', false);
    $('#sin_vc_vc').prop('checked', false);
    $('#con_tb_tb').prop('checked', false);
    $('#con_br_br').prop('checked', false);
    $('#con_vc_vc').prop('checked', false);

    if(indice==0){
        $('#caprino').prop('checked', false);
        $('#bovino').prop('checked', false);
        $('#ovino').prop('checked', false);
    }


    $('#meses_tb').prop('disabled', true);
    $('#meses_br').prop('disabled', true);
    $('#meses_vc').prop('disabled', true);

}

function unicozoo() {
    var zoo = document.getElementById('tuberculosis-p03_funczoo').value;
    $('#brucelosis-p03_funczoo').val(zoo).trigger('change');
}

function unicozoobt() {
    var zoo = document.getElementById('brucelosis-p03_funczoo').value;
    if(zoo!=''){
        $('#brucelosis-p03_funczoo').val(zoo).trigger('change');
    }
    //$('#tuberculosis-p03_funczoo').val(zoo).trigger('change');
}

function ultimaprueba(valor) {

    switch (valor){
        case 0: //$('#sin_tb_tb').prop('checked', false);
            if( $('#con_tb_tb').prop('checked') ) {
                $('#meses_tb').prop('disabled', false);
                realizar_filtro_ultimaprueba(0, 1);
            }else{
                $('#meses_tb').prop('disabled', true);
                realizar_filtro_ultimaprueba(0, 0);
            }
            break;
        case 1: //$('#sin_br_br').prop('checked', false);

            if( $('#con_br_br').prop('checked') ) {
                $('#meses_br').prop('disabled', false);
                realizar_filtro_ultimaprueba(1, 1);
            }else{
                $('#meses_br').prop('disabled', true);
                realizar_filtro_ultimaprueba(1, 0);
            }
            break;
        case 2: //$('#sin_vc_vc').prop('checked', false);
            if( $('#con_vc_vc').prop('checked') ) {
                $('#meses_vc').prop('disabled', false);
                realizar_filtro_ultimaprueba(2, 1);
            }else{
                $('#meses_vc').prop('disabled', true);
                realizar_filtro_ultimaprueba(2, 0);
            }
            break;
    }
}
function sinprueba(valor) {
    switch (valor){
        case 0: //$('#con_tb_tb').prop('checked', false);
            //$('#meses_tb').prop('disabled', true);
            if( $('#sin_tb_tb').prop('checked') ) {
                realizar_filtro_sinprueba(0, 1);
            }else{
                realizar_filtro_sinprueba(0, 0);
            }

            break;
        case 1: //$('#con_br_br').prop('checked', false);
            //$('#meses_br').prop('disabled', true);
            if( $('#sin_br_br').prop('checked') ) {
                realizar_filtro_sinprueba(1, 1);
            }else{
                realizar_filtro_sinprueba(1, 0);
            }
            break;
        case 2: //$('#con_vc_vc').prop('checked', false);
            //$('#meses_vc').prop('disabled', true);
            //Aun no se tiene de vacunación
            break;
    }
}
function cambio_especiefiltro(valor) {

    switch (valor){
        case 0: $('#caprino').prop('checked', false);
                $('#ovino').prop('checked', false);
                limpiarfiltros(1);
                if( $('#bovino').prop('checked') ) {
                    realizar_filtro_especie(1, 1);
                }else{
                    realizar_filtro_especie(1, 0);
                }
                revisar_todos_todos();

            break;
        case 1: $('#bovino').prop('checked', false);
                $('#ovino').prop('checked', false);
                limpiarfiltros(1);
                if( $('#caprino').prop('checked') ) {
                    realizar_filtro_especie(2, 1);
                }else{
                    realizar_filtro_especie(2, 0);
                }

                revisar_todos_todos();
            break;
        case 2: $('#bovino').prop('checked', false);
                $('#caprino').prop('checked', false);
                limpiarfiltros(1);
                if( $('#ovino').prop('checked') ) {
                    realizar_filtro_especie(3, 1);
                }else{
                    realizar_filtro_especie(3, 0);
                }
                revisar_todos_todos();
            break;
    }
}
function realizar_filtro_especie(valor, estatus) {
    var axuliar_id = document.getElementById('auxliar_id').value;
    parametro = {"prueba": axuliar_id, "op":valor, "estatus":estatus};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=seleccion-previa/realizarfiltroespecie',
        data: parametro,
        success: function (respuesta) {
            $.pjax.reload({container: "#tablat", timeout: false});  //Reload GridView
        },
        error : function(response){
            console.log(response);
        }
    });
}

function realizar_filtro_sinprueba(valor, estatus) {
    var axuliar_id = document.getElementById('auxliar_id').value;

    var espcie_existene=0;
    //Valores de filtros por especie
    var bov = document.getElementById('bovino').checked;
    var cap = document.getElementById('caprino').checked;
    var ovi = document.getElementById('ovino').checked;
    if(bov){
        espcie_existene=1;
    }
    if(cap){
        espcie_existene=2;
    }
    if(ovi){
        espcie_existene=3;
    }

    //Revismos el estatus del campo con ultima prueba
    var ultima;
    var ultima_tbs  = document.getElementById('con_tb_tb').checked;
    var ultima_brs  = document.getElementById('con_br_br').checked;
    var ultima_vcs  = document.getElementById('con_vc_vc').checked;
    var companero = false;
    if(valor==0){
        companero  = document.getElementById('sin_br_br').checked;
    }else if(valor==1){
        companero  = document.getElementById('sin_tb_tb').checked;
    }


    if(ultima_tbs || ultima_brs || ultima_vcs || companero){
        ultima = true;
    }else{
        ultima = false;
    }
    var isequal=false;
    if(valor==0){
        if(ultima_brs){
            isequal=true;
        }
    }else{
        if(ultima_tbs){
            isequal=true;
        }
    }
    //alert(ultima)


    parametro = {"prueba": axuliar_id, "op":valor, "estatus": estatus, "especie":espcie_existene, "ultimafiltro":ultima, "igual":isequal, "companero":companero};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=seleccion-previa/realizarfiltrosinprueba',
        data: parametro,
        success: function (respuesta) {
            //console.log(respuesta)
            $.pjax.reload({container: "#tablat", timeout: false});  //Reload GridView
        },
        error : function(response){
            console.log(response);
        }
    });
}

function realizar_filtro_ultimaprueba(valor, estatus) {
    var axuliar_id = document.getElementById('auxliar_id').value;

    var espcie_existene=0;
    //Valores de filtros por especie
    var bov = document.getElementById('bovino').checked;
    var cap = document.getElementById('caprino').checked;
    var ovi = document.getElementById('ovino').checked;
    if(bov){
        espcie_existene=1;
    }
    if(cap){
        espcie_existene=2;
    }
    if(ovi){
        espcie_existene=3;
    }

    var companero = false;
    var ultima; //Ultima es el estatus del campo Sin prueba (filtro)
    var ultima_tbs  = document.getElementById('sin_tb_tb').checked;
    var ultima_brs  = document.getElementById('sin_br_br').checked;
    var ultima_vcs  = document.getElementById('sin_vc_vc').checked;
    switch (valor){
        case 0: meses_filtro = document.getElementById('meses_tb').value;
            break;
        case 1: meses_filtro = document.getElementById('meses_br').value;
            break;
        case 2: meses_filtro = document.getElementById('meses_tb').value;
            break;
    }
    if(valor==0){
        companero  = document.getElementById('con_br_br').checked;
    }else if(valor==1){
        companero  = document.getElementById('con_tb_tb').checked;
    }

    if(ultima_tbs || ultima_brs || ultima_vcs || companero){
        ultima = true;
    }else{
        ultima = false;
    }
    var isequal=false;
    if(valor==0){
        if(ultima_brs){
            isequal=true;
        }
    }else{
        if(ultima_tbs){
            isequal=true;
        }
    }
//alert(ultima)
    if(meses_filtro){
        parametro = {"prueba": axuliar_id, "op":valor, "estatus": estatus, "especie":espcie_existene, "meses":meses_filtro, "ultimafiltro":ultima, "igual":isequal, "companero":companero};
        $.ajax({
            type: 'GET',
            url: 'index.php?r=seleccion-previa/realizarfiltroultimaprueba',
            data: parametro,
            success: function (respuesta) {
                $.pjax.reload({container: "#tablat", timeout: false});  //Reload GridView
            },
            error : function(response){
                console.log(response);
            }
        });
    }
}

function existente(){
    var sel = document.getElementById('propietariounidad-r01_id').value;
    console.log(sel)
    if(sel){
        var id= document.getElementById('id_edo').value;

        parametro = {"id": id};
        $.ajax({
            type: 'GET',
            url: 'index.php?r=ganaderos/checkrelaciones',
            data: parametro,
            dataType: "json",
            success: function (res) {
                //alert(res)
                if(res==1){
                    swal({
                        title: 'Relaciones Existentes',
                        text: '¿Deseas agregar una nueva UPP?',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#942626',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si',
                        cancelButtonText: 'Cancelar',
                        allowOutsideClick: false,
                        allowEnterKey: false,
                    }).then(function (res) {
                        $( "#modalButton" ).trigger( "click" );
                    }, function (dismiss) {
                        $("#propietariounidad-r01_id").select2("val", "");
                    });
                }
            }
        });
    }

}

function cargarPorResena() {
    var upp = document.getElementById('seleccionprevia-c01_id').value;
    var res = document.getElementById('resenas-p01_id').value;
    //cargarProductores();
    limpiarfiltros(0);
    if(res!=''){

        if(upp==''){
            swal("Aviso.", "No se ha seleccionado una UPP.")
                .catch(swal.noop);
            $.pjax.reload({container: "#tablat", timeout: false});
        }else{
            parametro = {"upp": upp, "res": res};
            $.ajax({
                type: 'GET',
                url: 'index.php?r=seleccion-previa/compararupp',
                data: parametro,
                success: function (respuesta) {
                    if(respuesta){
                        $.ajax({
                            type: 'GET',
                            url: 'index.php?r=seleccion-previa/agregararetesresena',
                            data: parametro,
                            success: function (resp) {
                                $.pjax.reload({container: "#tablat", timeout: false});  //Reload GridView
                                //$("#resenas-p01_id").select2("val", "");
                            },
                            error : function(response){
                                console.log(response);
                            }
                        });

                    }else{
                        $.pjax.reload({container: "#tablat", timeout: false});
                        swal("Aviso.", "La Upp de la reseña no coincide con la prueba.")
                            .catch(swal.noop);
                    }
                }
            });

        }

    }

}

function enlace(motivo) {
    var id_upp = document.getElementById('seleccionprevia-c01_id').value;
    var in_upp = document.getElementById('seleccionprevia-c01_id').selectedIndex;
    //alert("motivo:" + motivo + " id_upp:" + id_upp)

    if(id_upp){
        parametro = {"id_upp": id_upp};
        $.ajax({
            type: 'GET',
            url: 'index.php?r=seleccion-previa/validarposiciongeo',
            data: parametro,
            success: function (valido) {
                if(valido){
                    //motivo = document.getElementById('mot').value;
//alert("motivo " + motivo);
                    var radio = 0;
                    if(motivo==1)
                        radio = document.getElementsByName('opmotivo');
                    else if(motivo==2)
                        radio = document.getElementsByName('motivo_exp');
                    var op = 0, exp=0;

                    for (var i = 0, length = radio.length; i < length; i++){
                        if (radio[i].checked){
                            if(motivo==1)
                                op = radio[i].value;
                            else if(motivo==2)
                                exp = radio[i].value;
                            break;
                        }
                    }
                    return location.href= "index.php?r=seleccion-previa%2Fcreate&mot="+op+"&idup="+id_upp+"&inup="+in_upp+"&exp="+exp;
                }else{
                    if(id_upp){
                        swal({
                            title: 'La información de la latitud y/o longitud de la unidad es incorrecta.',
                            type: 'warning',
                            showCancelButton: false,
                            confirmButtonColor: '#942626',
                            confirmButtonText: 'Ok'
                        }).catch(swal.noop);
                        document.getElementById('seleccionprevia-c01_id').value='';
                        $('#seleccionprevia-c01_id').append(1).trigger('change');
                    }
                }
            },
            error : function(response){
                console.log(response);
            }
        });

    }else{
        var radio = 0;
        if(motivo==1)
            radio = document.getElementsByName('opmotivo');
        else if(motivo==2)
            radio = document.getElementsByName('motivo_exp');
        var op = 0, exp=0;

        for (var i = 0, length = radio.length; i < length; i++){
            if (radio[i].checked){
                if(motivo==1)
                    op = radio[i].value;
                else if(motivo==2)
                    exp = radio[i].value;
                break;
            }
        }
        return location.href= "index.php?r=seleccion-previa%2Fcreate&mot="+op+"&exp="+exp;
    }
}

function infoProductor(){
    var id_prod = document.getElementById('seleccionprevia-c01_ganadero').value;
    if(id_prod){
        window.open(
            'index.php?r=ganaderos/update&id='+id_prod,
            '_blank'
        );
    }

}

function guardaAreteAzul(r02_id, azul, numero, especie){
    parametro = {"r02_id": r02_id, "azul":azul.value, "numero":numero, "especie":especie};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=seleccion-previa/guardaazul',
        data: parametro,
        dataType: "json",
        success: function (res) {
            if(res){
                if(res==-1){
                    swal({
                        title: 'El número de arete azul ya fue asignado.',
                        type: 'warning',
                        showCancelButton: false,
                        confirmButtonColor: '#942626',
                        confirmButtonText: 'Ok'
                    }).catch(swal.noop);
                    cargarTabla();
                }else if(res==2){
                    swal({
                        title: 'Ocurrió un error al tratar de guardar el arete azul.',
                        type: 'warning',
                        showCancelButton: false,
                        confirmButtonColor: '#942626',
                        confirmButtonText: 'Ok'
                    }).catch(swal.noop);
                }
            }

        }
    });
}

function cargarTabla() {
    $.pjax.reload({
        container: "#tablat",
        timeout: false
    });

}
