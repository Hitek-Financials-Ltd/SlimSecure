<?php

namespace Hitek\Slimez\Payments\Core;

use TCPDF;

class PDFGenerator
{
    private $filename;
    private $content;

    public function __construct($filename)
    {
        $this->filename = $filename;
        $this->content = '';
    }

    public function addContent($content)
    {
        $this->content .= $content;
    }

    public function generate()
    {

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle($this->filename);
        $pdf->SetSubject('Generated PDF');
        $pdf->SetKeywords('PDF, Document, Generator');

        $pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING);
        $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        $pdf->setFontSubsetting(true);

        $pdf->SetFont('dejavusans', '', 14, '', true);

        $pdf->AddPage();

        $pdf->writeHTML($this->content, true, false, true, false, '');

        $pdf->lastPage();

        // Output the PDF file for download
        $pdf->Output($this->filename . '.pdf', 'D');
    }
}

// Example usage:
$generator = new PDFGenerator('example');//This is the file name
$generator->addContent('<h1>Example PDF Content</h1>');
$generator->addContent('<p>This is an example PDF file generated using PHP.</p>');
$generator->generate();
