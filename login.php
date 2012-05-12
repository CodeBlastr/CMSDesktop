<?php 

@session_start();

require_once(’class/user.class.php’);
// checks to see if user submitted form stuff, if yes, tries to login
if (isset($_POST['username']) && strlen($_POST['password']) >= 6) {
$username = &$_POST['username'];
$password = &$_POST['password'];
$userLogin = new User($username);
if ($userLogin->getExists() === TRUE && $userLogin->passwordMatch($password) === TRUE ) {
$_SESSION['username'] = $username;
}
}
// if user has been logged in successfully, say welcome, else rewrite form
if (isset($_SESSION['username'])) {
$userObj = new User($_SESSION['username']);
$userInfo['id'] = $userObj->getId();
$userInfo['username'] = $userObj->getUsername();
$userInfo['firstName'] = $userObj->getFirstName();
$userInfo['lastName'] = $userObj->getLastName();
$userInfo['email'] = $userObj->getEmail();
$userInfo['city'] = $userObj->getCity();
$userInfo['state'] = $userObj->getState();
$userInfo['country'] = $userObj->getCountry();
echo “Welcome “.$userInfo['firstName'].”! “;
echo “Logout“;
} else {
?>
<script type=”text/javascript” src=”http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js”></script>
<form name=”login” action=”" onsubmit=”return false” method=”post”>
username:<input type=”text” id=”usernameId” name=”username” maxlength=”50″ value=”" />
password:<input type=”password” id=”passwordId” name=”password” value=”" />
<input type=”submit” id=”submitLogin” value=”Login” onclick=”logMein();” />
</form>

}
?>