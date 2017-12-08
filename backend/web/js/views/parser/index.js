
$(function() {

    $('#btn-import').click(function(){
        $('#input-file').click();
        return false;
    });

    $('#input-file').change(function(){
        $('#parser-import-form').submit();
    });

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
      //return false;
      
      
    });
    
});