<div class="row my-3">
    <div class="col-4">
        <h3>Add New Election</h3>
        <form method="POST">
            <div>
                <input type="text" name="election_topic" placeholder="Election Topic" class="form-control"
                    required /><br>
            </div>
            <div>
                <input type="number" name="number_of_candidates" placeholder="No of Candidates" class="form-control"
                    required /><br>
            </div>
            <div>
                <input type="text" onfocus="this.type='Date'" name="starting_date" placeholder="Starting Date"
                    class="form-control" required /><br>
            </div>
            <div>
                <input type="text" onfocus="this.type='Date'" name="ending_date" placeholder="Ending Date"
                    class="form-control" required /><br>
            </div>
            <input type="submit" value="Add Election" name="addElectionBtn" class="btn btn-success" /><br>
        </form>
    </div>

    <?php 
    include 'config.php';

    if(isset($_POST['addElectionBtn']))
    {
        $election_topic =$_POST['election_topic'];
        $number_of_candidates =$_POST['number_of_candidates'];
        $starting_date = $_POST['starting_date'];
        $ending_date = $_POST['ending_date'];
        $inserted_on = date("Y-m-d");
    
        // Create date objects
        $date1 = date_create($inserted_on);
        $date2 = date_create($starting_date);
        $date3 = date_create($ending_date);
    
        // Calculate difference
        $diff = date_diff($date1, $date2);
    
        // Check if the starting date is in the past
        if ($starting_date < $inserted_on) {
            echo "Error: Past date can't be selected/added.";
            exit;
        }
    
        // Determine status
        if ($inserted_on < $starting_date) {
            $status = "Coming";
        } elseif ($inserted_on >= $starting_date && $inserted_on <= $ending_date) {
            $status = "Active";
        } else {
            $status = "Expired";
        }
    

        
        mysqli_query($db, "INSERT INTO elections(election_topic, no_of_candidates, starting_date, ending_date, status,  inserted_on) VALUES('". $election_topic ."', '". $number_of_candidates ."', '". $starting_date ."', '". $ending_date ."', '". $status ."', '". $inserted_on ."')") or die(mysqli_error($db));
        
     } ?>

    <div class="col-8">
        <h3>Upcoming Elections</h3>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Election Name</th>
                    <th scope="col"># Candidates</th>
                    <th scope="col">Starting Date</th>
                    <th scope="col">Ending Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                <?php
            include'config.php';
            $query = "SELECT * FROM elections";
            $result = mysqli_query($db, $query);
            if (mysqli_num_rows($result) > 0) {
                $sno = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo  "<tr>";
                    echo "<td>" . $sno++ . "</td>";
                    echo "<td>" . $row['election_topic'] . "</td>";
                    echo "<td>" . $row['no_of_candidates'] . "</td>";
                    echo "<td>" . $row['starting_date'] . "</td>";
                    echo "<td>" . $row['ending_date'] . "</td>";
                    echo "<td>" . $row['status'] . "</td>";
                    // Add your action buttons or links here
                    echo "<td><a href='/project/admin/inc/edit_elections.php?id=" . $row['id'] . "'>Edit</a> | <a name ='delelectionsbtn' href='/project/admin/inc/delete_elections.php?id=" . $row['id'] . "'>Delete</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No upcoming elections found.</td></tr>";
            }
            ?>