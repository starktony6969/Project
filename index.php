<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Login</title>
    <style>
    body {
        background-image: url(https://plus.unsplash.com/premium_photo-1708345949125-22c9889f2680?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D);
        background-size: cover;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="box form-box">
            <?php
                include("admin/inc/config.php"); 

                if (isset($_POST['submit'])) {
                    $name = $_POST['Name'];
                    $password = $_POST['Password'];

                    $query = "SELECT * FROM users WHERE name='".$name."' AND password='".$password."'";
                    $result = mysqli_query($db, $query);

                    if ($result && $result->num_rows > 0) {
                        $row = $result->fetch_assoc();

                        session_start();
                        $_SESSION['user_role'] = $row['user_role'];
                        $_SESSION['Name'] = $row['Name'];
                        $_SESSION['user_id'] = $row['id'];

                        if ($row['user_role'] == "Admin") {
                            $_SESSION['key'] = "AdminKey";
                            echo "<script> location.assign('admin/adminhome.php?homepage=1'); </script>";
                        } else {
                            $_SESSION['key'] = "VotersKey";
                            echo "<script> location.assign('voters/home.php'); </script>";
                        }
                        exit;
                    } else {
                        echo "<p>Invalid username or password.</p>";
                    }
                }
            ?>

            <header>Login</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="Name">Name</label>
                    <input type="text" name="Name" id="Name" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="Password">Password</label>
                    <input type="Password" name="Password" id="Password" autocomplete="off" required>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Login">
                </div>

                <div class="links">
                    Not registered? <a href="register.php">Register</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>