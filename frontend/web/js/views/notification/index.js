$(function(){
  $('button.close').click(function(){
    var $msg=$(this).closest('div.panel');
    var id=$(this).data('id');

    
    $.ajax({
      url: "/notification/delete?id="+id,
      method:'POST',
      type:'text',
      success:function(data){
        $msg.remove();
      }
    });
    
  });
});