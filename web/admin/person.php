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
            <button type="submit" class="btn btn-primary">NEXT</button>
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
            <button type="submit" class="btn btn-secondary">DONE</button>
        </div>
    </div>
</div>

<div class="container" id="graphics">
    <div class="row my-3">
        <div class="col">
            <?php echo '<h1 class="display-5" id="head">Information: </h1>'?>
        </div>
    </div>
    <div class="row py-2">
        <div class="col-md-5 py-1">
            <h2 class="display-5">Male - Famale Student</h2>
            <div class="card">
                <div class="card-body">
                    <canvas id="chDonut1"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-5 py-1">
            <h2 class="display-5">Instructor - Student</h2>
            <div class="card">
                <div class="card-body">
                    <canvas id="chDonut2"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];

    /* 3 donut charts */
    var donutOptions = {
    cutoutPercentage: 55, 
    legend: {position:'bottom', padding:5, labels: {pointStyle:'circle', usePointStyle:true}}
    };

    // donut 1
    var chDonutData1 = {
        labels: ['Male ', 'Famale'],
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
        labels: ['Student', 'Instructor'],
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
            <a class="nav-link active" href="#student" role="tab" data-toggle="tab"><i
                    class="fas fa-user-circle"></i> Students </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#instructor" role="tab" data-toggle="tab"><i
                    class="fas fa-info-circle"></i> Instructors </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#graded" role="tab" data-toggle="tab"><i
                    class="fas fa-info-circle"></i> Graduated Students </a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade show active" id="student">

        </div>
        <div role="tabpanel" class="tab-pane fade" id="instructor">

        </div>
        <div role="tabpanel" class="tab-pane fade" id="graded">

        </div>
    </div>

</div>


<script>

function updateInsTable(departmentid){
    $.ajax({
        url:"api.php",
        type:"POST",
        data:{
            function:"updateIns",
            departmentid:departmentid
        },
        success:function(data){
            document.getElementById('instructor').innerHTML=data;
        }
    });
}

function updateStuTable(departmentid){
    $.ajax({
        url:"api.php",
        type:"POST",
        data:{
            function:"updateStu",
            departmentid:departmentid
        },
        success:function(data){
            document.getElementById('student').innerHTML=data;
        }
    });
}

function updateOldStuTable(departmentid){
    $.ajax({
        url:"api.php",
        type:"POST",
        data:{
            function:"updateGraduatedStu",
            departmentid:departmentid
        },
        success:function(data){
            document.getElementById('graded').innerHTML=data;
        }
    });
}

function updateChart(facultyid,departmentid){
    $.ajax({
        url:"api.php",
        type:"POST",
        data:{
            function:"updatechart",
            facultyid:facultyid,
            departmentid:departmentid
        },
        success:function(data){
            var mfi=JSON.parse(data);
            console.log(JSON.parse(data));
            chDonutData1.datasets[0].data=[mfi['M'],mfi['F']]
            chDonutData2.datasets[0].data=[mfi['M']+mfi['F'],mfi['Ins']]
            cd1.update();
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

// domAction , class, function
$(document).on('click','.btn-primary',function(){
    var fid = document.getElementById('faculties').value;
    console.log(fid);
    filldepartments(fid);
});

$(document).on('click','.btn-secondary',function(){
    var fid = document.getElementById('faculties').value;
    var did = document.getElementById('departments').value;
    var selectedIndex = document.getElementById('departments').selectedIndex;
    console.log(fid,did,selectedIndex);
    document.getElementById('head').innerHTML="Information: "+document.getElementById('faculties').options[fid].innerHTML+" "+document.getElementById('departments').options[selectedIndex].innerHTML;
    updateChart(fid,did);
    updateStuTable(did);
    updateInsTable(did);
    updateOldStuTable(did);
});


</script>