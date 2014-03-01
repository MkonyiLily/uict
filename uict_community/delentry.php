<?php
require_once("../conn/db_conn.php");
if (!$_POST) {
//haven’t seen the selection form, so show it
$display_block = "<h1>Select an Entry</h1>";
//get parts of records
$get_list_sql = "SELECT reg_no,CONCAT_WS(', ', l_name, f_name) AS display_name FROM master_name ORDER BY l_name, f_name";
$get_list_res = mysql_query($get_list_sql) or die(mysql_error($data));
if (mysql_num_rows($get_list_res) < 1) {
//no records
$display_block .= "<p><em>Sorry, no records to select!</em></p>";
} else {
//has records, so get results and print in a form
        $display_block .= "<form method=\"post\" action=\"".$_SERVER['PHP_SELF']."\">";
        $display_block .= "<p><label for=\"sel_id\">Select a Record:</label><br/>";
        $display_block .= "<select id=\"sel_id\" name=\"sel_id\" required=\"required\">";
        $display_block .= "<option value=\"\">-- Select One --</option>";
while ($recs = mysql_fetch_array($get_list_res)) {
    $id = $recs['reg_no'];
   $display_name = stripslashes($recs['display_name']);
   $display_block .= "<option value=\"".$id."\">".$display_name."</option>";
}
$display_block .= "</select><button type=\"submit\" name=\"submit\" value=\"view\">View Selected Entry\"></button></form>";
}
//free result
mysql_free_result($get_list_res);
} else if ($_POST) {
//check for required fields
if ($_POST['sel_id'] == "") {
header("Location: delentry.php");
exit;
}

//create safe version of ID
$safe_id = mysql_real_escape_string( $_POST['sel_id']);

//issue queries
$del_master_sql = "DELETE FROM master_name WHERE reg_no = '".$safe_id."'";
$del_master_res = mysql_query($del_master_sql) or die(mysql_error($data));
$del_address_sql = "DELETE FROM address WHERE reg_no = '".$safe_id."'";
$del_address_res = mysql_query($del_address_sql) or die(mysql_error($data));
$del_tel_sql = "DELETE FROM telephone WHERE reg_no = '".$safe_id."'";
$del_tel_res = mysql_query($del_tel_sql) or die(mysql_error($data));
$del_fax_sql = "DELETE FROM fax WHERE reg_no = '".$safe_id."'";
$del_fax_res = mysql_query($del_fax_sql) or die(mysql_error($data));
$del_email_sql = "DELETE FROM email WHERE reg_no = '".$safe_id."'";
$del_email_res = mysql_query($del_email_sql) or die(mysql_error($data));
$del_note_sql = "DELETE FROM personal_notes WHERE reg_no = '".$safe_id."'";
$del_note_res = mysql_query( $del_note_sql) or die(mysql_error($data));

mysql_close($data);
$display_block = "<h1>Record(s) Deleted</h1><p>Would you like to <a href=\"".$_SERVER['PHP_SELF']."\">delete another</a>?</p>";
}
?>
<!DOCTYPE html>
<html>
<head>
<title>My Records</title>
</head>
<body>
<?php echo $display_block; ?>
</body>
</html>
