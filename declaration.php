<?php
if(isset($_POST['submit'])){
   if(isset($_POST['declaration']) &&  $_POST['declaration'] == 'yes') 
    {
        session_start();
        $_SESSION['duration']=30;
        $_SESSION['start_time']=date("Y-m-d H:i:s");
        $end_time=date("Y-m-d H:i:s",strtotime("+".$_SESSION['duration'].'minutes',strtotime($_SESSION['start_time'])));
        $_SESSION['end_time']=$end_time;
        header('Location: http://'.$_SERVER['HTTP_HOST'].'/project/example1.php', true, 301);
        exit();
    }
    else{
        echo "please accept the declaration" ;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap.min.css" crossorigin="anonymous">
    <title>Choice Based Online Examination System</title>
    <style>
     .title{
        text-align: center;
        margin:auto;
        font-family: Montserrat;
        font-style: normal;
        font-weight: bold;
        font-size: 30px;
        line-height: 59px;
        color: darkblue;
    } 
    </style>
</head>
<body>
    
    <header class=" title text-center">
    CHOICE BASED ONLINE EXAMINATION SYSTEM
    </header>
    
    <section>
            <h4 class="row d-flex justify-content-center">
                DECLARATION
            </h4>
            <div class="container">
            <div class="row">
            <ol type="i">
                <li>
                    You are required to comply with the directions given by the head invigilator at the examination venue.
                </li>
                <li>
                    Your student identity card or other valid photo identification must be visible on your desk during the entire examination (Student ID App with photo is not valid as identification).
                </li>
                <li>
                    You may keep food and drink on or by the desk during the entire examination. You may eat and drink whenever you want.
                </li>
                <li>
                    You are not permitted to leave the venue for a break .If you wish to withdraw from the examination, please note that you are not permitted to leave the venue before 10 a.m. at the earliest, see below, Withdrawing from an examination.
                </li>
                <li>
                    If anything in the examination question paper is unclear, you can contact the lecturer visiting the venue. Such contact is facilitated by the head invigilator at the venue.
                </li>
                <li>
                    Law: The student representatives do not represent the faculty, but if anything in the examination question paper is unclear the student representative at the venue can pass on the query to the right person(s) in charge.
                </li>
                <li>
                    Papers and computer/laptop are to be covered when you leave your place.
                </li>
                <li>
                    If you experience technical problems during a digital examination, you must immediately contact one of the invigilators. The invigilator will call for technical support. Failure to report such technical problems might be treated as cheating or an attempt to cheat.
                </li>
            </ol> 
            </div>
            <form class="row" action="" method="post">
            <div class="form-group">
            <input  class="form-check-input " name="declaration" type="checkbox" value="yes">
            <label  class="form-check-label" for="check1">
                I Have read and understand the instruction.All Computer hardware allocated to me are in proper working condition.I agree that in case of adhering to the instruction.I will be disqualified from giving exam. 
            </label>

            <button type="submit"  class="btn btn-secondary" name="submit" >I am ready to Begin</button>
            </div>
            </form>
            </div>
    </section>
    
</body>
</html>