<?php

include "../includer.php";

$newconn = new ConnectDB($sn,$un,$pss,$db);


?>


<div class="container">
    <h1 class="display-4">Join Class</h1>
        <table class="table table-hover">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Course Code</th>
                <th scope="col">Course Name</th>
                <th scope="col">Section Number</th>
                </tr>
            </thead>
            <tbody>

<?php

function addRow2JoinCourseTable($row,$numberofrow,$color){ #color for taken or not
    if($color)
        echo '<tr class="table-dark">';
    else
        echo '<tr>';
    echo '<th scope="row">'.$numberofrow.'</th>';
    echo '<td>'.$row["CourseCode"].'</td>';
    echo '<td>'.$row["CourseName"].'</td>';
    echo '<td>'.$row["sectionID"].'</td>';
    #suraya hocayıda ekle
    echo "</tr>";
}

function alreadyTaken($takenCourses,$checkKlass){

    $res=false;

    foreach($takenCourses as $taken){
        if($taken['CourseCode']==$checkKlass){
            $res=true;
            break;
        }
    }

    return $res;
}

function takenCoursesbyMe($connection,$myid){
    $sqlTakenCourses="call OneStudentTookAllCourse(".$myid.")";
    $stmt=$connection->prepare($sqlTakenCourses);
    $stmt->execute();
    $tcs = $stmt->fetchall();
    // foreach($tcs as $tc){
    //     addRow2JoinCourseTable($tc,-1);
    // }
    return $tcs;
}

function listCourseToJoin($connection,$yyyy,$tterm,$depid,$stuID){

    $takenCourses = takenCoursesbyMe($connection,$stuID);

    $sqldepcour="call myDepartmentOpenCourse(".$yyyy.",'".$tterm."',".$depid.")";
    $stmt = $connection->prepare($sqldepcour);
    if(!$stmt){
        die("Error: ". print_r($stmt->errorInfo()));
    }
    else{
        $stmt->execute();
        $i=1;
        foreach($stmt as $row){
            addRow2JoinCourseTable($row,$i++,alreadyTaken($takenCourses,$row['CourseCode']));
        }
    }
}

listCourseToJoin($newconn->conn,$_SESSION["year"],$_SESSION["term"],$_SESSION["departmentID"],$_SESSION['userid']);

?>
                
            </tbody>
        </table>









</div>


