<div id="pclicks-settings" class="wrap">
  <h3> 
    <img src='<?php echo PCLICKS_PLUGIN_URL . "/images/pclicks_small.png" ?>'/>
  </h3>

  <?php if ( $msg ) echo $msg; ?>

  <form action="" method="post">
    <div class="postbox-container">        
      <div class="metabox-holder">
        <div class="meta-box-sortables">        
          <div id="settings" class="postbox">
            <h3 class="handle">
              Settings
            </h3>
            <div class="inside">
              <input type="hidden" name="submitted" value="true"></input>

              <div class="entry">
                <div class="pcidinput">
                  <label for="<?php echo PCLICKS_PCID_OPTION; ?>"><strong>PCID:</strong></label>
                  <input name="<?php echo PCLICKS_PCID_OPTION; ?>" type="text" value="<?php echo $currentPcid; ?>" class="input-text"></input>
                </div>
                <div class="pcidinput">
                  <small>
                    <a href="#" class="toggle-explanation">What's this?</a>
                  </small>

                  <div class="explanation">
                    <strong>PCID</strong>
                    <p>
                      PCIDs are unique identifiers for each PClicks profile that are used to track your webpage.In order to retrieve it, follow these steps:
                    </p>
                    <ol>
                      <li>Log into <a href="https://www.pclicks.com">https://www.pclicks.com</a>.</li>
                      <li>You should see a list of all your PClicks profiles; go to your website profile's "Setup" page.</li>
                      <li>At the setup screen you will see your profile's PCID listed right below your profile name.</li>
                    </ol>
                  </div>
                </div>
              </div>
              
              <div class="entry">
                <div class="pcidinput">
                  <label for="<?php echo PCLICKS_KEY_OPTION; ?>"><strong>API Key:</strong></label>
                  <input name="<?php echo PCLICKS_KEY_OPTION; ?>" type="text" value="<?php echo $currentKey; ?>" class="input-text api-key"></input>
                </div>
                <div class="pcidinput">
                  <small>
                    <a href="#" class="toggle-explanation">What's this?</a>
                  </small>
                  <div class="explanation">
                    <strong>API Key</strong>
                    <p>
                      In order to access our API you need to generate a key; this key will be linked to your account and will be necessary for any request you initiate with our services. This is what you need to do:
                    </p>
                    <ol>
                      <li>Log into <a href="https://www.pclicks.com">https://www.pclicks.com</a>.</li>
                      <li>Click on "my account" link, it is at the top of the page, on the right side of your login name.</li>
                      <li>Click on "API Key" link.</li>
                      <li>If you haven't created your key, click on the "generate key" button. The key will show up.</li>
                      <li>Copy and paste the key to the above field.</li>
                    </ol>
                  </div>
                </div>
              </div>
              
              <div class="entry">
                <div class="pcidinput">
                  <label for="<?php echo PCLICKS_MINUTES_OPTION; ?>"><strong>Time: </strong></label>
                  <select name="<?php echo PCLICKS_MINUTES_OPTION; ?>" id="pclicks-minutes" class="input-text">
                    <?php
                    foreach ( $PCLICKS_TIMES_OPTS as $key => $value ) {
                      if ($key == PClicks_Plugin::get_minutes())
                        echo "<option value='$key' selected='selected'>$value</option>";
                      else
                        echo "<option value='$key'>$value</option>";
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div> <!-- end div.inside -->
          </div><!-- end div#settings -->
        </div><!-- end div.meta-box-sortables -->
      </div><!-- end div.metabox-holder -->
    </div> <!-- end div.postbox-container -->  
    
    <input type="submit" class="button-primary"value="Update Settings &raquo;"></input>
  </form>
</div> <!-- end div.wrap -->

<div class="clear"></div>