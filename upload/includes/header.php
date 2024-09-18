<?
require 'includes/setup.php';

session_start();
if ( !$_SESSION['refid'] ) {
    $_SESSION['refid'] = floor( $_GET['u'] );
    $news = 1;
}
$thecode = $_SESSION['ht_mem'];
$result = $db->query( "SELECT uID FROM users_online WHERE uCode=\"$thecode\"" );
$elcode = $db->fetch( $result );

$ht_mem = $thecode;

$result = $db->query( "SELECT * FROM users WHERE uID=\"" . $elcode['uID'] . "\"" );
$user = $db->fetch( $result );

if ( !$user && $ingame == "*" ) {
    header( "Location: index.php" );
} elseif ( $user && $ingame != "*" && $inadmin != "y" ) {
    header( "Location: base.php" );
} elseif ( $_GET[u] && $ingame != "*" && $inadmin != "y" ) {
    header( "Location: register.php" );
}

if ( $user && $ingame == "*" ) {
    $db->query( "UPDATE users_online SET uTime=\"" . time() . "\",uIPAddress=\"" . $REMOTE_ADDR . "\" WHERE uID=\"" . $user['uID'] . "\"" );
}

/*
      Permissions
*/
if ( $user['uRank'] == 5 ) {
    $ALLOWED_ACTIONS['forums'] = 1;
    $ALLOWED_ACTIONS['news'] = 1;
    $ALLOWED_ACTIONS['polls'] = 1;
    $ALLOWED_ACTIONS['settings'] = 1;
    $ALLOWED_ACTIONS['deleteplayers'] = 1;
    $ALLOWED_ACTIONS['editplayers'] = 1;
} elseif ( $user['uRank'] == 4 ) {
    $ALLOWED_ACTIONS['forums'] = 1;
    $ALLOWED_ACTIONS['news'] = 1;
    $ALLOWED_ACTIONS['polls'] = 1;
    $ALLOWED_ACTIONS['settings'] = 0;
    $ALLOWED_ACTIONS['deleteplayers'] = 0;
    $ALLOWED_ACTIONS['editplayers'] = 0;
} elseif ( $user['uRank'] == 3 ) {
    $ALLOWED_ACTIONS['forums'] = 1;
    $ALLOWED_ACTIONS['news'] = 0;
    $ALLOWED_ACTIONS['polls'] = 0;
    $ALLOWED_ACTIONS['settings'] = 0;
    $ALLOWED_ACTIONS['deleteplayers'] = 0;
    $ALLOWED_ACTIONS['editplayers'] = 0;
} elseif ( $user[uRank] == 1 ) {
    $ALLOWED_ACTIONS['forums'] = 0;
    $ALLOWED_ACTIONS['news'] = 0;
    $ALLOWED_ACTIONS['polls'] = 0;
    $ALLOWED_ACTIONS['settings'] = 0;
    $ALLOWED_ACTIONS['deleteplayers'] = 0;
    $ALLOWED_ACTIONS['editplayers'] = 0;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<title><?=$SETTINGS['gametitle']?></title>
<base target="_top" />
<link rel="SHORTCUT ICON" href="/images/favicon.ico" />
<meta content="text/html;charset=UTF-8" http-equiv="Content-Type" />
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="cache-control" content="no-cache" />
<link rel="stylesheet" type="text/css" href="includes/style.css" />
<script language="JavaScript" type="text/javascript">
<!--
if (top.location != location) {
top.location.href = document.location.href ;
}
-->
</script>
<? require 'includes/dropdown.php'; ?>
</head>

<body>

<div id="container">
	<div class="logoarea">
	<? if ($user) { ?>
		<img alt="" src="images/header_1.gif" /><a onclick="return clickreturnvalue();" onmouseover="dropdownmenu(this, event, menu1, '150px'); document.images['home'].src = 'images/h_home_b.gif'" onmouseout="delayhidemenu(); document.images['home'].src = 'images/h_home_a.gif'" onmousedown="document.images['home'].src = 'images/h_home_b.gif'" onmouseup="document.images['home'].src = 'images/h_home_a.gif'"><img name="home" src="images/h_home_a.gif" alt="Home" /></a><img alt="" src="images/header_2.gif" /><a onclick="return clickreturnvalue();" onmouseover="dropdownmenu(this, event, menu2, '150px'); document.images['games'].src = 'images/h_rev_b.gif'" onmouseout="delayhidemenu(); document.images['games'].src = 'images/h_rev_a.gif'" onmousedown="document.images['games'].src = 'images/h_rev_b.gif'" onmouseup="document.images['games'].src = 'images/h_rev_a.gif'"><img name="games" src="images/h_rev_a.gif" alt="games" /></a><img alt="" src="images/header_3.gif" /><img alt="" src="images/header_logo.png" /><img alt="" src="images/header_4.gif" /><a onclick="return clickreturnvalue();" onmouseover="dropdownmenu(this, event, menu3, '150px'); document.images['usercp'].src = 'images/h_con_b.gif'" onmouseout="delayhidemenu(); document.images['usercp'].src = 'images/h_con_a.gif'" onmousedown="document.images['usercp'].src = 'images/h_con_b.gif'" onmouseup="document.images['usercp'].src = 'images/h_con_a.gif'"><img name="usercp" src="images/h_con_a.gif" alt="usercp" /></a><img alt="" src="images/header_5.gif" /><a href="https://discord.gg/tyBbY5As" onmouseover="document.images['forums'].src = 'images/h_forums_b.gif'" onmouseout="document.images['forums'].src = 'images/h_forums_a.gif'" onmousedown="document.images['forums'].src = 'images/h_forums_b.gif'" onmouseup="document.images['forums'].src = 'images/h_forums_a.gif'"><img name="forums" src="images/h_forums_a.gif" alt="forums" /></a>
		<? } else { ?>
		<center><img alt="" src="images/header_logo.png" /></center>
		<? } ?>
		
		</div>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
		<tr>
			<td class="leftmargin"></td>
			<td class="topnav"><img alt="" src="images/container_tl.gif" /></td>
			<td class="middlemargin">
			<img alt="" src="images/middlemargin_t.gif" /></td>
			<td class="topcontent"><img alt="" src="images/container_tr.gif" /></td>
			<td class="rightmargin"></td>
		</tr>
		<tr>
		
		<td class="leftmargin"></td>
			<td class="nav" align="center">
			<b><tl>Vote Links</tl></b><br />
			<img alt="" src="images/seperator.gif" /><br />
			<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script><script type="text/javascript">stLight.options({publisher:'5fdf3a8c-5fc3-4872-87f8-cb27999cc978'});</script>
            <span class="st_twitter_large" displayText="Tweet"></span><br /><span class="st_facebook_large" displayText="Facebook"></span><br /><span class="st_ybuzz_large" displayText="Yahoo! Buzz"></span><br /><span class="st_gbuzz_large" displayText="Google Buzz"></span><br /><span class="st_email_large" displayText="Email"></span><br /><span class="st_sharethis_large" displayText="ShareThis"></span><br /><br />
		    <b><tl>Affiliates</tl></b><br />
			<img alt="" src="images/seperator.gif" /><br />
			<a href="#">Your link here!</a><br />
			<a href="#">Your link here!</a><br />
			<a href="#">Your link here!</a><br />
			<a href="#">Your link here!</a><br /><br />
			<font color="black">10$/Month. Message in Discord</font>
			</td>
		
		<!-- THE ORIGINAL SIDEBAR!	<td class="leftmargin"></td>
			<td class="nav" align="center">
			<? if ($user) { 
			  $percentage_1 = getpower($user['uID'],$SETTINGS['dpower_1'],$SETTINGS['dpower_2'],$SETTINGS['dpower_3'],$SETTINGS['dpower_4'],$SETTINGS['dpower_5'],$SETTINGS['plant_output']);
			  $topbar = (100-$percentage_1);
			  
			  // Multiply for correct size
			  $percentage = ($percentage_1*'2.5');
			  $topbar = ($topbar*'2.5');
			  ?>
		<img src="images/power.gif" border="0" title="Power"><br /><br />
		<table border="0" width="11" cellspacing="0" cellpadding="0">
		  <tr>
		    <td width="100%">
	<table width="100%" height="250px" cellspacing="0" class="percentbar" style="border: 1px solid #000000;">
		<tr>
		  	<td height="<?=$topbar?>px" width="100%" class="pbred" title="Power in use"> </td>
		</tr>
		<tr>
			<td height="<?=$percentage?>px" width="100%" class="pbgreen" title="Avaliable Power"> </td>
		</tr>
	</table>
				    </td>
		  </tr>
		</table>
	<? } else { ?>
	<img src="images/welcome.gif" border="0">
	<? } ?>
			
			
			</td> -->
			
			
			<td class="middlemargin"></td>
			<td class="content">
			<table border="0" cellpadding="0" cellspacing="3">
				<tbody>
				<tr>
					<td class="news">
					
  <?php
if ( $user['uRandomEvents'] != 0 ) {
    $rand = rand( 1, 1000 );
    if ( $rand == 46 || $rand == 126 || $rand == 290 || $rand == 486 || $rand == 629 || $rand == 954 ) {
        $rand_cash = rand( 2500, 30000 );
        $db->query( "UPDATE users SET uGold=uGold+'$rand_cash',uRandomEvents=uRandomEvents-1 WHERE uID='" . $user['uID'] . "'" );

        ?><center><b>You just stumbled across <?=$rand_cash?> Gold. You decide to take it!</b></center><br /><?php
    }
    if ( $rand == 195 || $rand == 325 || $rand == 772 ) {
        $rand_citz = rand( 2, 10 );
        $db->query( "UPDATE users SET uCitizens=uCitizens+'$rand_citz',uRandomEvents=uRandomEvents-1 WHERE uID='" . $user['uID'] . "'" );

        ?><center><b><?=$rand_citz?> citizens turn up at your house asking if they can join your empire. You kindly accept!</center><br /><?php
    }
}

$newstuff = $db->fetch( $db->query( "SELECT count(*) FROM messages WHERE mTo='" . $user['uID'] . "' AND mRead='no'" ) );
if ( $newstuff[0] ) {

    ?><center><a href="pm.php">You have <?=$newstuff[0]?> new message<? if ($newstuff[0]!=1) { echo "s"; } ?></a></center><br /><?php
}

/* +10% ECONOMY */
if ($user['uRace']==1||$user['uRace']==2||$user['uRace']==3) {
  $discount = 10;
}

?>