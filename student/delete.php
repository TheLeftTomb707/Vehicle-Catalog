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

$delete = "DELETE FROM vehicles WHERE id = $id";

if ($conn->query($delete) === TRUE) {
} else {
  echo "Error deleting record: " . $conn->error;
}
  header("location: index.php");
?>