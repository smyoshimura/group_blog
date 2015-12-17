<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
session_start();
require('db_connect.php');

//$blog_ids = [6];
//$token = '12345';

$invalid_id = false;
$token = $_POST['auth_token'];
// validate number of incoming blog_ids to assign as an array for looping operation
$ids_length = count($_POST['blog_ids']);
if ($ids_length > 1) {
    $blog_ids = $_POST['blog_ids'];
}
else if ($ids_length == 1) {
    $blog_ids[] = $_POST['blog_ids'];
}
else {
    $invalid_id = true;
}

// check if requested blog_ids exist and not soft-deleted already
if (isset($blog_ids)) {
    foreach ($blog_ids as $values) {
        $queries[] = "SELECT id, soft_delete FROM blogs WHERE id=$values";
    }
    foreach ($queries as $query) {
        $id_check[] = mysqli_query($conn, $query);
    }
    foreach ($id_check as $ids) {
        if (mysqli_num_rows($ids) > 0) {
            while ($row = mysqli_fetch_assoc($ids)) {
                $output[] = $row;
            }
        }
        else {
            $invalid_id = true;
            $result = ['success'=>0, 'data'=>[], 'errors'=>'Requested blog ID missing in database. Operation cancelled'];
            break;
        }
    }
    foreach ($output as $values) {
        if ($values['soft_delete'] == 1) {
            $invalid_id = true;
            $result = ['success'=>0, 'data'=>[], 'errors'=>'One or more requested posts already deleted. Operation cancelled'];
        }
    }
}

// perform deletion
if (isset($token) && !$invalid_id) {
/*    // generate queries for hard/permanent delete
    foreach ($blog_ids as $values) {
        $queries[] = "DELETE FROM blogs WHERE id=$values";
    }*/

    // generate queries for soft delete
    foreach ($blog_ids as $values) {
        $queries[] = "UPDATE blogs SET soft_delete=1 WHERE id=$values";
    }
    // iterate through query array strings to delete/mark blog posts
    foreach ($queries as $query) {
        mysqli_query($conn, $query);
    }
    // check if query operation succeeded
    if (mysqli_affected_rows($conn)>0) {
        $result = ['success'=>1, 'data'=>['ids'=>$blog_ids]];
    }
    else {
        $result = ['success'=>0, 'data'=>['ids'=>$blog_ids], 'errors'=>'unknown database error'];
    }
}
//else if ($token == '12345')) {
//    $result = ['success'=>0, 'data'=>[], 'errors'=>'invalid token'];
//}

// send result data via ajax
if (isset($result)) {
    print_r($result);
}
else {
    $result = ['success'=>0, 'data'=>[], 'errors'=>'fatal operation error'];
    print_r($result);
}

?>