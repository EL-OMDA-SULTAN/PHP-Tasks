<?php
// logout
    if(isset($_POST["logout"])){
        if($_COOKIE["type"]=="Doctor"){
            setcookie("doctor_name", "", time() - 3600, "/");
            setcookie("doctor_national_id", "", time() - 3600, "/");
            setcookie("doctor_department", "", time() - 3600, "/");
            setcookie("doctor_img", "", time() - 3600, "/");
            setcookie("doctor_id", "", time() - 3600, "/");
            setcookie("doctor_time", "", time() - 3600, "/");
            setcookie("doctor_phone", "", time() - 3600, "/");
            setcookie("type", "", time() - 3600, "/");
            var_dump($_COOKIE);
            header("location: ../home.php");
        }
        else if($_COOKIE["type"]=="Patient"){
            setcookie("patient_name", "", time() - 3600, "/");
            setcookie("patient_national_id", "", time() - 3600, "/");
            setcookie("patient_diagnosis", "", time() - 3600, "/");
            setcookie("patient_department", "", time() - 3600, "/");
            setcookie("patient_img", "", time() - 3600, "/");
            setcookie("patient_doctor", "", time() - 3600, "/");
            setcookie("patient_id", "", time() - 3600, "/");
            setcookie("patient_phone", "", time() - 3600, "/");
            setcookie("type", "", time() - 3600, "/");
            header("location: ../home.php");
        }
    }
    //massage show
    $DB_user = "root";
    $DB_pass = "omda732";
    $con=new PDO("mysql:host=localhost;dbname=hospital",$DB_user,$DB_pass);
    if(isset($_POST["send"])){
        $massage = $_POST["massage"];
        if(!empty($massage)){
            $sql="select doctor_id from `doctor` where doctor_name=:doctor_name";
            $stmt=$con->prepare($sql);
            $stmt->bindParam(":doctor_name",$_COOKIE["patient_doctor"]);
            $stmt->execute();
            $doc_id=$stmt->fetch()["doctor_id"];
            $sql = "insert into `send_mass` (send_mass_text,send_mass_doc_id,send_mass_patient_id,send_mass_time) 
            values (:send_mass_text,:send_mass_doc_id,:send_mass_patient_id,:send_mass_time)";
            $stmt=$con->prepare($sql);
            $stmt->bindParam(":send_mass_text",$massage);
            $stmt->bindParam(":send_mass_doc_id",$doc_id);
            $stmt->bindParam(":send_mass_patient_id",$_COOKIE["patient_id"]);
            $stmt->bindParam(":send_mass_time",date("Y-m-d H:i:s"));
            $stmt->execute();
            header("location: massage.php");
        }
        
    }
    $error = "";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["reply"])){
            $reply = $_POST["massageReply"];
            $send_mass_id = $_POST["reply_mass"];
            if(empty($send_mass_id)){
                $error = "Please Enter Massage ID";
            }
            else if(empty($reply)){
                $error = "Please Enter Reply";
            }
            else{
                $sql="select send_mass_id from `send_mass` where send_mass_id=:send_id";
                $stmt=$con->prepare($sql);
                $stmt->bindParam(":send_id",$send_mass_id);
                $stmt->execute();
                if($stmt->rowCount()==0){
                    $error = " Massage Not Found ";
                }
                else{
                    $sql="select reply_mass_send_id from `reply_mass` where reply_mass_send_id=:mass_send_id";
                    $stmt=$con->prepare($sql);
                    $stmt->bindParam(":mass_send_id",$send_mass_id);
                    $stmt->execute();
                    if($stmt->rowCount()>0){
                        $error = "Massage Already Reply";
                    }
                }
            }
            if($error==""){
                $sql = "insert into `reply_mass` (reply_mass_text,reply_mass_time,reply_mass_send_id) 
                values (:reply_mass_text,:reply_mass_time,:reply_mass_send_id)";
                $stmt=$con->prepare($sql);
                $stmt->bindParam(":reply_mass_text",$reply);
                $stmt->bindParam(":reply_mass_time",date("Y-m-d H:i:s"));
                $stmt->bindParam(":reply_mass_send_id",$send_mass_id);
                $stmt->execute();
                header("location: massage.php");
            }
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Massage</title>
        <link rel="stylesheet" href="../CSS/all.css">
        <link rel="stylesheet" href="../CSS/bootstrap.min.css">
        <link rel="stylesheet" href="../CSS/profile.css">
    </head>
    <body>
        <nav class="navbar navbar-expand">
            <div class="container justify-content-center">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="../home.php">Home</a></li>
                    <?php 
                        if($_COOKIE["type"]=="Doctor"){
                            echo '<li class="nav-item"><a class="nav-link" href="patient_details.php">P_Details</a></li>';
                        }
                    ?>
                    <li><a class="nav-link active" href="massage.php">Massage</a></li>
                    <li>
                        <form action="" method="POST">
                            <input type="submit" name="logout" value="Logout" class="nav-link" id="logout">
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
        <section class="massage">
            <div class="container">
                <h1 class="text-center">Massage</h1>
                <?php
                    if($_COOKIE["type"]=="Patient"){
                        $sql="select send_mass_text,send_mass_time,send_mass_id from send_mass where send_mass_patient_id=:patient_id";
                        $stmt=$con->prepare($sql);
                        $stmt->bindParam(":patient_id",$_COOKIE["patient_id"]);
                        $stmt->execute();
                        
                        if($stmt->rowCount()==0){
                            echo '<h2 class="text-center">" No Massages "</h2></div>';
                        }
                        else{
                            $x=1;
                            while($row=$stmt->fetch()){
                                echo '<div class="row mb-2 justify-content-center">';
                                echo '<div class="col-12"><div class="table-responsive"><table class="table"><tr><th>N</th><th>Type</th><th>Text</th><th>time</th><th>M ID</th></tr>';
                                echo '<tr>';
                                echo '<td>'.$x.'</td>';
                                echo '<td>Massage</td>';
                                echo '<td>'.$row["send_mass_text"].'</td>';
                                echo '<td>'.$row["send_mass_time"].'</td>';
                                echo '<td>'.$row["send_mass_id"].'</td>';
                                echo '</tr>';
                                $x++;
                                $sql2="select reply_mass_text,reply_mass_time,reply_mass_id from reply_mass where reply_mass_send_id=:send_mass_id";
                                $stmt2=$con->prepare($sql2);
                                $stmt2->bindParam(":send_mass_id",$row["send_mass_id"]);
                                $stmt2->execute();
                                if($stmt2->rowCount()>0){
                                    while($row2=$stmt2->fetch()){
                                        echo '<tr>';
                                        echo '<td>'.$x.'</td>';
                                        echo '<td>Reply</td>';
                                        echo '<td>'.$row2["reply_mass_text"].'</td>';
                                        echo '<td>'.$row2["reply_mass_time"].'</td>';
                                        echo '<td>'.$row2["reply_mass_id"].'</td>';
                                        echo '</tr>';
                                        $x++;
                                    }
                                }
                                else{
                                    echo '<tr><td colspan="5" class="text-center">No Reply</td></tr>';
                                }
                            }
                            echo '</table></div></div>';
                        }
                    }
                    else if($_COOKIE["type"]=="Doctor"){
                        $sql="select send_mass_text,send_mass_time,send_mass_id from send_mass where send_mass_doc_id=:doctor_id";
                        $stmt=$con->prepare($sql);
                        $stmt->bindParam(":doctor_id",$_COOKIE["doctor_id"]);
                        $stmt->execute();
                        
                        if($stmt->rowCount()==0){
                            echo '<h2 class="text-center">" No Massages "</h2></div>';
                        }
                        else{
                            while($row=$stmt->fetch()){ $x=1;
                                echo '<div class="row mb-2 justify-content-center">';
                                echo '<div class="col-12"><div class="table-responsive"><table class="table"><tr><th>N</th><th>Type</th><th>Text</th><th>time</th><th>M ID</th></tr>';
                                echo '<tr>';
                                echo '<td>'.$x.'</td>';
                                echo '<td>Massage</td>';
                                echo '<td>'.$row["send_mass_text"].'</td>';
                                echo '<td>'.$row["send_mass_time"].'</td>';
                                echo '<td>'.$row["send_mass_id"].'</td>';
                                echo '</tr>';
                                $x++;
                                $sql2="select reply_mass_text,reply_mass_time,reply_mass_id from reply_mass where reply_mass_send_id=:send_mass_id";
                                $stmt2=$con->prepare($sql2);
                                $stmt2->bindParam(":send_mass_id",$row["send_mass_id"]);
                                $stmt2->execute();
                                if($stmt2->rowCount()>0){
                                    while($row2=$stmt2->fetch()){
                                        echo '<tr>';
                                        echo '<td>'.$x.'</td>';
                                        echo '<td>Reply</td>';
                                        echo '<td>'.$row2["reply_mass_text"].'</td>';
                                        echo '<td>'.$row2["reply_mass_time"].'</td>';
                                        echo '<td>'.$row2["reply_mass_id"].'</td>';
                                        echo '</tr>';
                                        $x++;
                                    }
                                }
                                else{
                                    echo '<tr><td colspan="5" class="text-center">No Reply</td></tr>';
                                }
                                echo '</table></div></div>';
                            }
                            
                        }
                    }
                ?>
            </div>
        </section>
        <hr class="border-2 text-light opacity-100">
        <?php
        if($_COOKIE["type"]=="Doctor"){
            echo '
                <section class="massage_form mt-4 mb-5">
                    <div class="container">
                        <div class="row justify-content-center">
                            <form action="" method="POST" class="form col-sm-10 col-md-6 col-lg-4 col-12">
                                <h1 class="text-center">Reply Massage</h1>
                                    <label for="massage" class="form-label">Massage</label>
                                    <textarea name="massageReply" id="massage" class="form-control" placeholder="Massage"></textarea>
                                    <label for="reply_mass" class="form-label">Massage ID</label>
                                    <input type="number" name="reply_mass" id="reply_mass" class="form-control mb-2">
                                    <span id="error" class="text-danger">'.$error.'</span>
                                    <input type="submit" value="reply" name="reply" class="btn btn-primary mb-3" id="reply_mass">
                                    
                            </form>
                        </div>
                    </div>
                </section>
            ';
        }
        if($_COOKIE["type"]=="Patient"){
            echo '
            <section class="massage_form mt-5 mb-5">
                <div class="container">
                    <div class="row justify-content-center">
                            <form action="" method="POST" class="form col-sm-10 col-md-6 col-lg-4 col-12">
                                <h1 class="text-center">Send Massage</h1>
                                <label for="massage" class="form-label">Massage</label>
                                <textarea name="massage" id="massage" class="form-control" placeholder="Massage"></textarea>
                                    <input type="submit" value="send" name="send" class="btn btn-primary mb-3" id="send_mass">
                            </form>
                    </div>
                </div>
            </section>
            ';
        }
        ?>
    <script src="../JS/bootstrap.min.js"></script>
    </body>
</html>