$( document ).ready(function() {
    cargarEstados();
});
var map;
var heatmap;
var manchas=[];

function inicializar() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 22.770151, lng: -102.570880},
        maxZoom: 16,
        minZoom: 6,
        zoom: 6
    });

    //generarManchasA();

}

function inicializarManchas() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 22.770151, lng: -102.570880},
        maxZoom: 16,
        minZoom: 6,
        zoom: 6
    });

    generarManchasA();

}

function dibujarMapaCalor(){
    /*map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 22.770151, lng: -102.570880},
        maxZoom: 16,
        minZoom: 6,

        zoom: 6
    });*/
    heatmap = new google.maps.visualization.HeatmapLayer({
        data: manchas,
        map: map,
        radius: 40,
    });
}


function generarPuntos(){
    $.ajax({
        type: 'GET',
        url: 'index.php?r=mapa-calor/getunidades',
        dataType: "json",
        success: function (unidades) {
            if (unidades) {

                //for (i=0; i<unidades.length; i++){
                for (i=0; i<unidades.length; i++){
                    parametro = {"id": unidades[i]};
                    $.ajax({
                        type: 'GET',
                        url: 'index.php?r=mapa-calor/getinfounidad',
                        data: parametro,
                        dataType: "json",
                        success: function (unidad) {
                            if (unidad) {
                                addMarker({lat:unidad[1], lng:unidad[2]});
                            }
                        }
                    });
                }
            }
        }
    });
}

function generarManchasA(){
    return $.ajax({
        type: 'GET',
        url: 'index.php?r=mapa-calor/getunidades',
        dataType: "json",
        success: function (unidades) {
            if (unidades) {

                //for (i=0; i<unidades.length; i++){
//alert("unidades.length " + unidades.length);
                for (i=0; i<unidades.length; i++){
                    parametro = {"id": unidades[i]};
                    $.ajax({
                        type: 'GET',
                        url: 'index.php?r=mapa-calor/getinfounidad',
                        data: parametro,
                        dataType: "json",
                        success: function (unidad) {
                            if (unidad) {
                                manchas.push(new google.maps.LatLng(unidad[1], unidad[2]));
                            }
                        }
                    });
                }
            }
        }
    });
}


function dibujarCirculos(citymap){
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 22.770151, lng: -102.570880},
        maxZoom: 16,
        minZoom: 6,
        zoom: 6
    });

    for (var city in citymap) {
        // Add the circle for this city to the map.
        var cityCircle = new google.maps.Circle({
            strokeColor: '#FF0000',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#FF0000',
            fillOpacity: 0.35,
            map: map,
            center: citymap[city].center,
            radius: Math.sqrt(citymap[city].population) * 10000
        });
    }
}

function dibujarMarcas(citymap){
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 22.770151, lng: -102.570880},
        maxZoom: 16,
        minZoom: 6,
        zoom: 6
    });

    generarPuntos();
}

function addMarker(props){
    /*var marker = new google.maps.Marker({
        position:coords,
        map:map,
        //icon:props.iconImage
    });*/
    var marker = new google.maps.Marker({
        position:props.coords,
        map:map,
        //icon:props.iconImage
    });

    if(props.content){
        var infoWindow = new google.maps.InfoWindow({
            content:props.content
        });

        marker.addListener('click', function(){
            infoWindow.open(map, marker);
        });
    }
}


function opcionesRadio(){
    var sel = document.getElementById('opcRadio');
    var opc = sel.options[sel.selectedIndex].value;

    if(opc && heatmap){
        switch (parseInt(opc)) {
            case 1:
                heatmap.set('radius', 25);
                break;
            case 2:
                heatmap.set('radius',50);
                break;
            case 3:
                heatmap.set('radius',75);
                break;
        }
    }
}

function opcionesPruebas(){
    var sel = document.getElementById('opcDictamen');
    var opc = sel.options[sel.selectedIndex].value;

    if(opc) {
        switch (parseInt(opc)) {
            case 1:
                $( "#divBruce").fadeOut( "fast", function() {
                    $( "#divTuber").fadeIn( "fast", function() {
                        $( "#divLocalizacion").fadeIn( "fast", function() {});
                    });
                });

                break;
            case 2:
                $( "#divTuber").fadeOut( "fast", function() {
                    $( "#divBruce").fadeIn( "fast", function() {
                        $( "#divLocalizacion").fadeIn( "fast", function() {});
                    });
                });
                break;
        }
    }
}

