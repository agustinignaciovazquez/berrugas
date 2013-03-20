<?php
//BIT.LY API ACORTADOR DE URL
function short_url($url){
$connectURL = 'http://api.bit.ly/v3/shorten?login=krakarg&apiKey=ACAPONETUAPIGUACHO&uri='.urlencode($url).'&format=txt';
  return curl_get_result($connectURL);
}
function curl_get_result($url) {
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_HTTPHEADER, Array("User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.15) Gecko/20080623 Firefox/2.0.0.15") ); 
curl_setopt($ch, CURLOPT_NOBODY, false);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result= curl_exec ($ch);
curl_close ($ch);
return $result;
}
?>