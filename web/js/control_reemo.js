/**
 * Created by Edd on 26/06/2017.
 */
$(document).ready(function(){

    $('body').on('keyup', '.select2-search__field', function() {
        var selectItem = $('.select2-container--open').prev();
        var index = selectItem.index();
        var id = selectItem.attr('id');

        if(id == 'reemomanual-r01_origen' || id == 'reemomanual-r01_destino'){
            $('.select2-search__field').mask('00-000-0000-AAA');
        }else{
            $('.select2-search__field').unmask();
        }

    });

    $('#bus_arete').mask('0000000000');
    uppOrigen();
    uppDestino();
});

function uppOrigen() {
    if(document.getElementById('id_origen').value!=-1){
        var id_origen = document.getElementById('id_origen').value;
        var id_destino = document.getElementById('id_destino').value;
    }else{
        var id_origen = document.getElementById('reemomanual-r01_origen').value;
        var id_destino = document.getElementById('reemomanual-r01_destino').value;
    }

    if ((id_destino != '' && id_origen != '') && (id_destino != null && id_origen != null) && (id_origen == id_destino)) {
        swal("Aviso.", "No se puede elegir la misma UPP como origen y destino.")
            .catch(swal.noop);
        document.getElementById('reemomanual-r01_origen').value='';
        $('#reemomanual-r01_origen').val('').trigger('change');
    }else if(id_destino == '' && id_origen == ''){
        document.getElementById('origen_nombre').value = '';
        document.getElementById('origen_direccion').value = '';
        document.getElementById('origen_localidad').value = '';
    }

    var id= document.getElementById('reemomanual-r01_origen').value;
    if(id){
        parametro = {"id": id};
        $.ajax({
            type: 'GET',
            url: 'index.php?r=reemo-manual/infoupp',
            data: parametro,
            dataType: "json",
            success: function (res) {
                if (res) {
                    document.getElementById('origen_nombre').value = res[0];
                    document.getElementById('origen_direccion').value = res[1];
                    document.getElementById('origen_localidad').value = res[2];
                }
            }
        });
    }
}

function uppDestino() {
    if(document.getElementById('id_origen').value!=-1){
        var id_origen = document.getElementById('id_origen').value;
        var id_destino = document.getElementById('id_destino').value;
    }else{
        var id_origen = document.getElementById('reemomanual-r01_origen').value;
        var id_destino = document.getElementById('reemomanual-r01_destino').value;
    }
    if ((id_destino != '' && id_origen != '') && (id_destino != null && id_origen != null) && (id_origen == id_destino)) {
        swal("Aviso.", "No se puede elegir la misma UPP como origen y destino.")
            .catch(swal.noop);
        document.getElementById('reemomanual-r01_destino').value='';
        $('#reemomanual-r01_destino').val('').trigger('change');
    }else if(id_destino == '' && id_origen == ''){
        document.getElementById('destino_nombre').value = '';
        document.getElementById('destino_direccion').value = '';
        document.getElementById('destino_localidad').value = '';
    }

    var id= document.getElementById('reemomanual-r01_destino').value;
    if(id){
        parametro = {"id": id};
        $.ajax({
            type: 'GET',
            url: 'index.php?r=reemo-manual/infoupp',
            data: parametro,
            dataType: "json",
            success: function (res) {
                if (res) {
                    document.getElementById('destino_nombre').value = res[0];
                    document.getElementById('destino_direccion').value = res[1];
                    document.getElementById('destino_localidad').value = res[2];
                }
            }
        });
    }
}

function agregarArete(){
    var num = document.getElementById('bus_arete').value
    if(document.getElementById('id_reemo').value!=-1)
        var id_reemo = document.getElementById('id_reemo').value;
    else
        var id_reemo = 0;
    parametro = {"id_reemo": id_reemo, "arete":num};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=reemo-manual/aretelistado',
        data: parametro,
        success: function (res) {
            if (res==0) {

                if(id_reemo==0){ //agregar aretes del create en la tabla

                    parametro = {"num": num};
                    $.ajax({
                        type: 'GET',
                        url: 'index.php?r=reemo-manual/agregaralista',
                        data: parametro,
                        success: function (res) {
                            if (res==1) {
                                document.getElementById('bus_arete').value = '';
                                document.getElementById('bus_edad').value = '';
                                document.getElementById('bus_raza1').value = '';
                                document.getElementById('bus_raza2').value = '';
                                document.getElementById('bus_sexo').value = '';
                                document.getElementById('bus_arete').focus();
                                document.getElementById('bus_arete').select();
                                $.pjax.reload({container: "#tablaar", timeout: false});
                            }else{
                                swal("Aviso.", "El arete no existe en la base de datos.")
                                    .catch(swal.noop);
                            }
                        }
                    });

                }else//agregar aretes del update en la tabla
                    {

                    parametro = {"num": num, "id":id_reemo};
                    $.ajax({
                        type: 'GET',
                        url: 'index.php?r=reemo-manual/agregaralistaupdate',
                        data: parametro,
                        success: function (res) {
                            if (res==1) {
                                document.getElementById('bus_arete').value = '';
                                document.getElementById('bus_edad').value = '';
                                document.getElementById('bus_raza1').value = '';
                                document.getElementById('bus_raza2').value = '';
                                document.getElementById('bus_sexo').value = '';
                                document.getElementById('bus_arete').focus();
                                document.getElementById('bus_arete').select();
                                $.pjax.reload({container: "#tablaar", timeout: false});
                            }else{
                                swal("Aviso.", "El arete no existe en la base de datos.")
                                    .catch(swal.noop);
                            }
                        }
                    });

                }

            }else{
                swal("Aviso.", "El arete ya está en la lista de aretes.")
                    .catch(swal.noop);
                document.getElementById('bus_arete').value = '';
                document.getElementById('bus_edad').value = '';
                document.getElementById('bus_raza1').value = '';
                document.getElementById('bus_raza2').value = '';
                document.getElementById('bus_sexo').value = '';
                document.getElementById('bus_arete').focus();
                document.getElementById('bus_arete').select();
            }
        }
    });


}

$( "#bus_arete" ).keyup(function() {

    var arete = document.getElementById('bus_arete').value

    if(arete.length>0){
        parametro = {"arete": arete};
        $.ajax({
            type: 'GET',
            url: 'index.php?r=reemo-manual/getareteupp',
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
                }
            }
        });

    }else{
        document.getElementById('bus_edad').value = "";
        document.getElementById('bus_raza1').value = "";
        document.getElementById('bus_raza2').value = "";
        document.getElementById('bus_sexo').value = "";
    }

});