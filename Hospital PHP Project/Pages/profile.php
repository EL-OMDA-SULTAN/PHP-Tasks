<?php
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
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile</title>
        <link rel="stylesheet" href="../CSS/all.css">
        <link rel="stylesheet" href="../CSS/bootstrap.min.css">
        <link rel="stylesheet" href="../CSS/profile.css">
    </head>
    <body>
        <nav class="navbar navbar-expand">
            <div class="container justify-content-center">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link active" href="profile.php">Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="../home.php">Home</a></li>
                    <?php 
                        if($_COOKIE["type"]=="Doctor"){
                            echo '<li class="nav-item"><a class="nav-link" href="patient_details.php">P_Details</a></li>';
                        }
                    ?>
                    <li><a class="nav-link" href="massage.php">Massage</a></li>
                    <li>
                        <form action="" method="POST">
                            <input type="submit" name="logout" value="Logout" class="nav-link" id="logout">
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="details">
            <div class="row  h-100 align-items-center justify-content-center">
                <div class="col-lg-3 col-md-5 col-sm-8 col-10 details_content">
                    <h2>Personal Details</h2>
                    <div class="details_img">
                        <?php
                            if($_COOKIE["type"]=="Doctor"){
                                echo '<img src="../images/doctor/'.$_COOKIE["doctor_img"].'" alt="doctor" width="60px" height="60px">';
                                echo '<p>Dr : '.$_COOKIE["doctor_name"].'</p>';
                            }
                            else if($_COOKIE["type"]=="Patient"){
                                echo '<img src="../images/patient/'.$_COOKIE["patient_img"].'" alt="doctor" width="60px" height="60px">';
                                echo '<p>Mr/Mrs : '.$_COOKIE["patient_name"].'</p>';
                            }
                        ?>
                    </div>
                    <hr>
                    <div class="details_info">
                        <?php
                            if($_COOKIE["type"]=="Doctor"){
                                echo '<p><span>National ID :</span> '.$_COOKIE["doctor_national_id"].'</p>';
                                echo '<p><span>Time :</span> '.$_COOKIE["doctor_time"].'</p>';
                                echo '<p><span>Phone :</span> '.$_COOKIE["doctor_phone"].'</p>';
                                echo '<p><span>Department :</span> '.$_COOKIE["doctor_department"].'</p>';
                            }
                            else if($_COOKIE["type"]=="Patient"){
                                echo '<p><span>National ID :</span> '.$_COOKIE["patient_national_id"].'</p>';
                                echo '<p><span>Phone :</span> '.$_COOKIE["patient_phone"].'</p>';
                                echo '<p><span>Diagnosis :</span> '.$_COOKIE["patient_diagnosis"].'</p>';
                                echo '<p><span>Department :</span> '.$_COOKIE["patient_department"].'</p>';
                                echo '<p><span>Doctor :</span> '.$_COOKIE["patient_doctor"].'</p>';
                                echo '<button class="btn btn-primary d-block m-auto"><a href="update.php" class="text-white text-decoration-none fs-5">Update</a></button>';
                            }
                        ?>
                    </div>
                    
                </div>
                <div class="col-lg-9 col-md-7 col-sm-10 col-12 departments ">
                    <h2>Departments</h2>
                    <div class="row justify-content-center align-content-center column-gap-5">
                        <div class="col-lg-4 col-md-6 col-sm-10 col-10">
                            <h3>Bones</h3>
                            <div class="dep_img">
                                <img src="../images/dep 1.avif" alt="department 1">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-10 col-10">
                            <h3>Brain_and_Nerves</h3>
                            <div class="dep_img">
                                <img src="../images/dep 2.avif" alt="department 2">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center align-content-center column-gap-5">
                        <div class="col-lg-4 col-md-6 col-sm-10 col-10">
                            <h3>Subconscious</h3>
                            <div class="dep_img">
                                <img src="../images/dep 3.avif" alt="department 1">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-10 col-10">
                            <h3>Burns</h3>
                            <div class="dep_img">
                                <img src="../images/dep 4.avif" alt="department 2">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="welcome">
            <?php
                echo '<span class="welcome_exit" onclick="
                    document.querySelector(\'.welcome_span\').style.display = \'none\';
                    document.querySelector(\'.welcome_exit\').style.display = \'none\';
                    document.querySelector(\'.welcome_img\').style.display = \'none\';
                    "><i class="fa-solid fa-xmark"></i></span>';
            
                if(isset($_COOKIE["type"])) {
                    if ($_COOKIE["type"] == "Doctor") {
                        echo '<span class="welcome_span">Welcome Dr : ' . $_COOKIE["doctor_name"]. '</span>';
                    } else if ($_COOKIE["type"] == "Patient") {
                        echo '<span class="welcome_span">Welcome Mr/Mrs : ' .$_COOKIE["patient_name"]. '</span>';
                    }
                }
            ?>
            <img src="../images/profile welcome.avif" alt="welcome image" class="welcome_img">
        </div>
        <script src="../JS/bootstrap.bundle.min.js"></script>
    </body>
</html>