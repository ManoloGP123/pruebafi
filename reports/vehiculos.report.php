<?php
require('../reports/fpdf.php');
require_once("../models/vehiculos.model.php");

$pdf = new FPDF();
$pdf->AddPage();
$vehiculos = new Vehiculos();  
$pdf->SetFont('Arial', 'B', 12);
$pdf->Text(30, 10, 'Reporte de Vehículos');
$pdf->SetFont('Arial', '', 12);


$listavehiculos = $vehiculos->todos();  


if ($listavehiculos) {
    $pdf->Ln(10); 

    // Tablas vehículos
    $pdf->Cell(10, 10, "#", 1);
    $pdf->Cell(30, 10, "ID Vehiculo",1);
    $pdf->Cell(40, 10, "Marca", 1);
    $pdf->Cell(40, 10, "Modelo", 1);
    $pdf->Cell(20, 10, "Año", 1);
    $pdf->Cell(30, 10, "Disponible", 1);
    $pdf->Ln();

    
    $index = 1;
    while ($vehiculo = mysqli_fetch_assoc($listavehiculos)) {
        $pdf->Cell(10, 10, $index, 1);
        $pdf->Cell(30, 10, $vehiculo["vehiculo_id"], 1);
        $pdf->Cell(40, 10, $vehiculo["marca"], 1);
        $pdf->Cell(40, 10, $vehiculo["modelo"], 1);
        $pdf->Cell(20, 10, $vehiculo["año"], 1);
        $pdf->Cell(30, 10, $vehiculo["disponible"], 1);
        $pdf->Ln();
        $index++;
    }
} else {
    $pdf->Ln(20);
    $pdf->Cell(0, 10, 'No hay vehículos disponibles.', 1, 1, 'C');
}


$pdf->Output();
?>
