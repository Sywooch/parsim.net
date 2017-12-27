
$(function() {

    // Multiselect
    $('.multiselect').multiselect({
        dropRight: true,
        onChange: function(option, checked, select) {
            $.uniform.update();
        }
    });

    // Checkboxes and radios
    $(".styled, .multiselect-container input").uniform({ radioClass: 'choice' });

    // select2 Default initialization
    $('.select').select2({
        minimumResultsForSearch: Infinity
    });

    initTabEvents();

    $('#btn-add-action').click(function(){
        var $btn=$(this);
        
        $.ajax({
          type: 'POST',
          url: 'create-action?index='+$btn.data('index'),
          success:function(data){
            $btn.data('index',data.index);
            //var html=data.actionTab+$('#action-tabs').html();
            //$('#action-tabs').html(html);
            //$('#action-tabs').tab();
            $(data.actionTab).prependTo('#action-tabs');
            $(data.actionContent).prependTo('#action-contents');
            initTabEvents();
            //$('#lnk-tab-'+data.index).click();
            
            
          },
          error: function(data) { // if error occured

            console.log("Error occured.please try again");
          },
          dataType:'json'
        });
        
    });

    function initTabEvents(){
        $('.btn-delete-action').click(function(){
            var tab_index=$(this).data('index');
            $('#tab-'+tab_index).remove();
            $('#action-tab'+tab_index).remove();

            //$(this).closest('ul').parent().remove();
            if( $('#action-tabs li').length>1){
                $('#action-tabs li:eq(0) a:eq(0)').click();
            }
            
            
        });
    }
    /*

    $('.php_editor').each(function(){
        var editorId=$(this).attr('id');
        var modelInputId='#'+editorId.replace(/_/g, '-');

        var php_editor = ace.edit(editorId);

        php_editor.setTheme("ace/theme/monokai");
        php_editor.getSession().setMode("ace/mode/php");
        php_editor.setShowPrintMargin(false);
        
        php_editor.getSession().on('change', function(e){
            $(modelInputId).val(php_editor.getValue());
        });
    });
    */
    
});