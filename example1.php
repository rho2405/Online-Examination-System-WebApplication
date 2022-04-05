<?php

$cnt = 0;
$uAns = array();
$q=$qn=$choice1=$choice2=$choice3=$choice4=$ans=$uAns=array();


session_start();
$username=$_SESSION['username'];
if (!isset($_SESSION['cnt1'])) {
    global $cnt;
    $_SESSION['cnt1'] = 0;

    $cnt = $_SESSION['cnt1'];

    $question_paper = data_read();
    $_SESSION['q_paper1'] = $question_paper;

    $q = $question_paper["q"];
    $qn = $question_paper["qn"];
    $choice1 = $question_paper["choice1"];
    $choice2 = $question_paper["choice2"];
    $choice3 = $question_paper["choice3"];
    $choice4 = $question_paper["choice4"];
    $ans = $question_paper["ans"];
    $uAns = $question_paper["uAns"];
}
else {
    $cnt = $_SESSION['cnt1'];

    $question_paper = $_SESSION['q_paper1'];
    $q = $question_paper["q"];
    $qn = $question_paper["qn"];
    $choice1 = $question_paper["choice1"];
    $choice2 = $question_paper["choice2"];
    $choice3 = $question_paper["choice3"];
    $choice4 = $question_paper["choice4"];
    $ans = $question_paper["ans"];
    $uAns = $question_paper["uAns"];
}

