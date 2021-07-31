<?php
$exists = false;
$showAlert = false;
$showError = false;

if($_SERVER['REQUEST_METHOD']=='POST'){
    include 'dbconnect.php';
    

    $email=$_POST['email'];
    $password=$_POST['password'];
    $cpassword=$_POST['cpassword'];

    $existSql = "SELECT * FROM `users` WHERE `user_email` LIKE  '$email'";
    
    $result = mysqli_query($conn,$existSql);
   

    $num = mysqli_num_rows($result);
    
    if($num > 0){
        $exists=true;
        $showError = "Email already in use!";
        header("location:/Myphp/FORUMS/index.php?signupsuccess=4showAlert&error=$showError");
    }


    if($password == $cpassword && !($exists)){
        $hash = password_hash($password,PASSWORD_DEFAULT);
        

        $sql = "INSERT INTO `users` (`user_id`, `user_email`, `user_password_hash`, `date`) VALUES (NULL, '$email', '$hash', current_timestamp())";
        $result = mysqli_query($conn,$sql);
        if($result){
            $showAlert= true;
            header("location:/Myphp/FORUMS/index.php?signupsuccess=$showAlert");

            
        }

    }else if($password != $cpassword && !($exists)){
        $showError = "Passwords do not match!";
        header("location:/Myphp/FORUMS/index.php?signupsuccess=$showAlert&error=$showError");

    }
   

}


?>