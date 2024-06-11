<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My Info</title>
        <link rel="stylesheet" href="CSS/info.css">
        <link rel="stylesheet" href="../Bootstrap & Font Awsome/CSS/bootstrap.min.css">
    </head>
    <body>
        <section class="info">
            <div class="container">
                <h1>Hello,
                    <?php
                        $fname= explode(" ",$_COOKIE['fname'])[0];
                        echo "<span>".strtoupper($fname)."</span>"; ?>
                </h1>
                <p>This is your information</p>
                <div class="row  justify-content-lg-around justify-content-md-around justify-content-sm-center flex-sm-column flex-lg-row flex-md-row align-items-center flex-column">
                    <div class="col-sm-6 col-md-5 col-lg-3 col-6">
                        <img src="<?php echo "files/".$_COOKIE['img']; ?>" alt="">
                    </div>
                    <div class="col-sm-10 col-md-6 col-lg-7 mt-sm-5">
                        <ul>
                            <li>Name : <span><?php echo $_COOKIE['fname']; ?></span></li>
                            <li>Email : <span><?php echo $_COOKIE['email']; ?></span> </li>
                            <li>Date of Birth : <span><?php echo str_replace('-', ' / ', $_COOKIE['date']); ?></span> </li>
                            <li>Address : <span><?php echo ucfirst($_COOKIE['address']); ?> </span></li>
                            <!-- <li>password: <span><?php echo md5($_COOKIE['password']); ?></span></li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <script src="../Bootstrap & Font Awsome/JS/bootstrap.bundle.min.js"></script>
    </body>
</html>
<?php 

?>