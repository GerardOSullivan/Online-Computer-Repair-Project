<?php
include 'header.html';
?>
    <img class="float-left main-images" src="images/sad-face.png" alt="Sad-face-image"><!-- I took this image from this website https://www.google.com/search?q=sad+face+png+imagesize%3A100x100&tbm=isch&ved=2ahUKEwjF24ro5q3tAhWeZhUIHUmWC5gQ2-cCegQIABAA&oq=sad+face+png+imagesize%3A100x100&gs_lcp=CgNpbWcQA1DX3QhYkcMKYJXECmgFcAB4AIABNYgB8wKSAQE5mAEAoAEBqgELZ3dzLXdpei1pbWfAAQE&sclient=img&ei=27_GX4WCHZ7N1fAPyayuwAk&bih=880&biw=1920#imgrc=FEIkmzHoFNEU4M-->
    <h2  class="float-left small-margin">Customer <span class="orange-span">Details</span> Removed</h2>
<?php
try {
require('LoginFunction.php');
$sql = 'DELETE FROM customer WHERE CustomerID = :cid';
$result = $pdo->prepare($sql);
$result->bindValue(':cid', $_POST['id']);
$result->execute();
?>

<p class="float-left info-align">You just deleted customer no: <?php echo $_POST['id'] ?> click<a href='Customer.php'> here</a> to go back </p>';

<?php
}
catch (PDOException $e) {

if ($e->getCode() == 23000) {
?>
<p class="float-left info-align">Could not delete this customer as they currently have repairs on file. click<a href='Customer.php'> here</a> to go back </p>";
<?php
     }

}
include 'footer.html';
?>
