<?php INCLUDE "header.php" ?>
<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vcatalog";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$id = $_GET['id'];
$info = "SELECT make, model, cyear, color, vin, img FROM vehicles WHERE id='$id'";
$rinfo = $conn->query($info);

if ($rinfo->num_rows > 0) {
  // output data of each row
  while($row = $rinfo->fetch_assoc()) {
    echo "<div class='page upp'>
    <h1 id='uptitle'>Update for ID:$id</h1>
    <form method='post'>
    <label for='make'>Make:</label><br>
    <input type='text' name='make' id='make' value='$row[make]' required><br>
    <label for='model'>Model:</label><br>
    <input type='text' name='model' id='model' value='$row[model]' required><br>
    <label for='cyear'>Year:</label><br>
    <input type='number' name='cyear' id='cyear' value='$row[cyear]' required><br>
    <label for='color'>Color:</label><br>
    <input type='text' name='color' id='color' value='$row[color]' required><br>
    <label for='vin'>VIN:</label><br>
    <input type='text' name='vin' id='vin' minlength='17' maxlength='17' value='$row[vin]' required><br>
    <th><label for='img'>Image:</label></th><br>
    <td><input type='text' name='img' id='img' value='$row[img]'></td><br><br>
    <button type='submit'>Submit</button>
    </form>
    </div>
    <a id='back' href='index.php'>&larr;</a>";
  }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$make = $_REQUEST['make'];
$model = $_REQUEST['model'];
$cyear = $_REQUEST['cyear'];
$color = $_REQUEST['color'];
$vin = $_REQUEST['vin'];
$upvin = strtoupper($vin);
$img = $_REQUEST['img'];
$update = "UPDATE vehicles SET make='$make', model='$model', cyear='$cyear', color='$color', vin='$upvin', img='$img' WHERE id=$id";

if ($conn->query($update) === TRUE) {
} else {
  echo "Error updating record: " . $conn->error;
}
header("location: index.php");
};
?>
<?php INCLUDE "footer.php" ?>