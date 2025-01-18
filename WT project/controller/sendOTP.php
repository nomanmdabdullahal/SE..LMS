<?php
session_start();


if (!isset($_SESSION['reset_email'])) {
    echo "<script>alert('Session expired. Please restart the process.'); window.location.href = '../view/forgot_password.php';</script>";
    exit();
}


require_once '../model/db.php';


$validOtp = "123456"; 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enteredOtp = trim($_POST['otp']);

    
    if ($enteredOtp === $validOtp) {
        header("Location: ../view/newpassword.php"); 
        exit();
    } else {
        echo "<script>alert('Invalid OTP. Please try again.'); window.location.href = '../view/otp.php';</script>";
    }
}
?>

      
