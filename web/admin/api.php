<?php

include_once "../database.php";
include_once "../config.php";
include_once "../functions.php";

$newconn = new ConnectDB($sn,$un,$pss,$db);

if(isset($_POST['function'])){

    if($_POST['function']=="filldepartments"){
        $facid = $_POST['facultyid'];
        $stmt=$newconn->conn->prepare("Select * from Department where facultyID=".$facid);
        $stmt->execute();
        $getDeps=$stmt->fetchall();

        $i=0;
        echo '<option  ordi="'.$i.'" value=0 selected>Choose...</option>';
        foreach($getDeps as $dep){
            $i++;
            echo '<option ordi="'.$i.'" value='.$dep['departmentID'].'>'.$dep['name'].'</option>';
        }
    }

    else if($_POST['function']=="fillcourses"){
        $depid = $_POST['departmentid'];
        $stmt=$newconn->conn->prepare("Select * from Course where departmentID=".$depid." order by code");
        $stmt->execute();
        $getCourses=$stmt->fetchall();
        // print_r($getCourses);

        $i=0;
        echo '<option  ordi="'.$i.'" value=0 selected>Choose...</option>';
        foreach($getCourses as $cou){
            $i++;
            echo '<option ordi="'.$i.'" value='.$cou['courseID'].'>'.$cou['name'].'</option>';
        }
    }

    else if($_POST['function']=="fillclasses"){
        $cid = $_POST['courseid'];
        $stmt=$newconn->conn->prepare("Select * from Class where courseID=".$cid." and year<2019 order by year");
        $stmt->execute();
        $getClasses=$stmt->fetchall();
        //print_r($getClasses);

        $i=0;
        echo '<option  ordi="'.$i.'" value=0 selected>Choose...</option>';
        foreach($getClasses as $klass){
            $i++;
            echo '<option ordi="'.$i.'" value='.$klass['classID'].'>'.yearHelper($klass['term'],$klass['year']).' - '.$klass['term'].'</option>';
        }
    }

    else if($_POST['function']=="updatechart"){
        $facid = $_POST['facultyid'];
        $depid = $_POST['departmentid'];

        $stmt=$newconn->conn->prepare("select sex,count(*) as Count from Student  where departmentID=".$depid." group by sex order by sex");
        $stmt->execute();
        $MFCount=$stmt->fetchall();
        $M = $MFCount[1]['Count'];
        $F = $MFCount[0]['Count'];

        $stmt=$newconn->conn->prepare("select count(*) as Count from Instructor  where departmentID=".$depid);
        $stmt->execute();
        $InsCount=$stmt->fetchall();
        $I = $InsCount[0]['Count'];

        echo json_encode(array("M"=>$M,"F"=>$F,"Ins"=>$I));
    }

    else if($_POST['function']=="updatecoursechart"){
        $courseid = $_POST['courseid'];

        $stmt=$newconn->conn->prepare("select (select count(*) from StudentHasGraded where courseID=".$courseid." and substr(grade,1,1)='F') as failed, (select count(*) from StudentHasGraded where courseID=".$courseid." and substr(grade,1,1)!='F') as passed;");
        $stmt->execute();
        $PF=$stmt->fetchall()[0];
        //print_r($PF);
        $P = $PF['passed'];
        $F = $PF['failed'];

        echo json_encode(array("P"=>$P,"F"=>$F));
    }

    else if($_POST['function']=="updateclasschart"){
        $cid = $_POST['classid'];

        $stmt=$newconn->conn->prepare("select (select count(*) from StudentHasGraded where classID=".$cid." and substr(grade,1,1)='F') as failed, (select count(*) from StudentHasGraded where classID=".$cid." and substr(grade,1,1)!='F') as passed;");
        $stmt->execute();
        $PF=$stmt->fetchall()[0];
        //print_r($PF);
        
        $P = $PF['passed'];
        $F = $PF['failed'];

        echo json_encode(array("P"=>$P,"F"=>$F));
    }

    else if($_POST['function']=="updateFacultyBarChart"){
   
        $stmt=$newconn->conn->prepare("Select name from Faculty");
        $stmt->execute();
        $Facs=$stmt->fetchall();
        // print_r($Facs);
        $facArr = array( );
        
        $stmt=$newconn->conn->prepare("select * from takedropfacultycountView");
        $stmt->execute();
        $TDFC = $stmt->fetchall();
        
        $FCchart=array();
        foreach($TDFC as $FC){
            $FCchart = array_merge($FCchart,array($FC['ftd']=>$FC['count']));
        }
        //print_r($FCchart);
        
        foreach($Facs as $f){
        
            $T=$FCchart[$f['name'].'T'];
            $D=$FCchart[$f['name'].'D'];
            if(is_null($T)){
                $T=0;
            }
            if(is_null($D)){
                $D=0;
            }
            if($T+$D>0){
                array_push($facArr,array("name"=>$f['name'],"T"=>$T, "D"=>$D ));
            }
            //echo $f['name'].":".$T."-".$D."<br>";
        }
        //print_r($facArr);

        echo json_encode($facArr);
    }

    else if($_POST['function']=="updateDepartmentBarChart"){

        $facid=$_POST['facultyid'];
   
        $stmt=$newconn->conn->prepare("Select name from Department where facultyID=".$facid);
        $stmt->execute();
        $Deps=$stmt->fetchall();
        // print_r($Deps);
        
        
        $stmt=$newconn->conn->prepare("select * from takedropdepartmentcountView");
        $stmt->execute();
        $TDDC = $stmt->fetchall();
        
        $DCchart=array();
        foreach($TDDC as $DC){
            $DCchart = array_merge($DCchart,array($DC['dtd']=>$DC['count']));
        }
        //print_r($DCchart);

        $depArr = array( );
        foreach($Deps as $d){
            $T=$DCchart[$d['name'].'T'];
            $D=$DCchart[$d['name'].'D'];
            if(is_null($T)){
                $T=0;
            }
            if(is_null($D)){
                $D=0;
            }
            if($T+$D>0){
                array_push($depArr,array("name"=>$d['name'],"T"=>$T, "D"=>$D ));
            }
            //echo $d['name'].":".$T."-".$D."<br>";
        }
        //print_r($depArr);

        echo json_encode($depArr);
    }
    
    else if($_POST['function']=="updateCourseBarChart"){

        $depid=$_POST['departmentid'];
   
        $stmt=$newconn->conn->prepare("Select name from Course where departmentID=".$depid);
        $stmt->execute();
        $Cous=$stmt->fetchall();
        // print_r($Cous);
        
        $stmt=$newconn->conn->prepare("select * from takedropcoursecountView");
        $stmt->execute();
        $TDCC = $stmt->fetchall();
        
        $CCchart=array();
        foreach($TDCC as $CC){
            $CCchart = array_merge($CCchart,array($CC['ctd']=>$CC['count']));
        }
        //print_r($FCchart);
        
        $couArr = array( );
        foreach($Cous as $c){
        
            $T=$CCchart[$c['name'].'T'];
            $D=$CCchart[$c['name'].'D'];
            if(is_null($T)){
                $T=0;
            }
            if(is_null($D)){
                $D=0;
            }
            if($T+$D>0){
                array_push($couArr,array("name"=>$c['name'],"T"=>$T, "D"=>$D ));
            }
            //echo $c['name'].":".$T."-".$D."<br>";
        }
        //print_r($facArr);

        echo json_encode($couArr);
    }

    else if($_POST['function']=="updateStu"){

        $depid = $_POST['departmentid'];

        $stmt=$newconn->conn->prepare("select studentID,stu.name as StudentName,stu.surname as StudentSurname,startYear,stu.sex,ins.name as AdvisorName,ins.surname as AdvisorSurname,(collectedGrade /collectedCredits) as GPA from (select * from Student  where graduate=0 and  departmentID=".$depid.") stu, (select * from Instructor where departmentID=".$depid.") ins where instructorID=advisor order by startYear ASC , GPA DESC;");
        $stmt->execute();
        $Students=$stmt->fetchall();

        echo '<table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Student Number</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Student Surname</th>
                        <th scope="col">Start Year</th>
                        <th scope="col">GPA</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Advisor Name</th>
                        <th scope="col">Advisor Surname</th>
                    </tr>
                </thead>
                <tbody>';
        $i=1;
        foreach($Students as $stu){
            echo '<tr onclick="window.location=\'inspectStudent.php?stuid='.$stu['studentID'].'\';">
                    <th scope="row">'.$i.'</th>
                    <td>'.$stu['studentID'].'</td>
                    <td>'.$stu['StudentName'].'</td>
                    <td>'.$stu['StudentSurname'].'</td>
                    <td>'.$stu['startYear'].'</td>
                    <td>'.number_format($stu['GPA'], 2, '.', ',').'</td>
                    <td>'.$stu['sex'].'</td>
                    <td>'.$stu['AdvisorName'].'</td>
                    <td>'.$stu['AdvisorSurname'].'</td>
                </tr>';
            $i++;
        }
        echo '</tbody>
        </table>';
    }
    

    else if($_POST['function']=="updateGraduatedStu"){

        $depid = $_POST['departmentid'];

        //echo "select * from Student where departmentID=".$depid." and graduate=1";
        $stmt=$newconn->conn->prepare("select * from Student where departmentID=".$depid." and graduate=1 order by startYear DESC, (collectedGrade/collectedCredits) DESC");
        $stmt->execute();
        $Students=$stmt->fetchall();

        echo '<table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Student Number</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Student Surname</th>
                        <th scope="col">Start Year</th>
                        <th scope="col">Graduated Year</th>
                        <th scope="col">GPA</th>
                        <th scope="col">Gender</th>
                    </tr>
                </thead>
                <tbody>';
        $i=1;
        foreach($Students as $stu){
            echo '<tr onclick="window.location=\'inspectStudent.php?stuid='.$stu['studentID'].'\';">
                    <th scope="row">'.$i.'</th>
                    <td>'.$stu['studentID'].'</td>
                    <td>'.$stu['name'].'</td>
                    <td>'.$stu['surname'].'</td>
                    <td>'.$stu['startYear'].'</td>
                    <td>2019</td>
                    <td>'.number_format(($stu['collectedGrade']/$stu['collectedCredits']), 2, '.', ',').'</td>
                    <td>'.$stu['sex'].'</td>
                </tr>';
            $i++;
        }
        echo '</tbody>
        </table>';
    }


    else if($_POST['function']=="updateStuGradedClass"){

        $cid = $_POST['classid'];

        $stmt=$newconn->conn->prepare("SELECT * FROM studenthasgradedJoin where classID=".$cid);
        $stmt->execute();
        $Students=$stmt->fetchall();

        echo '<table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Student Number</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Student Surname</th>
                        <th scope="col">Grade</th>
                    </tr>
                </thead>
                <tbody>';
        $i=1;
        foreach($Students as $stu){
            $color="";
            if($stu['grade'][0]=="F")
                $color='class="table-danger"';
            else
                $color='class="table-primary"';
            echo '<tr '.$color.' onclick="window.location=\'inspectStudent.php?stuid='.$stu['studentID'].'\';">
                    <th scope="row">'.$i.'</th>
                    <td>'.$stu['studentID'].'</td>
                    <td>'.$stu['StudentName'].'</td>
                    <td>'.$stu['StudentSurname'].'</td>
                    <td>'.$stu['grade'].'</td>
                </tr>';
            $i++;
        }
        echo '</tbody>
        </table>';
    }

    else if($_POST['function']=="updateIns"){

        $depid = $_POST['departmentid'];

        $stmt=$newconn->conn->prepare("select * from Instructor where departmentID=".$depid);
        $stmt->execute();
        $Instructors=$stmt->fetchall();

        echo '<table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Instructor Number</th>
                        <th scope="col">Instructor Name</th>
                        <th scope="col">Instructor Surname</th>
                        <th scope="col">Gender</th>
                    </tr>
                </thead>
                <tbody>';
        $i=1;
        foreach($Instructors as $ins){
            echo '<tr onclick="window.location=\'inspectInstructor.php?insid='.$ins['instructorID'].'\';">
                    <th scope="row">'.$i.'</th>
                    <td>'.$ins['instructorID'].'</td>
                    <td>'.$ins['name'].'</td>
                    <td>'.$ins['surname'].'</td>
                    <td>'.$ins['sex'].'</td>
                </tr>';
            $i++;
        }
        echo '</tbody>
        </table>';
    }

    else if($_POST['function']=="deleteStuCourse"){

        $stuid = $_POST['studentid'];
        $cid = $_POST['classid'];
        $sid = $_POST['sectionid'];

        if($sid==0){
            $delCourseSQL = "delete from StudentHasGraded where studentID=".$stuid." and classID=".$cid;
        }
        else{
            $delCourseSQL = "delete from StudentTakenCourse where studentID=".$stuid." and classID=".$cid." and sectionID=".$sid;
        }
       
        $stmt=$newconn->conn->prepare($delCourseSQL);
        $stmt->execute();
        
    }
    
    else if($_POST['function']=="updateStuGrade"){

        $stuid = $_POST['studentid'];
        $courseid = $_POST['courseid'];
        $cid = $_POST['classid'];
        $sid = $_POST['sectionid'];
        $newgrade = $_POST['newgrade'];

        $allgradesletter = array("A1","A2","A3","B1","B2","B3","C1","C2","C3","D","F1","F2","F3");
        $flag=0;
        foreach($allgradesletter as $letter){
            if($letter==$newgrade){$flag=1;break;}
        }
        if($flag==0){
            return;
        }

        // print_r($_POST);

        if($sid==0){
            $updateCourseGradeSQL = "UPDATE StudentHasGraded SET grade='".$newgrade."' where studentID=".$stuid." and classID=".$cid;
            echo $updateCourseGradeSQL;
        }
        else{
            $updateCourseGradeSQL = "call gradeMe(".$stuid.", ".$courseid.", ".$cid.",".$sid.",'".$newgrade."')";
            echo $updateCourseGradeSQL;
        }
       
        $stmt=$newconn->conn->prepare($updateCourseGradeSQL);
        $stmt->execute();
        
    }
    

    
}


?>