<?php

//USER WANTS TO EDIT TITLE
function editTitle(){
    echo 'edit the title in this function';
    $query = "";
}
//USER WANTS TO EDIT TEXT
function editText(){
    echo 'edit text in this function';
    $query = "";
}
//USER WANTS TO EDIT TAGS
function editTags(){
    echo 'edit tags in this function';
    $query = "";
}
//USER WANTS TO PUBLISH A POST THAT HAS NOT BEEN PUBLISHED
/*
 * NEEDED VARIABLES:
 * 1. THE ID OF THE BLOG POST
 */
$query = "UPDATE `blogs` SET `published_timestamp`= NOW() WHERE `id` = 2";
function editPublish(){
    echo 'publish the post in this function';
    $query = "";
}
//USER WANTS TO CHANGE FROM PRIVATE TO PUBLIC
function editPrivacy(){
    echo 'edit privacy function goes here';
    $query = "";
}

$edits = array('title'=>'yay title', 'text'=>'helllloooooooo', 'tags'=>'fun, fun, fun', 'public'=>'', 'publish'=>'');
//$querygoal = "UPDATE `blogs` SET `title`=[value-2],`text`=[value-3],`tags`=[value-4],`published_timestamp`=[value-7],`public`=[value-9], WHERE `id` = 1"

function makeAnUpdate($edits){
    //TODO REQUIRE CONNECTION FILE
    echo '<pre>';
    foreach($edits as $editedItem => $edit) {
        if(!empty($edit)){
            echo "`$editedItem` = '{$edit}',";

//            switch ($editedItem) {
//                case 'title':
//                    editTitle();
//                    break;
//                case 'text':
//                    editText();
//                    break;
//                case 'tags':
//                    editTags();
//                    break;
//                case 'public':
//                    editPrivacy();
//                    break;
//                case 'publish':
//                    editPublish();
//                    break;
//            }
        }
        else{
            //echo "There are no needed edits in the category: \$edits[$editedItem]\n";
        }
    }

    echo '</pre>';
}

makeAnUpdate($edits);