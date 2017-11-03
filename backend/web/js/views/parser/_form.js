
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
    
});