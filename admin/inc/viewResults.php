<?php 
    include 'config.php';

    $election_id = $_GET['viewResult'];

?>

<div class="row my-3">
        <div class="col-12">
            <h3> Election Results </h3>

            <?php

                $queryElections = ( "SELECT * FROM elections WHERE id = '". $election_id ."'");
                $resultElections = mysqli_query($db, $queryElections) or die(mysqli_error($db));

   if (mysqli_num_rows($resultElections) > 0) {
   while ($election = mysqli_fetch_assoc($resultElections)) {

    $election_id = $election['id'];
    $election_name = $election['election_topic'];
  

     }  ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th colspan="4" class="bg-green text-white"><h5> ELECTION TOPIC: <?php echo strtoupper($election_name); ?></h5></th>
                        </tr>
                        <tr>
                            <th> Photo </th>
                            <th> Registration_No </th>
                            <th> Candidate Details </th>
                            <th> No of Votes </th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        
                    <?php
                    
                         $query= ("SELECT * FROM candidate_details WHERE election_topic= '". $election_name ."'") ;
                         $result = mysqli_query($db, $query) or die(mysqli_error($db)) ;
                         if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {

                            $candidate_id = $row['id'];
                            $candidate_photo = $row['candidate_photo'];
                            $Registration_No = $row['Registration_No'];

                            // Fetching Candidate Votes 
                            $fetchingVotes = mysqli_query($db, "SELECT * FROM votings WHERE candidate_id = '". $candidate_id . "'") or die(mysqli_error($db));
                            $totalVotes = mysqli_num_rows($fetchingVotes);
                    ?>
                            <tr>
                            
                                <td> <img src="<?php echo $candidate_photo; ?>" class="candidate_photo"> </td>
                                <td><?php echo $Registration_No?></td>
                                <td><?php echo "<b>" . $row['candidate_name'] . "</b><br />" . $row['candidate_details']; ?></td>
                                <td><?php echo $totalVotes; ?></td>
                                <td>
                                <?php
                                }
                            ?>
                            </tbody>

                        </table>
                <?php
                    
                    }
                }else {
                    echo "No any active election.";
                }
            ?>

        </div>
</div>
