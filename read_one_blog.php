<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
require('connect.php');
session_start();

if (!empty($_POST)) {

    $id = $_POST['blog_id'];
//    $token = $_POST['token'];

//Checks if token is valid, if not only a public blog entry will return
//    if (isset($token)) {
//        if ($token === $_SESSION['token']) {
            $query = "select `id`, `title`, `text`, `tags`, `owner_id`, `created_timestamp`, `published_timestamp`, `edited_timestamp` from `blogs` where `id`=$id";
//        } else {
//            $public = 1;
//            $query = "select `id`, `title`, `text`, `tags`, `owner_id`, `created_timestamp`, `published_timestamp`, `edited_timestamp` from `blogs` where `id`=$id and `public`=$public";
//        }
//    }

//This fetches the blogs from the database and saves it in the variable $output

    $info = mysqli_query($conn, $query);
    if (mysqli_num_rows($info) > 0) {
        while ($row = mysqli_fetch_assoc($info)) {
            $output[] = $row;
        };
        $result = ['success' => 1, 'data' => $output];
    } else {
        $result = ['success' => 0, 'data' => [], 'error' => 'no data found'];
    }
}
if (isset($result)) {
    print_r(json_encode($result));
} else {
    $result = ['success' => 0, 'data' => [], 'error' => 'unknown error'];
    print_r(json_encode($result));
}
?>