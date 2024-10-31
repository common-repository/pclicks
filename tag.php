<?php
function pclicks_tag_attach( ) {
  $currentPcid = get_option( PCLICKS_PCID_OPTION );
  if ( $currentPcid ) {
?>
<!-- Pclicks Tag Start -->
<script type="text/javascript">
  document.write(unescape("%3Cscript src='" + document.location.protocol +
    '//capture.pclicks.com/js?pcid=<?php echo $currentPcid; ?>' + "' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
  (function() {
    var pc = new predicta.PClick();
    pc.start();
  })();
</script>
<!-- Pclicks Tag End -->
<?php
  }
}
?>