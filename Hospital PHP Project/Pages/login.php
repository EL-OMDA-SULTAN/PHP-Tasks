<?php
    $DB_user = "root";
    $DB_pass = "omda732";
    $con=new PDO("mysql:host=localhost;dbname=hospital",$DB_user,$DB_pass);
    session_start();

    $nidError = $passError = "";
    $nidValue = $passValue = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nidValue = $_POST["nid"];
        $passValue = $_POST["pass"];
        $pat_nid="/^[0-9]+$/";

        if($nidValue==""){
            $nidError="* National ID is required";
        }
        else if(trim($nidValue)==""){
            $nidError="* National ID is required";
        }
        else if(!preg_match($pat_nid, $nidValue)){
            $nidError="* Invalid National ID Only Numbers";
        }
        else if(strlen($nidValue)!=14){
            $nidError="* Invalid National ID length";
        }
        else if(strlen($nidValue)==14){
            $sql="select user_name from `user`";
            $stmt=$con->prepare($sql);
            $stmt->execute();
            $bool=false;
            foreach($stmt as $row){
                if($nidValue==$row['user_name']){
                    $bool=true;
                    break;
                }
            }
            if($bool){
                $_SESSION['nidLogin'] = $nidValue;
                if($passValue==""){
                    $passError="* Password is required";
                }
                else if(trim($passValue)==""){
                    $passError="* Password is required";
                }
                else{
                    $sql="select user_password from `user` where user_name='$nidValue'";
                    $stmt=$con->prepare($sql);
                    $stmt->execute();
                    $bool=false;
                    foreach($stmt as $row){
                        if(md5($passValue)==$row['user_password']){
                            $bool=true;
                            break;
                        }
                        
                    }
                    if(!$bool){
                        $passError="* Invalid Password";
                    }
                }
            }
            else{
                $nidError="* National ID does not exist";
            }
        }

        if($nidError=="" && $passError==""){
            $sql="select user_type_id from `user` where user_name='$nidValue'";
            $stmt=$con->prepare($sql);
            $stmt->execute();
            foreach($stmt as $row){
                if($row['user_type_id']==1){
                    $sql="select * from `doctor` where doctor_n_id='$nidValue'";
                    $stmt=$con->prepare($sql);
                    $stmt->execute();
                    foreach($stmt as $row){
                        setcookie('doctor_name', $row['doctor_name'], time() + (86400 * 30), "/");
                        setcookie('doctor_id', $row['doctor_id'], time() + (86400 * 30), "/");
                        setcookie('doctor_national_id', $row['doctor_n_id'], time() + (86400 * 30), "/");
                        setcookie('doctor_time', $row['doctor_time'], time() + (86400 * 30), "/");
                        setcookie('doctor_phone', $row['doctor_phone'], time() + (86400 * 30), "/");
                        setcookie('doctor_img', $row['doctor_img'], time() + (86400 * 30), "/");
                        $sql="select dep_name from `department` where dep_id='$row[doctor_dep_id]'";
                        $stmt=$con->prepare($sql);
                        $stmt->execute();
                        foreach($stmt as $row){
                            setcookie('doctor_department', $row['dep_name'], time() + (86400 * 30), "/");
                        }
                    }
                    setcookie('type', "Doctor", time() + (86400 * 30), "/");
                }
                else if($row['user_type_id']==2){
                    setcookie('type', "Patient", time() + (86400 * 30), "/");
                    $sql="select * from `patient` where patient_n_id='$nidValue'";
                    $stmt=$con->prepare($sql);
                    $stmt->execute();
                    foreach($stmt as $row){
                        setcookie('patient_name', $row['patient_name'], time() + (86400 * 30), "/");
                        setcookie('patient_id', $row['patient_id'], time() + (86400 * 30), "/");
                        setcookie('patient_national_id', $row['patient_n_id'], time() + (86400 * 30), "/");
                        setcookie('patient_phone', $row['patient_phone'], time() + (86400 * 30), "/");
                        setcookie('patient_img', $row['patient_img'], time() + (86400 * 30), "/");
                        setcookie('patient_diagnosis', $row['patient_Diagnosis'], time() + (86400 * 30), "/");
                        $sql2="select dep_name from `department` where dep_id='$row[patient_dep_id]'";
                        $stmt2=$con->prepare($sql2);
                        $stmt2->execute();
                        foreach($stmt2 as $row2){
                            setcookie('patient_department', $row2['dep_name'], time() + (86400 * 30), "/");
                        }
                        $sql="select doctor_name from `doctor` where doctor_id='$row[patient_doc_id]'";
                        $stmt=$con->prepare($sql);
                        $stmt->execute();
                        foreach($stmt as $row){
                            setcookie('patient_doctor', $row['doctor_name'], time() + (86400 * 30), "/");
                        }
                    }
                }
            }
            header('Location: profile.php');
        }
    }
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="icon" href="../images/logo.png">
        <link rel="stylesheet" href="../CSS/bootstrap.min.css">
        <link rel="stylesheet" href="../CSS/register.css">
    </head>
    <body>
        <section class="login_form">
            <div class="container">
                <div class="row justify-content-center">
                    <form method="POST" class="form col-lg-5 col-md-7 col-sm-10 col-10" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <h1 class="text-center">Login</h1>
                        <div class="form-group mb-4">
                            <label for="nid">National ID</label>
                            <input type="text" class="form-control" id="nid" placeholder="Enter Your National ID" name="nid" value="<?php echo $nidValue; ?>">
                            <span class="col-12 nid_error text-center mt-2"><?php echo $nidError; ?></span>
                        </div>
                        <div class="form-group mb-4">
                            <label for="pass">password</label>
                            <input type="password" class="form-control" id="pass" placeholder="Enter Your Password" name="pass" value="<?php echo $passValue; ?>">
                            <span class="col-12 name_error text-center mt-2"><?php echo $passError; ?></span>
                        </div>
                        <button type="submit" class="btn mt-4" name="register">Login</button>
                        <div class="text-center mt-4 text-light">don't have an account?<a href="register.php"> Register</a></div>
                    </form>
                </div>
            </div>
            <div class="animation_one">
            </div>
            <div class="animation_two"></div>
            </div>
        </section>
        <script src="../JS/bootstrap.bundle.min.js"></script>
    </body>
</html>
