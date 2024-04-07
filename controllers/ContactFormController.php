<?php 
include_once('../config/app.php');

class ContactFormController{

    public function __construct()
    {
        $db = new DatabaseConnection;

        $this->conn = $db->conn;
    }

    public function getError()
    {
        return $this->error;
    }

    public function createContactFormEntry($full_name, $email, $message)
{
    $query = "INSERT INTO contact_form (full_name, email, message) VALUES (?, ?, ?)";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("sss", $full_name, $email, $message);

    $result = $stmt->execute();

    if (!$result) {
        $this->error = $stmt->error;
    }

    $stmt->close();

    return $result;
}
public function getAllContacts($user_role)
{
    if ($user_role != 1) {
        redirect("", "index.php");
        exit();  
    }

    $listings = [];

    $query = "SELECT * FROM contact_form";

    $result = $this->conn->query($query);

    if (!$result) {
        return [];
    }

    $listings = $result->fetch_all(MYSQLI_ASSOC);

    $result->close();

    return $listings;
}
}