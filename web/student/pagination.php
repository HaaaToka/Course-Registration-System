<?php  
//page=10&yyyy=2019&depid=41&tterm=Fall

include_once "../database.php";
include_once "../config.php";
include_once "../function.php";

$newconn = new ConnectDB($sn,$un,$pss,$db);

$record_per_page = '';  
$page = '';  
$output = '';  
if(isset($_POST["page"]))
    $page = $_POST["page"];
else
    $page = 1;


if(isset($_POST["cpp"]))
    $record_per_page=$_POST["cpp"];
else
    $record_per_page=10;

$start_from = ($page - 1)*$record_per_page;  
$sqldepcour="SELECT * FROM joincourseclasssection where year=".$_POST['year']." and term='".$_POST['term']."' and departmentID=".$_POST['depid']." order by courseID DESC limit ".$start_from.",".$record_per_page;

$stmt = $newconn->conn->prepare($sqldepcour);

if(!$stmt){
    die("Error: ". print_r($stmt->errorInfo()));
}
else{
    $output .= '  
        <h1 class="display-4">Join Class</h1>
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Course Code</th>
                    <th scope="col">Course Name</th>
                    <th scope="col">Section Number</th>
                    </tr>
                </thead>
                <tbody> 
    ';
    $i=1;
    $stmt->execute();
    foreach($stmt as $row){
        $output.='
            <tr>
                <th scope="row">'.$i++.'</th>
                <td>'.$row["CourseCode"].'</td>
                <td>'.$row["CourseName"].'</td>
                <td>'.$row["sectionID"].'</td>
            </tr>
        ';
    }
    
    $output .= ' </tbody></table><br /><nav aria-label="Page navigation example"><ul class="pagination pagination-lg justify-content-center">';  

    $page_query = "SELECT count(*) as coc FROM joincourseclasssection where year=".$_POST['year']." and term='".$_POST['term']."' and departmentID=".$_POST['depid']; 

    $stmt = $newconn->conn->prepare($page_query);
    $stmt->execute();
    $resultofpagecount=$stmt->fetch();
    $total_records = $resultofpagecount["coc"]; 

    $total_pages = ceil($total_records/$record_per_page);  
    for($i=1; $i<=$total_pages; $i++)  
    {  
        if($page==i){
            $output.='<li class="page-item disabled">
                        <a class="page-link" id='.$page.' tabindex="-1">'.$page.'</a>
                      </li>';
        }
        else{
            $output.='<li class="page-item">
                        <a class="page-link" id='.$i.'>'.$i.'</a>
                      </li>';
        } 
    }  
    $output .= '  	&nbsp;
                    <div class="dropdown show">
                        <a class="btn btn-lg btn-info dropdown-toggle" id="cpp" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$record_per_page.'</a>
                        <div class="dropdown-menu" aria-labelledby="cpp">
                            <a class="dropdown-item" id="10">10</a>
                            <a class="dropdown-item" id="20">20</a>
                            <a class="dropdown-item" id="50">50</a>
                            <a class="dropdown-item" id="100">100</a>
                        </div>
                    </div>
                </ul></nav>
    ';  

    echo $output;  

}
?>  