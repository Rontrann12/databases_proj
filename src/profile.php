<html>
<head>
  <title>GRK Clothing Warehouse</title>
  <style>
    body{
      padding-top :5px;
      padding-bottom: 40px;
      background-color: lightblue;
    }


 </style>

</head>

<body>
<h1>Profile</h1>

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
  
<?php
  $conn=mysqli_connect("localhost","root","root1234", "grk");
  // Check connection
  if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  /* ####################### GLOBAL VARIABLES ########################### */
  global $newpassword, $wishlist, $amount_paid, $pay_type;
  $newpassword="";
  $newwishlist="";
  $newamount_paid="";
  $newpay_type="";
  /* ####################### GLOBAL VARIABLES ########################### */
 ?>

 <h3>Account Information</h3>
<?php
	session_start();

	$user = $_SESSION["t1"]; // Username transfered over from option.php
	$account = mysqli_query($conn, "SELECT * FROM `account` WHERE username = '".$user."'");
	if (!$account) {
		printf("Error: %s\n", mysqli_error($conn));
		exit();
    }

	$row = mysqli_fetch_array($account);

	echo "Username: " .$row["username"]. "<br>";
	echo "Wishlist: " .$row["wishlist"]. "<br>";
	echo "Payment Type: " .$row["payment_type"];
	echo "<br>";
?>
 <h3>Edit Account</h3>
 <form method = "post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  New Password: <input type = "password" name = "password"><br>
  Pay Type: <select name = "pay" class = "form-control">
	<option value = ""> None </option>
	<option value = "Debit">Debit</option>
	<option value = "Credit">Credit</option>	
  </select>
  <br>
  Wishlist: <input type = "text" name = "wishlist"><br>
  <input type = "submit">
 </form>
 
  <h3>Logout</h3>
 <form method = "post" action = "website.php">
  <Button type = "Logout">Logout</Button>
 </form>

 <h3>Delete Account</h3>
 <form method = "post" action = deleteAccount.php>
  <Button type = "Delete">Delete</Button>
 </form>
 
  <h3>Return to Options</h3>
 <form method = "post" action = "option.php">
  <Button type = "Back">Return</Button>
 </form>
<?php //Error checking

	session_start();    //need this to send variables

	$newpassword = $_POST["password"];
	$newpay_type = $_POST["pay"];
	$newwishlist = $_POST["wishlist"];
	$user = $_SESSION["t1"]; // Username transfered over from option.php
	$_SESSION["t2"] = $user; // Username to transfer over to deleteAccount.php

    $result = mysqli_query($conn,"SELECT * FROM `account` WHERE username = '".$user."'");
    if (!$result) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
    }

	// password, wishlist, amount_paid, payment_type
	/* Updating profile information */
	// Updating Password
	if ($newpassword != "") {
		$update = mysqli_query($conn, "UPDATE `account` SET password = '".$newpassword."' WHERE username = '".$user."'");
		echo "Password Updated!";
	}
	// Updating Pay_Type
	if ($newpay_type == "" || $newpay_type == "Debit" || $newpay_type == "Credit") {
		$update = mysqli_query($conn, "UPDATE `account` SET payment_type = '".$newpay_type."' WHERE username = '".$user."'");
	}
	// Updating Wish List
	if ($newwishlist != "") {
		$update = mysqli_query($conn, "UPDATE `account` SET wishlist = '".$newwishlist."' WHERE username = '".$user."'");
		echo "Wishlist Updated!";
	}

?>
</body>
</html>
