<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(dirname(__FILE__) . '/dompdf/autoload.inc.php');

class Pdf
{
    function createPDF($html, $filename='', $download=TRUE, $paper='A4', $orientation='landscape'){
        $dompdf = new Dompdf\Dompdf();
        $dompdf->load_html($html);
        $customPaper = array(0,0,300,600);
   //     $dompdf->set_paper($customPaper);
        $dompdf->set_paper($customPaper, $orientation);
        $dompdf->render();
       // $pdf = PDF::loadView('pdf.or_spct', $data)->setPaper(array(0, 0, 396, 612), 'landscape');
        if($download)
            $dompdf->stream($filename.'.pdf', array('Attachment' => 1));
        else
            $dompdf->stream($filename.'.pdf', array('Attachment' => 0));
    }
}
?>