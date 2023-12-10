<?php
$full_name = $_POST['full_name']; 
$email = $_POST['email'];         
$message = $_POST['message'];
$officer = $_POST['officer'];     

$conn = new mysqli('localhost', 'root', '', 'agro_pro');
if ($conn->connect_errno) {
    die('Connection Failed: ' . $conn->connect_errno);
} else {
    $stmt = $conn->prepare("INSERT INTO contact (full_name, email, message, officer) VALUES (?, ?, ?, ?)");
    
    
    if ($stmt) {
        $stmt->bind_param("ssss", $full_name, $email, $message, $officer);
        $stmt->execute();
        $stmt->close();
        $conn->close();

        echo "<script type='text/javascript'>alert('Message Sent'); window.location.href = 'contact.html';</script>";
        exit;
    } else {
        
        echo 'Prepare statement failed: ' . $conn->error;
    }
}
?>
