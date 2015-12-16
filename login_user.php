<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
session_start();

//$user_email = 'jean@gmail.com';
//$user_password = 'jean1';
$user_email = $_POST['email'];
$user_password = $_POST['password'];

require('db_connect.php');
// get user data based on user's email address inputted
$query = "SELECT id, username, email, password FROM users WHERE email='$user_email'";
$user_data = mysqli_query($conn, $query);

// if email found, assign user data to $output, validate password, assign user id to SESSION variable
if (mysqli_num_rows($user_data)>0) {
    while ($row = mysqli_fetch_assoc($user_data)) {
        $output[] = $row;
    }
    if ($output[0]['password'] == $user_password) {
        // correct password
        $_SESSION['user_id'] = $output[0]['id'];
        $result = ['success'=>1,
            'data'=>['user_id'=>$output[0]['id'], 'username'=>$output[0]['username'], 'auth_token'=>'test12345']
        ];
        unset($output);
    }
    else {
        // incorrect password
        $result = ['success'=>0, 'error'=>'incorrect password'];
        unset($output);
    }
}
else {
    $result = ['success'=>0, 'error'=>'email not found'];
    unset($output);
}

// print_r($result) sends the AJAX output
if (isset($result)) {
    print_r($result);
}
else {
    $result = ['success'=>0, 'error'=>'operation error'];
    print_r($result);
}

// if login success
//$token = md5(uniqid(mt_rand(), true));
//$_SESSION['token'] = $token;
