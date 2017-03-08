<?php
    require_once "common_parts/_html_top.php";
?>
<body id="top">
<?php
    require_once "common_parts/_header.php";
?>
  <div id="contents">
    <div class="inner">
      <div id="main">
<style>
  .search_inner {
    background-color:#FFA0A0;
    border:solid 5px;
    border-radius: 10px;
    text-align: center;
  }
  
  .search_result {
    width: 100%;
  }
</style>
<script>
  function select_big_id(){
    jQuery('[name=category_med]').children().remove();
    jQuery('[name=category_med]').append("<option value=''>-- カテゴリを選択してください --</option>")
    jQuery('[name=category_sml]').children().remove();
    jQuery('[name=category_sml]').append("<option value=''>-- カテゴリを選択してください --</option>")
    
    jQuery.ajax({
      type: 'post',
      url: '<?php echo base_url(); ?>/ajax/get_med_categories.html',
      data: {'big_id': $('[name=category_big]').val()},
      dataType: 'json', 
      async: false,
      success: function(data){
        for(var i in data) {
          jQuery('[name=category_med]').append("<option value='" +data[i].med_id + "'>" + data[i].med_name +  "</option>");
        }
      }
    });
  }
  function select_med_id(){
    jQuery('[name=category_sml]').children().remove();
    jQuery('[name=category_sml]').append("<option value=''>-- カテゴリを選択してください --</option>")
    jQuery.ajax({
      type: 'post',
      url: '<?php echo base_url(); ?>/ajax/get_sml_categories.html',
      data: {'big_id': $('[name=category_big]').val(), 'med_id': $('[name=category_med]').val(), },
      dataType: 'json', 
      async: false,
      success: function(data){
        for(var i in data) {
          jQuery('[name=category_sml]').append("<option value='" +data[i].sml_id + "'>" + data[i].sml_name +  "</option>");
        }
      }
    });
  }
  
  
</script>
        <section class="search_inner">
          <form action="search.html" method="GET" name="search">
            <table>
              <tr>
                <th>エリア</th>
                <td>
                  <select name="area">
                    <option value="">-- エリアを選択してください --</option>
                    <?php
                      foreach($areas as $row){
                    ?>
                    <option value="<?php echo $row->area_key; ?>" <?php if($row->area_key == $area){ ?>selected<?php } ?>><?php echo $row->area_name; ?></option>
                    <?php
                      }
                    ?>
                  </select>
                </td>
              </tr>
              <tr>
                <th rowspan="3">カテゴリ</th>
                <td>
                  <select name="category_big" onchange="select_big_id()">
                    <option value="">-- カテゴリを選択してください --</option>
                    <?php
                      foreach($categories_big as $row){
                    ?>
                    <option value="<?php echo $row->big_id; ?>" <?php if($row->big_id == $category_big){ ?>selected<?php } ?>><?php echo $row->big_name; ?></option>
                    <?php
                      }
                    ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td>
                  <select name="category_med" onchange="select_med_id()">
                    <option value="">-- カテゴリを選択してください --</option>
                    <?php
                      if($categories_med <> ""){
                        foreach($categories_med as $row){
                    ?>
                      <option value="<?php echo $row->med_id; ?>" <?php if($row->med_id == $category_med){ ?>selected<?php } ?>><?php echo $row->med_name; ?></option>
                    <?php
                        }
                      }
                    ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td>
                  <select name="category_sml">
                    <option value="">-- カテゴリを選択してください --</option>
                    <?php
                      if($categories_sml <> ""){
                        foreach($categories_sml as $row){
                    ?>
                      <option value="<?php echo $row->sml_id; ?>" <?php if($row->sml_id == $category_sml){ ?>selected<?php } ?>><?php echo $row->sml_name; ?></option>
                    <?php
                        }
                      }
                    ?>
                  </select>
                </td>
              </tr>
<?php
/*
              <tr>
                ?>
                <th>こだわり検索</th>
                <td>
                <?php
                    foreach($likes as $key => $val){
                ?>
                  <label><input type="checkbox" name="like[]" value="<?php echo $key; ?>" <?php if(in_array($key,$like)){ ?>checked<?php } ?>><?php echo $val; ?></label>
                <?php
                    }
                ?>
                </td>
              </tr>
*/
?>
              <tr>
                <th>フリーワード</th>
                <td>
                  <input type="text" value="<?php echo $free_word; ?>" name="free_word" placeholder="フリーワードで検索"/>
                  ※半角スペース区切りでOR検索が可能です。
                </td>
              </tr>
              <tr>
               <td colspan="2" >
                 <input type="submit" value="検索" />
               </td>
              </tr>
            </table>
          </form>
        </section>
        <section class="search_inner">
          <table class="search_result">
            <tr>
              <th>エリア</th>
              <th>分類</th>
              <th>スポット名称</th>
              <th></th>
            </tr>
            <?php
                foreach($result as $row){
            ?>
            <tr>
              <td><?php echo $row->area_name; ?></td>
              <td><?php echo $row->big_name; ?>/<?php echo $row->med_name; ?>/<?php echo $row->sml_name; ?></td>
              <td><?php echo $row->name; ?></td>
              <td><a href="">詳細</a></td>
            </tr>
            <?php
                }
            ?>
          </table>
          <?php echo $this->pagination->create_links(); ?>
        </section>
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
