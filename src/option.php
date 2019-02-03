<html land = "en">
<head>
  <title>GRK Clothing Warehouse</title>
  <h1>GRK Clothing Warehouse<h1>
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
  <h1>Options<h1>
  <style>
    body{
      padding-top: 40px;
      padding-bottom: 40px;
      background-color: lightblue;
    }

  </style>
  <script>
  function goBack(){
	  window.history.back()
  }
  </script>
</head>
<?php
  $input = "";
?>
<body>
  <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post">
    <select name = "action">
      <option value = ""> Select.. </option>
      <option value = "search_store">Store Inventory </option> <!-- Done -->
      <option value = "search_for_Item">Search Items </option> <!-- Done -->
      <option value = "update_quant">Update Item Quantities (admins only)</option> <!-- Done -->
      <option value = "new_item">Add New Items (admins only)</option> <!-- Done -->
      <option value = "add_shops"> Manage Shops (admins only)</option>
      <option value = "manage employees"> Manage Employees (admins only)</option> <!-- Done -->
      <option value = "profile">Profile</option> <!--Kevin's Working on this -->
    </select>
    <input type = "submit">
  </form>

    <h4>Return to Menu</h4>
  <form action = "website.php">
	<Button type = "return">Return</Button>
</form>
 
  <!-- Manage redirect -->
  <!-- Still need to implement some of these pages + queries -->
  <?php
    $conn = mysqli_connect("localhost","root","root1234","grk");
    session_start();
    $userTransfer = $_SESSION["user"];
    $jack = $_POST["action"];

    if ($jack == "search_store"){
      header("Location:search.php");
    }
    if($jack == "profile"){

      $_SESSION["t1"] = $userTransfer;
      header("Location:profile.php");
    }

    if( $jack == "search_for_Item"){
      header("Location:look_for_item.php");
    }
    if ( $jack == "manage employees"){
      //admin only thing
      $result = mysqli_query($conn, "SELECT isAdmin FROM `account` WHERE `account`.username = '".$userTransfer."'");
      $row = mysqli_fetch_array($result);
      if($row["isAdmin"] == True){
        header("Location:modEmployee.php");
      }
      else{
        echo "You are not an Admin";
      }
    }

    if( $jack == "update_quant"){

      //admin only thing
      $result = mysqli_query($conn, "SELECT isAdmin FROM `account` WHERE `account`.username = '".$userTransfer."'");
      $row = mysqli_fetch_array($result);
      if($row["isAdmin"] == True){
        header("Location:updateQuant.php");
      }
      else{
        echo "You are not an Admin";
      }

    }
    if($jack == "new_item"){

      //admin only thing
      $result = mysqli_query($conn, "SELECT isAdmin FROM `account` WHERE `account`.username = '".$userTransfer."'");
      $row = mysqli_fetch_array($result);
      if($row["isAdmin"] == True){
        header("Location:addItem.php");
      }
      else{
        echo "You are not an Admin";
      }
    }

    if($jack == "add_shops"){

      //admin only thing
      $result = mysqli_query($conn, "SELECT isAdmin FROM `account` WHERE `account`.username = '".$userTransfer."'");
      $row = mysqli_fetch_array($result);
      if($row["isAdmin"] == True){
        header("Location:addShops.php");
      }
      else{
        echo "You are not an Admin";
      }
    }




  ?>

</body>
