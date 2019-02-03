<html>

<head>
  <title>GRK Clothing Warehouse</title>
  <h1>Add new Item</h1>

  <style>
    body{
      padding-top: 0px;
      padding-bottom: 40px;
      background-color: lightblue;
    }

  </style>
</head>

<body>


<?php
  //establish a connection with the data base
  $conn = mysqli_connect("localhost","root","root1234","grk");
  if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: ".mysqli_connect_error();
  }
?>

<h2>Item Information</h2>
<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post">
  Name: <input type = "text" name = "item_name"><br>
  Product ID: <input type = "text" name = "prodID"><br>
  Price: <input type = "text" name = "price"><br>
  Quantity: <input type = "text" name = "quant"><br>

  <input type = "submit">
</form>

<?php

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    //Error checking (if item name already exists)
    $item = mysqli_query($conn, "SELECT * FROM `items` WHERE `items`.name = '".$_POST["item_name"]."'");
    $pID = mysqli_query($conn, "SELECT * FROM `items` WHERE `items`.product_id = '".$_POST["prodID"]."'");
    if($item->num_rows>0){
      echo $_POST["item_name"];
      echo " already exists in the Database";
    }
    else if($pID->num_rows>0){
      echo "Product ID must be unique ";
      echo $_POST["prodID"];
      echo " already exists in the Database";
    }
    else{ //else it is safe to add to the data base

      $insert = mysqli_query($conn, "INSERT INTO `items` VALUES ('".$_POST["item_name"]. "', '".$_POST["prodID"]."', '".$_POST["price"]. "', ".$_POST["quant"]. ")" );
      echo "Item has been added to the database";
    }
  }
?>

<h3>Return to Options</h3>
<form method="post" action="option.php">
  <Button type = "submit">Return</Button>
</form>

</body>
</html>
