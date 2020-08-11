<?php // callback.php

require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');
$access_token = 'mbyJk3t1tj30YHrDBQN5XExusAPF75q0oI55C7u1r6HZjMYwe3wzGmuaUinkoX7FMv2M6/bc9kf7MlyX+x6JzJooFEDxVCPkIEM5ypt4NRBlY8feWp6Pw1jK7wi0chqwNEShGVtsAEPJothOH/pbbQdB04t89/1O/w1cDnyilFU=';
$msg_reply='';

$server = "us-cdbr-iron-east-05.cleardb.net";
$username = "b4eebb1ab31fba";
$password = "8b0430ea";
$db = "heroku_a797b8e9f9df240";
$group ="N";

function TheMallSendLineNotify($string) {
    //** Reply only when message sent is in 'text' format
    $Token='eAuBBBthymE50g2lw9EV549cuqZLBtAwSRSURUxKCNo';
    $name = $string;
    $chOne = curl_init(); 
    curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
    //** SSL USE 
    curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
    curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
    //**POST 
    curl_setopt( $chOne, CURLOPT_POST, 1); 
    //** Message 
    curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=$name&imageThumbnail=$inputimage&imageFullsize=$inputimage"); 
    //**curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=$name");   
    //** follow redirects 
    curl_setopt( $chOne, CURLOPT_FOLLOWLOCATION, 1); 
    //**ADD header array 
    $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$Token.'', ); 
    curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
    //**RETURN 
    curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
    $result = curl_exec( $chOne );     
}


function SendLineNotify($string) {
    //** Reply only when message sent is in 'text' format
    //botdev group
    $Token='O0rzEarg2qtBbDTWfxefXF4usrHdrlTHzs9yNvtNVYh';
    $name = $string;
    $chOne = curl_init(); 
    curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
    //** SSL USE 
    curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
    curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
    //**POST 
    curl_setopt( $chOne, CURLOPT_POST, 1); 
    //** Message 
    curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=$name&imageThumbnail=$inputimage&imageFullsize=$inputimage"); 
    //**curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=$name");   
    //** follow redirects 
    curl_setopt( $chOne, CURLOPT_FOLLOWLOCATION, 1); 
    //**ADD header array 
    $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$Token.'', ); 
    curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
    //**RETURN 
    curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
    $result = curl_exec( $chOne );     
}

function getLINEProfile($datas)
{
   $datasReturn = [];
   $curl = curl_init();
   curl_setopt_array($curl, array(
     CURLOPT_URL => $datas['url'],
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_ENCODING => "",
     CURLOPT_MAXREDIRS => 10,
     CURLOPT_TIMEOUT => 30,
     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
     CURLOPT_CUSTOMREQUEST => "GET",
     CURLOPT_HTTPHEADER => array(
       "Authorization: Bearer ".$datas['token'],
       "cache-control: no-cache"
     ),
   ));
   $response = curl_exec($curl);
   $err = curl_error($curl);
   curl_close($curl);
   if($err){
      $datasReturn['result'] = 'E';
      $datasReturn['message'] = $err;
   }else{
      if($response == "{}"){
          $datasReturn['result'] = 'S';
          $datasReturn['message'] = 'Success';
      }else{
          $datasReturn['result'] = 'E';
          $datasReturn['message'] = $response;
      }
   }
   return $datasReturn;
}

