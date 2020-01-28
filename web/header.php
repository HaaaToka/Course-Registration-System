
<?php 

function innarray($uri){
    $search = explode("?",array_pop(explode("/",$uri)))[0];
    //echo $search."->>";
    $pages=array("transcript.php",
                "myClass.php",
                "lookClass.php");
    foreach($pages as $page){
        if($page==$search){
            return 1;
        }
    }
    return 0;
}

function printButton($uri){
    
    // echo $uri.$mainLocation."<br>,,";
    // echo innarray($uri,$mloc);
    if(innarray($uri,$mainLocation))
        echo '<button type="button" class="btn btn-warning" onClick="window.print()">Print this page</button>';
}

include_once "config.php";
include_once "function.php";


?>

<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="<?php echo $mainLocation;?>index.php"><img width="60" height="50" src="<?php echo $mainLocation;?>/media/img/hackerman3.png"></a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

            <li class="nav-item">
                <a class="badge-danger nav-link" href="<?php echo $mainLocation;?>media/img/hackDatabase.png">-_-</a>
            </li>
<?php if(isset($_SESSION["login"])){
            if($_SESSION['role']!="admin"){
                if($_SESSION['role']=="instructor"){?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            MENU
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a href="<?php echo $mainLocation;?>instructor/myClass.php" class="dropdown-item">My This Semester Classes</a>
                                <a href="<?php echo $mainLocation;?>instructor/myOldClass.php" class="dropdown-item">My ALL Classes</a>  
                        </div>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="btn btn-dark" onClick="window.location.href='myProfile.php'">My Profile</button>
                    </li> 
                    
                <?php }
                else if($_SESSION['role']=="student"){?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            MENU
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a href="<?php echo $mainLocation;?>student/myClass.php" class="dropdown-item">My Classes</a>
                                <a href="<?php echo $mainLocation;?>student/myProfile.php" class="dropdown-item">My Profile</a> 
                        </div>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="btn btn-dark" onClick="window.location.href='transcript.php'">My Transcript</button>
                    </li> 
                    <li class="nav-item">
                        <button type="button" class="btn btn-dark" onClick="window.location.href='courseRegistration.php'">Course Registration</button>
                    </li> 

                <?php } ?>

                <li class="nav-item" >
                    <span class="badge badge-light">Welcome : <?php echo $_SESSION["name"]." ".$_SESSION['surname']?></span>
                </li>
<?php       }
            else{?>
                
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $mainLocation;?>admin/course.php" class="dropdown-item">Courses</a>
                </li>              
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $mainLocation;?>admin/person.php" class="dropdown-item">People</a>
                </li>
<?php       }
        } ?>          
        </ul>

        <div id="loginout">
        
<?php


    printButton($_SERVER['REQUEST_URI']);

    if(isset($_SESSION['login'])){
        echo '<button type="button" class="btn btn-dark" onClick="window.location.href=\''.$mainLocation.'logout.php\'">LOGOUT</button>';
    }
    else{
    echo '<button type="button" class="btn btn-ligth" onClick="window.location.href=\''.$mainLocation.'login.php\'">LOGIN</button>';
    }
    
?>

        </div>

    </div>
</nav>


