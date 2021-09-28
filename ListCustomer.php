<?php
include 'header.html';
?>
    <img class="float-left main-images" src="images/list-Image.png" alt="list-image"><!-- I took this image from this website https://www.google.com/search?q=list+png&tbm=isch&ved=2ahUKEwi2j-2r6a3tAhWUtnEKHRHWDsUQ2-cCegQIABAA&oq=list+png&gs_lcp=CgNpbWcQAzIECCMQJzICCAAyAggAMgIIADICCAAyAggAMgIIADICCAAyAggAMgIIAFDtugJYl7wCYJW-AmgAcAB4AIABLogBVpIBATKYAQCgAQGqAQtnd3Mtd2l6LWltZ8ABAQ&sclient=img&ei=gsLGX7bGHJTtxgORrLuoDA&bih=937&biw=1920#imgrc=HxkPWVitQs8LIM-->
    <h2  class="float-left small-margin">Customer <span class="orange-span">Details</span> displayed</h2>
<?php
try {
require('LoginFunction.php');
$sql = 'SELECT count(*) FROM customer where CustomerID = :cid';
$result = $pdo->prepare($sql);
$result->bindValue(':cid', $_GET['CustomerID']);
$result->execute();

if($result->fetchColumn() > 0)
{
    $sql = 'SELECT * FROM customer where CustomerID = :cid';
    $result = $pdo->prepare($sql);
    $result->bindValue(':cid', $_GET['CustomerID']);
    $result->execute();

while ($row = $result->fetch()) {

      echo '<p class="float-left allign-Textbox">Customer ID: '.$row['CustomerID'].
      '<br>First Name: ' . $row['FirstName'] .
      '<br>Last Name: ' . $row['LastName'] .
      '<br>Email: '. $row['Email'] .
      '<br>Address: '. $row['Address'];

      if($row['Eircode'] != null)
      {
        echo'<br>Eircode: '. $row['Eircode'];
      }
      else{
        echo'<br>Eircode: Customer has not provided an Eircode';
      }
      echo'<br>Phone Number: '. $row['PhoneNumber'] .
      '<br><br><a class="formButtons" href="Customer.php">Go back to Customer page</a>';

   }
}
else {
      echo '<p class="float-left info-align">No rows matched the query. Click <a href="Customer.php">here</a> to go back to customer page</p>';
    }}
catch (PDOException $e) {
$output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
}
include 'footer.html';
?>
