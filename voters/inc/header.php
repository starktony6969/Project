<?php 

    require_once("../admin/inc/config.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voters Panel - Online Voting System</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row bg-black text-white">

            <div class="col-11 my-auto">
                <center>
                    <h3> ONLINE VOTING SYSTEM </h3>
                    <?php
                  
// Database connection
$db = mysqli_connect("localhost", "root", "", "project") or die("Connectivity Failed");



// Get the session user ID
$id = $_SESSION['user_id'];

// Fetch voter data from the database
$queryVoters = "SELECT Name FROM users WHERE id= '$id'";
$resultVoters = mysqli_query($db, $queryVoters);

// Check if data is found and display it
if (mysqli_num_rows($resultVoters) > 0) {
    while ($voter = mysqli_fetch_assoc($resultVoters)) {
        // Retrieve values
        $name = htmlspecialchars($voter['Name']);
    
        
        // Display voter information
        echo '<div class="section mb-3">';
        echo '<div><strong>Welcome</strong> ' . $name . '</div>';
      
        echo '</div>';
    }
} else {
    // Display a message if no data is found
    echo '<p>No voter data found.</p>';
}             

?>


                </center>
            </div>
        </div>