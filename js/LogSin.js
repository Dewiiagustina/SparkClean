const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
    container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
    container.classList.remove("right-panel-active");
});

// Client-side validation for sign-up form
const signUpForm = document.querySelector('.sign-up-container form');
signUpForm.addEventListener('submit', (event) => {
    const name = signUpForm.querySelector('input[name="name"]').value;
    const email = signUpForm.querySelector('input[name="email"]').value;
    const password = signUpForm.querySelector('input[name="password"]').value;

    if (name === "" || email === "" || password === "") {
        event.preventDefault();
        alert("All fields are required for sign-up!");
    } else if (!validateEmail(email)) {
        event.preventDefault();
        alert("Please enter a valid email address.");
    } else if (password.length < 6) {
        event.preventDefault();
        alert("Password must be at least 6 characters long.");
    }
});

// Client-side validation for sign-in form
const signInForm = document.querySelector('.sign-in-container form');
signInForm.addEventListener('submit', (event) => {
    const email = signInForm.querySelector('input[name="email"]').value;
    const password = signInForm.querySelector('input[name="password"]').value;

    if (email === "" || password === "") {
        event.preventDefault();
        alert("All fields are required for sign-in!");
    } else if (!validateEmail(email)) {
        event.preventDefault();
        alert("Please enter a valid email address.");
    }
});

// Email validation function
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(String(email).toLowerCase());
}
