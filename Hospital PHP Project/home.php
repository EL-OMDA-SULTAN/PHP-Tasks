<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="images/logo.png">
        <title>Al-Hayat Hospital</title>
        <link rel="stylesheet" href="CSS/bootstrap.min.css">
        <link rel="stylesheet" href="CSS/all.css">
        <link rel="stylesheet" href="CSS/home.css">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="#"><img src="images/logo.png" alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#dep">Departments</a></li>
                        <li class="nav-item"><a class="nav-link " href="#contact">Contact</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">About Us</a></li>
                        
                    </ul>
                </div>
                <div>
                    <?php
                        if(isset($_COOKIE["type"])){
                            if( $_COOKIE["type"] != ""){
                                if($_COOKIE["type"] == "Doctor"){
                                    echo '<a href="pages/profile.php" class="profile_img" title="Profile"><img src="images/doctor/'.$_COOKIE["doctor_img"].'" alt=""></a>';
                                }
                                else if($_COOKIE["type"] == "Patient"){
                                    echo '<a href="pages/profile.php" class="profile_img" title="Profile"><img src="images/patient/'.$_COOKIE["patient_img"].'" alt=""></a>';
                                }
                            }
                        }
                        else{
                            echo '<a class="btn" href="Pages/register.php" role="button">Register</a>';
                            echo '<a href="pages/login.php" title="Login"><i class="fas fa-user"></i></a>';
                            
                        }
                    ?>
                </div>
            </div>
        </nav>
        <section class="home">
            <div class="container text-center">
                <h1><span id="text">Al-Hayat</span><span id="dot"></span>Hospital</h1>
                <h4>
                    <span class="text-slider-items">
                        Welcome to Al-Hayat Hospital, 
                        Your Trusted Healthcare Partner, 
                        We care about your well-being.
                    </span>
                    <strong class="text-slider"></strong>
                </h4>
                <a href="Pages/login.php" class="btn">Get Started</a>
            </div>
        </section>

        <section class="departments" id="dep">
            <div class="container">
                <h1 class="text-center">Departments</h1>
                <div class="row justify-content-lg-around justify-content-md-around justify-content-sm-center  justify-content-center flex-lg-row flex-md-row flex-sm-row flex-column align-items-center ">
                    <h3>1-Bones</h3>
                    <div class="col-lg-5 col-md-6 col-sm-10 col-10 dep_img">
                        <img src="images/dep 1.avif" alt="">
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-10 col-10 dep_content">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Consequuntur, voluptate facilis! Dignissimos molestias
                            voluptate facilis! Dignissimos molestias voluptate facilis!
                        </p>
                    </div>
                </div>
                <div class="row justify-content-lg-around justify-content-md-around justify-content-sm-center  justify-content-center flex-lg-row flex-md-row flex-sm-row flex-column align-items-center">
                    <h3>2-Brain</h3>
                    <div class="col-lg-5 col-md-6 col-sm-10 col-10 dep_img">
                        <img src="images/dep 2.avif" alt="">
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-10 col-10 dep_content">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Consequuntur, voluptate facilis! Dignissimos molestias
                            voluptate facilis! Dignissimos molestias voluptate facilis!
                        </p>
                    </div>
                </div>
                <div class="row justify-content-lg-around justify-content-md-around justify-content-sm-center  justify-content-center flex-lg-row flex-md-row flex-sm-row flex-column align-items-center">
                    <h3>3-Subconscious</h3>
                    <div class="col-lg-5 col-md-6 col-sm-10 col-10 dep_img">
                        <img src="images/dep 3.avif" alt="">
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-10 col-10 dep_content">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Consequuntur, voluptate facilis! Dignissimos molestias
                            voluptate facilis! Dignissimos molestias voluptate facilis!
                        </p>
                    </div>
                </div>
                <div class="row justify-content-lg-around justify-content-md-around justify-content-sm-center  justify-content-center flex-lg-row flex-md-row flex-sm-row flex-column align-items-center">
                    <h3>4-Burns</h3>
                    <div class="col-lg-5 col-md-6 col-sm-10 col-10 dep_img">
                        <img src="images/dep 4.avif" alt="">
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-10 col-10 dep_content">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Consequuntur, voluptate facilis! Dignissimos molestias
                            voluptate facilis! Dignissimos molestias voluptate facilis!
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <section class="contact" id="contact">
            <div class="container">
                <h1 class="text-center">Contact Us</h1>
                <div class="row justify-content-lg-around justify-content-md-around justify-content-sm-center  justify-content-center flex-lg-row flex-md-row flex-sm-row flex-column align-items-center">
                    <div class="col-lg-5 col-md-6 col-sm-10 col-10 d-none d-lg-block d-md-block d-sm-none">
                        <img src="images/contact.webp" alt="">
                    </div>
                    <form class="form col-lg-5 col-md-6 col-sm-10 col-10">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" class="form-control" placeholder="Your Name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" class="form-control" placeholder="Your Email">
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" class="form-control"  placeholder="Message"></textarea>
                        </div>
                        <div class="form-group text-center">
                            <input type="submit" class="btn btn-primary" value="Send">
                        </div>
                        </form>
                </div>
            </div>
        </section>
        <footer>
            <div class="container">
                <div class="row justify-content-lg-around justify-content-md-around justify-content-sm-center  justify-content-center flex-lg-row flex-md-row flex-sm-row flex-column align-items-center">
                    <div class="col-lg-3 col-md-6 col-sm-10 col-10 text-center mb-3">
                        <img src="images/logo.png" alt="logo">
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-10 col-10 mb-3">
                        <h3>Links</h3>
                        <ul class="links">
                            <li><a href="login.php">login</a></li>
                            <li><a href="register.php">Register</a></li>
                            <li><a href="#home">Home</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-10 col-10 mb-3">
                        <h3>Follow Us</h3>
                        <ul class="social">
                            <li><a href="https://www.facebook.com"><i class="fab fa-facebook"></i></a></li>
                            <li><a href="https://twitter.com"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="https://www.instagram.com"><i class="fab fa-instagram"></i></a></li>
                        </ul>
                </div>
            </div>
        </footer>

        <!-- // java scripts -->
        <script src="JS/bootstrap.bundle.min.js"></script>
        <script src="JS/typed.js-main/dist/typed.umd.js"></script>
        <script src="JS/jquery-3.7.1.js"></script>
        <script>
            if ($(".text-slider").length == 1) {
                var typed_strings = $(".text-slider-items").text();
                var typed = new Typed(".text-slider", {
                    strings: typed_strings.split(", "),
                    typeSpeed: 90,
                    loop: true,
                    backDelay: 900,
                    backSpeed: 60,
                });
            }
        </script>
    </body>
</html>