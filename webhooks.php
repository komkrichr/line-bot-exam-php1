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

$access_token = 'iDajrSSMIRGaGQgv3AbuFaKHlDH6fU35m216/2T0Bb9MX/egR0Mm4ZrkTmUGeHqA1CM/h1AxwrVjrKItQc0kpqXjnRyieff+4iIKR+XSglOaSRnSloWn8arnI3LQxZy9KFfLArzYYf85Lvq6ZLISIwdB04t89/1O/w1cDnyilFU=';
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
			
			//if (!is_null($jsonData['Raids'])) {
			//	foreach ($jsonData['Raids'] as $event) {
			//	}
			//}
			
			if (strpos($msg_reply, '##Raid Boss##') !== false) {
				//eho 'JASON:';
				//echo $jsonData->{'Raids'}; 
				$curlSession = curl_init();
				curl_setopt($curlSession, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($curlSession, CURLOPT_URL, 'http://43.254.133.192/raid/botgo.asp');
				curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
				curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
				$jsonData = json_decode(curl_exec($curlSession));
				curl_close($curlSession);
				$msg = iconv('ASCII', 'UTF-8//IGNORE', $jsonData->{'Raids'});

				//$arr = explode(' ',$jsonData->{'Raids'});
				//$msg='';
				//foreach ($arr as &$value) {
					//$msg=$msg.chr($value);
					//$msg=$msg.($value);
				//}
				//echo $msg;
				//echo "<br>";
				//echo $jsonData->{'Raids'};
				
				// Get text sent
				//$text = $event['source']['userId'];
				$text = $msg;
				// Get replyToken
				$replyToken = $event['replyToken'];
				// Build message to reply back
				$messages = [
					'type' => 'text',
					'text' => $text,
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
				echo $result . "\r\n";
			}

			if ((strpos($msg_reply, 'Co-ords') !== false) || (strpos($msg_reply, 'Exraid') !== false) || (strpos($msg_reply, 'Ex Raid Gym') !== false) || (strpos($msg_reply, 'EX RAID GYM') !== false)) {
				$name =  $msg_reply;
				$inputimage =  "";
				$sTokenDev="sRCa53zmuuPNdZqvXtUYX2IxB24SlPpJd5V4VClZovv";			
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
				$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sTokenDev.'', ); 
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
				$msg_reply="";
			}
			
			if ((strpos($msg_reply, 'IV100') !== false) || (strpos($msg_reply, '100IV') !== false)) {
				$name =  $msg_reply;
				$inputimage =  "";
				$sTokenDev="sRCa53zmuuPNdZqvXtUYX2IxB24SlPpJd5V4VClZovv";			
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
				$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sTokenDev.'', ); 
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
				$msg_reply="";
			}
			
			if (strpos($msg_reply, '/Cancel') !== false) {
				$url = 'http://43.254.133.192/raid/delete.asp';
				$ch = curl_init( $url );
				$myvars = 'GymsName='.$AscMessage;
				$headers = ['Content-Type' => 'application/x-www-form-urlencoded', 'charset' => 'windows-874'];
				curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt( $ch, CURLOPT_HEADER, $headers);
				curl_setopt( $ch, CURLOPT_ENCODING, 'windows-874');
				curl_setopt( $ch, CURLOPT_POST, 1);
				curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
				curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);				
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
				$response = curl_exec( $ch );
			}

			if (strpos($msg_reply, '/ExRaid') !== false) {
				$url = 'http://43.254.133.192/raid/exraid.asp';
				$ch = curl_init( $url );
				$myvars = 'GymsName='.$AscMessage;
				$headers = ['Content-Type' => 'application/x-www-form-urlencoded', 'charset' => 'windows-874'];
				curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt( $ch, CURLOPT_HEADER, $headers);
				curl_setopt( $ch, CURLOPT_ENCODING, 'windows-874');
				curl_setopt( $ch, CURLOPT_POST, 1);
				curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
				curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);				
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
				$response = curl_exec( $ch );
			}
			
			if (strpos($msg_reply, '/CancelExRaid') !== false) {
				$url = 'http://43.254.133.192/raid/cancel_exraid.asp';
				$ch = curl_init( $url );
				$myvars = 'GymsName='.$AscMessage;
				$headers = ['Content-Type' => 'application/x-www-form-urlencoded', 'charset' => 'windows-874'];
				curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt( $ch, CURLOPT_HEADER, $headers);
				curl_setopt( $ch, CURLOPT_ENCODING, 'windows-874');
				curl_setopt( $ch, CURLOPT_POST, 1);
				curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
				curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);				
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
				$response = curl_exec( $ch );
			}
			
			if (strpos($msg_reply, '/!Send') !== false) {
				$url = 'http://43.254.133.192/raid/send.asp';
				$ch = curl_init( $url );
				$headers = ['Content-Type' => 'application/x-www-form-urlencoded', 'charset' => 'windows-874'];
				curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false);
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
				curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt( $ch, CURLOPT_HEADER, $headers);
				curl_setopt( $ch, CURLOPT_ENCODING, 'windows-874');
				curl_setopt( $ch, CURLOPT_POST, 1);
				curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
				curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);				
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
				$response = curl_exec( $ch );
			}
			
			if (strpos($msg_reply, '/!Reply1') !== false) {
				// Get replyToken
				$Token = "K6R3pKOXUxu4eh84eivsUTZRZL6lDzt7n8LvB8x88Uv";
				
				$msg_reply = str_replace('/!Reply1','',$msg_reply);

				$chOne = curl_init(); 
				curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
				// SSL USE 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
				//POST 
				curl_setopt( $chOne, CURLOPT_POST, 1); 
				// Message 
				curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=$msg_reply&imageThumbnail=$inputimage&imageFullsize=$inputimage"); 
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
				
				curl_close( $chOne );  
			}

			if  (strpos($msg_reply, '/!Reply2') !== false) {
				// Get replyToken
				$Token1 = "IRBcmOtiPol9awe67vgeNpOupkfcDUmLCGsEXn0TdWK" ;				
				$msg_reply = str_replace('/!Reply2','',$msg_reply);
				
				$chOne = curl_init(); 
				curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
				// SSL USE 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
				//POST 
				curl_setopt( $chOne, CURLOPT_POST, 1); 
				// Message 
				curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=$msg_reply&imageThumbnail=$inputimage&imageFullsize=$inputimage"); 
				//curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=$name");   
				// follow redirects 
				curl_setopt( $chOne, CURLOPT_FOLLOWLOCATION, 1); 
				//ADD header array 
				$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$Token1.'', ); 
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
			}
			
			if  ((strpos($msg_reply, '/!Reply') !== false) && (strpos($msg_reply, '/!Reply1') == false) && (strpos($msg_reply, '/!Reply2') == false)) {
				// Get replyToken
				$Token = "K6R3pKOXUxu4eh84eivsUTZRZL6lDzt7n8LvB8x88Uv";
				$Token1 = "IRBcmOtiPol9awe67vgeNpOupkfcDUmLCGsEXn0TdWK" ;
				
				$msg_reply = str_replace('/!Reply','',$msg_reply);

				$chOne = curl_init(); 
				curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
				// SSL USE 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
				//POST 
				curl_setopt( $chOne, CURLOPT_POST, 1); 
				// Message 
				curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=$msg_reply&imageThumbnail=$inputimage&imageFullsize=$inputimage"); 
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
				
				$chOne = curl_init(); 
				curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
				// SSL USE 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
				//POST 
				curl_setopt( $chOne, CURLOPT_POST, 1); 
				// Message 
				curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=$msg_reply&imageThumbnail=$inputimage&imageFullsize=$inputimage"); 
				//curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=$name");   
				// follow redirects 
				curl_setopt( $chOne, CURLOPT_FOLLOWLOCATION, 1); 
				//ADD header array 
				$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$Token1.'', ); 
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
			}
				

			if ((strlen($msg_reply)<200) && (strpos($msg_reply, 'http') == false))  {
				//if (((strpos($msg_reply, '/') !== false) && (strpos($msg_reply, ':') !== false)) || ((strpos($msg_reply, '/') !== false) && (strpos($msg_reply, '.') !== false)) || (strpos($msg_reply, 'lo/') !== false) || (strpos($msg_reply, 'Lo/') !== false) || (strpos($msg_reply, 'LO/') !== false)) {
				if (((strpos($msg_reply, '/') !== false) && (strpos($msg_reply, ':') !== false)) || ((strpos($msg_reply, '/') !== false) && (strpos($msg_reply, '.') !== false)) || (strpos($msg_reply, '//') !== false)) {

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
					curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false);
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

echo "<br>007";
