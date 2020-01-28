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

function sql_check($data)
{
    #if database's character set is big5, this is exploitable
    #sunun duzgununu yaz
    #$data = mysql_real_escape_string($data,ENT_QUOTES);
    return addslashes($data);
    
}




function file_upload_check($file, $file_extensions  = array("jpeg", "jpg", "png", "gif"), $target_dir)
{
    
    $error = "";
    
    $imageFileType = strtolower(pathinfo(basename($file["name"]),PATHINFO_EXTENSION));
    $target_file = $target_dir .$_SESSION['userid'].".png";

    // echo "----->>".$target_file."-------------".$imageFileType."-------------";

    $check = getimagesize($file["tmp_name"]);
    if($check == false) {
        return "File is not an image.";
    }

    // Allow certain file formats
    if($imageFileType != "png" && $imageFileType != "jpg")  {
        return "Sorry, only PNG,JPG files are allowed.";
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        # $error = "Sorry, file already exists.";
        //echo $target_file;
        if (!unlink($target_file)){
            return"Error deleting ";
        }
    }
    // Check file size
    if ($file["size"] > 500000) {
        return "Sorry, your file is too large.";
    }

    return $error;
    
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
        
        echo '<div class="alert alert-'.$type.'" role="alert" id="remainingCredit">';
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
        echo '<h1 class="display-6" id="attendedHeader">Attended Classes</h1>
        <table class="table table-hover">
            <thead>
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

//"9:00-11:00","9:00-12:00","10:00-12:00","10:00-13:00","13:00-15:00","13:00-16:00"
function helperInsertCourseToSchedule($dayArray,$start,$finish,$code){
    //echo $code."-".$start."-".$finish."<br>";
    if($start=="09:00:00" && $finish=="11:00:00"){
        array_push($dayArray["09:00:00"],$code);
        array_push($dayArray["10:00:00"],$code);
    }
    else if($start=="09:00:00" && $finish=="12:00:00"){
        array_push($dayArray["09:00:00"],$code);
        array_push($dayArray["10:00:00"],$code);
        array_push($dayArray["11:00:00"],$code);
    }
    else if($start=="10:00:00" && $finish=="12:00:00"){
        array_push($dayArray["10:00:00"],$code);
        array_push($dayArray["11:00:00"],$code);
    }
    else if($start=="10:00:00" && $finish=="13:00:00"){
        array_push($dayArray["10:00:00"],$code);
        array_push($dayArray["11:00:00"],$code);
        array_push($dayArray["12:00:00"],$code);
    }
    else if($start=="13:00:00" && $finish=="15:00:00"){
        array_push($dayArray["13:00:00"],$code);
        array_push($dayArray["14:00:00"],$code);
    }
    else if($start=="13:00:00" && $finish=="16:00:00"){
        array_push($dayArray["13:00:00"],$code);
        array_push($dayArray["14:00:00"],$code);
        array_push($dayArray["15:00:00"],$code);
    }
    return $dayArray;
}

function mergeHourCourse($wwww,$day,$start,$finish,$code){
    //echo $day;
    if($day=="Monday"){
        $wwww[0]=helperInsertCourseToSchedule($wwww[0],$start,$finish,$code);
    }
    else if($day=="Tuesday"){
        $wwww[1]=helperInsertCourseToSchedule($wwww[1],$start,$finish,$code);
    }
    else if($day=="Wednesday"){
        $wwww[2]=helperInsertCourseToSchedule($wwww[2],$start,$finish,$code);
    }
    else if($day=="Thursday"){
        $wwww[3]=helperInsertCourseToSchedule($wwww[3],$start,$finish,$code);
    }
    else if($day=="Friday"){
        $wwww[4]=helperInsertCourseToSchedule($wwww[4],$start,$finish,$code);
    }
    return $wwww;
}

function generateSchedule($connection,$role,$myid,$year,$term){

    $mon = array("09:00:00"=>array(),"10:00:00"=>array(),"11:00:00"=>array(),"12:00:00"=>array(),"13:00:00"=>array(),"14:00:00"=>array(),"15:00:00"=>array(),"16:00:00"=>array(),"17:00:00"=>array());
    $tue = array("09:00:00"=>array(),"10:00:00"=>array(),"11:00:00"=>array(),"12:00:00"=>array(),"13:00:00"=>array(),"14:00:00"=>array(),"15:00:00"=>array(),"16:00:00"=>array(),"17:00:00"=>array());
    $wen = array("09:00:00"=>array(),"10:00:00"=>array(),"11:00:00"=>array(),"12:00:00"=>array(),"13:00:00"=>array(),"14:00:00"=>array(),"15:00:00"=>array(),"16:00:00"=>array(),"17:00:00"=>array());
    $thu = array("09:00:00"=>array(),"10:00:00"=>array(),"11:00:00"=>array(),"12:00:00"=>array(),"13:00:00"=>array(),"14:00:00"=>array(),"15:00:00"=>array(),"16:00:00"=>array(),"17:00:00"=>array());
    $fri = array("09:00:00"=>array(),"10:00:00"=>array(),"11:00:00"=>array(),"12:00:00"=>array(),"13:00:00"=>array(),"14:00:00"=>array(),"15:00:00"=>array(),"16:00:00"=>array(),"17:00:00"=>array());
    $week=array($mon,$tue,$wen,$thu,$fri);
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
    if($role=='instructor'){
        $sqlTakenCourses="call OneInstructorAllClassesInSemester(".$myid.",".$year.",'".$term."')";
    }
    else if($role == 'student'){
        $sqlTakenCourses="call OneStudentTookAllCourse(".$myid.")";
    }
    
    $stmt=$connection->prepare($sqlTakenCourses);
    $stmt->execute();
    $stc=$stmt->fetchall();
    //Array ( [studentID] => 981 [0] => 981 [StudentName] => Okan [1] => Okan [StudentSurname] => ALAN [2] => ALAN [CourseCode] => BBM471 [3] => BBM471 [CourseName] => Database Management Systems [4] => Database Management Systems [classID] => 6328 [5] => 6328 [sectionID] => 1 [6] => 1 [credit] => 10 [7] => 10 [day1] => Monday [8] => Monday [startTime1] => 09:00:00 [9] => 09:00:00 [endTime1] => 12:00:00 [10] => 12:00:00 [day2] => [11] => [startTime2] => 00:00:00 [12] => 00:00:00 [endTime2] => 00:00:00 [13] => 00:00:00 [day3] => [14] => [startTime3] => 00:00:00 [15] => 00:00:00 [endTime3] => 00:00:00 [16] => 00:00:00 )
    foreach($stc as $row){
        $week=mergeHourCourse($week,$row["day1"],$row["startTime1"],$row["endTime1"],$row["CourseCode"]);
        if($row['day2']!=""){
            $week=mergeHourCourse($week,$row["day2"],$row["startTime2"],$row["endTime2"],$row["CourseCode"]);
        }
    }    

    $hours=array("09:00:00","10:00:00","11:00:00","12:00:00","13:00:00","14:00:00","15:00:00","16:00:00","17:00:00");

    foreach($hours as $hhhh){
        echo "<tr>
                <td>".$hhhh."</td>";
        
        foreach($week as $dd){
            echo "<td>";
            foreach($dd[$hhhh] as $cou){
                echo $cou."<br>";
            }
            echo "</td>";
        }

        echo "</tr>";
    }
    echo "<br>";
    

    echo '  </tbody>
    </table>';

}

function yearHelper($term,$year){
    if($term=="Fall"){
        return $year."-".($year+1);
    }
    else{
        return ($year-1)."-".$year;
    }
}


?>
