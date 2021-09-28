<?php
include 'headerRepairs.html';
?>
    <img class="float-left main-images" src="images/list-Image.png" alt="list-image"><!-- I took this image from this website https://www.google.com/search?q=list+png&tbm=isch&ved=2ahUKEwi2j-2r6a3tAhWUtnEKHRHWDsUQ2-cCegQIABAA&oq=list+png&gs_lcp=CgNpbWcQAzIECCMQJzICCAAyAggAMgIIADICCAAyAggAMgIIADICCAAyAggAMgIIAFDtugJYl7wCYJW-AmgAcAB4AIABLogBVpIBATKYAQCgAQGqAQtnd3Mtd2l6LWltZ8ABAQ&sclient=img&ei=gsLGX7bGHJTtxgORrLuoDA&bih=937&biw=1920#imgrc=HxkPWVitQs8LIM-->
    <h2  class="float-left small-margin">Repair <span class="orange-span">Details</span> displayed</h2>
<?php
try {
require('LoginFunction.php');
$sql = 'SELECT count(*) FROM repairs where RepairTicketID = :rid';
$result = $pdo->prepare($sql);
$result->bindValue(':rid', $_GET['RepairTicketID']);
$result->execute();

if($result->fetchColumn() > 0)
{
    $sql = 'SELECT * FROM repairs where RepairTicketID = :rid';
    $result = $pdo->prepare($sql);
    $result->bindValue(':rid', $_GET['RepairTicketID']);
    $result->execute();

while ($row = $result->fetch()) {

      echo '<p class="float-left allign-Textbox">Repair ID: '.$row['RepairTicketID'].
      '<br><a href=\'ListCustomer.php?CustomerID='.$row['CustomerID'].'\'>Customer ID: ' . $row['CustomerID'] .'</a>'. /// i did this so you could go straight to the customer details of a particular repair
      '<br>Date Repair Logged: ' . date("d/m/y", strtotime($row['DateRepairLogged'])) . // Got the code to sort the date. It just looks much more profesional to do it this way https://stackoverflow.com/questions/2671145/convert-to-date-format-dd-mm-yyyy
      '<br>Repair Description: '. $row['RepairDescription'] .
      '<br>Status: '. $row['status'] .
      '<br>Total Cost: &euro;'. $row['totalcost'];

      if($row['DatePaid'] != null)
      {
        echo'<br>Date Paid: '. date("d/m/y", strtotime($row['DatePaid']));
      }
      else {
        echo '<br>Date paid: Customer has not paid yet';
      }

      echo '<br><br><a class="formButtons" href="Repairs.php">Go back to the Repairs page</a>';

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
