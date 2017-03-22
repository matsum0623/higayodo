<?php
    require_once "admin_parts/_html_top.php";
?>
<body id="top">
<?php
    require_once "admin_parts/_header.php";
?>
<style>
  .spot_inner {
    border:solid 2px;
    border-radius:0px 0px 0px 0px;
  }
  .spot_table {
    text-align:left;
  }
  .spot_table input{
    text-align:left;
    width:95%;
    margin-left:5px;
  }
  .spot_table select{
    text-align:left;
    width:95%;
    margin-left:5px;
  }
</style>
  <div id="contents">
    <div class="inner">
      <div id="main">
        <a href="admin.html">管理トップ</a>　＞　<a href="admin/spot.html">スポット管理</a>　＞　新規施設登録
        <form action="admin/spot/regist.html" method="POST">
          <section class="spot_inner">
            <h3 style="margin-bottom:0px;">スポット編集</h3>
            <ul style="margin-left:15px">
              <li>ID：<input type="text" name="id" value=""/></li>
            </ul>
            <input type="button" value="検索"/>
            ※20170315 通常画面で更新できるので構築ストップ
          </section>
          <hr>
          <section class="spot_inner">
            <h3 style="margin-bottom:0px;">新規スポット登録</h3>
            <table class="spot_table">
              <tr>
                <th>名称</th>
                <td><input type="text" name="name" value="" /></td>
              </tr>
              <tr>
                <th>カナ名称</th>
                <td><input type="text" name="name_kana" value=""/></td>
              </tr>
              <tr>
                <th>エリア</th>
                <td>
                  <select name="area_id">
                    <?php
                      foreach ($areas as $row) {
                    ?>
                      <option value="<?php echo $row->area_id; ?>"><?php echo $row->area_name; ?></option>
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
                    <option value="00">  -- 大分類を選択 --  </option>
                    <?php
                      foreach ($categories_big as $row) {
                    ?>
                      <option value="<?php echo $row->big_id; ?>"><?php echo $row->big_name; ?></option>
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
                    <option value="00">  -- 中分類を選択 --  </option>
                    <?php
                      foreach ($categories_med as $row) {
                    ?>
                      <option value="<?php echo $row->med_id; ?>"><?php echo $row->med_name; ?></option>
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
                    <option value="00">  -- 小分類を選択 --  </option>
                    <?php
                      foreach ($categories_sml as $row) {
                    ?>
                      <option value="<?php echo $row->sml_id; ?>"><?php echo $row->sml_name; ?></option>
                    <?php
                      }
                    ?>
                  </select>
                </td>
              </tr>
              <tr>
                <th>住所</th>
                <td><input type="text" name="address" value=""/></td>
              </tr>
              <tr>
                <th>営業時間(開店)</th>
                <td><input type="text" name="open_time" value=""/></td>
              </tr>
              <tr>
                <th>営業時間(閉店)</th>
                <td><input type="text" name="close_time" value=""/></td>
              </tr>
              <tr>
                <th>定休日</th>
                <td><input type="text" name="closed" value="" /></td>
              </tr>
              <tr>
                <th>HP</th>
                <td><input type="text" name="url" value="" /></td>
              </tr>
              <tr>
                <th>コメント</th>
                <td>
                  <textarea name="comment" rows="20" cols="84%"></textarea>
                </td>
              </tr>
            </table>
          </section>
          <?php
            if($this->session->userdata("is_logged_in") == 1){
          ?>
          <input type="hidden" name="check" value="no"/>
          <input type="submit" value="確認"/>
          <?php
            }
          ?>
        </form>
      </div>
      <!--/main-->
<?php
    require_once "admin_parts/_sub.php";
    require_once "admin_parts/_footer.php";
?>
    </div>
    <!--/inner-->
  </div>
  <!--/contents-->
<?php
    require_once "admin_parts/_add_js.php";
?>
</body>
</html>
