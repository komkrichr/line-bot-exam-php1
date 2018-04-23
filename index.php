<?php

function _uniord($c) {
    if (ord($c{0}) >=0 && ord($c{0}) <= 127)
        return ord($c{0});
    if (ord($c{0}) >= 192 && ord($c{0}) <= 223)
        return (ord($c{0})-192)*64 + (ord($c{1})-128);
    if (ord($c{0}) >= 224 && ord($c{0}) <= 239)
        return (ord($c{0})-224)*4096 + (ord($c{1})-128)*64 + (ord($c{2})-128);
    if (ord($c{0}) >= 240 && ord($c{0}) <= 247)
        return (ord($c{0})-240)*262144 + (ord($c{1})-128)*4096 + (ord($c{2})-128)*64 + (ord($c{3})-128);
    if (ord($c{0}) >= 248 && ord($c{0}) <= 251)
        return (ord($c{0})-248)*16777216 + (ord($c{1})-128)*262144 + (ord($c{2})-128)*4096 + (ord($c{3})-128)*64 + (ord($c{4})-128);
    if (ord($c{0}) >= 252 && ord($c{0}) <= 253)
        return (ord($c{0})-252)*1073741824 + (ord($c{1})-128)*16777216 + (ord($c{2})-128)*262144 + (ord($c{3})-128)*4096 + (ord($c{4})-128)*64 + (ord($c{5})-128);
    if (ord($c{0}) >= 254 && ord($c{0}) <= 255)    //  error
        return FALSE;
    return 0;
}   //  function _uniord()

echo "Hello LINE BOT 1. <br>";

$sMessage='ทดสอบ ARL';
$iCount=strlen($sMessage)-1;
$AscMessage="";
                                                                 

//echo mb_strlen($sMessage) . "<br>";                                               
                                                                 
for ($x = 0; $x <= $iCount; $x++) {
    if (ord(substr($sMessage,$x,1)) >122) {   
         echo $x.": ". substr($sMessage,$x,3) . " UTF:" . _uniord(substr($sMessage,$x,3)) . "<br>"; 
         $x=$x+2;
    }else{
        echo $x.": ". substr($sMessage,$x,1). " Asc:" . _uniord(substr($sMessage,$x,1)) . "<br>";      
    }
    //echo "The number is: $x string: " . substr($sMessage,$x,1) . " Asc:" . ord(substr($sMessage,$x,1)) . "<br>";
    //$AscMessage.=substr("000".ord(substr($sMessage,$x,1)),-3,3);
    //echo substr("000".ord(substr($sMessage,$x,1)),-3,3). "<br>";
}
echo ord('ท')."<br>";
echo ord('ด')."<br>";

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
