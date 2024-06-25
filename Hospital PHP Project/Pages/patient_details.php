<?php
    $DB_user = "root";
    $DB_pass = "omda732";
    $con=new PDO("mysql:host=localhost;dbname=hospital",$DB_user,$DB_pass);
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
    $nidValue=$nidError="";
    if(isset($_POST["delete"])){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
        $nidValue=$_POST["nid"];
        if(empty($nidValue)){
            $nidError="* Enter National ID";
        }
        else if(strlen($nidValue)!=14){
            $nidError="* Enter 14 digits National ID";
        }
        else{
            $sql="select patient_n_id from `patient` where patient_n_id=:patient_n_id";
            $stmt=$con->prepare($sql);
            $stmt->bindParam(':patient_n_id',$nidValue);
            $stmt->execute();
            if($stmt->rowCount()==0){
                $nidError="* National ID doesn't exist";
            }
        }
        if($nidError==""){
            $sql="select patient_img from `patient` where patient_n_id=:patient_n_id";
            $stmt=$con->prepare($sql);
            $stmt->bindParam(':patient_n_id',$nidValue);
            $stmt->execute();
            foreach($stmt as $row){
                $img=$row["patient_img"];
            }
            unlink("../images/patient/".$img);

            $sql="select patient_dep_id from `patient` where patient_n_id=:patient_n_id";
            $stmt=$con->prepare($sql);
            $stmt->bindParam(':patient_n_id',$nidValue);
            $stmt->execute();
            foreach($stmt as $row){
                $dep_id=$row["patient_dep_id"];
            }
            $sql="update `department` set dep_num_patient=dep_num_patient-1 where dep_id=:dep_id";
            $stmt=$con->prepare($sql);
            $stmt->bindParam(':dep_id',$dep_id);
            $stmt->execute();
            
            $sql="delete from `patient` where patient_n_id=:patient_n_id";
            $stmt=$con->prepare($sql);
            $stmt->bindParam(':patient_n_id',$nidValue);
            $stmt->execute();

            $sql="delete from `user` where user_name=:user_n_id";
            $stmt=$con->prepare($sql);
            $stmt->bindParam(':user_n_id',$nidValue);
            $stmt->execute();

            header("Location: patient_details.php");
        }
    }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile</title>
        <link rel="stylesheet" href="../CSS/bootstrap.min.css">
        <link rel="stylesheet" href="../CSS/profile.css">
        <link rel="stylesheet" href="../CSS/patient_details.css">
    </head>
    <body>
        <nav class="navbar navbar-expand">
            <div class="container justify-content-center">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="../home.php">Home</a></li>
                    <?php 
                        if($_COOKIE["type"]=="Doctor"){
                            echo '<li class="nav-item"><a class="nav-link active" href="patient_details.php">P_Details</a></li>';
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
        <section class="patient-details" >
            <div class="container" >
                <h2>Patient Details</h2>
                <div class="row row mb-2 justify-content-center" >
                    <div id="print col-12">
                    <?php
                    $sql="select dep_num_patient,dep_id from `department` where dep_name=:dep_name";
                    $stmt=$con->prepare($sql);
                    $stmt->bindParam(":dep_name",$_COOKIE["doctor_department"]);
                    $stmt->execute();
                    foreach($stmt as $row){
                        $dep_id=$row["dep_id"];
                        if($row["dep_num_patient"]>0){
                            $sql="select * from patient where patient_dep_id={$dep_id}";
                            $stmt=$con->prepare($sql);
                            $stmt->execute();
                            $x=1;
                            echo "<div class='table-responsive' id='print'>";
                            echo "<table class='table table-striped table-bordered patient_table table-striped' id='patient_table print'>";
                            echo "<thead><tr><th>N</th><th>Patient Image</th><th>Patient Name</th>
                                    <th>Patient National ID</th><th>Patient Phone</th>
                                    <th>Patient Diagnosis</th><th>Patient Doctor</th></tr></thead><tbody>";
                            foreach($stmt as $row){
                                echo "<tr>";
                                echo "<td>{$x}</td>";
                                $x++;
                                echo "<td><img class='patient_image ' src='../images/patient/{$row["patient_img"]}' alt='patient_image'></td>";
                                echo "<td><span class='patient_name'>{$row["patient_name"]}</span></td>";
                                echo "<td><span class='patient_national_id'>{$row["patient_n_id"]}</span></td>";
                                echo "<td><span class='patient_phone'>{$row["patient_phone"]}</span></td>";
                                echo "<td><span class='patient_Diagnosis'>{$row["patient_Diagnosis"]}</span></td>";
                                $sql2 = "SELECT doctor_name FROM doctor WHERE doctor_id={$row["patient_doc_id"]}";
                                $stmt2 = $con->prepare($sql2);
                                $stmt2->execute();
                                foreach($stmt2 as $row2){
                                    echo "<td><span class='patient_doctor'>{$row2["doctor_name"]}</span></td>";
                                }
                                echo "</tr>";
                            }
                            echo "</tbody></table>";
                            echo "</div>";
                        }
                        else{
                            echo "<div class='patient_non'>\" No Patient Found \"</div>";
                        }
                        echo "<div class='btn_group text-center exclude-print'>";
                        echo "<button class='btn btn-success'><a href='register.php'>Insert</a></button>
                                <button class='btn btn-primary'><a href='update.php'>Update</a></button>
                                <button class='btn btn-danger delete' onclick='deletePatient()'>Delete</button>
                                <button class='btn btn-secondary' onclick=\"printElement('print')\">Print</button></div>";

                    }
                ?>
                </div>
                </div>
            </div>
        </section>
        <div class="over">
            <div class="container">
                <div class="row justify-content-center">
                    <form method="POST" class="form col-lg-5 col-md-7 col-sm-10 col-10" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <h1 class="text-center">Patient Delete</h1>
                        <div class="form-group mb-4">
                            <label for="nid" class="form-label mb-2">National ID</label>
                            <input type="text" class="form-control" id="nid" placeholder="Enter Patient National ID" name="nid" value="<?php echo $nidValue; ?>">
                            <span class="col-12 nid_error text-danger text-center mt-2"><?php echo $nidError; ?></span>
                        </div>
                        <div class="btn_group">
                            <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                            <button type="submit" class="btn btn-primary" name="cancel">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="../JS/bootstrap.min.js"></script>
        <script>
            function deletePatient(){
                document.querySelector(".over").style.display="block";
            }
            function printElement(elementId) {
                var printContents = document.getElementById(elementId).innerHTML;
                var originalContents = document.body.innerHTML;
                var printWindow = window.open('', '', 'height=600,width=800');
                printWindow.document.write('<html><head><title>Patient Details</title>');
                printWindow.document.write(`<style>
                                        body{
                                            font-family: sans-serif;
                                            background-color:#061b39b4;
                                        }
                                        table {
                                            border: 2px solid black !important;
                                            margin: auto;
                                            width: 90%;
                                        }
                                        table img{
                                            width: 100px;
                                            height: 100px;
                                            object-fit: cover;
                                            border-radius: 50%;
                                            box-shadow: 0 0 10px black;
                                        }

                                        table th{
                                            background-color: #0e6e9f !important;
                                            color: white !important;
                                            text-shadow: 0 0 5px black !important;
                                            border: 2px solid black !important;
                                            text-align: center;
                                        }

                                        table td{
                                            border: 2px solid black !important;
                                            text-align: center;
                                            font-size: 18px;
                                            font-weight: 500;
                                            align-content: center;
                                            color: white;
                                        }
                                            h1{
                                                color: white;
                                                text-align: center;
                                                text-shadow: 0 0 5px black;
                                                margin-bottom: 50px;

                                            }
                                        </style>`);
                printWindow.document.write('</head><h1>Patient Details</h1><body>');
                var elementsToExclude = document.querySelectorAll('.exclude-print');
                    elementsToExclude.forEach(function(item) {
                    printContents = printContents.replace(item.outerHTML, '');
                    });
                printWindow.document.write(printContents);
                printWindow.document.write('</body></html>');
                printWindow.document.close();
                printWindow.print();
            }
        </script>
    </body>
</html>