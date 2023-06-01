<?php

session_start();

// Retrieve the form data
$username = $_POST['username'];
$eyes = $_POST['eyes'];
$mouth = $_POST['mouth'];
$skin = $_POST['skin'];

// Concatenate the values to form the avatar
$avatar = $eyes . '_' . $mouth . '_' . $skin;

// Set the session variables
$_SESSION['username'] = $username;
$_SESSION['avatar'] = $avatar;

// Set the cookies
setcookie('username', $username, time() + (86400 * 30), "/");
setcookie('avatar', $avatar, time() + (86400 * 30), "/");

// Redirect to the profile page
header('Location: index.php');
exit;

?>