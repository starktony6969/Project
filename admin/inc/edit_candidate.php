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
    $query = "SELECT * FROM candidate_details WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch data and populate the form
    if ($row = $result->fetch_assoc()) {
        $election_topic = $row['election_topic'];
        $candidate_name = $row['candidate_name'];
        $Registration_No = $row['Registration_No'];
        $candidate_details = $row['candidate_details'];
        $candidate_photo = $row['candidate_photo'];
        
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
                    value="<?php echo $election_topic; ?>" required readonly /><br>
            </div>
            <div class="form-group">
                <select class="form-control" name="election_topic" required>
                    <option value="">Select Election</option>
                    <?php
                    $db = mysqli_connect("localhost", "root", "", "project") or die("Connectivity Failed");
                    $queryElections = "SELECT * FROM elections WHERE status = 'active'";
                    $resultElections = mysqli_query($db, $queryElections) or die(mysqli_error($db));

                    if (mysqli_num_rows($resultElections) > 0) {
                        while ($election = mysqli_fetch_assoc($resultElections)) {
                            $election_topic = $election['election_topic'];
                            $election_name = $election['election_topic'];
                    ?>
                    <option value="<?php echo ($election_topic); ?>"><?php echo ($election_name); ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </div>







            <div>
                <input type="text" name="candidate_name" placeholder="No of Candidates" class="form-control"
                    value="<?php echo $candidate_name; ?>" required /><br>
            </div>
            <div>
                <input type="text" name="Registration_No" placeholder="Starting Date" class="form-control"
                    value="<?php echo $Registration_No; ?>" required /><br>
            </div>
            <div>
                <input type="text" name="candidate_details" placeholder="Ending Date" class="form-control"
                    value="<?php echo $candidate_details; ?>" required /><br>
            </div>

            <div class="d-flex">

                <input type="submit" value="Update Election" name="updatecandidatebtn" class="btn btn-success " />
            </div>


        </form>
    </div>
</div>

<?php
// Handle form submission
if (isset($_POST['updatecandidatebtn'])) {
   
    $election_topic = $row['election_topic'];
        $candidate_name = $row['candidate_name'];
        $Registration_No = $row['Registration_No'];
        $candidate_details = $row['candidate_details'];
        $candidate_photo = $row['candidate_photo'];

   

    // Prepare the update query
    $update_query = "UPDATE candidate_details SET election_topic = ?, Registration_No = ?, candidate_details = ?  WHERE id = ?";
    $stmt = $db->prepare($update_query);
    $stmt->bind_param("sissi", $election_topic, $Registration_No, $candidate_details, $id);

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