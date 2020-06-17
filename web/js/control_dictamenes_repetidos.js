function desplegar(){
    //$( "#panel-primary-mpc" ).fadeIn( "fast", function() {});
    var select = document.getElementById('opcRep');
    var opcion = select.options[select.selectedIndex].value;
    if(opcion){
        switch (parseInt(opcion)){
            case 1:
                $( "#dictamenes-repetidos-tb-index").fadeIn( "fast", function() {});
                $( "#dictamenes-repetidos-br-index").fadeOut( "fast", function() {});
                $( "#dictamenes-repetidos-vc-index").fadeOut( "fast", function() {});
                $( "#dictamenes-repetidos-gr-index").fadeOut( "fast", function() {});
                break;
            case 2:
                $( "#dictamenes-repetidos-tb-index").fadeOut( "fast", function() {});
                $( "#dictamenes-repetidos-br-index").fadeIn( "fast", function() {});
                $( "#dictamenes-repetidos-vc-index").fadeOut( "fast", function() {});
                $( "#dictamenes-repetidos-gr-index").fadeOut( "fast", function() {});
                break;
            case 3:
                $( "#dictamenes-repetidos-tb-index").fadeOut( "fast", function() {});
                $( "#dictamenes-repetidos-br-index").fadeOut( "fast", function() {});
                $( "#dictamenes-repetidos-vc-index").fadeIn( "fast", function() {});
                $( "#dictamenes-repetidos-gr-index").fadeOut( "fast", function() {});
                break;
            case 4:
                $( "#dictamenes-repetidos-tb-index").fadeOut( "fast", function() {});
                $( "#dictamenes-repetidos-br-index").fadeOut( "fast", function() {});
                $( "#dictamenes-repetidos-vc-index").fadeOut( "fast", function() {});
                $( "#dictamenes-repetidos-gr-index").fadeIn( "fast", function() {});
                break;
        }
    }
}

function  motivoBorrar(id,upp,tipo,fecha) {

    parametro = {
        "id" : id,
        "upp" : upp,
        "fecha" : fecha,
        "tipo" : tipo
    };

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
        $.get("index.php?r=dictamenes-repetidos/deletedictamen&id="+id+"&motivo="+result+"&tipo=1&upp="+upp+"&fecha="+fecha+"&prueba="+tipo, function(datos){
            if(datos==1){
                //mandar la impresion

                location.href= "index.php?r=dictamenes-repetidos/deletedictamen&id="+id+"&motivo="+result+"&tipo=1&upp="+upp+"&fecha="+fecha+"&prueba="+tipo+"";

            }else{
                swal('', datos,'warning');
            }
        });

    });
}

function  motivoBorrarBr(id,upp,tipo,fecha) {

    parametro = {
        "id" : id,
        "upp" : upp,
        "fecha" : fecha,
        "tipo" : tipo
    };

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
        $.get("index.php?r=dictamenes-repetidos/deletedictamen&id="+id+"&motivo="+result+"&tipo=2&upp="+upp+"&fecha="+fecha+"&prueba="+tipo, function(datos){
            if(datos==1){
                //mandar la impresion

                location.href= "index.php?r=dictamenes-repetidos/deletedictamen&id="+id+"&motivo="+result+"&tipo=2&upp="+upp+"&fecha="+fecha+"&prueba="+tipo+"";

            }else{
                swal('', datos,'warning');
            }
        });

    });
}

function  motivoBorrarVc(id,upp,fecha) {

    parametro = {
        "id" : id,
        "upp" : upp,
        "fecha" : fecha
    };

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
        $.get("index.php?r=dictamenes-repetidos/deletedictamen&id="+id+"&motivo="+result+"&tipo=3&upp="+upp+"&fecha="+fecha+"&prueba=0", function(datos){
            if(datos==1){
                //mandar la impresion

                location.href= "index.php?r=dictamenes-repetidos/deletedictamen&id="+id+"&motivo="+result+"&tipo=3&upp="+upp+"&fecha="+fecha+"&prueba=0";

            }else{
                swal('', datos,'warning');
            }
        });

    });
}

function  motivoBorrarGr(id,upp,tipo,fecha) {

    parametro = {
        "id" : id,
        "upp" : upp,
        "fecha" : fecha,
        "tipo" : tipo
    };

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
        $.get("index.php?r=dictamenes-repetidos/deletedictamen&id="+id+"&motivo="+result+"&tipo=4&upp="+upp+"&fecha="+fecha+"&prueba="+tipo, function(datos){
            if(datos==1){
                //mandar la impresion

                location.href= "index.php?r=dictamenes-repetidos/deletedictamen&id="+id+"&motivo="+result+"&tipo=4&upp="+upp+"&fecha="+fecha+"&prueba="+tipo+"";

            }else{
                swal('', datos,'warning');
            }
        });

    });
}