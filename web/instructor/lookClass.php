<?php

function updateQuota($cid,$sid,$courseName,$quota){
    echo '<div class="container">
            <h2 class="display-5">Change Quota of '.$courseName.' Section '.$sid.'</h4><br>
            <h4 class="display-5">Remaining Quota is '.$quota.' (Write -5 to decrease 5 quota or write 5 for increasing)</h4><br>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon1">UPDATE</button>
                </div>
                <input type="text" class="form-control" id="change">
            </div>
        </div>';
}


function initTable($cid,$sid){

    echo '<div class="container"><br>

            <a href="statistic.php?cid='.$cid.'&sid='.$sid.'" class="badge badge-warning">Go To Statistic of This Class</a>

        </div> ';

    echo '<div class="container">
            <table class="table table-bordered">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Student Number</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Grade</th>
                <th scope="col">Save Grade</th>

            </tr>
            </thead>
            <tbody>';
}

function addRow2StudentCourse($i,$stu){
    echo '<tr>
            <th scope="row">'.$i.'</th>
            <td>'.$stu['studentID'].'</td>
            <td>'.$stu['StudentName'].'</td>
            <td>'.$stu['StudentSurname'].'</td>
            <td scope="col"><input size="2" type="text" id="newgrade'.$stu["studentID"].'"/></td>
            <td scope="col"><button type="button" class="btn btn-success" courseid="'.$stu['courseID'].'" studentid ="'.$stu["studentID"].'" id="update">SAVE</button></td>
        </tr>';
}

function closeTable(){
    echo '</tbody></table>';
}

include_once "../includer.php";
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

        updateQuota($cid,$sid,$secinfo['CourseName'],$secinfo['quota']);


        initTable($cid,$sid);
        $whoTakeThisClassSql = "select * from studenttakencourseJoin where classID=".$cid." and sectionID=".$sid;
        // echo $whoTakeThisClassSql;
        $stmt = $newconn->conn->prepare($whoTakeThisClassSql);
        $stmt->execute();
        $students = $stmt->fetchall();
        $i=1;
        foreach($students as $stu){
            // print_r($stu);
            addRow2StudentCourse($i,$stu);
            $i++;
        }
        closeTable();
    }
    else{
        echo "This class doesn't belong you";

    }

}
?>


</div>


<script>



function updateQuota(functionName,amount){
    $.ajax({
      url:"api.php",
      type:"POST",
      data:{
              function:functionName,
              classid:<?php echo $cid?>,
              sectionid:<?php echo $sid?>,
              amount:amount
      },
      success:function(data){
        alert(data);
      },
      complete:function(){
          document.location.reload(true);
      }
    });
}

function gradeStudent(studentid,courseid,grade){
$.ajax({
    url:"api.php",
    type:"POST",
    data:{
            function:"gradeStudent",
            studentid:studentid,
            courseid:courseid,
            classid:<?php echo $cid?>,
            sectionid:<?php echo $sid?>,
            grade:grade
    },
    success:function(data){
        alert(data);
    },
    complete:function(){
        document.location.reload(true);
    }
});
}

$(document).on('click','.btn-outline-secondary',function(){
      var change = document.getElementById("change").value;
      updateQuota("updatequota",change);  
  });


$(document).on('click','.btn-success',function(){
    var stuid=$(this).attr("studentid");
    var cid=$(this).attr("courseid");
    var niwgrade=document.getElementById("newgrade"+stuid).value;
    console.log("gradeMe",cid,stuid);
    if (window.confirm('Are you sure you want grade this student?')) {
        gradeStudent(stuid,cid,niwgrade);
    }
});

</script>