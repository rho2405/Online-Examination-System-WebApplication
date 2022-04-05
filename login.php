
<?php

$username_entered=$password_entered=$username=$password="";
if(isset($_POST['login_submit'])){
    
    if(isset($_POST['username'])){
        $username_entered=$_POST['username'];
    }
    else{
        $username_entered="";
    }
    if(isset($_POST['password'])){
        $password_entered=$_POST['password'];
    }
    else{
        $password_entered="";
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

    $sqlselect = $conn->prepare("select * from user_info where username = ?");
    $sqlselect->bind_param("s",$username_entered);
    $sqlselect->execute();
    $res = $sqlselect->get_result();
    $info=$res->fetch_assoc();
    $sqlselect->close();
    
    
    if($username_entered==$info['username'] && $password_entered==$info['password']){
        session_start();
        $_SESSION['username']=$username_entered;
        header('Location: http://'.$_SERVER['HTTP_HOST'].'/project/declaration.php', true, 301);
        exit();
    }else{
        echo "wrong password or username";
    }
    /*------------------------OR---------------------
    if($username_entered==$info['username'] && $password_entered==$info['password']){
        session_start();
        $_SESSION['username']=$username_entered;
        $URL='http://'.$_SERVER['HTTP_HOST'].'/project/declaration.php';
        echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
    }else{
        echo "wrong password or username";
    }
    */

}else{
    // echo"Something went wrong";
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
    
    <section class="container">
            <h4 class="row d-flex justify-content-center">
            LOGIN
            </h4>
            <br>
            <form class="row d-flex justify-content-center" action="" method="post">
           
            <div class="form-group">
                    <label>Username:</label>
                    <input type="text" class="form-control" name="username" placeholder="Enter uername">
                    <label>Password:</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter password">
                    <br>
                    <button type="submit" name="login_submit" class="btn btn-secondary">LOGIN</button>
                </div>
            </form>
    </section>
    
</body>
</html>