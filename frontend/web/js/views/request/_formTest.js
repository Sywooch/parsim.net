$(function(){
  initForm();

  function initForm(){
    $('#request-submit').click(function(){
      var data=$("#request-form").serialize();
      $.ajax({
        type: 'POST',
        data:data,
        url: $('#request-form').attr('action'),
        success:function(data){

          if(data.form){
            $('#demo-request-area').html(data.form);  
          }

          if(data.view){
           $('#demo-request-area').html(data.view);   
          }

          initForm();
        },
        error: function(data) { // if error occured
          console.log("Error occured.please try again");
        },
        dataType:'json'
      });

      return false; 
    });

    $('#try-again').click(function(){
      $.ajax({
        type: 'GET',
        url: '/request/create-test',
        success:function(data){

          if(data.form){
            $('#demo-request-area').html(data.form);  
          }

          if(data.view){
           $('#demo-request-area').html(data.view);   
          }

          initForm();
        },
        error: function(data) { // if error occured
          console.log("Error occured.please try again");
        },
        dataType:'json'
      });

      
      
      return false; 
    });    
  }
  
});