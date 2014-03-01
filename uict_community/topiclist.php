
<?php
require_once("../conn/db_conn.php");
//gather the topics
$get_topics_sql = "SELECT topic_id, topic_title,DATE_FORMAT(topic_create_time, '%b %e %Y at %r') AS fmt_topic_create_time, topic_owner FROM forum_topics
ORDER BY topic_create_time DESC";
$get_topics_res = mysql_query($get_topics_sql) or die(mysql_error($data));
if (mysql_num_rows($get_topics_res) < 1) {
          //there are no topics, so say so
          $display_block = "<p><em>No topics exist.</em></p>";
          } else {
//create the display string
          $display_block .= "<table><tr><th>TOPIC TITLE</th><th># of POSTS</th></tr>";
while ($topic_info = mysql_fetch_array($get_topics_res)) {
               $topic_id = $topic_info['topic_id'];
               $topic_title = stripslashes($topic_info['topic_title']);
               $topic_create_time = $topic_info['fmt_topic_create_time'];
               $topic_owner = stripslashes($topic_info['topic_owner']);
//get number of posts
               $get_num_posts_sql = "SELECT COUNT(post_id) AS post_count FROM forum_posts WHERE topic_id = '".$topic_id."'";

$get_num_posts_res = mysql_query( $get_num_posts_sql) or die(mysql_error($data));
while ($posts_info = mysql_fetch_array($get_num_posts_res)) {
                 $num_posts = $posts_info['post_count'];
                          }
//add to display
     $display_block .= "<tr>";
$display_block .= "<td><a href=\"showtopic.php?topic_id=$topic_id\"><strong>$topic_title</strong></a><br/>Created on $topic_create_time by $topic_owner</td><td class=\"num_posts_col\">$num_posts</td></tr>";

}
//free results
         mysql_free_result($get_topics_res);
         mysql_free_result($get_num_posts_res);
//close connection to MySQL
         mysql_close($data);
//close up the table
$display_block .= "</table>";
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Topics in Forum</title>
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
}
.num_posts_col { text-align: center; }
</style>
</head>
<body>
<h1>Topics in Forum</h1>
<?php echo $display_block; ?>
<p>Would you like to <a href="addtopic.html">add a topic</a>?</p>
</body>
</html>
