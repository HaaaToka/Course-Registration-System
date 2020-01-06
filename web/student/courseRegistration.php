<?php

include "../includer.php";

$newconn = new ConnectDB($sn,$un,$pss,$db);


?>


<div class="container" id="pagination_data">
    
</div>


<script>  
 $(document).ready(function(){  

  load_data();
  function load_data(page,coursePerPage){
    $.ajax({
      url:"pagination.php",
      type:"POST",
      data: {page:page,
             year:<?php echo $_SESSION['year']?>,
             term:'<?php echo $_SESSION['term']?>',
             depid:<?php echo $_SESSION['departmentID']?>,
             cpp:coursePerPage},
      success:function(data){
        document.getElementById('pagination_data').innerHTML=data;
        console.log(data);
      }
    });
  }

  $(document).on('click','.page-link',function(){
      var page=$(this).attr("id");
      var coursePerPage = document.getElementById("cpp").innerHTML;
      load_data(page,coursePerPage);
  });

  $(document).on('click','.dropdown-item',function(){
      var coursePerPage=$(this).attr("id");
      load_data(1,coursePerPage);
  });

 });  
 </script>  