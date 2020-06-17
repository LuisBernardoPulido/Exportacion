function validarInicio(){
    var ini =document.getElementById('foliosestatal-r20_rangoinicio').value;
    var tipo =document.getElementById('tipo_dict').value;
    var id = document.getElementById('id_registro').value;
    if(ini!=''){
        val = {"ini": ini, "tipo": tipo, "id":id};
        $.ajax({
            type: 'GET',
            url: 'index.php?r=folios-estatal/validar_fol_ini',
            data: val,
            dataType: "json",
            success: function (res) {
                if(res==1){
                    swal({
                        type: 'error',
                        title: 'No se puede asignar el folio ' + ini + '.',
                        text: 'El folio no se encuentra en la lista de folios asignables.',
                    }).catch(swal.noop);
                    document.getElementById('foliosestatal-r20_rangoinicio').value='';
                }else if(res==2){
                    swal({
                        type: 'error',
                        title: 'No se puede asignar el folio ' + ini + '.',
                        text: 'El folio ya fue asignado.',
                    }).catch(swal.noop);
                    document.getElementById('foliosestatal-r20_rangoinicio').value='';
                }
            }
        });
    }
}

function validarFin(){
    var ini =document.getElementById('foliosestatal-r20_rangoinicio').value;
    var fin =document.getElementById('foliosestatal-r20_rangofin').value;
    var tipo =document.getElementById('tipo_dict').value;
    var id = document.getElementById('id_registro').value;
    if(ini!='' && fin!='' && validarOrden(ini, fin)){
        val = {"ini": ini, "fin": fin, "tipo": tipo, "id":id};
        $.ajax({
            type: 'GET',
            url: 'index.php?r=folios-estatal/validar_fol_fin',
            data: val,
            dataType: "json",
            success: function (res) {
                if(res==1){
                    swal({
                        type: 'error',
                        title: 'No se puede asignar el rango de folios del ' + ini + ' al '+ fin +'.',
                        text: 'Hay folios que no se encuentra en la lista de folios asignables.',
                    }).catch(swal.noop);
                    document.getElementById('foliosestatal-r20_rangoinicio').value='';
                    document.getElementById('foliosestatal-r20_rangofin').value='';
                }else if(res==2){
                    swal({
                        type: 'error',
                        title: 'No se puede asignar el rango de folios del ' + ini + ' al '+ fin +'.',
                        text: 'El rango interfiere con folios asignados.',
                    }).catch(swal.noop);
                    document.getElementById('foliosestatal-r20_rangoinicio').value='';
                    document.getElementById('foliosestatal-r20_rangofin').value='';
                }

            }
        });
    }
}

function foliosPendientes() {
    var med =document.getElementById('foliosestatal-user_role').value;
    if(med!=''){
        val = {"med": med};
        $.ajax({
            type: 'GET',
            url: 'index.php?r=folios-estatal/folios_pendientes',
            data: val,
            dataType: "json",
            success: function (res) {
                if(res){
                    document.getElementById('pendientes').value=res;
                }else
                    document.getElementById('pendientes').value=0;

            }
        });
    }
}

function validarFoliosTipo(){
    var ini =document.getElementById('foliosestatal-r20_rangoinicio').value;
    var fin =document.getElementById('foliosestatal-r20_rangofin').value;
    if(ini!='' && fin==''){
        validarInicio();
    }else if(ini!='' && fin!=''){
        validarFin();
    }
}

function validarOrden(ini, fin){
    if(ini>fin){
        swal({
            type: 'error',
            title: 'El folio inicial debe ser menor o igual al folio final.',
            //text: 'El folio ya fue asignado.',
        });
        document.getElementById('foliosestatal-r20_rangoinicio').value='';
        document.getElementById('foliosestatal-r20_rangofin').value='';
        return false;
    }else
        return true;
}