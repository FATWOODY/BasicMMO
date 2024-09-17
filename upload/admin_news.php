<?php

$inadmin = "y";
require 'includes/header.php';
require 'includes/admin.php';

if ( $ALLOWED_ACTIONS['news'] == 0 ) {
    echo "<meta http-equiv='refresh' content='1; url=index.php'>Redirecting, please hold on a moment.";
    exit();
} 

if ( !$_GET[stp] ) {

    ?>
	<table border="0" align="center">
	  <tr>
		<th>Date</th>
		<th>Title</th>
		<th colspan="2">Commands</th>
	  </tr>
	  <tr>
		<td colspan="2"></td>
		<td colspan="2" align="center"><a href="admin_news.php?stp=edit">add news</a></th>
	  </tr>
	  <?php
    $perpage = $SETTINGS['Admin_News_Items_Per_Page'];

    $pnum = $_GET['p'];
    if ( !$pnum ) {
        $pnum = 0;
    } 
    $lmin = $pnum * $perpage;
    $lmax = $lmin + $perpage;

    $result = $db->query( "SELECT nID,nDate,nTitle FROM news ORDER BY nID DESC LIMIT $lmin, $perpage" );
    while ( $news = $db->fetch( $result ) ) {
        echo "<tr>";
        echo "	<td>" . $news['nDate'] . "</td>";
        echo "	<td>" . $news['nTitle'] . "</td>";
        echo "	<td align=\"center\"><a href=\"admin_news.php?stp=edit&id=" . $news['nID'] . "\"><img src=\"images/b_edit.gif\" border=\"0\"></a></td>";
        echo "	<td align=\"center\"><a href=\"admin_news.php?stp=delete&id=" . $news['nID'] . "\"><img src=\"images/b_drop.gif\" border=\"0\"></a></td>";
        echo "</tr>";
    } 

    ?>
	  <tr>
		<td colspan="4" align="center">
			<?php
    echo "<br>Page:<br>";
    $result = $db->query( "SELECT count(*) FROM news" );
    $temp = $db->fetch( $result );
    $pcount = ceil( $temp[0] / $perpage );
    $pnumtemp = 0;
    while ( $pnumtemp < $pcount ) {
        $pnum2 = $pnumtemp + 1;
        if ( $pnumtemp != $pnum ) {
            echo "<a href='admin_news.php?p=$pnumtemp'>$pnum2</a> ";
        } else {
            echo "<b>$pnum2</b> ";
        } 
        $pnumtemp++;
    } 

    ?>
		</td>
	  </tr>
	</table>
	<?php
} elseif ( $_GET['stp'] == "edit" ) {
    $editid = round( $_GET['id'] );
    if ( $editid ) {
        $result = $db->query( "SELECT * FROM news WHERE nID='$editid'" );
        $news = $db->fetch( $result );
        $showthis = "<input name=\"nid\" type=\"hidden\" value=\"" . $news['nID'] . "\">";
        $submittext = "Edit";
    } else {
        $submittext = "Add";
    } 

    ?>
	<form action="admin_news.php?stp=edit2" method="post">
	<table border="0" align="center">
	  <tr>
		<td>
			<?=$showthis?>
			<b>News Date</b>
			<br>
			<input name="ndate" type="text" value="<?=$news['nDate']?>" size="60">
			<br>
			<b>News Title</b>
			<br>
			<input name="ntitle" type="text" value="<?=$news['nTitle']?>" size="60">
			<br>
			<b>News Body</b>
			<br>
			<textarea name="nbody" rows="10" cols="45"><?=$news['nBody']?></textarea>
			<br><br>
			<input name="sumbit" type="submit" value="<?=$submittext?>">
		</td>
	  </tr>
	</table>
	</form>
	<?php
} elseif ( $_GET['stp'] == "edit2" ) {
    if ( !$_POST['ndate'] || !$_POST['ntitle'] || !$_POST['nbody'] ) {
        echo "You did not complete all of the fields.";
    } else {
        $ndate = htmlentities( $_POST['ndate'] );
        $ntitle = htmlentities( $_POST['ntitle'] );
        $nbody = htmlentities( $_POST['nbody'] );
        if ( $_POST['nid'] ) {
            $edid = $_POST['nid'];
            $db->query( "UPDATE news SET nDate=\"$ndate\",nTitle=\"$ntitle\",nBody=\"$nbody\" WHERE nID='$edid'" );
            echo "You successfully updated this news item.";
        } else {
            $db->query( "INSERT INTO news (`nDate`,`nTitle`,`nBody`) VALUES (\"$ndate\",\"$ntitle\",\"$nbody\")" );
            echo "You successfully added this news item.";
        } 
    } 
} elseif ( $_GET['stp'] == "delete" ) {
    $delid = round( $_GET['id'] );
    $db->query( "DELETE FROM news WHERE nID='$delid'" );
    echo "This news item has been successfully deleted.";
} 
require 'includes/footer.php';

?>