<?php
session_start(); // Ensure session is started
require_once("inc/header.php");
require_once("inc/navigation.php");

// Ensure user is logged in or redirect
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Database connection
$db = mysqli_connect("localhost", "root", "", "project") or die("Connectivity Failed");

// Start the main container
echo '<div class="row my-3">';
echo '<div class="col-12">';
echo '<h3>Voters Panel</h3>';

// Get the session user ID
$id = $_SESSION['user_id'];

// Fetch voter data from the database
$queryVoters = "SELECT Name, Contact, Registration_No FROM users WHERE id= '$id'";
$resultVoters = mysqli_query($db, $queryVoters);

// Check if data is found and display it
if (mysqli_num_rows($resultVoters) > 0) {
    while ($voter = mysqli_fetch_assoc($resultVoters)) {
        // Retrieve values
        $name = htmlspecialchars($voter['Name']);
        $contact = htmlspecialchars($voter['Contact']);
        $registrationNo = htmlspecialchars($voter['Registration_No']);
        
        // Display voter information
        echo '<div class="section mb-3">';
        echo '<div><strong>Name:</strong> ' . $name . '</div>';
        echo '<div><strong>Contact:</strong> ' . $contact . '</div>';
        echo '<div><strong>Registration No:</strong> ' . $registrationNo . '</div>';
        echo '</div>';
    }
} else {
    // Display a message if no data is found
    echo '<p>No voter data found.</p>';
}

// Close main container
echo '</div>';
echo '</div>';

require_once("inc/footer.php"); // Include the footer
?>