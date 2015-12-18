<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
require('connect.php');

//Checks if token is valid, if not only public blog entries will return

if (isset($token)) {
    if ($token === $_SESSION['token']) {
        $query = "SELECT * FROM `blogs`";
    } else {
        $query = "SELECT * FROM `blogs` WHERE `public`=1";
    }
}
$info = mysqli_query($conn, $query);
if (mysqli_num_rows($info) > 0) {
    while ($row = mysqli_fetch_assoc($info)) {
        $output[] = $row;
    }
    $result = ['success' => 1, 'data' => $output];
} else {
    $result = ['success' => 0, 'errors' => 'No blogs exist.'];
}
print(json_encode($result));
?>
