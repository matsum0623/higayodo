<?php
    require_once APPPATH."views/common_parts/_html_top.php";
?>
<body id="top">
<?php
    require_once APPPATH."views/common_parts/_header.php";
?>
  <div id="contents">
    <div class="inner">
      <div id="main">
<?php
    require_once APPPATH."views/special/".$id.".php"
?>
      </div><!--/main-->
<?php
    require_once APPPATH."views/common_parts/_sub.php";
    require_once APPPATH."views/common_parts/_footer.php";
?>
    </div><!--/inner-->
  </div><!--/contents-->
<?php
    require_once APPPATH."views/common_parts/_add_js.php";
?>
</body>
</html>
