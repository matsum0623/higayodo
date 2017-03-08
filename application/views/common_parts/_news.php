<section id="new" style="border:solid;">
  <h2 id="newinfo_hdr" class="close" style="border-radius:0px;">新着情報</h2>
  <dl id="newinfo">
  <?php
      $now = new DateTime();
      foreach($news as $row){
        $day = new DateTime($row->ins_date);
        $interval = $now->diff($day);
  ?>
    <dt><?php echo substr($row->ins_date,0,10); ?></dt>
    <dd>
        <?php
            echo $row->text;
            if($interval->format('%a') <= 5){
        ?>
        <span class="newicon">NEW</span>
        <?php
            }
        ?>
    </dd>
  <?php
      }
  ?>
  </dl>
</section>