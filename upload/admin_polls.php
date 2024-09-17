<?php

$inadmin = "y";
require 'includes/header.php';
require 'includes/admin.php';

if ( $ALLOWED_ACTIONS['polls'] == 0 ) {
    echo "<meta http-equiv='refresh' content='1; url=index.php'>Redirecting, please hold on a moment.";
    exit();
} 

if ( !$_GET['stp'] ) {

    ?>
	<center>
		<b>Create Poll</b><br>
		<form method="POST" action="admin_polls.php?stp=2">
		  <table border="0" width="30%">
			<tr>
			  <td width="86%">How many answers would you like to enter at most?<BR>
			  <input type="text" name="answers" size="46" value="4"></td>
			</tr>
			<tr>
			  <td width="86%"><input type="submit" value="Next Step" name="Submit"></td>
			</tr>
		  </table>
		</form>
		<br><br>
		<b>Delete Poll</b><br>
		<form method="POST" action="admin_polls.php?stp=d">
		<select size="1" name="delthis">
			<?php
    $result = $db->query( "SELECT pID,pQuestion FROM polls ORDER BY pID DESC" );
    while ( $pollz = $db->fetch( $result ) ) {
        echo "<option value=\"" . $pollz['pID'] . "\">" . $pollz['pQuestion'] . "</option>";
    } 

    ?>
		</select>
		<input type="submit" value="Delete" name="delete">
		</form>
		<br><br>
		<b>View Poll</b><br>
		<form method="POST" action="index.php">
		<select size="1" name="pid">
			<?php
    $result = $db->query( "SELECT pID,pQuestion FROM polls ORDER BY pID DESC" );
    while ( $pollz = $db->fetch( $result ) ) {
        echo "<option value=\"" . $pollz['pID'] . "\">" . $pollz['pQuestion'] . "</option>";
    } 

    ?>
		</select>
		<input type="submit" value="View Results" name="view">
		</form>
	</center>
	<?php
} elseif ( $_GET['stp'] == "d" ) {
    echo "This poll has been successfully deleted.";
    $result = $db->query( "DELETE FROM polls WHERE pID=" . $_POST['delthis'] );
} elseif ( $_GET['stp'] == 2 ) {

    ?>
	<center>
		<form method="POST" action="admin_polls.php?stp=3">
		  <table border="0" width="30%">
			<tr>
			  <td width="86%">Question:<BR><input type="text" name="question" size="46"><BR><BR></td>
			</tr>
			<?php
    $totalanswers = floor( $_POST['answers'] );
    if ( $totalanswers < 2 ) {
        $totalanswers = 2;
    } 
    $totalanswers++;
    $x = 1;
    while ( $x != $totalanswers ) {

        ?>
				<tr>
				  <td width="86%">Answer <?=$x?>:<BR><input type="text" name="answer<?=$x?>" size="46"></td>
				</tr>
				<?php
        $x++;
    } 

    ?>
			<tr>
			  <td width="86%"><input type="hidden" value="<?=$totalanswers?>" name="totansw"><input type="submit" value="Create Poll" name="Submit"></td>
			</tr>
		  </table>
		</form>
	</center>
	<?php
} elseif ( $_GET[stp] == 3 ) {
    $sql_ques = htmlentities( $_POST['question'], ENT_QUOTES );
    $totalanswers = floor( $_POST['totansw'] );
    $x = 1;
    $x2 = 0;
    while ( $x != $totalanswers ) {
        $checkr = "answer$x";
        $test = stripslashes( htmlentities( $_POST[$checkr], ENT_QUOTES ) );
        if ( $test ) {
            if ( $x2 == 0 ) {
                $sql_answ .= "$test";
                $sql_resu .= "0";
            } else {
                $sql_answ .= ";$test";
                $sql_resu .= ";0";
            } 
            $x2++;
        } 
        $x++;
    } 
    if ( !$sql_ques ) {
        echo "You must enter a Question for the Poll.";
    } elseif ( $x2 < 2 ) {
        echo "You must have at least 2 Answers for the Poll.";
    } else {
        echo "Your poll was successfully created.";
        $db->query( "INSERT INTO polls (pQuestion,pAnswers,pResults) VALUES (\"$sql_ques\",\"$sql_answ\",\"$sql_resu\")" );
    } 
    echo "<BR><BR>";
} 

require 'includes/footer.php';

?>