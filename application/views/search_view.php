<?php
    require_once "common_parts/_html_top.php";
?>
<body id="top">
<?php
    require_once "common_parts/_header.php";
?>
<style>
  .pagenation {
    text-align:center;
  }
  .pagenation strong{
    margin-left:5px;
    margin-right:5px;
  }
  .pagenation a{
    margin-left:5px;
    margin-right:5px;
  }
</style>
  <div id="contents">
    <div class="inner">
      <div id="main">
        <a href="search.html">検索</a>　＞　検索結果一覧
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
                  <select name="big_id" onchange="select_big_id()">
                    <option value="">  -- 大分類を選択 --  </option>
                    <?php
                      foreach($categories_big as $row){
                    ?>
                    <option value="<?php echo $row->big_id; ?>" <?php if($row->big_id == $big_id){ ?>selected<?php } ?>><?php echo $row->big_name; ?></option>
                    <?php
                      }
                    ?>
                  </select>
                  <select name="med_id" onchange="select_med_id()">
                    <option value="">  -- 中分類を選択 --  </option>
                    <?php
                      if($categories_med <> ""){
                        foreach($categories_med as $row){
                    ?>
                      <option value="<?php echo $row->med_id; ?>" <?php if($row->med_id == $med_id){ ?>selected<?php } ?>><?php echo $row->med_name; ?></option>
                    <?php
                        }
                      }
                    ?>
                  </select>
                  <select name="sml_id">
                    <option value="">  -- 小分類を選択 --  </option>
                    <?php
                      if($categories_sml <> ""){
                        foreach($categories_sml as $row){
                    ?>
                      <option value="<?php echo $row->sml_id; ?>" <?php if($row->sml_id == $sml_id){ ?>selected<?php } ?>><?php echo $row->sml_name; ?></option>
                    <?php
                        }
                      }
                    ?>
                  </select>
                </td>
              </tr>
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
                  $spot_link .= "&big_id={$big_id}";
                  $spot_link .= "&med_id={$med_id}";
                  $spot_link .= "&sml_id={$sml_id}";
                  $spot_link .= "&free_word={$free_word}";
                  $spot_link .= "&page_num={$page_num}";
            ?>
            <tr>
              <td><?php echo $row->area_name; ?></td>
              <td><?php echo $row->big_name; ?><?php echo $row->med_name <> '' ? '/'.$row->med_name : ''; ?><?php echo $row->sml_name <> '' ? '/'.$row->sml_name : ''; ?></td>
              <td><?php echo $row->name; ?></td>
              <td><a href="<?php echo $spot_link; ?>" target="_blank">詳細</a></td>
            </tr>
            <?php
                }
            ?>
          </table>
          <div class="pagenation">
            <?php echo $this->pagination->create_links(); ?>
          </div>
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
