<?php
    include "connection.php";
    require ("fpdf/fpdf.php");
    if(isset($_GET['d_id'])){
        $d_id = $_GET['d_id'];
        
        $sql = "SELECT * From deposit WHERE d_id = '$d_id'";
        $query = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($query);
        $invoice = $row['deposit_no'];
        $subject = $row['subject'];
        $category = $row['category'];
        $amount = $row['amount'];
        $time = $row['time'];
        date_default_timezone_set('Asia/Dhaka');
        $print_time = date('d/m/Y  h:i:s a');

        $pdf = new FPDF();

        $pdf ->AddPage("P","A4");
        $pdf -> setFont("Arial");

        $pdf->cell(0,20,"MASUM RECORD WEB\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\tLIFE PAYMENT RECORD",0,1,"C",);
        $pdf->cell(0,10,"Invoice/Deposit Memo",0,1,"C",);
        $pdf->cell(50.5,10,"Invoice No ",0,0);
        $pdf->cell(50.5,10,": {$invoice}",0,0);
        $pdf->cell(50.5,10,"Invoice Date ",0,0);
        $pdf->cell(50.5,10,": {$time}",0,1);
        $pdf->cell(50.5,10,"Subject ",0,0);
        $pdf->cell(50.5,10,": {$subject}",0,0);
        $pdf->cell(50.5,10,"Category ",0,0);
        $pdf->cell(50.5,10,": {$category}",0,1);
        $pdf->cell(50.5,10,"AMOUNT ",0,0);
        $pdf->cell(50.5,10,": {$amount}",0,1);
        $pdf->cell(50.5,10,"Please Contact",0,1);
        $pdf->cell(50.5,10,"Mohakhali,Dhaka-1212",0,1);
        $pdf->cell(50.5,10,"Name: Md Masum",0,1);
        $pdf->cell(50.5,10,"Phone: 01798840244",0,1);
        $pdf->cell(50.5,10,"Gmail:mdmasum99d@gmail.com",0,1);
        $pdf->cell(0,10,"Print Date & Time:{$print_time}",0,1,"C");
        $pdf->Output();
    }
?>