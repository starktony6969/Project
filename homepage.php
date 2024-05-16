<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    .container {
        width: 80%;
        margin: auto;
        overflow: hidden;
    }

    header {
        background: #50a3a2;
        color: #ffffff;
        padding-top: 30px;
        min-height: 70px;
        border-bottom: #077187 1px solid;
    }

    header h1 {
        text-align: center;
        margin: 0;
        padding-bottom: 10px;
        font-weight: bold;
        color: black;
    }

    body,
    html {
        height: 100%;
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;

        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;

    }

    .content {
        height: 100%;
        padding: 20px;
        text-align: center;
        background-image: url('p.jpg');
        background-size: cover;
        background-position: center;
        color: black;
        font-weight: bold;
    }

    .button-group {
        margin: 20px 0;
        margin-top: 80px;

    }

    .login-button,
    .register-button {
        display: inline-block;
        width: 200px;
        padding: 10px;
        background-color: #50a3a2;
        color: black;
        text-align: center;
        text-decoration: none;
        border-radius: 5px;
        margin: 0 10px;
    }

    .subtext {
        font-size: 16px;
        /* Example size; adjust as needed */
        color: #333;
        /* Dark grey text color; adjust as needed */
        font-weight: bold;
        text-align: center
            /* Add more styling as needed */
    }
    </style>
</head>

<body>
    <header>
        <h1>Welcome To Our Website</h1>
        <p class="subtext">Online Voting System</p>
        </div>
    </header>

    <div class="content">
        <div class="container">
            <h2>Online Voting System</h2>
            <p>Welcome to our Online Voting Platform, the premier destination for secure, transparent, and accessible
                online voting. Our platform offers a seamless and straightforward voting process for a wide range of
                elections, from local community polls to organizational elections. With cutting-edge security and
                user-friendly design, participating in democracy has never been easier.</p>

            <!-- Button group for both Login and Register -->
            <div class="button-group">
                <a href="index.php" class="login-button">Login</a>
                <a href="register.php" class="register-button">Register</a>
            </div>
        </div>
    </div>
</body>

</html>