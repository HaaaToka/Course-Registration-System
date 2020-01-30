<?php

include "../includer.php";

$newconn = new ConnectDB($sn,$un,$pss,$db);

$stmt = $newconn->conn->prepare("select * from joininstructordepartmentfaculty where instructorID=".$_SESSION['userid']);
$stmt->execute();
$who = $stmt->fetch();
// print_r($who);

if(isset($_POST["submit"])) {

    $target_dir ="../media/pp/ins/";
    $error = file_upload_check($_FILES["fileToUpload"],array("png","jpg"),$target_dir);

    if($error == ""){
        $target_file = $target_dir .$_SESSION['userid'].".png";
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

?>

<div class="container">
    <!-- <h1 class="display-3" align="center">Hello How Are You, <?php  echo $_SESSION['name']." ".$_SESSION['surname'];?></h1> -->
    <blockquote class="blockquote text-right">
        <p class="mb-0">Yeni nesli, Cumhuriyet’in özverili öğretmen ve eğitmenleri, sizler yetiştireceksiniz; yeni nesil, sizin eseriniz olacaktır. Eserin kıymeti, sizin yeteneğiniz ve özveriniz derecesiyle uygun olacaktır. Cumhuriyet; fikren, ilmen, fennen, bedenen kuvvetli ve yüksek karakterli koruyucular ister. Yeni nesli, bu kalite ve yetenekte yetiştirmek sizin elinizdedir. Sizlerin, seçkin görevinizin yerine getirilmesine büyük özveriyle varlığınızı vereceğinize hiç şüphe etmem.</p>
        <footer class="blockquote-footer">MUSTAFA KEMAL ATATURK </footer>
    </blockquote>
</div>


<div class="container">
    <div class="row">
        <div class="col-3">
            <div class="col-md-12 col-md-12-sm-12 col-xs-12 user-image text-center">
                <img width="200" height="200"
                    src="<?php echo $mainLocation;?>media/pp/ins/<?php echo $_SESSION["userid"]?>.png"
                    class="rounded-circle">
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 user-detail-section1 text-center">
                <div class="form-group">
                    <form action="myProfile.php" method="post" enctype="multipart/form-data">
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
                                        <p><?php echo $who["instructorID"]."ins@mok.edu.tr"?></p>
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


function fillInstructorAdvisedStudent($students){
    $i=1;
    foreach($students as $stu){

        echo '<tr>
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



$stmt = $newconn->conn->prepare("SELECT * FROM Student where advisor=".$_SESSION['userid']);
$stmt->execute();
$students = $stmt->fetchall();
//print_r($gradeKlass);


?>

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
                    <?php  fillInstructorAdvisedStudent($students); ?>
            </tbody>
        </table>
    </div>
</div>

