<?php INCLUDE "header.php" ?>
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
    <h1 id='viewtitle'>Viewing $row[make] $row[model]</h1>
    <div id='wrap'>
        <img src='../img/$row[img]' width='550vw' alt='$row[model] Img'>
        <div>
            <h4>$row[make]</h4>
            <h3>$row[model]</h3><br>
            <h5>$row[cyear]</h5><br>
            <h5>$row[color]</h5><br><br><br>
            <h6>$row[vin]</h6>
        </div>
    </div>
    <a id='back' href='index.php'>&larr;</a>
    </div>";
  }
}
?>
<?php INCLUDE "footer.php" ?>