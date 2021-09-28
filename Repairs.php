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
              <li><a href="Customer.php">Customer</a></li>
              <li class ="active"><a href="Repairs.php">Repairs</a></li>
              <li><a href="Parts.php">Parts</a></li>
            </ul>
          </nav>
        </div>
      </div>
      <div class="clearfix"></div>
    <div class="banner-wrapper"><p></p></div>
    <div class="main-background" style="height:1100px;">
    <div class="main" style="display:flex;">
      <Article>
        <!--left Side-->
        <div class="Top-left">
            <img class="float-left main-images" src="images/Repair-image.png" alt="Repair-Image"><!-- I took this image from this website https://www.soltech.ie/home/repair-icon/-->
            <h2  class="float-left small-margin">Log a <span class="orange-span">New</span> Repair</h2>
          <form action="Repairs.php" method="post">
            <p class="float-left allign-Textbox">
            Customer ID:<input class="textBoxes" type="text" name="cid" value = ""><br>
            Repair description:<br><textarea placeholder="e.g A dell laptop.Screen is damaged...." rows="7" style="width:300px; resize:none;" class="textBoxes" type="text" name="rdesc" value = ""></textarea><br>
            <input class="formButtons formHover" type="submit" name="LogRepair" value="Log Repair" >

<?php
if (isset($_POST['LogRepair'])) {
try {
  require('LoginFunction.php');
  $sql = 'SELECT count(*) FROM customer WHERE CustomerID = :cid';
  $result = $pdo->prepare($sql);
  $result->bindValue(':cid', $_POST['cid']);
  $result->execute();

    $CustomerID = $_POST['cid'];
    $RepairDescription = $_POST['rdesc'];
    if ($CustomerID == ''  or $RepairDescription == '')
    {
?>
        <p class="float-left" style="margin-left:120px; margin-top:40px;">You did not fill in all the details correctly <br></p>
<?php
    }
    else if ($result->fetchColumn() <= 0)
    {
?>

        <p class="float-left" style="margin-left:120px; margin-top:40px;">No CustomerID matches your request please enter a valid CustomerID.<br></p>
<?php
}
 else{
    $sql = "INSERT INTO repairs (CustomerID,RepairDescription,DateRepairLogged) VALUES(:cid, :rdesc,now())";

    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':cid', $CustomerID);
    $stmt->bindValue(':rdesc', $RepairDescription);

    $stmt->execute();
    ?>
      <p class="float-left" style="margin-left:120px; margin-top:40px;">You succesfully Logged a repair!!! <br></p>
      <?php
    }
}
catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
}
}
?>
</p>
          </form>
        </div>
        <div class="Bottom-left">
            <img class="float-left main-images" src="images/Repair-items-image.png" alt="images\Repair-items-image"><!-- I took this image from this website http://apliitech.com/-->
            <h2  class="float-left small-margin">All <span class="orange-span">Repair</span> Details</h2>
