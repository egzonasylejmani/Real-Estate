<?php

include_once("../components/header.php");
include_once('../codes/authentication_code.php');


?>
<div class="flex login-register">
  <div class="card">
    <h2>Login Form</h2>
    <div id="errorMessages" class="errorMessages"></div>
    <?php include_once('../components/message.php'); ?>

    <form id="loginForm" method="POST" action="" onsubmit="return validateLogin()">
      <label for="email">Email</label>
      <input type="email" name="email" id="email" placeholder="Enter your email" required>

      <label for="password">Password</label>
      <input type="password" name="password" id="password" placeholder="Enter your password" required>

      <button name="login_btn" type="submit">Login</button>
    </form>
    <div class="switch">Don't have an account? <a href="<?= base_url('register.php') ?> ">Register here</a></div>
  </div>
</div>


<script>
  function validateLogin() {
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    var errorMessagesContainer = document.getElementById('errorMessages');
    errorMessagesContainer.innerHTML = ''; // Clear previous error messages

    // Check for empty fields
    if (username === '' || password === '') {
      displayErrorMessage('Both username and password are required.');
      return false; // Prevent form submission
    }

    // Check minimum length requirements
    if (username.length) {
      displayErrorMessage('Username and password must be at least 4 characters long.');
      return false; // Prevent form submission
    }


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