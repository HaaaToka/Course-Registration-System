<?php

include "../includer.php";

$newconn = new ConnectDB($sn,$un,$pss,$db);

if(isset($_GET["stuid"]) ){
    $stuid = $_GET["stuid"];


    $stmt = $newconn->conn->prepare("select * from joinstudentdepartmentfaculty where studentID=".$stuid);
    $stmt->execute();
    $who = $stmt->fetch();
    # print_r($who);
    
    $stmt=$newconn->conn->prepare("select name,surname from Instructor where instructorID=".$who['advisor']);
    $stmt->execute();
    $myadvisor=$stmt->fetch();
    #print_r($myadvisor);
    
    if(isset($_POST["submit"])) {
    
        $target_dir ="../media/pp/stu/";
        $error = file_upload_check($_FILES["fileToUpload"],array("png"),$target_dir);
    
        if($error == ""){
            $target_file = $target_dir .$stuid.".png";
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
                    src="<?php echo $mainLocation;?>media/pp/stu/<?php echo $stuid?>.png"
                    class="rounded-circle">
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 user-detail-section1 text-center">
                <div class="form-group">
                    <form action="<?php echo($_SERVER["SCRIPT_NAME"])."?stuid=".$stuid;?>" method="post" enctype="multipart/form-data">
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
                        <h1><?php echo $who["studentName"]?></h1>
                        <h5><?php echo $who["studentSurname"]?></h5>
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
                            <li class="nav-item">
                                <a class="nav-link" href="#buzz" role="tab" data-toggle="tab"><i
                                        class="fas fa-info-circle"></i> About Courses </a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="profile">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Student Number</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $who["studentID"]?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $who["studentID"]."@mok.edu.tr"?></p>
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
                            <div role="tabpanel" class="tab-pane fade" id="buzz">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Collected Credits</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $who["collectedCredits"]?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Collected Grade</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $who["collectedGrade"]?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>GPA</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo number_format($who["collectedGrade"]/$who["collectedCredits"], 2, '.', ',')?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Advisor</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $myadvisor['name']." ".$myadvisor['surname']?></p>
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



function fillStudentAdmin1($gradeKlass){
    $i=1;
    foreach($gradeKlass as $klass){
        echo '<tr>
                <td scope="col">'.$i.'</td>
                <td scope="col">'.$klass["code"].'</td>
                <td scope="col">'.$klass["courseName"].'</td>
                <td scope="col">'.yearHelper($klass["term"],$klass["year"]).'</td>
                <td scope="col">'.$klass["term"].'</td>
                <td scope="col"><input size="2" type="text" id="newgrade'.$klass["classID"].'" placeholder="'.$klass["grade"].'"/></td>
                <td scope="col"><button type="button" class="btn btn-warning" courseid="'.$klass["courseID"].'" classid="'.$klass["classID"].'" sectionid="0" id="update">x</button></td>
                <td scope="col"><button type="button" class="btn btn-danger" courseid="'.$klass["courseID"].'" classid="'.$klass["classID"].'" sectionid="0" id="delete">x</button></td>
            </tr>
                ';
        $i++;
    }
}

function fillStudentAdmin2($takenKlass){
    $i=1;
    foreach($takenKlass as $klass){
        echo '<tr>
                <td scope="col">'.$i.'</td>
                <td scope="col">'.$klass["CourseCode"].'</td>
                <td scope="col">'.$klass["CourseName"].'</td>
                <td scope="col">'.yearHelper($klass["term"],$klass["year"]).'</td>
                <td scope="col">'.$klass["term"].'</td>
                <td scope="col"><input size="2" type="text" id="newgrade'.$klass["classID"].'"/></td>
                <td scope="col"><button type="button" class="btn btn-warning" courseid="'.$klass["courseID"].'" classid="'.$klass["classID"].'" sectionid="'.$klass["sectionID"].'" id="update">x</button></td>
                <td scope="col"><button type="button" class="btn btn-danger" courseid="'.$klass["courseID"].'" classid="'.$klass["classID"].'" sectionid="'.$klass["sectionID"].'" id="delete">x</button></td>
            </tr>
                ';
        $i++;
    }
}

$stmt = $newconn->conn->prepare("call getMyTranscript(".$stuid.")");
$stmt->execute();
$gradeKlass = $stmt->fetchall();
//print_r($gradeKlass);

$newconn->disconnectServer();
$newconn = new ConnectDB($sn,$un,$pss,$db);

$stmt = $newconn->conn->prepare("call 471DB.OneStudentTookAllCourse(".$stuid.")");
$stmt->execute();
$takenKlass = $stmt->fetchall();

?>


<div class="container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Course Code</th>
                <th scope="col">Course Name</th>
                <th scope="col">Year</th>
                <th scope="col">Fall</th>
                <th scope="col">Grade</th>
                <th scope="col">Update</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
                <?php fillStudentAdmin1($gradeKlass); fillStudentAdmin2($takenKlass); ?>
        </tbody>
    </table>
</div>



<script>

function delete_update_Class(functionName,courseid,klassid,secid,niw){
    $.ajax({
      url:"api.php",
      type:"POST",
      data:{
              function:functionName,
              studentid:<?php echo $who['studentID']?>,
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