<?php
   try {
require('LoginFunction.php');
$sql = 'SELECT * FROM repairs';
$result = $pdo->query($sql);
?>
<div class="table-align">
<table border=6><tr><th>RepairID</th>
<th>CustomerID</th><th>Status</th><th>Total Cost</th><th>Details</th></tr>

<?php
while ($row = $result->fetch()) {
echo "<tr>";
echo "<td>" . $row['RepairTicketID'] . "</td>";
echo "<td>" . $row['CustomerID'] . "</td>";
echo "<td>". $row['status'] . "</td>";
echo "<td>&euro;". $row['totalcost'] . "</td>";
echo "<td><a href=\"ListRepair.php?RepairTicketID=".$row['RepairTicketID']."\">Details</a></td>";
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
      </Article>
      <!--Right Side-->
      <aside>
        <div class="Top-right">
            <img class="float-left main-images" src="images/Parts.png" alt="images\Parts"><!-- I took this image from this website http://www.pngall.com/motherboard-png/download/3712-->
            <h2  class="float-left small-margin">Add <span class="orange-span">Parts</span> to Repair</h2>
            <form action="Repairs.php" method="post">
              <p class="float-left allign-Textbox">
              Repair ID:<input class="textBoxes" type="text" name="repairID" value = ""><br>
              Choose a part to add:
            <select class="textBoxes" name="PartAdded">
              <option value=""></option>
        <?php
        $conn =require('LoginFunction.php');
        $currentPart = 'SELECT * FROM parts';
        $result = $pdo->query($currentPart);

        while ($row = $result->fetch()) {
            echo '<option class="float-left" value="'.$row['Description'].'">'.$row['Description'].' '. $row['PartType'] .'</option>';
        }
        ?>
            </select><br>
            Quantity of Parts:<input class="textBoxes" type="text" name="QtyParts" value = ""><br>
              <input class="formButtons formHover" type="submit" name="AddParts" value="Add Parts to Repair" >

  <?php
  if (isset($_POST['AddParts'])) {
  try {
    require('LoginFunction.php');

    $RepairTicketID = $_POST['repairID'];
    $PartAdded = $_POST['PartAdded'];
    $PartsQty = $_POST['QtyParts'];

    $sql = 'SELECT count(*) FROM repairs WHERE RepairTicketID = :repairID';
    $result = $pdo->prepare($sql);
    $result->bindValue(':repairID', $RepairTicketID);
    $result->execute();

    $sql1 = 'SELECT QtyInStock FROM parts WHERE Description = :PartAdded';
    $QtyInStock = $pdo->prepare($sql1);
    $QtyInStock->bindValue(':PartAdded', $PartAdded);
    $QtyInStock->execute();
    $QtyInStockAsString=$QtyInStock->fetchColumn();

    $sql2 = 'SELECT Status FROM parts WHERE Description = :PartAdded';
    $partStatus = $pdo->prepare($sql2);
    $partStatus->bindValue(':PartAdded', $PartAdded);
    $partStatus->execute();

    $sql3 = 'SELECT RepairTicketID FROM repairs WHERE RepairTicketID = :rid';
    $result1 = $pdo->prepare($sql3);
    $result1->bindValue(':rid', $RepairTicketID);
    $result1->execute();
    $row = $result1->fetchColumn();

    $sql4 = 'SELECT status FROM repairs WHERE RepairTicketID = :rid';
    $status = $pdo->prepare($sql4);
    $status->bindValue(':rid', $RepairTicketID);
    $status->execute();
    $currentStatus=$status->fetchColumn();

      if ($RepairTicketID == '' or $PartAdded == ''or $PartsQty == '')
      {
  ?>
          <p class="float-left" style="margin-left:120px; margin-top:40px;">You did not fill in all the details correctly <br></p>
  <?php
      }
      else if ($result->fetchColumn() <= 0)
      {
  ?>
          <p class="float-left" style="margin-left:120px; margin-top:40px;">No Repair ID matches your request please enter a valid Repair ID.<br></p>
  <?php
  }
  else if (!ctype_digit($PartsQty))
  {
?>
      <p class="float-left" style="margin-left:120px; margin-top:40px;">The Quantity of parts must be a valid number.<br></p>
<?php
}
else if ($partStatus->fetchColumn() == 'D')
{
?>

    <p class="float-left" style="margin-left:120px; margin-top:40px;">This part has been delisted and cannot be used for repair please select another part.<br></p>
<?php
}
else if ($QtyInStockAsString <= 0)
{
?>
    <p class="float-left" style="margin-left:120px; margin-top:40px;">This part is out of stock please select another part.<br></p>
<?php
}
else if ($currentStatus != 'L' and $currentStatus != 'R')
{
?>
    <p class="float-left" style="margin-left:120px; margin-top:40px;">Your Repair is No longer logged or Commenced and cannot add more parts to the repair.Click <?php echo"<a href=\"ListRepair.php?RepairTicketID=".$row."\">";?>here</a> to see its current status<br></p>
<?php
}
   else{
     $sql3 = 'SELECT Cost FROM parts WHERE Description = :PartAdded';
     $costOfPart = $pdo->prepare($sql3);
     $costOfPart->bindValue(':PartAdded', $PartAdded);
     $costOfPart->execute();
     $costOfPartAsString=$costOfPart->fetchColumn();

     $sql4 = 'SELECT totalcost FROM repairs WHERE RepairTicketID = :repairID';
     $currentCost = $pdo->prepare($sql4);
     $currentCost->bindValue(':repairID', $RepairTicketID);
     $currentCost->execute();
     $currentCostAsString=$currentCost->fetchColumn();

     $sql5 = 'SELECT PartID FROM parts WHERE Description = :PartAdded';
     $partID = $pdo->prepare($sql5);
     $partID->bindValue(':PartAdded', $PartAdded);
     $partID->execute();
     $partIDAsString=$partID->fetchColumn();

     $sql6 = 'SELECT Count(*) FROM repairitems WHERE RepairTicketID = :repairID AND PartID = :PartID';
     $partsAlreadyAdded = $pdo->prepare($sql6);
     $partsAlreadyAdded->bindValue(':repairID', $RepairTicketID);
     $partsAlreadyAdded->bindValue(':PartID', $partIDAsString);
     $partsAlreadyAdded->execute();

     if($partsAlreadyAdded->fetchColumn()<=0)
     {
       $sql = "INSERT INTO repairitems (RepairTicketID,PartID,QtyInRepair) VALUES(:repairID, :partID ,:QtyParts)";
       $stmt = $pdo->prepare($sql);
       $stmt->bindValue(':repairID', $RepairTicketID);
       $stmt->bindValue(':partID', $partIDAsString);
       $stmt->bindValue(':QtyParts', $PartsQty);
       $stmt->execute();
     }
     else {
       $sql = "UPDATE repairitems SET QtyInRepair=QtyInRepair+:QtyParts WHERE RepairTicketID = :repairID AND PartID = :partID";
       $stmt = $pdo->prepare($sql);
       $stmt->bindValue(':repairID', $RepairTicketID);
       $stmt->bindValue(':partID', $partIDAsString);
       $stmt->bindValue(':QtyParts', $PartsQty);
       $stmt->execute();
     }

      $newQtyInStock=$QtyInStockAsString-$PartsQty;

      $sql = "UPDATE parts SET QtyInStock=:QtyInStock WHERE Description = :PartAdded";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':PartAdded', $PartAdded);
      $stmt->bindValue(':QtyInStock', $newQtyInStock);
      $stmt->execute();

      $newTotalCost=$currentCostAsString+($costOfPartAsString*$PartsQty);

      $sql = "UPDATE repairs SET totalcost=:totalcost WHERE RepairTicketID = :repairID";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':repairID', $RepairTicketID);
      $stmt->bindValue(':totalcost', $newTotalCost);
      $stmt->execute();


      ?>
        <p class="float-left" style="margin-left:120px; margin-top:40px;">You succesfully added a part to a repair!!! <br></p>
        <?php
      }
  }
  catch (PDOException $e) {
      $title = 'An error has occurred';
      $output = 'Database error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
  }
  }
  ?>
  </p>
            </form>
        </div>
        <div class="Bottom-right">
            <img class="float-left main-images" src="images/Repair-man.png" alt="Repair-man-image"><!-- I took this image from this website https://www.pngfind.com/mpng/iRRToJw_repair-man-hd-png-download/-->
            <h2  class="float-left small-margin">Commence or <span class="orange-span">Finish</span> a Repair</h2>
          <form action="Repairs.php" method="post">
            <p class="float-left allign-Textbox">
            Repair ID:<input class="textBoxes" type="text" name="rid" value = ""><br>
            <input class="formButtons formHover" type="submit" name="CommenceRepair" value="Commence Repair" >
            <input class="formButtons formHover" type="submit" name="FinishRepair" value="Finish Repair" >

