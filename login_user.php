<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
session_start();

$user_email = $_POST['email'];
$user_password = $_POST['password'];

// perform validation/regex on email chars

// perform email & password validation against DB
require('db_connect.php');
$query = "SELECT email, password FROM users WHERE email=$user_email";



// if login success
$token = md5(uniqid(mt_rand(), true));
$_SESSION['token'] = $token;







// token test
//$length = 10;
//$token = bin2hex(random_compat($length));
//print_r($token);