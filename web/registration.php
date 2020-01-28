<?php

include_once "base.html";
include_once "header.php";

include_once "functions.php";
include_once "database.php";

$message="";

$newconn = new ConnectDB($sn,$un,$pss,$db);

$stmt=$newconn->conn->prepare("select * from Department order by name");
$stmt->execute();
$deps=$stmt->fetchall();
//print_r($deps);


if(isset($_POST['form'])){
    
    // $sql = "call registration(':nname',':ssurname',':ppassword',:yyear)";
    // $stmt = $newconn->conn->prepare($sql);
    // $stmt -> bindParam('name',$_POST['name'],PDO::PARAM_STR);
    // $stmt -> bindParam('surname',$_POST['surname'],PDO::PARAM_STR);
    // $stmt -> bindParam('password',$_POST['password'],PDO::PARAM_STR);
    // $stmt -> bindParam('year',$_POST['startyear'],PDO::PARAM_INT);

    $nname = sql_check($_POST['name']);
    $ssurname = sql_check($_POST['surname']);
    // $ppass = sqli_check_1($_POST['password']);
    $yyear =sql_check($_POST['startyear']);
    $uuserid=-1;
    // $sql="call registration('".$nname."','".$ssurname."','".$ppass."',".$yyear.")";
    $depid = sql_check($_POST['department']);


    $sql="call registration('".$nname."','".$ssurname."',".$yyear.",".$depid.")";
    //echo $sql;
    $stmt = $newconn->conn->prepare($sql);
    if(!$stmt){
        die("Error: ". print_r($stmt->errorInfo()));
    }
    else{
        $stmt -> execute();
        if($stmt->rowCount()!=0){
            $row = $stmt->fetch();
            // echo print_r($row);
            if($row){
                
                $message = 'Yuppiii! You are a student at OYT. <br> 
                            Your Student ID = <span class="badge badge-success">'.$row['sid'].'</span> Password= <span class="badge badge-success">'.$nname.$ssurname.'123</span> 
                            <br><a class="badge badge-primary" href="login.php">Click Me To Log In</a>';
            }
        }
        else{
            $message = "<font color=\"red\">Invalid credentials!</font>";
        }
    }
}



?>




<div class="container">
    <?php echo $message;?></p>
    <h1>SIGNUP</h1>

    <p>Fill the require fields:</p>

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="POST">

        <p><label for="name">Name:</label><br />
        <input type="text" id="name" name="name"></p>

        <p><label for="surname">Surname:</label><br />
        <input type="text" id="surname" name="surname"></p>

        <!-- <p><label for="password">Password:</label><br />
        <input type="password" id="password" name="password"></p> -->
        
        <p><label for="startyear">Start Year:</label><br />
        <select name="startyear" id="startyear">
            <option value="2013">2013</option>
            <option value="2014">2014</option>
            <option value="2015">2015</option>
            <option value="2016">2016</option>
            <option value="2017">2017</option>
            <option value="2018">2018</option>
        </select></p>

        <p><label for="department">Department:</label><br/>
        <select name="department" id="department">
            
            <?php
            
                foreach($deps as $ss){
                    echo '<option value='.$ss["departmentID"].'>'.$ss["name"].'</option>';
                }
            
            ?>
            
        </select></p>

        <!-- <p>If you sign up, You are accepted being in the computer engineering department and being a student</p> -->

        <button type="submit" name="form" value="submit">Sign Up</button>

    </form>

    <p>

</div>