<?php
//commencing Repair
if (isset($_POST['CommenceRepair'])) {
try {
  require('LoginFunction.php');
  $sql = 'SELECT count(*) FROM repairs WHERE RepairTicketID = :rid';
  $result = $pdo->prepare($sql);
  $result->bindValue(':rid', $_POST['rid']);
  $result->execute();

  $sql1 = 'SELECT status FROM repairs WHERE RepairTicketID = :rid';
  $status = $pdo->prepare($sql1);
  $status->bindValue(':rid', $_POST['rid']);
  $status->execute();
  $currentStatus=$status->fetchColumn();

  $sql2 = 'SELECT RepairTicketID FROM repairs WHERE RepairTicketID = :rid';
  $result1 = $pdo->prepare($sql2);
  $result1->bindValue(':rid', $_POST['rid']);
  $result1->execute();
  $row = $result1->fetchColumn();

    $RepairID = $_POST['rid'];
    if ($RepairID == '')
    {
?>
        <p class="float-left" style="margin-left:120px; margin-top:40px;">You did not fill in the Repair ID <br></p>
<?php
    }
    else if ($result->fetchColumn() <= 0)
    {
?>
        <p class="float-left" style="margin-left:120px; margin-top:40px;">No Repair ID matches your request please enter a valid Repair ID.<br></p>
<?php
}
else if ($currentStatus != 'L')
{
?>
    <p class="float-left" style="margin-left:120px; margin-top:40px;">Your Repair is No longer logged and cannot be marked as ready for repair.Click <?php echo"<a href=\"ListRepair.php?RepairTicketID=".$row."\">";?>here</a> to see its current status<br></p>
<?php
}
 else{
    $sql = "UPDATE repairs SET status='R' WHERE RepairTicketID = :rid";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':rid', $_POST['rid']);
    $stmt->execute();
    ?>
      <p class="float-left" style="margin-left:120px; margin-top:40px;">Your Repair has now commenced!!!<br></p>
      <?php
    }
}
catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
}
//finishing Repair
}else if (isset($_POST['FinishRepair'])) {
try {
  require('LoginFunction.php');
  $sql = 'SELECT count(*) FROM repairs WHERE RepairTicketID = :rid';
  $result = $pdo->prepare($sql);
  $result->bindValue(':rid', $_POST['rid']);
  $result->execute();

  $sql1 = 'SELECT status FROM repairs WHERE RepairTicketID = :rid';
  $status = $pdo->prepare($sql1);
  $status->bindValue(':rid', $_POST['rid']);
  $status->execute();
  $currentStatus=$status->fetchColumn();

  $sql2 = 'SELECT RepairTicketID FROM repairs WHERE RepairTicketID = :rid';
  $result1 = $pdo->prepare($sql2);
  $result1->bindValue(':rid', $_POST['rid']);
  $result1->execute();
  $row = $result1->fetchColumn();

    $RepairID = $_POST['rid'];
    if ($RepairID == '')
    {
?>
        <p class="float-left" style="margin-left:120px; margin-top:40px;">You did not fill in the Repair ID<br></p>
<?php
    }
    else if ($result->fetchColumn() <= 0)
    {
?>
        <p class="float-left" style="margin-left:120px; margin-top:40px;">No Repair ID matches your request please enter a valid Repair ID.<br></p>
<?php
}
else if ($currentStatus != 'R')
{
?>
    <p class="float-left" style="margin-left:120px; margin-top:40px;">Your Repair is No longer being Repaired and cannot be marked as finished.Click <?php echo"<a href=\"ListRepair.php?RepairTicketID=".$row."\">";?>here</a> to see its current status<br></p>
<?php
}
 else{
    $sql = "UPDATE repairs SET status='F' WHERE RepairTicketID = :rid";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':rid', $_POST['rid']);
    $stmt->execute();
    ?>
      <p class="float-left" style="margin-left:120px; margin-top:40px;">Your Repair has now Finished!!!<br></p>
      <?php
    }
}
catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
}
}
?>
</p>
          </form>
        </div>
        <div class="Bottom-right">
            <img class="float-left main-images" src="images/Euro-Symbol.png" alt="Euro-Symbol"><!-- I took this image from this website https://www.freeiconspng.com/downloadimg/10373-->
            <h2  class="float-left small-margin">Pay for a <span class="orange-span">Repair</span></h2>
          <form action="Repairs.php" method="post">
            <p class="float-left allign-Textbox">
            Repair ID:<input class="textBoxes" type="text" name="rid" value = ""><br>
            Paid amount:&nbsp;&euro;&nbsp;<input class="textBoxes" type="text" name="pay" value = ""placeholder="e.g 50.00"><br>
            <input class="formButtons formHover" type="submit" name="PayforRepair" value="Pay for Repair" >

