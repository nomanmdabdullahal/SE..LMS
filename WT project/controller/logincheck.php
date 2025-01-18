<?php
session_start();

require_once '../model/db.php';

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format!'); window.location.href = '../view/login.php';</script>";
        exit();
    }

    
    $user = getUserByEmail($email, $conn);

    if ($user) {

        if (verifyPassword($password, $user['password'])) { 
            
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_name'] = $user['first_name'];
            $_SESSION['user_last_name'] = $user['last_name'];
            $_SESSION['user_type'] = $user['type'];

        
            if (isset($_POST['remember'])) {
                setcookie("user_email", $email, time() + (86400 * 30), "/");
                setcookie("user_password", $password, time() + (86400 * 30), "/");
            } else {
                setcookie("user_email", "", time() - 3600, "/");
                setcookie("user_password", "", time() - 3600, "/");
            }

            
            if ($user['type'] === 'admin') {
                header("Location: ../view/admin_dashboard.php");
            } else {
                header("Location: ../view/user.php");
            }
            exit();
        } else {
            echo "<script>alert('Incorrect password!'); window.location.href = '../view/login.php';</script>";
        }
    } else {
        echo "<script>alert('No account found with this email!'); window.location.href = '../view/login.php';</script>";
    }
} else {
    header("Location: ../view/login.php");
    exit();
}
?>
