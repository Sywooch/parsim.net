$(function(){
  $('.comment-reply-link').click(function(){
    $('#comment-parent-id').val($(this).data('id'));
  });
});