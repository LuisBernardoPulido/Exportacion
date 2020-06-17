function buscarFolio(){

    var folio = document.getElementById("num_dictamen").value;
    var val = document.getElementById("tipo_dic");
    var tipo = val.options[val.selectedIndex].value;

    if(validarBusqueda(folio, tipo)){
        parametro = {"folio": folio, "tipo": tipo};
        var p_coor = document.getElementById("panel_coordinador");
        var p_super = document.getElementById("panel_supervisor");
        var p_dict = document.getElementById("panel_dictamen");
        var p_canc = document.getElementById("panel_cancelado");
        p_coor.style.display = "none";
        p_super.style.display = "none";
        p_dict.style.display = "none";
        p_canc.style.display = "none";

        $.ajax({
            type: 'GET',
            url: 'index.php?r=folios/infocoordinador',
            data: parametro,
            dataType: "json",
            success: function (res) {
                if (res) {
                    document.getElementById('txt_coor_administrador').innerHTML = "ADMINISTRADOR QUE ASIGNÓ EL FOLIO: " +  res[0];
                    document.getElementById('txt_coor_rango').innerHTML = "RANGO DE FOLIOS ASIGNADOS: " +  res[1];
                    document.getElementById('txt_coor_coordinador').innerHTML = "NOMBRE DEL COORDINADOR: " +  res[2];
                    p_coor.style.display = "block";
                }else{
                    p_coor.style.display = "none";
                }
            }
        });

        $.ajax({
            type: 'GET',
            url: 'index.php?r=folios/infosupervisor',
            data: parametro,
            dataType: "json",
            success: function (res) {
                if (res) {
                    document.getElementById('txt_super_administrador').innerHTML = "COORDINADOR QUE ASIGNÓ EL FOLIO: " + res[0];
                    document.getElementById('txt_super_rango').innerHTML = "RANGO DE FOLIOS ASIGNADOS: " + res[1];
                    document.getElementById('txt_super_supervisor').innerHTML = "NOMBRE DEL SUPERVISOR: " + res[2];
                    p_super.style.display = "block";
                }else{
                    p_super.style.display = "none";
                }
            }
        });

        $.ajax({
            type: 'GET',
            url: 'index.php?r=folios/infodictamen',
            data: parametro,
            dataType: "json",
            success: function (res) {
                if (res) {
                    document.getElementById('txt_medico').innerHTML = "MÉDICO: " + res[0];
                    document.getElementById('txt_upp').innerHTML = "UPP: " + res[1];
                    document.getElementById('txt_tipo').innerHTML = "TIPO DE PRUEBA: " + res[2];
                    document.getElementById('txt_usuario').innerHTML = "USUARIO ALTA: " + res[3];
                    document.getElementById('txt_dictaminado').innerHTML = "DICTAMINADO: " + res[4];
                    document.getElementById('txt_fecha').innerHTML = "FECHA DE ALTA: " + res[5];
                    p_dict.style.display = "block";
                }else{
                    p_dict.style.display = "none";
                }
            }
        });

        $.ajax({
            type: 'GET',
            url: 'index.php?r=folios/infocancelacion',
            data: parametro,
            dataType: "json",
            success: function (res) {
                if (res) {
                    document.getElementById('txt_cancelo').innerHTML = "USUARIO CANCELÓ: " + res[0];
                    document.getElementById('txt_fecha_cancelo').innerHTML = "FECHA DE CANCELACIÓN: " + res[1];
                    p_canc.style.display = "block";
                }else{
                    p_canc.style.display = "none";
                }
            }
        });

    }
}

function validarBusqueda(folio, tipo){

    var valido = false;
    if(folio.length==0){
        alert("No se ha ingresado un folio");
        document.getElementById("num_dictamen").focus();
    }else if(tipo==''){
        alert("No se ha seleccionado el tipo de dictamen");
    }else
        valido = true;

    return valido;
}