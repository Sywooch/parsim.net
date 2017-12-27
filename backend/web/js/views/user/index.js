
$(function() {

    $('.btn-delete').on('click', function() {
        var id=$(this).data('id');
        var $row=$(this).closest('tr');
        
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this item!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#FF7043",
            confirmButtonText: "Yes, delete it!"
        },function() {
            $.ajax({
              type: 'POST',
              url: 'delete?id='+id,
              success:function(data){
                $row.remove();
              },
              error: function(data) { // if error occured
                console.log("Error occured.please try again");
              },
              dataType:'html'
            });
        });
    });


    $('.btn-disable').on('click', function() {
        var id=$(this).data('id');
        var $statusField=$(this).closest('tr').find('#col-status');

        $.ajax({
          type: 'POST',
          url: 'disable?id='+id,
          success:function(data){
            $statusField.empty();
            $statusField.html(data);
          },
          error: function(data) { // if error occured
            console.log("Error occured.please try again");
          },
          dataType:'html'
        });
    });

    $('.btn-enable').on('click', function() {
        var id=$(this).data('id');
        var $statusField=$(this).closest('tr').find('#col-status');

        $.ajax({
          type: 'POST',
          url: 'enable?id='+id,
          success:function(data){
            $statusField.empty();
            $statusField.html(data);
          },
          error: function(data) { // if error occured
            console.log("Error occured.please try again");
          },
          dataType:'html'
        });
    });
    
});