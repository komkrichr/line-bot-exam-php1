<?php
echo "Hello LINE BOT";

$sMessage='พญาไทย ARL';
$iCount=strlen($sMessage);

echo "$sMessage <br>";
for ($x = 0; $x <= $iCount; $x++) {
    echo "The number is: $x " + substr($sMessage,$x,1) +"<br>";
} 
?>
