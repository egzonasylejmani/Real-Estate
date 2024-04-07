<?php

include_once('../config/app.php');

class RealEstateController
{
    public function __construct()
    {
        $db = new DatabaseConnection;

        $this->conn = $db->conn;
    }


    public function getError()
    {
        return $this->error;
    }

    public function createListing($user_id, $title, $location, $price, $bedrooms, $bathrooms, $sqr, $picture1_url, $picture2_url, $picture3_url, $description, $type)
    {

        $query = "INSERT INTO estate (user_id, title, location, price, bedrooms, bathrooms, sqr, picture1_url, picture2_url, picture3_url, description, type) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("isssssssssss", $user_id, $title, $location, $price, $bedrooms, $bathrooms, $sqr, $picture1_url, $picture2_url, $picture3_url, $description, $type);

        $result = $stmt->execute();

        if (!$result) {
            $this->error = $stmt->error;
        }

        $stmt->close();

        return $result;
    }

    public function getAllListings($user_id, $user_role)
    {
        $listings = [];

        $query = "SELECT * FROM estate";

        if ($user_role == 1) {
            $result = $this->conn->query($query);
        } else {
            $query .= " WHERE user_id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("i", $user_id);
            $result = $stmt->execute();

            $listings = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

            $stmt->close();
        }

        if (!$result) {
            return [];
        }

        if ($user_role == 1) {
            $listings = $result->fetch_all(MYSQLI_ASSOC);
        }

        return $listings;
    }

    public function getAllListingsView()
    {
        $listings = [];

        $query = "SELECT *  FROM estate";

        $result = $this->conn->query($query);

        if (!$result) {
            return [];
        }

        $listings = $result->fetch_all(MYSQLI_ASSOC);

        return $listings;
    }

    public function deleteListing($id, $user_id, $user_role)
    {
        $isAdmin = ($user_role == 1);

        if ($isAdmin) {
            $query = "DELETE FROM estate WHERE id = ?";
        } else {
            $query = "DELETE FROM estate WHERE id = ? AND user_id = ?";
        }

        $stmt = $this->conn->prepare($query);

        if ($isAdmin) {
            $stmt->bind_param("i", $id);
        } else {
            $stmt->bind_param("ii", $id, $user_id);
        }

        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function getEstateById($estate_id)
    {
        $query = "SELECT * FROM estate WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $estate_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();

        return $data;
    }

    public function updateListing($estate_id, $title, $location, $price, $bedrooms, $bathrooms, $sqr, $picture1_url, $picture2_url, $picture3_url, $description, $type)
    {
        $query = "UPDATE estate SET title=?, location=?, price=?, bedrooms=?, bathrooms=?, sqr=?, picture1_url=?, picture2_url=?, picture3_url=?, description=?, type=? WHERE id=?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssssssssssi", $title, $location, $price, $bedrooms, $bathrooms, $sqr, $picture1_url, $picture2_url, $picture3_url, $description, $type, $estate_id);

        $result = $stmt->execute();

        if (!$result) {
            $this->error = $stmt->error;
        }

        $stmt->close();

        return $result;
    }

    function getUserIdByEstateId($estate_id)
    {
        $query = "SELECT user_id FROM estate WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $estate_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();

        return $data['user_id'];
    }

    function canEditEstate($user_id, $estate_id, $user_role)
    {
        $creator_id = $this->getUserIdByEstateId($estate_id);
        if ($user_id === $creator_id || $user_role === 1) {
            return true;
        }

        return false;
    }

    public function getEstateDetails($id)
    {
        $query = "SELECT * FROM estate WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $estateDetails = $result->fetch_assoc();

        $stmt->close();

        return $estateDetails;
    }

}