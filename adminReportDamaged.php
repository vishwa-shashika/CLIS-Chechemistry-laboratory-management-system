<?php

session_start();

if($_SESSION['role']!="Admin"){
    header('location:index.php');
}

require('fpdf/fpdf.php');

include_once 'connectdb.php';



$pdf = new FPDF('P','mm','A4');

$pdf->AddPage();

$pdf->SetFont('Arial','B',16);
$pdf->Cell(130,10,'Faculty Of Computing & Technology',0,0);

$pdf->SetFont('Arial','B',13);
$pdf->Cell(60,10,'Required Equipments',0,1,'C');

$pdf->SetFont('Arial','',10);
$pdf->Cell(130,5,'4th Post, Peliyagoda, Kelaniya.',0,0);
$pdf->SetFont('Arial','',10);

date_default_timezone_set("Asia/Kolkata");
$pdf->Cell(60,5,'Date : '.date("Y/m/d"),0,1,'C');

$pdf->SetFont('Arial','',10);
$pdf->Cell(150,5,'Phone : 011-4545123',0,1);
$pdf->Cell(150,5,'Email : fct@kln.ac.lk',0,1);


$pdf->Line(5,40,205,40);
$pdf->Ln(10);    //Line Break



$pdf->SetFont('Arial','B',13);
$pdf->SetFillColor(208,208,208);
$pdf->Cell(120,10,'Equipment Name',1,0,'L',true);
$pdf->Cell(70,10,'Required Qty',1,1,'C',true);

$pdf->Ln(3);





$select = $pdo->prepare("SELECT * FROM items");
$select->execute();
while($row=$select->fetch(PDO::FETCH_ASSOC)){
    $i_stock = (int)$row['ideal_stock'];
    $c_stock = (int)$row['current_stock'];
    $r_stock = $i_stock - $c_stock;
    if($r_stock>0){
        
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(120,8,$row['item_name'],1,0,'L',);
        $pdf->Cell(70,8,$r_stock,1,1,'C',true);
                            
    }

}








$pdf->Output();





?>