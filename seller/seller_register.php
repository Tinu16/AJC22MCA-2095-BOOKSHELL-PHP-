<?php
session_start();
include("../dbcon.php");
include("../includes/header.php");
?>
<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <!-- First Column -->
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <?php include("../message.php"); ?>
                                <h1 class="h4 text-gray-900 mb-4">Create a seller account!</h1>
                            </div>
                            <form class="user" method="POST" action="seller_registercode.php">
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" name="email" id="email" placeholder="Email Address" onInput="validateEmail()">
                                    <small id="email_error" style="color: red;"></small>
                                </div>
                                <div class="form-group">
                                    <input type="phone" class="form-control form-control-user" name="phone" id="phone" placeholder="Mobile Number" oninput="validatePhone()">
                                    <small id="phoneError" style="color: red;"></small>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Password" oninput="validatePassword()">
                                        <small id="passwordError" style="color: red;"></small>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" name="confirmPassword" id="confirmPassword" placeholder="Repeat Password" oninput="validateConfirmPassword()" required>
                                        <small id="confirmPasswordError" style="color: red;"></small>
                                    </div>
                                    <input type="hidden" name="usertype" value="seller">
                                </div>
                                <input type="submit" name="register_btn" class="btn btn-primary btn-user btn-block" value="Register Account" onsubmit="return validateForm()">
                                <hr>
                                <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Register with Google
                                </a>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="../login.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                    <!-- Second Column -->
                    <div class="col-lg-5 d-none d-lg-flex align-items-center justify-content-center">
                        <img src="../img/seller1.jpg" class="img-fluid img-medium" alt="Delivery Boy Image">
                    </div>
                </div>
            </div>
        </div>

    </div>
   

    <script>
        function validateEmail() {
            var email = document.getElementById('email').value;
            var email_error = document.getElementById('email_error');
            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/.test(email);
            let message = "";
            if (!emailPattern) {
                message += "Enter a valid email.<br>";
            }
            email_error.innerHTML = message;
            if (emailPattern) {
                email_error.style.color = "green";
                email_error.textContent = "Email is valid!";
            } else {
                email_error.style.color = "red";
            }
        }

        function validatePhone() {
            var phoneInput = document.getElementById("phone").value;
            var phoneError = document.getElementById("phoneError");
            phoneError.innerHTML = "";
            if (/[a-zA-Z]/.test(phoneInput)) {
                phoneError.innerHTML = "Phone number must not contain letters.";
            }
            if (phoneInput.length > 10) {
                document.getElementById("phone").value = phoneInput.slice(0, 10);
            }
            if (!/^(\+91)?[6789]\d{9}$/.test(phoneInput)) {
                phoneError.innerHTML = "Please enter a valid Indian phone number.";
            }
        }

        function validatePassword() {
            var passwordInput = document.getElementById("password").value;
            var passwordError = document.getElementById("passwordError");
            passwordError.innerHTML = "";
            if (!/(?=.*\d)/.test(passwordInput)) {
                passwordError.innerHTML += "Password must contain at least 1 digit.<br>";
            }
            if (!/(?=.*[!@#$%^&*])/.test(passwordInput)) {
                passwordError.innerHTML += "Password must contain at least 1 symbol (!@#$%^&*).<br>";
            }
            if (!/(?=.*[a-z])/.test(passwordInput)) {
                passwordError.innerHTML += "Password must contain at least 1 lowercase letter.<br>";
            }
            if (!/(?=.*[A-Z])/.test(passwordInput)) {
                passwordError.innerHTML += "Password must contain at least 1 uppercase letter.<br>";
            }
            if (passwordInput.length < 6) {
                passwordError.innerHTML += "Password must be at least 6 characters.<br>";
            }
        }

        function validateConfirmPassword() {
            var passwordInput = document.getElementById("password").value;
            var confirmPasswordInput = document.getElementById("confirmPassword").value;
            var confirmPasswordError = document.getElementById("confirmPasswordError");
            confirmPasswordError.innerHTML = "";
            if (passwordInput !== confirmPasswordInput) {
                confirmPasswordError.innerHTML = "Passwords do not match.";
            }
        }

        function validateForm() {
            validatePhone();
            validatePassword();
            validateConfirmPassword();
            if (
                document.getElementById("phoneError").innerHTML !== "" ||
                document.getElementById("passwordError").innerHTML !== "" ||
                document.getElementById("confirmPasswordError").innerHTML !== "" ||
                document.getElementById("email_error").innerHTML !== "" ||
                document.getElementById('email').value.trim() === "" ||
                document.getElementById('phone').value.trim() === "" ||
                document.getElementById('password').value.trim() === "" ||
                document.getElementById('confirmPassword').value.trim() === ""
            ) {
                return false;
            }
            alert("Form submitted successfully!");
            return true;
        }
    </script>
    <?php include("../includes/scripts.php"); ?>
