<?php
require_once("../conn/db_conn.php");
//check for required info from the query string
if (!isset($_GET['topic_id'])) {
header("Location: topiclist.php");
exit;
}
//create safe values for use
$safe_topic_id = mysql_real_escape_string($_GET['topic_id']);
//verify the topic exists
$verify_topic_sql = "SELECT topic_title FROM forum_topics WHERE topic_id = '".$safe_topic_id."'";
$verify_topic_res = mysql_query($verify_topic_sql) or die(mysql_error($data));
if (mysql_num_rows($verify_topic_res) < 1) {
//this topic does not exist
$display_block = "<p><em>You have selected an invalid topic.<br/>Please <a href=\"topiclist.php\">try again</a>.</em></p>";
} else {
//get the topic title
while ($topic_info = mysql_fetch_array($verify_topic_res)) {
$topic_title = stripslashes($topic_info['topic_title']);
}
//gather the posts
$get_posts_sql = "SELECT post_id, post_text,DATE_FORMAT(post_create_time,'%b %e %Y<br/>%r') AS fmt_post_create_time, post_owner
FROM forum_posts WHERE topic_id = '".$safe_topic_id."' ORDER BY post_create_time ASC";
$get_posts_res = mysql_query( $get_posts_sql) or die(mysql_error($data));
//create the display string
$display_block .= "<p>Showing posts for the <strong>$topic_title</strong> topic:</p>";
$display_block .= "<table>";
$display_block .= "<tr>";
$display_block .= "<th>AUTHOR</th>";
$display_block .= "<th>POST</th>";
$display_block .= "</tr>";

while ($posts_info = mysql_fetch_array($get_posts_res)) {
$post_id = $posts_info['post_id'];
$post_text = nl2br(stripslashes($posts_info['post_text']));
$post_create_time = $posts_info['fmt_post_create_time'];
$post_owner = stripslashes($posts_info['post_owner']);
//add to display
$display_block .="<tr><td>$post_owner<br/><br/>created on:<br/>$post_create_time</td>";
$display_block .= "<td>$post_text<br/><br/>";
$display_block .= "<a href=\"replytopost.php?post_id=$post_id\">";
$display_block .= "<strong>REPLY TO POST</strong></a></td></tr>";
}
//free results

mysql_free_result($get_posts_res);
mysql_free_result($verify_topic_res);
//close connection to MySQL
mysql_close($data);
//close up the table
$display_block .= "</table>";
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Posts in Topic</title>
<style type="text/css">
table {
border: 1px solid black;
border-collapse: collapse;
}
th {
border: 1px solid black;
padding: 6px;
font-weight: bold;
background: #ccc;
}
td {
border: 1px solid black;
padding: 6px;
vertical-align: top;
}
.num_posts_col { text-align: center; }
</style>
</head>
<body>
<h1>Posts in Topic</h1>
<?php echo $display_block; ?>
</body>
</html>