function opcionesLocalizacion(){
    var sel = document.getElementById('opcLocalizacion');
    var opc = sel.options[sel.selectedIndex].value;
    if(opc) {
        switch (parseInt(opc)) {
            case 1:
                $( "#divLocMuni").fadeOut( "fast", function() {
                    $( "#divLocEstado").fadeOut( "fast", function() {
                        $( "#divLocUpp").fadeIn( "fast", function() {});
                    });
                });
                break;
            case 2:
                $( "#divLocEstado").fadeOut( "fast", function() {
                    $( "#divLocUpp").fadeOut( "fast", function() {
                        $( "#divLocMuni").fadeIn( "fast", function() {});
                    });
                });
                break;
            case 3:
                $( "#divLocUpp").fadeOut( "fast", function() {
                    $( "#divLocMuni").fadeOut( "fast", function() {
                        $( "#divLocEstado").fadeIn( "fast", function() {});
                    });
                });
                break;
        }
    }
}

function opcionesPorcentaje() {
    var sel = document.getElementById('opcFiltroR');
    var opc = sel.options[sel.selectedIndex].value;
    if(opc) {
        switch (parseInt(opc)) {
            case 1:
                $( "#divPorcentaje").fadeIn( "fast", function() {});
                break;
        }
    }
}

function generarMapa(){
    $( "#panel-info-mpc" ).fadeIn( "fast", function() {});

    var op = document.getElementById('opcMapa');
    var tipo_mapa = parseInt(op.options[op.selectedIndex].value);

    var selectTipoDict = document.getElementById('opcDictamen');
    var tipoDict = parseInt(selectTipoDict.options[selectTipoDict.selectedIndex].value);
    var porcentaje = document.getElementById('porcentaje').value;
    var fecha_inicial = document.getElementById('fecha_inicial').value;
    var fecha_final = document.getElementById('fecha_final').value;

    var selectFiltro = document.getElementById('opcFiltroR');
    var filtro = parseInt(selectFiltro.options[selectFiltro.selectedIndex].value);

    var selectLocalizacion = document.getElementById('opcLocalizacion');
    //var localizacion = parseInt(selectLocalizacion.options[selectLocalizacion.selectedIndex].value);

    var upp=-1, edo=-1, mun=-1;
    var valido = false;

    if(isNaN(filtro)){
        swal({
            title: 'No se ha seleccionado el tipo de consulta.',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#942626',
            confirmButtonText: 'Ok'
        }).catch(swal.noop);
    }else if(porcentaje.length==0){
        swal({
            title: 'No se ha seleccionado el porcentaje.',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#942626',
            confirmButtonText: 'Ok'
        }).catch(swal.noop);
    }
    /*else if(isNaN(localizacion)){
        swal({
            title: 'No se ha seleccionado la localización.',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#942626',
            confirmButtonText: 'Ok'
        }).catch(swal.noop);
    }*/else{
        valido = true;
    }

    var edo = document.getElementById('id_edo').value;
    var mun = document.getElementById('id_mun').value;
    if(!edo){
        valido = false;
        swal({
            title: 'No se ha seleccionado un estado.',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#942626',
            confirmButtonText: 'Ok'
        }).catch(swal.noop);
    }else if(!mun && edo!=0){
        mun=0;
    }

    if (valido){
        dibujarMapa(tipo_mapa, tipoDict, porcentaje, fecha_inicial, fecha_final, mun, edo, upp);
    }
}

function dibujarMapa(tipoMapa, tipoDict, porcentaje, fecha_inicial, fecha_final, mun, edo, upp){
    //Dictamen Tuberculosis
    if(tipoDict==1){
        var selectTipoPruebaTB = document.getElementById('opcTuber');
        var tipoPruebaTB = selectTipoPruebaTB.options[selectTipoPruebaTB.selectedIndex].value;
        if(tipoMapa==1){
            this.manchas=[];
            inicializar();
            $.when(generarManchasTB(tipoPruebaTB, porcentaje, fecha_inicial, fecha_final, mun, edo, upp)).done(function(a1){
                dibujarMapaCalor();
            });
        }else if(tipoMapa==2){
            generarPuntosTB(tipoPruebaTB, porcentaje, fecha_inicial, fecha_final, mun, edo, upp);
        }

    }else if(tipoDict==2){//Dictamen de Brucelosis
        var selectTipoPruebaBR = document.getElementById('opcBruce');
        var tipoPruebaBR = parseInt(selectTipoPruebaBR.options[selectTipoPruebaBR.selectedIndex].value);
        if(tipoMapa==1){
            this.manchas=[];
            inicializar();
            $.when(generarManchasBR(tipoPruebaBR, porcentaje, fecha_inicial, fecha_final, mun, edo, upp)).done(function(a1){
                dibujarMapaCalor();
            });
        }else if(tipoMapa==2){
            generarPuntosBR(tipoPruebaBR, porcentaje, fecha_inicial, fecha_final, mun, edo, upp);
        }
    }
}

