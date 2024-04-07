<?php
include_once('../config/app.php');
include_once('../controllers/RealEstateController.php');

if( isset($_SESSION['user_id']) && isset($_SESSION['role']) ) {
    $user_id = $_SESSION['user_id'];
    $user_role = $_SESSION['role'];
} 

$realEstate = new RealEstateController();

if (isset($_POST['createEstate_btn'])) {
    $title = $_POST['title'];
    $location = $_POST['location'];
    $price = $_POST['price'];
    $bedrooms =  $_POST['bedrooms'];
    $bathrooms = $_POST['bathrooms'];
    $sqr = $_POST['sqr'];
    $picture1_url = $_POST['picture1_url'];
    $picture2_url = $_POST['picture2_url'];
    $picture3_url = $_POST['picture3_url'];
    $description = $_POST['description'];
    $type = $_POST['type'];


    $user_id = $_SESSION['user_id'];

    // Registration
    $createQuery = $realEstate->createListing($user_id, $title, $location, $price, $picture1_url, $picture2_url, $picture3_url, $description, $type);

    if ($createQuery) {
        // Redirect with a success message when registration is successful
        redirectTo("Estate Created successfully.", "index.php");
    } else {
        redirectTo("Estate Creating failed. Error: $error", "index.php");
    }
}


if (isset($_POST['editEstate_btn'])) {
    // Validate and retrieve data from the form
    $estate_id = validateInput($db->conn, $_POST['estate_id']);
    $title = validateInput($db->conn, $_POST['title']);
    $location = validateInput($db->conn, $_POST['location']);
    $price = validateInput($db->conn, $_POST['price']);
    $bedrooms = validateInput($db->conn, $_POST['bedrooms']);
    $bathrooms = validateInput($db->conn, $_POST['bathrooms']);
    $sqr = validateInput($db->conn, $_POST['sqr']);
    $picture1_url = validateInput($db->conn, $_POST['picture1_url']);
    $picture2_url = validateInput($db->conn, $_POST['picture2_url']);
    $picture3_url = validateInput($db->conn, $_POST['picture3_url']);
    $description = validateInput($db->conn, $_POST['description']);
    $type = validateInput($db->conn, $_POST['type']);

    // Check if the user is authorized to edit the estate
    if ($realEstate->canEditEstate($user_id, $estate_id, $user_role)) {
        // Update the real estate listing
        $updateResult = $realEstate->updateListing($estate_id, $title, $location, $price,$bedrooms, $bathrooms,$sqr,  $picture1_url, $picture2_url, $picture3_url, $description, $type);

        if ($updateResult) {
            // Redirect with a success message when the update is successful
            redirectTo("Estate Updated successfully.", "index.php");
        } else {
            // Redirect with an error message if the update fails
            redirectTo("Estate Update failed. Error: $error", "index.php");
        }
    } else {
        // Redirect with an error message if the user is not authorized
        redirectTo("You are not authorized to edit this estate.", "index.php");
    }
}




if (isset($_POST['deleteListing'])) {
    $listingIdToDelete = $_POST['listingIdToDelete'];

    // Attempt to delete the listing
    $deleteResult = $realEstate->deleteListing($listingIdToDelete, $user_id, $user_role);

    if ($deleteResult) {
        // Redirect or display a success message
        redirectTo("Listing deleted successfully.", "index.php");
    } else {
        // Redirect or display an error message
        redirectTo("Failed to delete listing.", "index.php");
    }

}
?>