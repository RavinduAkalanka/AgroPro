<?php

$f_nameErr = $l_nameErr = $emailErr = $phoneErr = $passwordErr = "";

if($_SERVER["REQUEST_METHOD"] =="POST"){
   $f_name = $_POST['f_name'];
   $l_name = $_POST['l_name'];
   $email = $_POST['email'];
   $phone = $_POST['phone'];
   $password = $_POST['password'];

   if (empty($f_name)) {
       $f_nameErr = "First Name is required.";
    }

   if (empty($l_name)) {
       $l_nameErr = "Last Name is required.";
    }

    if (empty($email)) {
        $emailErr = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format.";
    }

    if (empty($phone)) {
        $phoneErr = "Phone number is required.";
    } elseif (!preg_match("/^\d{10}$/", $phone)) {
        $phoneErr = "Invalid phone number format (10 digits required).";
    }

    if (empty($password)) {
        $passwordErr = "Password is required.";
    } elseif (strlen($password) < 8) {
        $passwordErr = "Password must be at least 8 characters long.";
    }
}


   $conn = new mysqli('localhost','root','','agro_pro');
   if($conn->connect_errno){
      die('Connection Failed  : '.$conn->connect_errno);

   }else{
    $stmt = $conn->prepare("INSERT INTO user(f_name, l_name, email, phone, password)
        values (?,?,?,?,?)");
    $stmt->bind_param("sssis", $f_name, $l_name, $email, $phone, $password);
    $stmt->execute();
    
    $stmt->close();
    $conn->close();

    echo "<script type='text/javascript'>alert('Successfully Registered'); window.location.href = 'index.html';</script>";
    exit; 

}