<?php

$inadmin = "y";
require 'includes/header.php';
require 'includes/admin.php';

if ( $ALLOWED_ACTIONS['editplayers'] == 0 ) {
    echo "<meta http-equiv='refresh' content='1; url=index.php'>Redirecting, please hold on a moment.";
    exit();
} 

if ( !$_GET[stp] ) {

    ?>
	<table border="0" align="center">
	  <tr>
		<th>ID</th>
		<th>Name</th>
		<th colspan="2">Commands</th>
	  </tr>
	  <?php
    $perpage = 25;
    $pnum = $_GET['p'];
    if ( !$pnum ) {
        $pnum = 0;
    } 
    $lmin = $pnum * $perpage;
    $lmax = $lmin + $perpage;

    $result = $db->query( "SELECT uID,uLogin FROM users ORDER BY uID DESC LIMIT $lmin, $perpage" );
    while ( $users = $db->fetch( $result ) ) {
        echo "<tr>";
        echo "	<td>" . $users['uID'] . "</td>";
        echo "	<td>" . $users['uLogin'] . "</td>";
        echo "	<td align=\"center\"><a href=\"admin_users.php?stp=edit&id=" . $users['uID'] . "\"><img src=\"images/b_edit.gif\" border=\"0\"></a></td>";
        echo "	<td align=\"center\"><a href=\"admin_users.php?stp=delete&id=" . $users['uID'] . "\"><img src=\"images/b_drop.gif\" border=\"0\"></a></td>";
        echo "</tr>";
    } 

    ?>
	  <tr>
		<td colspan="4" align="center">
			<?php
    echo "<br>Page:<br>";
    $result = $db->query( "SELECT count(*) FROM users" );
    $temp = $db->fetch( $result );
    $pcount = ceil( $temp[0] / $perpage );
    $pnumtemp = 0;
    while ( $pnumtemp < $pcount ) {
        $pnum2 = $pnumtemp + 1;
        if ( $pnumtemp != $pnum ) {
            echo "<a href='admin_users.php?p=$pnumtemp'>$pnum2</a> ";
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
        $result = $db->query( "SELECT * FROM users WHERE uID='$editid'" );
        $users = $db->fetch( $result );
        $showthis = "<input name=\"uid\" type=\"hidden\" value=\"" . $users['uID'] . "\">";
        $submittext = "Edit";
    } 

    ?>
	<form action="admin_users.php?stp=edit2" method="post">
	<table border="0" align="center">
	  <tr>
		<td>
			<?=$showthis?>
			<b>Email</b>
			<br>
			<input name="uemail" type="text" value="<?=$users['uEmail']?>" size="60">
			<br><br>
			<b>Name</b>
			<br>
			<input name="ulogin" type="text" value="<?=$users['uLogin']?>" size="60">
			<br><br>
			<b>Password</b>
			<br>
			<input name="upassword" type="text" value="<?=$users['uPassword']?>" size="60">
			<br><br>
			<b>First Name</b>
			<br>
			<input name="ufirstname" type="text" value="<?=$users['uFirstName']?>" size="60">
			<br><br>
			<b>Last Name</b>
			<br>
			<input name="ulastname" type="text" value="<?=$users['uLastName']?>" size="60">
			<br><br>
			<b>Gender</b>
			<br>
			<?php
    if ( $users['uGender'] == 'Male' ) {
        $ugen[0] = ' selected';
    } else {
        $ugen[1] = ' selected';
    } 

    ?>
			<select name="ugender">
				<option value="Male"<?=$ugen[0]?>>Male</option>
				<option value="Female"<?=$ugen[1]?>>Female</option>
			</select>
			<br><br>
			<b>Race</b>
			<br>
			<?php
    $dssel = $users['uRace'] + 1;
    $ugen[$dssel] = ' selected';

    ?>
			<select name="urace">
				<option value="1"<?=$ugen[2]?>><?=$SETTINGS['prace_1']?></option>
				<option value="2"<?=$ugen[3]?>><?=$SETTINGS['prace_2']?></option>
				<option value="3"<?=$ugen[4]?>><?=$SETTINGS['prace_3']?></option>
				<option value="4"<?=$ugen[5]?>><?=$SETTINGS['prace_4']?></option>
				<option value="5"<?=$ugen[6]?>><?=$SETTINGS['prace_5']?></option>
				<option value="6"<?=$ugen[7]?>><?=$SETTINGS['prace_6']?></option>
			</select>
			<br><br>
			<b>Gold</b>
			<br>
			<input name="ugold" type="text" value="<?=$users['uGold']?>" size="60">
			<br><br>
			<b>Bank</b>
			<br>
			<input name="ubank" type="text" value="<?=$users['uBank']?>" size="60">
			<br><br>
			<b>Citizens</b>
			<br>
			<input name="ucitizens" type="text" value="<?=$users['uCitizens']?>" size="60">
			<br><br>
			<b>Offensive Men</b>
			<br>
			<input name="uoffensivemen" type="text" value="<?=$users['uOffensiveMen']?>" size="60">
			<br><br>
			<b>Defensive Men</b>
			<br>
			<input name="udefensivemen" type="text" value="<?=$users['uDefensiveMen']?>" size="60">
			<br><br>
			<b>Miners</b>
			<br>
			<input name="uminers" type="text" value="<?=$users['uMiners']?>" size="60">
			<br><br>
			<b>Status</b>
			<br>
			<?php
    $dssel = $users['uRank'] + 10;
    $ugen[$dssel] = ' selected';

    ?>
			<select name="urank">
				<option value="5"<?=$ugen[15]?>>Owner</option>
				<option value="4"<?=$ugen[14]?>>Admin</option>
				<option value="3"<?=$ugen[13]?>>Moderator</option>
				<option value="1"<?=$ugen[11]?>>Member</option>
			</select>
			<br><br>
			<input name="sumbit" type="submit" value="<?=$submittext?>">
		</td>
	  </tr>
	</table>
	</form>
	<?php
} elseif ( $_GET['stp'] == "edit2" ) {
    $frmempty = 0;
    foreach( $_POST as $value ) {
        if ( $value == '' ) {
            $frmempty++;
        } 
    } 
    if ( $frmempty > 0 ) {
        echo "You did not complete all of the fields.";
    } else {
        $uemail = strip_tags( stripslashes( $_POST['uemail'] ) );
        $ulogin = htmlentities( stripslashes( $_POST['ulogin'] ) );
        $upassword = stripslashes( $_POST['upassword'] );
        $ufirstname = htmlentities( stripslashes( $_POST['ufirstname'] ) );
        $ulastname = htmlentities( stripslashes( $_POST['ulastname'] ) );
        $ugender = htmlentities( stripslashes( $_POST['ugender'] ) );
        $urace = $_POST['urace'];
        $ugold = $_POST['ugold'];
        $ubank = $_POST['ubank'];
        $ucitizens = $_POST['ucitizens'];
        $uoffensivemen = $_POST['uoffensivemen'];
        $udefensivemen = $_POST['udefensivemen'];
        $uminers = $_POST['uminers'];
        $urank = $_POST['urank'];

        $edid = round( $_POST['uid'] );
        if ( $edid == 1 ) {
            $urank = 5;
            $nmessg = 'The Status of this account will not be changed.';
        } 
        $dbquerysql = "UPDATE users SET uEmail=\"$uemail\",uLogin=\"$ulogin\",uPassword=\"$upassword\",uFirstName=\"$ufirstname\",uLastName=\"$ulastname\",uGender=\"$ugender\",uRace=\"$urace\",uGold=\"$ugold\",uBank=\"$ubank\",uCitizens=\"$ucitizens\",uOffensiveMen=\"$uoffensivemen\",uDefensiveMen=\"$udefensivemen\",uMiners=\"$uminers\",uRank=\"$urank\" WHERE uID=\"$edid\"";
        $db->query( $dbquerysql );
        echo "You successfully edited this user. $nmessg";
    } 
} elseif ( $_GET['stp'] == "delete" ) {
    $delid = round( $_GET['id'] );
    echo "Are you sure you want to delete this user? This process is irreversible!<br>";
    echo "<a href=\"admin_users.php?stp=delete2&id=" . $delid . "\">Yes, Delete this user.</a>";
} elseif ( $_GET['stp'] == "delete2" ) {
    $delid = round( $_GET['id'] );
    if ( $delid != 1 ) {
        $db->query( "DELETE FROM users WHERE uID='$delid'" );
        echo "This user has been successfully deleted.";
    } else {
        echo "You can not delete this user.";
    } 
} 
require 'includes/footer.php';

?>