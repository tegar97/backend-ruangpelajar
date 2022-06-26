<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;
class certifcateGenerator extends Controller
{
    public function process() {
        $name = "tegar";
        $outputFile = "certificate.pdf";
        $this->fillPdf(public_path(), 'master/template.pdf',$outputFile,$name);
    }

    public function fillPdf($file,$outputFile,$name) 
    {
        $fpdi = new FPDI;
        $fpdi->setSourceFile($file);
        $template = $fpdi->importPage(1);
        $size = $fpdi->getTemplateSize($template
    );
        $fpdi->AddPage($size['orientation'],array($size['width'],$size['height']));
        $fpdi->useTemplate($template);
        $top = 105;
        $right = 135;
        $fpdi->SetFont('helvetica','',17);
        $fpdi->SetTextColor(25,26,25);
        $fpdi->Text($right,$top,$name);
    }
}
