<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Task 1 PHP</title>
        <link rel="stylesheet" href="../Bootstrap & Font Awsome/CSS/bootstrap.min.css">
        <link rel="stylesheet" href="../Bootstrap & Font Awsome/CSS/all.css">
        <link rel="stylesheet" href="CSS/style.css">
    </head>
    <body>
        <section class="form">
            <div class="container">
                <div class="row justify-content-center">
                    <form action="done.php" method="GET" class="col-sm-10 col-md-8 col-lg-6 col-10">
                        <div class="row mb-4">
                            <label for="fname" class="col-3 form-label">First Name</label>
                            <div class="col-8">
                                <input type="text" class="form-control" id="fname" name="fname" required>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="lname" class="col-3 form-label">Last Name</label>
                            <div class="col-8">
                                <input type="text" class="form-control" id="lname" name="lname" required>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="address" class="col-3 form-label">Address</label>
                            <div class="col-8">
                                <textarea name="address" id="address" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="country" class="col-3 form-label">Country</label>
                            <div class="col-8">
                                <select name="country" id="country" class="form-select" required>
                                    <option value="bangladesh" selected disabled>Select Country</option>
                                    <option value="Egypt" name="Egypt">Egypt</option>
                                    <option value="india" name="india">India</option>
                                    <option value="pakistan" name="pakistan">Pakistan</option>
                                    <option value="korea" name="korea">korea</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="address" class="col-3 form-label">Gender</label>
                            <div class="col-8">
                                    <input class="form-check-input" type="radio" name="gender" id="male" value="male" required>
                                    <label class="form-check-label me-sm-3 me-lg-5 me-md-5" for="male">Male</label>
                                    <input class="form-check-input" type="radio" name="gender" id="female" value="female" required>
                                    <label class="form-check-label" for="female">Female</label>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="address" class="col-3 form-label">Skills</label>
                            <div class="col-8">
                                <div class="row ms-1">
                                    <div class="form-check col-lg-4 col-6">
                                        <input class="form-check-input" type="checkbox" id="php" name="skill[]" value="php" required>
                                        <label class="form-check-label" for="php">PHP</label>
                                    </div>
                                    <div class="form-check col-lg-4 col-6">
                                        <input class="form-check-input" type="checkbox" id="J2SE" name="skill[]" checked value="J2SE" >
                                        <label class="form-check-label" for="J2SE">J2SE</label>
                                    </div>
                                </div>
                                <div class="row ms-1">
                                    <div class="form-check col-lg-4 col-6">
                                        <input class="form-check-input" type="checkbox" id="MySQL" name="skill[]" checked value="MySQL" >
                                        <label class="form-check-label" for="MySQL">MySQL</label>
                                    </div>
                                    <div class="form-check col-lg-4 col-6">
                                        <input class="form-check-input" type="checkbox" id="PostgreeSQL" name="skill[]" value="PostgreeSQL" >
                                        <label class="form-check-label" for="PostgreeSQL">PostgreeSQL</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="uname" class="col-3 form-label">User Name</label>
                            <div class="col-8">
                                <input type="text" class="form-control" id="uname" name="uname" required>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="password" class="col-3 form-label">Password</label>
                            <div class="col-8">
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="Department" class="col-3 form-label">Department</label>
                            <div class="col-8">
                                <input type="text" class="form-control" id="Department" name="Department" value='Open Source' readonly>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="" class="col-3 form-label"></label>
                            <div class="col-4 text-center">
                                <label for="" class="form-label text-center" id="code_label">Eh345o</label>
                                <input type="text" class="form-control" id="code_input" name="code" required>
                            </div>
                            <div class="col-4 align-self-center">
                                <label for="">please Insert the code in the below box</label>
                            </div>
                        </div>
                        <div class="form_btn">
                            <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary">
                            <input type="reset" name="reset" id="reset" value="Reset" class="btn btn-danger">
                        </div>
                        
                    </form>
                </div>
            </div>
        </section>
        <script src="../Bootstrap & Font Awsome/JS/bootstrap.bundle.min.js"></script>
        <script src="JS/code.js"></script>
    </body>
</html>