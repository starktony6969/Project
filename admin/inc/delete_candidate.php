
<?php


        $id = $_GET['id'];
        $db = mysqli_connect("localhost", "root", "", "project") or die("Connectivity Failed");

            $query = "DELETE FROM `candidate_details` WHERE id='$id'";
            $result = mysqli_query($db, $query);
            header('Location: /project/admin/adminhome.php?addCandidatePage=1'); 
    

   
?>