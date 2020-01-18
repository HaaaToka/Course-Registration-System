<?php

include "../includer.php";

$newconn = new ConnectDB($sn,$un,$pss,$db);

// collected credit ve grades i doldur filldb ile.

?>



<div class="container">
    <h1 class="display-3" align="center">Hello How Are You, <?php  echo $_SESSION['name']." ".$_SESSION['surname'];?> </h1>
    <blockquote class="blockquote text-right">
        <p class="mb-0">Buraya soyle tasaklı bir cümle yazda boş durmasın bu sayfada</p>
        <footer class="blockquote-footer">someone famous among you </footer>
    </blockquote>
    <img width="200" height="200" src="<?php echo $mainLocation;?>media/pp/<?php echo $_SESSION["userid"]?>.png"/>
</div>