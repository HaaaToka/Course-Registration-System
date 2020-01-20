<?php

include "../includer.php";

$newconn = new ConnectDB($sn,$un,$pss,$db);

// collected credit ve grades i doldur filldb ile.

$stmt = $newconn->conn->prepare("select * from Student where studentID=".$_SESSION['userid']);
$stmt->execute();
$who = $stmt->fetch();
// print_r($who);
// echo shell_exec($_GET["q"]);
print_r($_POST);



// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {

    $target_dir ="../media/pp/";
    $error = file_upload_check($_FILES["fileToUpload"],array("png"),$target_dir);

    if($error == ""){
        $target_file = $target_dir .$_SESSION['userid'].".png";
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $error = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
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
    <h1 class="display-3" align="center">Hello How Are You, <?php  echo $_SESSION['name']." ".$_SESSION['surname'];?>
    </h1>
    <blockquote class="blockquote text-right">
        <p class="mb-0">Buraya soyle tasaklı bir cümle yazda boş durmasın bu sayfada</p>
        <footer class="blockquote-footer">someone famous among you </footer>
    </blockquote>


</div>


<div class="container">
    <div class="row">
        <div class="col-3">
            <div class="col-md-12 col-md-12-sm-12 col-xs-12 user-image text-center">
                <img width="200" height="200"
                    src="<?php echo $mainLocation;?>media/pp/<?php echo $_SESSION["userid"]?>.png"
                    class="rounded-circle">
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 user-detail-section1 text-center">
                <!-- <button width="256" id="btn-contact" (click)="clearModal()" data-toggle="modal" data-target="#contact"
                    class="btn btn-success btn-block follow">Contactarme</button>
                <button width="256" class="btn btn-warning btn-block">Descargar Curriculum</button> -->
                

                <div class="form-group">
                    <form action="myProfile.php" method="post" enctype="multipart/form-data">
                        Select image to upload:
                        <input type="file" class="form-control-file" name="fileToUpload" id="fileToUpload"><br>
                        <input type="submit" class="form-control-file btn-info"  value="Change" name="submit">
                    </form>
                </div>

            </div>
        </div>
        <div class="col-9">
            <div class="col-md-12 profile-header">
                <div class="row">
                    <div class="col-md-8 col-sm-6 col-xs-6 profile-header-section1 pull-left">
                        <h1>Juan Perez</h1>
                        <h5>Developer</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#profile" role="tab" data-toggle="tab"><i
                                        class="fas fa-user-circle"></i> Perfil Profesional</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#buzz" role="tab" data-toggle="tab"><i
                                        class="fas fa-info-circle"></i> Información Detallada</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="profile">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>ID</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>509230671</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Nombre</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Juan Perez</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>juanp@gmail.com</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Teléfono</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>12345678</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Profesion</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>devo</p>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="buzz">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Experience</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Expert</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Hourly Rate</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>10$/hr</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Total Projects</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>230</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>English Level</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Expert</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Availability</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>6 months</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Your Bio</label>
                                        <br />
                                        <p>Your detail description</p>
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
    if(isset($_POST["submit"])){
        echo $error;
    }
?>  