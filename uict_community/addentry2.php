<?php
require_once("../conn/db_conn.php");
if ((!$_POST) || ($_GET['reg_no'] != "")) {
//haven’t seen the form, so show it
$display_block = "<form method=\"post\" action=\"".$_SERVER['PHP_SELF']."\">";
if (isset($_GET['reg_no'])) {
//create safe version of ID
$safe_id = mysql_real_escape_string( $_GET['reg_no']);
//get first, last names for display/tests validity
$get_names_sql ="SELECT concat_ws('  ', f_name, s_name, l_name) AS display_name FROM master_name WHERE reg_no = '".$safe_id."'";
$get_names_res = mysql_query($get_names_sql) or die(mysql_error());
if (mysql_num_rows($get_names_res) == 1) {
while ($name_info = mysql_fetch_array($get_names_res)) {
$display_name = stripslashes($name_info['display_name']);
   }
  }
}
if (isset($display_name)) {
$display_block .= "<p>Adding information for <strong>$display_name</strong>:</p>";
} else {
$display_block .= <<<END_OF_TEXT
<fieldset>
<legend>Member registration:</legend><br/>
<table><tr><td><label for=\"reg_no\">Registration no:</label></td><td><input type=\"text\" name=\"reg_no\" size=\"30\" maxlength=\"75\" required=\"required\" /></td></tr>
<tr><td><label for=\"f_name\">First name:</label></td><td><input type=\"text\" name=\"f_name\" size=\"30\" maxlength=\"75\" required=\"required\" /></td></tr>
<tr><td><label for=\"s_name\">Second name:</label></td><td><input type=\"text\" name=\"s_name\" size=\"30\" maxlength=\"75\" required=\"required\" /></td></tr>
<tr><td><label for=\"l_name\">Last name:</label></td><td><input type=\"text\" name=\"l_name\" size=\"30\" maxlength=\"75\" required=\"required\" /></td></tr>

<tr><td><label for=\"gender\">Gender:</label></td><td><select  name=\"gender\" value=\"gender\"><option>-- select --</option><option>M</option>
<option>F</option></select></td></tr>
<tr><td><label for=\"marital_status\">Marital Status:</label></td><td><select name=\"marital_status\" ><option>-- select --</option>
     <option>Single</option> <option> Double</option> <option>See someone</option><option>Silence</option></select>

</td></tr>
<tr><td><label for=\"position\">Position</label></td><td><input type=\"text\" name=\"position\" size=\"30\" maxlength=\"75\" required=\"required\" /></td></tr></table>
</fieldset>
END_OF_TEXT;
}
$display_block .= <<<END_OF_TEXT
<p><label for='address'>Street Address:</label><br/>
<input type='text' id='address' name='address' size='30' /></p>
<fieldset>
<legend>City/State/Zip:</legend><br/>
<input type='text' name='city' size='30' maxlength='50' />
<input type='text' name='state' size='5' maxlength='2' />
<input type='text' name='zipcode' size='10' maxlength='10' />
</fieldset>
<fieldset>
<legend>Address Type:</legend><br/>
<input type='radio' id='add_type_h' name='add_type'
value='home' checked />
<label for='add_type_h'>home</label>
<input type='radio' id='add_type_w' name='add_type' value='work' />
<label for='add_type_w'>work</label>
<input type='radio' id='add_type_o' name='add_type' value='other' />
<label for='add_type_o'>other</label>
</fieldset>
<fieldset>
<legend>Telephone Number:</legend><br/>
<input type='text' name='tel_number' size='30' maxlength='25' />
<input type='radio' id='tel_type_h' name='tel_type' value='home' checked />
<label for='tel_type_h'>home</label>
<input type='radio' id='tel_type_w' name='tel_type' value='work' />
<label for='tel_type_w'>work</label>
<input type='radio' id='tel_type_o' name='tel_type' value=other' />
<label for='tel_type_o'>other</label>
</fieldset>
<fieldset>
<legend>Fax Number:</legend><br/>
<input type='text' name='fax_number' size='30' maxlength='25' />
<input type='radio' id='fax_type_h' name='fax_type' value='home' checked />
<label for='fax_type_h'>home</label>
<input type='radio' id='fax_type_w' name='fax_type' value='work' />
<label for='fax_type_w'>work</label>
<input type='radio' id='fax_type_o' name='fax_type' value='other' />
<label for='fax_type_o'>other</label>
</fieldset>
<fieldset>
<legend>Email Address:</legend><br/>
<input type='email' name='email' size='30' maxlength='150' />
<input type='radio' id='email_type_h' name='email_type' value='home' checked />
<label for='email_type_h'>home</label>
<input type='radio' id='email_type_w' name='email_type' value='work' />
<label for='email_type_w'>work</label>
<input type='radio' id='email_type_o' name='email_type' value='other' />
<label for='email_type_o'>other</label>
</fieldset>
<p><label for='note'>Personal Note:</label><br/>
<textarea id='note' name='note' cols='56'
rows='3'></textarea></p>
END_OF_TEXT;
if ($_GET) {
$display_block .= "<input type=\"hidden\" name=\"reg_no\" value=\"".$_GET['reg_no']."\">";
}
$display_block .= "<button type=\"submit\" name=\"submit\" value=\"send\">Add Entry</button></form>";

} else if ($_POST) {
//time to add to tables, so check for required fields
if ((($_POST['f_name'] == "") || ($_POST['l_name'] == "")) &&
(!isset($_POST['reg_no']))) {
header('Location: addentry.php');
exit;
}
//connect to database

require_once("../conn/db_conn.php");
//create clean versions of input strings
$safe_reg_no = mysql_real_escape_string($_POST['reg_no']);
$safe_f_name = mysql_real_escape_string($_POST['f_name']);
$safe_l_name = mysql_real_escape_string($_POST['l_name']);
$safe_address = mysql_real_escape_string($_POST['address']);
$safe_city = mysql_real_escape_string($_POST['city']);
$safe_state = mysql_real_escape_string($_POST['state']);
$safe_zipcode = mysql_real_escape_string($_POST['zipcode']);
$safe_tel_number = mysql_real_escape_string($_POST['tel_number']);
$safe_fax_number = mysql_real_escape_string($_POST['fax_number']);
$safe_email = mysql_real_escape_string($_POST['email']);
$safe_note = mysql_real_escape_string($_POST['note']);
if (!$_POST['reg_no']) {
//add to master_name table
$add_master_sql = "INSERT INTO master_name (reg_no,date_added,date_modified,f_name, l_name) VALUES ('".$safe_reg_no."',now(), now(),'".$safe_f_name."', '".$safe_l_name."')";
$add_master_res = mysql_query($add_master_sql) or die(mysql_error());
//get master_id for use with other tables
$master_id = $safe_reg_no;
} else {
$master_id = mysql_real_escape_string($_POST['reg_no']);
}
if (($_POST['address']) || ($_POST['city']) ||
($_POST['state']) || ($_POST['zipcode'])) {
//something relevant, so add to address table
$add_address_sql = "INSERT INTO address (reg_no,
date_added, date_modified, address, city, state,
zipcode, type) VALUES
('".$master_id."', now(), now(),'".$safe_address."', '".$safe_city."','".$safe_state."' ,'".$safe_zipcode."' ,'".$_POST['add_type']."')";
$add_address_res = mysql_query($add_address_sql) or die(mysql_error());
}
if ($_POST['tel_number']) {
//something relevant, so add to telephone table
$add_tel_sql = "INSERT INTO telephone (reg_no, date_added,
date_modified, tel_number, type) VALUES ('".$master_id."', now(), now(),'".$safe_tel_number."', '".$_POST['tel_type']."')";
$add_tel_res = mysql_query($add_tel_sql) or die(mysql_error());
}
if ($_POST['fax_number']) {
//something relevant, so add to fax table
$add_fax_sql = "INSERT INTO fax (reg_no, date_added,
date_modified, fax_number, type) VALUES('".$master_id."', now(), now(), '".$safe_fax_number."','".$_POST['fax_type']."')";
$add_fax_res = mysql_query($add_fax_sql) or die(mysql_error());
}
if ($_POST['email']) {
//something relevant, so add to email table
$add_email_sql = "INSERT INTO email (reg_no, date_added,
date_modified, email, type) VALUES ('".$master_id."', now(), now(), '".$safe_email."','".$_POST['email_type']."')";
$add_email_res = mysql_query($add_email_sql) or die(mysql_error());
}
if ($_POST['note']) {
//something relevant, so add to notes table
$add_notes_sql = "UPDATE personal_notes set note ='".$safe_note."', date_modified = now() WHERE reg_no = '".$master_id."'";
}
mysql_close($data);
$display_block = "<p>Your entry has been added. Would you like to <a href=\"addentry2.php?reg_no=".."\">add another</a>?</p>";
}
?>
<!DOCTYPE html>
<head>
<title>Add an Entry</title>
</head>
<body>
<h1>Add an Entry</h1>
<?php echo $display_block; ?>
</body>
</html>
