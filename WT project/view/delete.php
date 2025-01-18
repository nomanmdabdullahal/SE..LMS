<?php
session_start();
require_once '../model/db.php';


if (!isset($_SESSION['user_type'])) {
    header("Location: ../view/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = trim($_POST['email']);
    $response = [];

    
    if (!empty($email)) {
        // Delete user by email
        $deleted_rows = deleteUserByEmail($email);

        if ($deleted_rows > 0) {
            $response['success'] = "Account deleted successfully!";
            $response['email'] = $email; 
        } else {
            $response['error'] = "No account found with this email.";
        }
    } else {
        $response['error'] = "Please enter a valid email address.";
    }

    
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}


$users = fetchAllUsers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
    <link rel="icon" href="../image/r1.png" type="image/gif/png">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 20px;
        }
        div {
            border: 2px solid black;
            width: 700px;
            padding: 20px;
            margin: 40px auto;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
        }
        form {
            margin-top: 20px;
            text-align: center;
        }
        input[type="email"] {
            width: 300px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            color: white;
            background-color: #d9534f;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #c9302c;
        }
        #response-msg {
            margin-top: 15px;
            font-size: 16px;
            color: black; 
            border: none; 
            padding: 0;
            margin: 0; 
            background: none; 
            display: inline-block; 
            width: auto; 
        }
        #response-msg.success {
            color: green;
        }
        #response-msg.error {
            color: red;
        }
    </style>
</head>
<body>
    <div>
        <h2 style="text-align: center;">List of Users Account</h2>

        <table id="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if ($users && $users->num_rows > 0) {
                    while ($row = $users->fetch_assoc()) {
                        echo "<tr data-email='" . htmlspecialchars($row['email']) . "'>";
                        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['first_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['last_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['phone_number']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No users found.</td></tr>";
                }
            ?>
            </tbody>
        </table>

        <form id="delete-form">
            <label for="email">Enter user Email to Delete Account:</label><br>
            <input type="email" name="email" id="email" placeholder="User Email" required><br>
            <button type="submit">Delete Account</button>
        </form>

        <div id="response-msg"></div>
    </div>

    <script>
        document.getElementById('delete-form').addEventListener('submit', function(e) {
            e.preventDefault();  

            const email = document.getElementById('email').value;  
            const responseMsg = document.getElementById('response-msg');  

            
            responseMsg.textContent = '';
            responseMsg.className = '';

            
            fetch('delete.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `email=${encodeURIComponent(email)}`,
            })
            .then(response => response.json())  // Parse JSON response
            .then(data => {
                if (data.success) {
                    responseMsg.className = 'success';
                    responseMsg.textContent = data.success;

                    
                    const row = document.querySelector(`tr[data-email="${email}"]`);
                    if (row) {
                        row.remove();
                    }
                } else if (data.error) {
                    responseMsg.className = 'error';
                    responseMsg.textContent = data.error;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                responseMsg.className = 'error';
                responseMsg.textContent = 'An error occurred. Please try again.';
            });
        });
    </script>
</body>
</html>
