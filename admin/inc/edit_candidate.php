<?php

require_once("header.php");
require_once("navigation.php");
    $db = new mysqli("localhost", "root", "", "project");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM candidate_details WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $election_topic = $row['election_topic'];
        $candidate_name = $row['candidate_name'];
        $Registration_No = $row['Registration_No'];
        $candidate_details = $row['candidate_details'];
    }
   
    $stmt->close();
}
?>

<link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
<link rel="stylesheet" href="../../assets/css/style.css">
<script src="../../assets/js/jquery.min.js"></script>
<script src="../../assets/js/bootstrap.min.js"></script>

<div class="row my-3 p-4">
    <div class="col-md-6">
        <h3>Edit Candidates</h3>

        <form method="POST" enctype="multipart/form-data">
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

            <div class="form-group">
                <input type="text" name="candidate_name" placeholder="Candidate Name" class="form-control"
                    value="<?php echo $candidate_name; ?>" required />
            </div>
            <div class="form-group">
                <input type="file" name="candidate_photo" class="form-control" required />
            </div>
            <div class="form-group">
                <input type="text" name="Registration_No" placeholder="Registration_No" class="form-control"
                    value="<?php echo $Registration_No; ?>" required />
            </div>
            <div class="form-group">
                <input type="text" name="candidate_details" placeholder="Candidate Details" class="form-control"
                    value="<?php echo $candidate_details; ?>" required />
            </div>
            <input type="button" value="Back" class="btn btn-danger mr-5" onclick="history.back()" />

            <input type="submit" value="Update Candidate" name="editCandidateBtn" class="btn btn-success" />
        </form>
    </div>


    <?php 
   $db = mysqli_connect("localhost", "root", "", "project") or die("Connectivity Failed");

    if(isset($_POST['editCandidateBtn']))
    {
        $candidate_name =$_POST['candidate_name'];
        $Registration_No=$_POST['Registration_No'];
        $candidate_details = $_POST['candidate_details'];
        $election_topic=$_POST['election_topic'];
        $inserted_on = date("Y-m-d");
        $traggetted_folder="../assets/images/candidate_photos/"; 
        $candidate_photo =$traggetted_folder .$_FILES['candidate_photo']['name'];
        $candidate_photo_tmp_name = $_FILES['candidate_photo']['name'];
        $candidate_photo_type = strtolower(pathinfo($candidate_photo, PATHINFO_EXTENSION));
        $allowed_types = array("jpg", "png", "jpeg", );
        $image_size= $_FILES['candidate_photo']['size'];
    

        $query = "SELECT * FROM candidate_details";
        $result = mysqli_query($db, $query);
        if (mysqli_num_rows($result) > 0) {
        $sno = 1;
        while ($row = mysqli_fetch_assoc($result)) 
        {
        
            $result=mysqli_query($db, "UPDATE candidate_details SET `election_topic`='$election_topic',`candidate_name`='$candidate_name',`Registration_No`='$Registration_No',`candidate_details`='$candidate_details',`candidate_photo`='$candidate_photo' WHERE id='$id'");

            if($result>0)
            {
               header('Location: /project/admin/adminhome.php?addCandidatePage=1'); 
        
            }
        
        }
}

    
  
}


?>