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
        <a href="search.html">検索</a>　＞　<a href="">検索結果一覧</a>　＞　<a href=""><?php echo $name; ?></a>　＞　更新内容確認
        <form action="spot/update.html" method="POST">
          <p>以下の内容で更新します。</p>
          <section class="spot_inner">
            <table class="spot_table">
              <tr>
                <th class="spot_table_header_top_left">スポットID</th>
                <td><?php echo $id; ?></td>
              </tr>
              <tr>
                <th>名称</th>
                <td><?php echo $name; ?></td>
              </tr>
              <tr>
                <th>カナ名称</th>
                <td><?php echo $name_kana; ?></td>
              </tr>
              <tr>
                <th>エリア</th>
                <td>
                  <?php echo $area_name; ?>
                </td>
              </tr>
              <tr>
                <th>大分類</th>
                <td>
                  <?php echo $big_name; ?>
                </td>
              </tr>
              <tr>
                <th>中分類</th>
                <td>
                  <?php echo $med_name; ?>
                </td>
              </tr>
              <tr>
                <th>小分類</th>
                <td>
                  <?php echo $sml_name; ?>
                </td>
              </tr>
              <tr>
                <th>住所</th>
                <td><?php echo $address; ?></td>
              </tr>
              <tr>
                <th>営業時間(開店)</th>
                <td><?php echo $open_time; ?></td>
              </tr>
              <tr>
                <th>営業時間(閉店)</th>
                <td><?php echo $close_time; ?></td>
              </tr>
              <tr>
                <th>定休日</th>
                <td><?php echo $closed; ?></td>
              </tr>
              <tr>
                <th class="spot_table_header_bottom_left">HP</th>
                <td><?php echo $url; ?></td>
              </tr>
            </table>
          </section>
          <?php
            if($this->session->userdata("is_logged_in") == 1){
          ?>
          <input type="hidden" name="id" value="<?php echo $id; ?>"/>
          <input type="hidden" name="name" value="<?php echo $name; ?>"/>
          <input type="hidden" name="name_kana" value="<?php echo $name_kana; ?>"/>
          <input type="hidden" name="area_id" value="<?php echo $area_id; ?>"/>
          <input type="hidden" name="big_id" value="<?php echo $big_id; ?>"/>
          <input type="hidden" name="med_id" value="<?php echo $med_id; ?>"/>
          <input type="hidden" name="sml_id" value="<?php echo $sml_id; ?>"/>
          <input type="hidden" name="address" value="<?php echo $address; ?>"/>
          <input type="hidden" name="open_time" value="<?php echo $open_time; ?>"/>
          <input type="hidden" name="close_time" value="<?php echo $close_time; ?>"/>
          <input type="hidden" name="closed" value="<?php echo $closed; ?>"/>
          <input type="hidden" name="url" value="<?php echo $url; ?>"/>
          <input type="hidden" name="check" value="yes"/>
          <input type="submit" value="更新"/>
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
