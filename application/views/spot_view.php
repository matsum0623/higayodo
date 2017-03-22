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
        <a href="search.html">検索</a>　＞　<a href="<?php echo $back_link; ?>">検索結果一覧</a>　＞　<?php echo $spot->name; ?>
        <section class="spot_inner">
          <table class="spot_table">
            <tr>
              <th class="spot_table_header_top_left">名称</th>
              <td><?php echo $spot->name; ?>(<?php echo $spot->name_kana; ?>)</td>
            </tr>
            <tr>
              <th>エリア名</th>
              <td><?php echo $spot->area_name; ?></td>
            </tr>
            <tr>
              <th>分類</th>
              <td><?php echo $spot->big_name; ?>/<?php echo $spot->med_name; ?>/<?php echo $spot->sml_name; ?></td>
            </tr>
            <tr>
              <th>住所</th>
              <td><a href="https://maps.google.co.jp/maps/search/<?php echo $spot->address; ?>" target="_blank"><?php echo $spot->address; ?></a></td>
            </tr>
            <tr>
              <th>営業時間</th>
              <td><?php echo $spot->open_time; ?> - <?php echo $spot->close_time; ?></td>
            </tr>
            <tr>
              <th>定休日</th>
              <td><?php echo $spot->closed; ?></td>
            </tr>
            <tr>
              <th>HP</th>
              <td><a href="<?php echo $spot->url; ?>" target="_blank"><?php echo $spot->url; ?></a></td>
            </tr>
            <tr>
              <th></th>
              <td>
                <?php echo $spot->comment; ?>
              </td>
            </tr>
            <tr>
              <th>登録日時</th>
              <td><?php echo $spot->reg_time; ?></td>
            </tr>
            <tr>
              <th class="spot_table_header_bottom_left">最終更新</th>
              <td><?php echo $spot->upd_time; ?></td>
            </tr>
          </table>
        </section>
        <?php
          if($this->session->userdata("is_logged_in") == 1){
        ?>
        <section style="text-align:right;">
          <a href="spot/edit.html?id=<?php echo $spot->id; ?>" >データ修正</a>
        </section>
        <?php
          }
        ?>
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
