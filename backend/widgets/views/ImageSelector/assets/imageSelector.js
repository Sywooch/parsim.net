$(function(){
  /*================================================== 
  /
  / Блок для single режима
  /
  ==================================================*/

  //Нажатие кнопки добавить файл
  $('.btn-add-single-file').click(function(){
    var container=$(this).closest(".single-upload-place");
    
    var inputFile=container.find('.hidden-area .signle-file-input');
    inputFile.click();
  });

  //Нажатие кнопки удалить файл
  $('.btn-delete-single-file').click(function(){
    var container=$(this).closest(".single-upload-place");
    var img=container.find('img');


    var inputFile=container.find('.hidden-area .signle-file-input');
    var inputHidden=container.find('.hidden-area .signle-file-id');
    var label=container.find('.signle-label');

    img.attr('src', img.data('default-src'));
    inputFile.val('');
    inputHidden.val('');
    label.removeClass('hidden');
  });
  
  //Выбран новый файл
  $('.signle-file-input').on('change',function(){
    var selectedFile = this.files[0];
    var container=$(this).closest(".single-upload-place");
    //var label=container.find('.signle-label');
    var img=container.find('img');
    
    selectedFile.convertToBase64(function(base64){
        //container.css('background-image', 'url(' + base64 + ')');
        img.attr('src',base64);
    });

    //label.addClass('hidden');
  });


  /*================================================== 
  /
  / Блок для multiply режима
  /
  ==================================================*/

  //Нажатие кнопки добавить файл
  $('.btn-add-multy-file').click(function(){
    var container=$(this).closest(".multiply-upload-place");
    var inputFile=container.find('.widgetInputFile');
    inputFile.click();
  });

  $('.btn-delete-multy-file ').click(function(){
    var container=$(this).closest(".multiply-upload-place");

    container.find('.dropzone .dz-image-preview').each(function(){
      $(this).remove();
    });
    
  });


  $('.widgetInputFile').on('change',function(){

    var selectedFiles = this.files;
    var container=$(this).closest(".multiply-upload-place");

    for (var i = 0; i<selectedFiles.length; i++) {
      var selectedFile= selectedFiles[i];
      var data={
        name:selectedFile.name,
        size:selectedFile.size,
        base64:null
      }
      selectedFile.convertToBase64(function(base64){
        //var container=$(this).closest(".multiply-upload-place");
        var tmpl=$(container.find('.preview-template').html());
        $(tmpl).find('.dz-image').append('<img src="' + base64 + '">');
          
        data.base64=base64;
        
        $(tmpl).find('.dz-image').append('<input type="hidden" name="'+ container.data('field')+'" value=\''+JSON.stringify(data)+'\'>');

        container.find('.dropzone').append(tmpl);
        
        initPreviewActions();
      });  
    }
  });

  initPreviewActions();

  

  function initPreviewActions(){
    $('.remove-pteview').click(function(){
      $(this).parent().remove();
      return false;
    });
  }


  /*================================================== 
  /
  /  Общие функции
  /
  ==================================================*/
  File.prototype.convertToBase64 = function(callback){
    var FR= new FileReader();
    FR.onload = function(e) {
      callback(e.target.result)
    };       
    FR.readAsDataURL(this);
  } 

});