function wait(ms){
    var start = new Date().getTime();
    var end = start;
    while(end < start + ms) {
        end = new Date().getTime();
    }
}

function mapaCalor(tipoDict, porcentaje, fecha_inicial, fecha_final, localizacion, mun, edo, upp){
    //Dictamen Tuberculosis
    if(tipoDict==1){
        var selectTipoPruebaTB = document.getElementById('opcTuber');
        var tipoPruebaTB = selectTipoPruebaTB.options[selectTipoPruebaTB.selectedIndex].value;
        //generarMarcadoresTB(tipoPruebaTB, porcentaje, fecha_inicial, fecha_final, localizacion, mun, edo, upp);
        dibujarMapaCalor();

    }else if(tipoDict==2){//Dictamen de Brucelosis
        var selectTipoPruebaBR = document.getElementById('opcBruce');
        var tipoPruebaBR = parseInt(selectTipoPruebaBR.options[selectTipoPruebaBR.selectedIndex].value);
        //generarMarcadoresBR(tipoPruebaBR, porcentaje, fecha_inicial, fecha_final, localizacion, mun, edo, upp);
        dibujarMapaCalor();
    }
}

function generarManchasTB(tipoPrueba, porcentaje, fecha_inicial, fecha_final,
                           municipio, estado, upp){

    valores = {"tipoPrueba":tipoPrueba, "porcentaje":porcentaje, "fecha_inicial":fecha_inicial,
        "fecha_final":fecha_final, "municipio":municipio, "estado":estado, "upp":upp};
    return $.ajax({
        type: 'GET',
        url: 'index.php?r=mapa-calor/getcoordenadastasarespuestatb',
        dataType: "json",
        data: valores,
        success: function (unidades) {
            if(unidades==0){
                swal('No se encontraron resultados')
                    .catch(swal.noop);
            }else if (unidades) {
                inicializar();
                swal(unidades.length + ' resultados')
                    .catch(swal.noop);
                for (i=0; i<unidades.length; i++){
                    for (j=0; j<unidades[i].length; j++){
                        //addMarker({lat:unidades[i][1], lng:unidades[i][2]});
                        manchas.push(new google.maps.LatLng(unidades[i][1], unidades[i][2]));
                    }
                }
            }
        }
    });
}

function generarPuntosTB(tipoPrueba, porcentaje, fecha_inicial, fecha_final,
                          municipio, estado, upp){

    valores = {"tipoPrueba":tipoPrueba, "porcentaje":porcentaje, "fecha_inicial":fecha_inicial,
        "fecha_final":fecha_final, "municipio":municipio, "estado":estado, "upp":upp};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=mapa-calor/getcoordenadastasarespuestatb',
        dataType: "json",
        data: valores,
        success: function (unidades) {
            if(unidades==0){
                swal('No se encontraron resultados')
                    .catch(swal.noop);
            }else if (unidades) {
                inicializar();
                swal(unidades.length + ' resultados')
                    .catch(swal.noop);
                for (i=0; i<unidades.length; i++){
                    for (j=0; j<unidades[i].length; j++){
                        //addMarker({lat:unidades[i][1], lng:unidades[i][2]});
                        addMarker({
                            coords:{lat:unidades[i][1], lng:unidades[i][2]},
                            content:'<b><h3>'+unidades[i][0]+'</h3></b>'
                        });

                    }
                }
            }
        }
    });
}

function generarManchasBR(tipoPrueba, porcentaje, fecha_inicial, fecha_final,
                             municipio, estado, upp){

    valores = {"tipoPrueba":tipoPrueba, "porcentaje":porcentaje, "fecha_inicial":fecha_inicial,
        "fecha_final":fecha_final, "municipio":municipio, "estado":estado, "upp":upp};
    return $.ajax({
        type: 'GET',
        url: 'index.php?r=mapa-calor/getcoordenadastasarespuestabr',
        dataType: "json",
        data: valores,
        success: function (unidades) {
            if(unidades==0){
                swal('No se encontraron resultados')
                    .catch(swal.noop);
            }else if (unidades) {
                inicializar();
                swal(unidades.length + ' resultados')
                    .catch(swal.noop);
                for (i=0; i<unidades.length; i++){
                    for (j=0; j<unidades[i].length; j++){
                        manchas.push(new google.maps.LatLng(unidades[i][1], unidades[i][2]));
                    }
                }
            }
        }
    });
}

