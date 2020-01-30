
<?php

include "includer.php";

//print_r($_SESSION);

if($_SESSION['role']=="student"){
    header("Location: student/myProfile.php");
}
else if($_SESSION['role']=="instructor"){
    header("Location: instructor/myProfile.php");
}
else if($_SESSION['role']=="admin"){
    header("Location: admin/dashboard.php");
}

?>

