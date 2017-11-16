$(function(){
  $('#order-amount').on('input',function(){
    //
    var ammount=Number($(this).val()).toFixed(2);
    
    $('#sum').val(ammount);
  });
  $('#btn-submit').click(function(){

    $.ajax({
      url: "create",
      method:'POST',
      dataType:'JSON',
      data:$('#form-pay').serialize(),
      success:function(data){
        gtag('event', 'test_parser', {
          // Event parameters
          'event_category': 'order',
          'event_action': 'create',
          'event_label':'Создание заказа на оплату',
          'value':data.amount
        });

        $('#form-pay #sum').val(data.amount);
        $('#form-pay #customerNumber').val(data.user_id);
        $('#form-pay #orderNumber').val(data.alias);
        $('#form-pay').submit();    
        
        
      }
    });
    
  });
});

