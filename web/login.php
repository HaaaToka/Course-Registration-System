<?php

session_start();
include "database.php";
include "config.php";
include "functions.php";
include "base.html";
include "header.php";
#include_once "includer.php";

$newconn = new ConnectDB($sn,$un,$pss,$db);


$message = "";

if(isset($_POST['form'])){
    // print_r($_POST);    
    $userid = addslashes($_POST['userid']);
    #$password = addslashes($_POST['password']);
    $password =  hash("sha1",$_POST['password'],false);

    if($_POST['role']=='student'){
        $sql = "SELECT * FROM UsersStudent WHERE userid='$userid'AND password='$password'";
        $sqlDep = "Select * from Student where studentID=$userid";
        $redirect = "student/myProfile.php";
    }
    else{
        $sql = "SELECT * FROM UsersInstructor WHERE userid='$userid'AND password='$password'";
        $sqlDep="Select * from Instructor where instructorID=$userid";
        $redirect = "instructor/myProfile.php";
    }
    $stmt = $newconn->conn->prepare($sql);

    if(!$stmt){
        die("Error: ". print_r($stmt->errorInfo()));
    }
    else{
        $stmt->execute();


        if($stmt->rowCount()!=0){
            $row = $stmt->fetch();
            // echo print_r($row);

            if($row){
                #session_regenerate_id(true);
                $token = hash("sha1",generateRandomString(10),false);
                $_SESSION["login"] = "true";
                $_SESSION["userid"]=$row['userid'];
                $_SESSION["role"]=$_POST['role'];
                $_SESSION["term"]=$term;
                $_SESSION["year"]=$year;

                $stmt=$newconn->conn->prepare($sqlDep);
                $stmt->execute();
                $row2 = $stmt->fetch();
                #print_r($row2);
                $_SESSION['departmentID'] = $row2['departmentID'];
                $_SESSION['name']=$row2['name'];
                $_SESSION['surname']=$row2['surname'];
                $_SESSION["startyear"]=$row2['startYear'];

                $_SESSION["token"] = $token;
                header("Location: ".$redirect);
            }
        }
        else{
            $message = "<font color=\"red\">Invalid credentials!</font>";
        }
    }

}

?>

<div class="container">

    <p> Do you want to be a student? <a class="badge badge-warning" href="registration.php">Click Me for Registration</a> </p>

</div>

<div class="container">
    <h1>LOGIN</h1>

    <p>Enter your username and password:</p>

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="POST">

        <p><label for="userid">User ID:</label><br />
        <input type="text" id="userid" name="userid"></p>

        <p><label for="password">Password:</label><br />
        <input type="password" id="password" name="password"></p>

        <p><label for="role">Role:</label><br />
        <select name="role" id="role">
            <option value="student">student</option>
            <option value="instructor">instructor</option>
        </select>
        </p>

        <button type="submit" name="form" value="submit">LogIn</button>

    </form>

    <p><?php echo $message;?></p>

</div>


<?php



$newconn->disconnectServer();


?>
