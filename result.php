<?php
    session_start();
    $username=$_SESSION['username'];
    
    
    
    $sqlservername="localhost";//servername mearns fomain name in our case it is local host
    $sqlusername="root";
    $sqlpassword="";
    $sqldbname="test";
    $conn=new mysqli($sqlservername,$sqlusername,$sqlpassword,$sqldbname);

    if($conn->connect_error)//if coonection error,then connect_error function of conn object will return 1
    {
        die("connection  failed!" . $conn->connect_error);
    }

    $sqlselect = $conn->prepare("select * from answer_table where username =?");
    $sqlselect->bind_param("s",$username);
    $sqlselect->execute();
    $res=$sqlselect->get_result();
    $info=$res->fetch_assoc();
    $sqlselect->close();
    if(isset($_POST['submit'])){
        session_unset();
        header('Location: http://'.$_SERVER['HTTP_HOST'].'/project/Registration.php', true, 301);
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
            .title {
                text-align: center;
                margin: auto;
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
        <br>
        <section>
            <div class="container">
                <h4 class="row d-flex justify-content-center">
                    RESULT
                </h4>
                <br>
                <div class="row d-flex justify-content-center">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="table-success">
                                <th>SUBJECT</th>
                                <th>TOTAL QUESTION</th>
                                <th>TOTAL ATTEMPTED</th>
                                <th>CORRECT</th>
                                <th>WRONG</th>
                                <th>TOTAL </th>
                            </tr>
                        </thead>
                        <tr>
                            <td>PHYSICS</td>
                            <td>10</td>
                            <td><?php echo $info['attempt1'] ; ?></td>
                            <td><?php echo $info['marks1'] ; ?></td>
                            <td><?php echo $info['attempt1']-$info['marks1'] ; ?></td>
                            <td><?php echo $info['marks1'] ; ?></td>

                        </tr>
                        <tr>
                            <td>CHEMISTRY</td>
                            <td>10</td>
                            <td><?php echo $info['attempt2'] ; ?></td>
                            <td><?php echo $info['marks2'] ; ?></td>
                            <td><?php echo $info['attempt2']-$info['marks2'] ; ?></td>
                            <td><?php echo $info['marks2'] ; ?></td>

                        </tr>
                        <tr>
                            <td>MATHS</td>
                            <td>10</td>
                            <td><?php echo $info['attempt3'] ; ?></td>
                            <td><?php echo $info['marks3'] ; ?></td>
                            <td><?php echo $info['attempt3']-$info['marks3'] ; ?></td>
                            <td><?php echo $info['marks3'] ; ?></td>

                        </tr>
                    </table>
                </div>
                <div class="row d-flex justify-content-center">
                    <form action="" method="post">
                        <div class="form-group ">
                            <button type="submit" name="submit" class="btn btn-secondary">END EXAM</button>
                        </div>
                </div>
            </div>
        </section>


    </body>

    </html>