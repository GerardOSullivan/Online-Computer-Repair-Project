<?php
include 'header.html';
?>
    <img class="float-left main-images" src="images/delete-image.png" alt="Big-X-image"><!-- I took this image from this website https://www.google.com/search?q=big+x+png+imagesize:100x100&sxsrf=ALeKk01bLj_Bdn0bIPJHVICVrieUm5knKQ:1606860761657&source=lnms&tbm=isch&sa=X&ved=2ahUKEwjpo5vn5q3tAhXCQxUIHYleCHIQ_AUoAXoECBQQAw&biw=1920&bih=880#imgrc=LKATf7FQkcoeRM-->
    <h2  class="float-left small-margin">Delete <span class="orange-span">Customer</span> Details?</h2>
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

      echo '<p class="float-left info-align">Customer ID: '.$row['CustomerID'].
      '<br>Name: ' . $row['FirstName'] . ' ' . $row['LastName'] .
      '<br>Email: '. $row['Email'] .
      '<br>Are you sure you want to delete this customer ??</p>
      <form style="padding-left:120px;"action="deletecustomer.php" method="post">
            <input type="hidden" name="id" value="'.$row['CustomerID'].'">
            <input class="formButtons formHover" type="submit" value="Delete Customer Details" name="delete">
            <a class="formButtons" href="Customer.php">Go back to Customer page</a>
        </form>';

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
