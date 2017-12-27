
$(function() {

    $('#btn-import').click(function(){
        $('#input-file').click();
        return false;
    });

    $('#input-file').change(function(){
        $('#parser-import-form').submit();
    });

    /*

    $('.btn-test').click(function(){
      
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
    */
    $('.btn-test').on('click', function() {
        var id=$(this).data('id');
        var $row=$(this).closest('tr');

        $.ajax({
          type: 'POST',
          url: 'test?id='+id,
          success:function(data){
            
            swal({
                title: data.title,
                text: data.text,
                type: data.type,
                confirmButtonColor:data.confirmButtonColor,
                
            });
          },
          error: function(data) { // if error occured
            console.log("Error occured.please try again");
          },
          dataType:'json'
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


    $('.btn-send-to-email').on('click', function() {
        var id=$(this).data('id');
        $.ajax({
          type: 'POST',
          url: 'test-email?id='+id,
          success:function(data){
            swal({
                title: data.title,
                text: data.text,
                type: data.type,
                confirmButtonColor:data.confirmButtonColor,
                
            });
          },
          error: function(data) { // if error occured
            console.log("Error occured.please try again");
          },
          dataType:'json'
        });
    });

    $('.btn-send-to-url').on('click', function() {
        var id=$(this).data('id');
        $.ajax({
          type: 'POST',
          url: 'test-url?id='+id,
          success:function(data){
            swal({
                title: data.title,
                text: data.text,
                type: data.type,
                confirmButtonColor:data.confirmButtonColor,
                
            });
          },
          error: function(data) { // if error occured
            console.log("Error occured.please try again");
          },
          dataType:'json'
        });
    });
    
});