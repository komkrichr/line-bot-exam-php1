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
    

    $sql = "SELECT product_price.product_id,product_price.product_price_id,product_price.product_price ";
    //$sql = .",product.product_name";
    $sql = ." FROM product_price ";
    //$sql = ." LEFT JOIN product on product.product_id=product_price.product_id ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "id: " . $row["product_id"]. " - Name: " . $row["product_price_id"]. " " . $row["product_price"]. "<br>";
        }
    }


$conn->close();

echo "Connected successfully"."<br>";
?>
