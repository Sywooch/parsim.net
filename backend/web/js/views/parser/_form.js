
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

    var php_editor = ace.edit("php_editor");
        php_editor.setTheme("ace/theme/monokai");
        php_editor.getSession().setMode("ace/mode/php");
        php_editor.setShowPrintMargin(false);
        php_editor.getSession().on('change', function(e) {
            $('#class-code').val(php_editor.getValue());
        });
    
});