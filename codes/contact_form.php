<?php
include_once('../config/app.php');
include_once('../controllers/ContactFormController.php');

$contactForm = new ContactFormController();



if (isset($_POST['submit_form'])) {
    $full_name = validateInput($db->conn, $_POST['full_name']);
    $email = validateInput($db->conn, $_POST['email']);
    $message = validateInput($db->conn, $_POST['message']);

    // Assuming you have a session variable for user_id
    $user_id = $_SESSION['user_id'];

    // Creating a contact form entry
    $createResult = $contactForm->createContactFormEntry($full_name, $email, $message);

    if ($createResult) {
        // Redirect with a success message when the entry is successful
        redirect("Form submitted successfully.", "contact-us.php");
    } else {
        // Redirect with an error message if the entry fails
        redirect("Form submission failed. Error: " . $contactForm->getError(), "contact-us.php");
    }
}

