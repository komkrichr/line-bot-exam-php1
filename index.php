<?php
require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

$url = 'http://43.254.133.192/raid/ar1.asp';

$msg_reply=str_replace(' ','A-A-A',$msg_reply);
$AscMessage='Wannasorn/11.30';
$myvars = 'txtRaid=' . $AscMessage  ;

$ch = curl_init( $url );

$headers = ['Content-Type' => 'application/x-www-form-urlencoded', 'charset' => 'windows-874'];
curl_setopt( $ch, CURLOPT_HEADER, $headers);
curl_setopt( $ch, CURLOPT_ENCODING, 'windows-874');
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);				
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
//$response = curl_exec( $ch );
echo $response . "\r\n";				

echo 'GoRaid V4';
?>
