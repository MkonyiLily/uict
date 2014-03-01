<?php
//check for required fields from the form
if ((!isset($_POST['username'])) || (!isset($_POST['password']))) {
header("Location: userlogin.html");
exit;
}
//connect to server and select database
require_once("../conn/db_conn.php");
//use mysql_real_escape_string to clean the input
$username = mysql_real_escape_string($_POST['username']);
$password = mysql_real_escape_string($_POST['password']);
//create and issue the query
$sql = "SELECT master_name.f_name,master_name.s_name,master_name.l_name,master_name.position, user.reg_no,user.status FROM user,master_name WHERE master_name.reg_no=user.reg_no AND user.username ='".$username."' AND user.password = PASSWORD('".$password."')";
$result = mysql_query($sql) or die(mysql_error());
//get the number of rows in the result set; should be 1 if a match
if (mysql_num_rows($result) == 1) {
//if authorized, get the values of f_name l_name
while ($info = mysql_fetch_array($result)) {
$f_name = stripslashes($info['f_name']);
$s_name = stripslashes($info['s_name']);
$l_name = stripslashes($info['l_name']);
}
//set authorization cookie
setcookie("auth", "1", 0, "/", "yourdomain.com", 0);
//create display string
$display_block = "<p>".$f_name." ".$l_name." is authorized!</p>

<p>Authorized Users’ Menu:</p>
<ul>
<li><a href=\"secretpage.php\">secret page</a></li>
</ul>";
} else {
//redirect back to login form if not authorized
header("Location: userlogin.html");
exit;
}
//close connection to MySQL
mysql_close($data);
?>
<!DOCTYPE html>
<html>
<head>
<title>Sign in</title>
</head>
<body>
<?php echo $display_block; ?>
</body>
</html>
