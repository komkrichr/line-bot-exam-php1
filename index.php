<?php
echo "Hello LINE BOT V1. <br>";

$sMessage='Sพญาไทย ARLE';
$iCount=strlen($sMessage)-1;
$AscMessage="";
echo "$sMessage <br>";
for ($x = 0; $x <= $iCount; $x++) {
    echo "The number is: $x string: " . substr($sMessage,$x,1) . " Asc:" . ord(substr($sMessage,$x,1)) . "<br>";
    $AscMessage.=substr("000".ord(substr($sMessage,$x,1)),-3,3);
    //echo substr("000".ord(substr($sMessage,$x,1)),-3,3). "<br>";
} 
echo $AscMessage;
?>
