<?php
echo "Fresh me";

$url = parse_url(getenv("mysql://b4eebb1ab31fba:8b0430ea@us-cdbr-iron-east-05.cleardb.net/heroku_a797b8e9f9df240?reconnect=true"));
$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

$conn = new mysqli($server, $username, $password, $db);
echo $server . "<br>";
echo $username . "<br>";
echo $password . "<br>";
echo $db . "<br>";
?>
