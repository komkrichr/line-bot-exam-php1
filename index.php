<?php

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

echo "Hello LINE BOT 7. <br>";

$sMessage='กข อฮ ดีดี่ดี้ดี๊ดี๋ ABXYZ 0189';

$iCount=strlen($sMessage)-1;
$AscMessage="";
                                                                 

$offset = 0;
$AsCon=3424;
echo "$sMessage <br>";

while ($offset >= 0) {
        $AscMessage.=ordutf8($sMessage, $offset)."|";
        //echo $offset.": UNI:".ordutf8($sMessage, $offset)."<br>";
}

echo "----- <br>";
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
