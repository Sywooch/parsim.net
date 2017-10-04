$(function(){
  $("#order-qty").change(function() {
    var ammount=$(this).val()*$('#order-price').val();
    $('#total-amount').text(ammount);
    $('#order-amount').val(ammount);
  });

  $('#btn-submit').click(function(){

    $.ajax({
      url: "create",
      method:'POST',
      dataType:'JSON',
      data:$('#form-pay').serialize(),
      success:function(data){
        $('#form-pay #sum').val(data.amount);
        $('#form-pay #customerNumber').val(data.user_id);
        $('#form-pay #orderNumber').val(data.id);
        $('#form-pay').submit();    
        //console.log(data);
      }
    });
    
  });
});