function data_read() {
    global $q, $qn, $choice1, $choice2, $choice3, $choice4, $ans, $uAns;

    $row = 1;
    if (($handle = fopen("text1.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            
            $row++;
            array_push($qn, $data[0]);
            array_push($q, $data[1]);
            array_push($choice1, $data[2]);
            array_push($choice2, $data[3]);
            array_push($choice3, $data[4]);
            array_push($choice4, $data[5]);
            array_push($ans, $data[6]);
            array_push($uAns,"z");
        }
        $_SESSION['u_ans'] = $uAns;
        fclose($handle);
    }
    $question_paper = array("q" => $q, "qn" => $qn, "choice1" => $choice1, "choice2" => $choice2, "choice3" => $choice3, "choice4" => $choice4, "ans" => $ans, "uAns" => $uAns);
    return $question_paper;

}


if (isset($_POST['save'])) {
    $cnt = $_SESSION["cnt1"];
    
    $uAns = $_SESSION["q_paper1"]["uAns"];
    if(isset($_POST['optradio'])){
        $uAns[$cnt] = $_POST['optradio'];
    }else{
        $uAns[$cnt] = "z";
    }
    
    $_SESSION["q_paper1"]["uAns"] = $uAns;
    //print_r($uAns);
    if($cnt<9){
        $cnt++;    
    }

    $_SESSION["cnt1"] = $cnt;

}

if (isset($_POST['submit'])) {
    $arr=result();
    $marks=$arr["marks"];
    $attempt=$arr["attempt"];
    
    $sqlservername="localhost";//servername mearns fomain name in our case it is local host
    $sqlusername="root";
    $sqlpassword="";
    $sqldbname="test";
    $conn=new mysqli($sqlservername,$sqlusername,$sqlpassword,$sqldbname);

    if($conn->connect_error)//if coonection error,then connect_error function of conn object will return 1
    {
        die("connection  failed!" . $conn->connect_error);
    }


     $sqlinsert=$conn->prepare("insert into answer_table(username,marks1,attempt1) values(?,?,?)");
     $sqlinsert->bind_param("sii",$username,$marks,$attempt);
     $sqlinsert->execute();
     $sqlinsert->close();

     $conn->close();
     
     $_SESSION['duration']=30;
     $_SESSION['start_time']=date("Y-m-d H:i:s");
     $end_time=date("Y-m-d H:i:s",strtotime("+".$_SESSION['duration'].'minutes',strtotime($_SESSION['start_time'])));
     $_SESSION['end_time']=$end_time;
     header('Location: http://'.$_SERVER['HTTP_HOST'].'/project/example2.php', true, 301);
     exit();

}

if (isset($_POST['cnt_1'])) {
    $_SESSION["cnt1"]=0;

}else if (isset($_POST['cnt_2'])) {
    $_SESSION["cnt1"]=1;

}else if (isset($_POST['cnt_3'])) {
    $_SESSION["cnt1"]=2;

}else if (isset($_POST['cnt_4'])) {
    $_SESSION["cnt1"]=3;

}else if (isset($_POST['cnt_5'])) {
    $_SESSION["cnt1"]=4;

}else if (isset($_POST['cnt_6'])) {
    $_SESSION["cnt1"]=5;

}else if (isset($_POST['cnt_7'])) {
    $_SESSION["cnt1"]=6;

}else if (isset($_POST['cnt_8'])) {
    $_SESSION["cnt1"]=7;

}else if (isset($_POST['cnt_9'])) {
    $_SESSION["cnt1"]=8;

}else if (isset($_POST['cnt_10'])) {
    $_SESSION["cnt1"]=9;

}


function result(){
    
    $marks=0; 
    $not_ans=0;
    $ans = $_SESSION['q_paper1']["ans"];
    $uAns = $_SESSION['q_paper1']["uAns"];
    for($i=0;$i<=9;$i++){
        if($uAns[$i]==$ans[$i]){
            $marks++;
        }else if($uAns[$i]=="z"){
            $not_ans++;
        }
    }

    return array("marks"=>$marks,"attempt"=>10-$not_ans);
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Choice Based Online Examination System</title>
    <link rel="stylesheet" href="style.css">
    <script>
        setInterval(() => {
            var button = document.getElementById('submit');
            button.click();  
        }, 1800000);
    </script>
</head>

<body>

    <header class=" title text-center">
    CHOICE BASED ONLINE EXAMINATION SYSTEM
    </header>
    <section class="section1">    
        <form class="section">
            <fieldset style="padding-bottom:18px;">
                <legend style="font-size:15px; margin-left:15px; "><b>Sections:</b></legend>
                <button disabled>Physics</button>
                <button>Maths</button>
                <button>English</button>

            </fieldset>
        </form>
        <div class="question_window">
            <div style=" padding-left: 10px;" id="question_num">
                <b><?php if($cnt<=9){ echo "Question No ".$qn[$cnt];}else{ echo "Question No ".$qn[9]; } ?></b>
            </div>
            <hr style="width:97%; margin-left:5px;">
            <div style=" padding-left: 10px;" id="question">
                <?php if($cnt<=9){ echo $q[$cnt]; }else{ echo $q[9]; } ?>
            </div>
            <br>
            <form action="" method="post">
                <div style=" padding-left: 10px;" class="radio">
                    <label><input type="radio" name="optradio" value="a" <?php  ?> id="option1"><?php if($cnt<=9){ echo $choice1[$cnt]; }else{ echo $choice1[9]; } ?></label>
                </div><br>
                <div style=" padding-left: 10px;" class="radio">
                    <label><input type="radio" name="optradio" value="b" <?php  ?> id="option2"><?php if($cnt<=9){ echo $choice2[$cnt]; }else{ echo $choice2[9]; } ?></label>
                </div><br>
                <div  style=" padding-left: 10px;" class="radio">
                    <label><input type="radio" name="optradio" value="c" <?php  ?> id="option3"><?php if($cnt<=9){ echo $choice3[$cnt]; }else{ echo $choice3[9]; } ?></label>
                </div><br>
                <div style=" padding-left: 10px;" class="radio">
                    <label><input type="radio" name="optradio" value="d" <?php  ?> id="option4"><?php if($cnt<=9){ echo $choice4[$cnt]; }else{ echo $choice4[9]; } ?></label>
                </div>
                <div style="top:130px; position:relative;">

                <br><hr style=" padding-left: 10px;"><br>
                <button  style=" margin-left: 10px; " class="next_b" name='save' id='save'><?php if($cnt<=8){echo "Save and Next";}else{echo "Save";} ?></button>
                </div>
                
            </form>
        </div>
    </section>
    <section class="section2">
        <div style=" position: absolute;">
            <?php 
                $sqlservername="localhost";//servername mearns fomain name in our case it is local host
                $sqlusername="root";
                $sqlpassword="";
                $sqldbname="test";
                $conn=new mysqli($sqlservername,$sqlusername,$sqlpassword,$sqldbname);
            
                if($conn->connect_error)//if coonection error,then connect_error function of conn object will return 1
                {
                    die("connection  failed!" . $conn->connect_error);
                }
            
                $sqlselect = $conn->prepare("select * from user_info where username =?");
                $sqlselect->bind_param("s",$username);
                $sqlselect->execute();
                $res=$sqlselect->get_result();
                $info=$res->fetch_assoc();
                $sqlselect->close();
                
                echo '<img src="'.$info['imagepath'].'" alt="userimage" class="userimage" >';
            ?>
            <div style="top: 10px; left:115px; display:block; position: absolute;">
            <b><?php  echo $username;?></b>
            <b>
            Time Left:
            <div id="response"></div>
            <script>
            setInterval(() => {
                var xmlhttp=new XMLHttpRequest();
                xmlhttp.open("GET","response.php",false);
                xmlhttp.send(null);
                document.getElementById("response").innerHTML=xmlhttp.responseText;
            }, 1000);
            </script>
 
            </b>
            </div>
        </div>
        <div style=" position: absolute;top: 110px; background-color:grey; width:100%;"class="qp"><b><center> Question palette</center></b></div>
        <form style=" position: absolute;top: 150px; padding-left:15px; " class="btn_container" action="" method="post">
            <?php 
            for($x=1;$x<=10;$x++){
                echo "<button name ='cnt_".$x."' id='cnt'>".$x."</button>";
            }
            ?>
        </form>
        <form style=" position: absolute;top: 495px; left:100px;" action="" method="post">
        <button type="submit" class="submit_b" id="submit" name="submit" rel="nofollow noopener">submit</button>
        </form>


            
    
    </section>
</body>

</html>