<?php

include_once "../database.php";
include_once "../config.php";
include_once "../functions.php";

$newconn = new ConnectDB($sn,$un,$pss,$db);


if(isset($_POST['function'])){

    if($_POST['function']="updatequota"){
        $cid=$_POST['classid'];
        $sid=$_POST['sectionid'];
        $amount=$_POST['amount'];

        $updatequotaSQL="UPDATE Section SET quota=quota+".$amount." where classID=".$cid." and sectionID=".$sid;
        $stmt=$newconn->conn->prepare($updatequotaSQL);
        $stmt->execute();
        print_r($stmt->fetchall());
    }

}

?>