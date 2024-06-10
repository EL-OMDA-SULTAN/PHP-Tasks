<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home Page</title>
        <link rel="stylesheet" href="CSS/home.css">
        <link rel="stylesheet" href="../Bootstrap & Font Awsome/CSS/bootstrap.min.css">
    </head>
    <body>

    <section class="student_info">
        <div class="container">
            <h1>Hello, Let's Know Students Degree</h1>
            <div class="row">
                <div class="col-12 st_btn text-center">
                    <button class="btn btn1" name="btn1" onclick="
                    let div=document.querySelector('.st_degree');
                    div.innerHTML=
                        ` 
                            <table style=''>
                                <thead>
                                    <tr style='text-align: center; padding: 10px ;'>
                                        <th scope='col'>N</th>
                                        <th scope='col'>Name</th>
                                        <th scope='col'>level</th>
                                        <th scope='col'>Math</th>
                                        <th scope='col'>Science</th>
                                        <th scope='col'>English</th>
                                        <th scope='col'>Arabic</th>
                                        <th scope='col'>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $x=1;
                                        $file = fopen ('files/students.txt', 'r');
                                        while (!feof($file)) {
                                            $line=fgets($file);
                                            $data=explode('-',$line);
                                                echo '<tr>';
                                                echo '<th>'.$x.'</th>';
                                                echo '<td>'.$data[0].'</td>';
                                                echo '<td>'.$data[1].'</td>';
                                                echo '<td>'.$data[2].'</td>';
                                                echo '<td>'.$data[3].'</td>';
                                                echo '<td>'.$data[4].'</td>';
                                                echo '<td>'.$data[5].'</td>';
                                                echo '<td>'.($data[2]+$data[3]+$data[4]+ $data[5]).'</td>';
                                                echo '</tr>';
                                                $x++;
                                            };
                                        fclose ($file); ?>
                                </tbody>
                            </table>
                        `;
                    ">Show </a></button>
                    <button class="btn btn2" name="btn2" 
                        onclick="
                            let div=document.querySelector('.st_degree');
                            div.innerHTML='';
                        ">
                    Hide</a></button>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-9 col-sm-12 st_degree">
                </div>
            </div>
        </div>
    </section>


    <section class="student_info_two">
        <div class="container">
            <h1>Top Student In Each Level</h1>
            <div class="row">
                <div class="col-12 st_btn text-center">
                    <button class="btn btn1" name="btn1" onclick="
                    let div=document.querySelector('.st_two');
                    div.innerHTML=
                        ` 
                            <table style=''>
                                <thead>
                                    <tr style='text-align: center; padding: 10px ;'>
                                        <th scope='col'>N</th>
                                        <th scope='col'>Name</th>
                                        <th scope='col'>level</th>
                                        <th scope='col'>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $x=1;
                                        $file = fopen ('files/students.txt', 'r');
                                        for ($i=1; $i<=4; $i++) {
                                            $max=0;
                                            fseek($file,0);
                                            while (!feof($file)) {
                                                $line=fgets($file);
                                                $data=explode('-',$line);
                                                if ($data[1]==$i) {
                                                    if ($data[2]+$data[3]+$data[4]+ $data[5]>$max) {
                                                        $max=$data[2]+$data[3]+$data[4]+ $data[5];
                                                        $max_name=$data[0];
                                                    }
                                                }
                                            }
                                            echo '<tr>';
                                            echo '<th>'.$x.'</th>';
                                            echo '<td>'.$max_name.'</td>';
                                            echo '<td>'.$i.'</td>';
                                            echo '<td>'.$max.'</td>';
                                            echo '</tr>';
                                            $x++;
                                        }
                                        fclose ($file); ?>
                                </tbody>
                            </table>
                        `;
                    ">Show </a></button>
                    <button class="btn btn2" name="btn2" 
                        onclick="
                            let div=document.querySelector('.st_two');
                            div.innerHTML='';
                        ">
                    Hide</a></button>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-9 col-sm-12 st_two">
                </div>
            </div>
        </div>
    </section>
    <!-- <hr class="line"> -->

    <!-- <section class="search">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-9 col-sm-12 mb-4">
                    <input type="text" name="search" id="search" class="form-control text-center fs-5" placeholder="Enter student Name" >
                </div>
                <div class="col-lg-7 col-md-9 col-sm-12 text-center mb-4">
                    <button class="btn btn3">Search</button>
                </div>
                <div class="col-lg-7 col-md-9 col-sm-12 text-center mb-4">
                    <div class="not_found">

                    </div>
                </div>
            </div>
        </div>
    </section> -->
        <script src="../Bootstrap & Font Awsome/JS/bootstrap.bundle.min.js"></script>
    </body>
</html>