
$(function() {

    var actionCount=$('.action-item').length;
    console.log(actionCount);

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

    setEvents();

    $('.add-action').click(function(){
        $.ajax({
          url: "view-action?index="+actionCount,
          method:'POST',
          dataType:'HTML',
          
          success:function(data){
            $('#action-list').append(data);
            actionCount++;
            setEvents();
          }
        });
    });

    function setEvents(){
        $('.remove-item').click(function(){
            $(this).parent().parent().remove();
        });

        $('.select').select2({
            minimumResultsForSearch: Infinity
        });  
    }
    

});