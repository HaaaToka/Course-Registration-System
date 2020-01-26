<?php 

include "../includer.php";

$newconn = new ConnectDB($sn,$un,$pss,$db);

if(isset($_GET['cid']) && isset($_GET['sid'])){
    $cid = $_GET['cid'];
    $sid = $_GET['sid'];


    $sectionInfoSQL="select * from joincourseclasssection where classID=".$cid." and sectionID=".$sid;
    $stmt=$newconn->conn->prepare($sectionInfoSQL);
    $stmt->execute();
    $secinfo=$stmt->fetch();
    // print_r($secinfo);

    $whoTakeThisClassSql = "select count(*) as count from studenttakencourseJoin where classID=".$cid." and sectionID=".$sid;
    $stmt = $newconn->conn->prepare($whoTakeThisClassSql);
    $stmt->execute();
    $studentsCount = $stmt->fetch();
    // print_r($studentsCount);

    $pfSQL="call takeClassAgain(".$cid.",".$sid.")";
    $stmt=$newconn->conn->prepare($pfSQL);
    $stmt->execute();
    $passed_failed=$stmt->fetchall();
    //print_r($passed_failed);
    $passed=0;
    $failed=0;

    foreach($passed_failed as $pf){
        if($pf['grade'][0]=='F'){
            $failed++;
        }
        else{
            $passed++;
        }
    }
    $takeAgain=$passed+$failed;
    $firstTaken=$studentsCount['count']-$takeAgain;


}


?>


<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

<div class="container">
    <div class="row my-3">
        <div class="col">
            <?php echo '<h1 class="display-5">Statistics of '.$secinfo['year'].'-'.$secinfo['term'].' '.$secinfo['CourseName'].'</h1>'?>
        </div>
    </div>
    <div class="row py-2">
        <div class="col-md-5 py-1">
            <h2 class="display-5">Take Again - First Taken</h2>
            <div class="card">
                <div class="card-body">
                    <canvas id="chDonut1"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-5 py-1">
            <h2 class="display-5">Failed and Passed Before</h2>
            <div class="card">
                <div class="card-body">
                    <canvas id="chDonut2"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var colors = ['#FF0000','#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];

    /* 3 donut charts */
    var donutOptions = {
    cutoutPercentage: 55, 
    legend: {position:'bottom', padding:5, labels: {pointStyle:'circle', usePointStyle:true}}
    };

    // donut 1
    var chDonutData1 = {
        labels: ['Take Again', 'First Taken'],
        datasets: [
        {
            backgroundColor: colors.slice(0,2),
            borderWidth: 0,
            data: [<?php echo $takeAgain.",".$firstTaken?>]
        }
        ]
    };

    var chDonut1 = document.getElementById("chDonut1");
    if (chDonut1) {
    new Chart(chDonut1, {
        type: 'pie',
        data: chDonutData1,
        options: donutOptions
    });
    }

    // donut 2
    var chDonutData2 = {
        labels: ['Failed', 'Passed'],
        datasets: [
        {
            backgroundColor: colors.slice(0,2),
            borderWidth: 0,
            data: [<?php echo $failed.",".$passed?>]
        }
        ]
    };
    var chDonut2 = document.getElementById("chDonut2");
    if (chDonut2) {
    var cd2=new Chart(chDonut2, {
        type: 'pie',
        data: chDonutData2,
        options: donutOptions
    });
    }

</script>

<br>
<div class="container">
    <h1 class="display-6">Take This Course Again</h1>
    <table class="table table-hover">
        <thead>
            <tr>
            <th scope="col">Student Number</th>
            <th scope="col">Student Name</th>
            <th scope="col">Student Surname</th>
            <th scope="col">Grade</th>
            </tr>
        </thead>
        <tbody>

    <?php
    
        foreach($passed_failed as $pf){
            $color = "r";
            if($pf['grade'][0]=="F")
                $color='class="table-danger"';
            else
                $color='class="table-info"';
            echo '<tr '.$color.'>
                    <td>'.$pf['studentID'].'</td>
                    <td>'.$pf['StudentName'].'</td>
                    <td>'.$pf['StudentSurname'].'</td>
                    <td>'.$pf['grade'].'</td>
                  </tr>';
            
        }

    ?>

        </tbody>
    </table>

</div>