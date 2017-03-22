<?php
    require_once "admin_parts/_html_top.php";
?>
<body id="top">
<?php
    require_once "admin_parts/_header.php";
?>
<style>
  .area_table {
    width:100%;
    text-align:center;
  }
  .area_table input {
    width:90%;
  }
  .area_section {
    border:solid 2px;
  }
  .area_table th {
    background-color:indianred;
  }
  .area_table td {
    border: solid 1px;
    border-color:gray;
  }
</style>
<script>
  function update_area(area_id){
    const area_key  = $('[name='+area_id+'area_key]').val();
    const area_name = $('[name='+area_id+'area_name]').val();
    
    const form = document.createElement("form");
    document.body.appendChild(form);
    const input1 = document.createElement("input");
    input1.setAttribute("type","hidden");
    input1.setAttribute("name","area_id");
    input1.setAttribute("value",area_id);
    form.appendChild(input1);

    const input2 = document.createElement("input");
    input2.setAttribute("type","hidden");
    input2.setAttribute("name","area_key");
    input2.setAttribute("value",area_key);
    form.appendChild(input2);

    const input3 = document.createElement("input");
    input3.setAttribute("type","hidden");
    input3.setAttribute("name","area_name");
    input3.setAttribute("value",area_name);
    form.appendChild(input3);

    form.setAttribute("action","admin/area/update.html");
    form.setAttribute("method","POST");
    form.submit();
  }
  
  function delete_area(area_id){
    const form = document.createElement("form");
    document.body.appendChild(form);
    const input1 = document.createElement("input");
    input1.setAttribute("type","hidden");
    input1.setAttribute("name","area_id");
    input1.setAttribute("value",area_id);
    form.appendChild(input1);

    form.setAttribute("action","admin/area/delete.html");
    form.setAttribute("method","POST");
    form.submit();
  }
</script>
  <div id="contents">
    <div class="inner">
      <div id="main">
        <a href="admin.html">管理画面トップ</a>　＞　エリア管理
        <section class="area_section">
          <h3 style="margin-bottom:0px">エリア編集</h3>
          <table class="area_table">
            <tr>
              <th>エリアID</th>
              <th>エリアキー</th>
              <th>エリア名称</th>
              <th></th>
              <th></th>
            </tr>
            <?php
              foreach($areas as $row){
            ?>
              <tr>
                <td><?php echo $row->area_id; ?></td>
                <td><input type="text" name="<?php echo $row->area_id; ?>area_key" value="<?php echo $row->area_key; ?>" /></td>
                <td><input type="text" name="<?php echo $row->area_id; ?>area_name" value="<?php echo $row->area_name; ?>" /></td>
                <td><input type="button" onclick="update_area(<?php echo $row->area_id; ?>);" value="更新" /></td>
                <td><input type="button" onclick="delete_area(<?php echo $row->area_id; ?>);" value="削除" /></td>
              </tr>
            <?php
              }
            ?>
              <tr>
                <form action="admin/area/regist" method="POST">
                  <td>新規エリア</td>
                  <td><input type="text" name="area_key" value="" /></td>
                  <td><input type="text" name="area_name" value="" /></td>
                  <td><input type="submit" value="追加" /></td>
                </form>
              </tr>
          </table>
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
