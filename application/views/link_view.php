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
          <h2>リンク一覧</h2>
          <ul style="margin-left:30px;">
            <?php
              foreach($links as $row){
            ?>
            <li><a href="<?php echo $row->link; ?>" target="_blank"><?php echo $row->name; ?></a> - <?php echo $row->comment; ?></li>
            <?php
              }
            ?>
          </ul>
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
