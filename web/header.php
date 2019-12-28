

<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php"><img width="125" height="50" src="media/img/hackerman.png"></a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

            <li class="nav-item">
                <a class="nav-link" href="media/img/hackDatabase.png">Link</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    HELLOOOO
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a href="#">dersler</a>
                    <a href="#">cartcurt</a>
                </div>
            </li>
            <li class="nav-item" >
<?php if(isset($_SESSION["login"])){ 
?>
        <div id="person">
            <font color="orange"> <label>Welcome : <?php echo $_SESSION["userid"]?></label> </font> <br />
        </div>  
<?php } 
?>
            </li>
        </ul>

        <div id="loginout">
        
<?php

            if(isset($_SESSION['login'])){
?>
            <input type="button" value="LOGOUT" onclick="window.location.href='logout.php'">
<?php
            }
            else{
?>
            <input type="button" value="LOGIN" onclick="window.location.href='login.php'">
<?php
            }
?>

        </div>

    </div>
</nav>


