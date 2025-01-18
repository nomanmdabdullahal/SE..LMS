<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: ../view/login.php");
    exit();
}


require_once '../model/db.php';


$user_id = $_SESSION['user_id'];
$first_name = $_SESSION['user_name'];
$last_name = $_SESSION['user_last_name'];

$user = getUserById($user_id, $conn);


$address = $user['address'] ?? '';
$profile_completion = empty($address) ? 80 : 100;
?>
<html>
<head>
    <title>User Dashboard</title>
    <link rel="icon" href="../image/r1.png" type="image/gif/png">
    
</head>
<body>

    
    <div>
        <h1>User Dashboard</h1>
        <div class="profile">Welcome, <?php echo htmlspecialchars($first_name . " " . $last_name); ?></div>
    </div>

    
    <div>
        <h2>Menu</h2>
        <ul>
            <li><a href="../view/profile.php">My Profile</a></li>           
            <li><a href="../view/change_password.php">Change Password</a></li>
            <li><a href="../controller/logout.php">Logout</a></li>
            <li><a href="../view/delete_account.php">Setting</a></li>
           
        </ul>
    </div>

    
    <div>
        <h2>Welcome to Your Dashboard</h2>
        <div>
            
            <div>
                <h3>Profile Completion</h3>
                <p><?php echo $profile_completion; ?>% completed</p>
            </div>
            <div>
                <h3>Account Status</h3>
                <p>Active</p>
            </div>
        </div>
        <div>
            <p>&copy; 2024 User Dashboard. All rights reserved.</p>
        </div>
    </div>

</body>
</html>
