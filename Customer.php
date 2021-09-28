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
    <header>
      <h1>Computer First Aid</h1>
    </header>

    <div class="background-image-container">
      <div class="nav-container">
        <img class="logo" src="images/main-computer-logo.png" alt="Computer logo"><!-- I took this image from this website https://www.pngegg.com/en/png-zrsif-->
        <nav>
            <ul>
              <li class ="active"><a href="Customer.php">Customer</a></li>
              <li><a href="Repairs.php">Repairs</a></li>
              <li><a href="Parts.php">Parts</a></li>
            </ul>
          </nav>
        </div>
      </div>
      <div class="clearfix"></div>
    <div class="banner-wrapper"><p></p></div>
    <div class="main-background">
    <div class="main" style="display:flex;">
      <Article>
        <div class="Top-left">
            <img class="float-left main-images" src="images/Customer-Image.png" alt="Customer-Image"><!-- I took this image from this website https://www.pinclipart.com/maxpin/hohJwi/-->
            <h2  class="float-left small-margin">Create a <span class="orange-span">New</span> Customer?</h2>
          <form action="Customer.php" method="post">
            <p class="float-left allign-Textbox">
            First Name:<input class="textBoxes" type="text" name="fname" ><br>
            Last Name:<input class="textBoxes" type="text" name="lname" ><br>
            Address: <input class="textBoxes" type="text" name="caddress" ><br>
            Eircode: <input class="textBoxes" type="text" name="eircode" placeholder="(optional)"><br>
            Phone Number: <input class="textBoxes" type="text" name="cphone"><br>
            Email: <input class="textBoxes" type="text" name="cemail" ><br>

            <input class="formButtons formHover" type="submit" name="createCustomerAccount" value="Create Account" >

<?php
if (isset($_POST['createCustomerAccount'])) {
try {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $caddress = $_POST['caddress'];
    $eircode = $_POST['eircode'];
    $cphone = $_POST['cphone'];
    $cemail = $_POST['cemail'];
    if ($fname == ''  or $lname == '' or $caddress == '' or $cphone == '' or $cemail == '' or !preg_match('/^[\p{L} ]+$/u',$fname) or !preg_match('/^[\p{L} ]+$/u',$lname))
    {
?>
        <!--I got validation code for checking if the names are only letters and spaces and are valid https://stackoverflow.com/questions/557377/how-to-check-real-names-and-surnames-php-->
        <p class="float-left" style="margin-left:120px; margin-top:40px;">You did not fill in all the details correctly <br></p>
<?php
    }
    else if (ctype_alpha($cphone))
    {
?>
        <!--I got validation code for checking if the phone number contained letters https://www.geeksforgeeks.org/php-ctype_alpha-checks-for-alphabetic-value/#:~:text=Input%20%3A%20GeeksforGeeks%20Output%20%3A%20Yes%20Explanation,then%20it%20will%20return%20FALSE.-->
        <p class="float-left" style="margin-left:120px; margin-top:40px;">Please enter a valid phone number<br></p>
<?php
    }
    else if (!filter_var($cemail, FILTER_VALIDATE_EMAIL))
    {
?>
      <!--I got validation code for checking an email from here  https://www.w3schools.com/php/php_form_url_email.asp-->
      <p class="float-left" style="margin-left:120px; margin-top:40px;">Please enter a valid email address<br></p>
<?php
      }
 else{
    require('LoginFunction.php');
    $sql = "INSERT INTO customer (FirstName, LastName, Address, Eircode, PhoneNumber, Email) VALUES(:fname, :lname, :caddress, :eircode, :cphone, :cemail)";

    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':fname', $fname);
    $stmt->bindValue(':lname', $lname);
    $stmt->bindValue(':caddress', $caddress);
    $stmt->bindValue(':eircode', $eircode);
    $stmt->bindValue(':cphone', $cphone);
    $stmt->bindValue(':cemail', $cemail);

    $stmt->execute();
    ?>
      <p class="float-left" style="margin-left:120px; margin-top:40px;">You succesfully added a Customer to the table!!! <br></p>
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
</p>
          </form>
        </div>
      </Article>
      <aside>
        <div class="Top-right">
            <img class="float-left main-images" src="images/First-Monitor-Image.png" alt="images\First-Monitor-Image"><!-- I took this image from this website http://www.pngonly.com/television-png/-->
            <h2  class="float-left small-margin"><span class="orange-span">List, Update</span> and <span class="orange-span">Delete</span> Details</h2>
<?php
   try {
require('LoginFunction.php');
$sql = 'SELECT * FROM customer';
$result = $pdo->query($sql);
?>
<div class="table-align">
<table border=6><tr><th>ID</th>
<th>First Name</th><th>Last Name</th><th>Email</th><th>Delete</th><th>Update</th><th>Details</th></tr>

<?php
while ($row = $result->fetch()) {
echo "<tr>";
echo "<td>" . $row['CustomerID'] . "</td>";
echo "<td>". $row['FirstName'] . "</td>";
echo "<td>". $row['LastName'] . "</td>";
echo "<td>". $row['Email'] . "</td>";
echo "<td><a href=\"AreYouSureDeleteCustomer.php? CustomerID=".$row['CustomerID']."\">Remove</a></td>";
echo "<td><a href=\"updateCustomerDetails.php?CustomerID=".$row['CustomerID']."\">Update</a></td>";
echo "<td><a href=\"ListCustomer.php?CustomerID=".$row['CustomerID']."\">Details</a></td>";
echo "</tr>";

}
?>
</table></div>
<?php
}
catch (PDOException $e) {
$output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
}
?>
        </div>
    </aside>
    </div>
  </div>

    <footer>
            <a href="https://www.instagram.com/computerfirstaidIE/"><img class="icons" src="images/Instagram.png" alt="Instagram_Icon"></a>
            <a href="https://www.facebook.com/computerfirstaidIE/"><img class="icons" src="images/Facebook.png" alt="Facebook_Icon"></a>
            <a href="https://twitter.com/computerfirstaidIE"><img class="icons" src="images/Twitter.png" alt="Twitter_Icon"></a>
            <a href="https://www.youtube.com/channel/computerfirstaidIE"><img class="icons" src="images/Youtube.png" alt="Youtube_Icon"></a>

            <ul>
              <li style="text-decoration:underline;font-size:18px;">Contents</li>
              <li><a href="Customer.php">Customer</a></li>
              <li><a href="Repairs.php">Repairs</a></li>
              <li><a href="Parts.php">Parts</a></li>
            </ul>

           <h4 class="Email-Link">Email:<a href="mailto:info@computerfirstAid.ie">info@computerfirstaid.ie</a></h4>
       </footer>

    <div id="Copyright-Info">Copyright &copy; 2020 | Irelands number one Computer repair company | computerfirstaid.ie</div>

  </body>
</html>
