<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'adminpanel');
define('SITE_URL', 'http://realestatephp.test/views/');
define('URL', 'http://realestatephp.test/');

define('ESTATE_URL', 'http://realestatephp.test/realestate/');
define('ABOUT_URL', 'http://realestatephp.test/aboutus/');
define('USER_URL', 'http://realestatephp.test/users/');


include_once('DatabaseConnection.php');

$db = new DatabaseConnection;

function base_url($slug){
    echo SITE_URL.$slug;
}
function url($slug){
    echo URL.$slug;
}

function estate_url($slug){
    echo ESTATE_URL.$slug;
}

function about_url($slug){
    echo ABOUT_URL.$slug;
}
function user_url($slug){
    echo USER_URL.$slug;
}

function redirect($message, $page){
    $redirectTo = SITE_URL.$page;
    $_SESSION['message']= "$message";
    header("Location: $redirectTo");
    exit(0);
}

function redirectTo($message, $page){
    $redirectTo = ESTATE_URL.$page;
    $_SESSION['message']= "$message";
    header("Location: $redirectTo");
    exit(0);
}

function redirectToAbout($message, $page){
    $redirectTo = ABOUT_URL.$page;
    $_SESSION['message']= "$message";
    header("Location: $redirectTo");
    exit(0);
}
function redirectToUsers($message, $page){
    $redirectTo = USER_URL.$page;
    $_SESSION['message']= "$message";
    header("Location: $redirectTo");
    exit(0);
}


function validateInput($dbcon,  $input){
    return mysqli_real_escape_string($dbcon, $input);
}
?>