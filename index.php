<?php

require 'input.php';

session_start();

// Check Login form submitted
if(isset($_POST['Submit'])){

    // Create variable from submitted username and password after checking if submitted
    $username = isset($_POST['Username']) ? $_POST['Username'] : '';
    $password = isset($_POST['Password']) ? $_POST['Password'] : '';

    // Check if username and password exist in array
    if (isset($login[$username]) && $login[$username] == $password){

        // On succes set session and redirect to coins page
        $_SESSION['UserData']['Username']=$login[$username];
        header("location:coins.php");
        exit;
    }
    else {
        // On fail give error message
        $msg="<span style='color:red'>Invalid Login Details</span>";
    }
}

?>

<html>

<head>
<title>Login Page</title>
<link rel="stylesheet" type="text/css" href="coinstyle.css" />
</head>

<body>
<center>
<form action="" method="post" name="Login_Form">
    <table width="400" border="0" align="center" valign="middle" cellpadding="5" cellspacing="0" class="table login">
            <?php if(isset($msg)){?>
        <tr>
            <td colspan="2" align="center" valign="middle"><?php echo $msg; ?></td>
        </tr>
            <?php } ?>
        <tr>
            <td height="50" valign="middle" colspan="2" align="center" class="login green">Login</td>
        </tr>
        <tr>
            <td align="right" valign="top">Username</td>
            <td><input name="Username" type="text" class="input_field"></td>
        </tr>
        <tr>
            <td align="right">Password</td>
            <td><input name="Password" type="password" class="input_field"></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input name="Submit" type="submit" value="Login" class="login_button"></td>
        </tr>
    </table>
</form>
</center>
</body>

</html>
