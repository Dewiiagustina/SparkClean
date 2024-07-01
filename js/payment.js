document.addEventListener("DOMContentLoaded", function() {
    const payButton = document.querySelector(".btn-primary");
    const overlay = document.getElementById("thank-you-overlay");
    const closeButton = document.getElementById("close-overlay-btn");

    payButton.addEventListener("click", function() {
        overlay.style.display = "block";
    });

    closeButton.addEventListener("click", function() {
        overlay.style.display = "none";
    });
});
