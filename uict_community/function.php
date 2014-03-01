<?php
function generateStrongPassword($length = 9, $add_dashes = false, $available_sets = 'luds')
{
$sets = array();
if(strpos($available_sets, 'l') !== false)
$sets[] = 'abcdefghjkmnpqrstuvwxyz';
if(strpos($available_sets, 'u') !== false)
$sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
if(strpos($available_sets, 'd') !== false)
$sets[] = '23456789';
if(strpos($available_sets, 's') !== false)
$sets[] = '!@#$%&*?';
 
$all = '';
$password = '';
foreach($sets as $set)
{
$password .= $set[array_rand(str_split($set))];
$all .= $set;
}
 
$all = str_split($all);
for($i = 0; $i < $length - count($sets); $i++)
$password .= $all[array_rand($all)];
 
$password = str_shuffle($password);
 
if(!$add_dashes)
return $password;
 
$dash_len = floor(sqrt($length));
$dash_str = '';
while(strlen($password) > $dash_len)
{
$dash_str .= substr($password, 0, $dash_len) . '-';
$password = substr($password, $dash_len);
}
$dash_str .= $password;
return $dash_str;
}
function validate($reg_no){
$check = "SELECT reg_no ";
$check .= "FROM user ";
$check .= "WHERE reg_no ='".$reg_no."'";
$exists = mysql_query($check) or die(mysql_error());
 $num = mysql_num_rows($exists);
if($num > 0){
$query = "UPDATE user ";
$query .= "SET status='1' ";
$query .= "WHERE reg_no='".$reg_no."'";
mysql_query($query) or die(mysql_error());
}else{ 
    $passwd = generateStrongPassword($length = 9, $add_dashes = false, $available_sets = 'luds');
    $put = "INSERT into user(reg_no,username,password,status) ";
    $put .="VALUE ('".$reg_no."','".$reg_no."','".$passwd."',1)";
    $set = mysql_query($put) or die(mysql_error());
    if(mysql_affected_rows()){
    echo "successfuly create an account username is <b><i>".$reg_no."</i></b> password is <b><i>".$passwd."</i></b>";
}else{
    echo "Fail to $reg_no generate password";
     }
  }


}
function add_bill($reg,$year,$sem,$pur,$datein,$amo,$dateout){
 $value = "INSERT `billing` ";
$value .="set reg_no='".$reg."' ,";
$value .="year='".$year."' ,";
$value .="semister='".$sem."' ,";
$value .="purpose='".$pur."' ,";
$value .="start_date='".$datein."' ,";
$value .="amount='".$amo."' ,";
$value .="end_date='".$dateout."' ";
mysql_query($value) or die(mysql_error());
validate($reg);
 }
function view_bill(){
$quer =mysql_query("SELECT * FROM billing ") or die(mysql_error());
echo "<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"1000\">";
echo "<tr><td><table cellspacing=\"0\" cellpadding=\"1\" border=\"1\" width=\"980\" >";
echo "<tr> <th>Sn</th><th>Member ID</th><th>Year of studty</th> <th>Semister</th><th>Purpose</th><th>Start date</th><th>Amount<th>End date</th><th>Delete </th></tr></table>";
echo "</td></tr><tr><td>";
echo "<div style=\"width:1000px; height:500px; overflow:auto;\">";
echo "<table cellspacing=\"0\" cellpadding=\"1\" border=\"1\" width=\"980\" >";
$i=1;
 while($row = mysql_fetch_array($quer)){
 echo "<tr >";
               echo '<td>' . $i . '</td>';
                echo '<td>' . $row[1] . '</td>';
                echo '<td>' . $row[2] . '</td>';
                echo '<td>' . $row[3] . '</td>';
                echo '<td>' . $row[4] . '</td>';
                echo '<td>' . $row[5] . '</td>';
                echo '<td>' . $row[6] . '</td>';
                echo '<td>' . $row[7] . '</td>';
                echo '<td><a href="delete.php?id='.urlencode($row['id']).'">Delete</a></td>';     
                echo "</tr>";
$i++;  

   }
echo " </table>"; 
echo "</div></td></tr></table>";
}
?>

