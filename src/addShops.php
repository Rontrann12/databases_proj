<html>

<head>
  <title>GRK Clothing Warehouse</title>
  <h1>Manage Shops</h1>

  <style>
    body{
      padding-top: 0px;
      padding-bottom: 40px;
      background-color: lightblue;
    }

  </style>
</head>

<?php

  //establish connection with data base
  $conn = mysqli_connect("localhost","root","root1234","grk");
  if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
 ?>

<body>
<h3>Add Shop<h3>
  <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post">
    Store Name: <input type = "text" name = "sName"><br>
    Location: <input type = "text" name = "location"><br>
    <input type = "submit">
  </form>

<?php
  //error checking
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $result = mysqli_query($conn, "SELECT * FROM `shops` WHERE `shops`.location = '".$_POST["location"]."'");
    if($result->num_rows>0){

    }
    else{
      //add the store name and location to the data base
      $insert = mysqli_query($conn, "INSERT INTO `shops` VALUES ( '" .$_POST["location"]. "', NULL,NULL,NULL, '" . $_POST["sName"]. "')");
      echo "Added new shop to the data base (Some values may need to be edited, go to edit shops to edit)";

    }
  }


?>

<h3>Edit Shops <h3>
  <form method="post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Store Name:   <select name="store_name" class="form-control">
	<?php
		$con=mysqli_connect("localhost", "root", "root1234", "grk");
		$sql = mysqli_query($con, "SELECT * FROM shops");
		$row = mysqli_num_rows($sql);
		while ($row = mysqli_fetch_array($sql)){
			echo "<option value='". $row['name'] ."'>" .$row['name'] ."</option>" ;
		}
	?>
	</select>
	<br>
    Number of Employees: <input type="text" name = "num_employees"><br>
    Profit: <input type = "text" name = "profit2"><br>
    Revenue: <input type = "text" name = "revenue2"><br>
    <input type = "submit">
  </form>
<?php
  //Error checking
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $result = mysqli_query($conn,"SELECT * FROM `shops` WHERE `shops`.location = '".$_POST["loc"]."'");
    if($result->num_rows == 0){
      echo " There is no shop at this location";
    }
    else{
      $insert = mysqli_query($conn,"UPDATE `shops` SET `shops`.number_of_employee = ".$_POST["num_employees"].", `shops`.profit = ".$_POST["profit2"]. ", `shops`.revenue = ".$_POST["revenue2"]." WHERE `shops`.location = '".$_POST["loc"]. "'");
      echo "Updated store information";
    }
  }

?>

<h3> Update Shop Inventory </h3>
<form method = "post" action "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  Store Name: <select name="store_name" class="form-control">
	<?php
		$con=mysqli_connect("localhost", "root", "root1234", "grk");
		$sql = mysqli_query($con, "SELECT * FROM shops");
		$row = mysqli_num_rows($sql);
		while ($row = mysqli_fetch_array($sql)){
			echo "<option value='". $row['location'] ."'>" .$row['name'] ."</option>" ;
		}
	?>
	</select>
	<br>
  New Product ID: <input type = "text" name = "product_ID"><br>
  <input type = "submit">
</form>

<?php

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    //Error checing
    $result = mysqli_query($conn,"SELECT * FROM `shops` WHERE `shops`.location = '".$_POST["store_name"]."'");
    $row = mysqli_fetch_array($result);
    echo $_POST["store_name"];
    if($result->num_rows == 0){
      echo "There are no shops at that location";
    }
    else {
      //Add new product
      $result = mysqli_query($conn,"INSERT INTO `have` VALUES ('" .$_POST["store_name"]."', '" .$_POST["product_ID"]."')");
      echo $_POST["product_ID"];
	  echo "Item added";
    }
  }
?>

<h3>Return to Options<h3>
<form action = "option.php" method="post">
  <Button type = "submit">Return</Button>
</form>


</body>
