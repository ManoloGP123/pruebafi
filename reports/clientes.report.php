<?php
require('../reports/fpdf.php');
require_once("../models/clientes.model.php");

$pdf = new FPDF();
$pdf->AddPage();
$clientes = new Clientes();  
$pdf->SetFont('Helvetica', 'B', 12);
$pdf->Text(30, 10, 'Reporte Clientes');
$pdf->SetFont('Helvetica', '', 12);


$listaclientes = $clientes->todos();  


if ($listaclientes) {
    $pdf->Ln(10); 

    // Tablas clientes
    $pdf->Cell(10, 10, "#", 1);
    $pdf->Cell(30, 10, "ID Cliente", 1);
    $pdf->Cell(40, 10, "Nombre", 1);
    $pdf->Cell(40, 10, "Apellido", 1);
    $pdf->Cell(40, 10, "Licencia", 1);
    $pdf->Cell(30, 10, "Telefono", 1);
    $pdf->Ln();

    
    $index = 1;
    while ($cliente = mysqli_fetch_assoc($listaclientes)) {
        $pdf->Cell(10, 10, $index, 1);
        $pdf->Cell(30, 10, $cliente["cliente_id"], 1);
        $pdf->Cell(40, 10, $cliente["nombre"], 1);
        $pdf->Cell(40, 10, $cliente["apellido"], 1);
        $pdf->Cell(40, 10, $cliente["licencia"], 1);
        $pdf->Cell(30, 10, $cliente["telefono"], 1);
        $pdf->Ln();
        $index++;
    }
} else {
    $pdf->Ln(20);
    $pdf->Cell(0, 10, 'No hay clientes disponibles.', 1, 1, 'C');
}

// Salida del PDF
$pdf->Output();
?>
