<html>
<head>
    <title>Registration Form</title>
    <link rel="icon" href="../image/r1.png" type="image/gif/png">
    <style>
        body {
            background-image: url('../image/r1.png');
            background-size: cover;
            font-family: Arial, sans-serif;
        }
        div {
            border: 2px solid black;
            width: 450px;
            padding: 20px;
            margin: 40px auto;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
        }
        #firstname, #lastname, #phonenumber, #address, #email, #password, #cpassword {
            width: 300px;
            padding: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        form {
            margin-left: 30px;
        }
        #submit {
            margin-left: 100px;
            width: 150px;
            padding: 5px;
            font-size: 18px;
            font-weight: bold;
            background-color: blue;
            color: white;
            border-radius: 20px;
            border: 1px solid blue;
        }
        #submit:hover {
            background-color: darkblue;
        }
        .login-link {
            text-align: center;
            margin-top: 15px;
            background: none;
            border: none;
            padding: 0;
            box-shadow: none;
        }
        .login-link a {
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            color: blue;
        }
        .login-link a:hover {
            color: darkblue;
        }
    </style>
    <script src="../javascript/reg.js" defer></script>
    
</head>
<body>
    <div>
        <form action="" method="POST">
            <h2 style="text-align: center;"><b>Registration</b></h2>

            <label for="firstname"><b>First Name</b></label><br>
            <input id="firstname" type="text" name="firstname" placeholder="Enter your first name" required>
            <br><br>

            <label for="lastname"><b>Last Name</b></label><br>
            <input id="lastname" type="text" name="lastname" placeholder="Enter your last name" required>
            <br><br>

            <label for="phonenumber"><b>Phone Number</b></label><br>
            <input id="phonenumber" type="text" name="phonenumber" placeholder="Enter your phone number" required>
            <br><br>

            <label for="address"><b>Address:</b></label><br>
            <textarea id="address" name="address" placeholder="Enter your address"></textarea>
            <br><br>

            <label for="email"><b>Email</b></label><br>
            <input id="email" type="email" name="email" placeholder="Enter your email address" required>
            <br><br>

            <label for="password"><b>Password</b></label><br>
            <input id="password" type="password" name="password" placeholder="Enter your password" required>
            <br><br>

            <label for="cpassword"><b>Confirm Password</b></label><br>
            <input id="cpassword" type="password" name="cpassword" placeholder="Re-enter your password" required>
            <br><br>

            <input id="submit" type="submit" name="submit" value="Register"><br>
        </form>

        <div class="login-link">
            <p>Already have an account? <a href="../view/login.php">Login here</a></p>
        </div>
    </div>
    <?php
    session_start();
    require_once '../model/db.php';

    if (isset($_POST['submit'])) {
        $firstname = trim($_POST['firstname']);
        $lastname = trim($_POST['lastname']);
        $phonenumber = trim($_POST['phonenumber']);
        $address = trim($_POST['address']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $cpassword = trim($_POST['cpassword']);

        $errors = [];

        
        if (!ctype_upper($firstname[0]) || preg_match('/[^a-zA-Z\s.\-]/', $firstname)) {
            $errors[] = "First name must start with a capital letter and can only include letters, spaces, dots (.), or hyphens (-).";
        }

        if (!ctype_upper($lastname[0]) || preg_match('/[^a-zA-Z\s.\-]/', $lastname)) {
            $errors[] = "Last name must start with a capital letter and can only include letters, spaces, dots (.), or hyphens (-).";
        }

        if (strlen($phonenumber) != 11 || !is_numeric($phonenumber)) {
            $errors[] = "Phone number must be 11 digits.";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format. Email must include '@' and '.'";
        }

        if (strlen($password) < 8) {
            $errors[] = "Password must be at least 8 characters long.";
        }

        if ($password !== $cpassword) {
            $errors[] = "Passwords do not match.";
        }

        if (emailExists($email, $conn)) {
            $errors[] = "An account with this email already exists.";
        }


        if (empty($errors)) {
            if (registerUser($firstname, $lastname, $phonenumber, $address, $email, $password, $conn)) {
                $_SESSION['success'] = "Registration successful. Please log in.";
                header("Location: ../view/login.php");
                exit();
            } else {
                echo "<script>alert('Error: Could not register.');</script>";
            }
        } else {
            foreach ($errors as $error) {
                echo "<script>alert('$error');</script>";
            }
        }
    }
?>

</body>
</html>
