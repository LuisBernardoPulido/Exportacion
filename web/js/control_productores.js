$(document).ready(function(){
    $('#ganaderos-c01_rfc').mask('AAAAAAAAAAAAA');
    $('#ganaderos-c01_curp').mask('SSSS000000SSSSSS00');
    $('#ganaderos-c01_cp').mask('00000');
    $('#ganaderos-c01_telefono').mask('000-000-0000');
    //$('.select2-search__field').mask('00-000-0000-000');

    $('body').on('keyup', '.select2-search__field', function() {
        var selectItem = $('.select2-container--open').prev();
        var index = selectItem.index();
        var id = selectItem.attr('id');

        if(id == 'propietariounidad-r01_id'){
            $('.select2-search__field').mask('00-000-0000-AAA');
        }else{
            $('.select2-search__field').unmask();
        }
    });

});


$( "#ganaderos-c01_correo" ).keyup(function() {
    var correo = document.getElementById('ganaderos-c01_correo').value
    var correcto = true;
    if(correo.length>0)
        correcto = validarEmail(correo);
    if(!correcto){
        $( "#val_email" ).fadeIn( "slow", function() {});
    }else
        $( "#val_email" ).fadeOut( "slow", function() {});
});

function tipoPersona(){
    var tipo = document.getElementById('ganaderos-c01_tipo').value;
    if(tipo==1){
        $( "#moral" ).fadeIn( "fast", function() {});
        $( "#curp" ).fadeOut( "fast", function() {
            document.getElementById('ganaderos-c01_curp').value=null;
        });

    }else{
        $( "#moral" ).fadeOut( "fast", function() {});
        $( "#curp" ).fadeIn( "fast", function() {
            document.getElementById('ganaderos-c01_razonsocial').value=null;
            document.getElementById('ganaderos-c01_rfc').value=null;
        });

    }

}

function validarEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function mostrarmodal(id) {
    swal({
        title: 'Productor existente',
        text: '¿Deseas editarlo?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#942626',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'Cancelar',
        allowOutsideClick: false,
        allowEnterKey: false,
    }).then(function (res) {
        location.href = "index.php?r=ganaderos/update&id=" + id + "";
    }, function (dismiss) {
        // dismiss can be 'cancel', 'overlay',
        // 'close', and 'timer'
        if (dismiss === 'cancel') {
            document.getElementById('ganaderos-c01_apaterno').value = '';
            /*$("#curp_rep").fadeOut("slow", function () {
            });*/
        }
    });
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