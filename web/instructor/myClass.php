<?php

function addRow2GivenCourseTable($klass){
    echo '<tr>
            <td>'.$klass['CourseCode'].'</td>        
            <td>'.$klass['CourseName'].'</td>
            <td>'.$klass['sectionID'].'</td>
            <td align="center"><a href="lookClass.php?cid='.$klass['classID'].'&sid='.$klass['sectionID'].'" class="badge badge-info">!</a></td>
    </tr>';
}

function givenCoursesbyMe($conn,$insid,$year,$semester){

    echo '<table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Course Code</th>
                    <th scope="col">Course Name</th>
                    <th scope="col">Section Number</th>
                    <th scope="col">View</th>
                </tr>
            </thead>
            <tbody>';

    $sqlMyCourse="call OneInstructorAllClassesInSemester(".$insid.",".$year.",'".$semester."')";
    $stmt=$conn->prepare($sqlMyCourse);
    $stmt->execute();
    foreach($stmt as $row){
        //print_r($row);
        addRow2GivenCourseTable($row);
    }

    echo '</tbody>
    </table>';
}

include "../includer.php";

$newconn = new ConnectDB($sn,$un,$pss,$db);


$yyyy = "";

if($_SESSION['term']=="Fall")
    $yyyy=$_SESSION['year']."-".($_SESSION['year']+1);
else
    $yyyy=($_SESSION['year']-1)."-".$_SESSION['year'];

?>

<div class="container" id="topOfCredit">
    <h1 class="display-4"><?php echo $yyyy." ".$_SESSION['term']." Semester"?></h1>
</div>


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

            <div class="container" id="myattended">
                <?php givenCoursesbyMe($newconn->conn,$_SESSION['userid'],$_SESSION['year'],$_SESSION['term']); ?>
            </div>

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
                <div class="card-body" id="cardbody">

                    <?php generateSchedule($newconn->conn,$_SESSION['role'],$_SESSION["userid"],$_SESSION['year'],$_SESSION['term']); ?>

                </div>
            </div>
        </div>
    </div>



</div>


<?php

$newconn->disconnectServer();

?>
