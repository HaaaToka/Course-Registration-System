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
    print_r($_POST);    
    $userid = $_POST['userid'];
    $password = $_POST['password'];
    #$password =  hash("sha1",$_POST['password'],false);

    if($_POST['role']=='student'){
        $sql = "SELECT * FROM UsersStudent WHERE userid='$userid'AND password='$password'";
    }
    else{
        $sql = "SELECT * FROM UsersInstructor WHERE userid='$userid'AND password='$password'";
    }
    $stmt = $newconn->conn->prepare($sql);

    if(!$stmt){
        die("Error: ". print_r($stmt->errorInfo()));
    }
    else{
        $stmt->execute();

        if($stmt->rowCount()!=0){
            $row = $stmt->fetch();
            echo print_r($row);

            if($row){
                #session_regenerate_id(true);
                $token = hash("sha1",generateRandomString(10),false);
                $_SESSION["login"] = "true";
                $_SESSION["userid"]=$row['userid'];
                $_SESSION["role"]=$_POST['role'];
                $_SESSION["token"] = $token;
                ?> <script>window.location="index.php"</script> <?php
            }
        }
        else{
            $message = "<font color=\"red\">Invalid credentials or user not activated!</font>";
        }
    }

}

?>

<div class="container">
    <h1>LOGIN</h1>

    <p>Enter your username and password:</p>

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="POST">

        <p><label for="userid">User ID:</label><br />
        <input type="text" id="userid" name="userid"></p>

        <p><label for="password">P4SSw0rd:</label><br />
        <input type="password" id="password" name="password"></p>

        <select name="role" id="role">
            <option value="student">student</option>
            <option value="teacher">teacher</option>
        </select>

        <button type="submit" name="form" value="submit">LogIn</button>

    </form>

    <p><?php echo $message;?></p>

</div>


<?php



$newconn->disconnectServer();


?>
