<?php
session_start();


require_once '../model/db.php';


if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: ../view/login.php");
    exit();
}


$total_users = getTotalUsers($conn);
?>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="icon" href="../image/r1.png" type="image/gif/png">
    
</head>
<body>

    
    <div >
        <h1>Admin Dashboard</h1>
        <div>Logged in as: Admin</div>
    </div>


    <div>
        <h2>Admin Panel</h2>
        <ul>
            
            <li><a href="#userManagement">User Management</a></li>
            <li><a href="#userRegistrationApproval">User Registration Approval</a></li>
            <li><a href="#chargingStationManagement">Charging Station Management</a></li>
            <li><a href="#energyAnalytics">Energy Analytics</a></li>
            <li><a href="#transactionManagement">Transaction Management</a></li>
            <li><a href="../view/delete.php">Remove User</a></li> 
            <li><a href="../controller/logout.php">Logout</a></li>
        </ul>
    </div>

    
    <div>
        <h2>Welcome to the Admin Dashboard</h2>
        <div>
            <div>
                <h3>Total Users</h3>
                <p><?php echo htmlspecialchars($total_users); ?></p>
            </div>
            
            <div>
                <h3>System Status</h3>
                <p>Operational</p>
            </div>
        </div>
        <div>
            <p>&copy; 2024 Admin Dashboard. All rights reserved.</p>
        </div>
    </div>

</body>
</html>
