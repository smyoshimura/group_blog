<?php
// check token against database
if (isset($token) && isset($_SESSION['uid'])) {
    $suid = $_SESSION['uid'];
    $query_t = "SELECT token FROM sessions WHERE user_id=$suid";
    $t_check = mysqli_query($conn, $query_t);
    $row = mysqli_fetch_assoc($t_check);
    if ($token == $row['token']) {
        $token_valid = true;
    }
    else {
        $token_valid = false;
    }
}

?>