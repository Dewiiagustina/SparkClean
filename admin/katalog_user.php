<?php 
include "../config.php";

if (isset($_POST['add'])) {
    echo "Form is submitted.<br>";

    $filename = $_FILES['uploadfile']['name'];
    $tempname = $_FILES['uploadfile']['tmp_name'];
    $folder = "images/" . $filename;
    $name = $_POST['name'];
    $price = $_POST['price'];

    // Cek apakah cleaner sudah ada di database
    $check_sql = "SELECT * FROM cleaner WHERE name = '$name'";
    $check_result = mysqli_query($db, $check_sql);

    if ($check_result->num_rows > 0) {
        echo "Cleaner dengan nama tersebut sudah ada.<br>";
    } else {
        $sql = "INSERT INTO cleaner (name, filename, price) VALUES ('$name', '$filename', '$price')";
        if (mysqli_query($db, $sql)) {
            if (move_uploaded_file($tempname, $folder)) {
                echo "Image uploaded successfully<br>";
                header("Location: admin/cleaner.php");
                exit();
            } else {
                echo "Failed to upload image<br>";
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
    <link rel="stylesheet" href="../css/katalog.css">
    <!-- Link ke CSS untuk styling -->
</head>
<body>
    <div class="navigation">
        <!-- Navigasi dan logo (penggantian "Log Out" dengan "Log In" jika belum login) -->
        <img src="images/logo.png" alt="Logo">
        <a href="../login.php">Log Out</a>
        <a href="../HomePage.html#contact">Contact US</a>
        <a href="#katalog">Cleaner</a>
        <a href="#services">Service</a>
        <a href="../HomePage.html">Dashboard</a>
         
    </div>
    <div class="banner">
        <div class="title">
            <h1>Our Services</h1>
        </div>  
        <div class="services-container" id="services">
            <div class="container">
                <input type="radio" name="service" id="house-clean">
                <label for="house-clean">
                    <div class="service-box">
                        <img src="images/plan1.png" alt="House Clean">
                        <h2>House Clean</h2>
                        <p>House Clean provides thorough cleaning services for your entire home. Our SparkleClean team will clean every 
                            corner of your home thoroughly and efficiently, ensuring that your home is clean, comfortable and free from dust and dirt.
                        </p>
                    </div>
                </label>
            </div>
            <div class="container">
                <input type="radio" name="service" id="furniture-clean">
                <label for="furniture-clean">
                    <div class="service-box">
                        <img src="images/plan2.png" alt="Furniture Clean">
                        <h2>Furniture Clean</h2>
                        <p>Furniture Clean provides special cleaning services for your home furniture. We understand that furniture is an important 
                            investment for the comfort and aesthetics of your home, so we provide safe and effective cleaning services to maintain the 
                            beauty and cleanliness of your furniture.
                        </p>
                    </div>
                </label>
            </div>
            <div class="container" >
                <input type="radio" name="service" id="bathroom-clean">
                <label for="bathroom-clean">
                    <div class="service-box">
                        <img src="images/plan3.png" alt="Bathroom Clean">
                        <h2>Bathroom Clean</h2>
                        <p>Bathroom Clean provides cleaning services to ensure the cleanliness and comfort of your bathroom. We understand that the 
                            bathroom is an area that is vulnerable to germs and bacteria, so we provide an effective thorough cleaning service.
                         </p>
                    </div>
                </label>
            </div>
        </div>
    </div>

    <div class="katalog" id="katalog">
        <!-- Daftar produk -->
        <div class="title">
            <h2>Cleaner</h2>
        </div>
        <div class="product-container">
        <?php
            $query = "SELECT * FROM cleaner";
            $result = $db->query($query);
            while ($row = $result->fetch_assoc()) {
                echo '<div class="product">';
                echo '<input type="radio" name="product" id="product' . $row['id'] . '">';
                echo '<label for="product' . $row['id'] . '">';
                echo '<div class="product-box">';
                echo '<div class="img-box">';
                echo '<img src="images/' . $row['filename'] . '" alt="' . $row['name'] . '">';
                echo '</div>';
                echo '<div class="detail-box">';
                echo '<h3>' . $row['name'] . '</h3>';
                echo '<h4>Rp. ' . number_format($row['price'], 2, ',', '.') . '</h4>';
                echo '</div>';
                echo '</div>';
                echo '</label>';
                echo '</div>';
            }
            ?>

        </div>
    </div>

    <div class="book">
        <hr>
        <div class="title">
            <h2>Book Your Service</h2>
        </div>
        <div class="booking-container">

            <div class="title">
                <!-- Tambahkan id unik pada tombol checkout -->
                <button class="checkout-btn" id="checkout-btn">Checkout</button>
            </div>
        </div>
    </div>
    
    <script>
        // Menggunakan JavaScript untuk menangani klik tombol checkout
        document.getElementById("checkout-btn").onclick = function() {
            // Mengarahkan ke halaman payment.html
            window.location.href = "payment.php";
        };
    </script>    
    
    <script src="script/katalog.js"></script>
</body>
</html>
