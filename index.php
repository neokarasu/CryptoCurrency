<?php 

session_start();

// Check Login form submitted
if(isset($_POST['Submit'])){

// Define username and password array

	$logins = array('username' => 'password');

// Create variable from submitted username and password after checking if submitted
	$Username = isset($_POST['Username']) ? $_POST['Username'] : '';
	$Password = isset($_POST['Password']) ? $_POST['Password'] : '';

// Check if username and password exist in array
	if (isset($logins[$Username]) && $logins[$Username] == $Password){

// On succes set session and redirect to coins page
		$_SESSION['UserData']['Username']=$logins[$Username];
		header("location:coins.php");
		exit;
	} else {
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
<Center>
<form action="" method="post" name="Login_Form">
  <table width="400" border="0" align="center" cellpadding="5" cellspacing="1" class="table login">
    <?php if(isset($msg)){?>
    <tr>
      <td colspan="2" align="center" valign="middle"><?php echo $msg;?></td>
    </tr>
    <?php } ?>
    <tr>
      <td colspan="2" align="center" class="login green"><h3>Login</h3></td>
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
