<?php 

    include 'db_conn.php';
    require("../fpdf.php");
    session_start();
    if(!isset($_SESSION['uid'])){
        header('location:../index.php');
        die;
    }

    $pdf = new FPDF();
    //get customer's details
    $usrID = $_SESSION["uid"];
    $fname = $_SESSION["fname"];
    $lname = $_SESSION["lname"];
    $phone = $_SESSION['phone'];
    $email = $_SESSION['email'];
    $addre = $_SESSION['address'];
    $distr = $_SESSION['district'];
    $totEntries = $_SESSION["purchEntries"];
    

    

    //- - - - PAGE BODY - - - -
    $pdf->AddPage();

    //- - - - HEADER - - - - 
    $pdf->SetFont("Arial","B", 22);
    $pdf->image('../images/logo.png', 50,5, 20,20);
    $pdf->Cell(65,10,"" ,0,0, "L");
    $pdf->Cell(115,10,"The Multitool Center" ,0,1, "L");
    $pdf->ln(20);

    //querying database for customer's purchase
    $purchaseLookup = mysqli_query($conn,"SELECT * FROM purchase_table WHERE uid = '$usrID' ORDER BY id DESC LIMIT $totEntries");
    $purchDet = mysqli_fetch_row($purchaseLookup);

    $pdf->SetFont("Arial","B", 12);
    //- - - - PURCHASE INFO - - - - 
    //purchase details                                          //account details
    $pdf->Cell(90,5, "Customer Details", 0,0);                  $pdf->Cell(90,5, "Purchase Details", 0,1);
    $pdf->SetFont("Arial","", 10);
    $pdf->Cell(90,5, $fname." ".$lname, 0,0);                   $pdf->Cell(90,5, "Purchase Order: ".$purchDet[0], 0,1);
    $pdf->Cell(90,5, $addre.", ".$distr, 0,0);                  $pdf->Cell(90,5, "Purchase Date:   ".$purchDet[5], 0,1);
    $pdf->Cell(90,5, $email, 0,1);
    $pdf->ln(20);

    //- - - - ITEMS PURCHASE LISTED - - - - 
    //cart details
    $grandTotal = 0;
    $totalLineDivider = 100;
    $pdf->SetFont("Arial","B", 16);
    $pdf->Cell(180,10, "Items Purchased", 0,1, "C");
    //cart header
    $pdf->SetFont("Arial","", 10);
    $pdf->Cell(100,10, "Product Name", 0,0, "L");
    $pdf->Cell(25,10, "Qty", 0,0, "L");
    $pdf->Cell(55,10, "Amount", 0,1, "L");
    //divider line
    $pdf->line(10, 100, 180, 100);
    //cart body
    //inserting purchase data into table
    $purchaseLookup = mysqli_query($conn,"SELECT * FROM purchase_table WHERE uid = '$usrID' ORDER BY id DESC LIMIT $totEntries");
    if (mysqli_num_rows($purchaseLookup)>0){
        while($row_data = mysqli_fetch_array($purchaseLookup)){
            //storing purchase data
            $itName = $row_data['item_name'];
            $itQuan = $row_data['quantity'];
            $itPric = $row_data['total'];
            $purOrd = $row_data['id'];
            $puDate = $row_data['date_of_purchase'];
            
            $pdf->Cell(100,8, "$itName", 0,0, "L");
            $pdf->Cell(25,8, "$itQuan", 0,0, "L");
            $pdf->Cell(55,8, "$"."$itPric".".00", 0,1, "L");

            $grandTotal += $itPric;
            $totalLineDivider += 8;
        }
    }
    //- - - - PURCHASE TOTAL - - - - 
    //divider line
    $pdf->line(10, $totalLineDivider, 180, $totalLineDivider);
    $gst =  $grandTotal * 0.12;
    $subtotal = $grandTotal - $gst;
    $pdf->Cell(100,6, "", 0,0, "L");
    $pdf->Cell(25,6, "Subtotal: ", 1,0, "R");
    $pdf->Cell(45,6, " $"."$subtotal", 1,1, "L");

    $pdf->Cell(100,6, "", 0,0, "L");
    $pdf->Cell(25,6, "GST (12%): ", 1,0, "R");
    $pdf->Cell(45,6, " $"."$gst", 1,1, "L");

    $pdf->Cell(100,6, "", 0,0, "L");
    $pdf->Cell(25,6, "Total: ", 1,0, "R");
    $pdf->Cell(45,6, " $"."$grandTotal".".00", 1,1, "L");

    $pdf->Output();
?>
