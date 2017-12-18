
$(function() {

    
    $('.btn-test').click(function(){
      //console.log($(this).closest('tr'));
      var $statusField=$(this).closest('tr').find('#col-status');
      $statusField.empty();
      $statusField.html('<i class="icon-spinner2 spinner"></i>');

      var id=$(this).data('id');
      $.ajax({
        type: 'POST',
        url: 'test?id='+id,
        success:function(data){
          $statusField.empty();
          $statusField.html(data);

          $statusField.find('[data-popup="tooltip"]').tooltip();
            
        },
        error: function(data) { // if error occured
          console.log("Error occured.please try again");
        },
        dataType:'html'
      });
    });

    

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
              url: 'delete?alias='+id,
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
    
});