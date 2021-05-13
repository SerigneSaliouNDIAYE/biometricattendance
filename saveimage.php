<?php
    	include 'connectDB.php';   
        $path ='zal'.date('YmdHis').rand(383,1000).'.jpg';
        move_uploaded_file($_FILES['webcam']['tmp_name'], $path);
       // $query = "INSERT INTO photo (id, image) VALUES ('', '".$path."')";
		
		$query="INSERT INTO users ( username, serialnumber, gender, email, fingerprint_id, fingerprint_select, user_date, time_in, add_fingerid, photo) VALUES ('', '', '', '', '', '', '', '', '', '".$path."')";
        $conn->query($query);
echo "<script>alert('successfully..');</script>";
 
    ?>