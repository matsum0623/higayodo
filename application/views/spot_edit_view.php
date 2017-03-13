<?php
    require_once "common_parts/_html_top.php";
?>
<body id="top">
<?php
    require_once "common_parts/_header.php";
?>
<style>
  .spot_inner {
    border:solid 5px;
    border-radius: 10px;
  }
  .spot_table {
    text-align:center;
    width:100%;
  }
  .spot_table th{
    background-color: indianred;
    text-align:center;
    border-top : solid 1px;
    border-bottom : solid 1px;
  }

  .spot_table td{
    border-top:solid 1px;
    border-bottom : solid 1px;
    font-size: 16px;
/*    font-weight: bold;*/
    color: white;
    letter-spacing: 1px;
    padding: 2px 0px 2px 0px;
  }
  .spot_table_header {
    background-color: indianred;
  }
  .spot_table_header_top_left {
    border-top-left-radius: 5px;
  }
  .spot_table_header_bottom_left {
    border-bottom-left-radius: 5px;
  }

</style>
<script>
  function select_big_id(){
    jQuery('[name=med_id]').children().remove();
    jQuery('[name=med_id]').append("<option value=''>  -- 中分類を選択 --  </option>")
    jQuery('[name=sml_id]').children().remove();
    jQuery('[name=sml_id]').append("<option value=''>  -- 小分類を選択 --  </option>")
    
    jQuery.ajax({
      type: 'post',
      url: '<?php echo base_url(); ?>/ajax/get_med_categories.html',
      data: {'big_id': $('[name=big_id]').val()},
      dataType: 'json', 
      async: false,
      success: function(data){
        for(var i in data) {
          jQuery('[name=med_id]').append("<option value='" +data[i].med_id + "'>" + data[i].med_name +  "</option>");
        }
      }
    });
  }
  function select_med_id(){
    jQuery('[name=sml_id]').children().remove();
    jQuery('[name=sml_id]').append("<option value=''>  -- 小分類を選択 --  </option>")
    jQuery.ajax({
      type: 'post',
      url: '<?php echo base_url(); ?>/ajax/get_sml_categories.html',
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
  
  
</script>
  <div id="contents">
    <div class="inner">
      <div id="main">
        <a href="search.html">検索</a>　＞　<a href="">検索結果一覧</a>　＞　<a href=""><?php echo $spot->name; ?></a>　＞　編集
        <form action="spot/update.html" method="POST">
          <section class="spot_inner">
            <table class="spot_table">
              <tr>
                <th class="spot_table_header_top_left">スポットID</th>
                <td><?php echo $spot->id; ?></td>
              </tr>
              <tr>
                <th>名称</th>
                <td><input type="text" name="name" value="<?php echo $spot->name; ?>"/></td>
              </tr>
              <tr>
                <th>カナ名称</th>
                <td><input type="text" name="name_kana" value="<?php echo $spot->name_kana; ?>"/></td>
              </tr>
              <tr>
                <th>エリア</th>
                <td>
                  <select name="area_id">
                    <?php
                      foreach ($areas as $row) {
                    ?>
                      <option value="<?php echo $row->area_id; ?>" <?php if($row->area_id == $spot->area_id){ ?>selected="selected"<?php } ?>><?php echo $row->area_name; ?></option>
                    <?php
                      }
                    ?>
                  </select>
                </td>
              </tr>
              <tr>
                <th>大分類</th>
                <td>
                  <select name="big_id" onchange="select_big_id()">
                    <?php
                      foreach ($categories_big as $row) {
                    ?>
                      <option value="<?php echo $row->big_id; ?>" <?php if($row->big_id == $spot->big_id){ ?>selected="selected"<?php } ?>><?php echo $row->big_name; ?></option>
                    <?php
                      }
                    ?>
                  </select>
                </td>
              </tr>
              <tr>
                <th>中分類</th>
                <td>
                  <select name="med_id" onchange="select_med_id()">
                    <option value=""></option>
                    <?php
                      foreach ($categories_med as $row) {
                    ?>
                      <option value="<?php echo $row->med_id; ?>" <?php if($row->med_id == $spot->med_id){ ?>selected="selected"<?php } ?>><?php echo $row->med_name; ?></option>
                    <?php
                      }
                    ?>
                  </select>
                </td>
              </tr>
              <tr>
                <th>小分類</th>
                <td>
                  <select name="sml_id">
                    <option value=""></option>
                    <?php
                      foreach ($categories_sml as $row) {
                    ?>
                      <option value="<?php echo $row->sml_id; ?>" <?php if($row->sml_id == $spot->sml_id){ ?>selected="selected"<?php } ?>><?php echo $row->sml_name; ?></option>
                    <?php
                      }
                    ?>
                  </select>
                </td>
              </tr>
              <tr>
                <th>住所</th>
                <td><input type="text" name="address" value="<?php echo $spot->address; ?>"/></td>
              </tr>
              <tr>
                <th>営業時間(開店)</th>
                <td><input type="text" name="open_time" value="<?php echo $spot->open_time; ?>"/></td>
              </tr>
              <tr>
                <th>営業時間(閉店)</th>
                <td><input type="text" name="close_time" value="<?php echo $spot->close_time; ?>"/></td>
              </tr>
              <tr>
                <th>定休日</th>
                <td><input type="text" name="closed" value="<?php echo $spot->closed; ?>" /></td>
              </tr>
              <tr>
                <th class="spot_table_header_bottom_left">HP</th>
                <td><input type="text" name="url" value="<?php echo $spot->url; ?>" /></td>
              </tr>
            </table>
          </section>
          <?php
            if($this->session->userdata("is_logged_in") == 1){
          ?>
          <input type="hidden" name="id" value="<?php echo $spot->id; ?>"/>
          <input type="hidden" name="check" value="no"/>
          <input type="submit" value="確認"/>
          <?php
            }
          ?>
        </form>
      </div>
      <!--/main-->
<?php
    require_once "common_parts/_sub.php";
    require_once "common_parts/_footer.php";
?>
    </div>
    <!--/inner-->
  </div>
  <!--/contents-->
<?php
    require_once "common_parts/_add_js.php";
?>
</body>
</html>
