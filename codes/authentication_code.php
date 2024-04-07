<?php
include_once('../config/app.php');
include_once('../controllers/RegisterController.php');
include_once('../controllers/LoginController.php');

$register = new RegisterController;

if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
    $user_id = $_SESSION['user_id'];
    $user_role = $_SESSION['role'];
}

if (isset($_POST['editUser_btn'])) {
    $session_id = validateInput($db->conn, $_POST['users_id']);
    $fname = validateInput($db->conn, $_POST['fname']);
    $lname = validateInput($db->conn, $_POST['lname']);
    $email = validateInput($db->conn, $_POST['email']);
    $password = validateInput($db->conn, $_POST['password']);
    $isadmin = validateInput($db->conn, $_POST['isadmin']);
    $is_active = validateInput($db->conn, $_POST['is_active']);
    $deleted_at = validateInput($db->conn, $_POST['deleted_at']);
    $deleted_by = validateInput($db->conn, $_POST['deleted_by']);


    // Assuming $db is an instance of DatabaseConnection
    // Check if the user exists before updating
    $result_user = $register->isUserExists($email);

    if ($register->canEditUser($user_id, $session_id, $user_role)) {
        // Update the real estate listing
        $updateResult = $register->updateUser($session_id, $fname, $lname, $email, $password, $isadmin);

        if ($updateResult) {
            // Redirect with a success message when the update is successful
            redirectToUsers("User Updated successfully.", "index.php");
        } else {
            // Redirect with an error message if the update fails
            redirectToUsers("User Update failed. Error: $error", "index.php");
        }
    } else {
        // Redirect with an error message if the user is not authorized
        redirectToUsers("You are not authorized to edit this estate.", "index.php");
    }
}
if (isset($_POST['register_btn'])) {
    $fname = validateInput($db->conn, $_POST['fname']);
    $lname = validateInput($db->conn, $_POST['lname']);
    $email = validateInput($db->conn, $_POST['email']);
    $password = validateInput($db->conn, $_POST['password']);
    $confirm_password = validateInput($db->conn, $_POST['confirm_password']);

    $register = new RegisterController;
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $result_password = $register->confirmPassword($password, $confirm_password);
    // Validate password format (at least 8 characters, one uppercase letter, and one number)
    $password_pattern = '/^(?=.*[A-Z])(?=.*\d).{8,}$/';
   
    // Assuming $db is an instance of DatabaseConnection
    $result_user = $register->isUserExists($email);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Redirect with an error message when the email already exists
        redirect("Email not formatted", "register.php");
    } else if (!preg_match($password_pattern, $password)) {
        redirect("Password not formatted", "register.php");
    } else if ($result_user) {
        redirect("Email already exists. Please choose a different one.", "register.php");
    } else {
        // Assuming $register is an instance of RegisterController

        // Check if the password and confirm password match
        $result_password = $register->confirmPassword($password, $confirm_password);

        if (!$result_password) {
            // Redirect with an error message when the passwords do not match
            redirect("Passwords do not match. Please try again.", "register.php");
        }

        // Registration
        $register_query = $register->registration($fname, $lname, $email, $hashed_password);

        if ($register_query) {
            // Redirect with a success message when registration is successful

            redirect("Registration successful. Please login.", "login.php");
        } else {
            redirect("Registration failed. Please try again.", "register.php");
        }
    }

}
if (isset($_POST['login_btn'])) {
    $email = validateInput($db->conn, $_POST['email']);
    $password = validateInput($db->conn, $_POST['password']);

    $login = new LoginController;

    $user = $login->userLogin($email, $password);

    if ($user !== null) {
        // Login successful
        // Set session variables
        session_start();
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['email'] = $user['email'];

        // Redirect to the dashboard or home page

        exit();
    } else {
        // Incorrect email or password
        redirect("Incorrect Email or Password", 'login.php');
    }
}

if (isset($_POST['deleteUser'])) {
    $listingIdToDeleteUser = $_POST['listingIdToDeleteUser'];

    // Attempt to delete the listing
    $deleteResult = $register->deactivateUser($listingIdToDeleteUser, $user_id, $user_role);

    if ($deleteResult) {
        // Redirect or display a success message
        redirectToUsers("User deleted successfully.", "index.php");
    } else {
        // Redirect or display an error message
        redirectToUsers("Users section update failed. Error: " . $register->getError(), "index.php");
    }

}

if (isset($_POST['activateUser'])) {
    $listingIdToActivateUser = $_POST['listingIdToActivateUser'];

    // Attempt to delete the listing
    $deleteResult = $register->activateUser($listingIdToActivateUser, $user_id, $user_role);

    if ($deleteResult) {
        // Redirect or display a success message
        redirectToUsers("User Activate successfully.", "index.php");
    } else {
        // Redirect or display an error message
        redirectToUsers("Users update failed. Error: " . $register->getError(), "index.php");
    }

}


?>