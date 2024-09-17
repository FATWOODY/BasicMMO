<?php

$inadmin = "y";
require 'includes/header.php';
require 'includes/admin.php';
?>
Welcome to the Administration Panel!<br><br>
| <b>Site Settings</b><br>
<?php
$result = $db->query( "SELECT sGroup, count(*) AS sCount FROM settings GROUP BY sGroup" );
$pnum2 = 0;
while ( $temp = $db->fetch( $result ) ) {
    echo "&nbsp;&nbsp;> <a href='admin_settings.php?p=" . $temp['sGroup'] . "' style=\"text-decoration: none;\">" . $temp['sGroup'] . "</a><br>";
    $pnum2++;
}

?>
| <b>Content Settings</b><br>
&nbsp;&nbsp;> <a href="admin_news.php" style="text-decoration: none;">News Management</a><br>
&nbsp;&nbsp;> <a href="admin_polls.php" style="text-decoration: none;">Poll Management</a><br>
&nbsp;&nbsp;> <a href="admin_users.php" style="text-decoration: none;">User Management</a><br>
<br><br>
<?php

require 'includes/footer.php';

?>