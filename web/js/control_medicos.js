/**
 * Created by Eduardo on 14/03/2017.
 */
$(document).ready(function(){
    $('#medicos-c05_clave').mask('0000-00-000-00');
    $('#medicos-c05_rfc').mask('AAAAAAAAAAAAA');
    $('#medicos-c05_curp').mask('SSSS000000SSSSSS00');
    $('#medicos-c05_cp').mask('00000');
    $('#medicos-c05_telefono').mask('000-000-0000');
    $('#medicos-c05_fexpiracionlicencia').mask('0000-00-00');
});

$( "#medicos-c05_correo" ).keyup(function() {
    var correo = document.getElementById('medicos-c05_correo').value
    var correcto = true;
    if(correo.length>0)
        correcto = validarEmail(correo);
    if(!correcto){
        $( "#email_rep" ).fadeIn( "slow", function() {});
    }else
        $( "#email_rep" ).fadeOut( "slow", function() {});
});

function validarEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function tipoMedico(){
    var tipo = document.getElementById('medicos-c05_tipomvz').value;
    if(tipo==0 || tipo==2 || tipo==3){
        $( "#cve_med" ).fadeIn( "fast", function() {});
        $( "#fecha_exp" ).fadeIn( "fast", function() {});
    }else{
        $( "#cve_med" ).fadeOut( "fast", function() {});
        $( "#fecha_exp" ).fadeOut( "fast", function() {});
        document.getElementById('medicos-c05_clave').value="0000-00-000-01";
    }

}