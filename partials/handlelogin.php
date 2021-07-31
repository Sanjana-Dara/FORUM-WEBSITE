<?php
$showError =false;
$showAlert = false;
if($_SERVER['REQUEST_METHOD']== 'POST'){
    include 'dbconnect.php';
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM `users` WHERE `user_email` LIKE '$email'";
    $result = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($result);
    if($num>0){
        while($row=mysqli_fetch_assoc($result)){
            $verify = password_verify($password,$row['user_password_hash']);
            $user=$row['user_email'];
            if($verify){
                $showAlert=true;
                header("location:/Myphp/FORUMS/index.php?loginsuccess=$showAlert&username=$user");
            }else{
                $showError="Password Incorrect!";
                header("location:/Myphp/FORUMS/index.php?loginsuccess=$showAlert&loginerror=$showError");

            }
        }
    }else{
        $showError="Account unavailable! Please Signup for iDiscuss. ";
        header("location:/Myphp/FORUMS/index.php?loginsuccess=$showAlert&loginerror=$showError");

    }

}
?>