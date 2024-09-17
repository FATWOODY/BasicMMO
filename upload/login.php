<?php
if ($_POST['login']) {
    require 'includes/setup.php';
    session_start();
    $_SESSION['ht_mem'] = "";
    $_POST['username'] = htmlentities($_POST['username']);
    
    // Enable error reporting for debugging
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if (!$_POST['username']) {
        header("Location: login.php?err=4");
        exit;
    }
    if (!$_POST['password']) {
        header("Location: login.php?err=5");
        exit;
    }

    // Prepare statement for user selection
    $stmt = $db->prepare("SELECT uID, uPassword, uCode FROM users WHERE uLogin = ?");
    $stmt->bind_param("s", $_POST['username']);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Check if user exists
    if (!$row) {
        header("Location: login.php?err=3");
        exit;
    }

    // Password validation (use password_verify if passwords are hashed)
    if ($_POST['password'] == $row['uPassword']) {
        if ($row['uCode'] == "done") {
            $sessionid = "l-in" . rand(100, 999) . substr($_POST['username'], 0, 3) . rand(100000, 999999);
            $_SESSION['ht_mem'] = $sessionid;

            $db->query("UPDATE users_online SET uCode='$sessionid' WHERE uID={$row['uID']}");
            header("Location: news.php");
        } else {
            header("Location: login.php?err=2");
        }
    } else {
        header("Location: login.php?err=1");
    }

    $db->close();
} else {
    require 'includes/header.php';
    if (!$_GET['err']) {
        // Display login form
    ?>
        <b><tl>Login</tl></b><br />
        <img alt="" src="images/seperator.gif" /><br />
        <center>
            <form action="login.php" method="post">
                <table width="60%" border="0" align="center">
                    <tr>
                        <td class="bodycell4" width="50%" align="right"><b>Username:</b></td>
                        <td class="bodycell4" width="50%"><input name="username" type="text" size="30" maxlength="16"></td>
                    </tr>
                    <tr>
                        <td class="bodycell4" width="50%" align="right"><b>Password:</b></td>
                        <td class="bodycell4" width="50%"><input name="password" type="password" size="30"></td>
                    </tr>
                    <tr>
                        <td colspan="4" class="bodycell4">
                            <center><input name="login" type="submit" value="Login"></center>
                        </td>
                    </tr>
                </table>
            </form>
        </center>
    <?php
    }

    // Handle error messages
    if ($_GET['err'] == 1) {
        echo "The password was incorrect.<br><br><a href=\"login.php\">BACK</a>";
    }
    if ($_GET['err'] == 2) {
        echo "You need to validate your account.<br><br><a href=\"validate.php\">Validate Your Account</a><br><br><a href=\"login.php\">BACK</a>";
    }
    if ($_GET['err'] == 3) {
        echo "The specified account does not exist.<br><br><a href=\"login.php\">BACK</a>";
    }
    if ($_GET['err'] == 4) {
        echo "You must enter a username.<br><br><a href=\"login.php\">BACK</a>";
    }
    if ($_GET['err'] == 5) {
        echo "You must enter a password.<br><br><a href=\"login.php\">BACK</a>";
    }
    echo "</center>";
    require 'includes/footer.php';
}
?>
