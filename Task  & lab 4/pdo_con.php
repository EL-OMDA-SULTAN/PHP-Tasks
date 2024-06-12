<?php

    $dsn = "mysql:host=localhost;dbname=phpcon";
    $user = "root";
    $pass = "omda732";

    $pdo = new PDO($dsn, $user, $pass);
    //create query
    // $query = "create table if not exists users(
    //         id int(11) not null auto_increment primary key,
    //         name varchar(255) not null,
    //         email varchar(255) not null, 
    //         password varchar(255) not null
    //     )";

    // $pdo->exec($query);

    // insert data
    // $query = "insert into users(name, email, password) 
    //         values('omda', 'omda@gmail.com', 'omda123')";
    // $query = "insert into users(name, email, password) 
    //         values('ali', 'ali@gmail.com', 'ali456')";
    // $query = "insert into users(name, email, password) 
    //         values('mohamed', 'mohamed@gmail.com', 'mohamed789')";
    // $pdo->exec($query);

    // update data
    // $query = "update users set name = 'mo_new' where id = ?";
    // $stmt = $pdo->prepare($query);
    // $stmt->execute([1]);
    
    // $query = "update users set name = 'omda', email = 'omda@gmail', password = 'omda123' where id = ?";
    // $stmt = $pdo->prepare($query);
    // $stmt->execute([3]);

    // delete data
    // $query = "delete from users where id = :id";
    // $stmt = $pdo->prepare($query);
    // $id=2;
    // $stmt->bindParam(':id', $id);
    // $stmt->execute();
    // echo $stmt->rowCount() . " row deleted";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PDO</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="../Bootstrap & Font Awsome/CSS/bootstrap.min.css">
    </head>
    <body>
        <h1>This is PDO connection</h1>

        <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-md-9 col-lg-7 col-sm-12 col-12">
                        <table>
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Password</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $query = "select * from users";
                                    $stmt = $pdo->query($query);
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<tr>";
                                        echo "<th>" . $row['id'] . "</th>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['password'] . "</td>";
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
$pdo = null;

?>