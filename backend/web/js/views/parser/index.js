
$(function() {

    $('#btn-import').click(function(){
        $('#input-file').click();
        return false;
    });

    $('#input-file').change(function(){
        $('#parser-import-form').submit();
    });
    
});