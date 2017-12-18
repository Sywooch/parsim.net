
$(function() {

    // Multiselect
    $('.multiselect').multiselect({
        dropRight: true,
        onChange: function(option, checked, select) {
            $.uniform.update();
        }
    });

    // Checkboxes and radios
    $(".styled, .multiselect-container input").uniform({ radioClass: 'choice' });

    // select2 Default initialization
    $('.select').select2({
        minimumResultsForSearch: Infinity
    });

    /*

    $('.php_editor').each(function(){
        var editorId=$(this).attr('id');
        var modelInputId='#'+editorId.replace(/_/g, '-');

        var php_editor = ace.edit(editorId);

        php_editor.setTheme("ace/theme/monokai");
        php_editor.getSession().setMode("ace/mode/php");
        php_editor.setShowPrintMargin(false);
        
        php_editor.getSession().on('change', function(e){
            $(modelInputId).val(php_editor.getValue());
        });
    });
    */
    
});