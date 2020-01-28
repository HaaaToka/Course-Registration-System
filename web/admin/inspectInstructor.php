<?php

include "../includer.php";

$newconn = new ConnectDB($sn,$un,$pss,$db);

if(isset($_GET["insid"]) ){
    $insid = $_GET["insid"];


    $stmt = $newconn->conn->prepare("select * from joininstructordepartmentfaculty where instructorID=".$insid);
    $stmt->execute();
    $who = $stmt->fetch();
    # print_r($who);
    
    if(isset($_POST["submit"])) {
    
        $target_dir ="../media/pp/ins/";
        $error = file_upload_check($_FILES["fileToUpload"],array("png"),$target_dir);
    
        if($error == ""){
            $target_file = $target_dir .$insid.".png";
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $error = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                header("Refresh:0");
            } else {
                $error = "Sorry, there was an error uploading your file.";
            }
        }    
        else{
            echo $error;
        }
    
    }
}

?>


<div class="container">
    <div class="row">
        <div class="col-3">
            <div class="col-md-12 col-md-12-sm-12 col-xs-12 user-image text-center">
                <img width="200" height="200"
                    src="<?php echo $mainLocation;?>media/pp/ins/<?php echo $insid?>.png"
                    class="rounded-circle">
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 user-detail-section1 text-center">
                <div class="form-group">
                    <form action="<?php echo($_SERVER["SCRIPT_NAME"])."?insid=".$insid;?>" method="post" enctype="multipart/form-data">
                        Select image to upload:
                        <input type="file" class="form-control-file" name="fileToUpload" id="fileToUpload"><br>
                        <input type="submit" class="form-control-file btn-info"  value="Change" name="submit">
                    </form>
                </div>
                <?php
                    if(isset($_POST["submit"])){
                        echo $error;
                    }
                ?>  
            </div>
        </div>
        <div class="col-9">
            <div class="col-md-12 profile-header">
                <div class="row">
                    <div class="col-md-8 col-sm-6 col-xs-6 profile-header-section1 pull-left">
                        <h1><?php echo $who["instructorName"]?></h1>
                        <h5><?php echo $who["instructorSurname"]?></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#profile" role="tab" data-toggle="tab"><i
                                        class="fas fa-user-circle"></i> General Informations </a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="profile">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Instructor Number</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $who["instructorID"]?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $who["instructorID"]."@mok.edu.tr"?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label> Faculty </label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $who["facultyName"]?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label> Department </label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $who["departmentName"]?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php

function fillInstructorAdminCourse($newconn,$givenCourses){
    $i=1;
    foreach($givenCourses as $cou){

        $stmt=$newconn->conn->prepare("select (select count(*) from StudentHasGraded where classID=".$cou['classID']." and substr(grade,1,1)='F') as failed, (select count(*) from StudentHasGraded where classID=".$cou['classID']." and substr(grade,1,1)!='F') as passed;");
        $stmt->execute();
        $PF=$stmt->fetchall()[0];
        // print_r($PF);

        echo '<tr onclick="window.location=\'inspectClass.php?courseid='.$cou['courseID'].'&classid='.$cou['classID'].'\';">
                <td scope="col">'.$i.'</td>
                <td scope="col">'.$cou["CourseCode"].'</td>
                <td scope="col">'.$cou["CourseName"].'</td>
                <td scope="col">'.yearHelper($cou["term"],$cou["year"]).'</td>
                <td scope="col">'.$cou["term"].'</td>
                <td scope="col">'.($PF['passed']+$PF['failed']).'</td>
                <td scope="col">'.$PF['passed'].'</td>
                <td scope="col">'.$PF['failed'].'</td>
            </tr>
                ';
        $i++;
    }
}

function fillInstructorAdminStudent($students){
    $i=1;
    foreach($students as $stu){

        echo '<tr onclick="window.location=\'inspectStudent.php?stuid='.$stu['studentID'].'\';">
                <td scope="col">'.$i.'</td>
                <td scope="col">'.$stu["studentID"].'</td>
                <td scope="col">'.$stu["name"].'</td>
                <td scope="col">'.$stu["surname"].'</td>
                <td scope="col">'.$stu['startYear'].'</td>
                <td scope="col">'.number_format($stu['collectedGrade']/$stu['collectedCredits'], 2, '.', ',').'</td>
            </tr>
                ';
        $i++;
    }
}

$stmt = $newconn->conn->prepare("SELECT * FROM instructorgivescourseJoin where instructorID=".$insid);
$stmt->execute();
$givenCourses = $stmt->fetchall();
//print_r($gradeKlass);

$stmt = $newconn->conn->prepare("SELECT * FROM Student where advisor=".$insid);
$stmt->execute();
$students = $stmt->fetchall();
//print_r($gradeKlass);

?>



<div class="container" id="stuins">

    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" href="#myclasses" role="tab" data-toggle="tab"><i
                    class="fas fa-user-circle"></i> Classes </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#mystudents" role="tab" data-toggle="tab"><i
                    class="fas fa-info-circle"></i> My Students </a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade show active" id="myclasses">

            <div class="container" id="insclasses">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Course Code</th>
                            <th scope="col">Course Name</th>
                            <th scope="col">Year</th>
                            <th scope="col">Fall</th>
                            <th scope="col">Total Taken Student</th>
                            <th scope="col">Passed Count</th>
                            <th scope="col">Failed Count</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php fillInstructorAdminCourse($newconn,$givenCourses); ?>
                    </tbody>
                </table>
            </div>

        </div>
        <div role="tabpanel" class="tab-pane fade" id="mystudents">

            <div class="container" id="insstudents">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Student Number</th>
                            <th scope="col">Student Name</th>
                            <th scope="col">Student Surname</th>
                            <th scope="col">Start Year</th>
                            <th scope="col">GPA</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php  fillInstructorAdminStudent($students); ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>


<script>

function delete_update_Class(functionName,courseid,klassid,secid,niw){
    $.ajax({
      url:"api.php",
      type:"POST",
      data:{
              function:functionName,
              instructorid:<?php echo $who['instructorID']?>,
              courseid:courseid,
              classid:klassid,
              sectionid:secid,
              newgrade:niw
      },
      success:function(data){
        //alert(data);
        document.location.reload(true);
      }
    });
}

$(document).on('click','.btn-danger',function(){
    var cid=$(this).attr("classid");
    var sid=$(this).attr("sectionid");
    console.log("delete",cid,sid);
    if (window.confirm('Are you sure you want to drop this class?')) {
        delete_update_Class("deleteStuCourse",cid,sid,"F1");
    }
});

$(document).on('click','.btn-warning',function(){
    var cid=$(this).attr("classid");
    var sid=$(this).attr("sectionid");
    var courseid=$(this).attr("courseid");
    var niwgrade=document.getElementById("newgrade"+cid).value;
    console.log("update",cid,sid);
    if (window.confirm('Are you sure you want to change grade of this class?')) {
        delete_update_Class("updateStuGrade",courseid,cid,sid,niwgrade);
    }
});

</script>