<?php
echo "Hello LINE BOT 10. <br>";

$curlSession = curl_init();
curl_setopt($curlSession, CURLOPT_URL, 'http://43.254.133.192/raid/botgo.asp');
curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
$jsonData = json_decode(curl_exec($curlSession));
curl_close($curlSession);
$msg = iconv('ASCII', 'UTF-8//IGNORE', $jsonData->{'Raids'});
echo $msg;
?>
