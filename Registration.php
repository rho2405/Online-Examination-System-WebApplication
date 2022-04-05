<?php
    $id=uniqid();
    $uname ="";
    $fathername ="";
    $dob ="";
    $email ="";
    $password ="";
    $gender = "";
    $target_file="";

if(isset($_POST['submit'])){
    if(isset($_FILES['file'])){
        
        $id="";
        $target_dir="IMG_UPLOAD\\";
        $id=uniqid($prefix="img_");
        $base=basename($_FILES['file']['name']);
        $filetype = strtolower(pathinfo($base,PATHINFO_EXTENSION));
        $target_file=$target_dir . $id. "." . $filetype;
        $tmp=($_FILES['file']['tmp_name']);
        $test=getimagesize($tmp);
        $uploadOK=1;


        if($test !==false){
            echo "File is an image ".isset($test['mime'])."<br>";
            $uploadOK=1;
        }else{
            echo"file is not an image"."<br>";
            $uploadOK=0;
        }
        
        if (file_exists($target_file)){
            echo "file already exists , sorry"."<br>";
            $uploadOK=0;
        }
        
        if(isset($_FILES['file']['size'])>500000){
            echo "sorry, file too large!". "<br>";
            $uploadOK=0;
        }
        
        if($filetype!="jpg" && $filetype!="png" && $filetype!="jpeg" && $filetype!="gif"){
            echo "sorry, only JPG, PNG, JPEG and GIF files are allowed"."<br>";
            $uploadOK=0;
        }
        if($uploadOK==0){
            echo"your file was not uploaded"."<br>";
        }else{
            //Everything OK, uploading file
            if(move_uploaded_file($_FILES["file"]["tmp_name"],$target_file)){
                echo "the file". basename(isset($_FILES['file']['name']))."has been uploaded.<br>"; 
            }else{
                echo "sorry unable to upload file <br>";
                print_r($_FILES["file"]["tmp_name"]);
            }
        }
    }else{
        echo "something wrong";
    }
    $id=uniqid();

    if(isset($_POST["username"]))//to check if anything entered by the user 
    {
        $username =$_POST["username"];
    }
    else//if nothing entered by the user 
    {
        $username ="";
    }
    if(isset($_POST["fathername"]))//to check if anything entered by the user 
    {
        $fathername =$_POST["fathername"];
    }
    else//if nothing entered by the user 
    {
        $fathername ="";
    }


    if(isset($_POST["dob"]))//to check if anything entered by the user 
    {
        $dob =$_POST["dob"];
    }
    else//if nothing entered by the user 
    {
        $dob ="";
    }


    if(isset($_POST["email"]))//to check if anything entered by the user 
    {
        $email =$_POST["email"];
    }
    else//if nothing entered by the user 
    {
        $email ="";
    }


    if(isset($_POST["password"]))//to check if anything entered by the user 
    {
        $password =$_POST["password"];
    }
    else//if nothing entered by the user 
    {
        $password ="";
    }


    if(isset($_POST['radio'])){
        $gender = $_POST['radio'];
    }else{
        $gender = "";
    }
    
    $sqlservername="localhost";//servername mearns fomain name in our case it is local host
    $sqlusername="root";
    $sqlpassword="";
    $sqldbname="test";
    $conn=new mysqli($sqlservername,$sqlusername,$sqlpassword,$sqldbname);

    if($conn->connect_error)//if coonection error,then connect_error function of conn object will return 1
    {
        die("connection  failed!" . $conn->connect_error);
    }

    $sqlinsert=$conn->prepare("insert into user_info(id,username,fathername,dob,email,password,gender,imagepath) values(?,?,?,?,?,?,?,?)");
    $sqlinsert->bind_param("ssssssss",$id,$username,$fathername,$dob,$email,$password,$gender,strval($target_file));//ssss means 4 string of text will be given in next arguments
    $sqlinsert->execute();
    $sqlinsert->close();

    $conn->close();

    header('Location: http://'.$_SERVER['HTTP_HOST'].'/project/login.php', true, 301);
    exit();

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
    
    body{
            background-color:rgb(141, 240, 194);
        }
        
    </style>
</head>
<body> 
    
    <header class=" title text-center">
    CHOICE BASED ONLINE EXAMINATION SYSTEM
    </header>
    <br>
    <section class="container">
            <h4 class="row d-flex justify-content-center">
            REGISTRATION
            </h4>
            <br>
            <form class="row d-flex justify-content-center" action="Registration.php" method="post" enctype="multipart/form-data" >
            <div class="form-group">
                <label>Name:</label>
                <input type="text"class="form-control"  name="username" placeholder="Enter Name">
                <label>Father'sName:</label>
                <input type="text" class="form-control" name="fathername" placeholder="Enter Father's Name">
                <label>Date of Birth:</label>
                <input type="text" class="form-control" name="dob" placeholder="Enter Date of birth">
                <label>Email:</label>
                <input type="email" class="form-control"  name="email"placeholder="Enter email">
                <label>Password:</label>
                <input type="password" class="form-control" name="password" minlength="8">
                <div class="form-check form-check-inline" name="gender">
                    <input type="radio" class="form-check-input" name="radio" id="radioid5" value="Male" >
                    <label  for="radioid5">Male&nbsp;&nbsp;</label> 
                    <input type="radio" class="form-check-input" name="radio" id="radioid5" value="Female" >
                    <label  for="radioid5">Female</label>
                </div>
                <input type="file" name="file">      
                <br><br>
                <div class="d-flex justify-content-center row">
                <button name="submit" class="btn btn-secondary" type="submit">REGISTER</button>
                </div>
                <br>
                <div>
                    Already registered? <a href=<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/project/login.php' ?>>Click Here to login</a>
                </div>
            </div>
            <form>
    </section>
    
</body>
</html>