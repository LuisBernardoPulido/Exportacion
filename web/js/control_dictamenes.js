$( document ).ready(function() {
    motivootro();
    tipootro();
    $( ".field-dictamenes-r03_tipo" ).fadeOut( "slow", function() {});

});
function cambiarFecha(){
    var inyeccion = document.getElementById('dictamenes-r03_finyeccion').value;

    var date = new Date(inyeccion);
    date.setDate(date.getDate()+3);
    var dd = date.getDate();
    var mm = date.getMonth()+1; //January is 0!
    var minutes = date.getMinutes();
    var hours = date.getHours();

    var yyyy = date.getFullYear();
    if(dd<10){
        dd='0'+dd;
    }
    if(mm<10){
        mm='0'+mm;
    }
    if(hours<10){
        hours='0'+hours;
    }
    if(minutes<10){
        minutes='0'+minutes;
    }
    var dateFormat = yyyy+'-'+mm+'-'+dd+' '+hours+':'+minutes;
    document.getElementById('dictamenes-r03_flectura').value=dateFormat;
}

function cambiarOpcion(){
    var e = document.getElementById('tipopor').value;
    if(e==0){
        $( "#aretespor" ).fadeOut( "slow", function() {
            $( "#lotespor" ).fadeIn( "slow", function() {});
        });

    }else{
        $( "#lotespor" ).fadeOut( "slow", function() {
            $( "#aretespor" ).fadeIn( "slow", function() {});
        });

    }
}

function generar(tipo){

    var i = document.getElementById('inicio').value;
    var f = document.getElementById('fin').value;

    var it = parseInt(i);
    var fn = parseInt(f);
    var uno =1;
    var diferencia = fn-it+1;


    if(i.length==0 || f.length==0 || i.length<10 || f.length<10){
        $( "#error_mensaje" ).fadeIn( "slow", function() {});
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
                $("#error_mensaje").fadeOut("slow", function () {
                    parametro = {"inicio": i, "fin": f, "tipo": tipo};
                    $.ajax({
                        type: 'GET',
                        url: 'index.php?r=dictamenes-aretes/lotes',
                        data: parametro,
                        success: function (respuesta) {
                            $.pjax.reload({container: "#tablat"});  //Reload GridView

                        }
                    });
                });

                //Termina function afirmativa
            })
        }else{
            document.getElementById('inicio').value = '';
            document.getElementById('fin').value = '';
            $("#error_mensaje").fadeOut("slow", function () {
                parametro = {"inicio": i, "fin": f, "tipo": tipo};
                $.ajax({
                    type: 'GET',
                    url: 'index.php?r=dictamenes-aretes/lotes',
                    data: parametro,
                    success: function (respuesta) {
                        $.pjax.reload({container: "#tablat"});  //Reload GridView

                    }
                });
            });
        }
    }

}

function cargarUnidades() {
    var gan = document.getElementById('dictamenes-c01_id');

    parametro={"ganadero":gan.value};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=dictamenes/poner_upps',
        data: parametro,
        success:function(respuesta){
            //alert(respuesta)
            document.getElementById('dictamenes-r01_id').innerHTML=respuesta;
        }
    });
}

function tipoMVZ() {
    var tipo = document.getElementById('dictamenes-r03_tipomvz');
    parametro={"mvz":tipo.value};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=dictamenes/poner_mvz',
        data: parametro,
        success:function(respuesta){
            //alert(respuesta)
            document.getElementById('dictamenes-c05_id').innerHTML=respuesta;
        }
    });

}

function arete(tipo){
    var i = document.getElementById('por_arete').value;

    if(i.length==0 || i.length<10){
        $( "#error_mensaje" ).fadeIn( "slow", function() {});
    }else{
        document.getElementById('por_arete').value = '';

        $("#error_mensaje").fadeOut("slow", function () {
            parametro = {"inicio": i, "tipo": tipo};
            $.ajax({
                type: 'GET',
                url: 'index.php?r=dictamenes-aretes/porarete',
                data: parametro,
                success: function (respuesta) {
                   // alert(respuesta)
                    $.pjax.reload({container: "#tablat"});  //Reload GridView

                }
            });
        });
    }
}

function opcion() {
    var i = document.getElementById('hatoC').checked;
    if(i){
        $('#dictamenes-r03_muestrahato').attr('readonly', true);
        $('#dictamenes-r03_totalhato').attr('readonly', true);
    }else{
        $('#dictamenes-r03_muestrahato').attr('readonly', false);
        $('#dictamenes-r03_totalhato').attr('readonly', false);
    }
}

function motivootro() {
    var mot = document.getElementById('dictamenes-r03_motivoprueba').value;
    if(mot==99){
        $('#motivobruce').removeClass('col-md-6');
        $('#motivobruce').addClass('col-md-3');
        $( "#motivoespe" ).fadeIn( "slow", function() {

        });
    }else{
        $( "#motivoespe" ).fadeOut( "slow", function() {

            $('#motivobruce').removeClass('col-md-3');
            $('#motivobruce').addClass('col-md-6');

        });
    }
}

function tipootro() {
    var mot = document.getElementById('dictamenes-r03_tipoprueba').value;
    if(mot==99){
        $('#tipobruce').removeClass('col-md-6');
        $('#tipobruce').addClass('col-md-3');
        $( "#tipoespe" ).fadeIn( "slow", function() {

        });
    }else{
        $( "#tipoespe" ).fadeOut( "slow", function() {

            $('#tipobruce').removeClass('col-md-3');
            $('#tipobruce').addClass('col-md-6');

        });
    }
}

function cargarAretes() {
    var upp = document.getElementById('dictamenes-r01_id').value;
    var tipo = document.getElementById('dictamenes-r03_tipo').value;

    parametro = {"upp": upp, "tipo":tipo};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=dictamenes/agregararetes',
        data: parametro,
        success: function (respuesta) {
           //alert(respuesta)
            $.pjax.reload({container: "#tablat"});  //Reload GridView

        }
    });

}

