<?php // callback.php

require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

$access_token = 'mbyJk3t1tj30YHrDBQN5XExusAPF75q0oI55C7u1r6HZjMYwe3wzGmuaUinkoX7FMv2M6/bc9kf7MlyX+x6JzJooFEDxVCPkIEM5ypt4NRBlY8feWp6Pw1jK7wi0chqwNEShGVtsAEPJothOH/pbbQdB04t89/1O/w1cDnyilFU=';
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
        
        $Token='O0rzEarg2qtBbDTWfxefXF4usrHdrlTHzs9yNvtNVYh';
        $name = $event['type'];
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
        
        if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
            // Get text sent
            $text = $event['message']['text'];
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
                'messages' => [$messages]
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
            echo $result . "";
        }
        
        if ($event['type'] == 'beacon') {
            
            $replyToken = $event['replyToken'];
            $text = $event['beacon']['hwid'];
            $text = .' : '.$event['beacon']['source']['userId'];
            
            if ($event['beacon']['type'] =='enter')
            {
                $text = .' สวัสดีค่ะ ยินดีต้อนรับ';
            }else if ($event['beacon']['type'] =='leave'){
                $text = .' โอกาสหน้าเชิญใหม่นะคะ';    
            }
            
            // Build message to reply back
            $messages = [
                'type' => 'text',
                'text' => $text,
            ];
            // Make a POST Request to Messaging API to reply to sender
            $url = 'https://api.line.me/v2/bot/message/reply';
            $data = [
                'replyToken' => $replyToken,
                'messages' => [$messages]
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
            echo $result . "";            
        }
       
    }
}

echo "<br>Beacons-102";
