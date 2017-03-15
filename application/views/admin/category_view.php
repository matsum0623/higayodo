<?php
    require_once "admin_parts/_html_top.php";
?>
<body id="top">
<?php
    require_once "admin_parts/_header.php";
?>
<style>
  .category_table {
    width:100%;
    text-align:center;
  }
  .category_table input {
    width:90%;
  }
  .category_section {
    border:solid 2px;
  }
  .category_table th {
    background-color:indianred;
  }
  .category_table td {
    border: solid 1px;
    border-color:gray;
  }
  .category_regist_form {
    padding:5px;
  }
  .category_regist_form .input_id {
    width:32px;
  }
  .category_regist_form ul {
    margin-left:15px;
  }
</style>
<script>
  function get_big_name(){
    $.ajax({
      type: 'post',
      url: 'admin/category/get_big_name.html',
      data: {'big_id': $('[name=big_id]').val()},
      dataType: 'json', 
      async: false,
      success: function(data){
        $('[name=big_name]').val(data.big_name);
        if(data.check == 'conflict'){
          $('[name=big_name]').prop('disabled',true);
        }else{
          $('[name=big_name]').prop('disabled',false);
        }
        $('[name=med_id]').val('');
        $('[name=med_name]').val('');
        $('[name=med_name]').prop('disabled',false);
        $('[name=sml_id]').val('');
        $('[name=sml_name]').val('');
        $('[name=sml_name]').prop('disabled',false);
        $('#regist_submit').prop('disabled',false);
      }
    });
  }
  function get_med_name(){
    $.ajax({
      type: 'post',
      url: 'admin/category/get_med_name.html',
      data: {'big_id': $('[name=big_id]').val(),'med_id': $('[name=med_id]').val()},
      dataType: 'json', 
      async: false,
      success: function(data){
        $('[name=med_name]').val(data.med_name);
        if(data.check == 'conflict'){
          $('[name=med_name]').prop('disabled',true);
        }else{
          $('[name=med_name]').prop('disabled',false);
        }
        $('[name=sml_id]').val('');
        $('[name=sml_name]').val('');
        $('[name=sml_name]').prop('disabled',false);
        $('#regist_submit').prop('disabled',false);
      }
    });
  }
  function get_sml_name(){
    $.ajax({
      type: 'post',
      url: 'admin/category/get_sml_name.html',
      data: {
          'big_id': $('[name=big_id]').val(),
          'med_id': $('[name=med_id]').val(),
          'sml_id': $('[name=sml_id]').val()
      },
      dataType: 'json', 
      async: false,
      success: function(data){
        $('[name=sml_name]').val(data.sml_name);
        if(data.check == 'conflict'){
          $('[name=sml_name]').prop('disabled',true);
          $('#regist_submit').prop('disabled',true);
        }else{
          $('[name=sml_name]').prop('disabled',false);
          $('#regist_submit').prop('disabled',false);
        }
      }
    });
  }
  function show_category(flg){
    $('#category_big').hide();
    $('#category_med').hide();
    $('#category_sml').hide();
    $('#category_'+flg).show();
  }
  function update_category_big(big_id){
    const form = document.createElement("form");
    document.body.appendChild(form);
    const input1 = document.createElement("input");
    input1.setAttribute("type","hidden");
    input1.setAttribute("name","flg");
    input1.setAttribute("value","big");
    form.appendChild(input1);

    const input2 = document.createElement("input");
    input2.setAttribute("type","hidden");
    input2.setAttribute("name","big_id");
    input2.setAttribute("value",big_id);
    form.appendChild(input2);

    const input3 = document.createElement("input");
    input3.setAttribute("type","hidden");
    input3.setAttribute("name","big_name");
    input3.setAttribute("value",$('[name='+big_id+'big_name]').val());
    form.appendChild(input3);

    form.setAttribute("action","admin/category/update.html");
    form.setAttribute("method","POST");
    form.submit();
    
  }
  function update_category_med(med_id){
    const form = document.createElement("form");
    document.body.appendChild(form);
    const input1 = document.createElement("input");
    input1.setAttribute("type","hidden");
    input1.setAttribute("name","flg");
    input1.setAttribute("value","med");
    form.appendChild(input1);

    const input2 = document.createElement("input");
    input2.setAttribute("type","hidden");
    input2.setAttribute("name","big_id");
    input2.setAttribute("value",med_id.substring(0,2));
    form.appendChild(input2);

    const input3 = document.createElement("input");
    input3.setAttribute("type","hidden");
    input3.setAttribute("name","med_id");
    input3.setAttribute("value",med_id.substring(2,4));
    form.appendChild(input3);

    const input4 = document.createElement("input");
    input4.setAttribute("type","hidden");
    input4.setAttribute("name","med_name");
    input4.setAttribute("value",$('[name='+med_id+'med_name]').val());
    form.appendChild(input4);

    form.setAttribute("action","admin/category/update.html");
    form.setAttribute("method","POST");
    form.submit();
  }
  function update_category_sml(sml_id){
    const form = document.createElement("form");
    document.body.appendChild(form);
    const input1 = document.createElement("input");
    input1.setAttribute("type","hidden");
    input1.setAttribute("name","flg");
    input1.setAttribute("value","sml");
    form.appendChild(input1);

    const input2 = document.createElement("input");
    input2.setAttribute("type","hidden");
    input2.setAttribute("name","big_id");
    input2.setAttribute("value",sml_id.substring(0,2));
    form.appendChild(input2);

    const input3 = document.createElement("input");
    input3.setAttribute("type","hidden");
    input3.setAttribute("name","med_id");
    input3.setAttribute("value",sml_id.substring(2,4));
    form.appendChild(input3);

    const input4 = document.createElement("input");
    input4.setAttribute("type","hidden");
    input4.setAttribute("name","sml_id");
    input4.setAttribute("value",sml_id.substring(4,6));
    form.appendChild(input4);

    const input5 = document.createElement("input");
    input5.setAttribute("type","hidden");
    input5.setAttribute("name","sml_name");
    input5.setAttribute("value",$('[name='+sml_id+'sml_name]').val());
    form.appendChild(input5);

    form.setAttribute("action","admin/category/update.html");
    form.setAttribute("method","POST");
    form.submit();
    
  }
