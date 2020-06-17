$('body').on('keyup', '.select2-search__field', function() {
    var selectItem = $('.select2-container--open').prev();
    var index = selectItem.index();
    var id = selectItem.attr('id');

    if(id == 'dictameneseliminadossearch-r01_id'){
        $('.select2-search__field').mask('00-000-0000-AAA');
    }else{
        $('.select2-search__field').unmask();
    }
});