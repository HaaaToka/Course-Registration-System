<?php


function addRow2OldClassStatus($i,$stu){
    $color="";
    if($stu['grade'][0]=="F")
        $color='class="table-danger"';
    else
        $color='class="table-success"';
    echo '<tr '.$color.'>
            <th scope="row">'.$i.'</th>
            <td>'.$stu['studentID'].'</td>
            <td>'.$stu['StudentName'].'</td>
            <td>'.$stu['StudentSurname'].'</td>
            <td>'.$stu['grade'].'</td>
        </tr>';
}


include "../includer.php";

$newconn = new ConnectDB($sn,$un,$pss,$db);


if(isset($_GET["cid"]) && isset($_GET["sid"]) ){
    $cid = $_GET['cid'];
    $sid = $_GET['sid'];
    $checkClassMine = "select count(*) as count from InstructorGivesCourse where classID=".$cid." and instructorID=".$_SESSION['userid'];
    $stmt = $newconn->conn->prepare($checkClassMine);
    $stmt->execute();
    $count = $stmt->fetch();
    if($count['count']==1){

        $stmt = $newconn->conn->prepare("select * from joincourseclasssection where classID=".$cid." and sectionID=".$sid);
        $stmt->execute();
        $secinfo=$stmt->fetch();

        $stmt = $newconn->conn->prepare("select * from studenthasgradedJoin where classID=".$cid);
        $stmt->execute();
        $classGraded=$stmt->fetchall();
        // print_r($classGraded);
        $passed=0;
        $failed=0;
    
        foreach($classGraded as $pf){
            if($pf['grade'][0]=='F'){
                $failed++;
            }
            else{
                $passed++;
            }
        }
    }
    else{
        echo "This class doesn't belong you";

    }

}

?>



<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

<div class="container">
    <div class="row my-3">
        <div class="col">
            <?php echo '<h1 class="display-5"> CLASS STATUS of '.$secinfo['CourseName'].' '.$secinfo['year'].' '.$secinfo['term'].'</h1>';?>
        </div>
    </div>
    <div class="row py-2">
        <div class="col-md-5 py-1">
            <h2 class="display-5">Graded Stats</h2>
            <div class="card">
                <div class="card-body">
                    <canvas id="chDonut1"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var colors = ['#FF0000','#00ff00','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];

    /* 3 donut charts */
    var donutOptions = {
    cutoutPercentage: 55, 
    legend: {position:'bottom', padding:5, labels: {pointStyle:'circle', usePointStyle:true}}
    };

    // donut 1
    var chDonutData1 = {
        labels: ['Failed', 'Passed'],
        datasets: [
        {
            backgroundColor: colors.slice(0,2),
            borderWidth: 0,
            data: [<?php echo $failed.",".$passed?>]
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

</script>


<div class="container">
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Student Number</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Grade</th>
        </tr>
        </thead>
        <tbody>
            <?php 
                $i=1;
                foreach($classGraded as $student){
                    addRow2OldClassStatus($i,$student);
                    $i++;
                }
            ?>
        </tbody>
    </table>
</div>