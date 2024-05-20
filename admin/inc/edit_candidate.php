<?php


    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
    }
?>
<?php 
    if(isset($_GET['added']))
    {
?>
<div class="alert alert-success my-3" role="alert">
    Candidate has been added successfully.
</div>
<?php 
    }else if(isset($_GET['largeFile'])) {
?>
<div class="alert alert-danger my-3" role="alert">
    Candidate image is too large, please upload small file (you can upload any image upto 2mbs.).
</div>
<?php
    }else if(isset($_GET['invalidFile']))
    {
?>
<div class="alert alert-danger my-3" role="alert">
    Invalid image type (Only .jpg, .png files are allowed) .
</div>
<?php
    }else if(isset($_GET['failed']))
    {
?>
<div class="alert alert-danger my-3" role="alert">
    Image uploading failed, please try again.
</div>
<?php
    }

?>
<div class="row my-3">
    <div class="col-4">
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
                <input type="text" name="candidate_name" placeholder="Candidate Name" class="form-control" required />
            </div>
            <div class="form-group">
                <input type="file" name="candidate_photo" class="form-control" required />
            </div>
            <div class="form-group">
                <input type="text" name="Registration_No" placeholder="Registration_No" class="form-control" required />
            </div>
            <div class="form-group">
                <input type="text" name="candidate_details" placeholder="Candidate Details" class="form-control"
                    required />
            </div>
            <input type="submit" value="Add Candidate" name="editCandidateBtn" class="btn btn-success" />
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
            // $alreadyp="notpresent";
        //  echo $row['Registration_No'];
          if($_POST['Registration_No'] == $row['Registration_No'])
            {
                // echo $row['Registration_No'];
            $alreadyp = "present";
            // echo $alreadyp;
            }
        }
        if($alreadyp=="present")
        {
            echo "";
        }
        else{
            $result=mysqli_query($db, "UPDATE `candidate_details` SET `election_topic`='$election_topic',`candidate_name`='$candidate_name',`Registration_No`='$Registration_No',`candidate_details`='$candidate_details',`candidate_photo`='$candidate_photo' WHERE id='$id'");

            if($result>0)
            {
               header('Location: /project/admin/adminhome.php?addCandidatePage=1'); 
        
            }
        
        }
}

    
  
}


?>