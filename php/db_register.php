<?php
	include 'db_conn.php';
    session_start();
    if( isset($_POST['first']) ){
        //query to see if email has been added before
        $email=$_POST['emailAdd'];
        $doesExist = mysqli_query($conn,"select * from users_table where email_address = '$email'");
        //if num_rows is 0, the email has not been saved before and the email can be used
        if (mysqli_num_rows($doesExist) == 0){
            $fname=$_POST['first'];
            $lname=$_POST['last'];
            $address=$_POST['homeAdd'];
            $district=$_POST['district'];
            $phone=$_POST['phoneNum'];
            $password=$_POST['password'];

            $sql = "INSERT INTO `users_table`( `fname`, `lname`, `phone_no`, `email_address`, `password`, `address`, `district`) 
            VALUES ('$fname','$lname','$phone','$email','$password','$address','$district')";
            if (mysqli_query($conn, $sql)) {
                echo json_encode(array("statusCode"=>200));
            } 
            else {
                echo json_encode(array("statusCode"=>201));
            }
        }
        else{
            echo json_encode(array("statusCode"=>202));
        }
        
        mysqli_close($conn);
    }	
?>