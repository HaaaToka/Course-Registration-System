<?php

function addRow2GivenOldCourseTable($klass){
    echo '<tr>
            <td>'.$klass['CourseCode'].'</td>        
            <td>'.$klass['CourseName'].'</td>
            <td>'.$klass['year'].'</td>
            <td>'.$klass['term'].'</td>
            <td align="center"><a href="lookOldClass.php?cid='.$klass['classID'].'&sid='.$klass['sectionID'].'" class="badge badge-info">!</a></td>
    </tr>';
}

function givenOldCoursesbyMe($conn,$insid,$year,$semester){

    echo '<table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Course Code</th>
                    <th scope="col">Course Name</th>
                    <th scope="col">Year</th>
                    <th scope="col">Term</th>
                    <th scope="col">View</th>
                </tr>
            </thead>
            <tbody>';

    $sqlMyCourse="call OneInstructorOldClasses(".$insid.",".($year+1).")";
    $stmt=$conn->prepare($sqlMyCourse);
    $stmt->execute();
    foreach($stmt as $row){
        //print_r($row);
        addRow2GivenOldCourseTable($row);
    }

    echo '</tbody>
    </table>';
}

include "../includer.php";

$newconn = new ConnectDB($sn,$un,$pss,$db);

?>


<div class="container">
    <h1 class="display-1"> MY ALL CLASSES</h1>
    <?php givenOldCoursesbyMe($newconn->conn,$_SESSION['userid'],$_SESSION['year'],$_SESSION['term']); ?>
</div>

<?php

$newconn->disconnectServer();

?>
