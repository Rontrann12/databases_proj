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
    }
  ?>

  <h3> Enter the item that you want to search for: </h3>
  <form method = "post" action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Search: <input type = "text" name = "the_item"><br>
    <input type = "submit">
  </form>

<?php
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    //need to check that the item exists in the data base
    $input = $_POST["the_item"];
    $result = mysqli_query($conn, "SELECT * FROM `items` WHERE `items`.name LIKE '%".$input."%'");

    if($result->num_rows == 0){
      echo "There are no results for ".$input;
    }
    else{
      //save the name of the item in a local variable
      $row = mysqli_fetch_array($result);
      $item_name = $row["name"];

      echo "Returning results for ";
      echo $input;
      echo "<br>";

      //return the stores that have this item
      $result = mysqli_query($conn, "SELECT `items`.name, `shops`.name, `shops`.location FROM `shops`,`have`,`items` WHERE `items`.name LIKE '%".$input."%' AND `items`.product_id = `have`.product_id AND `have`.location = `shops`.location");

      while($row = mysqli_fetch_array($result)){
        echo "Item: ".$row[0].", Store Name: ".$row[1].", Address:   ". $row[2]."<br>";
      }

    }
  }

 ?>

 <h3>Return to Options</h3>
 <form method = "post" action = "option.php">
   <Button type = "submit">Return </Button>
 </form>

</body>

</html>
