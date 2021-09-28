<?php
include 'header.html';
   try { 
$pdo = new PDO('mysql:host=localhost;dbname=videos; charset=utf8', 'root', ''); 
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = 'SELECT * FROM customer';
$result = $pdo->query($sql); 

echo "<br /><b>A Quick View</b><br><br>";
echo "<table border=1>";
echo "<tr><th>User Id</th>
<th>FirstName:</th><th>Delete</th><th>Update:</th></tr>";


while ($row = $result->fetch()) {
echo '<tr><td>' . $row['custid'] . '</td><td>'. $row['name'] . '</td>';
echo "<td><a href=\"delete.php?custid=".$row['custid']."\">Remove</a></td>";
      echo "<td><a href=\"updateform.php?custid=".$row['custid']."\">Update</a></td>";
      echo "</tr>";




}
echo '</table>';
} 
catch (PDOException $e) { 
$output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine(); 
}




?>