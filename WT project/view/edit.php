<?php
session_start();
require_once '../model/db.php'; 


if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit();
}

$user_id = $_SESSION['user_id'];


$user = getUserDetails($user_id, $conn);

if (!$user) {
    echo json_encode(['error' => 'User not found']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = trim($_POST['fname']);
    $last_name = trim($_POST['lname']);
    $phone_number = trim($_POST['phonenumber']);
    $address = trim($_POST['address']);
    $email = trim($_POST['email']);

    
    if (!ctype_upper($first_name[0]) || preg_match('/[^a-zA-Z\s.\-]/', $first_name)) {
        echo json_encode(['error' => 'Invalid first name format']);
        exit();
    }

    if (!ctype_upper($last_name[0]) || preg_match('/[^a-zA-Z\s.\-]/', $last_name)) {
        echo json_encode(['error' => 'Invalid last name format']);
        exit();
    }

    if (strlen($phone_number) != 10 || !ctype_digit($phone_number)) {
        echo json_encode(['error' => 'Invalid phone number']);
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['error' => 'Invalid email address']);
        exit();
    }

    
    if (updateUserProfile($user_id, $first_name, $last_name, $phone_number, $address, $email, $conn)) {
        echo json_encode(['success' => 'Profile updated successfully']);
    } else {
        echo json_encode(['error' => 'Error updating profile. Please try again later']);
    }
    exit();
}
?>

<html>
<head>
    <title>Edit Profile</title>
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

        .edit-container {
            background: #ffffff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .edit-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .edit-group {
            margin-bottom: 15px;
        }

        .edit-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        .edit-group input,
        .edit-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        .edit-group textarea {
            resize: none;
        }

        .edit-group button {
            width: 100%;
            padding: 10px;
            background: #007bff;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        .edit-group button:hover {
            background: #0056b3;
        }

        .alert {
            color: red;
            text-align: center;
            margin-top: 10px;
        }

        .success {
            color: green;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="edit-container">
        <h2>Edit Profile</h2>
        <form id="edit-profile-form">
            <div class="edit-group">
                <label for="fname">First Name</label>
                <input type="text" id="fname" name="fname" value="<?php echo htmlspecialchars($user['first_name']); ?>" required>
            </div>
            <div class="edit-group">
                <label for="lname">Last Name</label>
                <input type="text" id="lname" name="lname" value="<?php echo htmlspecialchars($user['last_name']); ?>" required>
            </div>
            <div class="edit-group">
                <label for="phonenumber">Phone Number</label>
                <input type="text" id="phonenumber" name="phonenumber" value="<?php echo htmlspecialchars($user['phone_number']); ?>" required>
            </div>
            <div class="edit-group">
                <label for="address">Address</label>
                <textarea id="address" name="address"><?php echo htmlspecialchars($user['address']); ?></textarea>
            </div>
            <div class="edit-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <div class="edit-group">
                <button type="submit">Save Changes</button>
            </div>
        </form>
        <p id="response-msg" class="alert"></p>
    </div>

    <script>
        document.getElementById('edit-profile-form').addEventListener('submit', function (e) {
            e.preventDefault(); 

            let formData = new FormData(this);

            let xhttp = new XMLHttpRequest();
            xhttp.open('POST', '', true); 
            xhttp.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    let response = JSON.parse(this.responseText);
                    if (response.success) {
                        document.getElementById('response-msg').className = 'success';
                        document.getElementById('response-msg').innerText = response.success;
                    } else if (response.error) {
                        document.getElementById('response-msg').className = 'alert';
                        document.getElementById('response-msg').innerText = response.error;
                    }
                }
            };
            xhttp.send(formData);
        });
    </script>
</body>
</html>
