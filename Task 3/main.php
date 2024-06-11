<?php
    session_start();
    // Define variables to hold form field values and error messages
    $fnameValue = $emailValue = $dateValue = $addressValue = $imgValue =
    $passwordValue = $c_passwordValue = $fnameError= $emailError = $dataError =
    $addressError = $imgError = $passwordError = $c_passwordError = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $fnameValue = $_POST['fname'];
        $emailValue = $_POST['email'];
        $dateValue = $_POST['date'];
        $addressValue = $_POST['address'];
        $passwordValue = $_POST['password'];
        $c_passwordValue = $_POST['c-password'];

        $pat_name="/^[a-zA-Z\s]+$/";
        $pat_email="/\.com$/";

        if($fnameValue==""){
            $fnameError="Name is required";
        }
        else if(trim($fnameValue)==""){
            $fnameError="Name is required";
        }
        else if(!preg_match($pat_name, $fnameValue)){
            $fnameError="Invalid Name only alphabets";
        }
        else{
            $_SESSION['fname'] = $fnameValue;
        }

        if($emailValue==""){
            $emailError="Email is required";
        }
        else if(!preg_match($pat_email, $emailValue)){
            $emailError=  "Invalid Email";
        }
        else{
            $_SESSION['email'] = $emailValue;
        }

        if($dateValue==""){
            $dataError ="Date is required";
        }
        else{
            $_SESSION['date'] = $dateValue;
        }

        if($addressValue==""){
            $addressError =  "Address is required";
        }
        else if(trim($addressValue)==""){
            $addressError =  "Address is required";
        }
        else{
            $_SESSION['address'] = $addressValue;
        }

        if($passwordValue==""){
            $passwordError = "Password is required";
        }
        else {
            if(strlen($passwordValue)<8){
                $passwordError = "Password must be at least 8 characters";
            }
            else if (!preg_match('/[A-Z]/', $passwordValue) && !preg_match('/[a-z]/', $passwordValue)){
                $passwordError = "Password must contain at least one uppercase letter and one lowercase letter";
            }
        }
        if($c_passwordValue==""){
            $c_passwordError =  "Confirm Password is required";
        }
        else if ($passwordValue != $c_passwordValue){
            $c_passwordError = "Password does not match";
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
                $imgError="please choose a JPEG or PNG file.";
            }
            if($file_size > 2097152){
                $imgError="File size must be excately 2 MB";
            }
            if(empty($fnameError) && empty($emailError) && 
                empty($dataError) && empty($addressError) && empty($imgError)
                && empty($passwordError) && empty($c_passwordError)){
                move_uploaded_file($file_tmp_name,"files/".$file_name);
                setcookie('img', $file_name, time() + (86400 * 30), "/");
            }
        }
        $_SESSION['fname'] = $fnameValue;
        $_SESSION['email'] = $emailValue;
        $_SESSION['date'] = $dateValue;
        $_SESSION['address'] = $addressValue;
        $_SESSION['password'] = $passwordValue;
        $_SESSION['c_password'] = $c_passwordValue;

        // echo $_SESSION['fname'];
        // echo $_SESSION['email'];
        // echo $_SESSION['date'];
        // echo $_SESSION['address'];
        // echo $_SESSION['password'];
        // echo $_SESSION['c_password'];

        if(empty($fnameError) && empty($emailError) && 
            empty($dataError) && empty($addressError) && empty($imgError)
            && empty($passwordError) && empty($c_passwordError)){
                header("Location: info.php");
                setcookie('fname', $fnameValue, time() + (86400 * 30), "/");
                setcookie('email', $emailValue, time() + (86400 * 30), "/");
                setcookie('date', $dateValue, time() + (86400 * 30), "/");
                setcookie('address', $addressValue, time() + (86400 * 30), "/");
                setcookie('password', $passwordValue, time() + (86400 * 30), "/");
                setcookie('c_password', $c_passwordValue, time() + (86400 * 30), "/");
                exit();
        }
        else{
            $fnameValue=$_SESSION['fname'];
            $emailValue=$_SESSION['email'];
            $dateValue=$_SESSION['date'];
            $addressValue=$_SESSION['address'];
            $passwordValue=$_SESSION['password'];
            $c_passwordValue=$_SESSION['c_password'];
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Page</title>
        <link rel="stylesheet" href="CSS/main.css">
        <link rel="stylesheet" href="../Bootstrap & Font Awsome/CSS/bootstrap.min.css">
    </head>
    <body>
        <section class="login_form">
            <div class="container">
                <div class="row justify-content-center">
                    <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="col-sm-10 col-md-8 col-lg-6 col-10" enctype="multipart/form-data">
                        <h1>LogIn</h1>
                        <div class="row mb-4 justify-content-center">
                            <label for="fname" class="col-3 form-label">Full Name</label>
                            <div class="col-8">
                                <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $fnameValue; ?>">
                            </div>
                            <span class="col-12 name_error text-danger text-center mt-2"><?php echo $fnameError; ?></span>
                        </div> 
                        
                        <div class="row mb-4 justify-content-center">
                            <label for="email" class="col-3 form-label">Email</label>
                            <div class="col-8">
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $emailValue; ?>">
                            </div>
                            <span class="col-12 email_error text-danger text-center mt-2"><?php echo $emailError; ?></span>
                        </div>
                        <div class="row mb-4 justify-content-center">
                            <label for="date" class="col-3 form-label">Date of Birth</label>
                            <div class="col-8">
                                <input type="date" class="form-control" id="date" name="date" value="<?php echo $dateValue; ?>">
                            </div>
                            <span class="col-12 date_error text-danger text-center mt-2"><?php echo $dataError; ?></span>
                        </div>
                        <div class="row mb-4 justify-content-center">
                            <label for="address" class="col-3 form-label">Address</label>
                            <div class="col-8">
                                <input type="text" class="form-control" id="address" name="address" value="<?php echo $addressValue; ?>">
                            </div>
                            <span class="col-12 address_error text-danger text-center mt-2"><?php echo $addressError; ?></span>
                        </div>
                        <div class="row mb-4 justify-content-center">
                            <label for="img" class="col-3 form-label">Photo</label>
                            <div class="col-8">
                                <input type="file" class="form-control " id="img" name="img" value="<?php echo $imgValue; ?>">
                            </div>
                            <span class="col-12 img_error text-danger text-center mt-2"><?php echo $imgError; ?></span>
                        </div>
                        <div class="row mb-4 justify-content-center">
                            <label for="password" class="col-3 form-label">Password</label>
                            <div class="col-8">
                                <input type="password" class="form-control" id="password" name="password" value="<?php echo $passwordValue; ?>">
                                <span class="col-12 password_error text-danger text-center mt-2"><?php echo $passwordError; ?></span>
                            </div>
                        </div>
                        <div class="row mb-4 justify-content-center">
                            <label for="c-password" class="col-3 form-label">Confirm Password</label>
                            <div class="col-8">
                                <input type="password" class="form-control" id="c-password" name="c-password" value="<?php echo $c_passwordValue; ?>">
                                <span class="col-12 c-password_error text-danger text-center mt-2"><?php echo $c_passwordError; ?></span>
                            </div>
                        </div>
                        <input type="submit" name="submit" id="submit" value="LogIn" class="btn mb-4" >
                    </form>
                </div>
            </div>
        </section>
    <script src="../Bootstrap & Font Awsome/JS/bootstrap.bundle.min.js"></script>
    </body>
</html>