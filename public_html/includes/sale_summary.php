<?php
session_start();

include_once("../fpdf/fpdf.php");

// Unescape the string values in the JSON array
$tableData = stripcslashes($_POST['tableData']);

//$selectType = $_POST['selectType'];
//$selectOption = $_POST['selectOption'];

// Decode the JSON array
$tableData = json_decode($tableData,TRUE);

// now $tableData can be accessed like a PHP array
// echo $tableData[0]['Full Name'];

if (count($tableData) > 0) {
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->setFont("Arial", "B", 16);
    $pdf->Cell(190, 10, "SCR System Summary", 0, 1, "C");
    $pdf->setFont("Arial", null, 12);

    $pdf->Cell(50, 10, "Start Date", 0, 0);
    $pdf->Cell(50, 10, ": " . $_POST['startDate'], 0, 1);
    $pdf->Cell(50, 10, "End Date", 0, 0);
    $pdf->Cell(50, 10, ": " . $_POST['endDate'], 0, 1);

    $pdf->Cell(50, 10, "", 0, 1);

    $pdf->Cell(10, 10, "#", 1, 0, "C");
    $pdf->Cell(40, 10, "Employee ID", 1, 0, "C");
    $pdf->Cell(70, 10, "Full Name", 1, 0, "C");
    $pdf->Cell(60, 10, "Account Total (Rs)", 1, 1, "C");

    for ($i = 0; $i < count($tableData); $i++) {
        $pdf->Cell(10, 10, ($i + 1), 1, 0, "C");
        $pdf->Cell(40, 10, $tableData[$i]["Employee ID"], 1, 0, "C");
        $pdf->Cell(70, 10, $tableData[$i]["Full Name"], 1, 0, "C");
        $pdf->Cell(60, 10, $tableData[$i]["User Type"], 1, 1, "C");
    }

    $pdf->Cell(50, 10, "", 0, 1);

    $pdf->Cell(180, 10, "Signature", 0, 0, "R");

    $pdf->Output("../PDF_INVOICE/PDF_INVOICE_" . date("Y-m-d H:i:s") . ".pdf", "F");

    $pdf->Output();

}
echo "Success!";
