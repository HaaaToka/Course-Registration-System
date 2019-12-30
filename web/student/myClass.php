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
                    <th scope="col">Course Name</th>
                    <th scope="col">Course Credit</th>
                    </tr>
                </thead>
                <tbody>



            <?php

                $sql = "call 471DB.OneStudentTookAllCourse(:userid)";
                $stmt = $newconn->conn->prepare($sql);
                $stmt->execute(array('userid'=>$_SESSION['userid']));
                //print_r($stmt);
                $count=1;
                foreach($stmt as $row){
                    addRowToMyClassTable($row,$count++);
                }
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

                haftalik takvim

            </div>
            </div>
        </div>
    </div>



</div>



<?php

$newconn->disconnectServer();

?>