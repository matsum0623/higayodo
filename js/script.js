  function select_big_id(){
    jQuery('[name=med_id]').children().remove();
    jQuery('[name=med_id]').append("<option value=''>  -- 中分類を選択 --  </option>")
    jQuery('[name=sml_id]').children().remove();
    jQuery('[name=sml_id]').append("<option value=''>  -- 小分類を選択 --  </option>")
    
    jQuery.ajax({
      type: 'post',
      url: 'https://higashiyodogawa-database-matsum0623.c9users.io/ajax/get_med_categories.html',
      data: {'big_id': $('[name=big_id]').val()},
      dataType: 'json', 
      async: false,
      success: function(data){
        for(var i in data) {
          jQuery('[name=med_id]').append("<option value='" +data[i].med_id + "'>" + data[i].med_name +  "</option>");
        }
      },
      error: function(data){
        
      }
    });
  }
  function select_med_id(){
    jQuery('[name=sml_id]').children().remove();
    jQuery('[name=sml_id]').append("<option value=''>  -- 小分類を選択 --  </option>")
    jQuery.ajax({
      type: 'post',
      url: 'https://higashiyodogawa-database-matsum0623.c9users.io/ajax/get_sml_categories.html',
      data: {'big_id': $('[name=big_id]').val(), 'med_id': $('[name=med_id]').val(), },
      dataType: 'json', 
      async: false,
      success: function(data){
        for(var i in data) {
          jQuery('[name=sml_id]').append("<option value='" +data[i].sml_id + "'>" + data[i].sml_name +  "</option>");
        }
      }
    });
  }
  