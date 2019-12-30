
<?php include_once "config.php";?>

<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="<?php echo $mainLocation;?>index.php"><img width="125" height="50" src="<?php echo $mainLocation;?>/media/img/hackerman.png"></a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

            <li class="nav-item">
                <a class="nav-link" href="<?php echo $mainLocation;?>media/img/hackDatabase.png">Link</a>
            </li>
<?php if(isset($_SESSION["login"])){?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    MENU
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php if($_SESSION["role"]=="student"){?>  
                        <a href="<?php echo $mainLocation;?>student/myClass.php" class="dropdown-item">My Classes</a>
                        <a href="<?php echo $mainLocation;?>student/myProfile.php" class="dropdown-item">My Profile</a>
                    <?php }elseif($_SESSION["role"]=="instructor"){?>
                        <a href="<?php echo $mainLocation;?>instructor/myClass.php" class="dropdown-item">My Classes</a>
                        <a href="<?php echo $mainLocation;?>instructor/myProfile.php" class="dropdown-item">My Profile</a>  
                    <?php }?>
                </div>
            </li>
            <li class="nav-item" >
        <div id="person">
            <font color="orange"> <label>Welcome : <?php echo $_SESSION["userid"]?></label> </font> <br />
        </div>  
<?php } ?>
            </li>
        </ul>

        <div id="loginout">
        
<?php

            if(isset($_SESSION['login'])){
?>
            <input type="button" value="LOGOUT" onclick="window.location.href='<?php echo $mainLocation;?>logout.php'">
<?php
            }
            else{
?>
            <input type="button" value="LOGIN" onclick="window.location.href='<?php echo $mainLocation;?>login.php'">
<?php
            }
?>

        </div>

    </div>
</nav>


