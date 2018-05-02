<?php // callback.php

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

$access_token = 'D72+jpfVSwYVT6aMhV4iWkotVP+RN08p0pslpXb4d7sKiNxPZeZ3nNIUoavXY7Ix1CM/h1AxwrVjrKItQc0kpqXjnRyieff+4iIKR+XSglPUas6F2BsDP3mRt9hyNN1iWNPF6sqBt9ayF4YXogZC3AdB04t89/1O/w1cDnyilFU=';
$msg_reply='';
	
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
			// Get text sent
			$text = $event['source']['userId'];
			$msg_reply = $event['message']['text'];
			//$msg_reply = $msg_reply. '///'. strlen($msg_reply);

			$AscMessage="";
			$offset = 0;
			$Message1=$msg_reply;
			
			while ($offset >= 0) {
				$AscMessage.=ordutf8($Message1, $offset)."|";
			}

			if (strpos($msg_reply, '/!Send') !== false) {
				$url = 'http://43.254.133.192/raid/send.asp';
				$ch = curl_init( $url );
				$headers = ['Content-Type' => 'application/x-www-form-urlencoded', 'charset' => 'windows-874'];
				curl_setopt( $ch, CURLOPT_HEADER, $headers);
				curl_setopt( $ch, CURLOPT_ENCODING, 'windows-874');
				curl_setopt( $ch, CURLOPT_POST, 1);
				curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
				curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);				
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
				$response = curl_exec( $ch );
			}
			
			if (strpos($msg_reply, '/!Update') !== false) {
				$url = 'http://43.254.133.192/raid/send.asp';
				$myvars = 'chkNew=Y';
				$ch = curl_init( $url );
				$headers = ['Content-Type' => 'application/x-www-form-urlencoded', 'charset' => 'windows-874'];
				curl_setopt( $ch, CURLOPT_HEADER, $headers);
				curl_setopt( $ch, CURLOPT_ENCODING, 'windows-874');
				curl_setopt( $ch, CURLOPT_POST, 1);
				curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
				curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);				
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
				$response = curl_exec( $ch );
			}
			
			if (strpos($msg_reply, '/!Reply') !== false) {
				// Get replyToken
				$replyToken = $event['replyToken'];
				$msg_reply = str_replace('/!Reply','',$msg_reply);
				$messages = [
					'type' => 'text',
					'text' => $msg_reply 
				];
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
				$result = curl_exec($ch);
				curl_close($ch);
				
			}
			if ((strlen($msg_reply)<200) && (strpos($msg_reply, 'http') == false))  {
				if (((strpos($msg_reply, '/') !== false) && (strpos($msg_reply, ':') !== false)) || ((strpos($msg_reply, '/') !== false) && (strpos($msg_reply, '.') !== false)) || (strpos($msg_reply, 'lo/') !== false) || (strpos($msg_reply, 'Lo/') !== false) || (strpos($msg_reply, 'LO/') !== false)) {
			
				// Get replyToken
				$replyToken = $event['replyToken'];
				$replyToken = str_replace('ดาว','',$replyToken);

				// Build message to reply back
				$messages = [
					'type' => 'text',
					'text' => $msg_reply 
				];
				
				//Save Location
				//$msg_reply='lo/ราช องค์/08.00';
				$url = 'http://43.254.133.192/raid/ar1.asp';

				$msg_reply=str_replace(' ','A-A-A',$msg_reply);

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
				//echo $response . "\r\n";				
				
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
	}
}

echo "100";
