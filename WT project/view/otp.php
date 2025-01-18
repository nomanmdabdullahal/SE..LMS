<html>
<head>
    <title>Enter OTP</title>
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

        #verify {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            font-weight: bold;
            background-color: blue;
            color: white;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

            #verify:hover {
                background-color: darkblue;
            }

        p {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div>
        <form method="POST" action="../controller/sendOTP.php">
            <h2 style="text-align: center;">Enter OTP</h2>
            <label for="otp">Enter the OTP sent to your email:</label><br>
            <input type="password" name="otp" placeholder="Enter OTP" required><br>
            <input id="verify" type="submit" value="Verify OTP"><br>
        </form>
        <p><a href="../view/forgot_password.php"><b>Resend OTP</b></a></p>
    </div>
</body>
</html>
