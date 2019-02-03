<html>
<head>
  <title>GRK Clothing Warehouse</title>

  <h1>GRK Employee Add<h1>

  <style>
    body{
      padding-top: 0px;
      padding-bottom: 40px;
      background-color: lightblue;
    }

  </style>
</head>
<h1> Add an employee to database</h1>
Fill in the blanks
<form action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
Ssn:<input type="text" name="ssn"><br>
First name:<input type="text" name="fname"><br>
Last name:<input type="text" name="lname"><br>
Salary:<input type="text" name="salary"><br>
Home address:<input type="text" name="address"><br>
Hours<input type="text" name="hour"><br>
Worker Type<select name="type">
	<option value="0"></option>
	<option value="IT">I.T.</option>
	<option value="Worker">Worker</option>
	<option value="Marketer">Marketer</option>
	</select>
	<br>
<input type="submit" name="add">
</form>
</html>

<?php
$con=mysqli_connect("localhost","root","root1234", "grk");
// Check connection
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$ssn = $_POST["ssn"];
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$salary = $_POST["salary"];
$address = $_POST["address"];
$hour = $_POST["hour"];
$work = $_POST["type"];

$sql = "INSERT INTO employee (ssn, fname, lname, salary, address, hours, jobtype)
		VALUES (".$ssn.",'".$fname."','".$lname."', '".$salary."','".$address."',".$hour.",'".$work."')";

$result = $con->query($sql);


$con ->close();
?>

<h4>Return to Options</h4>
<form method="post" action="option.php">
  <Button type = "submit">Return</Button>
</form>