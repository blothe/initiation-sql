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

<h3 style="text-decoration:underline">Répartition et nombre d'enregistrements par état :</h3>
<p style="text-align:justify">
<?php
$stmt = $conn->query("SELECT country_code, COUNT(country_code) FROM `data` GROUP BY country_code ORDER BY COUNT(country_code) ASC");
while ($result = $stmt->fetch())
{
  echo "<span>" . $result['country_code'] . "&nbsp;(" . $result['COUNT(country_code)'] . ")&nbsp;" . "| </span>";
}
echo "TERMINÉ";
?>
</p>

<h3 style="text-decoration:underline">Insertion d'une nouvelle entrée, màj e-mail, puis suppression :</h3>
<p style="text-align:justify">
<?php
$stmt = $conn->query("INSERT INTO `data` (first_name, last_name, email, gender, ip_address, birth_date, zip_code, avatar_url, state_code, country_code) VALUES ('Sam', 'Bell', 'sam.bell@moon.net', 'Male', '', '', '', 'https://raw.githubusercontent.com/baptl/cv/master/img/sam_gerty.jpg', '', '')");
$stmt = $conn->query("SELECT first_name, last_name, email FROM `data` WHERE email = 'sam.bell@moon.net'");
while ($result = $stmt->fetch())
{
  echo "<span>*** NOUVELLE ENTRÉE *** " . $result['first_name'] . "&nbsp;" . $result['last_name'] . "&nbsp;:&nbsp;" . $result['email'] . " | </span>";
}
echo "TERMINÉ ";
$stmt = $conn->query("UPDATE `data` SET email = 'sam.bell@earth.net' WHERE email = 'sam.bell@moon.net'");
$stmt = $conn->query("SELECT first_name, last_name, email FROM `data` WHERE email = 'sam.bell@earth.net'");
while ($result = $stmt->fetch())
{
  echo "<span>*** MISE À JOUR DE L'EMAIL *** " . $result['first_name'] . "&nbsp;" . $result['last_name'] . "&nbsp;:&nbsp;" . $result['email'] . " | </span>";
}
echo "TERMINÉ ";
$stmt = $conn->query("DELETE FROM `data` WHERE email = 'sam.bell@earth.net'");
echo "*** ENTRÉE SUPPRIMÉE ***";
?>
</p>

<h3 style="text-decoration:underline">Répartition par genre :</h3>
<p style="text-align:justify">
<?php
$stmt = $conn->query("SELECT gender, COUNT(gender) FROM `data` GROUP BY gender ORDER BY COUNT(gender) ASC");
while ($result = $stmt->fetch())
{
  echo "<span>" . $result['gender'] . "&nbsp;(" . $result['COUNT(gender)'] . ")&nbsp;" . "| </span>";
}
echo "TERMINÉ";
?>
</p>



<?php
// close the connection
$conn = null;
?>
