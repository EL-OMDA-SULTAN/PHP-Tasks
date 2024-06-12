<?php 
    $DB_Host="localhost";
    $DB_Username="root";
    $DB_Password="omda732";
    $DB_Name="phpcon";

    $con=new mysqli($DB_Host,$DB_Username,$DB_Password,$DB_Name);

    if(!$con->connect_error){
        // die("Connection failed: ".$con->connect_error);

        // create table

        // $query="create table courses if not exists(
        //     id int not null auto_increment primary key,
        //     name varchar(255) not null,
        //     description varchar(255) not null,
        //     price int not null
        // )";
        // $res=$con->query($query);

        // insert data

        // $query="insert into courses(name, description, price) 
        //         values('php', 'Learn php', 100)";
        // $query="insert into courses(name, description, price) 
        //         values('js', 'Learn js', 500)";
        // $query="insert into courses(name, description, price) 
        //         values('python', 'Learn python', 200)";
        // $res=$con->query($query);

        // update data

        // $query="update courses set name='php_new' where id=1";
        // $res=$con->query($query);

        // delete data

        // $query="delete from courses where id=2";
        // $res=$con->query($query);

        // select data

        // $query="select * from courses";
        // $res=$con->query($query);
        // while($row=$res->fetch_assoc()){
        //     echo "<table border='1'>";
        //     echo $row['id']." ".$row['name']." ".$row['description']." ".$row['price']."<br>";
        // }

    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>OOP</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="../Bootstrap & Font Awsome/CSS/bootstrap.min.css">
    </head>
    <body>
        <h1>This is mysql ( OOP ) Connection</h1>
        <section>
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-md-8 col-lg-6 col-sm-10 col-10">
                        <table>
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $query="select * from courses";
                                    $res=$con->query($query);
                                    while($row=$res->fetch_assoc()){
                                        echo "<tr>";
                                        echo "<th scope='row'>". $row['id'] . "</th>";
                                        echo "<td>". $row['name'] . "</td>";
                                        echo "<td>". $row['description'] . "</td>";
                                        echo "<td>". $row['price'] . "</td>";
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

<?php $con->close(); ?>