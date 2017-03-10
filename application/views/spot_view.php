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
              <td><?php echo $spot->address; ?></td>
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
              <th class="spot_table_header_bottom_left">HP</th>
              <td><?php echo $spot->url; ?></td>
            </tr>
          </table>
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
