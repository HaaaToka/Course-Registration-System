<?php

function initTable($cid,$sid){

    echo '<div class="container"><br>

            <a href="statistic.php?cid='.$cid.'&sid='.$sid.'" class="badge badge-warning">Go To Statistic of This Class</a>

        </div> ';

    echo '<div class="container">
            <table class="table table-bordered">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Student Number</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
            </tr>
            </thead>
            <tbody>';
}

function addRow2StudentCourse($i,$stu){
    echo '<tr>
            <th scope="row">'.$i.'</th>
            <td>'.$stu['studentID'].'</td>
            <td>'.$stu['StudentName'].'</td>
            <td>'.$stu['StudentSurname'].'</td>
        </tr>';
}

function closeTable(){
    echo '</tbody></table>';
}

include_once "../includer.php";
$newconn = new ConnectDB($sn,$un,$pss,$db);


if(isset($_GET["cid"])){
    $cid = $_GET['cid'];
    $sid = $_GET['sid'];
    $checkClassMine = "select count(*) as count from InstructorGivesCourse where classID=".$cid." and instructorID=".$_SESSION['userid'];
    $stmt = $newconn->conn->prepare($checkClassMine);
    $stmt->execute();
    $count = $stmt->fetch();
    if($count['count']==1){
        initTable($cid,$sid);
        $whoTakeThisClassSql = "select * from studenttakencourseJoin where classID=".$cid." and sectionID=".$sid;
        // echo $whoTakeThisClassSql;
        $stmt = $newconn->conn->prepare($whoTakeThisClassSql);
        $stmt->execute();
        $students = $stmt->fetchall();
        $i=1;
        foreach($students as $stu){
            // print_r($stu);
            addRow2StudentCourse($i,$stu);
            $i++;
        }
        closeTable();
    }
    else{
        echo "This class doesn't belong you";

    }

}
?>


</div>