<?php

include_once "../database.php";
include_once "../config.php";
include_once "../functions.php";

$newconn = new ConnectDB($sn,$un,$pss,$db);

if(isset($_POST["gimmeRemainingCredit"])){
    printCreditOnTopOfGrid($newconn,$_POST['studentid']);
}

if(isset($_POST['reload'])){
    $stuid=$_POST['reload'];
    takenCoursesbyMe($newconn->conn,$stuid,1);
}

if(isset($_POST['function'])){

    $studentid="-1";
    $classid="-1";
    $sectionid="-1";
    if(isset($_POST['studentid']))
        $studentid = $_POST['studentid'];
    else
        die("student id yok");
    if(isset($_POST['classid']))
        $classid = $_POST['classid'];
    else
        die("class id yok");
    if(isset($_POST['sectionid']))
        $sectionid = $_POST['sectionid'];
    else
        die("section id yok");

            
    if($_POST['function']=="delete")
        $sql = "call deleteStudentTakenCourse(".$studentid.",".$classid.",".$sectionid.")";
    else if($_POST['function']=="join")
        $sql = "call insertStudentTakenCourse(".$studentid.",".$classid.",".$sectionid.")";
    else if($_POST['function']=="update")
        $sql = "call updateMySection(".$studentid.",".$classid.",".$sectionid.")";
    

    $stmt = $newconn->conn->prepare($sql);
        if(!$stmt){
            die("join class Error:");
        }
        else{
            $stmt->execute();
            $res=$stmt->fetch();
            if($res['result']=="0")
                echo "You did not ".$_POST["function"]." the class";
            else
                echo "You ".$_POST["function"]." the class";
        }

}



?>