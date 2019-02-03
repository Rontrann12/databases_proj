<html>
<head>
  <title>GRK Clothing Warehouse</title>

  <h1>GRK Delete Employee<h1>

  <style>
    body{
      padding-top: 0px;
      padding-bottom: 40px;
      background-color: lightblue;
    }

  </style>
</head>

<h2>Employee ssn</h2>

<form action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

<select name="ssn">
<?php
$con=mysqli_connect("localhost","root","root1234", "grk");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql = mysqli_query($con, "SELECT * FROM employee");

while ($row = $sql->fetch_assoc()){
	echo '<option value="'.$row['ssn'].'">'.$row['ssn'].'</option>';
}
?>
<form>
</select>
<Button type="Delete" >Delete</Button>
</form>

<?php
$con=mysqli_connect("localhost","root","root1234", "grk");
// Check connection
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$ssn = $_POST['ssn'];
$sql = "DELETE FROM employee WHERE ssn =" .$ssn;

if ($con->query($sql) == TRUE) {
    echo "Employee Deleted";
} else {
    echo "Could not delete employee";
}

$con->close();
?>

<h4>Return to Options</h4>
<form method="post" action="option.php">
  <Button type = "submit">Return</Button>
</form>