<?php 
include "../config.php";

if (isset($_POST['add'])) {
    $filename = $_FILES['uploadfile']['name'];
    $tempname = $_FILES['uploadfile']['tmp_name'];
    $folder = "images/" . $filename;
    $name = $_POST['name'];
    $price = $_POST['price'];

    // Cek apakah cleaner sudah ada di database
    $check_sql = "SELECT * FROM cleaner WHERE name = '$name'";
    $check_result = mysqli_query($db, $check_sql);

    if ($check_result->num_rows > 0) {
        echo "Cleaner dengan nama tersebut sudah ada.";
    } else {
        $sql = "INSERT INTO cleaner (name, filename, price) VALUES ('$name', '$filename', '$price')";
        if (mysqli_query($db, $sql)) {
            if (move_uploaded_file($tempname, $folder)) {
                echo "Image uploaded successfully";
                header("Location: cleaner.php");
                exit();
            } else {
                echo "Failed to upload image";
            }
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($db);
        }
    }
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    // Menghapus file gambar
    $sql = "SELECT filename FROM cleaner WHERE id = '$id'";
    $result = mysqli_query($db, $sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $file_path = "images/" . $row['filename'];
        if (file_exists($file_path)) {
            unlink($file_path);
        }
    }
    
    $sql = "DELETE FROM cleaner WHERE id='$id'";
    mysqli_query($db, $sql);
    header("Location: cleaner.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalog</title>
    <link rel="stylesheet" href="css/katalog.css">
    <style>
        .container {
            width: 80%;
            margin: 0 auto;
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
            color: #333;
        }
        td img {
            max-width: 100px;
            max-height: 100px;
        }
        form {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .input-group {
            margin-bottom: 15px;
        }
        .input-group input, .input-group button {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 5px auto;
            display: block;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .input-group button {
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .input-group button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    
<div class="navigation">
        <!-- Navigasi dan logo (penggantian "Log Out" dengan "Log In" jika belum login) -->
        <img src="images/logo.png" alt="Logo">
        <a href="login.html">Log Out</a>
        <a href="../message.php">Message</a>
         <a href="katalog.php">Services</a>
         <a href="HomePage.html">Dashboard</a>
    </div>
    

    <div class="container">

        <h1>Add New Cleaner</h1>
        <form action="cleaner.php" method="post" enctype="multipart/form-data">
            <div class="input-group">
                <input type="text" name="name" placeholder="Name" required>
            </div>
            <div class="input-group">
                <input type="file" name="uploadfile" required>
            </div>
            <div class="input-group">
                <input type="number" name="price" placeholder="Price" required>
            </div>
            <div class="input-group">
                <button type="submit" name="add">Add</button>
            </div>
        </form>

        <div id="display-image">
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM cleaner";
                    $result = $db->query($query);
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td><img src='images/" . $row['filename'] . "' alt='" . $row['name'] . "'></td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>Rp. " . number_format($row['price'], 2, ',', '.') . "</td>";
                        echo "<td><form action='cleaner.php' method='post'>";
                        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                        echo "<input type='submit' name='delete' value='Delete'>";
                        echo "</form></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        
    </div>
</body>
</html>
