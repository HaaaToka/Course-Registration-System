<?php

include "../includer.php";

$newconn = new ConnectDB($sn,$un,$pss,$db);


?>



<div class="container" id="myattended">
      <?php takenCoursesbyMe($newconn->conn,$_SESSION['userid'],1); ?>
</div>

<div class="container" id="pagination_data">
    
</div>


<script>  
 $(document).ready(function(){  

  load_data(1,10,"-1");
  function load_data(page,coursePerPage,searchCourse,filter){
    $.ajax({
      url:"pagination.php",
      type:"POST",
      data: {page:page,
             studentid:<?php echo $_SESSION['userid']?>,
             year:<?php echo $_SESSION['year']?>,
             term:'<?php echo $_SESSION['term']?>',
             depid:<?php echo $_SESSION['departmentID']?>,
             filteryear:filter,
             cpp:coursePerPage,
             sc:searchCourse},
      success:function(data){
        document.getElementById('pagination_data').innerHTML=data;
      },
      error: function (request, status, error) {
        document.getElementById('pagination_data').innerHTML=request.responseText;
      },
      complete:function(){
        if(searchCourse!="-1")
          document.getElementById("search").value=searchCourse;
        else
          document.getElementById("search").value="";
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
        var filter=document.getElementById('filteryear').innerHTML;
        reload_data_mytaken('<?php echo $_SESSION['userid'];?>');
        load_data(1,document.getElementById("cpp").innerHTML,"-1",filter);
        // document.location.reload(true);
      }
    });
  }

  // domAction , class, function
  $(document).on('click','.page-link',function(){
      var page=$(this).attr("id");
      var coursePerPage = document.getElementById("cpp").innerHTML;
      var searchcourse = document.getElementById("search").value;
      var filter=document.getElementById('filteryear').innerHTML;
      load_data(page,coursePerPage,searchcourse,filter);
  });

  $(document).on('click','.dropdown-item',function(){
      var searchcourse = document.getElementById("search").value;
      var coursePerPage=$(this).attr("id");
      var filter=document.getElementById('filteryear').innerHTML;
      load_data(1,coursePerPage,searchcourse,filter);
  });

  $(document).on('click','.btn-outline-secondary',function(){
      var searchcourse = document.getElementById("search").value;
      var coursePerPage = document.getElementById("cpp").innerHTML;
      var filter=document.getElementById('filteryear').innerHTML;
      load_data(1,coursePerPage,searchcourse,filter);  
  });

  $(document).on('click','.btn-success',function(){
      var cid=$(this).attr("classid");
      var sid=$(this).attr("sectionid");
      var uid='<?php echo $_SESSION['userid']?>';
      console.log("attend ",cid,sid,uid);
      if(window.confirm('Are you sure you want to join this class?')){
        delete_update_join_Class("join",uid,cid,sid);
      }
  });

  $(document).on('click','.btn-danger',function(){
      var cid=$(this).attr("classid");
      var sid=$(this).attr("sectionid");
      var uid='<?php echo $_SESSION['userid']?>';
      console.log("delete",cid,sid,uid);
      if (window.confirm('Are you sure you want to drop this class?')) {
        delete_update_join_Class("delete",uid,cid,sid);
      }
  });

  $(document).on('click','.btn-warning',function(){
      var cid=$(this).attr("classid");
      var sid=$(this).attr("sectionid");
      var uid='<?php echo $_SESSION['userid']?>';
      console.log("update",cid,sid,uid);
      if (window.confirm('Are you sure you want to update section of this class?')) {
        delete_update_join_Class("update",uid,cid,sid);
      }
  });
  
  $(document).on('click','.btn-outline-primary',function(){
    var searchcourse = document.getElementById("search").value;
    var coursePerPage = document.getElementById("cpp").innerHTML;
    var filter=$(this).attr("year");
    load_data(1,coursePerPage,searchcourse,filter);
  });


 });  
 </script>  