<?php
session_start();
require_once '../model/db.php'; 


if (!isset($_SESSION['user_email'])) {
    header("Location: ../view/login.php");
    exit();
}

$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_SESSION['user_email']; 
    $password = trim($_POST['password']); 

    
    $storedPassword = fetchPasswordByEmail($email, $conn);

    if (!$storedPassword) {
        $errorMessage = "User not found.";
    } elseif ($password !== $storedPassword) {
        $errorMessage = "Incorrect password. Please try again.";
    } else {
        
        if (deleteUsersByEmail($email, $conn)) {
            
            session_destroy();
            echo "<script>alert('Account deleted successfully!'); window.location.href = '../view/login.php';</script>";
            exit();
        } else {
            $errorMessage = "An error occurred while deleting your account. Please try again.";
        }
    }
}
?>

<html>
<head>
    <title>Delete Account</title>
    <link rel="icon" href="../image/r1.png" type="image/gif/png">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        h2 {
            text-align: center;
            color: #444;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
        }
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            margin-top: 20px;
            width: 100%;
            padding: 10px;
            background-color: red;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: darkred;
        }
        .message {
            margin-top: 15px;
            text-align: center;
            font-weight: bold;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Delete Account</h2>
        <form action="" method="POST">
            <label for="password">Confirm Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
            <button type="submit">Delete Account</button>
        </form>
        <div class="message">
            <?php
            if (!empty($errorMessage)) {
                echo "<p class='error'>$errorMessage</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
