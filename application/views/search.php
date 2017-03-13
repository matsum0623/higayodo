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
    border:solid 5px;
    border-radius: 10px;
  }
  
  .search_result {
    width: 100%;
  }
  
  .search_form_table {
    width:100%;
  }
  .search_form_table th{
    width:30%;
    padding-top:5px;
    padding-bottom: 5px;
    text-align: center;
  }
  .search_form_table td{
    width:70%;
  }
  
  .search_form_table select {
    height:25px;
  }

  .search_button {
    width:175px;
    height: 30px;
    border-radius:15px;
    background-color:ivory;
  }
  
  .search_result {
    text-align:center;
  }
  
  .search_result td{
    border-top:solid 1px;
    font-size: 16px;
/*    font-weight: bold;*/
    color: white;
    letter-spacing: 1px;
    padding: 2px 0px 2px 0px;
  }
  
  .search_result_header {
    background-color: indianred;
  }
  .search_result_header_left {
    border-top-left-radius: 5px;
  }
  .search_result_header_right {
    border-top-right-radius: 5px;
  }
</style>
<script>
  function select_big_id(){
    jQuery('[name=category_med]').children().remove();
    jQuery('[name=category_med]').append("<option value=''>  -- 中分類を選択 --  </option>")
    jQuery('[name=category_sml]').children().remove();
    jQuery('[name=category_sml]').append("<option value=''>  -- 小分類を選択 --  </option>")
    
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
    jQuery('[name=category_sml]').append("<option value=''>  -- 小分類を選択 --  </option>")
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
            <table class="search_form_table">
              <tr>
                <th>エリア</th>
                <td>
                  <select name="area_id">
                    <option value="">  -- エリアを選択 --  </option>
                    <?php
                      foreach($areas as $row){
                    ?>
                    <option value="<?php echo $row->area_id; ?>" <?php if($row->area_id == $area_id){ ?>selected<?php } ?>><?php echo $row->area_name; ?></option>
                    <?php
                      }
                    ?>
                  </select>
                </td>
              </tr>
              <tr>
                <th>カテゴリ</th>
                <td>
                  <select name="category_big" onchange="select_big_id()">
                    <option value="">  -- 大分類を選択 --  </option>
                    <?php
                      foreach($categories_big as $row){
                    ?>
                    <option value="<?php echo $row->big_id; ?>" <?php if($row->big_id == $category_big){ ?>selected<?php } ?>><?php echo $row->big_name; ?></option>
                    <?php
                      }
                    ?>
                  </select>
                  <select name="category_med" onchange="select_med_id()">
                    <option value="">  -- 中分類を選択 --  </option>
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
                  <select name="category_sml">
                    <option value="">  -- 小分類を選択 --  </option>
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
                  <span style="font-size:x-small">
                    ※半角スペース区切りでOR検索が可能です。
                  </span>
                </td>
              </tr>
              <tr>
                <th colspan="2">
                  <input type="submit" class="search_button" value="検索" />
                </th>
              </tr>
            </table>
            <div class="">
            </div>
          </form>
        </section>
        <section class="search_inner">
          <table class="search_result">
            <tr class="search_result_header">
              <th class="search_result_header_left">エリア</th>
              <th>分類</th>
              <th>スポット名称</th>
              <th class="search_result_header_right"></th>
            </tr>
            <?php
                foreach($result as $row){
                  $spot_link  = "spot.html?id={$row->id}";
                  $spot_link .= "&area_id={$area_id}";
                  $spot_link .= "&category_big={$category_big}";
                  $spot_link .= "&category_med={$category_med}";
                  $spot_link .= "&category_sml={$category_sml}";
                  $spot_link .= "&free_word={$free_word}";
                  $spot_link .= "&page_num={$page_num}";
            ?>
            <tr>
              <td><?php echo $row->area_name; ?></td>
              <td><?php echo $row->big_name; ?>/<?php echo $row->med_name; ?>/<?php echo $row->sml_name; ?></td>
              <td><?php echo $row->name; ?></td>
              <td><a href="<?php echo $spot_link; ?>">詳細</a></td>
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
