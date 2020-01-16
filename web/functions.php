<?php

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function sqli_check_1($data)
{
    #if database's character set is big5, this is exploitable
    #sunun duzgununu yaz
    #$data = mysql_real_escape_string($data,ENT_QUOTES);
    return addslashes($data);
    
}


function addRowToMyClassTable($row,$count){
    echo "<tr>";
    echo "<td>".$count."</td>";
    echo "<td>".$row["CourseCode"]."</td>";
    echo "<td>".$row["CourseName"]."</td>";
    echo "<td>".$row["credit"]."</td>";
    echo "</tr>";
}

function printCreditOnTopOfGrid($newconn,$studentid){

    $sql = "SELECT * FROM Student S WHERE S.studentID=:studentid";
    $stmt = $newconn->conn->prepare($sql);
    $stmt->execute(array('studentid'=>$studentid));
    

    if(!$stmt){
        die("Error: ". print_r($stm->errorInfo()));
    }
    else{
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $type="success";
        if($row['creditLimit']==0){
            $type="danger";
        }
        else{
            $type="primary";
        }

        echo '<div class="alert alert-'.$type.'" role="alert">';
        echo "Heyy! ".$row['name']." ".$row['surname'].", your remaining credit is <strong>".$row['creditLimit']."</strong>";
        echo "</div>";
    }
        

}

function addRow2JoinCourseTable($row){ #color for taken or not
    echo '<tr>';
    echo '<td>'.$row["CourseCode"].'</td>';
    echo '<td>'.$row["CourseName"].'</td>';
    echo '<td>'.$row["sectionID"].'</td>';
    #suraya hocayıda ekle
    echo '<td><button type="button" class="btn btn-danger" classid="'.$row["classID"].'" sectionid="'.$row["sectionID"].'" id="join">x</button></td>';
    echo "</tr>";
}

function isAlreadyTaken($takenCourses,$checkKlass){

    $res=false;

    foreach($takenCourses as $taken){
        if($taken==$checkKlass){
            
            $res=true;
            break;
        }
    }

    return $res;
}


function takenCoursesbyMe($connection,$myid,$tblmy){
    if($tblmy==1){
        echo '<h1 class="display-6">Attended Classes</h1><table class="table table-hover"><thead>
            <tr>
            <th scope="col">Course Code</th>
            <th scope="col">Course Name</th>
            <th scope="col">Section Number</th>
            <th scope="col"></th> 
            <!-- buraya hoca ekle -->
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>';
    }

    $sqlTakenCourses="call OneStudentTookAllCourse(".$myid.")";
    $stmt=$connection->prepare($sqlTakenCourses);
    $stmt->execute();
    //$tcs = $stmt->fetchall();
    $classes=[];
    foreach($stmt as $tc){
        array_push($classes,$tc['classID']);
        if($tblmy!=2){
            addRow2JoinCourseTable($tc);
        }
    }
    if($tblmy==1){
        echo '</tbody>
        </table>';
    }

    return $classes;
}

function generateSchedule($connection,$myid){
    echo '
        <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">Hours</th>
            <th scope="col">Monday</th>
            <th scope="col">Tuesday</th>
            <th scope="col">Wednesday</th>
            <th scope="col">Thursday</th>
            <th scope="col">Friday</th>
            </tr>
        </thead>
        <tbody>
    ';
    $sqlTakenCourses="call OneStudentTookAllCourse(".$myid.")";
    $stmt=$connection->prepare($sqlTakenCourses);
    $stmt->execute();
    $stc=$stmt->fetchall();
    //Array ( [studentID] => 981 [0] => 981 [StudentName] => Okan [1] => Okan [StudentSurname] => ALAN [2] => ALAN [CourseCode] => BBM471 [3] => BBM471 [CourseName] => Database Management Systems [4] => Database Management Systems [classID] => 6328 [5] => 6328 [sectionID] => 1 [6] => 1 [credit] => 10 [7] => 10 [day1] => Monday [8] => Monday [startTime1] => 09:00:00 [9] => 09:00:00 [endTime1] => 12:00:00 [10] => 12:00:00 [day2] => [11] => [startTime2] => 00:00:00 [12] => 00:00:00 [endTime2] => 00:00:00 [13] => 00:00:00 [day3] => [14] => [startTime3] => 00:00:00 [15] => 00:00:00 [endTime3] => 00:00:00 [16] => 00:00:00 )
    foreach($stc as $row){
        print_r($row);
        echo "<br><br>";
        // echo "<tr>
        //         <td>1</td>
        //         <td>Mark<br>hello</td>
        //         <td>Otto</td>
        //         <td>@mdo</td>
        //         <td>Mark</td>
        //         <td>Otto</td>
        //         <td>@mdo</td>
        //     </tr>";
    }

    echo '  </tbody>
        </table>';

    //return $stc;
}

?>