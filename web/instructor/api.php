<?php

include_once "../database.php";
include_once "../config.php";
include_once "../functions.php";

$newconn = new ConnectDB($sn,$un,$pss,$db);


if(isset($_POST['function'])){

    if($_POST['function']=="updatequota"){
        $cid=$_POST['classid'];
        $sid=$_POST['sectionid'];
        $amount=$_POST['amount'];

        $updatequotaSQL="call updateQuota(".$cid.",".$sid.",".$amount.")";
        //$updatequotaSQL="UPDATE Section SET quota=quota+".$amount." where classID=".$cid." and sectionID=".$sid;
        $stmt=$newconn->conn->prepare($updatequotaSQL);
        $stmt->execute();
        // print_r($stmt->fetchall());
        echo "You changed section quota -_-";
    }

    else if($_POST['function']=="gradeStudent"){

        $stuid = $_POST['studentid'];
        $courseid = $_POST['courseid'];
        $cid = $_POST['classid'];
        $sid = $_POST['sectionid'];
        $newgrade = $_POST['grade'];
        // print_r($_POST);

        $allgradesletter = array("A1","A2","A3","B1","B2","B3","C1","C2","C3","D","F1","F2","F3");
        $flag=0;
        foreach($allgradesletter as $letter){
            if($letter==$newgrade){$flag=1;break;}
        }
        if($flag==0){
            return;
        }
        echo "Unvalid Grade";

        $updateCourseGradeSQL = "call gradeMe(".$stuid.", ".$courseid.", ".$cid.",".$sid.",'".$newgrade."')";
        // echo $updateCourseGradeSQL;
        $stmt=$newconn->conn->prepare($updateCourseGradeSQL);
        $stmt->execute();
        echo "You graded student -_-";
    }
    
}

?>