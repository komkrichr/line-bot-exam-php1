<?php


$url = parse_url(getenv("mysql://b4eebb1ab31fba:8b0430ea@us-cdbr-iron-east-05.cleardb.net/heroku_a797b8e9f9df240?reconnect=true"));
$server = "us-cdbr-iron-east-05.cleardb.net";
$username = "b4eebb1ab31fba";
$password = "8b0430ea";
$db = "heroku_a797b8e9f9df240";

$conn = new mysqli($server, $username, $password, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error."<br>");
}
    
//$sql = "CREATE TABLE MyGuests (line_id varchar(100) not null,user_name varchar(200)) ";
//if ($conn->query($sql) === TRUE) {
//}

//$sql = "insert into MyGuests(line_id,user_name) values('xxxxx','xxxxxx')";
//if ($conn->query($sql) === TRUE) {
//    echo "Insert successfully";
//} else {
//    echo "Error : " . $conn->error ."<br>";
//}
    //*** PROMOTION SEND AND KEEP LOG DB ***//
    $sql = "SELECT * FROM product_price ";
    $result = $conn->query($sql);
    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
        printf("Product ", $row["product_id"], $row["product_price_id"]);
    }
$conn->close();

echo "Connected successfully"."<br>";
?>
