<?php
echo "Hello LINE BOT V2. <br>";

$sMessage='พญาไท ARL';
$iCount=strlen($sMessage)-1;
$AscMessage="";
echo "$iCount : $sMessage <br>";
for ($x = 0; $x <= $iCount; $x++) {
    //echo "The number is: $x string: " . substr($sMessage,$x,1) . " Asc:" . ord(substr($sMessage,$x,1)) . "<br>";
    $AscMessage.=substr("000".ord(substr($sMessage,$x,1)),-3,3);
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
$response = curl_exec( $ch );

?>
