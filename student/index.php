<?php INCLUDE "header.php" ?>
<div class="page">
<h1 id="intitle"><b>Vehicle Catalog</b></h1>
<table>
<div id="form">
  <form method="post">
    <tr>
      <th>ID</th>
      <th><label for="fname">Make</label></th>
      <th><label for="lname">Model</label></th>
      <th><label for="email">Year</label></th>
      <th><label for="color">Color</label></th>
      <th><label for="vin">VIN</label></th>
      <th><label for="img">Image</label></th>
      <th>Operations</th>
    </tr>
    <tr>
      <td></td>
      <td><input type="text" name="make" class="ininput" id="make" required></td>
      <td><input type="text" name="model" class="ininput" id="model" required></td>
      <td><input type="number" name="cyear" class="ininput" id="cyear" required></td>
      <td><input type="text" name="color" class="ininput" id="color" required></td>
      <td><input type="text" name="vin" class="ininput" id="vin" minlength="17" maxlength="17" required></td>
      <td><input type="file" name="img" class="ininput" id="img" accept="image/*" required></td>
      <td colspan="3" id="subtd"><button type="submit" id="sub">Submit</button></td>
    </tr>
  </form>
</div>  
<div id="content">
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vcatalog";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

/*$dbase = "CREATE DATABASE vcatalog";
if ($conn->query($dbase) === TRUE) {
  echo "Database created successfully";
}
else {
  echo "Error creating database: " . $conn->error;
}

$table = "CREATE TABLE vehicle (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  make VARCHAR(30) NOT NULL,
  model VARCHAR(30) NOT NULL,
  cyear INT(6) NOT NULL,
  color VARCHAR(30) NOT NULL,
  vin VARCHAR(17),
  img VARCHAR(50)
)";
  
if ($conn->query($table) === TRUE) {
  echo "Table vehicle created successfully";
}
else {
  echo "Error creating table: " . $conn->error;
}*/

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

$make = $_REQUEST['make'];
$model = $_REQUEST['model'];
$cyear = $_REQUEST['cyear'];
$color = $_REQUEST['color'];
$vin = $_REQUEST['vin'];
$upvin = strtoupper($vin);
$img = $_REQUEST['img'];


$newrecord = "INSERT INTO vehicles (make, model, cyear, color, vin, img)
VALUES ('$make', '$model', '$cyear', '$color', '$upvin', '$img')";

if ($conn->query($newrecord) === TRUE) {
}
else {
  echo "Error: " . $newrecord . "<br>" . $conn->error;
}
header("location: index.php");
}
$students = "SELECT id, make, model, cyear, color, vin, img FROM vehicles";
$qstudents = $conn->query($students);
if ($qstudents->num_rows > 0) {
    while($row = $qstudents->fetch_assoc()) {
      echo "<tr><td>$row[id]</td><td>$row[make]</td><td>$row[model]</td><td>$row[cyear]</td><td>$row[color]</td><td>$row[vin]</td><td>$row[img]</td><td><div class='ops'><a href='view.php?id=$row[id]'><button>View</button></a><a href='update.php?id=$row[id]'><button>Update</button></a><a href='delete.php?id=$row[id]'><button>Delete</button></a></div></td></tr>";
    }
}
else {
    echo "<tr><td></td><td colspan='2'>Please input a vehicle.<td></tr>";
}
?>
</div>
</table>
</div>
<?php INCLUDE "footer.php" ?>
