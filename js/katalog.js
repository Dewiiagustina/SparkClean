// Mengambil elemen tombol Checkout
const checkoutBtn = document.querySelector('.checkout-btn');

// Mengambil elemen overlay dan modal untuk Payment Details
const overlayPayment = document.getElementById('overlay-payment');
const modalPayment = document.getElementById('modal-payment');

// Mengambil elemen untuk pesan terima kasih
const thankYouMessage = document.getElementById('thank-you-message');

// Mengatur event listener untuk tombol Checkout
checkoutBtn.addEventListener('click', function() {
    overlayPayment.style.display = 'flex'; // Menampilkan overlay
});

// Fungsi untuk menutup modal Payment Details
function closeModalPayment() {
    overlayPayment.style.display = 'none'; // Menyembunyikan overlay
}

// Fungsi untuk memproses pembayaran (disesuaikan dengan logika backend Anda)
function processPayment() {
    // Implementasi logika pembayaran di sini (misalnya validasi, pengiriman data ke server, dll)

    // Simulasi proses pembayaran berhasil
    // Di sini Anda bisa menambahkan logika sesuai dengan integrasi yang sebenarnya
    setTimeout(() => {
        closeModalPayment();
        showThankYouMessage();
    }, 2000); // Contoh: Menunggu 2 detik sebelum menampilkan pesan terima kasih
}

// Fungsi untuk menampilkan pesan terima kasih
function showThankYouMessage() {
    // Sembunyikan modal-payment (jika masih ditampilkan)
    modalPayment.style.display = 'none';
    
    // Tampilkan pesan terima kasih di dalam modal terpisah
    thankYouMessage.style.display = 'block';
}

// Fungsi untuk menutup pesan terima kasih
function closeThankYouMessage() {
    thankYouMessage.style.display = 'none';
    overlayPayment.classList.remove('show'); // Hilangkan class 'show' dari overlay-payment
}
