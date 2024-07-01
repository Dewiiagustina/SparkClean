<?php
include "../config.php"; // Pastikan path ini sesuai dengan struktur proyek Anda

// Mengambil data dari tabel cleaner
$cleaner_query = "SELECT id, name, price FROM cleaner";
$cleaner_result = mysqli_query($db, $cleaner_query);

// Inisialisasi pesan pembayaran
$message_payment = '';

// Memproses pembayaran jika ada POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $cleaner_id = $_POST['cleaner_id'];
    $service_id = $_POST['service_id'];
    $total_amount = $_POST['total_amount'];

    // Simpan data pembayaran ke tabel payments
    $payment_query = "INSERT INTO payments (name, cleaner_id, service_id, amount, payment_date) 
                      VALUES ('$name', $cleaner_id, $service_id, $total_amount, NOW())";

    if (mysqli_query($db, $payment_query)) {
        $message_payment = "Payment successful!";

        // Optional: Clear form fields after successful payment
        $_POST = array(); // Kosongkan data POST setelah berhasil
    } else {
        $message_payment = "Error: " . mysqli_error($db);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="../css/payment.css">
</head>
<body>
    <div class="container p-0">
        <div class="card px-4">
            <p class="h8 py-3">Payment Details</p>
            <form id="payment-form" method="POST" action="payment.php">
                <div class="row gx-3">
                    <div class="col-12">
                        <div class="d-flex flex-column">
                            <p class="text mb-1">Person Name</p>
                            <input class="form-control mb-3" type="text" name="name" placeholder="Enter your name" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex flex-column">
                            <p class="text mb-1">Card Number</p>
                            <input class="form-control mb-3" type="text" placeholder="1234 5678 435678" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex flex-column">
                            <p class="text mb-1">Expiry</p>
                            <input class="form-control mb-3" type="text" placeholder="MM/YYYY" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex flex-column">
                            <p class="text mb-1">CVV/CVC</p>
                            <input class="form-control mb-3 pt-2" type="password" placeholder="***" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex flex-column">
                            <p class="text mb-1">Cleaner</p>
                            <select id="cleaner_id" name="cleaner_id" class="form-control mb-3" required>
                                <option value="">Select Cleaner</option>
                                <?php while ($cleaner_row = mysqli_fetch_assoc($cleaner_result)): ?>
                                    <option value="<?php echo $cleaner_row['id']; ?>" data-price="<?php echo $cleaner_row['price']; ?>"><?php echo $cleaner_row['name']; ?> - Rp.<?php echo number_format($cleaner_row['price'], 2); ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex flex-column">
                            <p class="text mb-1">Service</p>
                            <select id="service_id" name="service_id" class="form-control mb-3" required>
                                <option value="">Select Service</option>
                                <option value="1">House Cleaning</option>
                                <option value="2">Furniture Cleaning</option>
                                <option value="3">Bathroom Cleaning</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex flex-column">
                            <p class="text mb-1">Total Amount</p>
                            <input class="form-control mb-3" type="text" id="total_amount" name="total_amount" readonly>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary mb-3" id="pay-button">
                            Pay Rp.<span id="display_amount">0.00</span>
                        </button>
                    </div>
                </div>
                <?php if (!empty($message_payment)): ?>
                    <div class="message">
                        <?php echo $message_payment; ?>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <!-- Overlay -->
    <div id="thank-you-overlay" class="overlay">
        <div class="overlay-content">
            <p>Terima kasih atas pemesanan Anda!</p>
            <button id="close-overlay-btn">Tutup</button>
        </div>
    </div>

    <script>
        document.getElementById('payment-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            // Simulasi proses pembayaran
            var form = this;
            var formData = new FormData(form);

            // Lakukan request AJAX jika diperlukan, atau lanjutkan dengan handling langsung di PHP

            // Contoh handling langsung dengan menampilkan overlay
            var overlay = document.getElementById('thank-you-overlay');
            overlay.style.display = 'block';

            // Optional: Clear form fields after successful payment
            form.reset();
        });

        // Tombol tutup overlay
        document.getElementById('close-overlay-btn').addEventListener('click', function() {
            document.getElementById('thank-you-overlay').style.display = 'none';
        });

        // Update total amount based on selected cleaner
        document.getElementById('cleaner_id').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var price = selectedOption.getAttribute('data-price');
            document.getElementById('total_amount').value = price;
            document.getElementById('display_amount').textContent = parseFloat(price).toFixed(2);
        });
    </script>
</body>
</html>
