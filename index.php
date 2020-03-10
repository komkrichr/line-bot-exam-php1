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

    $sql = "SELECT product_price.product_id,product.product_name,product_price.product_size_id ";
    $sql = $sql." ,product_size.product_size_name,product_price.product_price ";
    $sql = $sql." FROM product_price ";
    $sql = $sql." LEFT JOIN product on product.product_id=product_price.product_id ";
    $sql = $sql." LEFT JOIN product_size on product_size.product_size_id=product_price.product_size_id ";
    $sql = $sql." order by product_order_no,product_id ";
    //echo $sql."<br>";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "" . $row["product_name"]. " Size: " . $row["product_size_name"]. " " . $row["product_price"]. "<br>";
        }
    }

$conn->close();

echo "<br><br>Connected successfully"."<br>";
?>
