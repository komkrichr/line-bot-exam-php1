<?php


$url = parse_url(getenv("mysql://b4eebb1ab31fba:8b0430ea@us-cdbr-iron-east-05.cleardb.net/heroku_a797b8e9f9df240?reconnect=true"));
$server = "us-cdbr-iron-east-05.cleardb.net";
$username = "b4eebb1ab31fba";
$password = "8b0430ea";
$db = "mydb";

$conn = new mysqli($server, $username, $password, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "insert into user(line_id,user_name) values('xxxxx','xxxxxx')";
if ($conn->query($sql) === TRUE) {
    echo "Insert successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();

echo "Connected successfully"
?>
