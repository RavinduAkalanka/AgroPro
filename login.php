<?php
    $email = $_POST['email'];
    $password = $_POST['password'];

    $con = new mysqli("localhost", "root", "", "agro_pro");
    if($con->connect_error){
        die("Failed to connect : ".$con->connect_error);
    }else {
       $stmt = $con->prepare("select * from user where email = ?");
       $stmt->bind_param("s",$email);
       $stmt->execute();
       $stmt_result = $stmt->get_result();
       if($stmt_result->num_rows > 0){
          $data = $stmt_result->fetch_assoc();
          if($data['password'] === $password){
           
            echo "<script type='text/javascript'>alert('Loging Successfully'); window.location.href = 'index.html';</script>";
            exit; 
          }  
       }else {
        echo "<script type='text/javascript'>alert('Invalid Email or Password. Try Again!'); window.location.href = 'index.html';</script>";
        exit; 
       }

       $stmt->close();
       $con->close();
    }
    ?>

