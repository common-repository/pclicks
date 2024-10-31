<?php ?>
<div class="inside">
  <div class="table table_content">
    <?php
    if (!PClicks_Plugin::is_apikey_set()) {
    ?>
      <p>You need to <a href='options-general.php?page=pclicks'>set your API Key</a>.</p>
    <?php
    } else {
    ?>
      <div class="pclicks-float-right">
        <span>
          <?php
          if ($link_info && $link_info["link"]) {
          ?>  
            <a target="_blank" href="<?php echo PClicks_Plugin::get_redirect_uri('/private/{_uid}/profiles/{_pname}/link?time=' . PClicks_Plugin::get_minutes() . '&uid='. $link_info['link']['uid']);?>">View this link in PClicks<a/>
          <?php
          }
          ?>
        </span>
      </div>
      <div>
        <p class="sub pclicks-sub">
        <?php
        if ($link_info && $link_info["link"]) {
        ?>
          <span class="number"><?php echo $link_info['link']['clicks']; ?></span>
          <span class="label">Clicks in this link</span>
        <?php
        } else {
          echo "<span class='label'>Link not found in PClicks</span>";
        }
        ?>
        </p>
      </div>
    <?php 
    }
    ?>
  </div>
</div>