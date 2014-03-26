<?php

session_start();
include_once $_SESSION['ROOT'] . "/DataBase/DB_Class.php";
action();

function action() {
    $action = $_POST["action"];
    if ($action == "teacher") {
        teacher();
    }
    if ($action == "finish") {
        finish();
    }
}

function teacher() {
    $db = new DataBase();
    $db->select("teacher");
    $result = $db->getList();
    echo $result;
}

function finish() {
    $db = new DataBase();
    $leader_name = $_POST["leader_name"];
    $leader_number = $_POST["leader_number"];
    $project_name = $_POST["project_name"];
    $project_description = $_POST["project_description"];
    $project_teacher = $_POST["project_teacher"];
    $project_type = $_POST["project_type"];

    $db->select("teacher", "id = $project_teacher");
    $s = $db->getOne();
    $array = array(
        "p_name" => $project_name,
        "p_adviser" => $s["name"],
        "p_type" => $project_type,
        "p_description" => $project_description,
        "p_leader_name" => $leader_name,
        "p_leader_number" => $leader_number,
        "p_date" => date("Y-m-d")
    );
    $db->insert("project", $array);
    $db->select("project", "p_id=(SELECT max(p_id) FROM project)");
    $x = $db->getOne();
    $na = explode(",", $_POST["stu_name"]);
    $nu = explode(",", $_POST["stu_num"]);
    var_dump($na);
    for ($i = 0; $i < count($na); $i++) {
        $array = array(
            "s_project" => $x["p_id"],
            "s_name" => $na[$i],
            "s_id" => $nu[$i],
        );
        $db->insert("member", $array);
    }
    $nux = explode(",", $_POST["project_keyword"]);
    for ($i = 0; $i < count($nux); $i++) {
        $array = array(
            "k_project" => ($x["p_id"]),
            "k_value" => $nux[$i]
        );
        $db->insert("keyword", $array);
    }
echo  var_dump($array);
mkdir("/nas/project/$leader_number");
$data="index.txt";
$fp=fopen("/nas/project/$leader_number/$data","a+");  
$str = var_dump($array);
fwrite($fp,'434');
fclose($fp);
 
}

?>