function generarPuntosBR(tipoPrueba, porcentaje, fecha_inicial, fecha_final,
                          municipio, estado, upp){

    valores = {"tipoPrueba":tipoPrueba, "porcentaje":porcentaje, "fecha_inicial":fecha_inicial,
        "fecha_final":fecha_final, "municipio":municipio, "estado":estado, "upp":upp};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=mapa-calor/getcoordenadastasarespuestabr',
        dataType: "json",
        data: valores,
        success: function (unidades) {
            if(unidades==0){
                swal('No se encontraron resultados')
                    .catch(swal.noop);
            }else if (unidades) {
                inicializar();
                swal(unidades.length + ' resultados')
                    .catch(swal.noop);
                for (i=0; i<unidades.length; i++){
                    for (j=0; j<unidades[i].length; j++){
                        //addMarker({lat:unidades[i][1], lng:unidades[i][2]})
                        addMarker({
                            coords:{lat:unidades[i][1], lng:unidades[i][2]},
                            content:'<b><h3>'+unidades[i][0]+'</h3></b>'
                        });
                    }
                }
            }
        }
    });
}

function generarManchas(tipoPrueba, porcentaje, fecha_inicial, fecha_final,
                           localizacion, municipio, estado, upp){

    valores = {"tipoPrueba":tipoPrueba, "porcentaje":porcentaje, "fecha_inicial":fecha_inicial,
        "fecha_final":fecha_final, "localizacion":localizacion, "municipio":municipio, "estado":estado, "upp":upp};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=mapa-calor/getcoordenadastasarespuestatb',
        dataType: "json",
        data: valores,
        success: function (unidades) {
            if(unidades==0){
                swal('No se encontraron resultados')
                    .catch(swal.noop);
            }else if (unidades) {
                swal(unidades.length + ' resultados')
                    .catch(swal.noop);
                for (i=0; i<unidades.length; i++){
                    for (j=0; j<unidades[i].length; j++){
                        manchas.push(new google.maps.LatLng(unidades[i][1], unidades[i][2]));
                    }
                }
                //inicializar();
            }
        }
    });
}

function generarMarcadore(){
    $.ajax({
        type: 'GET',
        url: 'index.php?r=mapa-calor/getcoordenadas',
        dataType: "json",
        success: function (unidades) {
            if (unidades) {
                alert("Cantidad[] xd: " + unidades.length);
                for (i=0; i<unidades.length; i++){
                    for (j=0; j<unidades[i].length; j++){
                        addMarker({lat:unidades[i][1], lng:unidades[i][2]});
                    }
                }
            }
        }
    });
}

function desplegar(){
    $( "#panel-info-mpc" ).fadeIn( "fast", function() {});
    var select = document.getElementById('opcMapa');
    var opcion = select.options[select.selectedIndex].value;
    if(opcion){
        switch (parseInt(opcion)){
            case 1:
                //$( "#opcRadius").fadeIn( "fast", function() {
                    $( "#divOpcFiltros").fadeIn( "fast", function() {
                        $( "#opcopcionesDibujadoRadius").fadeIn( "fast", function() {

                        });
                    });
                //});
                break;
            case 2:
                //$( "#opcRadius").fadeOut( "fast", function() {
                    $( "#divOpcFiltros").fadeIn( "fast", function() {});
                //});
                break;
        }
    }
}

function cargarEstados() {

    //parametro = {"edo":edo};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=mapa-calor/cargarestados',
        //data: parametro,
        success: function (respuesta) {
            document.getElementById('id_edo').innerHTML=respuesta;
            $('#id_edo').val(0).trigger('change');

        }
    });
}

function cargarMunicipios(){
    var edo = document.getElementById('id_edo').value;

    parametro = {"edo":edo};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=mapa-calor/cargarmunicipios',
        data: parametro,
        success: function (respuesta) {
            document.getElementById('id_mun').innerHTML=respuesta;
            $('#id_mun').val(0).trigger('change');

        }
    });
}