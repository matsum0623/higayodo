<?php
    require_once "admin_parts/_html_top.php";
?>
<body id="top">
<?php
    require_once "admin_parts/_header.php";
?>
<style>
  .news_table {
    width:100%;
    text-align:center;
  }
  .news_table input {
    width:90%;
  }
  .news_section {
    border:solid 2px;
  }
  .news_table th {
    background-color:indianred;
  }
  .news_table td {
    border: solid 1px;
    border-color:gray;
  }

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
<script>
  function update_news(id){
    const form = document.createElement("form");
    document.body.appendChild(form);
    const input1 = document.createElement("input");
    input1.setAttribute("type","hidden");
    input1.setAttribute("name","id");
    input1.setAttribute("value",id);
    form.appendChild(input1);

    const input2 = document.createElement("input");
    input2.setAttribute("type","hidden");
    input2.setAttribute("name","text");
    input2.setAttribute("value",$('[name='+id+'text]').val());
    form.appendChild(input2);

    form.setAttribute("action","admin/news/update.html");
    form.setAttribute("method","POST");
    form.submit();
  }
  function delete_news(id){
    const form = document.createElement("form");
    document.body.appendChild(form);
    const input1 = document.createElement("input");
    input1.setAttribute("type","hidden");
    input1.setAttribute("name","id");
    input1.setAttribute("value",id);
    form.appendChild(input1);

    form.setAttribute("action","admin/news/delete.html");
    form.setAttribute("method","POST");
    form.submit();
  }

</script>
  <div id="contents">
    <div class="inner">
      <div id="main">
        <a href="admin.html">管理画面トップ</a>　＞　新着情報管理
        <section class="news_section">
          <h3 style="margin-bottom:0px">新着情報登録</h3>
          <form action="admin/news/regist" method="POST">
            <input type="text" name="text" value="" style="width:70%;margin:5px;" maxlength="200"/>
            <input type="submit" value="登録" />
          </form>
        </section>
        <hr>
        <section class="news_section">
          <h3 style="margin-bottom:0px;">新着情報一覧</h3>
          <table class="news_table">
            <tr>
              <th>登録日</th>
              <th>更新日</th>
              <th>削除日</th>
              <th>内容</th>
              <th></th>
              <th></th>
            </tr>
            <?php
              foreach($news as $row){
            ?>
              <tr>
                <td><?php echo substr($row->ins_date,0,10); ?></td>
                <td><?php echo substr($row->upd_date,0,10); ?></td>
                <td><?php echo substr($row->del_date,0,10); ?></td>
                <td><input type="text" name="<?php echo $row->id; ?>text" value="<?php echo $row->text; ?>" /></td>
                <td style="width:45px;"><input type="button" onclick="update_news(<?php echo $row->id; ?>);" value="更新"/></td>
                <td style="width:45px;"><input type="button" onclick="delete_news(<?php echo $row->id; ?>);" value="削除" <?php if($row->view_flg <> '1'){?>disabled<?php } ?>/></td>
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