$conn = new mysqli($server, $username, $password, $db);
// Check connection
if ($conn->connect_error) {
    SendLineNotify("Connection failed: " . $conn->connect_error);
    die("Connection failed: " . $conn->connect_error."<br>");
}

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
    // Loop through each event
    foreach ($events['events'] as $event) {
        //*** GET USER PROFIE AND SAVE DB **** //
        //SendLineNotify($event['source']['groupId']);
        
        
        $sql = "SELECT * FROM line_groups where group_status='A' and group_id='".$event['source']['groupId']."'";
        if ($result->num_rows >0) {
            $group="Y";
        }
        SendLineNotify($group);
        
        $userId = $event['source']['userId'];
        $LINEDatas['url'] = "https://api.line.me/v2/bot/profile/".$userId;
        $LINEDatas['token'] = $access_token;
        $results = getLINEProfile($LINEDatas);
        $profile = json_decode($results['message'], true);
        $sql = "SELECT * FROM line_users where line_id='".$userId."'";
        $result = $conn->query($sql);
        if ($result->num_rows ==0) {
            $userId = $event['source']['userId'];
            $LINEDatas['url'] = "https://api.line.me/v2/bot/profile/".$userId;
            $LINEDatas['token'] = $access_token;
            $results = getLINEProfile($LINEDatas);
            $profile = json_decode($results['message'], true);
            $sql = "insert into line_users(line_id,first_name,last_name,hwid,create_date,display_name,picture_url,status_message,status_code) ";
            if ($event['type'] =='beacon') $hwid =$event['beacon']['hwid'];
            $sql = $sql . " values('".$event['source']['userId']."','','','".$hwid."',curdate() " ;
            $sql = $sql .",'".$profile['displayName']."','".$profile['pictureUrl']."','".$profile['statusMessage']."','A' ";
            $sql = $sql . ")";

            if ($conn->query($sql) === TRUE) {
                SendLineNotify("Register ".$event['source']['userId']." complete.");
            } else {
                SendLineNotify("Error : " . $conn->error);
            }
        }
        
        if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
            $msg_reply=$event['message']['text'];
            $data = explode("/", $msg_reply);
            
            if ((strpos($msg_reply, '-RegisterGroup/') !== false)) {
                $data = str_replace('-RegisterGroup/','',$msg_reply);
                if ($data=='Y')
                {
                    $sql = "SELECT * FROM line_groups where group_id='".$event['source']['groupId']."'";
                    $result = $conn->query($sql);
                    if ($result->num_rows ==0) {
                        $sql = "insert into line_groups(group_id,group_name,group_status) ";
                        $sql = $sql . " values('".$event['source']['groupId']."','','A' " ;
                        $sql = $sql . ")";
                        if ($conn->query($sql) === TRUE) {
                            SendLineNotify("Register group ".$event['source']['groupId']." complete.");
                        } else {
                            SendLineNotify("Error : " . $conn->error);
                        }                    
                    }
                }
            } 
            if ((strpos($msg_reply, '-RegisterStaff/') !== false) && ($group=="Y")) {
                $sql = "SELECT * FROM line_staffs where line_id='".$userId."'";
                $result = $conn->query($sql);
                if ($result->num_rows ==0) {
                    $data = str_replace('-RegisterStaff/','',$msg_reply);
                    $ar = explode(" ", $data);
                    $userId = $event['source']['userId'];
                    $LINEDatas['url'] = "https://api.line.me/v2/bot/profile/".$userId;
                    $LINEDatas['token'] = $access_token;
                    $results = getLINEProfile($LINEDatas);
                    $profile = json_decode($results['message'], true);
                    $sql = "insert into line_staffs(line_id,first_name,last_name,hwid,create_date,display_name,picture_url,status_message,status_code) ";
                    if ($event['type'] =='beacon') $hwid =$event['beacon']['hwid'];
                    $sql = $sql . " values('".$event['source']['userId']."','".$ar[0]."','".$ar[1]."','".$hwid."',curdate() " ;
                    $sql = $sql .",'".$profile['displayName']."','".$profile['pictureUrl']."','".$profile['statusMessage']."','A' ";
                    $sql = $sql . ")";
                    if ($conn->query($sql) === TRUE) {
                        SendLineNotify("Register Staff".$event['source']['userId']." complete.");
                    } else {
                        SendLineNotify("Error : " . $conn->error);
                    }
                }                
            }
            
            if ((strpos($msg_reply, '-UpdateStaff/') !== false) && ($group=="Y")) {
                $data = str_replace('-UpdateStaff/','',$msg_reply);
                $ar = explode(" ", $data);
                $sql ="update line_staffs set first_name='".$ar[0]."'";
                $sql .=",last_name='".$ar[1]."'";
                $sql .=" where line_id='".$event['source']['userId']."'";
                if ($conn->query($sql) === TRUE) {
                    SendLineNotify("Update Staff ".$event['source']['userId']." complete.");
                } else {
                    SendLineNotify("Error : " . $conn->error);
                }
            }
            
            if ((strpos($msg_reply, 'The mall') !== false) && (strpos($msg_reply, '/') !== false) && ($group=="Y")) {
                $code=$msg_reply;
                $code = str_replace('The mall/','',$code);
                $sql = "SELECT redream_date  FROM redreams where redream_code='$code' ";
                $result1 = $conn->query($sql);
                if ($result1->num_rows > 0) {
                     $row1 = $result1->fetch_assoc();
                    TheMallSendLineNotify("รหัสเคยใช้งานแล้วเมื่อวันที่ ".$row1["redream_date"]);
                }else{
                    $id=1;
                    $sql = "SELECT max(redream_id) as 'max_id'  FROM redreams";
                    $result1 = $conn->query($sql);
                    if ($result1->num_rows > 0) {
                        $row1 = $result1->fetch_assoc();
                        $id = $row1["max_id"]+1;
                    }

                    $sql ="insert into redreams(redream_id,redream_code,redream_date) values ( $id,'$code',Now())";
                    if ($conn->query($sql) === TRUE) {
                        TheMallSendLineNotify("ลงทะเบียนรับส่วนลดเรียบร้อยแล้ว:".$code);
                    }else{
                        SendLineNotify("Redream Error:".$sql);
                    }
                }
            }
        }
        
        if ($event['type'] == 'beacon') {
            //*** GET USER PROFIE AND SAVE DB **** //
            $userId = $event['source']['userId'];
            $LINEDatas['url'] = "https://api.line.me/v2/bot/profile/".$userId;
            $LINEDatas['token'] = $access_token;
            $results = getLINEProfile($LINEDatas);
            $profile = json_decode($results['message'], true);
            $sql = "SELECT * FROM line_users where line_id='".$userId."'";
            $result = $conn->query($sql);
            if ($result->num_rows ==0) {
                $userId = $event['source']['userId'];
                $LINEDatas['url'] = "https://api.line.me/v2/bot/profile/".$userId;
                $LINEDatas['token'] = $access_token;
                $results = getLINEProfile($LINEDatas);
                $profile = json_decode($results['message'], true);
                $sql = "insert into line_users(line_id,first_name,last_name,hwid,create_date,display_name,picture_url,status_message) ";
                $sql = $sql . " values('".$event['source']['userId']."','','','".$event['beacon']['hwid']."',curdate() " ;
                $sql = $sql .",'".$profile['displayName']."','".$profile['pictureUrl']."','".$profile['statusMessage']."' ";
                $sql = $sql . ")";

                if ($conn->query($sql) === TRUE) {
                    SendLineNotify("new user register");
                } else {
                    SendLineNotify("Error : " . $conn->error);
                }
            }
            
            //*** SAVE VISIT LOG ***//
            $sql = "insert into line_beam_user_transaction "; 
            $sql = $sql . "(line_id,hwid,create_date) ";
            $sql = $sql . "values('".$event['source']['userId']."','".$event['beacon']['hwid']."',curdate()) ";
            if ($conn->query($sql) === TRUE) {
                 //SendLineNotify("user visit");
            } else {
                SendLineNotify("Error : " . $conn->error);
            }
            
            if ($event['beacon']['type'] =='enter')
            {
                $text = 'กรุณากด เช็คอินร้านค้า';
                $text =$text. '  '.'https://qr.thaichana.com/callback?appId=0001&shopId=S0000007846&type=checkin&token=&mode=line';
            }else if ($event['beacon']['type'] =='leave'){
                $text = 'กรุณากด เช็คเอาท์';    
                $text =$text. '  '.'https://qr.thaichana.com/callback?appId=0001&shopId=S0000007846&type=checkout&token=&mode=line';
            }

            $replyToken = $event['replyToken']; 
            //$text =$text. '  '.'https://qr.thaichana.com/?appId=0001&shopId=S0000007846';


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

            //SendLineNotify("Visit: ".$text);            
            //SendLineNotify("replyToken: ".$replyToken);     
        }       
    }
}

$conn->close();
echo "<br>Beacons  A-GO19";


