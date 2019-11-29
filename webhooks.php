<?php // callback.php

require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

function SendLineNotify($string) {
    //** Reply only when message sent is in 'text' format
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

$url = parse_url(getenv("mysql://b4eebb1ab31fba:8b0430ea@us-cdbr-iron-east-05.cleardb.net/heroku_a797b8e9f9df240?reconnect=true"));
$server = "us-cdbr-iron-east-05.cleardb.net";
$username = "b4eebb1ab31fba";
$password = "8b0430ea";
$db = "heroku_a797b8e9f9df240";
$conn = new mysqli($server, $username, $password, $db);
// Check connection
if ($conn->connect_error) {
    SendLineNotify("Connection failed: " . $conn->connect_error);
    die("Connection failed: " . $conn->connect_error."<br>");
}



$access_token = 'mbyJk3t1tj30YHrDBQN5XExusAPF75q0oI55C7u1r6HZjMYwe3wzGmuaUinkoX7FMv2M6/bc9kf7MlyX+x6JzJooFEDxVCPkIEM5ypt4NRBlY8feWp6Pw1jK7wi0chqwNEShGVtsAEPJothOH/pbbQdB04t89/1O/w1cDnyilFU=';
$msg_reply='';

$jsonSpecialOffer = [
    "type" => "flex",
    "altText" => "SPECIAL OFFER",
    "contents" => [
      "type" => "bubble",
      "direction" => "ltr",
      "header" => [
        "type" => "box",
        "layout" => "vertical",
        "contents" => [
          [
              "type"=> "image",
              "url"=> "https://scontent-kut2-1.xx.fbcdn.net/v/t1.0-9/p960x960/72621156_2359379364189164_6729822528555974656_o.jpg?_nc_cat=107&_nc_eui2=AeGJAMhb70mXeIf4YHlUkocsvhJLHDM-z3yY7qOpUEb0Ek6EbzNnIJZbk1QPiox9TP6KxSJtorDSD6MRBp7AwsYPWCLEvyB0eCjCSVsZGB562g&_nc_ohc=eUvOC_2FcnYAQmQIzAa4C4tAvKCZnKF8INfeWmQ7F4_kUuVhvYh0NpuzQ&_nc_ht=scontent-kut2-1.xx&oh=afec2f0052738c07c63b424e081143bd&oe=5E441FDD",
              "size"=> "full",
              "aspectRatio"=> "1:1",
              "aspectMode"=> "cover"
          ]
        ]
      ],
      "body" => [
        "type" => "box",
        "layout" => "vertical",
        "contents" => [
          [
            "type" => "text",
            "text" => "ซื้อเมนู Premium ในราคา 1 บาท",
            "margin" => "lg",
            "size" => "lg",
            "color" => "#000000"
          ]      
        ]
      ],
      "footer" => [
        "type" => "box",
        "layout" => "horizontal",
        "contents" => [
          [
            "type" => "text",
            "text" => "View Details",
            "size" => "lg",
            "align" => "start",
            "color" => "#0084B6",
            "action" => [
              "type" => "uri",
              "label" => "View Details",
              "uri" => "https://www.facebook.com/BUFreshme/photos/a.754557021645905/805391143229159/?type=3&theater"
            ]
          ]
        ]
      ]
    ]
  ];


$jsonFlex = [
    "type" => "flex",
    "altText" => "Hello Flex Message",
    "contents" => [
      "type" => "bubble",
      "direction" => "ltr",
      "header" => [
        "type" => "box",
        "layout" => "vertical",
        "contents" => [
          [
            "type" => "text",
            "text" => "Purchase",
            "size" => "lg",
            "align" => "start",
            "weight" => "bold",
            "color" => "#009813"
          ],
          [
            "type" => "text",
            "text" => "฿ 100.00",
            "size" => "3xl",
            "weight" => "bold",
            "color" => "#000000"
          ],
          [
            "type" => "text",
            "text" => "Rabbit Line Pay",
            "size" => "lg",
            "weight" => "bold",
            "color" => "#000000"
          ],
          [
            "type" => "text",
            "text" => "2019.02.14 21:47 (GMT+0700)",
            "size" => "xs",
            "color" => "#B2B2B2"
          ],
          [
            "type" => "text",
            "text" => "Payment complete.",
            "margin" => "lg",
            "size" => "lg",
            "color" => "#000000"
          ]
        ]
      ],
      "body" => [
        "type" => "box",
        "layout" => "vertical",
        "contents" => [
          [
            "type" => "separator",
            "color" => "#C3C3C3"
          ],
          [
            "type" => "box",
            "layout" => "baseline",
            "margin" => "lg",
            "contents" => [
              [
                "type" => "text",
                "text" => "Merchant",
                "align" => "start",
                "color" => "#C3C3C3"
              ],
              [
                "type" => "text",
                "text" => "BTS 01",
                "align" => "end",
                "color" => "#000000"
              ]
            ]
          ],
          [
            "type" => "box",
            "layout" => "baseline",
            "margin" => "lg",
            "contents" => [
              [
                "type" => "text",
                "text" => "New balance",
                "color" => "#C3C3C3"
              ],
              [
                "type" => "text",
                "text" => "฿ 45.57",
                "align" => "end"
              ]
            ]
          ],
          [
            "type" => "separator",
            "margin" => "lg",
            "color" => "#C3C3C3"
          ]
        ]
      ],
      "footer" => [
        "type" => "box",
        "layout" => "horizontal",
        "contents" => [
          [
            "type" => "text",
            "text" => "View Details",
            "size" => "lg",
            "align" => "start",
            "color" => "#0084B6",
            "action" => [
              "type" => "uri",
              "label" => "View Details",
              "uri" => "https://google.co.th/"
            ]
          ]
        ]
      ]
    ]
  ];

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {

    $userId = $event['source']['userId'];
    $LINEDatas['url'] = "https://api.line.me/v2/bot/profile/".$userId;
    $LINEDatas['token'] = $access_token;
    $results = getLINEProfile($LINEDatas);
    SendLineNotify($results['message']);

    // Loop through each event
    foreach ($events['events'] as $event) {
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
                //'messages' => [$jsonFlex1]
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
            

            $sql = "insert into line_beam_user_transaction "; 
            $sql = $sql . "(line_id,hwid,create_date) ";
            $sql = $sql . "values('".$event['source']['userId']."','".$event['beacon']['hwid']."',curdate()) ";
            if ($conn->query($sql) === TRUE) {
                 SendLineNotify("user visit");
            } else {
                SendLineNotify("Error : " . $conn->error);
            }
            
            $sql = "SELECT * FROM line_users where line_id='".$event['source']['userId']."'";
            $result = $conn->query($sql);
            if ($result->num_rows ==0) {     
                $sql = "insert into line_users(line_id,first_name,last_name,hwid,create_date) ";
                $sql = $sql . " values('".$event['source']['userId']."','','','".$event['beacon']['hwid']."',curdate()) " ;
                if ($conn->query($sql) === TRUE) {
                    SendLineNotify("new user register");
                } else {
                    SendLineNotify("Error : " . $conn->error);
                }
            }
            
            $promotion_id ='1';
            $sql = "SELECT * FROM line_beam_user_log where line_id='".$event['source']['userId']."'";
            $sql = $sql. " and line_beam_promotion_id=".$promotion_id;
            if ($result->num_rows ==0) {     
                $sql =  "insert into line_beam_user_log ";
                $sql = $sql . " (line_id,line_beam_promotion_id,create_date) ";
                $sql = $sql . " values('".$event['source']['userId']."',".$promotion_id.",curdate()) ";
                if ($conn->query($sql) === TRUE) {
                    $replyToken = $event['replyToken'];
                    $text = $event['beacon']['hwid'];
                    $text = $text.' '.$event['source']['userId'];

                    if ($event['beacon']['type'] =='enter')
                    {
                        $text = $text.' สวัสดีค่ะ ยินดีต้อนรับ';
                    }else if ($event['beacon']['type'] =='leave'){
                        $text = $text.' โอกาสหน้าเชิญใหม่นะคะ';    
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
                        'messages' => [$jsonSpecialOffer]    
                        //'messages' => [$messages]
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
                    SendLineNotify("send promotion".$promotion_id);
                }else{
                    SendLineNotify("Error : " . $conn->error);
                }
            }
        }
       
    }
}

$conn->close();
echo "<br>Beacons-104";


