<?php

require 'includes/header.php';
$gamename = "rogueBATTLE";

if (!$_GET['stp']) {

?>
    <b><tl>Register</tl></b><br />
    <img alt="" src="images/seperator.gif" /><br />
    <form action="register.php?stp=2" method="post">
        <table width="600" border="0" align="center">
            <tr>
                <td class="bodycell4" width="50%" align="right">
                    <b>Username:</b>
                </td>
                <td class="bodycell4" width="50%">
                    <input name="username" type="text" size="30" maxlength="16">
                </td>
            </tr>
            <tr>
                <td class="bodycell4" colspan="2" align="center">
                    Your username may be between 5 - 16 Characters.
                </td>
            </tr>
            <tr>
                <td class="bodycell4" width="50%" align="right">
                    <b>Password:</b>
                </td>
                <td class="bodycell4" width="50%">
                    <input name="password1" type="password" size="30">
                </td>
            </tr>
            <tr>
                <td class="bodycell4" width="50%" align="right">
                    <b>Re-type Password:</b>
                </td>
                <td class="bodycell4" width="50%">
                    <input name="password2" type="password" size="30">
                </td>
            </tr>
            <tr>
                <td class="bodycell4" colspan="2" align="center">
                    Your password may be between 5 - 10 Characters.
                </td>
            </tr>
            <tr>
                <td class="bodycell4" width="50%" align="right">
                    <b>Email:</b>
                </td>
                <td class="bodycell4" width="50%">
                    <input name="email1" type="text" size="30">
                </td>
            </tr>
            <tr>
                <td class="bodycell4" width="50%" align="right">
                    <b>Re-type Email:</b>
                </td>
                <td class="bodycell4" width="50%">
                    <input name="email2" type="text" size="30">
                </td>
            </tr>
            <tr>
                <td class="bodycell4" colspan="2" align="center">
                    Email must be correct as you need to validate your account.
                </td>
            </tr>
            <tr>
                <td class="bodycell4" width="50%" align="right">
                    <b>First Name:</b>
                </td>
                <td class="bodycell4" width="50%">
                    <input name="firstname" type="text" size="30">
                </td>
            </tr>
            <tr>
                <td class="bodycell4" width="50%" align="right">
                    <b>Last Name:</b>
                </td>
                <td class="bodycell4" width="50%">
                    <input name="lastname" type="text" size="30">
                </td>
            </tr>
            <tr>
                <td class="bodycell4" width="50%" align="right">
                    <b>Gender:</b>
                </td>
                <td class="bodycell4" width="50%">
                    <select name="gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="bodycell4" width="50%" align="right">
                    <b>Race:</b>
                </td>
                <td class="bodycell4" width="50%">
                    <select name="race">
                        <option value="1"><?=$SETTINGS['prace_1']?></option>
                        <option value="2"><?=$SETTINGS['prace_2']?></option>
                        <option value="3"><?=$SETTINGS['prace_3']?></option>
                        <option value="4"><?=$SETTINGS['prace_4']?></option>
                        <option value="5"><?=$SETTINGS['prace_5']?></option>
                        <option value="6"><?=$SETTINGS['prace_6']?></option>
                    </select>
                </td>
            </tr>

            <!-- New Table for Races and Descriptions -->
            <tr>
                <td class="bodycell4" colspan="2">
                    <table width="100%" border="1">
                        <tr>
                            <th>Race</th>
                            <th>Perks</th>
                            <th>Shield</th>
                        </tr>
                        <tr>
                            <td><?=$SETTINGS['prace_1']?></td>
                            <td>+2500 Defense, +2500 Offense, +15000 Gold, +10% Economy, +15% Offense</td>
                            <td><img src="images/undead.png" alt="<?=$SETTINGS['prace_1']?> Shield Icon" style="width: 50%; height: 50%;"></td>
                        </tr>
                        <tr>
                            <td><?=$SETTINGS['prace_2']?></td>
                            <td>+5 Army, +40000 Gold, +10% Economy, +15% Offense</td>
                            <td><img src="images/human.png" alt="<?=$SETTINGS['prace_2']?> Shield Icon" style="width: 50%; height: 50%;"></td>
                        </tr>
                        <tr>
                            <td><?=$SETTINGS['prace_3']?></td>
                            <td>+5000 Offense, +2500 Defense, +10% Economy, +15% Offense</td>
                            <td><img src="images/goblin.png" alt="<?=$SETTINGS['prace_3']?> Shield Icon" style="width: 50%; height: 50%;"></td>
                        </tr>
                        <tr>
                            <td><?=$SETTINGS['prace_4']?></td>
                            <td>+7500 Defense, +15% Defense</td>
                            <td><img src="images/elves.png" alt="<?=$SETTINGS['prace_4']?> Shield Icon" style="width: 50%; height: 50%;"></td>
                        </tr>
                        <tr>
                            <td><?=$SETTINGS['prace_5']?></td>
                            <td>+7500 Offense, +15% Defense</td>
                            <td><img src="images/orcs.png" alt="<?=$SETTINGS['prace_5']?> Shield Icon" style="width: 50%; height: 50%;"></td>
                        </tr>
                        <tr>
                            <td><?=$SETTINGS['prace_6']?></td>
                            <td>+5000 Offense, +25000 Gold, +15% Defense</td>
                            <td><img src="images/dwarf.png" alt="<?=$SETTINGS['prace_6']?> Shield Icon" style="width: 50%; height: 50%;"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="bodycell4">
                    <center>
                        <input name="register" type="submit" value="Register">
                    </center>
                </td>
            </tr>
        </table>
    </form>
<?php
} elseif ($_GET['stp'] == 2) {
    // The existing logic for form validation and database insertion
}
require 'includes/footer.php';
?>
