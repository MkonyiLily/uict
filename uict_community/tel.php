
<?php
$display_block = "<form method=\"post\" action='".$_SERVER['PHP_SELF']."'>";
$display_block .= "<fieldset>";
$display_block .="<legend>Telephone Number:</legend><br/>";
$display_block .="<input type=\"text\" name=\"tel_number\" size=\"30\" maxlength=\"25\" />";
$display_block .="<input type=\"radio\" id=\"tel_type_h\" name=\"tel_type\" value=\"home\" checked />";
$display_block .="<label for=\"tel_type_h\">home</label>";
$display_block .= "<input type=\"radio\" id=\"tel_type_w\" name=\"tel_type\" value=\"work\" />";
$display_block .= "<label for=\"tel_type_w\">work</label>";
$display_block .= "<input type=\"radio\" id=\"tel_type_o\" name=\"tel_type\" value=\"other\" />";
$display_block .= "<label for=\"tel_type_o\">other</label>";
$display_block .= "&nbsp&nbsp<a href='tel.php'> add</a>";
$display_block .= "</fieldset>";
$display_block .= "<button type=\"submit\" name=\"submit\" value=\"send\">Add Entry</button></form>";
?>
<html><head>
<title>telephone number</title>
<h1>Telephone Number</h1>
</head>
<p>
<?php
echo $display_block;
if ($_POST['tel_number']) {
$safe_tel_number = mysql_real_escape_string($_POST['tel_number']);
//something relevant, so add to telephone table
$add_tel_sql="INSERT INTO telephone (reg_no, date_added,date_modified, tel_number, type) VALUES ('".$master_id."', now(), now(),'".$safe_tel_number."','".$_POST['tel_type']."')";
$add_tel_res = mysql_query( $add_tel_sql) or die(mysql_error($data));
}
?>
</p>
</html>

