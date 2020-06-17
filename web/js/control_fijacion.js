function cambiarUL(ui){
    if(ui==-1){
        $("#brucelosissearch-p03_tipoprueba").val("").trigger('change');
    }else{
        $("#brucelosissearch-p03_tipoprueba").val(ui).trigger('change');
    }
}
