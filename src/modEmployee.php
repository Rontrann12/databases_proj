<html>
<head>
  <title>GRK Clothing Warehouse</title>

  <h1>GRK Modify Employees<h1>

  <style>
    body{
      padding-top: 0px;
      padding-bottom: 40px;
      background-color: lightblue;
    }

  </style>
</head>

<h2> Modify Employee Information</h2>
<h3>Fill In All Fields</h3>
<form action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
<!--Ssn:<input type="hidden" name="Ssn">-->

Ssn: <select name="ssn" class="form-control">
<?php
$con=mysqli_connect("localhost", "root", "root1234", "grk");
$sql = mysqli_query($con, "SELECT ssn FROM employee");
$row = mysqli_num_rows($sql);
while ($row = mysqli_fetch_array($sql)){
echo "<option value='". $row['ssn'] ."'>" .$row['ssn'] ."</option>" ;
}
?>
</select>
<br>
First Name: <input type="text" name="Fname"><br>
Last Name: <input type="text" name="Lname"><br>
Salary: <input type="text" name="Salary"><br>
Home Address: <input type="text" name="Address"><br>
Hours: <input type="text" name="Hours1"><br>
Job Type: <select name="type">
	<option value="Worker">Worker</option>
	<option value="IT">I.T.</option>
	<option value="Marketer">Marketer</option>
	</select>
	<br>
<input type="submit" name="mod">
</form>

<h3> Add Employee</h3>
<form method = "post" action = "addEmployee.php">
<Button type = "add">Add</button>
</form>

<h3> Delete Employee</h3>
<form method = "post" action = "deleteEmployee.php">
<Button type = "delete">Delete</Button>
</form>

<?php
$con=mysqli_connect("localhost", "root", "root1234", "grk");
//Check connection
if(mysqli_connect_errno())
{
	echo "Failed to connect to MYSQL: " .mysqli_connect_error();
}

$ssn = $_POST['ssn'];
$fname = $_POST['Fname'];
$lname = $_POST['Lname'];
$salary = $_POST['Salary'];
$address = $_POST['Address'];
$hour = $_POST['Hours1'];
$type = $_POST['type'];

if($fname != ""){
	$sql = "UPDATE `employee` SET `employee`.fname = '".$fname."' WHERE `employee`.ssn = '".$ssn."'";
	$result = $con->query($sql);
}
if($lname != ""){
	$sql = "UPDATE `employee` SET `employee`.lname = '".$name."' WHERE `employee`.ssn = '".$ssn."'";
	$result1 = $con->query($sql);
}
if($salary != ""){
	$sql = "UPDATE `employee` SET `employee`.salary = '".$salary."' WHERE `employee`.ssn = '".$ssn."'";
	$result2 = $con->query($sql);
}
if($address != ""){
	$sql = "UPDATE `employee` SET `employee`.address = '".$address."' WHERE `employee`.ssn = '".$ssn."'";
	$result3 = $con->query($sql);
}
if($hour != ""){
	$sql = "UPDATE `employee` SET `employee`.hours = '".$hour."' WHERE `employee`.ssn = '".$ssn."'";
	$result4 = $con->query($sql);
}
if($type != ""){
	$sql = "UPDATE `employee` SET `employee`.jobtype = '".$type."' WHERE `employee`.ssn = '".$ssn."'";
	$result5 = $con->query($sql);	
}

$con->close();
?>

<h4>Return to Options</h4>
<form method="post" action="option.php">
  <Button type = "submit">Return</Button>
</form>