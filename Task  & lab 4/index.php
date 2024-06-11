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

    // Select Data
    $query="select * from `student`";
    $res=mysqli_query($con, $query);
    echo "<table border='1'>";
    echo "<tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        </tr>";
    while($row = mysqli_fetch_assoc($res)){
        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td>{$row['name']}</td>";
        echo "<td>{$row['email']}</td>";
        echo "<td>{$row['phone']}</td>";
        echo "</tr>";
    }

}
else{
    echo "Connection Failed";
}
?>
