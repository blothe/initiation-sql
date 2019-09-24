<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mysql_exercices";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
  echo "Connection failed: " . $e->getMessage();
}

?>
<h3>Liste des personnes dont le nom de famille est Palmer :</h3>
<?php
$stmt = $conn->query("SELECT last_name, first_name FROM `data` WHERE last_name = 'Palmer'");
while ($result = $stmt->fetch())
{
  echo "<li>" . $result['last_name'] . " " . $result['first_name'] . "</li>";
}
?>



<?php
// close the connection
$conn = null;
?>
