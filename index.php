<html>

<head>
	<title>Freshme BU</title>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<script language="javascript" src="js/jsfunction.js"></script>
	<script language="javascript" src="js/keypress.js"></script>
  
    <style>
	body {
		font-family: 'Kanit';
		font-size:14;
	}
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
	}
		
	.company_logo {
	  max-width: 300px;
	  margin: auto;
	  text-align: left;
	}
	.card {
	  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
	  max-width: 300px;
	  margin: auto;
	  text-align: center;
	}

	.title {
	  color: grey;
	  font-size: 18px;
	}

	button_click {
	  border: none;
	  outline: 0;
	  display: inline-block;
	  padding: 8px;
	  color: white;
	  background-color: #000;
	  text-align: center;
	  cursor: pointer;
	  width: 100%;
	  font-size: 18px;
	}

	a {
	  text-decoration: none;
	  font-size: 18px;
	  color: black;
	}

	button:hover, a:hover {
	  opacity: 0.7;
	}
	
  </style>
</head>
<body topmargin="10" leftmargin="0" marginheight="0" marginwidth="0" >
<form name="frmdata" method="post" action="index.php">
    
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

    $sql = "update product set product_name='ชานม Signature' where product_id=1"; 	
    $result = $conn->query($sql);

    $sql = "update product set product_name='ชาเขียวจัสมิน' where product_id=4";  	
    $result = $conn->query($sql);
	
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
            echo "<div class='card'>";
            //echo "<img src='images/".$row["product_id"].".jpg' style='width:100%'>";
            echo "<h3>".$row["product_name"]."</h3>";
            echo "<h4>Size : ".$row["product_size_name"]." ".$row["product_price"]." บาท</h4>";		
            echo "</div>";
        }
    }

$conn->close();

?>

</form>
</body>
</html>
	
