<?php


// Connect to the database
require_once("header.php");
require_once("navigation.php");

?>
<link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
<link rel="stylesheet" href="../../assets/css/style.css">
<script src="../../assets/js/jquery.min.js"></script>
<script src="../../assets/js/bootstrap.min.js"></script>
<?php
// Connect to the database
$db = new mysqli("localhost", "root", "", "project");

// Check if ID is set and fetch election data
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare the query
    $query = "SELECT * FROM elections WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch data and populate the form
    if ($row = $result->fetch_assoc()) {
        $election_topic = $row['election_topic'];
        $number_of_candidates = $row['no_of_candidates'];
        $starting_date = $row['starting_date'];
        $ending_date = $row['ending_date'];
    }
    // Close the statement
    $stmt->close();
} else {
    
    // Redirect if ID is not set
    header("Location: /project/admin/adminhome.php?addElectionPage=1");
    exit;
}
?>

<!-- Form to edit election -->
<div class="row my-3 p-4">
    <div class="col-md-6">
        <h3>Edit // -> <a href=""> <?php echo $election_topic; ?></a> </h3>
        <form method="POST">
            <div>
                <input type="text" name="election_topic" placeholder="Election Topic" class="form-control"
                    value="<?php echo $election_topic; ?>" required /><br>
            </div>
            <div>
                <input type="number" name="number_of_candidates" placeholder="No of Candidates" class="form-control"
                    value="<?php echo $number_of_candidates; ?>" required /><br>
            </div>
            <div>
                <input type="date" name="starting_date" placeholder="Starting Date" class="form-control"
                    value="<?php echo $starting_date; ?>" required /><br>
            </div>
            <div>
                <input type="date" name="ending_date" placeholder="Ending Date" class="form-control"
                    value="<?php echo $ending_date; ?>" required /><br>
            </div>

            <div class="d-flex">
                <input type="submit" value="Back" name="updateElectionBtn" class="btn btn-danger mr-5" />

                <input type="submit" value="Update Election" name="updateElectionBtn" class="btn btn-success " />
            </div>


        </form>
    </div>
</div>

<?php
// Handle form submission
if (isset($_POST['updateElectionBtn'])) {
    $election_topic = $_POST['election_topic'];
    $number_of_candidates = $_POST['number_of_candidates'];
    $starting_date = $_POST['starting_date'];
    $ending_date = $_POST['ending_date'];
    $inserted_on = date("Y-m-d");


    // Calculate the status based on dates
    $status = '';
    if ($inserted_on < $starting_date) {
        $status = "Coming";
    } elseif ($inserted_on >= $starting_date && $inserted_on <= $ending_date) {
        $status = "Active";
    } else {
        $status = "Expired";
    }

    // Prepare the update query
    $update_query = "UPDATE elections SET election_topic = ?, no_of_candidates = ?, starting_date = ?, ending_date = ?, status = ?, inserted_on = ? WHERE id = ?";
    $stmt = $db->prepare($update_query);
    $stmt->bind_param("sissssi", $election_topic, $number_of_candidates, $starting_date, $ending_date, $status, $inserted_on, $id);

    // Execute the update query
    if ($stmt->execute()) {
        // Redirect after successful update
        header('Location: /project/admin/adminhome.php?addElectionPage=1');
        exit;
    } else {
        echo "Error updating record: " . $stmt->error;
    }
    
    // Close the statement
    $stmt->close();
}

// Close the database connection
$db->close();
?>