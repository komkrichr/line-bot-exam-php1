<?php

$Data="Warp Driver: 🇺🇸 #100IV 💯 Turtwig CP1102 IV100.0 LVL35
COORDINATES 🔽
42.588611,-88.359865
GOOGLE MAPS 🔽
https://t.co/IUnQ2uQ37J";


$line = split("\\n", $Data);
echo $line[0];
echo $line[1];
echo $line[3];
?>
