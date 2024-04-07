<?php 
include_once('../config/app.php');

class AboutUsController {

    
    public function __construct()
    {
        $db = new DatabaseConnection;
        
        $this->conn = $db->conn;
    }

    public function getError()
    {
        return $this->error;
    }

    public function getAllListings($user_role)
{
    if ($user_role != 1) {
        redirect("", "index.php");
        exit();  
    }

    $listings = [];

    $query = "SELECT * FROM about_section";

    $result = $this->conn->query($query);

    if (!$result) {
        return [];
    }

    $listings = $result->fetch_all(MYSQLI_ASSOC);

    $result->close();

    return $listings;
}
public function getAboutById($about_id)
{
    $query = "SELECT * FROM about_section WHERE id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $about_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $stmt->close();

    return $data;
}

    public function updateAbout($about_id, $title, $description, $history_title, $history_description, $owners_title, $owners_description)
    {
        $query = "UPDATE about_section SET title=?, description=?, history_title=?, history_description=?, owners_title=?, owners_description=? WHERE id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssssi", $title, $description, $history_title, $history_description, $owners_title, $owners_description, $about_id);

        $result = $stmt->execute();

        if (!$result) {
            $this->error = $stmt->error;
        }

        $stmt->close();

        return $result;
    }


function canEditAbout($user_role)
{
    if ( $user_role === 1) {
        return true;
    }

    return false;
}


}

?>