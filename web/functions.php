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
    if($color)
        echo '<tr class="table-dark">';
    else
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


function takenCoursesbyMe($connection,$myid){
    $sqlTakenCourses="call OneStudentTookAllCourse(".$myid.")";
    $stmt=$connection->prepare($sqlTakenCourses);
    $stmt->execute();
    //$tcs = $stmt->fetchall();
    $classes=[];
    foreach($stmt as $tc){
        array_push($classes,$tc['classID']);
        addRow2JoinCourseTable($tc);
    }
    return $classes;
}



?>