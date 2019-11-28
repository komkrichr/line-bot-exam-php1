<?php // callback.php

require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');
	
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('69d91fafb082e44307f374646698b32b');
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '1653577809']);

$Token = "hmFgqgYqcLfSEcJwwTQXXqPHeAa8wQqTkM99zI83Owk";
$name =  "..";
$inputimage =  "";
date_default_timezone_set("Asia/Bangkok");
//line Send
$chOne = curl_init(); 
curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
// SSL USE 
curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
//POST 
curl_setopt( $chOne, CURLOPT_POST, 1); 
// Message 
curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=$name&imageThumbnail=$inputimage&imageFullsize=$inputimage"); 
//curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=$name");   
// follow redirects 
curl_setopt( $chOne, CURLOPT_FOLLOWLOCATION, 1); 
//ADD header array 
$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$Token.'', ); 
curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
//RETURN 
curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
$result = curl_exec( $chOne ); 
//Check error 
if(curl_error($chOne)) {
    echo 'error:' . curl_error($chOne); } 
else {
  $result_ = json_decode($result, true); 
  echo "status : ".$result_['status']; echo "message : ". $result_['message']; 
} 
//Close connect 
curl_close( $chOne );      

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get replyToken
			$replyToken = $event['replyToken'];
			$response = $bot->replyText($replyToken, 'hello!');
			
			$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello');
			$response = $bot->replyMessage($replyToken, $textMessageBuilder);
			if ($response->isSucceeded()) {
			    echo 'Succeeded!';
			    return;
			}
		}
	}
}

echo "<br>Fresh me 8";
