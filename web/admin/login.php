<?php

session_start();
include "../database.php";
include "../config.php";
include "../functions.php";
include "../base.html";
include "../header.php";
#include_once "includer.php";

$newconn = new ConnectDB($sn,$un,$pss,$db);

$message = "";

if(isset($_POST['form'])){
    // print_r($_POST);    
    $userid = addslashes($_POST['userid']);
    #$password = addslashes($_POST['password']);
    $password =  hash("sha1",$_POST['password'],false);

    $sql = "SELECT * FROM UsersAdmin WHERE userid='$userid'AND password='$password'";
    $redirect = "dashboard.php";
    
    // echo $userid."--".$password;

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
                $_SESSION["token"] = $token;

                $_SESSION["login"] = "true";
                $_SESSION["userid"]=$row['userid'];
                $_SESSION["role"]="admin";
                $_SESSION["term"]=$term;
                $_SESSION["year"]=$year;

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
    <h1>LOGIN</h1>

    <p>Enter your username and password:</p>

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="POST">

        <p><label for="userid">User ID:</label><br />
        <input type="text" id="userid" name="userid"></p>

        <p><label for="password">Password:</label><br />
        <input type="password" id="password" name="password"></p>


        <button type="submit" name="form" value="submit">LogIn</button>

    </form>

    <p><?php echo $message;?></p>

</div>


<?php



$newconn->disconnectServer();


?>
