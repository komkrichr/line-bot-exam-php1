<html>

<head>
<title>Freshme</title>
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

	table {
	  border-collapse: collapse;
	  width: 100%;
	}

	th, td {
	  text-align: left;
	  padding: 8px;
	}
	tr:nth-child(even) {background-color: #f2f2f2;}

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
<br><br>
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

if ($_GET["ClearMembers"]=="Y")
{
	$sql = "truncate table line_staffs";
        if ($conn->query($sql) === TRUE) {
            echo "Clear All Data";
        } else {
            echo "Error : " . $conn->error;
        }	
}
if ($_GET["ClearGroups"]=="Y")
{
	$sql = "truncate table line_groups";
        if ($conn->query($sql) === TRUE) {
            echo "Clear All Data";
        } else {
            echo "Error : " . $conn->error;
        }	
}
	
$sql = "SELECT * ";
$sql = $sql." FROM line_staffs ";
$sql = $sql." order by first_name+last_name ";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
	// output data of each row
	echo "<div style='overflow-x:auto;'>";
	echo "<table>";
	echo "<tr><th>No</th>";
	echo "<th>Display</th>";
	echo "<th>Name</th>";
	echo "<th>ID</th>";
	echo "</tr>";
	
	$count=0;
	while($row = $result->fetch_assoc()) {
	    $count++;
	    echo "<tr><td>".$count."</td>";
  	    echo "<td>".$row["display_name"]."</td>";	
	    echo "<td>".$row["first_name"]." ".$row["first_name"]."</td>";		
	    echo "<td>".$row["line_id"]."</td></tr>";	
	}
	echo "</table>";
	echo "</div>";
}

?>
<br><br>
</form>
</body>
</html>
	
