<header>
  <div class="inner">
    <h1 id="logo">
      <a href="home.html" style="text-decoration:none;">
        <h2>東淀川データベース</h1>
      </a>
    </h1>
    <!--PC用（571px以上端末）メニュー-->
    <nav id="menubar">
      <ul>
        <li <?php if($page == "home"){     ?>class="current"<?php } ?>><a href="home.html"     >HOME</a></li>
        <li <?php if($page == "search"){   ?>class="current"<?php } ?>><a href="search.html"   >SEARCH</a></li>
        <li <?php if($page == "bulletin"){ ?>class="current"<?php } ?>><a href="bulletin.html" >BBS</a></li>
        <li <?php if($page == "link"){     ?>class="current"<?php } ?>><a href="link.html"     >LINK</a></li>
      </ul>
    </nav>
    <!--小さな端末用（※570px以下端末）メニュー-->
    <nav id="menubar-s">
      <ul>
        <li <?php if($page == "home"){     ?>class="current"<?php } ?>><a href="home.html"     >HOME</a></li>
        <li <?php if($page == "search"){   ?>class="current"<?php } ?>><a href="search.html"   >SEARCH</a></li>
        <li <?php if($page == "bulletin"){ ?>class="current"<?php } ?>><a href="bulletin.html" >BBS</a></li>
        <li <?php if($page == "link"){     ?>class="current"<?php } ?>><a href="link.html"     >LINK</a></li>
      </ul>
    </nav>
  </div>
  <!--/inner-->
</header>

