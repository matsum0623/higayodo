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
        <section>
          <h2>東淀川区地域情報データベース</h2>
          <h3>What's 東淀川データベース</h3>
          <p>
            このサイトは上新庄、相川、井高野を中心に、東淀川区内の医療施設、飲食店などの情報をまとめたデータベースです。<br>
            季節ごとに特集ページの作成も計画しています。<br>
            <br>
            生活圏を基本的なまとまりで考えているので、一部、淀川区、摂津市、吹田市の情報も登録されています。
            
          <h3>掲載内容について</h3>
          <p>
            ネットでの情報収集を中心に、実際に現地にて確認した情報を随時追加していきます。<br>
            掲載内容について、削除・修正などは<a href="mailto:<?php echo ADMIN_MAIL_ADDRESS; ?>"><strong>こちら</strong></a>からお願いします。
          </p>
        </section>
<?php
    require_once "common_parts/_news.php";
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
