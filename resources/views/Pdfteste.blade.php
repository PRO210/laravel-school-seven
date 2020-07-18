<?php

use Jithesh\Fpdf\FPDF;

$pdf = new FPDF();



    $pdf->SetLeftMargin(10);
    $pdf->SetAutoPageBreak(false);
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->RotatedText(70, 9, 'HISTÓRICO ESCOLAR DO ENSINO FUNDAMENTAL', 0);
    $pdf->SetFont('Arial', '', 7);
    $pdf->Cell(20, 30, '', 1, 0, 'L');
    $pdf->RotatedText(15, 35, 'COMPONENTES  ', 90);
    $pdf->RotatedText(20, 35, 'CURRICULARES', 90);
    for ($i = 0; $i < 5; $i++) {
        $pdf->Cell(10, 30, '', 1, 0, 'L');
    }
    $pdf->RotatedText(36, 39, 'LÍNGUA PORTUGUESA', 90);
    $pdf->RotatedText(44, 39, 'ESTUDOS SOCIAIS', 90);
    $pdf->RotatedText(56, 39, 'HISTÓRIA', 90);
    $pdf->RotatedText(66, 39, 'GEOGRAFIA', 90);
    $pdf->RotatedText(76, 39, 'CIÊNCIAS', 90);
    $pdf->Cell(15, 30, '', 1, 0, 'L');
    $pdf->RotatedText(86, 39, 'CIÊNCIAS FISÍCAS BIO.', 90);
    $pdf->RotatedText(89, 39, 'E PROGRAMAS', 90);
    $pdf->RotatedText(92, 39, 'DE SAÚDE', 90);
    for ($i = 0; $i < 5; $i++) {
        $pdf->Cell(10, 30, '', 1, 0, 'L');
    }
    $pdf->RotatedText(102, 39, 'ARTE', 90);
    $pdf->RotatedText(112, 39, 'EDUCAÇÃO ARTISTÍCA', 90);
    $pdf->RotatedText(122, 39, 'EDUCAÇÃO FÍSICA', 90);
    $pdf->RotatedText(132, 39, 'ENSINO RELIGIOSO', 90);
    $pdf->RotatedText(142, 39, 'MATEMÁTICA', 90);
    $pdf->Cell(15, 30, '', 1, 0, 'L');
    $pdf->RotatedText(150, 39, 'LINGUA ESTRANGEIRA', 90);
    $pdf->RotatedText(154, 39, 'MODERNA INGLÊS', 90);
    $pdf->Cell(10, 30, '', 1, 0, 'L');
    $pdf->RotatedText(165, 39, 'REDAÇÃO', 90);
    $pdf->Cell(15, 30, '', 1, 0, 'L');
    $pdf->RotatedText(175, 39, 'ELEMENTOS DE', 90);
    $pdf->RotatedText(178, 39, 'DESENHOS', 90);
    $pdf->RotatedText(181, 39, 'GEOMETRICOS', 90);
    $pdf->Cell(15, 30, '', 1, 1, 'L');
    $pdf->RotatedText(193, 39, 'DHC', 90);
    //

$pdf->Output();

exit();

//
