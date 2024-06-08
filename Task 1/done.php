<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Form Output</title>
        <link rel="stylesheet" href="CSS/style.css">
        <link rel="stylesheet" href="../Bootstrap & Font Awsome/CSS/bootstrap.min.css">
        <link rel="stylesheet" href="../Bootstrap & Font Awsome/CSS/all.css">
    </head>
    <body style="background-color: cadetblue;">
        <section class="output">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-7 col-sm-10 info">
                        <h2>Thanks
                            <?php if($_GET['gender'] == "male") echo 'Mr / ' . $_GET['fname'] .' ' . $_GET['lname'];
                            else echo 'Ms / ' . $_GET['fname'] . ' ' . $_GET['lname'];?>
                        </h2>
                        <h4 class="info_text">please review your information</h4>
                    <p><b><u>Name</u></b><?php echo ' : '.$_GET['fname'] . ' ' . $_GET['lname'];  ?></p>
                    <p><b><u>Address</u></b><?php echo ' : '.$_GET['address'];  ?></p>
                    <p><b><u>Your Skills</u></b>
                    <?php $x=1;
                        echo '<br>';
                        foreach ($_GET['skill'] as $skill) {
                            echo "<span> $x - $skill  <br></span>";
                            $x++;
                        }?></p>
                    <p><b><u>Department</u></b><?php echo ' : '.$_GET['Department'];  ?></p>
                    </div>
                </div>
            </div>
        </section>
        
        <script src="../Bootstrap & Font Awsome/JS/bootstrap.bundle.min.js"></script>
    </body>
</html>