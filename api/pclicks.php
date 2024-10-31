<?php
class Api {
  
  const URL = "http://api.pclicks.com";
  const CURRENT_VERSION = "v1";
  const CONNECTION_ERROR = 0;
  
  private $pcid;
  private $apiKey;
  
  function __construct($apiKey, $pcid) {
    $this->pcid = $pcid;
    $this->apiKey = $apiKey;
  }
  
  public function get_top_links() {
    return $this->_call("/top-links");
  }
  
  public function get_top_groups() {
    return $this->_call("/top-groups");
  }
  
  public function get_clicks_historical() {
    return $this->_call("/total-clicks/historical");
  }
  
  public function get_profile_info() {
    return $this->_call("/profile/info");
  }
  
  public function get_link_info($name, $href) {
    $encoded_name = urlencode($name);
    $encoded_href = urlencode($href);
    return $this->_call("/link", "&name=$encoded_name&href=$encoded_href");
  }
  
  private function _call($path, $params='') {
    $minutes = $this->_convert_string_to_minutes(PClicks_Plugin::get_minutes());
    
    $ch = curl_init(self::URL . "/" . self::CURRENT_VERSION . "$path?pcid=$this->pcid&key=$this->apiKey&minutes=$minutes$params");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $respose_body = curl_exec($ch);

    if (!$respose_body) {
      return Api::CONNECTION_ERROR;
    }  
    
    $info = curl_getinfo($ch);
    $http_code = $info['http_code'];
    
    if ($http_code != 200) {
      return Api::CONNECTION_ERROR;
    }
    
    curl_close($ch);
    return json_decode($respose_body, true);
  }
  
  private function _convert_string_to_minutes($string) {
    $rates = array(
      'm' => 1,
      'h' => 60,
      'd' => 24 * 60
    );
    $matches = array();
    $rate = $rates[substr($string, strlen($string) - 1)];
    preg_match('/^\d+/', $string, $matches);

    return intval($matches[0]) * $rate;
  }
}
?>