<?php
session_start();
date_default_timezone_set("Asia/Taipei");
$str = $_SERVER['HTTP_USER_AGENT'];
//echo $_SERVER['HTTP_USER_AGENT'] . "\n\n";

//if (strpos($str, 'Windows')=== false) 
    $_SESSION['ROOT'] = '/var/www/nas';

//include_once "DataBase/DB_Class.php";
include_once $_SESSION['ROOT'] . "/DataBase/DB_Class.php";

error_log(date('d-m-Y H:i:s') . "---" . basename(__FILE__) . "\n", 3, "/var/tmp/my-errors.log");
action();

function action() {
    $action = $_POST["action"];
    if ($action == "keyword") {
        keyword();
    } else if ($action == "teacher") {
        teacher();
    } else if ($action == "project") {
        project();
    }
}

function project() {
    $db = new DataBase();
    $db->select("project", "p_name LIKE '%{$_POST["p_name"]}%'");
    if ($db->length() == 0)
        echo 0;
    else
        echo $db->getList();
}

function teacher() {

    $db = new DataBase();
    $db->select("project", "p_adviser LIKE '%{$_POST["p_adviser"]}%'");
//    error_log(date('d-m-Y H:i:s') . "---p_adviser LIKE '%{$_POST["p_adviser"]}%'\n", 3, "/var/tmp/my-errors.log");
    if ($db->length() == 0)
        echo 0;
    else
        echo $db->getList();
}

function keyword() {

    $db = new DataBase();
    $db->distinct("keyword", "k_value LIKE '%{$_POST["k_value"]}%'","","k_project");
    $array = array();
    while (($result = $db->getOne()) != null) {
        $db2 = new DataBase();
        $db2->select("project", "p_id = {$result["k_project"]}");
        $array[] = $db2->getList();
    }
    //echo $array;
    //echo json_encode($array);
    echo json_encode($array,JSON_HEX_QUOT);
}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