<?php
if (isset($_POST['PayforRepair'])) {
try {
  require('LoginFunction.php');
  $RepairID = $_POST['rid'];
  $payAmount = $_POST['pay'];

  $sql = 'SELECT count(*) FROM repairs WHERE RepairTicketID = :rid';
  $result = $pdo->prepare($sql);
  $result->bindValue(':rid', $RepairID);
  $result->execute();

  $sql1 = 'SELECT status FROM repairs WHERE RepairTicketID = :rid';
  $status = $pdo->prepare($sql1);
  $status->bindValue(':rid', $RepairID);
  $status->execute();
  $currentStatus=$status->fetchColumn();

  $sql2 = 'SELECT RepairTicketID FROM repairs WHERE RepairTicketID = :rid';
  $result1 = $pdo->prepare($sql2);
  $result1->bindValue(':rid', $RepairID);
  $result1->execute();
  $row = $result1->fetchColumn();

  $sql3 = 'SELECT totalcost FROM repairs WHERE RepairTicketID = :rid';
  $currentCost = $pdo->prepare($sql3);
  $currentCost->bindValue(':rid', $RepairID);
  $currentCost->execute();
  $currentCostAsString=$currentCost->fetchColumn();
    if ($RepairID  == '' or $payAmount =='')
    {
?>
        <p class="float-left" style="margin-left:120px; margin-top:40px;">You did not fill in all the details correctly <br></p>
<?php
    }
    else if ($result->fetchColumn() <= 0)
    {
?>
        <p class="float-left" style="margin-left:120px; margin-top:40px;">No Repair ID matches your request please enter a valid Repair ID.<br></p>
<?php
}
else if (!preg_match("/^-?[0-9]+(?:\.[0-9]{1,2})?$/", $payAmount) or $payAmount >=10000)
{
?>
    <p class="float-left" style="margin-left:120px; margin-top:40px;">The pay amount you have entered is an invalid amount. Please enter a valid amount<br></p>
<?php
}
else if ($currentStatus != 'F')
{
?>
    <p class="float-left" style="margin-left:120px; margin-top:40px;">Your repair needs to be finished to start paying for it.Click <?php echo"<a href=\"ListRepair.php?RepairTicketID=".$row."\">";?>here</a> to see its current status<br></p>
<?php
}
else if ((double)($currentCostAsString-$payAmount) < 0)
{
?>
    <p class="float-left" style="margin-left:120px; margin-top:40px;">The pay amount you have entered is more than the total cost of the current repair .Click <?php echo"<a href=\"ListRepair.php?RepairTicketID=".$row."\">";?>here</a> to see the current total cost<br></p>
<?php
}
 else{
    $sql = "UPDATE repairs SET totalcost=totalcost-:payAmount WHERE RepairTicketID = :rid";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':rid', $RepairID);
    $stmt->bindValue(':payAmount', $payAmount);
    $stmt->execute();

    $sql = 'SELECT totalcost FROM repairs WHERE RepairTicketID = :rid';
    $currentCost = $pdo->prepare($sql);
    $currentCost->bindValue(':rid', $RepairID);
    $currentCost->execute();

    if($currentCost->fetchColumn() !=0 )
    {
    ?>
      <p class="float-left" style="margin-left:120px; margin-top:40px;">You paid &euro;<?php echo $payAmount;?> from your repair!!! <br></p>
      <?php
    }else {
      ?>
        <p class="float-left" style="margin-left:120px; margin-top:40px;">You have paid the full amount of your repair. The repair is now complete!!! <br></p>
        <?php
        $sql = "UPDATE repairs SET status='C',DatePaid=now() WHERE RepairTicketID = :rid";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':rid', $RepairID);
        $stmt->execute();
    }
  }
}
catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
}
}
?>
</p>
          </form>
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
