<?php

include "../includer.php";

$newconn = new ConnectDB($sn,$un,$pss,$db);

?>

<div id="topOfCredit">
    <?php
        printCreditOnTopOfGrid($newconn,$_SESSION['userid']);
    ?>
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
                <?php takenCoursesbyMe($newconn->conn,$_SESSION['userid'],1); ?>
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




<script>
document.getElementById("attendedHeader").style.display = 'none';

function refresh_remaining_credit(){
    $.ajax({
        url:"api.php",
        type:"POST",
        data:{
            gimmeRemainingCredit:"hands up (give me your hearth)",
            studentid:<?php echo $_SESSION['userid']?>
        },
        success:function(data){
            document.getElementById("topOfCredit").innerHTML=data;
        }
    });
}

function reload_data_mytaken(stuid){
    $.ajax({
      url:"api.php",
      type:"POST",
      data:{
          reload:stuid
      },
      success:function(data){
        document.getElementById('myattended').innerHTML=data;
        document.getElementById("attendedHeader").style.display = 'none';
        //refresh_remaining_credit();
        document.location.reload(true);
      }
    });
  }

  function delete_update_join_Class(functionName,stuid,klassid,secid){
    $.ajax({
      url:"api.php",
      type:"POST",
      data:{
              function:functionName,
              studentid:stuid,
              classid:klassid,
              sectionid:secid
      },
      success:function(data){
        alert(data);
      },
      complete:function(){
        reload_data_mytaken('<?php echo $_SESSION['userid'];?>');
        load_data(1,document.getElementById("cpp").innerHTML,"-1");
      }
    });
  }

  $(document).on('click','.btn-danger',function(){
      var cid=$(this).attr("classid");
      var sid=$(this).attr("sectionid");
      var uid='<?php echo $_SESSION['userid']?>';
      console.log("delete",cid,sid,uid);
      if (window.confirm('Are you sure you want to drop this class?')) {
        delete_update_join_Class("delete",uid,cid,sid);
      }
  });
</script>




<?php

$newconn->disconnectServer();

?>
