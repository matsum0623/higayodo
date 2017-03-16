<?php
    require_once "admin_parts/_html_top.php";
?>
<body id="top">
<?php
    require_once "admin_parts/_header.php";
?>
<style>
  .link_section {
    border:solid 2px;
  }
  .link_table {
    width:100%;
    text-align:center;
  }
  .link_table th{
    width:20%;
  }
  .link_table .list{
    border-top :solid 2px;
  }
  .link_id {
    width:30px;
  }
  .link_text {
    width:500px;
  }
  .td_button {
    width:30px;
    text-align:center;
  }
</style>
<script>
  function update_link(id){
    const form = document.createElement("form");
    document.body.appendChild(form);
    const input1 = document.createElement("input");
    input1.setAttribute("type","hidden");
    input1.setAttribute("name","id");
    input1.setAttribute("value",id);
    form.appendChild(input1);

    const input2 = document.createElement("input");
    input2.setAttribute("type","hidden");
    input2.setAttribute("name","seq");
    input2.setAttribute("value",$('[name='+id+'seq]').val());
    form.appendChild(input2);

    const input3 = document.createElement("input");
    input3.setAttribute("type","hidden");
    input3.setAttribute("name","name");
    input3.setAttribute("value",$('[name='+id+'name]').val());
    form.appendChild(input3);

    const input4 = document.createElement("input");
    input4.setAttribute("type","hidden");
    input4.setAttribute("name","link");
    input4.setAttribute("value",$('[name='+id+'link]').val());
    form.appendChild(input4);

    const input5 = document.createElement("input");
    input5.setAttribute("type","hidden");
    input5.setAttribute("name","comment");
    input5.setAttribute("value",$('[name='+id+'comment]').val());
    form.appendChild(input5);

    form.setAttribute("action","admin/link/update.html");
    form.setAttribute("method","POST");
    form.submit();
  }
  function delete_link(id){
    const form = document.createElement("form");
    document.body.appendChild(form);
    const input1 = document.createElement("input");
    input1.setAttribute("type","hidden");
    input1.setAttribute("name","id");
    input1.setAttribute("value",id);
    form.appendChild(input1);

    form.setAttribute("action","admin/link/delete.html");
    form.setAttribute("method","POST");
    form.submit();
  }
  
</script>
  <div id="contents">
    <div class="inner">
      <div id="main">
        <?php
          if($message <> ''){
        ?>
        <p style="color:red;font-weight:bold;font-size:large;">※<?php echo $message; ?></p>
        <?php
          }
        ?>
        <section class="link_section">
          <h3 style="margin-bottom:0px;">リンク新規登録</h3>
          <form action="admin/link/regist" method="POST">
            <table class="link_table">
              <tr>
                <th>並び順</th>
                <td><input type="text" name="seq" value="" style="width:90%;margin:5px;" maxlength="4" required/></td>
              </tr>
              <tr>
                <th>名称</th>
                <td><input type="text" name="name" value="" style="width:90%;margin:5px;" maxlength="200" required/></td>
              </tr>
              <tr>
                <th>リンクURL</th>
                <td><input type="url" name="link" value="" style="width:90%;margin:5px;" maxlength="200" required/></td>
              </tr>
              <tr>
                <th>コメント</th>
                <td><input type="text" name="comment" value="" style="width:90%;margin:5px;" maxlength="200" required/></td>
              </tr>
              <tr>
                <td colspan="2"><input type="submit" value="登録" /></td>
              </tr>
            </table>
          </form>
        </section>
        <hr>
        <section class="link_section">
          <h3 style="margin-bottom:0px;">リンク一覧</h3>
          <table class="link_table">
            <tr>
              <th>ID</th>
              <th>並び順</th>
              <th>名称/リンクURL/コメント</th>
              <th></th>
              <th></th>
            </tr>
            <?php
              foreach($links as $row){
            ?>
              <tr class="list">
                <td rowspan="3">
                  <?php echo $row->id; ?>
                </td>
                <td rowspan="3">
                  <input class="link_id" type="text" name="<?php echo $row->id; ?>seq" value="<?php echo $row->seq; ?>" />
                </td>
                <td>
                  <input class="link_text" type="text" name="<?php echo $row->id; ?>name" value="<?php echo $row->name; ?>" />
                </td>
                <td rowspan="3" class="td_button">
                  <input type="button" onclick="update_link(<?php echo $row->id; ?>);" value="更新" />
                </td>
                <td rowspan="3" class="td_button">
                  <input type="button" onclick="delete_link(<?php echo $row->id; ?>);"<?php if($row->del_time <> '0000-00-00 00:00:00'){ ?>disabled<?php } ?> value="削除" />
                </td>
              </tr>
              <tr>
                <td>
                  <input class="link_text" type="text" name="<?php echo $row->id; ?>link" value="<?php echo $row->link; ?>" />
                </td>
              </tr>
              <tr>
                <td>
                  <input class="link_text" type="text" name="<?php echo $row->id; ?>comment" value="<?php echo $row->comment; ?>" />
                </td>
              </tr>
            <?php
              }
            ?>
          </table>
          <div class="pagenation">
            <?php // echo $this->pagination->create_links(); ?>
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
