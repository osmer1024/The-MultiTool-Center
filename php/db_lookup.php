<?php
	include 'db_conn.php';
    session_start();
    if( isset($_POST['signE']) ){
        $email = $_POST['signE'];
        $password = $_POST['signP'];
        //query to find user credentials
        $check = mysqli_query($conn,"select * from users_table where email_address = '$email' and password = '$password'");
        //if num_rows is greater than 0, account exists
        if (mysqli_num_rows($check)>0)
        {
            //saving data into session
            $rowData = mysqli_fetch_row($check);
            $_SESSION["uid"] = $rowData[0];
            $_SESSION["fname"] = $rowData[1];
            $_SESSION["lname"] = $rowData[2];
            $_SESSION['phone'] = $rowData[3];
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            $_SESSION['address'] = $rowData[6];
            $_SESSION['district'] = $rowData[7];
            echo json_encode(array("statusCode"=>200));
        }
        else{
            echo json_encode(array("statusCode"=>201));
        }
        mysqli_close($conn);
    }

?>