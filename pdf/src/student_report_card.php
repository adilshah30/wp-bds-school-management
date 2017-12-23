<?php
//function bds_homework_pdf(){
/**
 * HTML2PDF Library - example
 *
 * HTML => PDF convertor
 * distributed under the LGPL License
 *
 * @package   Html2pdf
 * @author    Laurent MINGUET <webmaster@html2pdf.fr>
 * @copyright 2016 Laurent MINGUET
 *
 * isset($_GET['vuehtml']) is not mandatory
 * it allow to display the result in the HTML format
 */
    require_once(dirname(__FILE__).'/../vendor/autoload.php');
    try
    {
        // init HTML2PDF
        $html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', array(0, 0, 0, 0));

        // display the full page
        $html2pdf->pdf->SetDisplayMode('fullpage');

        // get the HTML
        ob_start();
        include(dirname(__FILE__).'/pdf_layout/student_report_card_pdf_layout.php');
        $content = ob_get_clean();

        // convert
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));

        // add the automatic index
        $html2pdf->createIndex('', 30, 12, false, true, 2);
            ob_end_clean();
        // send the PDF
        $html2pdf->Output('bds_report_card.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }