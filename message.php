<?php 
include "config.php";
if(isset($_POST['message'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $message=$_POST['message'];
    $phone=$_POST['phone'];
    $service=$_POST['service'];

    $sql="INSERT INTO contact_us (name,email,message,phone,service) VALUES ('$name', '$email','$message','$phone','$service')";
    if($db->query($sql)){
        header("Location: HomePage.html#contact");
    } else {
        echo "Failed to send message: " . $db->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SparkleClean</title>
    <link rel="stylesheet" href="css/styleaman.css">
    <style>
        
        table {
            width: 80%;
            margin: auto;
            border-collapse: collapse;
            text-align: center;
            margin-top: 50px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        th {
            background-color: #333;
            color: white;
            padding: 15px;
        }
        td {
            padding: 12px;
        }
        tr:nth-child(odd) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        th, td {
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="navigation">
        <img src="images/logo.png" alt="Logo">
        <a href="login.php">Log Out</a>
        <a href="admin/cleaner.php">Cleaner</a>
        <a href="admin/katalog.php">Services</a>
        <a href="admin/HomePage.html">Dashboard</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Service</th>
                <th>Message</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Ambil data dari database
            $sql = "SELECT * FROM contact_us";
            $result = $db->query($sql);

            if ($result->num_rows > 0) {
                // Output data dari setiap baris
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['phone'] . "</td>";
                    echo "<td>" . $row['service'] . "</td>";
                    echo "<td>" . $row['message'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No messages found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
