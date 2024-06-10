<?php
    $user=$_GET['username'];
    $pass=$_GET['password'];

    $file=fopen('../files/users.txt','a');
    fwrite($file,$user.'_'.$pass."\n");
    fclose($file);
    header('Location: ../login/login.php');
?>