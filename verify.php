<?php
$access_token = 'mbyJk3t1tj30YHrDBQN5XExusAPF75q0oI55C7u1r6HZjMYwe3wzGmuaUinkoX7FMv2M6/bc9kf7MlyX+x6JzJooFEDxVCPkIEM5ypt4NRBlY8feWp6Pw1jK7wi0chqwNEShGVtsAEPJothOH/pbbQdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v2/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);
echo 'go-1';
echo $result;
