<?php ?>
<script type="text/javascript" charset="utf-8">
  window.onload = function() {
    var container = null;
    
    function _waitForDomReady() {
      setTimeout(function() { 
        container = document.getElementById("clicks-historical");
        if (!container) {
          _waitForDomReady();
          return;
        }
        
        _printGraph();
      }, 100)
    }
    
    function _printGraph() {
      var chart = new Highcharts.Chart({
        chart: {
          renderTo: 'clicks-historical',
          defaultSeriesType: 'line',
          marginRight: 130,
          marginBottom: 60
        },
        credits: {
          enabled: false
        },
        title: {
          text: 'Clicks Over Time',
          x: -20 //center
        },
        subtitle: {
          text: 'Source: www.pclicks.com',
          x: -20
        },
        xAxis: {
          categories: <?php echo $clicks_historical_json_time; ?>,
          labels: {
            rotation: 30,
            step: 3,
            y: 30
          }
        },
        yAxis: {
          title: {
            text: 'Clicks'
          },
          plotLines: [{
            value: 0,
            width: 1,
            color: '#808080'
            }]
          },
          tooltip: {
            formatter: function() {
              return '<b>'+ this.series.name +'</b><br/>'+ this.x +' - '+ this.y;
            }
          },
          legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -10,
            y: 100,
            borderWidth: 0
          },
          series: [
            {
              name: 'Clicks',
              data: <?php echo $clicks_historical_json_clicks; ?>  
            }
          ]
      });
    }
    
    _waitForDomReady();
  }
</script>
<div class='wrap'>
  <div class="pclicks-float-right">
    <h2>
      <a href="https://www.pclicks.com" target="_blank">
        <img src='<?php echo PCLICKS_PLUGIN_URL . "/images/pclicks_small.png" ?>'/>
      </a>
    </h2>
  </div>
  <div id='icon-themes' class='icon32'></div>
  <h2>Dashboard</h2>
    <?php 
    if ($toplinks == Api::CONNECTION_ERROR || $clicks_historical == Api::CONNECTION_ERROR) {
    ?>
      <span class="error"><?php echo CONN_ERROR_MESSAGE; ?></span>
    <?php
    } else {
    ?>
      <div class="metabox-holder">
        <div class="postbox">
          <h3 class="hndle">
            <span>General</span>
          </h3>
          <div class="inside pclicks-inside">
            <div class="table table_content">
              <div class="pclicks-float-right">
                <span>
                  <a target="_blank" href="<?php echo PClicks_Plugin::get_redirect_uri('/private/{_uid}/profiles/{_pname}/dashboard?time=' . PClicks_Plugin::get_minutes() );?>">Go to PClicks Site Dashboard</a>
                </span>
              </div>
              <p class="sub">
                <span class="number"><?php echo $toplinks["totalClicks"]; ?></span>
                <span class="label">Clicks on links</span>
              </p>
              <div id="clicks-historical"></div>
            </div>
          </div>
        </div>
      </div>
      <h3>Top Links</h3>
      <table class="widefat pclicks-table" id="pclicks-toplinks">
        <thead>
          <tr>
            <th>Link</th>
            <th>Clicks</th>
            <th>Percentage</th>
            <th></th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Link</th>
            <th>Clicks</th>
            <th>Percentage</th>
            <th></th>
          </tr>
        </tfoot>
        <tbody>
          <?php
          foreach ( $toplinks["topLinks"] as $link ) { 
          ?>
            <tr>
              <td>
                <a href="<?php echo $link["href"]; ?>" target="_blank">
                  <?php echo $link["name"]; ?>
                </a>
              </td>
              <td><?php echo $link["clicks"]; ?></td>
              <td><?php echo $link["percentage"]; ?></td>
              <td class="right-aligned">
                <a target="_blank" href="<?php echo PClicks_Plugin::get_redirect_uri('/private/{_uid}/profiles/{_pname}/link?time=' . PClicks_Plugin::get_minutes() . '&uid='. $link['uid']);?>">View in PClicks</a>
              </td>
            </tr>
          <?php 
          } 
          ?>
        </tbody>
    <?php 
    } 
    ?>
  </table>
  <br/>
  <h3>Top Groups</h3>
    <?php 
    if ($topgroups == Api::CONNECTION_ERROR) {
    ?>
      <span class="error"><?php echo CONN_ERROR_MESSAGE; ?></span>
    <?php
    } else {
    ?>
      <table class="widefat pclicks-table" id="pclicks-toplinks">
        <thead>
          <tr>
            <th>Group</th>
            <th>Clicks</th>
            <th></th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Group</th>
            <th>Clicks</th>
            <th></th>
          </tr>
        </tfoot>
        <tbody>
          <?php
          foreach ( $topgroups["topGroups"] as $group ) {
          ?>
            <tr>
              <td>
                <?php echo $group["name"]; ?>
              </td>
              <td>
                <?php echo $group["clicks"]; ?>
              </td>
              <td class="right-aligned">
                <a target="_blank" href="<?php echo PClicks_Plugin::get_redirect_uri('/private/{_uid}/profiles/{_pname}/groups?time=' . PClicks_Plugin::get_minutes() . '&uid='. $group["name"]);?>">View in PClicks</a>
              </td>
            </tr>
          <?php 
          } 
          ?>
        </tbody>
    <?php 
    } 
    ?>
  </table>
  <div id="pclicks-dashboard-footer"></div>
</div>