<html>
<head>
<title>utf-8</title>
<meta http-equiv=Content-Type content="text/html; charset="utf-8">
</head>
<body>

<?php
//mb_internal_encoding("UTF-8");
//mb_http_output('UTF-8');
//header('Content-type: text/html; charset=utf-8');

echo "Hello LINE BOT V5. <br>";

$sMessage='ทดสอบ ARL';
$iCount=strlen($sMessage)-1;
$AscMessage="";
                                                                 
                                                                 
echo $sMessage <br>";
echo $x.": ". substr($sMessage,0,3) ."<br>";
echo $x.": ". substr($sMessage,3,3) ."<br>";
echo ord(substr($sMessage,0,3)) . "<br>";

//echo mb_strlen($sMessage) . "<br>";                                               
                                                                 
for ($x = 0; $x <= $iCount; $x++) {
    if  ((ord(ord(substr($sMessage,$x,1)) <40) && (ord(ord(substr($sMessage,$x,1)) >95)) {   
         echo $x.": ". substr($sMessage,$x,3) ."<br>";
         $x=$x+3;
    }else{
        echo $x.": ". substr($sMessage,$x,1) ."<br>";
    }
    //echo "The number is: $x string: " . substr($sMessage,$x,1) . " Asc:" . ord(substr($sMessage,$x,1)) . "<br>";
    //$AscMessage.=substr("000".ord(substr($sMessage,$x,1)),-3,3);
    //echo substr("000".ord(substr($sMessage,$x,1)),-3,3). "<br>";

}
echo $AscMessage;

$url = 'http://43.254.133.192/raid/ar.asp';
$msg_reply=$AscMessage;
$myvars = 'txtRaid=' . $msg_reply ;
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
//$response = curl_exec( $ch );
?>
    
</body>
</html>

