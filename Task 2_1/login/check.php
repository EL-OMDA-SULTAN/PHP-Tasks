<?php 
    $username = $_GET['username'];
    $password = $_GET['password'];
    
    $file = fopen ('../files/users.txt', 'r');
    $x=0;
    while (!feof($file)) {
        $line=fgets($file);
        $data=explode('_',$line);
        $user_name=$data[0];
        $user_password=$data[1];
        if($username == $user_name && $password == $user_password){
            global $x;
            $x=1;
            header('Location: ../home.php');
            break;
        }
    }
    if($x==0){
        header('Location: login.php');
    }
    fclose ($file);
?> 