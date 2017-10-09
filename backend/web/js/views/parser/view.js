
$(function() {

    $('.btn-test').click(function(){
        $.ajax({
          url: "test-url?url="+$('#test-url').val(),
          method:'POST',
          dataType:'JSON',
          
          success:function(data){
            $('#test-result').text(data.value);
          }
        });
    });

});