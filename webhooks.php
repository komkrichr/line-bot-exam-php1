<?php // callback.php

require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');
	
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('69d91fafb082e44307f374646698b32b');
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '1653577809']);

$Token = "NEvWA3b8STpVWM3HOFUVwulGlzQPWnnw5m0xNlXw8MW";
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


$access_token = '1653577809 69d91fafb082e44307f374646698b32b';
$msg_reply='';

file_put_contents('log.txt', file_get_contents('php://input') . PHP_EOL, FILE_APPEND);

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
			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $msg_reply 
			];
			
			// Get text sent
			$text = $event['source']['userId'];
			$msg_reply = $event['message']['text'];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
				$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			//$result = curl_exec($ch);
			curl_close($ch);
			//echo $result . "\r\n";
		}
	}
}

echo "<br>Fresh me 7";
