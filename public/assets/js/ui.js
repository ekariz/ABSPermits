var ui = {
    cc:function(  _path , _params , update_element){/*normal ajax call*/

        $.ajax({
          type: 'POST',
          url: _path,
          data: _params,
          success: function(responseText){
            $('#'+update_element+'').html(responseText);
         }
        });
     },
    fc:function( _params , update_element){/*fast call*/
        $.ajax({
          type: 'POST',
          url: _params,
          success: function(responseText){
            $('#'+update_element+'').html(responseText);
         }
        });
     },
    bc:function( _path, _params){/*null call*/
        $.ajax({
          type: 'POST',
          url: _path,
          data: _params,
          success: function(responseText){

         }
        });
     },
    tc:function(url,then){
     $.post(url).then(function(data){eval(then+'()');},
     function(){alert( url+" Failed!" );});
    },
    tcj:function(url,then){
    var request = $.ajax( url, { dataType: "json" } ),
     chained = request.then(function( data ) {
      console.log(data);
     });
    },
    call:function(  url , _params , update_element){/*normal ajax call*/
        $.ajax({
          type: 'POST',
          url: url,
          data: _params,
          success: function(responseText){
            $('#'+update_element+'').html(responseText);
         }
        });
     },
    fp:function(data, debug ) {
        $.each(data, function(name, val){
            var $el = $('#'+name),elType = $el.prop('tagName');
            if(elType=='DIV' || elType=='SPAN' || elType=='TD' ){
             $el.html(val);
            }else{
            var $el = $('[name="'+name+'"]'),
                type = $el.attr('type');
                elementType = $('input#'+name).prop('tagName') ? 1 : 0;
                is_textarea = $('#'+name).is("textarea");
                if(typeof debug=='number' && debug==1){
                console.log('name='+name);
                console.log('val='+val);
                console.log('type='+type);
                console.log('elementType='+elementType);
               }
            if(is_textarea===true){
              $('#'+name).val(val);
            }else{
             switch(type){
                case 'checkbox':
                     if(val!=null && val!=0){
                      $el.attr('checked', true);
                     }else{
                      $el.attr('checked', false);
                     }
                    break;
                case 'radio':
                    $el.filter('[value="'+val+'"]').attr('checked', 'checked');
                    break;
                case 'number':
                    $el.val(val);
                    break;
                case 'email':
                    $el.val(val);
                    break;
                default:
                   if( (elementType ==1) ){
                    $el.val(val);
                   }else{
                    if( $("#"+name+" option[value='"+val+"']").length > 0 ){
                     jQuery("select#"+name+" option[value='"+val+"']").attr("selected", "selected");
                     $('[name="'+name+'"]').val(val);
                    }else{
                     if(val!==''){
                      $("select#"+name).append("<option value=" + val + " selected >" + val + "</option>");
                     }
                    }
                  }
             }
            }
          }
        });
     },
     ff:function( _params, name ){/*get value*/
        $.ajax({
          type: 'POST',
          url: _params,
          success: function(val){
            var $el = $('[name="'+name+'"]'),
                type = $el.attr('type');
                elementType = $('input#'+name).prop('tagName') ? 1 : 0;
                is_textarea = $('#'+name).is("textarea");
            if(is_textarea===true){
              $('#'+name).val(val);
            }else{
             switch(type){
                case 'checkbox':
                    $el.attr('checked', 'checked');
                    $('input#disabled').attr('checked', 'checked');
                    $('#disabled').attr('checked', 'checked');
                    break;
                case 'radio':
                    $el.filter('[value="'+val+'"]').attr('checked', 'checked');
                    break;
                default:
                   if( (elementType ==1) ){
                    $el.val(val);
                   }else{
                    $('[name="'+name+'"]').val(val);
                   }
             }
            }
         }
        });
     },
     fpa:function(url , then){
      $.post(url, '', function(data) {
      if (data.success === 1) {
       ui.fp(data);
       if(typeof then=='string' && then!=''){eval(then+'()');}
      }else{
       alert(data.message);
      }
     }, "json");
    },
    fpf:function(url){
      $.post(url, '', function(data) {
      if (data.success === 1) {
       ui.fp(data);
      }else{
       if(typeof data.message=='string' ){ alert(data.message);}
      }
     }, "json");
    },
    fpt:function(url ,params, then){
      $.post(url, params, function(data) {
      if (data.success === 1) {
       ui.fp(data);
       if(typeof then=='string' && then!=''){eval(then+'()');}
      }else{
       alert(data.message);
      }
     }, "json");
    },
    ps:function(url ,params, select_id, selected_value){
     $.post(url, params, function(data) {
      $('#'+select_id).find('option').remove();
      var selected ='';
      $.each(data, function(index,item) {
       if(typeof item.id!='undefined' && typeof item.name!='undefined'){
        selected  = selected_value == item.id ? 'selected' : '';
        $("select#"+select_id).append("<option value=" + item.id + " "+selected+" >" + item.name + "</option>");
       }
      });
     }, "json");
    },
}
