<?php 
include_once('../config/app.php');

class LoginController {

    public $conn;

    public function __construct() {
        $db = new DatabaseConnection;
        $this->conn = $db->conn;
    }
    
    public function userLogin($email, $password) {
        $query = "SELECT * FROM users WHERE email = ? AND is_active = 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
    
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
    
            if (password_verify($password, $user['password'])) {
                $this->createSession($user);
                return $user;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
    

    public function createSession($user) {
        // Set the session lifetime to 2 minutes (60 seconds * 2)
        $sessionLifetime = 60 * 10;
        ini_set('session.gc_maxlifetime', $sessionLifetime);
    
        session_start();
    
        // Set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['fname'] = $user['fname'];
        $_SESSION['lname'] = $user['lname'];
        $_SESSION['role'] = $user['isadmin'];
    
        // Set the session cookie lifetime to match the session lifetime
        setcookie(session_name(), session_id(), time() + $sessionLifetime, '/');
    
        header("Location: index.php");
        exit();
    }
}
?>
