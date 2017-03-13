<?php
    require_once "common_parts/_html_top.php";
?>
<body id="top">
  <div id="contents">
    <div class="inner">
      <div id="main">
        <section>
          <?php
            echo form_open();	//フォームを開く
            
            echo validation_errors();
            
            echo '<p>ユーザー：' . form_input(array('name' => 'user_name', 'required' => 'required', 'value'=>$this->input->post("user_name"))) . '</p>';	//Emailの入力フィールドを出力

            echo '<p>パスワード：' . form_password(array('name' => 'password', 'required' => 'required')) . '</p>';	//パスワードの入力フィールドを出力

            echo '<p>' . form_submit("login_submit", "Login") . '</p>';	//ユーザー登録ボタンを出力

            echo form_close();	//フォームを閉じる
          ?>
        </section>
      </div>
      <!--/main-->
<?php
    require_once "common_parts/_footer.php";
?>
    </div>
    <!--/inner-->
  </div>
  <!--/contents-->
</body>
</html>
