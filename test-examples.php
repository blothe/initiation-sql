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
<h3 style="text-decoration:underline">Liste des personnes dont le nom de famille est Palmer :</h3>
<p style="text-align:justify">
<?php
$stmt = $conn->query("SELECT last_name, first_name FROM `data` WHERE last_name = 'Palmer'");
while ($result = $stmt->fetch())
{
  echo "<span>" . $result['last_name'] . "&nbsp;" . $result['first_name'] . "&nbsp;| </span>";
}
echo "TERMINÉ";
?>
</p>

<h3 style="text-decoration:underline">Liste des femmes :</h3>
<p style="text-align:justify">
<?php
$stmt = $conn->query("SELECT last_name, first_name FROM `data` WHERE gender = 'female'");
while ($result = $stmt->fetch())
{
  echo "<span>" . $result['last_name'] . "&nbsp;" . $result['first_name'] . "&nbsp;| </span>";
}
echo "TERMINÉ";
?>
</p>

<h3 style="text-decoration:underline">Liste des états dont le code commence par la lettre "N" :</h3>
<p style="text-align:justify">
<?php
$stmt = $conn->query("SELECT DISTINCT country_code FROM `data` WHERE country_code REGEXP '^N'");
while ($result = $stmt->fetch())
{
  echo "<span>" . $result['country_code'] . "&nbsp;| </span>";
}
echo "TERMINÉ";
?>
</p>

<h3 style="text-decoration:underline">Liste des adresses e-mail contenant le mot "Google" :</h3>
<p style="text-align:justify">
<?php
$stmt = $conn->query("SELECT email FROM `data` WHERE email REGEXP 'google'");
while ($result = $stmt->fetch())
{
  echo "<span>" . $result['email'] . "&nbsp;| </span>";
}
echo "TERMINÉ";
?>
</p>



<?php
// close the connection
$conn = null;
?>
