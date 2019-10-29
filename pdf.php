<?php
    SESSION_START();

    // include tcpdf-class
    require_once ('tcpdf_6_2_26/tcpdf.php');

    // check if customer or device is chosen
    if (isset($_GET["custname"])){
        $whowhat = $_GET["custname"];
        // tablehead
        $tablehead = '<table>
                        <thead>
                            <tr>
                                <th align="left">Bezeichnung</th>
                                <th align="left">Geräteart</th>
                                <th align="left">CPU</th>
                                <th align="left">Speicherkapazität</th>
                                <th align="left">RAM</th>
                                <th align="left">Seriennr</th>
                                <th align="left">BS</th>
                                <th align="left">Anschaffung</th>
                            </tr>
                        </thead>
                    </table>';
    }
    else if(isset($_GET["devicetyp"])){
        $whowhat = $_GET["devicetyp"];
        // tablehead
        $tablehead = '<table>
                        <thead>
                            <tr>
                                <th align="left">Kunde</th>
                                <th align="left">Bezeichnung</th>
                                <th align="left">CPU</th>
                                <th align="left">Speicherkapazität</th>
                                <th align="left">RAM</th>
                                <th align="left">Seriennr</th>
                                <th align="left">BS</th>
                                <th align="left">Anschaffung</th>
                            </tr>
                        </thead>
                    </table>';
    }
    
    // get datatable-content
    $html = $_SESSION["content"];

    // count different types of devices
    /*$count_laptop = substr_count($hmtl, '<td>Laptop</td>', 0);
    $count_rechner = substr_count($hmtl, '<td>Rechner</td>', 0);
    $count_server = substr_count($html, '<td>Server</td>', 0);*/

    $txt =  "Anzahl Laptops: ".$_SESSION['countlaptops'];
    $txt .= "\nAnzahl Rechner: ".$_SESSION['countrechner'];
    $txt .= "\nAnzahl Server: ".$_SESSION['countserver'];
    
        
    $pdfName = "Inventarliste ".$whowhat;

    class PDF extends TCPDF {

        public function Header(){        
            //set logo
            $image_file = 'logo_Zerbits.png';
            $this->Image($image_file, 15, 15, 45, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false,false,false);
            //set font
            $this->SetFont('helvetica', 'B', 15);
            //set title; params: width, height, content, border, position after, align, fill, link, scale
            $this->Cell(0, 15, 'Inventarliste '.$GLOBALS["whowhat"], 0, false, 'C', 0, '', 0, false, 'M', 'M');
            $this->SetFont('helvetica', '', 12);
            $this->Cell(0, 15, date('d.m.Y'), 0, true, 'C', 0, '', 0, false, 'M', 'M');
            $this->SetFont('helvetica', '', 10);
            $this->writeHTMLCell(270, '', 15, 30, $GLOBALS["tablehead"], true, false, false, true, '', true);
        }

        public function Footer() {
            //position from bottom
            $this->SetY(-15);
            //set font
            $this->SetFont('helvetica', '', 9);
            //page number
            $this->Cell(0, 10, 'Seite '.$this->getAliasNumPage().' von '.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T','M');
        }
    }

    //--------------------------------------------------
    // create new PDF document
    $pdf = new PDF('L', 'mm', 'A4', true, 'UTF-8');

    // set document meta information
    $pdf->SetCreator('Zerbits GmbH');
    $pdf->SetAuthor('ZerBits GmbH');
    $pdf->SetTitle('Inventarliste '.$whowhat);
    $pdf->SetSubject('Inventarliste Kundengeräte');

    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

    // set header - footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA)); 
    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(20,35.5,20);
    $pdf->SetHeaderMargin(15);
    $pdf->SetFooterMargin(10);

    // set auto page breaks
    $pdf->SetAutoPageBreak(True, 20);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // set font
    $pdf->SetFont('helvetica', '', 10);

    // new page
    $pdf->AddPage();
      
    // writeHTMLCell()-parameters: $w, $h, $x, $y, $html = '', $border = 0, $ln = 0, $fill = false, $reseth = true, $align = '', $autopadding = true 
    // border 'LRB' - left rigth bottom (no top border)
    $pdf->writeHTMLCell(270, '', 15, 35, $html, 'LRB', 1, false, true, '', true);
    $pdf->write(0, '', '', 0, 'L',true, 0, false, false, 0);
    $pdf->write(0, $txt, '', 0, 'L',true, 0, false, false, 0);
      
    // Clean any content of the output buffer - um Fehlermeldung von tcpdf zu vermeiden - OUTPUT von vorher noch finden
    ob_end_clean();

    // show pdf in browser
    $pdf->Output($pdfName, 'I');

    unset($_SESSION["countlaptops"]);
    unset($_SESSION["countrechner"]);
    unset($_SESSION["countserver"]);
?>

