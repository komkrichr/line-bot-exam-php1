<?php
require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

function ordutf8($string, &$offset) {
    $code = ord(substr($string, $offset,1)); 
    if ($code >= 128) {        //otherwise 0xxxxxxx
        if ($code < 224) $bytesnumber = 2;                //110xxxxx
        else if ($code < 240) $bytesnumber = 3;        //1110xxxx
        else if ($code < 248) $bytesnumber = 4;    //11110xxx
        $codetemp = $code - 192 - ($bytesnumber > 2 ? 32 : 0) - ($bytesnumber > 3 ? 16 : 0);
        for ($i = 2; $i <= $bytesnumber; $i++) {
            $offset ++;
            $code2 = ord(substr($string, $offset, 1)) - 128;        //10xxxxxx
            $codetemp = $codetemp*64 + $code2;
        }
        $code = $codetemp;
    }
    $offset += 1;
    if ($offset >= strlen($string)) $offset = -1;
    return $code;
}
$access_token = 'MFFmuhxVsj5vCPrHZ7i2dKBNsg0ksdE36S2OuxYEEuFQ2zN5Uc2sQpsYD6/L5y201CM/h1AxwrVjrKItQc0kpqXjnRyieff+4iIKR+XSglNKGAIZZ9pb9jRyMyweJ/KxfNom4LHazjILRJXRiNyQBwdB04t89/1O/w1cDnyilFU=';
$msg_reply='';
// Get POST body content
$content = file_get_contents('php://input');

echo "Hello LINE BOT 5. <br>";

$curlSession = curl_init();
curl_setopt($curlSession, CURLOPT_URL, 'http://43.254.133.192/raid/botgo.asp');
curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
$jsonData = json_decode(curl_exec($curlSession));
curl_close($curlSession);
echo $jsonData->{'Raids'};
echo '<br>';


$arr = explode(' ',$jsonData->{'Raids'});
$msg='';
foreach ($arr as &$value) {
	//$msg=$msg.iconv('ASCII', 'UTF-8//IGNORE',chr($value));
	$msg=$msg.$value;
}
//echo $msg;
//echo "<br>";
//echo $jsonData->{'Raids'};
//$msg = iconv('ASCII', 'UTF-8//IGNORE', $msg);
echo "utf8<br>";
echo $msg;
echo chr(190);
echo 'stop';
?>
