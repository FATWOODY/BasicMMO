<?php
$ingame = "*";
require 'includes/header.php';

// Check if an attack is being initiated (when a player clicks the "Attack" link)
if (isset($_GET['id'])) {
    // The ID of the target player
    $target_id = intval($_GET['id']);
    
    // Fetch the details of the target player
    $target = $db->fetch($db->query("SELECT * FROM users WHERE uID = '$target_id'"));
    
    if (!$target) {
        echo "Error: Player not found.";
    } else {
        // Get the attacker's level from session or database
        $attacker_level = $user['uLevel'];  // Assuming $user contains the attacker's info with their level

        // Check if the target is within 5 levels of the attacker
        $target_level = $target['uLevel'];
        if (abs($attacker_level - $target_level) > 5) {
            echo "<span style='color: red; font-weight: bold;'>You can only attack players within 5 levels of your own.</span><br>";
        } else {
            // Example attack logic
            echo "<b>Attacking " . $target['uLogin'] . "</b><br />";

            // Define success (replace this with actual game logic)
            $attack_success = true; // You can replace this with actual success logic

            if ($attack_success) {
                echo "<span style='color: green; font-weight: bold;'>Successful!</span><br>";

                // Generate a random percentage (between 10% and 50%) of the target's unbanked gold
                $percentage = rand(10, 50) / 100;
                $stolen_gold = round($target['uGold'] * $percentage);

                // Reduce the target's unbanked gold
                $db->query("UPDATE users SET uGold = uGold - $stolen_gold WHERE uID = '$target_id'");

                // Add the stolen gold to the attacker's unbanked gold
                $attacker_id = $user['uID']; // Assume $user contains the attacker's info
                $db->query("UPDATE users SET uGold = uGold + $stolen_gold WHERE uID = '$attacker_id'");

                echo "You have stolen $stolen_gold gold from " . $target['uLogin'] . ".<br>";
            } else {
                echo "<span style='color: red; font-weight: bold;'>Unsuccessful!</span><br>";
            }
        }

        // Provide a link back to the attack page
        echo "<br><br><a href=\"attack.php\">Back to attack page</a>";
    }
} else {
    // Core logic for the attack page listing
    if (!$_GET['id'] && !$_POST['turns'] && !$_POST['id']) {

        // If searching for a specific player by username
        if ($_POST['find_username']) {
            $theuser = htmlentities(stripslashes($_POST['username']));
            $whereclause = " WHERE uLogin LIKE '%$theuser%'";
        } else {
            $whereclause = "";
        }

        // Fetch the total number of users
        $users_total = $db->fetch($db->query("SELECT count(*) AS total FROM users $whereclause"));
        $pages = ceil($users_total['total'] / 25);

        // Determine current page
        $currentpage = isset($_GET['p']) ? round($_GET['p']) : 0;
        if ($currentpage < 0) $currentpage = 0;
        if ($currentpage >= $pages) $currentpage = $pages - 1;

        // Pagination: Limit the number of users displayed per page
        $lmin = $currentpage * 25;
        $lmax = 25;

        // Fetch players from the database
        $result = $db->query("SELECT uID, uLogin FROM users $whereclause LIMIT $lmin, $lmax");
        ?>

        <b>Find Players to Attack</b><br />
        <form action="attack.php" method="post">
            <input type="text" name="username" placeholder="Enter username">
            <input type="submit" name="find_username" value="Search">
        </form>
        <br />

        <table width="500" border="1">
            <tr>
                <th>Player</th>
                <th>Actions</th>
            </tr>
            <?php
            // Display the list of players
            while ($player = $db->fetch($result)) {
                echo "<tr>";
                echo "<td><a href=\"profile.php?id=" . $player['uID'] . "\">" . $player['uLogin'] . "</a></td>";
                echo "<td><a href=\"attack.php?id=" . $player['uID'] . "\">Attack</a></td>";
                echo "</tr>";
            }
            ?>
        </table>

        <?php
        // Pagination Links
        if ($currentpage > 0) {
            echo "<a href=\"attack.php?p=" . ($currentpage - 1) . "\">Previous</a> | ";
        }
        if ($currentpage + 1 < $pages) {
            echo "<a href=\"attack.php?p=" . ($currentpage + 1) . "\">Next</a>";
        }
    }
}

// Include the footer to complete the page layout
require 'includes/footer.php';
?>
