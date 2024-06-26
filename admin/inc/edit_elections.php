<?php


require_once("header.php");
require_once("navigation.php");

?>
<link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
<link rel="stylesheet" href="../../assets/css/style.css">
<script src="../../assets/js/jquery.min.js"></script>
<script src="../../assets/js/bootstrap.min.js"></script>
<?php

$db = new mysqli("localhost", "root", "", "project");


if (isset($_GET['id'])) {
    $id = $_GET['id'];

   
    $query = "SELECT * FROM elections WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $election_topic = $row['election_topic'];
        $number_of_candidates = $row['no_of_candidates'];
        $starting_date = $row['starting_date'];
        $ending_date = $row['ending_date'];
    }
 
    $stmt->close();
} else {
    
    
    header("Location: /project/admin/adminhome.php?addElectionPage=1");
    exit;
}
?>

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
                <label for="starting_date">Starting Date</label>
                <input type="date" name="starting_date" id="starting_date" value="<?php echo $starting_date; ?>"
                    class="form-control" />
                <span class="text-danger"><?php echo isset($starting_date_err) ? $starting_date_err : ''; ?></span><br>
            </div>
            <div>
                <label for="starting_date">Ending Date</label>
                <input type="date" name="ending_date" id="ending_date" placeholder="Ending Date" class="form-control"
                    value="<?php echo $ending_date; ?>" required />
                <span class="text-danger"><?php echo isset($ending_date_err) ? $ending_date_err : ''; ?></span><br>
            </div>

            <div class="d-flex">
                <input type="submit" value="Back" name="updateElectionBtn" class="btn btn-danger mr-5" />

                <input type="submit" value="Update Election" name="updateElectionBtn" class="btn btn-success " />
            </div>


        </form>
    </div>
</div>

<?php
          
            if (empty($_POST["starting_date"])) {
                $starting_date_err = "Starting date is required";
            }

            if (empty($_POST["ending_date"])) {
                $ending_date_err = "Ending date is required";
            }


if (isset($_POST['updateElectionBtn'])) {
    $election_topic = $_POST['election_topic'];
    $number_of_candidates = $_POST['number_of_candidates'];
    $starting_date = $_POST['starting_date'];
    $ending_date = $_POST['ending_date'];
    $inserted_on = date("Y-m-d");


     
        $date1 = date_create($inserted_on);
        $date2 = date_create($starting_date);
        $date3 = date_create($ending_date);

        $diff = date_diff($date1, $date2);

        
        if ($starting_date < $inserted_on) {
            echo "Error: please fill the details.";
            exit;
        }

    
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

    // Execute the update query..
    if ($stmt->execute()) {
        // Redirect after successful update..
        header('Location: /project/admin/adminhome.php?addElectionPage=1');
        exit;
    } else {
        echo "Error updating record: " . $stmt->error;
    }
    
    // Close the statement
    $stmt->close();
}

// Close the database connection.
$db->close();
?>


<script>
var today = new Date().toISOString().split('T')[0];

document.getElementById('starting_date').min = today;

document.getElementById('ending_date').min = today;

function confirmDelete() {
    return confirm('Are you sure you want to delete?');
}
</script>