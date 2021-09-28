<?php
include 'header.html';
?>
    <img class="float-left main-images" src="images/updated-image.png" alt="Green-tick-image"><!-- I took this image from this website https://www.google.com/search?q=correct+png&tbm=isch&ved=2ahUKEwil7dzX663tAhWMShUIHXrwCRoQ2-cCegQIABAA&oq=correct+png&gs_lcp=CgNpbWcQAzICCAAyAggAMgIIADICCAAyAggAMgIIADICCAAyAggAMgIIADICCAA6BAgAEEM6BggAEAcQHlDyjQFYr5cBYPWYAWgAcAB4AIABMIgBvAKSAQE3mAEAoAEBqgELZ3dzLXdpei1pbWfAAQE&sclient=img&ei=98TGX-WVFYyV1fAP-uCn0AE&bih=880&biw=1920#imgrc=uUGAaR9yBQsiUM-->
    <h2  class="float-left small-margin">Customer <span class="orange-span">Details</span> Updated</h2>
<?php
try {
require('LoginFunction.php');
$sql = 'update customer set FirstName=:cfname, LastName=:clname, Address=:caddress, Eircode=:ceircode, PhoneNumber=:cphone, Email=:cemail WHERE CustomerID = :cid';
$result = $pdo->prepare($sql);
$result->bindValue(':cid', $_POST['ud_id']);
$result->bindValue(':cfname', $_POST['ud_fname']);
$result->bindValue(':clname', $_POST['ud_lname']);
$result->bindValue(':caddress', $_POST['ud_address']);
$result->bindValue(':ceircode', $_POST['ud_eircode']);
$result->bindValue(':cphone', $_POST['ud_phone']);
$result->bindValue(':cemail', $_POST['ud_email']);
$result->execute();

$count = $result->rowCount();
if ($count > 0)
{
  ?>
  <p class="float-left allign-Textbox">You just updated customer no: <?php echo $_POST['ud_id'] ?> click <a href='Customer.php'>here</a> to go back</p>";
  <?php
}
else
{
  ?>
  <p class="float-left allign-Textbox">Nothing updated!!!!  click<a href='Customer.php'> here</a> to go back</p>";
  <?php
}
}

catch (PDOException $e) {

$output = 'Unable to process query sorry : ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();

}
include 'footer.html';
?>
