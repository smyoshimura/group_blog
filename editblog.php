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

function makeAnUpdate($edits){
    $updateString = array();
    //TODO REQUIRE CONNECTION FILE
    echo '<pre>';
    foreach($edits as $editedItem => $edit) {
        if(!empty($edit)){
            array_push($updateString,"`$editedItem` = '{$edit}'");
        else{
            echo "There are no needed edits in the category: \$edits[$editedItem]\n";
        }
    }
    print_r(implode(',', $updateString));

    echo '</pre>';
}

makeAnUpdate($edits);