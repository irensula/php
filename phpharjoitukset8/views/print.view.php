<?php

require('.././fpdf/fpdf.php');

class PDF extends FPDF {
    // Page header
    function Header() {
        // Logo
        $this->Image('.././public/images/main-img.jpg',10,6,30);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(40,10,'Reseptipankki',1,0,'C');
        // Line break
        $this->Ln(20);
    }
    // Page footer
    function Footer() {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}
// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->Cell(20,10, $category);
$pdf->Cell(30,10, $name);
$pdf->Cell(40,10, $image);
$pdf->Cell(50,10, $ingredients);
$pdf->Cell(60,10, $preparation);
$pdf->Cell(70,10, $additionDate);
$pdf->Output();

//https://www.youtube.com/watch?v=qB44PreHWow