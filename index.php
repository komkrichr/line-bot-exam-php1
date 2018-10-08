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

$access_token = 'iDajrSSMIRGaGQgv3AbuFaKHlDH6fU35m216/2T0Bb9MX/egR0Mm4ZrkTmUGeHqA1CM/h1AxwrVjrKItQc0kpqXjnRyieff+4iIKR+XSglOaSRnSloWn8arnI3LQxZy9KFfLArzYYf85Lvq6ZLISIwdB04t89/1O/w1cDnyilFU=';
$msg_reply='';

					//Save Location
					//$msg_reply='lo/ราช องค์/08.00';
					$url = 'http://43.254.133.192/raid/ar1.asp';

					$msg_reply=str_replace(' ','A-A-A',$msg_reply);
          $AscMessage='Wannasorn/11.30';
					$myvars = 'txtRaid=' . $AscMessage  ;

					$ch = curl_init( $url );

					//$myvars =  curl_escape($ch ,'txtRaid=' . $msg_reply);
					//curl_setopt( $ch, CURLOPT_ENCODING, 'UTF-8');
					$headers = ['Content-Type' => 'application/x-www-form-urlencoded', 'charset' => 'windows-874'];
					curl_setopt( $ch, CURLOPT_HEADER, $headers);
					curl_setopt( $ch, CURLOPT_ENCODING, 'windows-874');
					curl_setopt( $ch, CURLOPT_POST, 1);
					curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
					curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);				
					curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
					$response = curl_exec( $ch );
					echo $response . "\r\n";				


echo 'GoRaid V2';
?>
