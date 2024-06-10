<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Page</title>
        <link rel="stylesheet" href="../CSS/login.css">
        <link rel="stylesheet" href="../../Bootstrap & Font Awsome/CSS/bootstrap.min.css">
    </head>
    <body>
        <section class="login_form">
            <div class="container">
                <div class="row justify-content-center">
                    <form action="check.php" method="GET" class="col-sm-10 col-md-8 col-lg-6 col-10">
                        <h1>LogIn</h1>
                        <div class="row mb-4 justify-content-center">
                            <label for="username" class="col-3 form-label">Username</label>
                            <div class="col-8">
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                        </div>
                        <div class="row mb-4 justify-content-center">
                            <label for="password" class="col-3 form-label">Password</label>
                            <div class="col-8">
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                        </div>
                        <input type="submit" name="submit" id="submit" value="LogIn" class="btn" >
                    </form>
                </div>
            </div>
        </section>
    <script src="../../Bootstrap & Font Awsome/JS/bootstrap.bundle.min.js"></script>
    </body>
</html>