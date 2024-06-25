<?php
    $DB_user = "root";
    $DB_pass = "omda732";
    $con=new PDO("mysql:host=localhost;dbname=hospital",$DB_user,$DB_pass);
    session_start();
    $fnameValue = $nidValue = $phoneValue = $imgValue = $depValue = 
    $diagValue = $doctorValue = $passValue=$c_passValue =
    $fnameError = $nidError = $phoneError = $imgError = $depError= 
    $diagError = $doctorError= $passError=$c_passError = "";
    if(isset($_COOKIE["patient_id"])){
        $sql="select * from `patient` where patient_id=:patient_id";
        $stmt=$con->prepare($sql);
        $stmt->execute(['patient_id'=>$_COOKIE["patient_id"]]);
        foreach($stmt as $row){
            $fnameValue = $row["patient_name"];
            $nidValue = $row["patient_n_id"];
            $phoneValue = $row["patient_phone"];
            $diagValue = $row["patient_Diagnosis"];
            $imgValue = $row["patient_img"];
            $sql1="select dep_name from `department` where dep_id=:dep_id";
            $stmt1=$con->prepare($sql1);
            $stmt1->execute(['dep_id'=>$row["patient_dep_id"]]);
            foreach($stmt1 as $row1){
                $depValue = $row1["dep_name"];
            }
            $sql="select doctor_name from `doctor` where doctor_id=:doctor_id";
            $stmt=$con->prepare($sql);
            $stmt->execute(['doctor_id'=>$row["patient_doc_id"]]);
            foreach($stmt as $row){
                $doctorValue = $row["doctor_name"];
            }
        }
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $fnameValue = $_POST['fname'];
        $nidValue = $_POST['nid'];
        $phoneValue = $_POST['phone'];

        if(isset($_POST['depart'])){
            $depValue = $_POST['depart'];
        }
        if(isset($_POST['doctor'])){
            $doctorValue = $_POST['doctor'];
        }

        $diagValue = $_POST['diag'];
        $passValue = $_POST['pass'];
        $c_passValue = $_POST['c_pass'];

        $pat_name="/^[a-zA-Z\s]+$/";
        $pat_nid="/^[0-9]+$/";

        // full name validation
        if($fnameValue==""){
            $fnameError="* Name is required";
        }
        else if(trim($fnameValue)==""){
            $fnameError="* Name is required";
        }
        else if(!preg_match($pat_name, $fnameValue)){
            $fnameError="* Invalid Name only alphabets";
        }
        else{
            $_SESSION['fname'] = $fnameValue;
        }

        // national id validation
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
            if(isset($_COOKIE["patient_n_id"])){
                if($nidValue!=$_COOKIE["patient_n_id"]){
                    $nidError="* National ID Is Not Correct";   
                }
            }
            else{
                if(isset($_COOKIE["doctor_id"])){
                    $sql="select dep_id from `department` where dep_name=:doctor_dep_name";
                    $stmt=$con->prepare($sql);
                    $stmt->execute(['doctor_dep_name'=>$_COOKIE["doctor_department"]]);
                    foreach($stmt as $row){
                        $dep_id=$row["dep_id"];
                    }
                    // echo $dep_id;
                    // echo $_COOKIE["doctor_department"];
                    $sql="select patient_n_id from `patient` where patient_dep_id=:dep_id";
                    $stmt=$con->prepare($sql);
                    $stmt->execute(['dep_id'=>$dep_id]);
                    // var_dump($stmt);
                    $bool=false;
                    foreach($stmt as $row){
                        if($nidValue==$row["patient_n_id"]){
                            $bool=true;
                            break;
                        }
                    }
                    if(!$bool){
                        $nidError="* National ID Not exist";
                    }
                }
            }
        }
        
        // phone number validation
        if($phoneValue==""){
            $phoneError="* Phone number is required";
        }
        else if(trim($phoneValue)==""){
            $phoneError="* Phone number is required";
        }
        else if(!preg_match($pat_nid, $phoneValue)){
            $phoneError="* Invalid Phone number Only Numbers";
        }
        else if(strlen($phoneValue)!=11){
            $phoneError="* Invalid Phone number length";
        }
        else if($phoneValue[0]!=0){
            $phoneError="* Invalid Phone number";
        }
        else{
            $_SESSION['phone'] = $phoneValue;
        }

        // department validation
        if($depValue==""){
            $depError="* Department is required";
        }
        else if($depValue=="Select Department"){
            $depError="* Department is required";
        }
        else{
            $_SESSION['dep'] = $depValue;
        }
        
        // diagnosis validation
        if($diagValue==""){
            $diagError="* Diagnosis is required";
        }
        else{
            $_SESSION['diag'] = $diagValue;
        }
        
        // doctor validation
        if($doctorValue==""){
            $doctorError="* Doctor is required";
        }
        else{
            $_SESSION['doctor'] = $doctorValue;
        }

        // password validation
        if($passValue==""){
            $passError = "* Password is required";
        }
        else {
            if(strlen($passValue)<8){
                $passError = "* Password must be at least 8 characters";
            }
            else if (!preg_match('/[A-Z]/', $passValue) && !preg_match('/[a-z]/', $passValue)){
                $passError = "* Password must contain at least one uppercase letter and one lowercase letter";
            }
        }
        if($c_passValue==""){
            $c_passError =  "* Confirm Password is required";
        }
        else if ($passValue != $c_passValue){
            $c_passError = "* Password does not match";
        }

        if(isset($_FILES['img'])){
            $file_name=$_FILES['img']['name'];
            $file_size=$_FILES['img']['size'];
            $file_tmp_name=$_FILES['img']['tmp_name'];
            $file_type=$_FILES['img']['type'];
            
            $ext = "";
            $path_info = pathinfo($file_name);
            if (isset($path_info["extension"])) {
                $ext = $path_info["extension"];
            }
            $extensions= array("jpeg","jpg","png");
            
            if(in_array($ext,$extensions)=== false){
                $imgError="* please choose a JPEG or PNG file.";
            }
            if($file_size > 2097152){
                $imgError="* File size must be excately 2 MB";
            }
            if(empty($fnameError) && empty($nidError) && empty($phoneError) &&
                    empty($imgError) && empty($depError) && empty($diagError)&& 
                    empty($doctorError) && empty($passError) && empty($c_passError)){
                        if(isset($_COOKIE["doctor_id"])){
                            $sql="select patient_img from `patient` where patient_n_id=:nidValue";
                            $stmt=$con->prepare($sql);
                            $stmt->execute(['nidValue'=>$nidValue]);
                            foreach($stmt as $row){
                                unlink("../images/patient/".$row["patient_img"]);
                            }
                        }
                        else{
                            unlink("../images/patient/".$_COOKIE["patient_img"]);
                            setcookie("patient_img","",time()-3600,"/");
                            setcookie("patient_img",$file_name,time()+3600,"/");
                        }
                        
                        move_uploaded_file($file_tmp_name,"../images/patient/".$file_name);
                    $imgValue = $file_name;
            }
        }

        $_SESSION['fname'] = $fnameValue;
        $_SESSION['nid'] = $nidValue;
        $_SESSION['phone'] = $phoneValue;
        $_SESSION['dep'] = $depValue;
        $_SESSION['doctor'] = $doctorValue;
        $_SESSION['pass'] = $passValue;
        $_SESSION['c_pass'] = $c_passValue;
        if(empty($fnameError) && empty($nidError) && empty($phoneError) &&
                empty($img2Error) && empty($depError) && empty($diagError) && 
                empty($doctorError) &&  empty($passError) && empty($c_passError)){
                    if(isset($_COOKIE["patient_id"])){
                        $sql="update `department` set dep_num_patient=dep_num_patient-1 where dep_name=:depValue";
                        $stmt=$con->prepare($sql);
                        $stmt->execute(['depValue'=>$_COOKIE["patient_department"]]);
                    }
                    else if(isset($_COOKIE["doctor_id"])){
                        $sql="update `department` set dep_num_patient=dep_num_patient-1 where dep_name=:depValue";
                        $stmt=$con->prepare($sql);
                        $stmt->execute(['depValue'=>$_COOKIE["doctor_department"]]);
                    }
                    $sql="select dep_id from `department` where dep_name='$depValue'";
                    $stmt=$con->prepare($sql);
                    $stmt->execute();
                    foreach($stmt as $row){
                        $dep_id=$row['dep_id'];
                    }
                    $sql="select doctor_id from `doctor` where doctor_name='$doctorValue'";
                    $stmt=$con->prepare($sql);
                    $stmt->execute();
                    foreach($stmt as $row){
                        $doctor_id=$row['doctor_id'];
                    }
                    $sql="update `patient` 
                        set patient_name='$fnameValue',
                        patient_n_id='$nidValue',
                        patient_phone='$phoneValue',
                        patient_Diagnosis='$diagValue',
                        patient_img='$imgValue',
                        patient_dep_id='$dep_id',
                        patient_doc_id='$doctor_id'
                        where patient_n_id='$nidValue'";
                    $stmt=$con->prepare($sql);
                    $stmt->execute();

                    $sql="update `department` set dep_num_patient=dep_num_patient+1 where dep_name='$depValue'";
                    $stmt=$con->prepare($sql);
                    $stmt->execute();
                        
                    $pass_convert=md5($passValue);
                    $sql="update `user` set user_password='$pass_convert' where user_name='$nidValue'";
                    $stmt=$con->prepare($sql);
                    $stmt->execute();
                    if(isset($_COOKIE["patient_id"])){
                        setcookie("patient_national_id","",time()-3600,"/");
                        setcookie("patient_name","",time()-3600,"/");
                        setcookie("patient_phone","",time()-3600,"/");
                        setcookie("patient_diagnosis","",time()-3600,"/");
                        setcookie("patient_department","",time()-3600,"/");
                        setcookie("patient_doctor","",time()-3600,"/");

                        setcookie("patient_national_id",$nidValue,time()+3600);
                        setcookie("patient_name",$fnameValue,time()+3600);
                        setcookie("patient_phone",$phoneValue,time()+3600);
                        setcookie("patient_diagnosis",$diagValue,time()+3600);
                        setcookie("patient_department",$depValue,time()+3600);
                        setcookie("patient_doctor",$doctorValue,time()+3600);
                    }
                    if(isset($_COOKIE["doctor_id"])){
                        header('location: patient_details.php');
                        header("Refresh:0");
                        exit();
                    }
                    else{
                        header('location: profile.php');
                        header("Refresh:0");
                        exit();
                    }
        }
        else{
            $fnameValue=$_SESSION['fname'];
            $nidValue=$_SESSION['nid'];
            $phoneValue=$_SESSION['phone'];
            $depValue=$_SESSION['dep'];
            $typeOfRegisterValue=$_SESSION['typeOfRegister'];
            $timeValue=$_SESSION['time'];
            $doctorValue=$_SESSION['doctor'];
            $passValue=$_SESSION['pass'];
            $c_passValue=$_SESSION['c_pass'];
        }

    }
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update</title>
        <link rel="stylesheet" href="../CSS/register.css">
        <link rel="stylesheet" href="../CSS/bootstrap.min.css">
    </head>
    <body>
        <section class="register_form">
            <div class="container">
                <div class="row justify-content-center">
                    <form class="form col-lg-5 col-md-7 col-sm-10 col-10" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                        <h1 class="text-center">Update Information</h1>
                        <div class="form-group mb-4">
                            <label for="fname">Full Name</label>
                            <input type="text" class="form-control" id="fname" placeholder="Enter Your Full Name" name="fname" value="<?php echo $fnameValue; ?>">
                            <span class="col-12 name_error text-center mt-2"><?php echo $fnameError; ?></span>
                        </div>
                        <div class="form-group mb-4">
                            <label for="nid">National ID</label>
                            <input type="text" class="form-control" id="nid" placeholder="Enter Your National ID" name="nid" value="<?php echo $nidValue; ?>">
                            <span class="col-12 nid_error text-center mt-2"><?php echo $nidError; ?></span>
                        </div>
                        <div class="form-group mb-4">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" placeholder="Enter Your Phone number" name="phone" value="<?php echo $phoneValue; ?>">
                            <span class="col-12 phone_error text-center mt-2"><?php echo $phoneError; ?></span>
                        </div>
                        <div class="form-group mb-4">
                            <label for="img">Image</label>
                            <input type="file" class="form-control img" id="img" name="img" value="<?php echo $imgValue; ?>">
                            <span class="col-12 img_error text-center mt-2"><?php echo $imgError; ?></span>
                        </div>
                        <div class="form-group mb-4">
                            <label for="dep">Department Name</label>
                            <select class="form-select" name="depart" id="dep" value="<?php echo $depValue; ?>" 
                                onchange="
                                let select=document.getElementById('doctor_name_select');
                                let option=document.getElementById('dep').value;
                                if(option=='Bones'){
                                    select.innerHTML=
                                    `<option selected disabled>Select Doctor</option>
                                        <?php
                                            $sql='select doctor_name from `doctor` where doctor_dep_id=:dep_id';
                                            $stmt=$con->prepare($sql);
                                            $stmt->execute(['dep_id'=>1]);
                                            while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                                                echo '<option>'.$row['doctor_name'].'</option>';
                                            }
                                        ?>
                                    `;
                                }
                                else if(option=='Brain'){
                                    select.innerHTML=
                                    `<option selected disabled>Select Doctor</option>
                                        <?php
                                            $sql='select doctor_name from `doctor` where doctor_dep_id=:dep_id';
                                            $stmt=$con->prepare($sql);
                                            $stmt->execute(['dep_id'=>2]);
                                            while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                                                echo '<option>'.$row['doctor_name'].'</option>';
                                            }
                                        ?>
                                    `;
                                }
                                else if(option=='Subconscious'){
                                    select.innerHTML=
                                    `<option selected disabled>Select Doctor</option>
                                        <?php
                                            $sql='select doctor_name from `doctor` where doctor_dep_id=:dep_id';
                                            $stmt=$con->prepare($sql);
                                            $stmt->execute(['dep_id'=>3]);
                                            while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                                                echo '<option>'.$row['doctor_name'].'</option>';
                                            }
                                        ?>
                                    `;
                                }
                                else if(option=='Burns'){
                                    select.innerHTML=
                                    `<option selected disabled>Select Doctor</option>
                                        <?php
                                            $sql='select doctor_name from `doctor` where doctor_dep_id=:dep_id';
                                            $stmt=$con->prepare($sql);
                                            $stmt->execute(['dep_id'=>4]);
                                            while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                                                echo '<option>'.$row['doctor_name'].'</option>';
                                            }
                                        ?>
                                    `;
                                }
                                ">
                                <option selected disabled value="">Select Department</option>
                                    <?php 
                                        $query="SELECT dep_name FROM `department`";
                                        $result=$con->query($query);
                                        while($row=$result->fetch(PDO::FETCH_ASSOC)){
                                            echo "<option value=".$row['dep_name'].">".$row['dep_name']."</option>";
                                        }
                                    ?>
                            </select>
                            <span class="col-12 dep_error text-center mt-2"><?php echo $depError; ?></span>
                        </div>
                        <div class="form-group mb-4" id="diag">
                            <label for="diag_text">Diagnosis</label>
                            <textarea class="form-control" aria-label="With textarea" name="diag" id="diag_text"><?php echo $diagValue; ?></textarea>
                            <span class="col-12 diag_error text-center mt-2"></span>
                        </div>
                        <div class="form-group mb-4" id="doctor_name">
                            <label for="doctor">Doctor Name</label>
                            <select class="form-select" name="doctor" id="doctor_name_select">
                                <option selected disabled>Select Doctor</option>
                            </select>
                            <span class="col-12 doctor_error text-center mt-2"><?php echo $doctorError; ?></span>
                        </div>
                        <div class="form-group mb-4">
                            <label for="pass">password</label>
                            <input type="password" class="form-control" id="pass" placeholder="Enter Your Password" name="pass" value="<?php echo $passValue; ?>">
                            <span class="col-12 name_error text-center mt-2"><?php echo $passError; ?></span>
                        </div>
                        <div class="form-group mb-4">
                            <label for="c_pass">Confirm Password</label>
                            <input type="password" class="form-control" id="c_pass" placeholder="Enter Your Full Name" name="c_pass" value="<?php echo $c_passValue; ?>">
                            <span class="col-12 name_error  text-center mt-2"><?php echo $c_passError; ?></span>
                        </div>
                        <button type="submit" class="btn mt-4" name="register">Update</button>
                    </form>
                </div>
            </div>
        </section>
    <script src="../JS/bootstrap.bundle.min.js"></script>
    </body>
</html>