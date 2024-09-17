<?php
$ingame = "*";
require 'includes/header.php';
?>
<b><tl>Game Statistics</tl></b><br />
<img alt="" src="images/seperator.gif" /><br />

<!-- Table for Game Statistics -->
<table width="500" border="0">
  <tr>
    <td class="bodycell4" width="50%" valign="top">
      <div class="smlhead">Totals</div><br>
      <table width="100%" border="1" cellpadding="5">
        <tr>
          <th>Category</th>
          <th>Value</th>
        </tr>
        <?php
        $thetotal = $db->fetch($db->query("SELECT sum(uGold) AS uGold, sum(uBank) AS uBank, sum(uCitizens) AS uCitizens, sum(uOffensiveMen) AS uOffensiveMen, sum(uDefensiveMen) AS uDefensiveMen, sum(uMiners) AS uMiners FROM users"));
        $thetotal2 = $db->fetch($db->query("SELECT count(*) AS uCount FROM users WHERE uGender='Male'"));
        $thetotal3 = $db->fetch($db->query("SELECT count(*) AS uCount FROM users WHERE uGender='Female'"));
        $thetotal4 = $db->fetch($db->query("SELECT count(*) AS uCount FROM users WHERE uRace='1'"));
        $thetotal5 = $db->fetch($db->query("SELECT count(*) AS uCount FROM users WHERE uRace='2'"));
        $thetotal6 = $db->fetch($db->query("SELECT count(*) AS uCount FROM users WHERE uRace='3'"));
        $thetotal7 = $db->fetch($db->query("SELECT count(*) AS uCount FROM users WHERE uRace='4'"));
        $thetotal8 = $db->fetch($db->query("SELECT count(*) AS uCount FROM users WHERE uRace='5'"));
        $thetotal9 = $db->fetch($db->query("SELECT count(*) AS uCount FROM users WHERE uRace='6'"));
        
        // Displaying the totals in the table rows
        echo "
        <tr><td>Gold</td><td>{$thetotal['uGold']}</td></tr>
        <tr><td>Bank</td><td>{$thetotal['uBank']}</td></tr>
        <tr><td>Overall Gold</td><td>" . ($thetotal['uGold'] + $thetotal['uBank']) . "</td></tr>
        <tr><td>Citizens</td><td>{$thetotal['uCitizens']}</td></tr>
        <tr><td>Offensive Men</td><td>{$thetotal['uOffensiveMen']}</td></tr>
        <tr><td>Defensive Men</td><td>{$thetotal['uDefensiveMen']}</td></tr>
        <tr><td>Miners</td><td>{$thetotal['uMiners']}</td></tr>
        <tr><td>Population</td><td>" . ($thetotal['uCitizens'] + $thetotal['uOffensiveMen'] + $thetotal['uDefensiveMen'] + $thetotal['uMiners']) . "</td></tr>
        <tr><td>{$SETTINGS['prace_1']}</td><td>{$thetotal4['uCount']}</td></tr>
        <tr><td>{$SETTINGS['prace_2']}</td><td>{$thetotal5['uCount']}</td></tr>
        <tr><td>{$SETTINGS['prace_3']}</td><td>{$thetotal6['uCount']}</td></tr>
        <tr><td>{$SETTINGS['prace_4']}</td><td>{$thetotal7['uCount']}</td></tr>
        <tr><td>{$SETTINGS['prace_5']}</td><td>{$thetotal8['uCount']}</td></tr>
        <tr><td>{$SETTINGS['prace_6']}</td><td>{$thetotal9['uCount']}</td></tr>
        <tr><td>Male</td><td>{$thetotal2['uCount']}</td></tr>
        <tr><td>Female</td><td>{$thetotal3['uCount']}</td></tr>
        ";
        ?>
      </table>
    </td>
    <td class="bodycell4" width="50%" valign="top">
      <div class="smlhead">Top 10</div><br>
      <table width="100%" border="1" cellpadding="5">
        <tr>
          <th>Category</th>
          <th>Players</th>
          <th>Value</th>
        </tr>
        <?php
        // Top 10 Richest
        $lefttd = "<b>Richest</b>";
        $result = $db->query("SELECT uID, uLogin, (uGold+uBank) AS uMoney FROM users ORDER BY uMoney DESC LIMIT 10");
        while ($themost = $db->fetch($result)) {
            echo "<tr><td>Richest</td><td><a href=\"profile.php?id=" . $themost['uID'] . "\">" . $themost['uLogin'] . "</a></td><td>" . $themost['uMoney'] . "</td></tr>";
        }

        // Top 10 Population
        $result = $db->query("SELECT uID, uLogin, (uCitizens+uOffensiveMen+uDefensiveMen+uMiners) AS uPopulation FROM users ORDER BY uPopulation DESC LIMIT 10");
        while ($themost = $db->fetch($result)) {
            echo "<tr><td>Population</td><td><a href=\"profile.php?id=" . $themost['uID'] . "\">" . $themost['uLogin'] . "</a></td><td>" . $themost['uPopulation'] . "</td></tr>";
        }

        // Top 10 Army Size
        $result = $db->query("SELECT uID, uLogin, (uOffensiveMen+uDefensiveMen) AS uArmySize FROM users ORDER BY uArmySize DESC LIMIT 10");
        while ($themost = $db->fetch($result)) {
            echo "<tr><td>Army Size</td><td><a href=\"profile.php?id=" . $themost['uID'] . "\">" . $themost['uLogin'] . "</a></td><td>" . $themost['uArmySize'] . "</td></tr>";
        }
        ?>
      </table>
    </td>
  </tr>
</table>

<?php
require 'includes/footer.php';
?>
