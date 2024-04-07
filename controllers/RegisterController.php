<?php
include_once('../config/app.php');

class RegisterController
{
    private $error;
    public function __construct()
    {
        $db = new DatabaseConnection;

        $this->conn = $db->conn;
    }

    public function registration($fname, $lname, $email, $hashed_password)
    {
        // Validate email format

        $register_query = "INSERT INTO users (fname, lname, email, password) VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($register_query);

        $stmt->bind_param("ssss", $fname, $lname, $email, $hashed_password);

        $result = $stmt->execute();

        $stmt->close();

        return $result;
    }
    public function updateUser($user_id, $fname, $lname, $email, $password, $isadmin)
    {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE users SET fname=?, lname=?, email=?, password=?, isadmin=? WHERE id=?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssssi", $fname, $lname, $email, $hashed_password, $isadmin, $user_id);

        $result = $stmt->execute();

        if (!$result) {
            $this->error = $stmt->error;
        }

        $stmt->close();

        return $result;
    }
    function canEditUser($user_id, $session_id, $user_role)
    {
        $creator_id = $this->getUserId($session_id);
        if ($user_id === $creator_id || $user_role === 1) {
            return true;
        }

        return false;
    }

    function getUserId($estate_id)
    {
        $query = "SELECT id FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $estate_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();

        return $data['id'];
    }




    // Function to get the current user's ID from the session
    private function getCurrentUserId()
    {
        // Replace this with your logic to get the current user's ID from the session
        return $_SESSION['user_id'] ?? 0; // Default to 0 if the user ID is not set in the session
    }

    public function getUserById($estate_id)
    {
        $query = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $estate_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $data = $result->fetch_assoc();
        $stmt->close();

        return $data;
    }

    public function getAllUsers($is_admin, $target_user_id)
    {
        // Check if the user making the request is an admin
        // You can implement your own logic to determine if the user is an admin

        if ($is_admin) {
            // If the user is an admin, retrieve all users
            $query = "SELECT id,fname, lname,email, isadmin, is_active, deleted_at, deleted_by FROM users";
        } else {
            // If the user is not an admin, retrieve information for the specified user only
            $query = "SELECT id, fname, lname,email, isadmin, is_active, deleted_at, deleted_by FROM users WHERE id = ?";
        }

        $stmt = $this->conn->prepare($query);

        if (!$is_admin) {
            // If the user is not an admin, bind the user ID parameter
            $stmt->bind_param("i", $target_user_id);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }

        $stmt->close();

        return $users;
    }
    public function activateUser($id, $user_id, $user_role)
    {
        $isAdmin = ($user_role == 1);

        if ($isAdmin) {
            // Update the user to set is_active to false
            $updateQuery = "UPDATE users SET is_active = 1, deleted_at = CURRENT_TIMESTAMP, deleted_by = ? WHERE id = ?";
            $stmtUpdate = $this->conn->prepare($updateQuery);
            $stmtUpdate->bind_param("ii", $user_id, $id);

            $resultUpdate = $stmtUpdate->execute();
            $stmtUpdate->close();

            if (!$resultUpdate) {
                $this->error = "Failed to update user details.";
                return false;
            }

            return true;
        } else {
            // Handle non-admin access or other logic as needed
            return false;
        }
    }
    public function deactivateUser($id, $user_id, $user_role)
    {
        $isAdmin = ($user_role == 1);

        if ($isAdmin) {
            // Update the user to set is_active to false
            $updateQuery = "UPDATE users SET is_active = 0, deleted_at = CURRENT_TIMESTAMP, deleted_by = ? WHERE id = ?";
            $stmtUpdate = $this->conn->prepare($updateQuery);
            $stmtUpdate->bind_param("ii", $user_id, $id);

            $resultUpdate = $stmtUpdate->execute();
            $stmtUpdate->close();

            if (!$resultUpdate) {
                $this->error = "Failed to update user details.";
                return false;
            }

            return true;
        } else {
            // Handle non-admin access or other logic as needed
            return false;
        }
    }

    public function isUserExists($email)
    {
        
        $check_query = "SELECT COUNT(*) AS count FROM users WHERE email = ?";

        $stmt = $this->conn->prepare($check_query);

        if (!$stmt) {
            die("Error in SQL query: " . $this->conn->error);
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();

        if (!$result) {
            $this->error = $stmt->error;
        }

        $count = $result->fetch_assoc()['count'];

        $stmt->close();

        return $count > 0;
    }
    public function confirmPassword($password, $confirmPassword)
    {
        return $password === $confirmPassword;
    }
    public function getError()
    {
        return $this->error;
    }

}


?>