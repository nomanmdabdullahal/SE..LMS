<?php
session_start();

require_once '../model/db.php'; 


if (!isset($_SESSION['user_id'])) {
    header("Location: ../view/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];


$user = getUserDetails($user_id, $conn);

if (!$user) {
    echo "<script>alert('User not found.'); window.location.href = '../view/login.php';</script>";
    exit();
}
?>
<html>
<head>
    <title>Profile</title>
    <link rel="icon" href="../image/r1.png" type="image/gif/png">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .profile-container {
            background: #ffffff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .profile-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .profile-group {
            margin-bottom: 15px;
        }

        .profile-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        .profile-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        .profile-group input[readonly] {
            background: #f4f4f4;
            cursor: not-allowed;
        }

        .profile-group button {
            width: 100%;
            padding: 10px;
            background: #007bff;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
        }

        .profile-group button:hover {
            background: #0056b3;
        }

        .profile-group button a {
            color: #fff;
            text-decoration: none;
            display: block;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h2>User Profile</h2>
        <form>
            <div class="profile-group">
                <label for="fname">First Name</label>
                <input type="text" id="fname" name="fname" value="<?php echo htmlspecialchars($user['first_name']); ?>" readonly>
            </div>
            <div class="profile-group">
                <label for="lname">Last Name</label>
                <input type="text" id="lname" name="lname" value="<?php echo htmlspecialchars($user['last_name']); ?>" readonly>
            </div>
            <div class="profile-group">
                <label for="phonenumber">Phone Number</label>
                <input type="text" id="phonenumber" name="phonenumber" value="<?php echo htmlspecialchars($user['phone_number']); ?>" readonly>
            </div>
            <div class="profile-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($user['address']); ?>" readonly>
            </div>
            <div class="profile-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" readonly>
            </div>
            <div class="profile-group">
                <button type="button"><a href="../view/edit.php">Edit Profile</a></button>
            </div>
        </form>
    </div>
</body>
</html>
