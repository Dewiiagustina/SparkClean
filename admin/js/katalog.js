document.querySelector('.add-btn').addEventListener('click', function() {
    document.getElementById('overlay-add').style.display = 'flex';
});

document.querySelector('.delete-btn').addEventListener('click', function() {
    document.getElementById('overlay-del').style.display = 'flex';
});

function closeModal(overlayId) {
    document.getElementById(overlayId).style.display = 'none';
}

document.getElementById('add-cleaner-form').addEventListener('submit', function(event) {
    event.preventDefault();
    // Ambil data dari form
    const cleanerPhoto = document.getElementById('cleaner-photo').files[0];
    const cleanerName = document.getElementById('cleaner-name').value;
    const cleanerPrice = document.getElementById('cleaner-price').value;

    // Proses penambahan cleaner
    // Misalnya kirim data ke server atau tambahkan ke daftar cleaner

    // Tutup modal setelah submit
    closeModal('overlay-add');
});

document.getElementById('delete-cleaner-form').addEventListener('submit', function(event) {
    event.preventDefault();
    // Ambil data dari form
    const cleanerName = document.getElementById('delete-cleaner-name').value;

    // Proses penghapusan cleaner
    // Misalnya kirim data ke server untuk menghapus cleaner berdasarkan nama

    // Tutup modal setelah submit
    closeModal('overlay-del');
});
