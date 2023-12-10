<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agro_pro";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


    $search = mysqli_real_escape_string($conn, $_POST['search']);
   
    $sql = "SELECT * FROM product WHERE name = '$search'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error: " . mysqli_error($conn));
    }if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        echo "<script type='text/javascript'>";
        echo "alert('Product Details\\n" .
             "Product ID:  " . $row['product_id'] . "\\n" .
             "Name:  " . $row['name'] . "\\n" .
             "Quantity:  " . $row['quantity'] . "\\n" .
             "Price:  " . $row['price'] . "');" .
             "window.location.href = 'index.html';";
        echo "</script>";
    } else {
       
        echo "<script type='text/javascript'>alert('Product Not Found!'); window.location.href = 'index.html';</script>";
    }
    
    mysqli_close($conn);
}
?>


    