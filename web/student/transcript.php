<?php

function letterGradeChanger($letterNote){
    if($letterNote=="A1")
        return 4.00;
    else if($letterNote=="A2")
        return 3.75;
    else if($letterNote=="A3")
        return 3.50;
    else if($letterNote=="B1")
        return 3.25;
    else if($letterNote=="B2")
        return 3.00;
    else if($letterNote=="B3")
        return 2.75;
    else if($letterNote=="C1")
        return 2.50;
    else if($letterNote=="C2")
        return 2.25;
    else if($letterNote=="C3")
        return 2.00;
    else if($letterNote=="D")
        return 1.75;
    else
        return 0.00;
}

function semesterGPA($sg,$g,$sc,$c,$term,$year){

    // spring 2017 -> 2016-2017 yilinin springi
    // fall 2017 -> 2017-2018 yiklinin falli
    if($term!=""){
        echo '<tr><td colspan="2"><font color="red">Semester GPA: </font>'.number_format($sg/$sc, 2, '.', ',').'</td>';
        echo '<td colspan=3><font color="red">General GPA:</font> '.number_format($g/$c, 2, '.', ',').'</td></tr><br>';
        echo "</tbody></table>";

        //sonraki tablonun basligi ileri dusun
        if($term == "Fall"){
            echo $year."-".($year+1)." Spring Semester";
        }
        else{
            echo ($year)."-".($year+1)." Fall Semester";
        }
        
    }

    echo '<table class="table table-bordered">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Code</th>
                <th scope="col">Course Name</th>
                <th scope="col">Credit</th>
                <th scope="col">Grade</th>
            </tr>
            </thead>
        <tbody>';
}

function semesterChanger($currentKlassTerm,$term,$currentKlassYear,$year){
    if( ($currentKlassTerm!=$term) || ($currentKlassYear!=$year) ){
        return 1;
    }
    return 0;
}


function printKlass($klass,$number){
    echo '<tr>
            <th scope="row">'.$number.'</th>
            <td>'.$klass['code'].'</td>
            <td>'.$klass['courseName'].'<br>
            <td>'.$klass['credit'].'</td>
            <td>'.$klass['grade'].'</td>
          </tr>';
}

function generateTranscript($allKlass){
    $prevTerm="";
    $prevYear=0;
    $totalCredits=0;
    $totalGrade=0;
    $semesterCredits=0;
    $semesterGrade=0;
    $semesterKlassCount=0;

    foreach($allKlass as $klass){

        if( semesterChanger($klass["term"],$prevTerm,$klass["year"],$prevYear) == 1 ){

            $totalGrade+=$semesterGrade;
            $totalCredits+=$semesterCredits;
            semesterGPA($semesterGrade,$totalGrade,$semesterCredits,$totalCredits,$prevTerm,$prevYear);

            $semesterGrade=0;
            $semesterCredits=0;
            $semesterKlassCount=0;
            $prevTerm=$klass["term"];
            $prevYear=$klass["year"];
        }

        $semesterGrade+=(letterGradeChanger($klass["grade"])*$klass["credit"]);
        $semesterCredits+=$klass["credit"];
        $semesterKlassCount+=1;
        printKlass($klass,$semesterKlassCount);

    }
    
}

include "../includer.php";
$newconn = new ConnectDB($sn,$un,$pss,$db);

$stmt = $newconn->conn->prepare("call getMyTranscript(".$_SESSION["userid"].")");
$stmt->execute();
$gradeKlass = $stmt->fetchall();

//print_r($gradeKlass);

?>

<div class="container">
    <h1 class="display-3" align="center">Hello How Are You, <?php  echo $_SESSION['name']." ".$_SESSION['surname'];?></h1>
    buraya basalangıc yılını yaz
    <?php generateTranscript($gradeKlass); ?>

</div>