<?php

include_once "../includer.php";

$newconn = new ConnectDB($sn,$un,$pss,$db);

if(isset($_GET['classid']) && isset($_GET['courseid'])){
    $courseid=$_GET['courseid'];
    $classid=$_GET['classid'];

    $stmt = $newconn->conn->prepare("SELECT * FROM joincourseclasssection where sectionID=1 and courseID=".$courseid." and classID=".$classid);
    $stmt->execute();
    $ccs = $stmt->fetchall()[0];
    // print_r($ccs);
}

?>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>


<div class="container" id="graphics">
    <?php echo '<h1 class="display-5">'.yearHelper($ccs['term'],$ccs['year'])." : ".$ccs['term']."-".$ccs['CourseName'].'</h1>'; ?>
    <div class="row py-2">
        <div class="col-md-5 py-1">
            <h2 class="display-5">Course Failed Passed</h2>
            <div class="card">
                <div class="card-body">
                    <canvas id="chDonut1"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-5 py-1">
            <h2 class="display-5">Class Failed Passed</h2>
            <div class="card">
                <div class="card-body">
                    <canvas id="chDonut2"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var colors = ['#ff0000','#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];

    /* 3 donut charts */
    var donutOptions = {
    cutoutPercentage: 55, 
    legend: {position:'bottom', padding:5, labels: {pointStyle:'circle', usePointStyle:true}}
    };

    // donut 1
    var chDonutData1 = {
        labels: ['Failed ', 'Passed'],
        datasets: [
        {
            backgroundColor: colors.slice(0,2),
            borderWidth: 0,
            data: [30,45]
        }
        ]
    };

    var chDonut1 = document.getElementById("chDonut1");
    if (chDonut1) {
    var cd1=new Chart(chDonut1, {
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
            data: [10,100]
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


<div class="container" id="stuins">

    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" href="#student" role="tab" data-toggle="tab">
                <i class="fas fa-user-circle"></i> Students Have Graded for Selected Class </a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade show active" id="student">

        </div>
    </div>

</div>


<script>

function updateStuGradedClass(){
    $.ajax({
        url:"api.php",
        type:"POST",
        data:{
            function:"updateStuGradedClass",
            classid:<?php echo $classid?>
        },
        success:function(data){
            document.getElementById('student').innerHTML=data;
        }
    });
}

function updateCourseChart(){
    $.ajax({
        url:"api.php",
        type:"POST",
        data:{
            function:"updatecoursechart",
            courseid:<?php echo $courseid?>
        },
        success:function(data){
            var pf=JSON.parse(data);
            console.log(JSON.parse(data));
            chDonutData1.datasets[0].data=[pf['F'],pf['P']]
            cd1.update();
        }
    });
}

function updateClassChart(){
    $.ajax({
        url:"api.php",
        type:"POST",
        data:{
            function:"updateclasschart",
            classid:<?php echo $classid?>
        },
        success:function(data){
            var pf=JSON.parse(data);
            console.log(JSON.parse(data));
            chDonutData2.datasets[0].data=[pf['F'],pf['P']]
            cd2.update();
        }
    });
}

updateStuGradedClass();
updateCourseChart();
updateClassChart();
</script>