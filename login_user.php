<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
session_start();
require('db_connect.php');

$user_email = $_POST['email'];
$user_password = $_POST['password'];
//$user_email = 'jean@gmail.com';
//$user_password = 'jean1';

// get user data based on user's email address inputted
$query = "SELECT id, username, email, password FROM users WHERE email='$user_email'";
$user_data = mysqli_query($conn, $query);

// if email found, assign user data to $output, validate password, assign API data to $result
if (mysqli_num_rows($user_data)>0) {
    while ($row = mysqli_fetch_assoc($user_data)) {
        $output[] = $row;
    }
    // correct password
    if ($output[0]['password'] == $user_password) {
        // generate token
        $token = md5(uniqid(mt_rand(), true));
        $result = ['success'=>1,
            'data'=>['uid'=>$output[0]['id'], 'username'=>$output[0]['username'], 'auth_token'=>$token]
        ];
        $_SESSION['uid'] = $output[0]['id'];
        $_SESSION['token'] = $token;
        // sessions token table
/*        $uid = $output[0]['id'];
        $query_s = "INSERT INTO sessions (user_id, token) VALUES('$uid','$token')";
        mysqli_query($conn, $query_s);*/
        unset($output);
        unset($token);
    }
    // incorrect password
    else {
        $result = ['success'=>0, 'data'=>[], 'error'=>'incorrect password'];
        unset($output);
    }
}
else {
    $result = ['success'=>0, 'data'=>[], 'error'=>'email not found'];
}

// send result data via ajax
if (isset($result)) {
    print_r(json_encode($result));
}
else {
    $result = ['success'=>0, 'data'=>[], 'error'=>'operation error'];
    print_r(json_encode($result));
}

?>

