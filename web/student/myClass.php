<?php

include "../includer.php";

$newconn = new ConnectDB($sn,$un,$pss,$db);


printCreditOnTopOfGrid($newconn,$_SESSION['userid']);


?>



<div class="container">

    <div class="accordion" id="classes">
    <div class="card">
        <div class="card-header" id="headingOne">
        <h2 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Current Classes
            </button>
        </h2>
        </div>

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#classes">
            <div class="card-body">
    

            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Course Code</th>
                    <th scope="col">Course Name</th>
                    <th scope="col">Course Credit</th>
                    </tr>
                </thead>
                <tbody>



            <?php

                takenCoursesbyMe($newconn->conn,$_SESSION['userid'],0);
            ?>

                </tbody>
                </table>

            </div>
        </div>
    </div>
    </div>

    <div class="accordion" id="schedule">
        <div class="card">
            <div class="card-header" id="headingOne">
            <h2 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    Weekly Schedule
                </button>
            </h2>
            </div>

            <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#schedule">
            <div class="card-body">




            </div>
            </div>
        </div>
    </div>



</div>

<script>



</script>



<?php

$mon = array("09:00:00"=>"","10:00:00"=>"","11:00:00"=>"","12:00:00"=>"","13:00:00"=>"","14:00:00"=>"","15:00:00"=>"","16:00:00"=>"","17:00:00"=>"");
$tue = array("09:00:00"=>"","10:00:00"=>"","11:00:00"=>"","12:00:00"=>"","13:00:00"=>"","14:00:00"=>"","15:00:00"=>"","16:00:00"=>"","17:00:00"=>"");
$wen = array("09:00:00"=>"","10:00:00"=>"","11:00:00"=>"","12:00:00"=>"","13:00:00"=>"","14:00:00"=>"","15:00:00"=>"","16:00:00"=>"","17:00:00"=>"");
$thu = array("09:00:00"=>"","10:00:00"=>"","11:00:00"=>"","12:00:00"=>"","13:00:00"=>"","14:00:00"=>"","15:00:00"=>"","16:00:00"=>"","17:00:00"=>"");
$fri = array("09:00:00"=>"","10:00:00"=>"","11:00:00"=>"","12:00:00"=>"","13:00:00"=>"","14:00:00"=>"","15:00:00"=>"","16:00:00"=>"","17:00:00"=>"");



generateSchedule($newconn->conn,$_SESSION["userid"]);
$newconn->disconnectServer();

?>