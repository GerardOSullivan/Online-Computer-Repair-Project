<!DOCTYPE html>
<html lang='en'>
  <head>
    <title>Home page | Computer First Aid</title>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width' />
    <meta name='description' content='If you need a laptop or computer repaired computer first aid has got you covered.All
    our technicians at the computer first aid repair centre are fully qualified and trained to the higest standard'>
    <meta name='keywords' content='Repair, Computer, instilation'>
    <meta name='author' content='Gerard O Sullivan'>
    <meta name='robots' content='all'>
    <link href='main.CSS' rel='stylesheet' type='text/css'>
    <link href="images/favicon.ico" rel="icon">
    <link href="images/favicon.ico" rel="shortcut icon">

  </head>
  <body>
<form action="addparts.php" method="post">
            Part type:<input  type="text" name="lname" ><br>
            Description: <input  type="text" name="caddress" ><br>
            cost: <input  type="text" name="eircode" placeholder="(optional)"><br>
            Statusr: <input  type="text" name="cphone"><br>
            Qty: <input  type="text" name="cemail" ><br>
            <input class="formButtons" type="submit" name="createCustomerAccount" value="Create Account" >
</form>
<?php
if (isset($_POST['createCustomerAccount'])) {
try {
    $lname = $_POST['lname'];
    $caddress = $_POST['caddress'];
    $eircode = $_POST['eircode'];
    $cphone = $_POST['cphone'];
    $cemail = $_POST['cemail'];
    if ($lname == '' or $caddress == '' or $cphone == '' or $cemail == '')
    {
?>
        <p class="float-left" style="margin-left:120px; margin-top:40px;">You did not fill in all the details correctly <br></p>
<?php
    }
 else{
    require('LoginFunction.php');
    $sql = "INSERT INTO parts (PartType, Description, Cost, Status, QtyInStock) VALUES(:lname, :caddress, :eircode, :cphone, :cemail)";

    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':lname', $lname);
    $stmt->bindValue(':caddress', $caddress);
    $stmt->bindValue(':eircode', $eircode);
    $stmt->bindValue(':cphone', $cphone);
    $stmt->bindValue(':cemail', $cemail);

    $stmt->execute();
    ?>
      <p class="float-left" style="margin-left:120px; margin-top:40px;">You succesfully added a Part to the table!!! <br></p>
      <?php
    }
}
catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
    echo $output;
}
}
?>

</body>
</html>
