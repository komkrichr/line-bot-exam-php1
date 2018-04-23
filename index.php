<?php
echo "Hello LINE BOT";

$sMessage='พญาไทย ARL';
$iCount=strlen($sMessage);

echo "$sMessage <br>";
for ($x = 0; $x <= $iCount; $x++) {
    echo "The number is: $x string: " . substr($sMessage,$x,1) . " Asc:" . ord(substr($sMessage,$x,1)) . "<br>";
} 
?>
