<?php
session_start();

if (!isset($_SESSION['reset_email'])) {
    echo "<script>alert('Session expired.'); window.location.href = '../view/forgot_password.php';</script>";
    exit();
}


require_once '../model/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newPassword = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirm_password']);
    $email = $_SESSION['reset_email'];

    
    if ($newPassword !== $confirmPassword) {
        echo "<script>alert('Passwords do not match. Please try again.'); window.location.href = '../view/newpassword.php';</script>";
        exit();
    }

    
    if (updateUserPasswordByEmail($email, $newPassword)) {
        unset($_SESSION['reset_email']); 
        echo "<script>alert('Password updated successfully!'); window.location.href = '../view/login.php';</script>";
        exit();
    } else {
        echo "<script>alert('Error updating password. Please try again later.'); window.location.href = '../view/newpassword.php';</script>";
    }
}
?>

<html>
<head>
    <title>Reset Password</title>
    <link rel="icon" href="../image/r1.png" type="image/gif/png">
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }

        div {
            border: 2px solid black;
            width: 400px;
            padding: 20px;
            margin: 50px auto;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
        }

        input {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        #update {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            font-weight: bold;
            background-color: green;
            color: white;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        #update:hover {
            background-color: darkgreen;
        }

        p {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div>
        <form method="POST" action="">
            <h2 style="text-align: center;">Reset Password</h2>
            <label for="password">Enter New Password:</label><br>
            <input type="password" name="password" placeholder="Enter new password" required><br>
            <label for="confirm_password">Confirm New Password:</label><br>
            <input type="password" name="confirm_password" placeholder="Confirm new password" required><br>
            <input id="update" type="submit" value="Update Password"><br>
        </form>
        <p><a href="../view/login.php"><b>Back to Login</b></a></p>
    </div>
</body>
</html>
