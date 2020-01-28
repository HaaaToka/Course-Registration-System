<?php

function fillfacultycombobox($conn){
    $stmt=$conn->prepare("select * from Faculty");
    $stmt->execute();
    $facs=$stmt->fetchall();
    foreach($facs as $f){
        echo '<option value='.$f["facultyID"].'>'.$f["name"].'</option>';
    }
}

include_once "../includer.php";

$newconn = new ConnectDB($sn,$un,$pss,$db);


?>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>


<div class="container">
    <div class="form-row align-items-center">
        <label class="mr-sm-2" for="faculties">FACULTY</label>
        <div class="col-auto my-1">
            <select class="custom-select mr-sm-2" id="faculties">
                <option value="0" selected>Choose...</option>
                <?php  fillfacultycombobox($newconn->conn);?>
            </select>
        </div>
        <div class="col-auto my-1">
            <button type="submit" class="btn btn-primary btn-faculty">NEXT</button>
        </div>
    </div>
</div>

<div class="container">
    <div class="form-row align-items-center">
        <label class="mr-sm-2" for="departments">DEPARTMENT</label>
        <div class="col-auto my-1">
            <select class="custom-select mr-sm-2" id="departments">
            </select>
        </div>
        <div class="col-auto my-1">
            <button type="submit" class="btn btn-primary btn-department">NEXT</button>
        </div>
    </div>
</div>

<div class="container">
    <div class="form-row align-items-center">
        <label class="mr-sm-2" for="departments">Course</label>
        <div class="col-auto my-1">
            <select class="custom-select mr-sm-2" id="courses">
            </select>
        </div>
        <div class="col-auto my-1">
            <button type="submit" class="btn btn-primary btn-course">NEXT</button>
        </div>
    </div>
</div>

<div class="container">
    <div class="form-row align-items-center">
        <label class="mr-sm-2" for="departments">Term</label>
        <div class="col-auto my-1">
            <select class="custom-select mr-sm-2" id="classes">
            </select>
        </div>
        <div class="col-auto my-1">
            <button type="submit" class="btn btn-secondary btn-class">DONE</button>
        </div>
    </div>
</div>

<div class="container" id="graphics">
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
                <i class="fas fa-user-circle"></i> Students Have Graded for Selected Term </a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade show active" id="student">

        </div>
    </div>

</div>


<script>

    function updateStuGradedClass(classid){
        $.ajax({
            url:"api.php",
            type:"POST",
            data:{
                function:"updateStuGradedClass",
                classid:classid
            },
            success:function(data){
                document.getElementById('student').innerHTML=data;
            }
        });
    }

    function updateCourseChart(courseid){
        $.ajax({
            url:"api.php",
            type:"POST",
            data:{
                function:"updatecoursechart",
                courseid:courseid
            },
            success:function(data){
                var pf=JSON.parse(data);
                console.log(JSON.parse(data));
                chDonutData1.datasets[0].data=[pf['F'],pf['P']]
                cd1.update();
            }
        });
    }

    function updateClassChart(classid){
        $.ajax({
            url:"api.php",
            type:"POST",
            data:{
                function:"updateclasschart",
                classid:classid
            },
            success:function(data){
                var pf=JSON.parse(data);
                console.log(JSON.parse(data));
                chDonutData2.datasets[0].data=[pf['F'],pf['P']]
                cd2.update();
            }
        });
    }

    function filldepartments(facultyid){

        $.ajax({
            url:"api.php",
            type:"POST",
            data:{
                function:"filldepartments",
                facultyid:facultyid
            },
            success:function(data){
                document.getElementById('departments').innerHTML=data;
            }
        });

    }

    function fillcourses(depid){

        $.ajax({
            url:"api.php",
            type:"POST",
            data:{
                function:"fillcourses",
                departmentid:depid
            },
            success:function(data){
                document.getElementById('courses').innerHTML=data;
            }
        });

    }

    function fillclasses(cid){

        $.ajax({
            url:"api.php",
            type:"POST",
            data:{
                function:"fillclasses",
                courseid:cid
            },
            success:function(data){
                document.getElementById('classes').innerHTML=data;
            }
        });

    }

    // domAction , class, function
    $(document).on('click','.btn-faculty',function(){
        var fid = document.getElementById('faculties').value;
        console.log(fid);
        filldepartments(fid);
    });

    $(document).on('click','.btn-department',function(){
        var did = document.getElementById('departments').value;
        console.log(did);
        fillcourses(did);
    });

    $(document).on('click','.btn-course',function(){
        var cid = document.getElementById('courses').value;
        console.log(cid);
        fillclasses(cid);
        updateCourseChart(cid);
    });

    $(document).on('click','.btn-class',function(){
        var classid = document.getElementById('classes').value;
        console.log(classid);
        updateStuGradedClass(classid);
        updateClassChart(classid);
    });


</script>