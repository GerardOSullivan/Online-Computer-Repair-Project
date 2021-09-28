<?php
include 'header.html';
?>
    <img class="float-left main-images" src="images/updating-image.png" alt="updating-image"><!-- I took this image from this website https://www.google.com/search?q=updating+png&tbm=isch&ved=2ahUKEwji-sfh663tAhVJEsAKHXppALwQ2-cCegQIABAA&oq=updating+png&gs_lcp=CgNpbWcQAzICCAAyBggAEAcQHjIGCAAQBxAeOgQIABBDUOnEEVi50RFg9NIRaABwAHgAgAE2iAHaApIBATiYAQCgAQGqAQtnd3Mtd2l6LWltZ8ABAQ&sclient=img&ei=C8XGX6LJO8mkgAb60oHgCw&bih=880&biw=1920#imgrc=IPCpTgY4H9SRUM-->
    <h2  class="float-left small-margin">Update <span class="orange-span">Customer</span> Details</h2>
<?php
try {
require('LoginFunction.php');
$sql="SELECT count(*) FROM customer WHERE CustomerID=:cid";

$result = $pdo->prepare($sql);
$result->bindValue(':cid', $_GET['CustomerID']);
$result->execute();
if($result->fetchColumn() > 0)
{
    $sql = 'SELECT * FROM customer where CustomerID = :cid';
    $result = $pdo->prepare($sql);
    $result->bindValue(':cid', $_GET['CustomerID']);
    $result->execute();

    $row = $result->fetch() ;
    $id = $row['CustomerID'];
	  $fname= $row['FirstName'];
    $lname= $row['LastName'];
	  $address=$row['Address'];
    $eircode=$row['Eircode'];
    $phonenumber=$row['PhoneNumber'];
    $email=$row['Email'];
?>
<form action="CustomerUpdated.php" method="post">
  <p class="float-left allign-Textbox">
<input class="textBoxes" type="hidden" name="ud_id" value="<?php echo $id; ?>">
First Name: <input class="textBoxes" type="text" name="ud_fname" value="<?php if (isset($fname)) echo $fname; ?>"><br>
Last Name: <input class="textBoxes" type="text" name="ud_lname" value="<?php if (isset($lname)) echo $lname; ?>"><br>
Address: <input class="textBoxes" type="text" name="ud_address" value="<?php if (isset($address))echo $address; ?>"><br>
Eircode: <input class="textBoxes" type="text" name="ud_eircode" value="<?php if (isset($eircode)) echo $eircode; ?>"><br>
Phone Number: <input class="textBoxes" type="text" name="ud_phone" value="<?php if (isset($phonenumber)) echo $phonenumber; ?>"><br>
Email: <input class="textBoxes" type="text" name="ud_email" value="<?php if (isset($email)) echo $email; ?>"><br>
<input class="formButtons formHover" type="Submit" value="Update Customer Details">
</p>
</form>
<?php
}

else {
      echo '<p class="float-left info-align">No rows matched the query. Click <a href="Customer.php">here</a> to go back to customer page</p>';
    }}
catch (PDOException $e) {
$output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
}


include 'footer.html';
?>
