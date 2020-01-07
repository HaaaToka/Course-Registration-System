<?php

include "../includer.php";

$newconn = new ConnectDB($sn,$un,$pss,$db);


?>



<div class="container" id="myattended">
  <h1 class="display-6">Attended Classes</h1>
  <table class="table table-hover">
    <thead>
        <tr>
        <th scope="col">Course Code</th>
        <th scope="col">Course Name</th>
        <th scope="col">Section Number</th>
        <th scope="col"></th> 
        <!-- buraya hoca ekle -->
        <th scope="col"></th>
        </tr>
    </thead>
    <tbody> 
      <?php $mycklasseslist=takenCoursesbyMe($newconn->conn,$_SESSION['userid']); ?>
    </tbody>
  </table>
</div>

<div class="container" id="pagination_data">
    
</div>


<script>  
 $(document).ready(function(){  

  load_data(1,10,"");
  function load_data(page,coursePerPage,searchCourse){
    $.ajax({
      url:"pagination.php",
      type:"POST",
      data: {page:page,
             myclasses:<?php echo json_encode($mycklasseslist)?>,
             year:<?php echo $_SESSION['year']?>,
             term:'<?php echo $_SESSION['term']?>',
             depid:<?php echo $_SESSION['departmentID']?>,
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
  // domAction , class, function
  $(document).on('click','.page-link',function(){
      var page=$(this).attr("id");
      var coursePerPage = document.getElementById("cpp").innerHTML;
      load_data(page,coursePerPage,"-1");
  });

  $(document).on('click','.dropdown-item',function(){
      var coursePerPage=$(this).attr("id");
      load_data(1,coursePerPage,"-1");
  });

  $(document).on('click','.btn-success',function(){
      console.log($(this).attr("classid"));
      console.log($(this).attr("sectionid"));
  });

  $(document).on('click','.btn-outline-secondary',function(){
      var searchcourse = document.getElementById("search").value;
      var coursePerPage = document.getElementById("cpp").innerHTML;
      load_data(1,coursePerPage,searchcourse);  
  });
  

 });  
 </script>  