<?php
const HOST_NAME = "localhost";
const USER_NAME = "root";
const PASSWORD = "omda732";
const DB_NAME = "phpcon";

$con = mysqli_connect(HOST_NAME, USER_NAME, PASSWORD, DB_NAME,3306);
// var_dump($con);
if ($con) {
        // Create Table
    // $query="create table if not exists `student`( 
    //     id int not null auto_increment primary key,
    //     name varchar(255) not null,
    //     email varchar(255) not null,
    //     phone varchar(255) not null
    // )";
    // $res=mysqli_query($con, $query);
    // var_dump($res);

    // Insert Data
    // $query="insert into `student`(name, email, phone) 
    //         values('omda', 'elomdasultan@gmail.com', '01015570762')";
    // $res=mysqli_query($con, $query);
    // $query="insert into `student`(name, email, phone) 
    //         values('ali', 'ali@gmail.com', '015577062')";
    // $res=mysqli_query($con, $query);
    // $query="insert into `student`(name, email, phone) 
    //         values('saad', 'saad@gmail.com', '012577062')";
    // $res=mysqli_query($con, $query);
    // var_dump($res);

    // Update Data
    // $query="update `student` set name='ali_mohamed' where id=2";
    // $res=mysqli_query($con, $query);

    // Delete Data
    // $query="delete from `student` where id=3";
    // $res=mysqli_query($con, $query);

    // // Select Data
    // $query="select * from `student`";
    // $res=mysqli_query($con, $query);
    // echo "<table border='1'>";
    // echo "<tr>
    //     <th>ID</th>
    //     <th>Name</th>
    //     <th>Email</th>
    //     <th>Phone</th>
    //     </tr>";
    // while($row = mysqli_fetch_assoc($res)){
    //     echo "<tr>";
    //     echo "<td>{$row['id']}</td>";
    //     echo "<td>{$row['name']}</td>";
    //     echo "<td>{$row['email']}</td>";
    //     echo "<td>{$row['phone']}</td>";
    //     echo "</tr>";
    // }

}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>mysqli</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="../Bootstrap & Font Awsome/CSS/bootstrap.min.css">
    </head>
    <body>
        <h1>This is mysqli ( Procedural ) Connection</h1>
        <section>
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-md-9 col-lg-7 col-sm-12 col-12">
                        <table>
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $query="select * from `student`";
                                    $res=mysqli_query($con, $query);
                                    while($row = mysqli_fetch_assoc($res)){
                                        echo "<tr>";
                                        echo "<th scope='row'>". $row['id'] . "</th>";
                                        echo "<td>". $row['name'] . "</td>";
                                        echo "<td>". $row['email'] . "</td>";
                                        echo "<td>". $row['phone'] . "</td>";
                                        echo "</tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <script src="../Bootstrap & Font Awsome/JS/bootstrap.bundle.min.js"></script>
    </body>
</html>
<?php 
    mysqli_close($con);
?>