</script>
  <div id="contents">
    <div class="inner">
      <div id="main">
        <a href="admin.html">管理画面トップ</a>　＞　エリア管理
        <section class="category_section">
          <h3 style="margin-bottom: 0px;">新規分類登録</h3>
          <form action="admin/category/regist" method="POST" class="category_regist_form">
            <ul>
              <li>
                大分類ID：<input class="input_id" type="text" name="big_id" value=""
                  maxlength="2" pattern="^[0-9]+$" onchange="get_big_name();" required/>
                大分類名称：<input type="text" name="big_name" value=""/>
              </li>
            </ul>
            <ul>
              <li>
                中分類ID：<input class="input_id" type="text" name="med_id" value=""
                  maxlength="2" pattern="^[0-9]+$" onchange="get_med_name();" required/>
                中分類名称：<input type="text" name="med_name" value=""/>
              </li>
            </ul>
            <ul>
              <li>
                小分類ID：<input class="input_id" type="text" name="sml_id" value=""
                  maxlength="2" pattern="^[0-9]+$" onchange="get_sml_name();" required/>
                小分類名称：<input type="text" name="sml_name" value=""/>
              </li>
            </ul>
            <input id="regist_submit" type="submit" value="登録"/>
          </form>
        </section>
        <hr>
        <section class="category_section">
          <h3 style="margin-bottom: 0px;">
            分類編集 &nbsp;&nbsp;&nbsp;
            <input type="button" value="大分類編集" onclick="show_category('big');"/>
            <input type="button" value="中分類編集" onclick="show_category('med');"/>
            <input type="button" value="小分類編集" onclick="show_category('sml');"/>
          </h3>
          <table id="category_big" class="category_table" style="display:<?php echo $big_view; ?>">
            <tr>
              <th colspan="2">大分類</th>
              <th></th>
              <th></th>
            </tr>
            <tr>
              <th>CD</th>
              <th>名称</th>
              <th></th>
              <th></th>
            </tr>
            <?php
              foreach($categories_big as $row){
            ?>
              <tr>
                <td><?php echo $row->big_id; ?></td>
                <td><input type="text" name="<?php echo $row->big_id; ?>big_name" value="<?php echo $row->big_name; ?>" /></td>
                <td><input type="button" onclick="update_category_big('<?php echo $row->big_id; ?>');" value="更新" /></td>
                <td><input type="button" onclick="delete_category_big('<?php echo $row->big_id; ?>');" value="削除" /></td>
              </tr>
            <?php
              }
            ?>
          </table>
          <table id="category_med" class="category_table" style="display:<?php echo $med_view; ?>">
            <tr>
              <th colspan="2">大分類</th>
              <th colspan="2">中分類</th>
              <th></th>
              <th></th>
            </tr>
            <tr>
              <th>CD</th>
              <th>名称</th>
              <th>CD</th>
              <th>名称</th>
              <th></th>
              <th></th>
            </tr>
            <?php
              foreach($categories_med as $row){
            ?>
              <tr>
                <td><?php echo $row->big_id; ?></td>
                <td><?php echo $row->big_name; ?></td>
                <td><?php echo $row->med_id; ?></td>
                <td><input type="text" name="<?php echo $row->big_id.$row->med_id; ?>med_name" value="<?php echo $row->med_name; ?>" /></td>
                <td><input type="button" onclick="update_category_med('<?php echo $row->big_id.$row->med_id; ?>');" value="更新" /></td>
                <td><input type="button" onclick="delete_category_med('<?php echo $row->big_id.$row->med_id; ?>');" value="削除" /></td>
              </tr>
            <?php
              }
            ?>
          </table>
          <table id="category_sml" class="category_table" style="display:<?php echo $sml_view; ?>">
            <tr>
              <th colspan="2">大分類</th>
              <th colspan="2">中分類</th>
              <th colspan="2">小分類</th>
              <th></th>
              <th></th>
            </tr>
            <tr>
              <th>CD</th>
              <th>名称</th>
              <th>CD</th>
              <th>名称</th>
              <th>CD</th>
              <th>名称</th>
              <th></th>
              <th></th>
            </tr>
            <?php
              foreach($categories_sml as $row){
            ?>
              <tr>
                <td><?php echo $row->big_id; ?></td>
                <td><?php echo $row->big_name; ?></td>
                <td><?php echo $row->med_id; ?></td>
                <td><?php echo $row->med_name; ?></td>
                <td><?php echo $row->sml_id; ?></td>
                <td><input type="text" name="<?php echo $row->big_id.$row->med_id.$row->sml_id; ?>sml_name" value="<?php echo $row->sml_name; ?>" /></td>
                <td><input type="button" onclick="update_category_sml('<?php echo $row->big_id.$row->med_id.$row->sml_id; ?>');" value="更新" /></td>
                <td><input type="button" onclick="delete_category_sml('<?php echo $row->big_id.$row->med_id.$row->sml_id; ?>');" value="削除" /></td>
              </tr>
            <?php
              }
            ?>
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
