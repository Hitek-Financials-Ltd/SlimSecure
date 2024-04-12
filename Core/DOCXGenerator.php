<?php
namespace Hitek\Slimez\Payments\Core;

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class DOCXGenerator
{
    private $filename;
    private $phpWord;

    public function __construct($filename)
    {
        $this->filename = $filename;
        $this->phpWord = new PhpWord();
    }

    public function addContent($content)
    {
        $section = $this->phpWord->addSection();
        $section->addText($content);
    }

    public function generate()
    {
        $filePath = $this->filename . '.docx';

        $objWriter = IOFactory::createWriter($this->phpWord, 'Word2007');
        $objWriter->save($filePath);

        // Download the file
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $this->filename . '.docx"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);

        // Clean up the temporary file
        unlink($filePath);
    }
}

// Example usage:
$generator = new DOCXGenerator('example');//file name
$generator->addContent('Example DOCX Content');
$generator->addContent('Lorem ipsum dolor sit amet, consectetur adipiscing elit.');
$generator->generate();
