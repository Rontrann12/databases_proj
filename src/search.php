<html>

<head>
  <title>GRK Clothing Warehouse</title>
  <h1>GRK Search Manager</h1>
  
  <?php
  $conn = mysqli_connect("localhost","root","root1234","grk");
  $check = mysqli_query($conn, "SELECT product_id FROM `promotes`");
  $num = mysqli_num_rows($check);
  $num = $num * 5;
loop:
  $adnum = rand(1, $num);
  $allads = mysqli_query($conn, "SELECT filename FROM `advertisement` WHERE `advertisement`.projectNumber = '".$adnum."'");
  if($allads->num_rows == 0) {
	  goto loop;
  }
  $ad = mysqli_fetch_array($allads);
  ?>
  <img src = <?php echo $ad[0]; ?> alt="Test" width="200" height="200">

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
  //connect to the data base
  $conn=mysqli_connect("localhost","root","root1234","grk");
  if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: ".mysqli_connect_error();
  } ?>

  <!-- Should we have a drop down list or search bar? -->
  <!-- Need to return list of products available at the store -->
  <h3>Check inventory of a store<h3>
  <form method ="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <select name="store_name" class="form-control">
	<?php
		$con=mysqli_connect("localhost", "root", "root1234", "grk");
		$sql = mysqli_query($con, "SELECT * FROM shops");
		$row = mysqli_num_rows($sql);
		while ($row = mysqli_fetch_array($sql)){
			echo "<option value='". $row['name'] ."'>" .$row['name'] ."</option>" ;
		}
	?>
	</select>
    <!--Search a Store: <input type "text" name = "store_name"><br>-->
    <!--<input type = "submit"> -->
	
    <select name = "action">
      <option value = ""> Sort by.. </option>
      <option value = "Lowest Quantity">Lowest Quantity</option>
	  <option value = "Highest Quantity">Highest Quantity</option>
      <option value = "Lowest Price">Lowest Price</option>
	  <option value = "Highest Price">Highest Price</option>
    </select>
    <input type = "submit">
  </form>


<?php

  if($_SERVER["REQUEST_METHOD"] == "POST"){

    // need to check that the store exists in the data base
    $input = addslashes($_POST["store_name"]);    //store the input in local variable
    $sortBy = $_POST["action"];		  //action to sort results by
    $result = mysqli_query($conn, "SELECT name FROM `shops` WHERE `shops`.name = '".addslashes($input)	."'"); //Returns store
    //check if there are no results for the search
    if($result->num_rows == 0){
      echo "No items in ".$input;
    }
    else{
      //save the name of the store in a local variable
      $row = mysqli_fetch_array($result);
      $store_name = $row["name"];

      echo "Returning results for ";
      echo $store_name;
      echo "<br>";

	  if($sortBy == "Highest Quantity") {
		$result = mysqli_query($conn, "SELECT * FROM `items`,`shops`,`have` WHERE `shops`.name = '".$store_name. "'" . " AND `shops`.location = `have`.location AND `have`.product_id = `items`.product_id ORDER BY quantity DESC");
	  }
	  // Sort by ascending quantity
	  else if($sortBy == "Lowest Quantity") {
		$result = mysqli_query($conn, "SELECT * FROM `items`,`shops`,`have` WHERE `shops`.name = '".$store_name. "'" . " AND `shops`.location = `have`.location AND `have`.product_id = `items`.product_id ORDER BY quantity ASC");
	  }
	  // Sort by descending price
	  else if($sortBy == "Highest Price") {
		$result = mysqli_query($conn, "SELECT * FROM `items`,`shops`,`have` WHERE `shops`.name = '".$store_name. "'" . " AND `shops`.location = `have`.location AND `have`.product_id = `items`.product_id ORDER BY price DESC");
	  }
	  // Sort by ascending price
	  else if($sortBy == "Lowest Price") {
		$result = mysqli_query($conn, "SELECT * FROM `items`,`shops`,`have` WHERE `shops`.name = '".$store_name. "'" . " AND `shops`.location = `have`.location AND `have`.product_id = `items`.product_id ORDER BY price ASC");
	  }
	  // No Sorting
	  else {
		$result = mysqli_query($conn, "SELECT * FROM `items`,`shops`,`have` WHERE `shops`.name = '".$store_name. "'" . " AND `shops`.location = `have`.location AND `have`.product_id = `items`.product_id");
	  }

	  // ############################### NEED TO FIX ABOVE ###############################

      while($row = mysqli_fetch_array($result)){
        echo $row[0]. ": Price:   ". $row[2].". Quantity:   ". $row[3]. ". Store Address:   ". $row[4]. "<br>";
      }

    }
  }

?>
<h3>Return to Options<h3>
<form method = "post" action = "option.php">
  <Button type = "submit">Return</Button>
</form>


</body>
</html>
