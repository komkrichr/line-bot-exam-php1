<?php



require "vendor/autoload.php";

$access_token = 'D72+jpfVSwYVT6aMhV4iWkotVP+RN08p0pslpXb4d7sKiNxPZeZ3nNIUoavXY7Ix1CM/h1AxwrVjrKItQc0kpqXjnRyieff+4iIKR+XSglPUas6F2BsDP3mRt9hyNN1iWNPF6sqBt9ayF4YXogZC3AdB04t89/1O/w1cDnyilFU=';

$channelSecret = 'afbe8fe1ddb3e69302cf90e9d869d80b';

$pushID = 'Uc49a693b962b98a4f675febdcfcea570';

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello world');
$response = $bot->pushMessage($pushID, $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();







