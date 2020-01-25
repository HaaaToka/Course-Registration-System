<?php

include "../includer.php";

$newconn = new ConnectDB($sn,$un,$pss,$db);

$stmt = $newconn->conn->prepare("select * from joinstudentdepartmentfaculty where studentID=".$_SESSION['userid']);
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
        <p class="mb-0">Gençler, Cesaretimizi güçlendiren ve sürdüren sizlersiniz. Siz, almakta olduğunuz terbiye ve kültür ile, insanlık değerinin, vatan sevgisinin en değerli örneği olacaksınız.</p>
        <footer class="blockquote-footer">Mustafa Kemal ATATÜRK</footer>
    </blockquote>
</div>


<div class="container">
    <div class="row">
        <div class="col-3">
            <div class="col-md-12 col-md-12-sm-12 col-xs-12 user-image text-center">
                <img width="200" height="200"
                    src="<?php echo $mainLocation;?>media/pp/stu/<?php echo $_SESSION["userid"]?>.png"
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
                                        <label>Transcript</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><a href="transcript.php" class="badge badge-warning">Click Me To Look Transcript</a></p>
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


