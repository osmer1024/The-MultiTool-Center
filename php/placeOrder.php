<?php
	include 'db_conn.php';
    session_start();
    if( isset($_POST['noItemEntries']) ){
        $uid=$_POST['userID'];
        $item_name=$_POST['itemName'];
        $item_quant=$_POST['itemQuant'];
        $item_price=$_POST['priceTot'];
        $buyer_add=$_POST['buyerAdd'];
        $buyer_dist=$_POST['buyerDist'];
        $pay_meth=$_POST['paymentMeth'];
        $card_name=$_POST['paymentName'];
        $card_num=$_POST['paymentNum'];

        //storing the amount of entries made on purchase
        $_SESSION["purchEntries"] = $_POST['noItemEntries'];

        //placeing order into database
        $sql = "INSERT INTO `purchase_table`( `uid`, `item_name`, `quantity`, `total`, `add_address`, `add_district`, `method`, `name_on_card`, `card_number`) 
        VALUES ('$uid','$item_name','$item_quant','$item_price','$buyer_add','$buyer_dist','$pay_meth','$card_name','$card_num')";

        //reporting result of insertion
        if (mysqli_query($conn, $sql)) {
            echo json_encode(array("statusCode"=>200));
        } 
        else {
            echo json_encode(array("statusCode"=>201));
        }
        mysqli_close($conn);
    }	
?>