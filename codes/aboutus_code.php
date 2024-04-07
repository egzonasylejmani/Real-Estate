<?php
include_once('../config/app.php');
include_once('../controllers/AboutUsController.php');

if( isset($_SESSION['user_id']) && isset($_SESSION['role']) ) {
    $user_id = $_SESSION['user_id'];
    $user_role = $_SESSION['role'];
} 

$aboutUs = new AboutUsController();

 

if (isset($_POST['editAbout_btn'])) {
    // Validate and retrieve data from the form
    $title = validateInput($db->conn, $_POST['title']);
    $description = validateInput($db->conn, $_POST['description']);
    $history_title = validateInput($db->conn, $_POST['history_title']);
    $history_description = validateInput($db->conn, $_POST['history_description']);
    $owners_title = validateInput($db->conn, $_POST['owners_title']);
    $owners_description = validateInput($db->conn, $_POST['owners_description']);
    $about_id = validateInput($db->conn, $_POST['about_id']); // Assuming you have an 'about_id' field in your form

    // Check if the user is authorized to edit the about section
    if ($aboutUs->canEditAbout($user_role)) {
        // Update the about section
        $updateResult = $aboutUs->updateAbout($about_id, $title, $description, $history_title, $history_description, $owners_title, $owners_description);

        if ($updateResult) {
            // Redirect with a success message when the update is successful
            redirectToAbout("About section updated successfully.", "index.php");
        } else {
            // Redirect with an error message if the update fails
            redirectToAbout("About section update failed. Error: " . $aboutUs->getError(), "index.php");
        }
    } else {
        // Redirect with an error message if the user is not authorized
        redirectToAbout("You are not authorized to edit this about section.", "index.php");
    }
}

?>