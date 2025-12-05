document.addEventListener("DOMContentLoaded", () => {
    const signInForm = document.getElementById("signInForm");
    const signUpForm = document.getElementById("signUpForm");

    // Handle Sign In
    signInForm.addEventListener("submit", (event) => {
        event.preventDefault();
        const email = document.getElementById("loginEmail").value;
        const password = document.getElementById("loginPassword").value;
        alert(`Welcome back! Email: ${email}`);
    });

    // Handle Sign Up
    signUpForm.addEventListener("submit", (event) => {
        event.preventDefault();
        const name = document.getElementById("registerName").value;
        const email = document.getElementById("registerEmail").value;
        const password = document.getElementById("registerPassword").value;
        alert(`Account created! Name: ${name}, Email: ${email}`);
    });
});
