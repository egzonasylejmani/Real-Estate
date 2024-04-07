
<?php

include_once("../components/header.php");
include_once('../codes/authentication_code.php');


?>

<div class="flex login-register">
    <div class="card">
        <h2>Register Form</h2>
        <div id="errorMessages" class="errorMessages"></div>
        <?php include_once('../components/message.php');?>
        <form id="registrationForm" action="" method="POST" onsubmit="validateForm()">
            <label for="fullname">First Name</label>
            <input type="text" name="fname" id="firstname" placeholder="Enter your First name">

            <label for="fullname">Last Name</label>
            <input type="text"  name="lname" id="lastname" placeholder="Enter your Last name">

            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Enter your email">

            <label for="new-password">New Password</label>
            <input type="password" name="password" id="new-password" placeholder="Enter your new password">

            <label for="new-password">Confirm Password</label>
            <input type="password" name="confirm_password" id="new-password" placeholder="Enter your new password">

            <button name="register_btn" type="submit">Register</button>
        </form>
        <div class="switch">Already have an account? <a href="login.php">Login here</a></div>
    </div>
</div>



<script>
    function validateForm() {
      var fullname = document.getElementById('fullname').value;
      var email = document.getElementById('email').value;
      var newPassword = document.getElementById('new-password').value;
      var errorMessagesContainer = document.getElementById('errorMessages');
      errorMessagesContainer.innerHTML = ''; // Clear previous error messages

      // Check if all fields are filled
      if (fullname === '' || email === '' || newPassword === '') {
        displayErrorMessage('All fields are required.');
        return false;
      }

      // Check if the username and password meet the length requirements
      if (fullname.length < 4 || newPassword.length < 4) {
        displayErrorMessage('Full name and password must be at least 4 characters long.');
        return false;
      }

      // Check if the email is valid
      var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email)) {
        displayErrorMessage('Email Not Formatted');
        return false;
      }

      // Check if the password meets the specified pattern
      var passwordRegex = /^(?=.*[A-Z])(?=.*\d).{8,}$/;

      if (!passwordRegex.test(newPassword)) {
        displayErrorMessage('Password not formatted');
        return false;
      }

      // Form is valid, allow submission
      return true;
    }

    function displayErrorMessage(message) {
      var errorMessagesContainer = document.getElementById('errorMessages');
      var errorMessageElement = document.createElement('div');
      errorMessageElement.className = 'error';
      errorMessageElement.textContent = message;
      errorMessagesContainer.appendChild(errorMessageElement);
    }
  </script>