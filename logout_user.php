<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
session_start();

$token = $_POST['auth_token'];

if (isset($token)) {
    if ($token == $_SESSION['token']) {
        $result = ['success' => 1, 'data' => []];
        unset($token);
        session_unset();
        session_destroy();
    } else {
        $result = ['success' => 0, 'data' => [], 'error' => 'invalid token'];
    }
}
else {
    $result = ['success' => 0, 'data' => [], 'error' => 'missing token'];
}


if (isset($result)) {
    print_r(json_encode($result));
}
else {
    $result = ['success'=>0, 'data'=>[], 'errors'=>'fatal operation error'];
    print_r(json_encode($result));
}