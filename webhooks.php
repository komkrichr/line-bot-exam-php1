<?php

require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

$channelAccessToken = '1653577809';
$channelSecret = '69d91fafb082e44307f374646698b32b';
$client = new LINEBotTiny($channelAccessToken, $channelSecret);


foreach ($client->parseEvents() as $event) {

};

echo "<br>LINEBotTiny-2";
?>
