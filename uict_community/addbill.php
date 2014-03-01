
<?php
 function renderForm($reg,$pv,$cv,$date_start,$purpose,$amount,$date_of_end)
 { 
require_once("../conn/db_conn.php");
    ?>

<!DOCTYPE html>
<html>
<head>
<title>Billing</title>

</head>
<body>
<fieldset><legend>Transaction insertion form</legend>
<form method="post" action="">
<table><tr><td><label for="reg_no">Member ID</td>
<td><input type="text" id="reg_no" name="reg_no" required="required"/></label></td></tr>

<tr><td><label for="year">Academic year</td>
<?php
echo "<td><select name='year' id='year' required='required'>";
echo "<option value=''>--  Select  --</option>";
$i=-3;
 
while($i<=3){
$yos = (date("Y")+$i)."  -  ".((date("Y")+1)+$i);
 echo "<option value='".$yos."'>$yos</option>";
$i++;
 }
echo "</select></td></tr>";
?>


<tr><td><label for="semister">Study semister</td>
 <?php
echo "<td><select name='semister' id='semister' required='required' >";
echo "<option value=''>-- select ---</option>";
$sem=1;
 while($sem<3){
echo "<option value='".$sem."'>$sem</option>";
  $sem++;
}
echo "</select></td></tr>";
?>
<tr><td><label for="purpose">Purpose of payment</td>
<?php
echo "<td><select name=\"purpose\" id=\"purpose\" required=\"required\">";

echo "<option value=''>---  Select  ---</option>";
 $query = mysql_query("SELECT * FROM billing_detail"); 
 while($value = mysql_fetch_array($query)){
echo "<option value='".$value[0]."'>".$value[1]."</option>";
}
echo "</select></td></tr>";
?>


<?php 
 echo "<tr><td><label for=\"start\">Starting date:</td>";
$dt=1;
echo "<td><select name ='dt' id=\"dt\" required=\"required\">";
 echo "<option value=''>Date</option>";
 while($dt<=31){
if($dt<10){
echo "<option value='".$dt."'>0".$dt."</option>";
    $dt++;
}else{
echo "<option value='".$dt."'>".$dt."</option>";
    $dt++;
}
}
echo "</select>&nbsp&nbsp&nbsp";
 
$mt=1;
echo "<select name ='mt' id=\"mt\" required=\"required\">";
echo "<option value=''>month</option>";
 while($mt<=12){
if($mt<10){
echo "<option value='".$mt."'>0".$mt."</option>";
    $mt++;}else{
echo "<option value='".$mt."'>".$mt."</option>";
    $mt++;
  }
}
echo "</select>&nbsp&nbsp&nbsp";
$y=2012;
echo "<select name ='y' id=\"y\" required=\"required\">";
echo "<option value=''>year</option>";
 while($y <= (date("Y")+1)){
echo "<option value='".$y."'>".$y."</option>";
    $y++;
}
echo "</select></label></td></tr>";

?>
<tr><td><label for="amount">Amount</td>
<td><input type="text" id="amount" name="amount" required="required"/></label></td></tr>


<?php 
 echo "<tr><td><label for=\"end\">Ending date:</label></td>";
$dt=1;
echo "<td><select name ='dd' id='dd' required='required'>";
echo "<option value=''>Date</option>";
 while($dt<=31){
if($dt<10){
echo "<option value='".$dt."'>0".$dt."</option>";
    $dt++;
}else{
echo "<option value='".$dt."'>".$dt."</option>";
    $dt++;
}
}
echo "</select>&nbsp&nbsp&nbsp";
$mt=1;
echo "<select name ='mm' id=\"mm\" required=\"required\">";
echo "<option value=''>Month</option>";
 while($mt<=12){
if($mt<10){
echo "<option value='".$mt."'>0".$mt."</option>";
    $mt++;}else{
echo "<option value='".$mt."'>".$mt."</option>";
    $mt++;
  }
}
echo "</select>&nbsp&nbsp&nbsp";
$y=2012;
echo "<select name ='yy' id='yy' required=\"required\">";
echo "<option value=''>Year</option>";
 while($y <= (date("Y")+1)){
echo "<option value='".$y."'>".$y."</option>";
    $y++;
}
echo "</select></td></tr>";
mysql_close($data);
?>
<tr><td></td>
<td><button type="submit" name="submit" value="add"><i> Add </i></button><button type="reset" name="reset" value="reset"><i>Reset</i></button></button><button type="show" name="show" value="show"><i>show</i></button></td></tr></table>
</form>
</fieldset>
</body>
</html>
<?php
}
if (isset($_POST['submit']))
 { 
require_once("function.php");
require_once("../conn/db_conn.php");
 //get form data, making sure it is valid
 $reg_no = mysql_real_escape_string(htmlspecialchars($_POST['reg_no']));
 $pv = mysql_real_escape_string(htmlspecialchars($_POST['year']));
 $ch = mysql_real_escape_string(htmlspecialchars($_POST['semister']));
 $dt = mysql_real_escape_string(htmlspecialchars($_POST['dt']));
$mt = mysql_real_escape_string(htmlspecialchars($_POST['mt']));
$y = mysql_real_escape_string(htmlspecialchars($_POST['y']));
 $dd = mysql_real_escape_string(htmlspecialchars($_POST['dd']));
$mm = mysql_real_escape_string(htmlspecialchars($_POST['mm']));
$yy = mysql_real_escape_string(htmlspecialchars($_POST['yy']));
$amount = mysql_real_escape_string(htmlspecialchars($_POST['amount']));
$purpose = mysql_real_escape_string(htmlspecialchars($_POST['purpose']));
$date_start = $y.'/'.$mt.'/'.$dt;
$date_end = $yy.'/'.$mm.'/'.$dd;

 // save the data to the database
renderForm('','','','','','','');
//view_bill();
echo "\n\n";
add_bill($reg_no,$pv,$ch,$purpose,$date_start,$amount,$date_end);
 // once saved, redirect back to the view page 
 }elseif(isset($_POST['show'])){
  renderForm('','','','','','','');
  view_bill();
      }else{

        renderForm('','','','','','','');
}

 
?>
