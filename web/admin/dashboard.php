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
    <div class="row my-3">
        <div class="col">
            <h4>Take-Drop Count of Faculties</h4>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <canvas id="chBarFaculty" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

    // chart colors
    var colors = ['#007bff','#28a745','#444444','#c3e6cb','#dc3545','#6c757d'];

    var chBar = document.getElementById("chBarFaculty");
    var chartDataFac = {
        labels: ["S", "M", "T", "W", "T", "F", "S"],
        datasets: [{//Take
                data: [589, 445, 483, 503, 689, 692, 634],
                backgroundColor: colors[0]
            },
            {// Drop
                data: [209, 245, 383, 403, 589, 692, 580],
                backgroundColor: colors[4]
            },
        ]
    };
    if (chBar) {
        var facchart = new Chart(chBar, {
            type: 'bar',
            data: chartDataFac,
            options: {
                scales: {
                    xAxes: [{
                        barPercentage: 0.4,
                        categoryPercentage: 0.5
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: false
                        }
                    }]
                },
                legend: {
                    display: false
                }
            }
        });
    }
</script>



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
    <div class="row my-3">
        <div class="col">
            <h4>Take-Drop Count of Departments</h4>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <canvas id="chBarDepartment" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>



<script>

    // chart colors
    var colors = ['#007bff','#28a745','#444444','#c3e6cb','#dc3545','#6c757d'];

    var chBar = document.getElementById("chBarDepartment");
    var chartDataDep = {
        labels: ["O", "K", "A", "N", "A", "L", "A","N"],
        datasets: [{
                data: [589, 445, 483, 503, 689, 692, 634,0],
                backgroundColor: colors[0]
            },
            {
                data: [209, 245, 383, 403, 589, 692, 580,0],
                backgroundColor: colors[4]
            }
        ]
    };
    if (chBar) {
        var depchart = new Chart(chBar, {
            type: 'bar',
            data: chartDataDep,
            options: {
                scales: {
                    xAxes: [{
                        barPercentage: 0.4,
                        categoryPercentage: 0.5
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: false
                        }
                    }]
                },
                legend: {
                    display: false
                }
            }
        });
    }
</script>


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
    <div class="row my-3">
        <div class="col">
            <h4>Take-Drop Count of Courses</h4>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <canvas id="chBarCourse" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>



<script>

    // chart colors
    var colors = ['#007bff','#28a745','#444444','#c3e6cb','#dc3545','#6c757d'];

    var chBar = document.getElementById("chBarCourse");
    var chartDataCou = {
        labels: ["O", "K", "A", "N", "A", "L", "A","N"],
        datasets: [{
                data: [589, 445, 483, 503, 689, 692, 634,0],
                backgroundColor: colors[0]
            },
            {
                data: [209, 245, 383, 403, 589, 692, 580,0],
                backgroundColor: colors[4]
            }
        ]
    };
    if (chBar) {
        var couchart = new Chart(chBar, {
            type: 'bar',
            data: chartDataCou,
            options: {
                scales: {
                    xAxes: [{
                        barPercentage: 0.4,
                        categoryPercentage: 0.5
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: false
                        }
                    }]
                },
                legend: {
                    display: false
                }
            }
        });
    }
</script>




<script>
    updateFacultyBarChart();
    function updateFacultyBarChart(){
        $.ajax({
            url:"api.php",
            type:"POST",
            data:{
                function:"updateFacultyBarChart",
            },
            success:function(data){
                var facInf=JSON.parse(data);
                console.log(JSON.parse(data));
                chartDataFac.labels=[];
                chartDataFac.datasets[0].data=[]
                chartDataFac.datasets[1].data=[]
                for(var i=0;i<facInf.length;i++){
                    chartDataFac.labels.push(facInf[i]['name']);
                    chartDataFac.datasets[0].data.push(facInf[i]['T']);
                    chartDataFac.datasets[1].data.push(facInf[i]['D']);
                }
                facchart.update();
            }
        });
    }
    
    function updateDepartmentBarChart(facid){
        $.ajax({
            url:"api.php",
            type:"POST",
            data:{
                function:"updateDepartmentBarChart",
                facultyid:facid
            },
            success:function(data){
                var depInf=JSON.parse(data);
                console.log(JSON.parse(data));
                chartDataDep.labels=[];
                chartDataDep.datasets[0].data=[]
                chartDataDep.datasets[1].data=[]
                for(var i=0;i<depInf.length;i++){
                    chartDataDep.labels.push(depInf[i]['name']);
                    chartDataDep.datasets[0].data.push(depInf[i]['T']);
                    chartDataDep.datasets[1].data.push(depInf[i]['D']);
                }
                depchart.update();
            }
        });
    }

    function updateCourseBarChart(depid){
        $.ajax({
            url:"api.php",
            type:"POST",
            data:{
                function:"updateCourseBarChart",
                departmentid:depid
            },
            success:function(data){
                var couInf=JSON.parse(data);
                console.log(JSON.parse(data));
                chartDataCou.labels=[];
                chartDataCou.datasets[0].data=[]
                chartDataCou.datasets[1].data=[]
                for(var i=0;i<couInf.length;i++){
                    chartDataCou.labels.push(couInf[i]['name']);
                    chartDataCou.datasets[0].data.push(couInf[i]['T']);
                    chartDataCou.datasets[1].data.push(couInf[i]['D']);
                }
                couchart.update();
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

    // domAction , class, function
    $(document).on('click','.btn-faculty',function(){
        var fid = document.getElementById('faculties').value;
        console.log(fid);
        filldepartments(fid);
        updateDepartmentBarChart(fid);
    });

    $(document).on('click','.btn-department',function(){
        var did = document.getElementById('departments').value;
        console.log(did);
        updateCourseBarChart(did);
    });

</script>